<?php
require "../../auth.php";
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<title>食品リスト　管理機能</title>
</head>
<body>
    <?php include "../header.html" ?>
    <div class="container">
        <h1>食品リスト　管理機能</h1>
        
        <h2><a href="FoodCategory/top.php">食品カテゴリー</a></h2>
        <p>食品の分類に必要なカテゴリーを、追加/編集/削除します</p>
        
        <h2><a href="Food/top.php">食品</a></h2>
        <p>食品を、追加/編集/削除します</p>

    </div>
</body>
</html>