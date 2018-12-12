<?php
class Img{
	static function creerMin($img, $chemin, $nom, $mlargeur=100, $mhauteur=100){
	
	$dimension=getimagesize($img);

	if(substr(strtolower($img),-4)==".jpg"){$image = imagecreatefromjpeg($img); }
	else if(substr(strtolower($img),-4)==".png"){$image = imagecreatefrompng($img); }
	else if(substr(strtolower($img),-4)==".gif"){$image = imagecreatefromgif($img); }
	else{return false; }
	
	$miniature =imagecreatetruecolor ($mlargeur, $mhauteur);

	if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur;
$dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0;}
	if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1] ){ $dimX=$mlargeur;
$dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0;}
	if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; 
$decalX=0; $decalY=0;}

	imagecopyresampled($miniature, $image, $decalX, $decalY, 0, 0, $dimX, $dimY, $dimension[0], $dimension[1]);
	unlink($img);
	
	imagejpeg($miniature, $chemin."/".$nom, 90);
return true;
}
}

?>