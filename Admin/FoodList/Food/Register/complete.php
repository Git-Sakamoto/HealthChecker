<?php
require_once '../../../auth.php';

require "../../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

// POSTされたトークンを取得
$token = isset($_POST["token"]) ? $_POST["token"] : "";
// セッション変数のトークンを取得
$session_token = isset($_SESSION["token"]) ? $_SESSION["token"] : "";
// セッション変数のトークンを削除
unset($_SESSION["token"]);
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
<title>食品リスト（食品）　管理機能　新規登録</title>
</head>
<body>
    <?php include "../../../header.html" ?>
    <div class="container">
        <div class="smallTitle">食品リスト（食品）　管理機能　新規登録</div>
            <?php if($token != "" && $token == $session_token) : ?>
                <?php
                $categoryId = $_POST['categoryId'];
                $categoryName = $_POST['categoryName'];
                $foodName = $_POST['foodName'];
                $kcal = $_POST['kcal'];
                $protein = $_POST['protein'];
                ?>
                    
                <p>
                <?php if($databaseManager->insertFood($categoryId, $foodName, $kcal, $protein)) : ?>
                    <b>以下の内容の登録に成功しました</b>
                <?php else : ?>
                    <b>以下の内容の登録に失敗しました</b>
                <?php endif; ?>
                <br>
                カテゴリー：<?php echo $categoryName; ?>
                <br>
                食品名：<?php echo $foodName; ?>
                <br>
                カロリー：<?php echo $kcal; ?>kcal
                <br>
                たんぱく質：<?php echo $protein; ?>g
                </p>
            <?php else : ?>
                <p>完了画面は再表示できません</p>
            <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">リストに戻る</button>
    </div>
</body>
</html>