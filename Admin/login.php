<?php
session_start();
require "../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

$error_message = "";

if(isset($_POST["login"])) {

	if($databaseManager->userSearch($_POST["user_name"],$_POST["password"])) {
		$_SESSION["user_name"] = $_POST["user_name"];
		header("Location: top.php");
		exit;
	}
    
    $error_message = "※ユーザー名、もしくはパスワードが間違っています。<br>もう一度入力して下さい。";
}
?>

<html lang="ja">
<head>
<meta charset="UTF-8">
<title>ログイン</title>
</head>
<body>
    <?php
    if($error_message){
    	echo $error_message;
    }
    ?>
    <p>
        ユーザー名：testuser<br>
        パスワード：testpass
    </p>
    <form action="login.php" method="POST">
    	<p>ユーザー名：<input type="text" name="user_name"></p>
    	<p>パスワード：<input type="password" name="password"></p>
    	<input type="submit" name="login" value="ログイン">
</form>
</body>
</html>