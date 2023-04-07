<?php
header("Content-Type: text/xmlns");
try{
	$VeritabaniBaglantisi	=	new PDO("mysql:host=localhost;dbname=furkan_test;charset=UTF8", "root", "");
}catch(PDOException $Hata){
	echo $Hata->getMessage();
	die();
}


echo "<?xml version='1.0' encoding='UTF-8'?>
<rss xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xmlns:xsd='http://www.w3.org/2001/XMLSchema' version='2.0'>
	<channel>
		<title>Extra Eğitim</title>
		<description>İleri Seviye Eğitim Setleri</description>
		<link>http://www.extraegitim.com</link>
		<language>tr</language>";

$Sorgu			=	$VeritabaniBaglantisi->prepare("SELECT * FROM users");
$Sorgu->execute();
$SorguSayisi	=	$Sorgu->rowCount();
$SorguKayitlari	=	$Sorgu->fetchAll(PDO::FETCH_ASSOC);

if($SorguSayisi>0){
	foreach($SorguKayitlari as $Satirlar){
		$UrunAdi	=	$Satirlar["id"];
		$UrunFiyati	=	$Satirlar["name"];

		echo "
		<item>
		<title>$UrunAdi</title>
		<price>$UrunFiyati</price>
		</item>";
	}
}

echo "
	</channel>
</rss>";
$VeritabaniBaglantisi	=	null;
?>