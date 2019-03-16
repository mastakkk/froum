<?

$title = "Reduct State";

require_once "../include/db.php";

$single = getSingle_by_id($_GET["id_state"]);

if (isset($_POST["submit"])) {
    $errors_reduct = "";

    if (empty($_POST["reduct_title"])) {
        $errors_reduct = "Заполните поле Названия статьи";
    }

    if (empty($_POST["reduct_text"])) {
        $errors_reduct = "Заполните поле Текст статьи";
    }



    if (isset($_FILES['reduct_img'])) {
        $file_name = $_FILES['reduct_img']['name'];
        $file_size = $_FILES['reduct_img']['size'];
        $file_tmp = $_FILES['reduct_img']['tmp_name'];
        $file_ext = strtolower(end(explode('.',$_FILES['reduct_img']->name)));
    
        $expensions = array("jpeg","jpg","png");
        $errors_img = "";
        
        
        if ($file_size > 2097152) {
            $errors_img = "Картинка не должна превышать 2 мб";
        }
        if (empty($errors_img)) {
            move_uploaded_file($file_tmp,"../img/".$file_name);
        }
    }


    if (empty($errors_reduct)) {
        $reduct_state = R::dispense('singles');

        $reduct_state->id = $single->id;
        $reduct_state->title = $_POST["reduct_title"];
        $reduct_state->id_category = $_POST["reduct_list"];
        $reduct_state->text = $_POST["reduct_text"];
        if (isset($_FILES['reduct_img'])) {
            if ($errors_img == "") {
                $reduct_state->img_preview = "/img/".$_FILES['reduct_img']['name'];
            }
        } else {
            $reduct_state->img_preview = $single->img_preview;
        }

        R::store($reduct_state);
        // header("Location: state.php?id_single=".$single->id);
    }
}

require_once "../elements/header.php";
?>

<article class="main-reduct">
    <h4>Редактирование статьи под номером: <?=$single->id?></h4>
    <form action=""  method="POST" enctype="multipart/form-data">
        <div class="img-reduct">
            <input type="file" name="reduct_img">
            <img src="<?=$single->img_preview?>" alt="">
        </div>

        <p>Название статьи</p>
        <input type="text" value="<?=$single->title?>" class="text-reduct" name="reduct_title">

        <p>Выберите категорию</p>
        <select name="reduct_list">
            <?  $category_all = R::findAll('categories');
                $count_categories = R::count('categories');
                for ($i=1; $i <= $count_categories; $i++) {?>
                    <option value="<?=$i?>" <?   if ($category_all[$i]->id == $single->id_category) {?>selected<?}?>><?=$category_all[$i]->category_name?></option>
                <?}
            ?>

        </select>

        <div>
            <p>Текст статьи: </p>
            <textarea type="text" name="reduct_text" cols="57" rows="5"><?=$single->text?></textarea>
        </div>

        <pre><input type="submit" name="submit" class="submit-reduct"></pre>
    </form>
</article>

<?
require_once "../elements/footer.php";
?>