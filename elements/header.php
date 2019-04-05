<?
    if (isset($_GET["search"]) & $title != "Search") {
        header("Location: search.php?search=".$_GET["search"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/css/style.css" type="text/css">
    <link rel="stylesheet" href="/css/profile.css" type="text/css"> 
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=cyrillic-ext" rel="stylesheet">
        <?
            if (isset($_SESSION["logged_user"])) {?>
                <script> 
                let body   = document.getElementById("body");
                let status = false;
                
                body.onload = () => {
                    if (status == false) {
                        status = true;
                    }
                }
                
                body.onbeforeunload = () => {
                    if (status == true) {
                        status = false;
                    }
                } 
                </script>
                <?
                    $setset = '<script> document.write(status); </script>';
                    if ($setset == false) {
                        $new_status = R::dispense('users'); 
                            
                        $new_status->id = $_SESSION["logged_user"]->id;
                        $new_status->set = false;
                        
                        R::store($new_status);
                    } else {
                        $new_status = R::dispense('users'); 
                            
                        $new_status->id = $_SESSION["logged_user"]->id;
                        $new_status->set = true;
                        
                        R::store($new_status);
                    }
            }
        ?>
</head>
<body id="body">
    <div class="wrapper">
<!--   header open    -->
        <header>
            <div class="header-title"><a href="../index.php">Froum.</a></div>
            
            <div><a href="../index.php">Home</a></div>
            <div><a href="/pages/explore.php">Category</a></div>
            <div><a href="#">Members</a></div>
            <div><a href="#">About</a></div>
            <div><a href="#">Site Rules</a></div>
            <div><a href="<?
            if (isset($_SESSION["logged_user"])) {?>
                /pages/profile.php?id_profile=<?=$_SESSION["logged_user"]->id?>&block=posts
            <?} else {?>
                /pages/login.php
            <?}
            ?>">Profile</a></div>
        </header>
<!--   header close     -->