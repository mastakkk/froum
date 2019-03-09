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

                <div class="search">
                    <div class="container">
                        <input type="text"placeholder="Search..">
                        <div class="search"></div>
                    </div>
                </div>

                <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
            </article>
            
           
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
                           <img src="/img/флажок.png" alt="">
                       </div>
                       <div>
                           <img src="/img/триточки.png" alt="">
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
                    </div>
                </article>
            <?}?>
<!--     comment close      -->
       </main>

<?
require_once "../elements/footer.php";
?>
       
    