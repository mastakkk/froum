<?
    require_once "../include/db.php";

    if (isset($_POST["submit_create"])) {
        $errors_create = "";

        if (empty($_POST["text_create"])) {
            $errors_create = "Введите текст статьи";
        }

        if (empty($_POST["list"])) {
            $errors_create = "Выберите категорию";
        }

        if (empty($_POST["title"])) {
            $errors_create = "Введите название";
        }

        require "../elements/upload-img.php";

        if (empty($errors_create)) {
            $create_state = R::dispense('singles');

            $create_state->title = $_POST["title"];
            $create_state->text = html_entity_decode($_POST["text_create"]);
            $create_state->id_category = $_POST["list"];
            $create_state->id_user = $_SESSION["logged_user"]->id;
            if (isset($_FILES['image'])) {
                $create_state->img_preview = "/img/".$_FILES['image']['name'];
            }

            R::store($create_state);
            header("Location: singles.php?id_category=".$_POST["list"]);
        }
    }

    require_once "../elements/header.php";


?>
        <article class="create-new-post">
            <div class="center-create">
                <h1>Создать новый пост</h1>
                <form action="" method="POST" enctype="multipart/form-data">
                    <textarea type="text" name="title" placeholder="Название статьи" cols="35" rows="1" maxlength="121"></textarea>

                    <div class="img-form img-settings">
                            <input type="file" name="image">
                            <img src="/img/1.png" alt="">
                    </div>
                    <div class="under-from"><br>
                        <h6>Выберите категорию</h6>
                        <select name="list">
                            <option value="1">Cinema</option>
                            <option value="2">Game</option>
                            <option value="3">Fight</option>
                            <option value="4">Comics</option>
                            <option value="5">IT</option>
                            <option value="6">Musics</option>
                        </select>
                    </div>

                    <div class="text-create">
                        <textarea type="text" name="text_create" placeholder="Введи текст статьи" cols="57" rows="5"></textarea>
                    </div>

                    <input type="submit" name="submit_create">
                    <?=$errors_create?>
                </form>
            </div>
        </article>
<?
    require_once "../elements/footer.php";
?>