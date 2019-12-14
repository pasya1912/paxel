<?php
include('config.php');
echo "
__________                      .__   
\______   \_____  ___  ___ ____ |  |  
 |     ___/\__  \ \  \/  // __ \|  |  
 |    |     / __ \_>    <\  ___/|  |__
 |____|    (____  /__/\_ \\___  >____/
                \/      \/    \/      
Bot Reff		";
sleep(1);
echo "\n\r";
echo "Jangan Lupa masukkan ref di reff.txt";
sleep(1);
echo "\r\nNomor : ";	
$no = trim(fgets(STDIN));
$ref = file_get_contents('reff.txt');
$data = '{"phone":"'.$no.'","referral_code":""}';
$send = curl("https://api.paxel.co/apg/api/v1/me/phone-token?on=register",$data);
$load = json_decode($send, TRUE);
if($load['code'] == 200){
	echo "\r\nOTP Code :";
	$otp = trim(fgets(STDIN));
	sleep(1);
	$dataa = '{"phone":"'.$no.'","token":"'.$otp.'"}';
	$sendd = curl("https://api.paxel.co/apg/api/v1/me/phone-token/validate",$dataa);
	$sendd = json_decode($sendd, TRUE);
	if($sendd['code'] == 200){
		$nem = nama();
		$nama = explode(" ", $nem); 
		$datta = '{"social_media_id":"","social_media_type":"","first_name":"'.$nama[0].'","last_name":"'.$nama[1].'","refer_by":"'.$ref.'","phone":"'.$no.'","token":"'.$otp.'","username":"'.$nama[0].$mt_rand(0, 10).'","password":"sgb'.$mt_rand(0, 14).'","email":"","referrer_source":"","campaign":""}';
		$doit = curl("https://api.paxel.co/apg/api/v1/register", $datta);
	if($doit['code'] == 200){
		echo "Refferal Success !";
	}
	else{
		die('Reff Gagal!');
	}
	}
	else{
		die('OTP salah');
	}
	
}
elseif($load['code'] == 405){
	die('Nomor Telah Terdaftar');
}
else{
	die('Kirim OTP gagal');
}
?>
