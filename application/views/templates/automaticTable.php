<div id="tableContainer">
  <table id="automaticTable" class="table display select">
    <thead>
      <tr>
        <th scope="col"><input name="select_all" value="1" type="checkbox"></th>
        <th scope="col">#</th>
        <?php
          foreach ($columns as $key => $value) {
            echo '<th scope="col">'.$value.'</th>';
          }
        ?>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

</div>