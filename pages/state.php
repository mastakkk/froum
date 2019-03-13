<?

$title = "State";
require_once "../include/db.php";

$single = getSingle_by_id($_GET["id_single"]);

$category = getCategory_by_name($single->id_category);

views_update($single->id);

if (isset($_GET["comm"])) {
    $comm = $_GET["comm"];
    $delete_comm = R::findOne('comments', "WHERE id = $comm");

    R::trash($delete_comm);
    header("Location: state.php?id_single=$single->id");
}
if (isset($_POST["submit_like_unset"])) {
    header("Location: state.php?id_single=$single->id");
}
if (isset($_POST["submit_like_set"])) {
    header("Location: state.php?id_single=$single->id");
}
if (isset($_POST["create_comment_submit"])) {
    if (empty($errors_comment)) {
        header("Location: state.php?id_single=$single->id");
    }
}

if (isset($_POST["submit_under"])) {
    $errors_under_comment = "";

    if (empty($_POST["text_under"])) {
        $errors_under_comment = "Поле не заполнено";
    }

    if (empty($errors_under_comment)) {
        $under_comm = R::dispense('undercomments');

        $under_comm->id_user = $_SESSION["logged_user"]->id;
        $under_comm->text = $_POST["text_under"];
        $under_comm->id_comment = $_GET["id_comm"];

        R::store($under_comm);

        header("Location: state.php?id_single=".$single->id);
    }

}


require_once "../elements/header.php";?>

<main class="main-explore ">


<?
$you = $_SESSION["logged_user"];

$user = GetUser($single->id_user);
$like = getLike_by_id($single->id, $you->id);



$comments = getComments_all($single->id);

// Лайк лайк опен
if (isset($_POST["submit_like_unset"])) {
    $like_unset = R::findOne('likes', "WHERE id_user_id = $you->id AND id_single = $single->id");

    R::trash($like_unset);
}
if (isset($_POST["submit_like_set"])) {
    $like_set = R::dispense('likes');

    $like_set->id_single = $single->id;
    $like_set->id_user_id = $you->id;

    R::store($like_set);
}

$likes_count = getCount_like($_GET["id_single"]);
// Лайк лайк клоуз

if (isset($_POST["create_comment_submit"])) {
    $errors_comment = "";
    if (empty($_POST["create_comment_text"])) {
        $errors_comment = "Заполните поле текста";
    }
    if (empty($errors_comment)) {
        $new_comment = R::dispense('comments');

        $new_comment->id_user = $_SESSION["logged_user"]->id;
        $new_comment->id_single = $single->id;
        $new_comment->text = $_POST["create_comment_text"];

        R::store($new_comment);
    }
}
?>    

            <article class="menu-explore">
                <div class="menu-explore-title">
                    <a href="explore.php">Explore Forum</a> - <a href="singles.php?id_category=<?=$category->id?>"><?=$category->category_name?></a> - State
                </div>

<?
require_once "../elements/bar.php";
?>
            
           
<!--     main-state      -->
           <article class="state">
               <div class="state-under">
                   <div class="state-user">
                             <div class="img-for-single">
                                <a href="profile.php?id_profile=<?=$user->id?>"><img src="<?=$user->img?>" alt=""></a>
                            </div>
                       <div class="under-state-user">
                           <div class="nickname-state"><a href="profile.php?id_profile=<?=$user->id?>"><?=$user->login?></a></div>
                           <div class="data-state"><?=$single->date?></div>
                       </div>
                       <div>
                           <img src="/img/flag.png" alt="">
                       </div>
                       <div>
                           <img src="/img/three.png" alt="">
                       </div>
                   </div>
                   <div class="title-under-state"><?=$single->title?></div>
                   <div class="comm-view-single">
                       <div class="comm"><?=$single->comments?> comments</div>
                       <div><?=$single->views?> views</div>
                   </div>
                   <div class="text-under-single"><?
                   echo $single->text;
                   ?></div>
               </div>
               <div class="footer-state">
                   <div class="comment-count"><a href="#"><i class="fa fa-comment" aria-hidden="true"></i> Comment</a></div>
                  <div class="likes"><p><?=$likes_count?></p>

                  <form action="" method="post">
                    <?if (isset($like)) {?>
                        <button type="submit" name="submit_like_unset"><i class="fa fa-heart" aria-hidden="true" style="color: red"></i></button>
                    <?} else {?>
                        <button type="submit" name="submit_like_set"><i class="fa fa-heart" aria-hidden="true"></i></button>
                    <?}?>
                  </form>
                  
                </div>
               </div>
           </article>
