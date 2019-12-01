<?php



defined('BASEPATH') OR exit('No direct script access allowed');

function ci() {
    $ci =& get_instance();
    return $ci;
}

function sessData($key) {
    return ci()->session->userdata($key);
}

function setSession($data) {
    return ci()->session->set_userdata($data);
}

function sess($key) {
    return ci()->session->userdata($key);
}

function isLoggedIn() {
    return sessData('authenticated') ? TRUE : FALSE;
}

function loadView($page, $data = NULL) {
    return ci()->load->view($page, $data);
}

function render($page = NULL, $data = NULL, $withTemplate = TRUE) {
    $expPage = explode('/', $page);
    if (uriSegment(1)) {
        if (in_array($expPage[1], array('promotion', 'retirement'))) {
            if (!canAccess($expPage[1].'/'.uriSegment(2))) {
                $page = NULL;
                $data['notGrantedAlert'] = TRUE;
            }
        } else if (!canAccess($expPage[1]) && uriSegment(4) != 'f') {
            $page = NULL;
            $data['notGrantedAlert'] = TRUE;
        }
    }

    if (isLoggedIn()) {
		$data['photo']          = ci()->Auth_model->getUserPhoto(sess('nip'));
        $data['page']           = $page != NULL ? $page : 'landing/index';
        $data['withTemplate']   = $withTemplate;

        ci()->load->view('master', $data);
    } else {
        loadView('auth/login');
    }
}

function dateFormat() {
    return 'd/m/Y';
}

function inputGet($key = NULL) {
    return ci()->input->get($key);
}

function inputPost($key = '') {
    return ci()->input->post($key);
}

function uriSegment($segment) {
    return ci()->uri->segment($segment);
}

function DBS() {
    return ci()->db;
}

function maximumContentLimitation() {
    ci()->load->model('Preferences_model');
    return ci()->Preferences_model->getMaximumContentLimitation();
}

function currentMethod() {
    return uriSegment(3);
}

// Set segment of primary key for updating/deleting data
function primaryKeySegmentData() {
    return uriSegment(4);
}

function env($value) {
    return getenv($value);
}

function dateFields() {
    return array('promotionSK', 'currentSK', 'createdDate');
}

function generateDataTable($data, $columns, $pk, $model) {
    
    $statusIcons = array(
        'Open' => '<i style="color:green" class="fas fa-circle"></i> &nbsp; Open',
        'Sedang Direview' => '<i class="fas fa-search" style="color:lime"></i> &nbsp; Sedang Direview',
        'Sedang Dikirim' => '<i class="fas fa-share" style="color:blue"></i> &nbsp; Sedang Dikirim',
        'Reject' => '<i class="fas fa-times" style="color:red"></i> &nbsp; Rejected',
        'Done' => '<i style="color:green;" class="fas fa-check"></i> &nbsp; Done',
    );

    $list = array();
    $no = $_POST['start'];

    foreach ($data as $field) {
        $no++;
        $row = array();
        $row[] = $field->{$pk};
        $row[] = $no;
        
        foreach ($columns as $key => $value) {
            // aliasing, concatiation
            if ($key == 'bup') {
                $field->{$key} = date('d F', strtotime($field->tgl_lahir)) . ' ' . date('Y', strtotime($field->tgl_lahir . "+696 months"));
            }
            if ($key == 'retSK') {
                $field->{$key} = date('01 F Y',  strtotime($field->tgl_lahir . "+697 months"));
            }
            if ($key == 'pangkat') {
                $field->{$key} = $field->golongan . ' (' . $field->pangkat . ')';
            }
            if ($key == 'promotionReqID') {
                $field->{$key} = 'TPR-'.sprintf('%04d', $field->{$key});
            }
            if ($key == 'retirementReqID') {
                $field->{$key} = 'TRT-'.sprintf('%04d', $field->{$key});
            }
            if ($key == 'activityID') {
                if ($field->activityType == 'Promotion') {
                    $field->{$key} = 'TPR-'.sprintf('%04d', $field->{$key});                    
                } else {
                    $field->{$key} = 'TRT-'.sprintf('%04d', $field->{$key});
                }
            }
            if ($key == 'time') {
                $field->{$key} = date('D, d/m/Y H:i', strtotime($field->{$key}));
            }
            if (in_array($key, dateFields())) {
                $field->{$key} = date(dateFormat(), strtotime($field->{$key}));
            }
            if (in_array($field->{$key}, array('', ' ', NULL))) {
                $field->{$key} = '-';
            }
            if ($key == 'approved') {
                if ($field->{$key} == NULL) {
                    $field->{$key} = '-';
                } else {
                    if ($field->{$key} == 'Y') {
                        $field->{$key} = 'Approved';                        
                    } else if ($field->{$key} == 'N') {
                        $field->{$key} = 'Rejected';
                    }
                }
            }
            if ($key == 'requestStatus') {
                $field->{$key} = $statusIcons[$field->{$key}];
            }
            
            $row[] = $field->{$key};
        }
 
        $list[] = $row;
    }
 
    $output = array(
        "draw" => $_POST['draw'],
        "recordsTotal" => ci()->{$model}->countAll(),
        "recordsFiltered" => ci()->{$model}->countFiltered(),
        "data" => $list,
        "post" => $_POST,
    );
    
    echo json_encode($output);
}

