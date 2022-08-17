<?php

if(isset($_POST['submit'])){
    $file = $_FILES['download'];
    
    $fileName = $_FILES['download']['name'];
    $fileTmpName = $_FILES['download']['tmp_name'];
    $fileSize = $_FILES['download']['size'];
    $fileError = $_FILES['download']['error'];
    $fileType = $_FILES['download']['type'];

    $fileExt = explode('.',$fileName);
    $ActualExt = strtolower((end($fileExt)));

    $allowed = array('csv','json','xml');

    if(in_array($ActualExt,$allowed)){
        if($fileError === 0){
            if($fileSize<10000){
                $fimeNameNew=$fileName;
                $fileDestination = 'C:/xampp/htdocs/Galanix/uploads/'.$fimeNameNew;
                move_uploaded_file($fileTmpName,$fileDestination);
                header('Location:/Galanix/index.php?uploadsuccess');
            } else {
                echo 'File is too big';
            }
        }else {
            echo 'There was an error uploading file';
        }
    }
    else echo 'You can`t upload files of this type';
}
?>