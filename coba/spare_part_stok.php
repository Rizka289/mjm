<?php
include("config.php");


/*

// masukin stok
$sql = "select * from spare_part";
$query = $db->get_results($sql);
foreach ($query as $row)
{
	
    $str = "insert into spare_part_stok (id_nama_spare_part, id_spare_part, stok) values ('$row->id_nama_spare_part','$row->id_spare_part','$row->jumlah')";
    $db->query($str);
    echo "$str<br>";
}

exit;

$sql = "select * from xxx";
$query = $db->get_results($sql);
foreach ($query as $row)
{
	$sql = "select * from spare_part_stok where id_nama_spare_part = $row->id_nama_spare_part limit 1"; //and stok > 0 limit 1";
	$q = $db->get_results($sql);
	//echo var_dump($q[0]->id_nama_spare_part); echo "<br>";
	if ($q)
	{
		$id_spare_part = $q[0]->id_spare_part;
		//echo " ada stok - $id_spare_part<br>";

	}
	else
	{
		echo "tidak ada stok<br>";
	}
	
	
	
    $str = "insert into penggunaan_spare_part_detail (id_penggunaan_spare_part, id_spare_part, jumlah_penggunaan) 
	values ('$row->id_penggunaan_spare_part','$id_spare_part','$row->jumlah_penggunaan')";
    $db->query($str);
    echo "$str<br>";
}



exit;
*/





// kurangi pemakaian
$sql = "select * 
		from penggunaan_spare_part order by id_penggunaan_spare_part limit 300
		";
$query = $db->get_results($sql);

$i=0;
foreach ($query as $row)
{
	$i++;
	echo $i." ----------------<br> ";
	
	$sql = "select penggunaan_spare_part_detail.*, spare_part.id_nama_spare_part from penggunaan_spare_part_detail 
	left join spare_part on penggunaan_spare_part_detail.id_spare_part = penggunaan_spare_part_detail.id_spare_part
	where id_penggunaan_spare_part = $row->id_penggunaan_spare_part";
	$r = $db->get_results($sql);
	echo var_dump($r); echo "<br><br><Br>"; exit;
	foreach ($r as $d)
	{
		$sql = "select * from spare_part_stok where id_nama_spare_part = $d->id_nama_spare_part and stok >= $d->jumlah_penggunaan limit 1";
		$q = $db->get_results($sql);
		if ($q)
		{
			$id_spare_part = $q[0]->id_spare_part;
			echo "- $id_spare_part<br>";
		}
		else
		{
			echo "- no stok<br>";
		}
		
		$str = "update spare_part_stok set stok = stok - $d->jumlah_penggunaan where id_spare_part_stok = $q[0]->id_spare_part_stok";
		//$db->query($str);
		echo "$str<br>";
		$str = "update penggunaan_spare_part_detail set id_spare_part = $id_spare_part where id_penggunaan_spare_part_detail = $d->id_penggunaan_spare_part_detail";
		//$db->query($str);
		echo "$str<br>";
		
	}
	
}
