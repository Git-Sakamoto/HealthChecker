<?php
require_once '../../../auth.php';
require "../../../../Class/Food.php";

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
<title>食品リスト（食品）　管理機能　編集</title>
</head>
<body>
    <?php include "../../../header.html" ?>
    <div class="container">
        <div class="smallTitle">食品リスト（食品）　管理機能　編集</div>
        <form method="post" action="confirm.php">
            <?php if($row = $databaseManager->selectFood($_POST['foodId'])) : ?>
                <?php
                $foodId = $_POST['foodId'];
                $beforeCategoryName = $row[$databaseManager->food_category_category_name];
                $beforeFoodName = $row[$databaseManager->food_name];
                $beforeKcal = $row[$databaseManager->food_kcal];
                $beforeProtein = $row[$databaseManager->food_protein];

                $beforeInfo = new Food($foodId, $categoryName, $foodName, $kcal, $protein);
                $_SESSION['beforeInfo'] = serialize($beforeInfo);
                ?>
                
                <p>
                <b>更新前</b>
                <br>
                カテゴリー：<?php echo $beforeCategoryName; ?>
                <br>
                食品名：<?php echo $beforeFoodName; ?>
                <br>
                カロリー：<?php echo $beforeKcal; ?>kcal
                <br>
                たんぱく質：<?php echo $beforeProtein; ?>g
                </p>
                    
                <?php if(isset($_SESSION['afterInfo'])) : ?>
                    <?php $afterInfo = unserialize($_SESSION['afterInfo']); ?>
                    <p>
                    <b>更新後</b>
                    <br>
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
                <?php else : ?>
                    <p>
                    <b>更新後</b>
                    <br>
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
<script type="text/javascript">
window.onload = function() {
    selectCategory('<?php echo $beforeCategoryName ?>');
};

function selectCategory(category){
    var select = document.forms[0].category;
 
	for(var i=0; i < select.options.length; i++){
		if(select.options[i].text === category){
			select.options[i].selected = true;
		}
	}
}
</script>
</html>