<main class="main-explore ">
          
<?
require_once "bar.php";

$single = getSingle_by_id($_GET["id_single"]);
$user = GetUser($single->id_user);
$like = getLike_by_id($single->id, $_SESSION["logged_user"]->id);

$comments = getComments_all($single->id);
?>
           
           
<!--     main-state      -->
           <article class="state">
               <div class="state-under">
                   <div class="state-user">
                             <div class="img-for-single">
                                <img src="<?=$user->img?>" alt="">
                            </div>
                       <div class="under-state-user">
                           <div class="nickname-state">Admin</div>
                           <div class="data-state">Jun 2, 2018</div>
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
                  <div class="likes"><a href="#"><?=$single->likes?> <?
                  if ($like->id_user_id == $_SESSION["logged_user"]->id) {?>
                    <i class="fa fa-heart" aria-hidden="true" style="color: red"></i>
                  <?} else {?>
                      <i class="fa fa-heart" aria-hidden="true"></i>
                  <?}
                  ?></a></div>
               </div>
           </article>
<!-- main state close   -->
           
<!--     create comment open      -->
           <article class="create-comment">
                    <form action="">
                       <p>Введите комментарий</p>
                        <input type="text" class="create-comment-text">
                        <input type="submit">
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