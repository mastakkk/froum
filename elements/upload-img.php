<?
if (isset($_FILES['image'])) {
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_ext = strtolower(end(explode('.',$_FILES['image']->name)));

    $expensions = array("jpeg","jpg","png");
    $errors_img = "";
    
    
    if ($file_size > 2097152) {
        $errors_img = "Картинка не должна превышать 2 мб";
    }
    if (empty($errors_img)) {
        move_uploaded_file($file_tmp,"../img/".$file_name);
    }
}
?>