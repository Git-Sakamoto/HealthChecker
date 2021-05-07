<?php
require_once '../../auth.php';
require "../../../Protein/Protein.php";

require "../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

$formCount = $_SESSION['formCount'];
$deleteLevelArray = $_SESSION['deleteLevelArray'];

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
<title>たんぱく質計算機　管理機能　削除</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">たんぱく質計算機　管理機能　削除</div>
            <?php if($token != "" && $token == $session_token) : ?>
                <?php for($i = 0; $i < $formCount; $i++) : ?>
                    <?php
                    $protein = unserialize($deleteLevelArray[$i]);
                    
                    $levelId = $protein->getLevel();
                    $levelName = $protein->getName();
                    $min = $protein->getIntakeMin();
                    $max = $protein->getIntakeMax();
                    ?>
                    
                    <p>
                    <?php if($databaseManager->deleteProtein($levelId)) : ?>
                        <b>以下の情報の削除に成功しました</b>
                    <?php else : ?>
                        <b>以下の情報の削除に失敗しました</b>
                    <?php endif; ?>
                    <br>
                    <b>（<?php echo $i + 1; ?>）</b>
                    <br>
                    運動レベルID：<?php echo $levelId; ?>
                    <br>
                    運動レベル名：<?php echo $levelName; ?>
                    <br>
                    最小摂取たんぱく質量：<?php echo $min; ?>g
                    <br>
                    最大摂取たんぱく質量：<?php echo $max; ?>g
                    </p>
                <?php endfor; ?>
            <?php else : ?>
                <p>完了画面は再表示できません</p>
            <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">リストに戻る</button>
    </div>
</body>
</html>