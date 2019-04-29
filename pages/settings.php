<?
    $title = "Settings";
    require_once "../include/db.php";
    // if (isset($_POST["submit_change"])) {
    //     header()
    // }
    require_once "../elements/header.php";
    
    if ($_GET["block"] == false) {
        $_GET["block"] = "profile";
    }

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
        if (!empty($_POST["change_status"])) {
            $change_profile->status = htmlspecialchars($_POST["change_status"]);
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
            if ($errors_img != "") {
                move_uploaded_file($file_tmp, "../img/".$file_name);
    
                $change_profile->img = "/img/".$file_name;
            }
            $change_profile->img = "/img/".$file_name;
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
                        
                        <p>Status: </p>
                        <input type="text" name="change_status">

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
                        foreach ($getstates as $getstate) {
                            $count_comments = getCount_comments($getstate->id);
                            ?>
                            <article class="state post-state">
                                <div class="state-under post-state-under">
                                    <div class="state-user">
                                        <div class="img-for-single img-for-post">
                                            <a href="profile.php?id_profile=<?=$user->id?>"><img src="<?=$user->img?>" alt=""></a>
                                        </div>
                                        <div class="under-state-user under-post-user" >
                                            <div class="nickname-state"><a href="profile.php?id_profile=<?=$user->id?>"><?=$user->login?></a></div>
                                            <div class="data-state"><?=$getstate->date?></div>
                                        </div>
                                        <div>
                                            <a href="reduct.php?id_state=<?=$getstate->id?>"><button>Редактировать стр</button></a>
                                        </div>
                                    </div>
                                    <div class="title-under-state"><?=$getstate->title?></div>
                                    <a href="state.php?id_single=<?=$getstate->id?>">
                                            <div class="text-under-state"><?

                                            if (strpos($getstate->text, "<br>") == true) {
                                                echo htmlspecialchars(substr($getstate->text, 0, strpos($getstate->text, "<br>")));
                                            } else { 
                                                echo htmlspecialchars($getstate->text);
                                            }
                                            
                                            ?></div>
                                    </a>
                                </div>
                                <div class="footer-state">
                                    <div><?=$count_comments?> comments</div>
                                    <div><?=$getstate->views?> views</div>
                                    <div><?=$getstate->likes?> likes</div>
                                </div>
                            </article>
                        <?}?>
                    </div>
                </article>
        <?}
    }
    require_once "../elements/footer.php";
?>