<!-- main state close   -->
           
<!--     create comment open      -->
           <article class="create-comment">
                    <form action="" method="post">
                       <p>Введите комментарий <?
                       echo $errors_comment;
                       ?></p>
                       <textarea name="create_comment_text" id="" cols="50" rows="4" placeholder="Введи коммент"></textarea>
                        <input type="submit" name="create_comment_submit">
                    </form>
           </article>
<!--      create comment close     -->
           
           
<!--     comment open      -->
            <?foreach ($comments as $comment) {
                $user_comment = getUser($comment->id_user);?>
                <article class="comment">
                    <div class="under-comment">
                        <div class="img-for-single">
                            <a href="profile.php?id_profile=<?=$user_comment->id?>"><img src="<?=$user_comment->img?>" alt=""></a>
                        </div>
                        <div class="author-comment">
                            <p><a href="profile.php?id_profile=<?=$user_comment->id?>"><?=$user_comment->login?></a></p>
                        </div>
                        <div class="date-comment">
                            <?=$comment->date?>
                        </div>
                        <div class="delete_button_comment">
                            <?
                            if ($you->id == $comment->id_user || $_SESSION["logged_user"]->privilege == 3 || $_SESSION["logged_user"]->privilege == 2) {?>
                                <form action="" method="post">
                                    <button type="submit" name="delete_comment"><a href="state.php?id_single=<?=$single->id?>&comm=<?=$comment->id?>">Удалить</a></button>
                                </form>
                            <?}?>

                        </div>
                        <div class="text-comment">
                            <p><?=$comment->text?></p>
                        </div>

                        <div class="get--comment">
                            <p class="text-get--comment"><a href="state.php?id_single=<?=$single->id?>&id_comm=<?=$comment->id?>">Ответить на комментарий</a></p>
                        </div>

                        <?
                        if (isset($_GET["id_comm"]) & $comment->id == $_GET["id_comm"]) {?>
                            <div class="form--comment">
                                <form action="" method="post">
                                    <p>Напишите комментарий</p>
                                    <input type="text" name="text_under" value="<?=$errors_under_comment?>" placeholder="Вводи тут..." class="input--comment">
                                    <input type="submit" name="submit_under"class="submit--comment" style="cursor: pointer;">
                                </form>
                            </div>
                        <?} ?>

                        <!-- Under comment -->
                        <?
                        $under_comms = getUnder_comm($comment->id);
                        foreach ($under_comms as $under_comm) {
                            $user_under_comment = getUser($under_comm->id_user);
                            ?>
                            <div class="under--comment">
                                <div class="grid-under--comment">
                                    <div></div>
                                    <div class="main--border"></div>
                                    <div></div>
                                    <div style="border-left: 1px solid #000; margin-top: -25px; z-index: 1;"></div>
                                </div>
                                <div class="content--comment">
                                    <div class="img-for-single img--comment">
                                        <a href="profile.php?id_profile=<?=$user_under_comment->id?>"><img src="<?=$user_under_comment->img?>" alt=""></a>
                                    </div>
                                    <p><a href="profile.php?id_profile=<?=$user_under_comment->id?>"><?=$user_under_comment->login?></a></p>
                                    <div class="text--comment">
                                        <p><?=$under_comm->text?></p>
                                    </div>
                                </div>
                            </div>
                        <?} ?>
                        <!-- Under comment close-->
                    </div>
                </article>
            <?}?>
<!--     comment close      -->
       </main>

<?
require_once "../elements/footer.php";
?>
       
    