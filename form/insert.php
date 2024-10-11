<?php

session_start();

if (!isset($_SESSION['nama'])) {
    header("Location:../index.php");
}

if (isset($_POST["item_name"])) {

	include('get_item.php');

	for ($count = 0; $count < count($_POST["item_name"]); $count++) {

		$inputdate = date('Y-m-d', strtotime(str_replace("/", "-", $_POST['input_date'][$count])));
		$temporary = "INSERT INTO tb_temporary (tanggal, kode_brg, stok) VALUES (:inputdate, :item_name, :item_quantity)
		ON DUPLICATE KEY UPDATE stok = stok + :item_quantity";

		$intmp = $connect->prepare($temporary);

		$intmp->execute(
			array(
				':inputdate'	=>	$inputdate,
				':item_name'	=>	$_POST["item_name"][$count],
				':item_quantity' =>	$_POST["item_qty"][$count]
			)
		);

		$tmpres = $intmp->fetchAll();

		$compare = $connect->prepare("SELECT * FROM tb_rstaff INNER JOIN tb_temporary
		on tb_rstaff.kode_brg = tb_temporary.kode_brg
		where tb_rstaff.stok > tb_temporary.stok");
		$compare->execute();

		$tem = $connect->prepare("SELECT * FROM tb_temporary");
		$tem->execute();

		$temprow = $tem->rowCount();
		$comprow = $compare->rowCount();

		if ($comprow < $temprow) {
			$delete = $connect->prepare("DELETE FROM tb_temporary");
			$delete->execute();
			echo "<script>alert('Ada kesalahan pada stok');window.location='form_pemakaian'</script>";
		} else {

			$update = $connect->prepare("UPDATE tb_rstaff 
			INNER JOIN tb_temporary 
			SET tb_rstaff.stok = tb_rstaff.stok - tb_temporary.stok
			, tb_rstaff.tanggal = tb_temporary.tanggal 
			WHERE tb_rstaff.kode_brg = tb_temporary.kode_brg");
			$update->execute();

			$inputdate = date('Y-m-d', strtotime(str_replace("/", "-", $_POST['input_date'][$count])));
			$query = "INSERT INTO tb_pemakaian (kode_form, subjek, tanggal, kode_brg, jumlah, keterangan) 
        VALUES (:form_code, :form_subject, :inputdate, :item_name, :item_quantity, :item_remarks)";

			$statement = $connect->prepare($query);

			$statement->execute(
				array(
					':form_code'	=>	$_POST["form_id"][$count],
					':form_subject'	=>	$_POST["form_subject"][$count],
					':inputdate'	=>	$inputdate,
					':item_name'	=>	$_POST["item_name"][$count],
					':item_quantity' =>	$_POST["item_qty"][$count],
					':item_remarks'	=>	$_POST["item_remarks"][$count]
				)
			);
		}
	}

	$result = $statement->fetchAll();

	if (isset($result)) {
		echo 'ok';
		$delete = $connect->prepare("DELETE FROM tb_temporary");
		$delete->execute();
	}
}
