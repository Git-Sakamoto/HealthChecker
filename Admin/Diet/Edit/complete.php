<?php
require_once '../../auth.php';
require "../../../Diet/Action.php";

require "../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

$formCount = $_SESSION['formCount'];
$beforeInfoArray = $_SESSION['beforeInfoArray'];
$afterInfoArray = $_SESSION['afterInfoArray'];

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
<title>ダイエット計算機　管理機能　編集</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">ダイエット計算機　管理機能　編集</div>
            <?php if($token != "" && $token == $session_token) : ?>
                <?php for($i = 0; $i < $formCount; $i++) : ?>
                    <?php
                    $beforeInfo = unserialize($beforeInfoArray[$i]);
                    $beforeName = $beforeInfo->getName();
                    $beforeTime = $beforeInfo->getTime();
                    $beforeMets = $beforeInfo->getMets();
                    
                    $afterInfo = unserialize($afterInfoArray[$i]);
                    $afterName = $afterInfo->getName();
                    $afterTime = $afterInfo->getTime();
                    $afterMets = $afterInfo->getMets();

                    $id = $beforeInfo->getId();
                    ?>
                    
                    <p>
                    <?php if($databaseManager->updateAction($id, $afterName, $afterTime, $afterMets)) : ?>
                        <b>以下の情報の更新に成功しました</b>
                    <?php else : ?>
                        <b>以下の情報の更新に失敗しました</b>
                    <?php endif; ?>
                    <br>
                    <b>（<?php echo $i + 1; ?>）</b>
                    <br>
                    <b>更新前</b>
                    <br>
                    行動：<?php echo $beforeName; ?>
                    <br>
                    1回あたりの時間（分）：<?php echo $beforeTime; ?>
                    <br>
                    運動強度（METs）：<?php echo $beforeMets; ?>
                    </p>
                    
                    <p>
                    <b>更新後</b>
                    <br>
                    行動：<?php echo $afterName; ?>
                    <br>
                    1回あたりの時間（分）：<?php echo $afterTime; ?>
                    <br>
                    運動強度（METs）：<?php echo $afterMets; ?>
                    </p>
                <?php endfor; ?>
            <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">リストに戻る</button>
    </div>
</body>
</html>