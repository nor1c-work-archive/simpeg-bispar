<?php



defined('BASEPATH') OR exit('No direct script access allowed');

// list of ambiguoses column
function aliasesColumns() {
	return ci()->Master_model->aliasesColumns();
}

// initialize column aliasing
function initColumnAliasing($method, $column) {
	$aliasesColumns = aliasesColumns();
	if (key_exists($method, $aliasesColumns)) { // check if method has ambiguos columns
		if (in_array($column, array_keys($aliasesColumns[$method]))) { // if column inside ambiguos column list
			return $aliasesColumns[$method][$column].".$column"; // set the column to : "table.column"
		} else {
			return NULL;
		}
	}
}

// avoid column ambiguos
function avoidColumnAmbiguos($method, $column) {
	if (initColumnAliasing($method, $column) != NULL) {
		return TRUE;
	}
}

function columnAliasing($method, $column) {
	return initColumnAliasing($method, $column);
}

function whereMode($column, $value, $mode = 'contain') {
	// avoid if the column inside more than one table
	if (avoidColumnAmbiguos(currentMethod(), $column)) {
		$column = columnAliasing(currentMethod(), $column);
	}
    switch ($mode) {
        case 'equal':
                return dbWhere($column, $value);
			break;
		case 'containBefore':
				return DBS()->like($column, $value, 'before');
			break;
		case 'containAfter':
				return DBS()->like($column, $value, 'after');
			break;
		case 'notContain':
				return DBS()->not_like($column, $value);
			break;
        default:
                return DBS()->like($column, $value);
            break;
    }
}

function orderIt($column, $orderDirection = 'ASC') {
    return DBS()->order_by($column, $orderDirection);
}

function groupIt($column) {
    return DBS()->group_by($column);
}

function getLimit($params) {
	$params['page']     = setPage($params);
	$params['limit']	= setLimit($params);
	
	if(isset($params['limit']))
		return DBS()->limit($params['limit'], ($params['page']-1)*$params['limit']);
}

// set current page if there's no page parameter
function setPage($params) {
    if(!isset($params['page']))
		return 1;
	return $params['page'];
}

function setLimit($params) {
	if (!isset($params['limit']))
		return 10;
	return $params['limit'];
}

function dbSelect($table, $columns, $proctedColumns = FALSE) {
	if(is_array($columns)) {
		$selectedColumns = array();
		foreach ($columns as $key => $column) {
			if (!is_int($key))
				$selectedColumns[] = "$table.$key as $column";
			else
				$selectedColumns[] = "$table.$column as $column";
		}
		$selectedColumns = implode(',', $selectedColumns);
	} else {
		$selectedColumns = "$table.$columns";
	}
	return DBS()->select($selectedColumns);
}

function isntWhereParamsType() {
    return array('limit', 'page', 'order', 'group', 'unprotect', 'byActiveUser');
}

function getWhere($params, $mode = null) {
    $isntWhereParamsType = isntWhereParamsType();
    foreach ($params as $paramType => $paramValue) {
        if(!in_array($paramType, $isntWhereParamsType)) {
            if(isset($params[$paramType])) {
                if(strpos($paramValue, '$') !== false) {
                    $mode = explode('$', $paramValue);
                    whereMode($paramType, $mode[0], $mode[1]);
                } else {
                    whereMode($paramType, $paramValue);
                }
            }
        }
    }
}

function getOrders($params) {
    if(isset($params['order'])) {
        foreach ($params as $paramType => $paramValue) {
            if($paramType == 'order') {
                if(isset($params[$paramType])) {
                    if(strpos($paramValue, '|') !== false) {
                        $allOrders = explode('|', $paramValue);
                        foreach ($allOrders as $partialKey => $partialOrder) {
                            if(strpos($partialOrder, '$') !== false) {
                                $orders = explode('$', $partialOrder);
                                orderIt($orders[0], strtoupper($orders[1]));
                            } else {
                                orderIt($partialOrder);
                            }
                        }
                    } else {
                        if(strpos($paramValue, '$') !== false) {
                            $orders = explode('$', $paramValue);
                            orderIt($orders[0], strtoupper($orders[1]));
                        } else {
                            orderIt($paramValue);
                        }
                    }
                }
            }
        }
    }
}

function getGroups($params) {
    if(isset($params['group'])) {
        foreach ($params as $paramType => $paramValue) {
            if($paramType == 'group') {
                if(isset($params[$paramType])) {
                    groupIt(str_replace('|', ',', $paramValue));
                }
            }
        }
    }
}

function countAllResult() {
	return DBS()->count_all_results('', FALSE);
}

function generateData($params, $protectedColumns = NULL, $arrayMode = 'object') { // parameters, protected columns, array mode,
	getWhere($params);
    getOrders($params);
    getGroups($params);
	DBS()->stop_cache();
	
	// Count all result before limited
	$resultArr			= array();
	$resultArr['total']	= countAllResult();
	
	getLimit($params);
	$qResult = DBS()->get();
	switch ($arrayMode) {
		case 'array':
				$result = $qResult->result_array();
			break;
		
		case 'object':
				$result = $qResult->result();
			break;
		default:
				$result = $qResult->result();
			break;
	}
    $resultArr['data']['data']             = $result;
	$resultArr['data']['protectedColumns'] = $protectedColumns;
	
	return $resultArr;
}

function dbWhere($key, $value) {
	return DBS()->where($key, $value);
}

function pkExist($PK, $column, $table) {
	return ci()->Master_model->checkPKAvailibility($PK, $column, $table);
}

function generateTransResult($isInsert = FALSE) {
	$insert_id = DBS()->insert_id();
	DBS()->trans_complete();
	
	if (DBS()->trans_status() === FALSE) {
        DBS()->trans_rollback();
        return FALSE;
    } else {
        DBS()->trans_commit();
		return $isInsert ? $insert_id : TRUE;
	}
}

function transStart() {
	return DBS()->trans_start();
}

function dbInsert($table, $data) {
	return DBS()->insert($table, $data);
}

function dbUpdate($table, $data) {
	return DBS()->update($table, $data);
}

function dbDelete() {
	return DBS()->delete();
}

function dbCountNotZero() {
	return DBS()->get()->num_rows() > 0 ? TRUE : FALSE;
}