<?
    require_once "../include/db.php";
    require_once "../elements/header.php";

    $user_profile = getUser($_GET["id_profile"]);

    $user_privilege = getPrivilege_for_user($_SESSION["logged_user"]);


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
                $getstates = getStates_for_one_user($user_profile->id);
                foreach ($getstates as $getstate) {?>
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
                                        <img src="img/флажок.png" alt="">
                                    </div>
                                    <div>
                                        <img src="img/триточки.png" alt="">
                                    </div>
                                </div>
                                <div class="title-under-state"><?=$getstate->title?></div>
                                <a href="state.php?id_single=<?=$getstate->id?>">
                                        <div class="text-under-state"><?=$getstate->text?></div>
                                </a>
                            </div>
                            <div class="img-state">
                                <img src="<?=$getstate->img_preview?>" alt="">
                            </div>
                            <div class="footer-state">
                                <div><?=$getstate->comments?> comments</div>
                                <div><?=$getstate->views?> views</div>
                                <div><?=$getstate->likes?> likes</div>
                            </div>
                        </div>
                    </article>
                <?}
            } elseif ($_GET["block"] == 'likes') {
                $yes_getlike = getLikes_for_one_user($user_profile->id);
                foreach ($yes_getlikes as $yes_getlike) {
                    echo 123;
                }
            }
            ?>
            
        </main>
<?
    require_once "../elements/footer.php";
?>