<?php

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["task3__fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["task3__sbmt-btn"])) {
  $check = getimagesize($_FILES["task3__fileToUpload"]["tmp_name"]);

}
// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";

}
// Check file size
if ($_FILES["task3__fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";

}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["task3__fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["task3__fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";

  }
}