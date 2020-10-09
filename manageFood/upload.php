
<?php
//upload.php
if ($_FILES["file"]["name"] != '') {
    $test = explode('.', $_FILES["file"]["name"]);
    $ext = end($test);
    $imageName = "img_" . uniqid() . '.' . $ext;
    $location = '../src/img/food/' . $imageName;
    move_uploaded_file($_FILES["file"]["tmp_name"], $location);
    echo '<img src="' . $location . '" height="150" width="225" class="img-thumbnail" />';
    echo '<input type="hidden" id="imageName" name="imageName" value="' . $imageName . '" />';
}
?>
