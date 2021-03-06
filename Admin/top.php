<?php
require "../auth.php";
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<title>健康計算機　管理機能</title>
</head>
<body>
    <?php include "header.html" ?>
    <div class="container">
        <h1>健康計算機　管理機能</h1>
        
        <h2><a href="Protein/top.php">たんぱく質計算機</a></h2>
        <p>たんぱく質量の計算に必要な「運動レベル」を、追加/編集/削除します</p>
        
        <h2><a href="Diet/top.php">ダイエット計算機</a></h2>
        <p>計算結果画面に表示する「行動別カロリー消費例」の「行動」を、追加/編集/削除します</p>

        <h2><a href="FoodList/top.php">食品リスト</a></h2>
        <p>リストに表示する「分類」「食品」を、追加/編集/削除します</p>
    </div>
</body>
</html>