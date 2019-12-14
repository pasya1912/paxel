<?php

include('config.php');
function login($nam, $passs){
$data = '{"username":"'.$nam.'","password":"'.$passs.'"}';
$send = curl("https://api.paxel.co/apg/api/v1/login",$data);
$gat = json_decode($send, TRUE);
if($gat['code'] == 200){
return $gat['data']['api_token'];
}
else
die("\r\nLogin gagal");
}
function topup($metod, $harga, $token){
$data = '{"amount":'.$harga.',"bank_name":"'.$metod.'"}';
$send = curls("https://api.paxel.co/apg/api/v1/payment/midtrans/charge",$data, $token);
$gat = json_decode($send, TRUE);
if($gat['code'] == 200){
return $gat['data']['va_number'];
}
else{
print_r($gat);
}
}
echo "
__________                      .__   
\______   \_____  ___  ___ ____ |  |  
 |     ___/\__  \ \  \/  // __ \|  |  
 |    |     / __ \_>    <\  ___/|  |__
 |____|    (____  /__/\_ \\___  >____/
                \/      \/    \/      
Bypass Minimum Topup Paxel		";
sleep(1);
echo "\n\r";
echo "Nomor|password ( Contoh : 0981821|pass ) :";	

$nope = explode('|', trim(fgets(STDIN)));
$nam = $nope[0];
$passs = $nope[1];
sleep(1);
sleep('0.5');
echo "Jumlah Topup *recom 1000 : ";
$harga = trim(fgets(STDIN));
echo "Pembayaran
1. BNI ( OVO )
2. Mandiri
3. BCA
Pilihan : ";
$metod = trim(fgets(STDIN));

$token = login($nam, $passs);
if($metod == "1"){
	$tambah = topup("bni", $harga, $token);
echo "ATM BNI no Akun : ". $tambah." Sejumlah ".$harga;
}
elseif($metod == "2"){
	$tambah = topup("mandiri", $harga, $token);
echo "ATM Mandiri no Akun : ". $tambah." Sejumlah ".$harga;
}
elseif($metod == "3"){
	$tambah = topup("bca", $harga, $token);
echo "ATM BCA no Akun : ". $tambah." Sejumlah ".$harga;
}



?>
