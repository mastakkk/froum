<?
$title = "Explore";
require_once "../include/db.php";
require_once "../elements/header.php";
?>
<!-- main explore open -->
<main class="main-explore">
          
<?
require_once "../elements/bar.php";

$categories = getCategory_all();



?>
          
          <article class="explore-forum-title">
              <h2>Explore Forum</h2>
              <p>Explore your forum below to see what you can do, or head to Settings to start managing your Categories.</p>
          </article>
          
          <article class="explore-categories">
             <?
                foreach ($categories as $category) {

                    $count_categories = getCount_for_Category($category->id);?>

                    <div class="one_category">
                        <div class="explore-bg image-slider" style="background-image: url(<?=$category->img?>)"></div>
                        <div class="text-explore">
                            <h3><a href="singles.php?id_category=<?=$category->id?>"><?=$category->category_name?></a></h3>
                            <p><?=$category->views?> views | <?=$count_categories?> posts</p>
                            <p class="under-text-explore">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis, eius.</p>
                        </div>
                    </div>
                <?}
             ?>
              
          </article>
      </main>
      <!-- main explore close -->
<?
require_once "../elements/footer.php";
?>
