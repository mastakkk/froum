<?
    require_once "../include/db.php";
    require_once "../elements/header.php";
?>
        <article class="settings-profile">
            <div class="left-side-settings">
                <ul>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Posts</a></li>
                </ul>
            </div>
            <div class="right-side-settings">
                <form action="" method="post" enctype="multipart/form-data">
                    <p>Login: </p>
                    <input type="text">
                    
                    <p>Email: </p>
                    <input type="text">
                    
                    <p>Password</p>
                    <input type="text">
                    
                    <p>Изменить аватарку: </p>
                    <input type="file" name="change_img">
                    <div class="img-settings">
                        <img src="img/1.png" alt="">
                    </div>
                    <input type="submit">
                </form>
            </div>
        </article>
<?
    require_once "../elements/footer.php";
?>