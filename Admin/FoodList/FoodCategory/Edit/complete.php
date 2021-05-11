<?php
require_once '../../../auth.php';
require "../../../../Food/FoodCategory.php";

require "../../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

$beforeInfo = $_SESSION['beforeInfo'];
$afterInfo = $_SESSION['afterInfo'];

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
<title>食品リスト（分類）　管理機能　編集</title>
</head>
<body>
    <?php include "../../../header.html" ?>
    <div class="container">
        <div class="smallTitle">食品リスト（分類）　管理機能　編集</div>
            <?php if($token != "" && $token == $session_token) : ?>
                <?php
                $beforeInfo = unserialize($_SESSION['beforeInfo']);
                $beforeCategoryId = $beforeInfo->getCategoryId();
                $beforeCategoryName = $beforeInfo->getCategoryName();
                    
                $afterInfo = unserialize($_SESSION['afterInfo']);
                $afterCategoryId = $afterInfo->getCategoryId();
                $afterCategoryName = $afterInfo->getCategoryName();
                ?>
                    
                <p>
                <?php if($databaseManager->updateFoodCategory($beforeCategoryId, $afterCategoryId,$afterCategoryName)) : ?>
                    <?php
                    $databaseManager->updateFoodTableCategoryId($beforeCategoryId, $afterCategoryId);
                    ?>
                    <b>以下の情報の更新に成功しました</b>
                <?php else : ?>
                    <b>以下の情報の更新に失敗しました</b>
                <?php endif; ?>
                </p>

                <p>
                <b>更新前</b>
                <br>
                カテゴリーID：<?php echo $beforeCategoryId; ?>
                <br>
                カテゴリー名：<?php echo $beforeCategoryName; ?>
                </p>
                    
                <p>
                <b>更新後</b>
                <br>
                カテゴリーID：<?php echo $afterCategoryId; ?>
                <br>
                カテゴリー名：<?php echo $afterCategoryName; ?>
                </p>
            <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">リストに戻る</button>
    </div>
</body>
</html>