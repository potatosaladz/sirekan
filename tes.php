<?php

function __autoload($class_name) {
    include 'class/class.' . strtolower($class_name) . '.php';
}

//$data = array(
//	'kode_ba' =>'015' ,
//	'kode_es' => '08',
//	'kode_satker' => '635172',
//	'nama_satker' => 'KPPN Mana Saaja',
//);
//$satker = new Satker($data);
//echo $satker;
//$bag=$_GET['data'];
//$db= Database::getInstance();
//$mysql=$db->getConnection($bag);
//if($bag==2) {
//	$query='select * from t_kppn';
//} else {
//	$query='select * from users';
//}
//$result=$mysql->query($query) or trigger_error(mysqli_connect_error());
//$result=$mysql->prepare($query);
//$result->execute();
//if($result==false) {
//	echo 'ra iso';
//}
//$data=$result->fetch_assoc();
//$data=$result->fetch();
//	print_r($data);
//	echo '<br />';
//	echo '<br />';
//	echo '<br />';
//	
//	$kppn=new Kppn();
//	$data=$kppn->getNamaKppn();
//	
//	//print_r($data);
//	
//	echo '<br />';
//	echo '<br />';
//	
//	echo $data->nmkppn;
//        
//        echo date('Y-m-d H:i:s');
//$input = 'bl';
//$data = array('orange', 'blue', 'green', 'red', 'pink', 'brown', 'black');
//        
//$result = array_filter($data, function ($item) use ($input) {
//    if (stripos($item, $input) !== false) {
//        return true;
//    }
//    return false;
//});
//
//var_dump($result);

$adk = new Adk();
$cek=$adk->cekRekonSA('01508', '635162');
if($cek) {
    print_r('Sudah rekon');
} else {
    $content = $adk->getFile('SAKD01508635162.012', 1);
    print_r($content[0]['KDKANWIL']);
}
?>