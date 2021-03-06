<?

require_once "../include/db.php";

$title = "Categories";

require_once "../elements/header.php";



$category = getCategory_by_name($_GET["id_category"]);


views_update_category($category->id);





?>

        <main class="main-explore ">
            <article class="menu-explore">
                <div class="menu-explore-title">
                    <a href="explore.php">Explore Forum</a> - <?=$category->category_name?>
                </div>

               <?
               require_once "../elements/bar.php";
               ?>
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
        <?
        $singles = getSingles_by_category($category->id);

        

		$pages = getCount_for_Category($category->id);
		$p = isset($_GET["page"]) ? (int) $_GET["page"] : 0;
		$count = 4;
		$len = floor($pages / $count);

		$first = $p*$count;
		$second = ($p+1)*$count;
		
		$new_singles = R::find('singles', "WHERE id_category = $category->id LIMIT $first, $second");

		foreach ($new_singles as $new_single) {
				$user = GetUser($new_single->id_user);
				$count_comments = getCount_comments($new_single->id);
				?>
				<article class="state">
					<div class="state-under">
						<div class="state-user">
							<div class="img-for-single">
								<a href="profile.php?id_profile=<?=$user->id?>"><img src="<?=$user->img?>" alt=""></a>
							</div>
							<div class="under-state-user">
								<div class="nickname-state"><a href="profile.php?id_profile=<?=$user->id?>"><?=$user->login?></a></div>
								<div class="data-state"><?=$new_single->date?></div>
							</div>
							<div>
								<img src="/img/flag.png" alt="">
							</div>
							<div>
								<img src="/img/three.png" alt="">
							</div>
						</div>
						<div class="title-under-state"><?=$new_single->title?></div>
						<a href="state.php?id_single=<?=$new_single->id?>">
								<div class="text-under-state"><?
	
								if (strpos($new_single->text, "<br>") == true) {
									echo htmlspecialchars(substr($new_single->text, 0, strpos($new_single->text, "<br>")));
								} else { 
									echo htmlspecialchars($new_single->text);
								}
								
								?></div>
						</a>
					</div>
					<div class="img-state">
						<img src="<?=$new_single->img_preview?>" alt="">
					</div>
					<div class="footer-state">
						<div><?=$count_comments?> comments</div>
						<div><?=$new_single->views?> views</div>
						<div><?=$new_single->likes?> likes</div>
					</div>
				</article>
			<?}            ?> 
	
		


           
<!-- navigation open -->
           <article class="navigation">
            <ul>
            <? for($i = 0; $i <= $len; $i++) { ?>
                <li><a href="?id_category=<?=$category->id?>&page=<?=$i?>"><?=$i+ 1?></a></li>
            <? } ?>
            </ul>
           </article>
<!-- navigation close -->
<!-- main state close   -->
<?

require_once "../elements/footer.php";
?>