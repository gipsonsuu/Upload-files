<?php
if (isset($_POST['Submit'])) {
    $file = $_FILES['file'];
    
    $fileName = $_FILES['file']['name'];
    $fileTmPName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['Size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg', 'jpeg', 'png', 'pdf');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
           if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$
                fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                move_uploaded_file($fileTmPName,$
                fileDestination);
                header("Location: index.php?uploadsuccess");
           } else {
            echo "Your file is too big!";
           }
        } else {
            "There was an error uploading your files!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}