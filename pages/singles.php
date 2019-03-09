<?

require_once "../include/db.php";

$title = "Categories";

require_once "../elements/header.php";



$category = getCategory_by_name($_GET["id_category"]);


views_update_category($category->id);

$singles = getSingles_by_category($_GET["id_category"]);

echo $single->id;

$pages = getCount_for_Category($_GET["id_category"]);
$p = isset($_GET["page"]) ? (int) $_GET["page"] : 0;
$count = 4;
$len = floor($pages / $count);


?>

        <main class="main-explore ">
            <article class="menu-explore">
                <div class="menu-explore-title">
                    <a href="explore.php">Explore Forum</a> - <?=$category->category_name?>
                </div>

                <div class="search">
                    <div class="container">
                        <input type="text"placeholder="Search..">
                        <div class="search"></div>
                    </div>
                </div>

                <i class="fa fa-user-circle fa-2x" aria-hidden="true"></i>
            </article>

           
           <article class="img-title-category">
               <div class="bg-img-category" style="background-image: url(../img/баста.jpg)">
                   <h4><?=$category->category_name?></h4>
                   <span>Preview your site to navigate your forum. This is where you go to add, edit &amp; delete posts and comments.</span>
               </div>
           </article>
           
           <article class="create-post-article">
               <div class="create-post"><a href="create-state.php">Create New Post</a></div>
           </article>
           
<!--     main-state      -->
            <? foreach ($singles as $single) {
                $user = GetUser($single->id_user);
                ?>
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
                                <img src="img/флажок.png" alt="">
                            </div>
                            <div>
                                <img src="img/триточки.png" alt="">
                            </div>
                        </div>
                        <div class="title-under-state"><?=$single->title?></div>
                        <a href="state.php?id_single=<?=$single->id?>">
                                <div class="text-under-state"><?

                                if (strpos($single->text, "<br>") == true) {
                                    echo htmlspecialchars(substr($single->text, 0, strpos($single->text, "<br>")));
                                } else { 
                                    echo htmlspecialchars($single->text);
                                }
                                
                                ?></div>
                        </a>
                    </div>
                    <div class="img-state">
                        <img src="<?=$single->img_preview?>" alt="">
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
<?

require_once "../elements/footer.php";
?>