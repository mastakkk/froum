<?
    $title = "Settings";
    require_once "../include/db.php";
    // if (isset($_POST["submit_change"])) {
    //     header()
    // }
    require_once "../elements/header.php";
    
    if (isset($_POST["submit_change"])) {
        $change_profile = R::dispense("users");

        $change_profile->id = $_SESSION["logged_user"]->id;
        if (!empty($_POST["change_login"])) {
            $change_profile->login = $_POST["change_login"];
        }
        if (!empty($_POST["change_email"])) {
            $change_profile->email = $_POST["change_email"];
        }
        if (!empty($_POST["change_password"])) {
            $change_profile->password = password_hash($_POST["change_password"], PASSWORD_DEFAULT);
        }
        if (!empty($_FILES['change_img'])) {
            $file_name = $_FILES['change_img']['name'];
            $file_size = $_FILES['change_img']['size'];
            $file_tmp = $_FILES['change_img']['tmp_name'];
            $file_ext = strtolower(end(explode('.',$_FILES['change_img']->name)));
        
            $expensions = array("jpeg","jpg","png");
            $errors_img = "";
            
            
            if ($file_size > 2097152) {
                $errors_img = "Картинка не должна превышать 2 мб";
            }
            if (empty($errors_img)) {
                move_uploaded_file($file_tmp, "../img/".$file_name);
    
                $change_profile->img = "/img/".$file_name;
            }
        }


        R::store($change_profile);

        $_SESSION["logged_user"] = $change_profile;
    }
    



    $user = getUser($_GET["id_user"]);
    if ($_SESSION["logged_user"]->id == $user->id) {
        if ($_GET["block"] == "profile") {?>
            <article class="settings-profile">
                <div class="left-side-settings">
                    <ul>
                        <li><a href="settings.php?id_user=<?=$user->id?>&block=profile"><span style="
                        border-bottom: 1px solid #fff">Profile</span></a></li>

                        <li><a href="settings.php?id_user=<?=$user->id?>&block=posts">Posts</a></li>
                    </ul>
                </div>
                <div class="right-side-settings">
                    <form action="" method="post" enctype="multipart/form-data">
                        <p>Login: </p>
                        <input type="text" name="change_login">
                        
                        <p>Email: </p>
                        <input type="text" name="change_email">
                        
                        <p>Password</p>
                        <input type="password" name="change_password">
                        
                        <p>Изменить аватарку: </p>
                        <input type="file" name="change_img">
                        <div class="img-settings">
                            <img src="<?
                                echo $user->img;
                            ?>" alt="">
                        </div>
                        <input type="submit" name="submit_change" class="submit_change">
                    </form>
                </div>
            </article>
        <?} elseif ($_GET["block"] == "posts") {?>
                <article class="settings-profile">
                    <div class="left-side-settings">
                        <ul>
                            <li><a href="settings.php?id_user=<?=$user->id?>&block=profile">Profile</a></li>
                            <li><a href="settings.php?id_user=<?=$user->id?>&block=posts"><span style="
                        border-bottom: 1px solid #fff">Posts</span></a></li>
                        </ul>
                    </div>
                    <div class="right-side-settings">
                        <?$getstates = getStates_for_one_user($user->id);
                        foreach ($getstates as $getstate) {?>

                        <?}?>
                    </div>
                </article>
        <?}
    }
    require_once "../elements/footer.php";
?>