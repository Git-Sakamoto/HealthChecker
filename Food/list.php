<?php
require "../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<title>食品リスト</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
</head>
<body>
    <?php include "../header.html" ?>
    <div class="container">
        <div class="smallTitle">食品リスト</div>
        <p>
            <a href="https://www.mext.go.jp/a_menu/syokuhinseibun/1365419.htm">日本食品標準成分表</a>から一部抜粋して、食品（100g）のカロリーとたんぱく質量を表示しています
        </p>
        <?php if($result = $databaseManager->selectAllFood()) : ?>
            <?php $categoryArray = $result->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP); ?>
            <?php foreach($categoryArray as $category => $foodArray) : ?>
                <div class="smallTitle"><?php echo $category; ?></div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 40%">食品名</th>
                            <th scope="col">エネルギー</th>
                            <th scope="col">たんぱく質</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($foodArray as $food) : ?>
                            <tr>
                                <td><?php echo $food['name']; ?></td>
                                <td><?php echo $food['kcal']; ?>kcal</td>
                                <td><?php echo $food['protein']; ?>g</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endforeach; ?>
        <?php else : ?>
            <p>データを取得できませんでした</p>
        <?php endif; ?>
    </div>
</body>
</html>