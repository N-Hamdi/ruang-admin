<?php
$connect = new PDO("mysql:host=localhost;dbname=db_inventori", "root", "");
function fill_item($connect)
{ 
 $output = '';
 $query = "SELECT * FROM tb_rstaff
 INNER JOIN tb_brg
 ON tb_rstaff.kode_brg = tb_brg.kode_brg";
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
     $output .= '<option value="'.$row["kode_brg"].'">'.$row["nama_brg"].'</option>';
 }
 return $output;
}



?>
