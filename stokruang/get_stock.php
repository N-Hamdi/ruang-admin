<?php 

include "../connect.php";

if (isset($_POST['item_id'])) {
    $stock = $_POST["item_id"];

    $sqlst = "SELECT * FROM tb_ruang WHERE kode_brg=$stock";

    $res = mysqli_query($koneksi, $sqlst);
    while ($row = mysqli_fetch_array($res)) {

        $jml_stok = $row["jml_stok"];
        ?>
        <option value="<?php echo $jml_stok; ?>"><?php echo $jml_stok; ?></option>
<?php
    }

}
?>
