<?php 

if (isset($_POST['upload'])) {
    $name= $_FILES['file']['name'];

    $tmp_name= $_FILES['file']['tmp_name'];

    $position= strpos($name, ".");

    $fileextension= substr($name, $position + 1);

    $fileextension= strtolower($fileextension);

<<<<<<< HEAD
    $path='uploads/images/';
=======
    $path= 'uploads/images/';
>>>>>>> d8ce289c2d85226f424c628cf2803fa0a870b6fc
    if (empty($name)){
        echo "Please choose a file";
    } else if (!empty($name)){
        if (($fileextension !== "jpg") && ($fileextension !== "jpeg") && ($fileextension !== "png") && ($fileextension !== "bmp") && ($fileextension !== "gif")){
            echo "The file extension must be .jpg, .jpeg, .png, .gif or .bmp in order to be uploaded";
        } else if (($fileextension == "jpg") || ($fileextension == "jpeg") || ($fileextension == "png") || ($fileextension == "bmp") || ($fileextension == "gif")){
            if (move_uploaded_file($tmp_name, $path.$name)) {
                echo 'Uploaded!';
            }
        }
    }
}
?>