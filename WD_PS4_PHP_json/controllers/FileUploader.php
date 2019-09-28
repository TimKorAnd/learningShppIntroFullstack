<?php
class FileUploader {
  private $targetDir;
  private $targetFile;

  /**
   * UploadFile constructor.
   * @param string $targetDir
   */
  public function __construct( string $targetDir = "uploads/" )
  {
    $this->targetDir = $targetDir;
    $this->targetFile = $this->targetDir . basename($_FILES["task3__fileToUpload"]["name"]);
  }

  public function fileUpload() //TODO if-cases complete
  {
    if (file_exists($this->targetFile)) {
      echo "Rewrite already exists file .";
      /*print <<<CONFIRM
<script>
if (window.confirm("Do you really want to overwrite file?")) {
}
</script>
CONFIRM;*/ //TODO how correct use dialog window and user answer?
    }

    if (move_uploaded_file($_FILES["task3__fileToUpload"]["tmp_name"], $this->targetFile)) {
      echo "The file " . basename($_FILES["task3__fileToUpload"]["name"]) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";

    }
  }
}