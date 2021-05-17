<?php
require_once '../../../auth.php';

require "../../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

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
<title>食品リスト（食品）　管理機能　新規登録</title>
<script type="text/javascript">
window.onload = function() {
    setCategoryName();
};

function setCategoryName(){
    var obj = document.getElementById('category');
    var index = obj.selectedIndex;
    var value = obj.options[index].value;
    var text  = obj.options[index].text;

    document.forms[0].categoryName.value=text;
}
</script>
</head>
<body>
    <?php include "../../../header.html" ?>
    <div class="container">
        <div class="smallTitle">食品リスト（食品）　管理機能　新規登録</div>
        <form method="post" name="form" action="complete.php">
            <p>
            カテゴリー：
            <select id="category" name="categoryId" onchange="setCategoryName()">
            <?php $result = $databaseManager->selectAllFoodCategory(); ?>
            <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                <?php
                $categoryId = $row[$databaseManager->food_category_category_id];
                $categoryName = $row[$databaseManager->food_category_category_name];
                ?>
                
                <option value="<?php echo $categoryId; ?>">
                <?php echo $categoryName; ?>
                </option>
            <?php endwhile; ?>
            </select>
            </p>

            <input type="hidden" name="categoryName" value="">

            <p>
            食品名：
            <input type="text" name="foodName" required>
            </p>

            <p>
            カロリー（食品100gあたり）：
            <input type="number" name="kcal" step="1" required>
            kcal
            </p>

            <p>
            たんぱく質（食品100gあたり）：
            <input type="number" name="protein" step="0.1" required>
            g
            </p>
            
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
            <input class="btn btn-outline-primary" type="submit" value="登録">
        </form>
    </div>
</body>
</html>