function ifEdit($EDIT, $field) {
    if (is_string($EDIT))
        return $EDIT;
    else {
        if (in_array($field, dateFields()))
            return isset($EDIT[$field]) ? date(dateFormat(), strtotime($EDIT[$field])) : '';
        else
            return isset($EDIT[$field]) ? $EDIT[$field] : '';
    }
        
}

function inputForm($legendName, $fieldName, $EDIT, $attributes = '', $type = 'text', $additionalClass = '', $additionalHtml = '') {
    echo    '<tr>
			    <td class="tdLegend">'.$legendName.'</td>
                <td>'. input($fieldName, $EDIT, $attributes, $type, $additionalClass) . $additionalHtml .'</td>
		     </tr>';
}

function input($fieldName, $EDIT, $attributes, $type, $additionalClass) {
    return '<input type="'.$type.'" name="'.$fieldName.'" value="'.ifEdit($EDIT, $fieldName).'" class="form-control '.$additionalClass.'" '.$attributes.'>';
}

function inputOption($legendName, $fieldName, $EDIT, $attributes = '', $data, $optionKey, $optionValue, $isAssoc = FALSE) {
    echo    '
        <tr>
			<td class="tdLegend">'.$legendName.'</td>
			<td>
				<select name="'.$fieldName.'" class="form-control" '.$attributes.'>
						<option value="" selected>-- Select '.str_replace('*', '', $legendName).' --</option>"';
						foreach ($data as $key => $value) {
                            $isSelected = $EDIT["$fieldName"] == $value["$optionKey"] ? 'selected' : '';
							if (!$isAssoc) {
                                echo '<option value="'.$value["$optionKey"].'" '.$isSelected.'>'.($fieldName == 'golongan' ? $value["$optionValue"] . ' (' . $value['pangkat'] . ')' : $value["$optionValue"]).'</option>';
                            } else {
                                echo '<option value="'.$key.'" '.$isSelected.'>'.$value.'</option>';
                            }
						}
	echo 		'</select>
			</td>
		</tr>
    ';
}

function readonlyIfNotEmpty($EDIT) {
    return !empty($EDIT) == '1' ? 'readonly' : '';
}

function flashData($key) {
    return ci()->session->flashdata($key);
}

function setFlashData($key, $message) {
    return ci()->session->set_flashdata($key, $message);
}

function ifProcessed($module, $model, $method, $data, $extraUrl = '', $mode = NULL, $f = 0) {
    $processed = ci()->{$model}->{$method}($data, $mode); // TRUE OR FALSE

    if ($processed) { // TRUE
        $data['edit'] ? // edit atau bukan,
            setFlashData('success', 'Data berhasil diupdate!') : // kalo edit
            setFlashData('success', 'Data berhasil ditambahkan!'); // kalo tambah

        if (in_array($module, array('promotion', 'retirement')) || (canAccess($module) && $f == 0)) {
            redirect($extraUrl != '' ? $module.'/'.$extraUrl : $module); // selesai tambah
        } else {
            redirect('/');
        }
    }
}

function trDetail($legendName, $value) {
    echo "<tr>
              <td style='width:200px;'>".$legendName."</td>
              <td>".($value != '' ? $value : '-')."</td>
          </tr>";
}

function isDate($value) {
    if (!$value) {
        return false;
    }

    try {
        new \DateTime($value);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function printTable($columns, $data) {
    
    echo '
        <link href="'.base_url('node_modules/mdbootstrap/css/bootstrap.min.css').'" rel="stylesheet">
        <style>
            @page {
                size: landscape;
            }
            * {
                font-size: 11px !important;   
            }
            thead {
                text-align: center;
            }
            #td100 {
                min-width: 100px;
            }
        </style>
    ';
    $table = '<table class="table table-stripped table-bordered">
              <thead style="font-weight:bold;">
                <tr>
                    <td style="min-width:10px !important;">No</td>';

    foreach ($columns as $key => $value) {
        $table .= '<td id="td100">'.$value.'</td>';
    }

    $table .= '</tr>
               </thead>
               <tbody>';

    $no = 1;
    foreach ($data as $dkey => $dvalue) {
        $table .= '<tr>';
        $table .= '<td>'.$no.'</td>';
        foreach ($columns as $key => $value) {
            if (in_array($key, array('tgl_lahir', 'tmt_sk_terakhir')))
                $table .= '<td>'.date(dateFormat(), strtotime($dvalue[$key])).'</td>';
            else if ($key == 'isRetired')
                $table .= '<td>'.($dvalue[$key] == 1 ? 'Retired' : 'Active').'</td>';
            else
                $table .= '<td>'.$dvalue[$key].'</td>';
        }   
        $table .= '</tr>';
        $no++;
    }

    $table .= '</tbody>
               </table>';

    echo $table;
}

function canAccess($menu) {
    $roleID = sessData('roleID');

    ci()->load->model('Role_model');
    $isCanAccess = ci()->Role_model->canAccess($roleID, $menu);

    return $isCanAccess; // TRUE or FALSE
}

function inputDate($date = NULL) {
    // if (!empty($data)) {
        if (strpos('/', $date) !== TRUE) {
            $date = str_replace('/', '-', $date);
        }
    // }

    return in_array($date, array(NULL, '', ' ', '0000-00-00')) ? NULL : date('Y-m-d', strtotime($date));
}