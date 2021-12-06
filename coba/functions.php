<?php

set_time_limit(0);

$LICENSE_PATH = "";



function errmsg($msg, $color) {

	echo "<span style=\"color: ".$color."; background-color: #cccccc; padding: 1px\">".$msg."</span>";

}



function gotoLocation($url) {

	echo "<script language=\"Javascript\">\r\n";

	echo "window.location = \"$url\";\r\n";

	echo "</script>\r\n";

}

function gotoloc($url) {

	echo "<script language=\"Javascript\">\r\n";

	echo "window.location = \"$url\";\r\n";

	echo "</script>\r\n";

}

function sql2date($mysqlStr)      // 01-12-2007

{

    $s = explode("-",$mysqlStr);

    return "$s[2]-$s[1]-$s[0]";

}

function convert2mktime($tanggal, $jam)
{
	$tanggal = trim($tanggal);
	$jam = trim($jam);
	
	$explodeTanggal = explode("-", $tanggal);
	$explodeJam = explode(":", $jam);
	
	$str = mktime($explodeJam[0], $explodeJam[1], 1, $explodeTanggal[1],  $explodeTanggal[2],  $explodeTanggal[0]);
	return $str;	
}

function date2sql($mysqlStr)      // 01/12/2007

{

    $s = explode("/",$mysqlStr);

    return "$s[2]-$s[1]-$s[0]";

}

function getFromTable($sql)

{

    global $db;

    $r1 = $db->get_row($sql, ARRAY_N) or die($sql);

    if($r1) {
		//echo var_dump($r1); exit;
        $ret = $r1[0];

    } else {

        $ret = NULL;

    }

    mysqli_free_result($r1);

    return $ret;

}

function title($text, $size=14, $align="left") {

	echo "<span style=\"font-size: ".$size."px; font-weight: bold; text-align: $align\">$text</span>";

}
 

function validation(){



	if (empty($_SESSION[login_username])) {

		gotoLocation("../../logout.php");

		exit;

	}

}

function getUserRole($user_id)
{
	global $conn;
	
	$role_id = getFromTable("select ROLE_ID from wds_user_role where USERNAME = '$user_id'");
	$role_name = getFromTable("select ROLE_NAME from wds_system_role where ID = $role_id");
	return $role_name;
}



function getCount($x, $arr)
{
	$j=0;
	for ($i=0; $i<count($arr); $i++)
	{
		if ($arr[$i] == $x)
		{
			$j++;
		}
	}
	
	return $j;
}

function Terbilang($x)
{
  $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "belas";
  elseif ($x < 100)
    return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
  elseif ($x < 200)
    return " seratus" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " seribu" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
}

function arrayTahun()
{
	$tahun_now = date("Y");
	$tahun = array();
	for ($i=2010; $i<=$tahun_now; $i++)
	{
		$tahun[$i] = $i; 
	}
	
	return $tahun;
}

function getBulan($i)
{
	$bulan = array(
	1=>"Januari"
	,2=>"Februari"
	,3=>"Maret"
	,4=>"April"
	,5=>"Mei"
	,6=>"Juni"
	,7=>"Juli"
	,8=>"Agustus"
	,9=>"September"
	,10=>"Oktober"
	,11=>"November"
	,12=>"Desember"
	);
	
	return $bulan[$i];
}

function dateCount($date1, $date2)
{
	$tgl1 = strtotime($date1);
	$tgl2 = strtotime($date2);
	$datediff = $tgl2 - $tgl1;

	return floor($datediff / (60 * 60 * 24)) +1;
}

function insertSQL($dbTable, $dataTable)

{
	global $db;
	$sql = "insert into $dbTable (";

	$count = 0; $tails = "";

	foreach ($dataTable as $key => $value)

	{

		$sql .= $key;

		$tails .= "'".$value."'";

		if ($count < count($dataTable)-1)

		{

			$sql .= ",";

			$tails .= ",";

		}

		$count++;

	}

	$sql .= ") values (";

	$sql .= $tails;

	$sql .= ")";

	

	$db->query($sql);	

}

function updateSQL($dbTable, $dataTable, $condition)

{
	global $db;

	$sql = "update $dbTable set ";

	$count = 0; $tails = "";

	foreach ($dataTable as $key => $value)

	{

		$sql .= $key."='".$value."'";

		if ($count < count($dataTable)-1)

		{

			$sql .= ",";

		}

		$count++;

	}

	$sql .= " where ".$condition;

	 

	$db->query($sql);	

}



function deleteSQL($dbTable, $condition)

{
	global $db;
	
	$sql = "delete from $dbTable where $condition";

	$db->query($sql);

}

date_default_timezone_set('Asia/Jakarta');





?>



		
