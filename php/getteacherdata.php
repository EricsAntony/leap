<?php
include "config.php";
$query = "select * from teacher order by t_id desc";
$result = mysqli_query($con, $query);
$output = '<table
 class="table table-bordered table-striped table-hover js-basic-example dataTable" id="dataTables">
 <thead>

     <tr>
    
         <th>Appoint as HOD</th>
         <th>Name</th>
         <th>Email</th>
         <th>Mobile</th>
         <th>Action</th>
     </tr>
 </thead>
 <tfoot>

     <tbody>';
if (mysqli_num_rows($result) > 0) {

     $i = 1;
     while ($row = mysqli_fetch_array($result)) {

          $b = '<button type="button"  
        data-id1="' . $row["t_id"] . '"
        data-id2="' . $row["t_name"] . '"
        data-id3="' . $row["t_email"] . '"
        data-id4="' . $row["t_phn"] . '"
        
      
        class="btn btn-xs btn-info btn_update"  data-toggle="modal" data-target="#defaultModal"><i
        class="zmdi zmdi-edit"></i></button>';
          $c = '<button type="button"  
        data-id1="' . $row["t_id"] . '"
        class="btn btn-xs btn-info btn_update"  data-toggle="modal" id="delbtn" data-target="#delstudentmodel"><i
        class="zmdi zmdi-delete"></i></button>';

        $d = '<a href="#"  
        data-tid="' . $row["t_id"] . '"
        class=""  data-toggle="modal" id="adbtn" data-target="#changeadminModal"><i
        class="zmdi ti-check-box"></i></a>';


          $output .= '  
                <tr>  
                     <td>' . $d . '</td>  
                     <td>' . $row["t_name"] . '</td> 
                     <td>' . $row["t_email"] . '</td>  
                     <td>' . $row["t_phn"] . '</td>  
                     <td>' . $b . $c . '</td>   
                </tr>  
           ';
     }

} else {
     $output .= '<tr>  
                          <td colspan="8">Data not Found</td>  
                     </tr>';
}
$output .= '</table>  
      </div>
      <script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
      <script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
      <script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
      <script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
      <script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
      <script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>
      <script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
      <script src="assets/js/pages/tables/jquery-datatable.js"></script>';
echo $output;
?>