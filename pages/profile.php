<?
    $title = "Profile";
    require_once "../include/db.php";

    $user_profile = getUser($_GET["id_profile"]);
    
    $user_privilege = getPrivilege_for_user($user_profile);

    if (isset($_GET["comm"])) {
        $comm = $_GET["comm"];
        $delete_comm = R::findOne('comments', "WHERE id = $comm");
    
        R::trash($delete_comm);
        header("Location: profile.php?id_profile=".$user_profile->id."&block=comments");
    }
    if ($_GET["block"] == false) {
        $_GET["block"] = "posts";
    }

    require_once "../elements/header.php";
?>
        <main class="profile">
            <article class="real-profile">
                <div class="left-side-profile">
                    <div class="img-for-profile">
                            <img src="<?=$user_profile->img?>" alt="">
                    </div>
                    <div class="id-profile">
                        <p>id: <?=$user_profile->id?></p>
                    </div>
                </div>
                <div class="right-side-profile">
                    <ul>
                        <span class="nickname-profile"><li><?=$user_profile->login?></li></span>
                        <li><span>Роль в системе: </span><?=$user_privilege?></li>
                        <li><span>Почта: <?=$user_profile->email?></span></li>
                        <li><span>Статус: </span><?=$user_profile->status?></li>
                        <li><div style="color: green">Online</div><div style="color: darkred">Offline</div></li>
                        <?
                        if ($_SESSION["logged_user"]->id == $user_profile->id) {?>
                            <li><a href="settings.php?id_user=<?=$_SESSION["logged_user"]->id?>&block=profile">Настройки</a> | <a href="logout.php">Выйти</a></li>
                        <?}
                        ?>
                    </ul>
                </div>
            </article>
            
            <article class="sidebar-profile">
                <?
                ?>
                <div style="
                <? if ($_GET["block"] == 'posts') { ?>
                border-bottom: 1px solid #fff
                <?}?>"
                ><a href="profile.php?id_profile=<?=$user_profile->id?>&block=posts">Posts</a></div>

                <div style="
                <? if ($_GET["block"] == 'likes') { ?>
                border-bottom: 1px solid #fff
                <?}?>"
                ><a href="profile.php?id_profile=<?=$user_profile->id?>&block=likes">Likes</a></div>

                <div style="
                <? if ($_GET["block"] == 'comments') { ?>
                border-bottom: 1px solid #fff
                <?}?>"
                ><a href="profile.php?id_profile=<?=$user_profile->id?>&block=comments">Comments</a></div>
            </article>
            
            <? if ($_GET["block"] == 'posts') {

                $count_getstate = R::count('singles', "WHERE id_user = $user_profile->id");
                $p = isset($_GET["page"]) ? (int) $_GET["page"] : 0;
                $count = 4;
                $len = floor($count_getstate / $count);

                $first = $p*$count;
                $second = ($p+1)*$count;
                
                $getstates = R::find('singles', "WHERE id_user = $user_profile->id LIMIT $first, $second");

                foreach ($getstates as $getstate) {
                    $count_comments = getCount_comments($getstate->id);
                    ?>
                    <article>
                        <div class="state">
                            <div class="state-under">
                                <div class="state-user">
                                    <div class="img-for-single">
                                        <img src="<?=$user_profile->img?>" alt="">
                                    </div>
                                    <div class="under-state-user">
                                        <div class="nickname-state"><?=$user_profile->login?></div>
                                        <div class="data-state"><?=$user_profile->date?></div>
                                    </div>
                                    <div>
                                        <img src="/img/flag.png" alt="">
                                    </div>
                                    <div>
                                        <img src="/img/three.png" alt="">
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
                            <div class="img-state">
                                <img src="<?=$getstate->img_preview?>" alt="">
                            </div>
                            <div class="footer-state">
                                <div><?=$count_comments?> comments</div>
                                <div><?=$getstate->views?> views</div>
                                <div><?=$getstate->likes?> likes</div>
                            </div>
                        </div>
                    </article>
                <?}?>
                <!-- navigation open -->
                <article class="navigation">
                 <ul>
                 <? for($i = 0; $i <= $len; $i++) { ?>
                     <li><a href="profile.php?id_profile=1&block=posts&page=<?=$i?>"><?=$i+ 1?></a></li>
                 <? } ?>
                 </ul>
                </article>
                <!-- navigation close -->
            <?} elseif ($_GET["block"] == 'likes') {
                // $yes_getlikes = getLikes_for_one_user($user_profile->id);
                

                $count_getstate = R::count('singles', "WHERE id_user = $user_profile->id");
                $p = isset($_GET["page"]) ? (int) $_GET["page"] : 0;
                $count = 4;
                $len = floor($count_getstate / $count);

                $first = $p*$count;
                $second = ($p+1)*$count;
                
                $yes_getlikes = R::find('likes', "WHERE id_user_id = $user_profile->id LIMIT $first, $second");

                foreach ($yes_getlikes as $yes_getlike) {
                    $getlike = getSingle_by_id($yes_getlike->id_single);
                    $getuser_by_like = getUser($getlike->id_user);
                    $count_comments = getCount_comments($getlike->id);
                    ?>
                    <article>
                        <div class="state">
                            <div class="state-under">
                                <div class="state-user">
                                    <div class="img-for-single">
                                        <img src="<?=$getuser_by_like->img?>" alt="">
                                    </div>
                                    <div class="under-state-user">
                                        <div class="nickname-state"><?=$getuser_by_like->login?></div>
                                        <div class="data-state"><?=$getuser_by_like->date?></div>
                                    </div>
                                    <div>
                                        <img src="/img/flag.png" alt="">
                                    </div>
                                    <div>
                                        <img src="/img/three.png" alt="">
                                    </div>
                                </div>
                                <div class="title-under-state"><?=$getlike->title?></div>
                                <a href="state.php?id_single=<?=$getlike->id?>">
                                        <div class="text-under-state"><?
                                        if (strpos($getlike->text, "<br>") == true) {
                                            echo htmlspecialchars(substr($getlike->text, 0, strpos($getlike->text, "<br>")));
                                        } else { 
                                            echo htmlspecialchars($getlike->text);
                                        }?></div>
                                </a>
                            </div>
                            <div class="img-state">
                                <img src="<?=$getlike->img_preview?>" alt="">
                            </div>
                            <div class="footer-state">
                                <div><?=$count_comments?> comments</div>
                                <div><?=$getlike->views?> views</div>
                                <div><?=$getlike->likes?> likes</div>
                            </div>
                        </div>
                    </article>
                <?}?>
                <!-- navigation open -->
                <article class="navigation">
                 <ul>
                 <? for($i = 0; $i <= $len; $i++) { ?>
                     <li><a href="profile.php?id_profile=1&block=likes&page=<?=$i?>"><?=$i+ 1?></a></li>
                 <? } ?>
                 </ul>
                </article>
                <!-- navigation close -->
            <?} elseif ($_GET["block"] == 'comments') {

                $count_getstate = R::count('singles', "WHERE id_user = $user_profile->id");
                $p = isset($_GET["page"]) ? (int) $_GET["page"] : 0;
                $count = 6;
                $len = floor($count_getstate / $count);

                $first = $p*$count;
                $second = ($p+1)*$count;

                $getcomms = R::find('comments', "WHERE id_user = $user_profile->id LIMIT $first, $second");

                // $getcomms = getComm_by_id($user_profile->id);
                foreach ($getcomms as $getcomm) {?>
                    <article class="comment">
                        <div class="under-comment">
                            <div class="img-for-single">
                                <img src="<?=$user_profile->img?>" alt="">
                            </div>
                            <div class="author-comment">
                                <p><?=$user_profile->login?></p>
                            </div>
                            <div class="date-comment">
                                <?=$getcomm->date?>
                            </div>
                            <div class="delete_button_comment">
                                <?
                                if ($SESSION["logged_user"]->id == $getcomm->id_user || $_SESSION["logged_user"]->privilege == 3 || $_SESSION["logged_user"]->privilege == 2) {?>
                                    <form action="" method="post">
                                        <button type="submit" name="delete_comment"><a href="profile.php?id_profile=<?=$user_profile->id?>&comm=<?=$getcomm->id?>&block=comments">Удалить</a></button>
                                    </form>
                                <?}?>

                            </div>
                            <div class="text-comment">
                                <p><?=$getcomm->text?></p>
                            </div>
                        </div>
                    </article>
                <?}?>
                <!-- navigation open -->
                <article class="navigation">
                    <ul>
                    <? for($i = 0; $i <= $len; $i++) { ?>
                        <li><a href="profile.php?id_profile=1&block=comments&page=<?=$i?>"><?=$i+ 1?></a></li>
                    <? } ?>
                    </ul>
                </article>
                <!-- navigation close -->
            <?}
            ?>
            
        </main>
<?
    require_once "../elements/footer.php";
?>