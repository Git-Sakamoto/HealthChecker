<?php
session_start();
header('Expires: -1');
header('Cache-Control:');
header('Pragma:');

$mode = "input";
    
if(isset($_POST["confirm"])){
    $mode = "confirm";
    
    $_SESSION["fullName"] = $_POST["fullName"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["message"] = $_POST["message"];
    
    $_SESSION['sendMail'] = true;
}else if(isset($_POST["send"]) && isset($_SESSION['sendMail'])){
    $mode = "send";
    
    $message = "お問い合わせを受け付けました\r\n"
            ."名前：".$_SESSION["fullName"]."\r\n"
            ."メールアドレス：".$_SESSION["email"]."\r\n"
            ."お問い合わせ内容：\r\n"
            .preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION["message"]);
    $headers = "From: 健康計算機<sakamototest@sv5.php.xdomain.ne.jp>"."\r\n"."Reply-To: ".$_SESSION["email"];

    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    mb_send_mail("sakamoto.test.mail@gmail.com", "お問い合わせの受付", $message, $headers);
    
    sessionUnset();
}else{
    sessionUnset();
}

function sessionUnset()
{
    unset($_SESSION['fullName']);
    unset($_SESSION['email']);
    unset($_SESSION['message']);
    unset($_SESSION['sendMail']);
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<title>お問い合わせ</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
</head>
<body>
<?php include "../header.html" ?>  
    <div class="container">
        <div class="smallTitle">お問い合わせ</div>
        <?php if($mode == "input") : ?>
            <!-- 入力画面 -->
            <p>お問い合わせ、要望、ご自由にどうぞ</p>
            
            <form action="form.php" method="post">
            <p>
            名前：
            <br>
            <input type="text" name="fullName" required>
            </p>
            
            <p>
            メールアドレス：
            <br>
            <input type="email" name="email" required>
            </p>

            <p>
            本文：
            <br>
            <textarea name="message" cols="40" rows="5"></textarea>
            </p>
            
            <input class="btn btn-outline-primary" type="submit" name="confirm" value="確認">
            </form>
        <?php elseif($mode == "confirm") : ?>
            <!-- 確認画面 -->
            <p>
            名前：
            <br>
            <?php echo $_SESSION["fullName"]; ?>
            </p>

            <p>
            メールアドレス：
            <br>
            <?php echo $_SESSION["email"]; ?>
            </p>
            
            <p>
            本文：
            <br>
            <?php echo nl2br($_SESSION["message"]); ?>
            </p>
            
            <form action="form.php" method="post">
            <button class="btn btn-outline-primary" type="button" onclick="history.back();">戻る</button>
            <input class="btn btn-outline-primary" type="submit" name="send" value="送信" />
            </form>
        <?php elseif($mode == "send") : ?>
            <!-- 完了画面 -->
            <p>
            送信が完了しました。
            <br>
            ありがとうございました。
            </p>
        <?php endif; ?>
    </div>
</body>
</html>