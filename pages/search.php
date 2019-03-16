<?

require_once "../include/db.php";

$title = "Search";

require_once "../elements/header.php";


// $singles = getSearch($_GET["search"]);
$singles = R::exec("SELECT * FROM `singles` WHERE `title` LIKE '%1%'");

echo $singles;

?>

        
	
		


           
<!-- navigation open -->
           <article class="navigation">
            <ul>
            </ul>
           </article>
<!-- navigation close -->
<!-- main state close   -->
<?

require_once "../elements/footer.php";
?>