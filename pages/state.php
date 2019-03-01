<?
require_once "../include/db.php";

$single = getSingle_by_id($_GET["id_single"]);

if (isset($_POST["submit_like_unset"])) {
    header("Location: state.php?id_single=$single->id");
}
if (isset($_POST["submit_like_set"])) {
    header("Location: state.php?id_single=$single->id");
}
if (isset($_POST["create_comment_submit"])) {
    header("Location: state.php?id_single=$single->id");
}

require_once "../elements/header.php";
require_once "../elements/main-state.php";
require_once "../elements/footer.php";
?>
       
    