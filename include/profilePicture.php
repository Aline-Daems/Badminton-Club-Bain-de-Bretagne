<?php 

if (isset($_POST['upload'])) {
    $name= $_FILES['file']['name'];

    $tmp_name= $_FILES['file']['tmp_name'];

    $position= strpos($name, ".");

    $fileextension= substr($name, $position + 1);

    $fileextension= strtolower($fileextension);

    $path='uploads/images/';
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