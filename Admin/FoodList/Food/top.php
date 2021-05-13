<?php
require '../../auth.php';
require "../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

//編集機能で使用
unset($_SESSION['afterInfo']);
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
<title>食品リスト（食品）　管理機能</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">食品リスト（食品）　管理機能</div>
        
        <p>
        <a href="https://www.mext.go.jp/a_menu/syokuhinseibun/1365419.htm">日本食品標準成分表</a>のデータを使用しています
        <br>
        カロリー、たんぱく質：食品100gあたり
        </p>
        
        <?php if($result = $databaseManager->selectAllFood()) : ?>
            <form action="" method="POST">
                <?php $categoryArray = $result->fetchAll(PDO::FETCH_ASSOC|PDO::FETCH_GROUP); ?>
                <?php foreach($categoryArray as $category => $foodArray) : ?>
                    <div class="smallTitle"><?php echo $category; ?></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 40%">食品名</th>
                                <th scope="col">エネルギー</th>
                                <th scope="col">たんぱく質</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($foodArray as $food) : ?>
                            <tr>
                                <td><?php echo $food['name']; ?></td>
                                <td><?php echo $food['kcal']; ?>kcal</td>
                                <td><?php echo $food['protein']; ?>g</td>
                                <td>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Edit/input.php" name="categoryId" value="<?php echo $food['food_id']; ?>">編集</button>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Delete/confirm.php" name="categoryId" value="<?php echo $food['food_id']; ?>">削除</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>
            </form>
        <?php else : ?>
            <p>データの取得に失敗しました</p>
        <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='Register/input.php'">新規登録</button>
    </div>
</body>
</html>