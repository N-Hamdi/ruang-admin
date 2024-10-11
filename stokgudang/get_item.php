<?php
include_once "../connect.php";
if (isset($_POST['category_id'])) {
    $cat = $_POST["category_id"];

    $sql = "SELECT * FROM tb_brg WHERE kategori='$cat'";

    $hasil = mysqli_query($koneksi, $sql);
    while ($data = mysqli_fetch_array($hasil)) {
?>
        <option value="<?php echo $data["kode_brg"]; ?> "><?php echo $data["nama_brg"]; ?></option>
<?php

    }
}

?>