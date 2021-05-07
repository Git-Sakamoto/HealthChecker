<?php
require_once '../../../auth.php';
require "../../../../Food/FoodCategory.php";

require "../../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();
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
        <form method="post" action="confirm.php">
            <?php if($row = $databaseManager->selectFoodCategory($_POST['categoryId'])) : ?>
                <?php
                $categoryId = $row[$databaseManager->food_category_category_id];
                $categoryName = $row[$databaseManager->food_category_category_name];

                $beforeInfo = new FoodCategory($categoryId, $categoryName);
                $_SESSION['beforeInfo'] = serialize($beforeInfo);
                ?>
                
                <p>
                <b>更新前</b>
                <br>
                カテゴリーID：<?php echo $categoryId; ?>
                <br>
                カテゴリー名：<?php echo $categoryName; ?>
                </p>
                    
                <?php if(isset($_SESSION['afterInfo'])) : ?>
                    <?php $afterInfo = unserialize($_SESSION['afterInfo']); ?>
                    <p>
                    <b>更新後</b>
                    <br>
                    カテゴリーID：
                    <input type="text" pattern="^[a-z]+$" name="afterCategoryId" value="<?php echo $afterInfo->getCategoryId(); ?>" required>
                    </p>
                    
                    <p>
                    カテゴリー名：
                    <input type="text" name="afterCategoryName" value="<?php echo $afterInfo->getCategoryName(); ?>" required>
                    </p>
                <?php else : ?>
                    <p>
                    <b>更新後</b>
                    <br>
                    カテゴリーID（半角小文字アルファベット）：
                    <input type="text" pattern="^[a-z]+$" name="afterCategoryId" value="<?php echo $categoryId; ?>" required>
                    </p>
                    
                    <p>
                    カテゴリー名：
                    <input type="text" name="afterCategoryName" value="<?php echo $categoryName; ?>" required>
                    </p>
                <?php endif; ?>
                <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
                <input class="btn btn-outline-primary" type="submit" value="更新"">
            <?php else : ?>
                <p>情報を取得できませんでした</p>
                <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>