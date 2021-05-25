<?php
require '../../auth.php';
require "../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
<title>食品リスト（分類）　管理機能</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">食品リスト（カテゴリー）　管理機能</div>
        <?php if($result = $databaseManager->selectAllFoodCategory()) : ?>
            <form action="" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">カテゴリーID</th>
                            <th scope="col">カテゴリー名</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <?php
                            $categoryId = $row[$databaseManager->food_category_category_id];
                            $categoryName = $row[$databaseManager->food_category_category_name];
                            ?>
                            <tr>
                                <td><?php echo $categoryId; ?></td>
                                <td><?php echo $categoryName; ?></td>
                                <td>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Edit/input.php" name="categoryId" value="<?php echo $categoryId; ?>">編集</button>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Delete/confirm.php" name="categoryId" value="<?php echo $categoryId; ?>">削除</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </form>
        <?php else : ?>
            <p>データの取得に失敗しました</p>
        <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='Register/input.php'">新規登録</button>
    </div>
</body>
</html>