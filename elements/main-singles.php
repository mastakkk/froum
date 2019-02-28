<main class="main-explore ">
          
<?
require_once "bar.php";


 $category = getCategory_by_name($_GET["id_category"]);

 $singles = getSingles_by_category($_GET["id_category"]);

echo $single->id;

 $pages = getCount_for_Category($_GET["id_category"]);
 $p = isset($_GET["page"]) ? (int) $_GET["page"] : 0;
 $count = 4;
 $len = floor($pages / $count);


?>
           
           <article class="img-title-category">
               <div class="bg-img-category" style="background-image: url(../img/баста.jpg)">
                   <h4><?=$category->category_name?></h4>
                   <span>Preview your site to navigate your forum. This is where you go to add, edit &amp; delete posts and comments.</span>
               </div>
           </article>
           
           <article class="create-post-article">
               <div class="create-post"><a href="#">Create New Post</a></div>
           </article>
           
<!--     main-state      -->
            <? foreach ($singles as $single) {
                $user = GetUser($single->id_user);
                ?>
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
                                <img src="img/флажок.png" alt="">
                            </div>
                            <div>
                                <img src="img/триточки.png" alt="">
                            </div>
                        </div>
                        <div class="title-under-state"><?=$single->title?></div>
                        <a href="state.php?id_single=<?=$single->id?>">
                                <div class="text-under-state"><?=$single->text?></div>
                        </a>
                    </div>
                    <div class="img-state">
                        <img src="<?=$single->img?>" alt="">
                    </div>
                    <div class="footer-state">
                        <div><?=$single->comments?> comments</div>
                        <div><?=$single->views?> views</div>
                        <div><?=$single->likes?> likes</div>
                    </div>
                </article>
            <?}             ?>
           
<!-- navigation open -->
           <article class="navigation">
            <ul>
            <? for($i = 0; $i <= $len; $i++) { ?>
                <li><a href="?id_category=<?=$category->id?>?page=<?=$i?>"><?= $i + 1?></a></li>
            <? } ?>
            </ul>
           </article>
<!-- navigation close -->
<!-- main state close   -->
