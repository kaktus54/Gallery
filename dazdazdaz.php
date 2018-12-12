<?php

if(!empty($_FILES)){
    require("imgClass.php");
    $img = $_FILES['img'];
    $ext = strtolower(substr($img['name'],-3));
    $allow_ext = array("jpg","png","gif");
    if(in_array($ext,$allow_ext)){
    copy($img['tmp_name'], "images/norm/".$img['name']);

    move_uploaded_file($img['tmp_name'],"images/".$img['name']);
    Img::creerMin("images/".$img['name'],"images/min",$img['name'],215,112);
    }
    else{
        $erreur = "votre fichier n'est pas une image";

    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" types="text/css" href="theme/styles.css" /> 
    <meta charset='UTF-8'>
    <title>A TITLE</title>
</head>
<body>
    <div class="wrapper">
    <?php
    if(isset($erreur)){
        echo $erreur;
    }
    ?>
        <form method="post" action="index.php" enctype="multipart/form-data">
        <input type="file" name="img"/>
        <input type="submit" name="envoyer">
    <?php
    $dos = "images/min";
    $dir = opendir($dos);
    while($file= readdir($dir)){
        $allow_ext = array("jpg","png","gif");
        $ext = strtolower(substr($file,-3));
        if(in_array($ext,$allow_ext)){
        ?>
        <div class="min">
        <a href="images/norm/<?php echo $file; ?>">
        <img src="images/min/<?php echo $file; ?>">
        <h3><?php echo $file; ?><h3>
        </a>
        </div>
        <?php
        }
    }
    ?>
    </div>
</body>
</html>