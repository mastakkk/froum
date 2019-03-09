<?
$title = "Login";
require_once "../include/db.php";

if (isset($_SESSION["logged_user"])) {
    header("Location: profile.php?id_profile=".$_SESSION["logged_user"]->id);
}

if (isset($_POST['submit'])) {
		
    $errors = "";

    $user = R::findOne('users', 'login = ?', array($_POST['login']));

    if ($user) {
        
        if (password_verify($_POST['password'], $user->password) ) {
            $_SESSION["logged_user"] = $user;
            header("Location: profile.php?id_profile=".$_SESSION["logged_user"]->id."&block=posts");
        } else {
            $errors = "Неверный пароль";
        }
    } else {
        $errors = "Пользователь с таким логином не найден";
    }
}

require_once "../elements/header.php";
?>
        
        
<!--   main open     -->
        <main class="form-regist">
            <div class="title-form-regist">
                <h1>Have something to say? Regist now!</h1>
            </div>
            <div class="form-form-regist">
               <p>U can <a href="/pages/regist.php">regist</a> now dude. Rly do it</p>
               <?=$errors?>
               <?
               if (isset($_SESSION["logged_user"])) {
                   echo "Авторизован";
                   ?> <a href="logout.php">Выйти</a> <?
               }
               ?>
               <form action="" method="post" class="this-form">
                   <input type="text" name="login" class="LoginOrEmail" placeholder="Login or Email">
                   <input type="password" name="password" class="" placeholder="Password">
                   <input type="submit" name="submit" class="submit">
               </form>
            </div>
        </main>
<!--    main close    -->
        
        
<?
require_once "../elements/footer.php";
?>