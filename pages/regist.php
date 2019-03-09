<?
$title = "Regist";
require_once "../include/db.php";



if (isset($_POST["submit"])) {
    $errors_regist = "";

    $login = R::findOne('users', 'login = ?', array($_POST["login"]));
    $email = R::findOne('users', 'email = ?', array($_POST["email"]));

    if (empty($_POST["password"])) {
        $errors_regist = "Заполните поле пароля";
    }
    if ($_POST["password"] != $_POST["second_password"]) {
        $errors_regist = "Пароли не совпадают";
    }
    if (empty($_POST["email"]) || $_POST["email"] == $email->email) {
        $errors_regist = "Заполните поле емайла или пользователь с такой почтой уже сущ";
    }
    if (empty($_POST["login"]) || $_POST["login"] == $login->login) {
        $errors_regist = "Заполните поле логина или пользователь с таким логином уже сущ";
    }


    if (empty($errors_regist)) {
        $user = R::dispense("users");

        $user->login = $_POST["login"];
        $user->email = $_POST["email"];
        $user->password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $user->img = "/img/img-user.jpg";
        $user->ip = $_SERVER["REMOTE_ADDR"];
        $user->privilege = 1;

        
        R::store($user);
        $_SESSION["logged_user"] = $user;

        header("Location: login.php");
        exit;
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
               <p>Ok dude, u can <a href="/pages/login.php">login</a> now</p>
               <?=$errors_regist?>
               <?
               if (isset($_SESSION["logged_user"])) {
                   echo "Авторизован";
                   echo "<br>";
                   echo $_SESSION["logged_user"]->login;
                   ?> <a href="logout.php">Выйти</a> <?
               }
               ?>
               <form action="" method="post" class="this-form">
                   <input type="text" name="login" class="" placeholder="Login">
                   <input type="text" name="email" class="" placeholder="Email">
                   <input type="password" name="password" class="" placeholder="Password">
                   <input type="password" name="second_password" class="" placeholder=" Repeat password">
                   <input type="submit" name="submit" class="submit">
               </form>
            </div>
        </main>
<!--    main close    -->
        
        
<?
require_once "../elements/footer.php";
?>