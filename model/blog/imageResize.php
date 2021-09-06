<?php
    function imageResize($image, $height){

    $fileName = $image['name'];
    $tmpLocation = $image['tmp_name'];

    $time = time();
    $newFile = "../../assets/images/blogImages/"."small".$time.$fileName;
    $newFileForDatabase = "assets/images/blogImages/"."small".$time.$fileName;

    $newHeight = $height;

    list($width, $height) = getImageSize($tmpLocation);

    $newWidth = $width * $newHeight / $height;

    $platno = imagecreatetruecolor($newWidth, $newHeight);
    $for = imagecreatefromjpeg($tmpLocation);

    imagecopyresized($platno, $for, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    imagejpeg($platno, $newFile);
    imagedestroy($platno);

    return $newFileForDatabase;
    }
?>