<?php
require_once '../../../auth.php';
require "../../../../Food/FoodCategory.php";

// 二重送信防止用トークンの発行
$token = uniqid('', true);
//トークンをセッション変数にセット
$_SESSION['token'] = $token;
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
        <p>以下の内容で情報を更新します</p>
        <?php
        $beforeInfo = unserialize($_SESSION['beforeInfo']);
        $categoryId = $beforeInfo->getCategoryId();
        $categoryName = $beforeInfo->getCategoryName();
                
        $afterInfo = new FoodCategory($_POST['afterCategoryId'], $_POST['afterCategoryName']);
        $_SESSION['afterInfo'] = serialize($afterInfo);
        ?>
                
        <p>
        <b>更新前</b>
        <br>
        カテゴリーID：<?php echo $beforeInfo->getCategoryId(); ?>
        <br>
        カテゴリー名：<?php echo $beforeInfo->getCategoryName(); ?>
        </p>
                
        <p>
        <b>更新後</b>
        <br>
        カテゴリーID：<?php echo $afterInfo->getCategoryId(); ?>
        <br>
        カテゴリー名：<?php echo $afterInfo->getCategoryName(); ?>
        </p>
        
        <form action = "complete.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <button class="btn btn-outline-primary" type="button" onclick="history.back();">戻る</button>
            <input class="btn btn-outline-primary" type="submit" value="確定">
        </form>
    </div>
</body>
</html>