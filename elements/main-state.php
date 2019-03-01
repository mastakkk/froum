<main class="main-explore ">
          
<?
require_once "bar.php";

$user = GetUser($single->id_user);
$like = getLike_by_id($single->id, $_SESSION["logged_user"]->id);


$you = $_SESSION["logged_user"];
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

?>
           
           
<!--     main-state      -->
           <article class="state">
               <div class="state-under">
                   <div class="state-user">
                             <div class="img-for-single">
                                <img src="<?=$user->img?>" alt="">
                            </div>
                       <div class="under-state-user">
                           <div class="nickname-state"><?=$user->login?></div>
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
                   <div class="text-under-single"><?=$single->text?></div>
               </div>
               <div class="img-single">
                   <img src="<?=$single->img?>" alt="">
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
                       <p>Введите комментарий</p>
                        <input type="text" class="create-comment-text">
                        <input type="submit" name="create-comment-submit">
                    </form>
           </article>
<!--      create comment close     -->
           
           
<!--     comment open      -->
            <?
            foreach ($comments as $comment) {
                $user_comment = getUser($comment->id_user);?>

                <article class="comment">
                    <div class="under-comment">
                        <div class="img-for-single">
                            <img src="<?=$user_comment->img?>" alt="">
                        </div>
                        <div class="author-comment">
                            <p><?=$user_comment->login?></p>
                        </div>
                        <div class="date-comment">
                            <?=$comment->date?>
                        </div>
                        <div class="delete_button_comment">
                            <button>Удалить</button>
                        </div>
                        <div class="text-comment">
                            <p><?=$comment->text?></p>
                        </div>
                    </div>
                </article>
            <?}?>
<!--     comment close      -->
       </main>