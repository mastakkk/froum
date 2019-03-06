<?
    require_once "../include/db.php";
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