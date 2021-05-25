<?php
require '../auth.php';
require "../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
<title>たんぱく質計算機　管理機能</title>
<script type="text/javascript">
function check(){
    const checkBox = document.getElementsByClassName("form-check-input");

	let count = 0;

	for (let i = 0; i < checkBox.length; i++) {
	    if (checkBox[i].checked) {
	        count++;
	    }
	}
	
	if(count > 0){
	    return true; // 送信を実行
	}else{
		window.alert('チェックされていません');
		return false;
	}
}
</script>
</head>
<body>
    <?php include "../header.html" ?>
    <div class="container">
        <div class="smallTitle">たんぱく質計算機　管理機能</div>
        <?php if($result = $databaseManager->selectAllProtein()) : ?>
            <form action="" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">レベルID</th>
                            <th scope="col">レベル名</th>
                            <th scope="col">最少摂取たんぱく質量</th>
                            <th scope="col">最大摂取たんぱく質量</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <?php
                            $levelId = $row[$databaseManager->protein_level];
                            $levelName = $row[$databaseManager->protein_name];
                            $min = $row[$databaseManager->protein_intake_min];
                            $max = $row[$databaseManager->protein_intake_max];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="form-check-input" name="idArray[]" value="<?php echo $levelId; ?>"></td>
                                <td><?php echo $levelId; ?></td>
                                <td><?php echo $levelName; ?></td>
                                <td><?php echo $min; ?></td>
                                <td><?php echo $max; ?></td>
                                <td>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Edit/input.php" name="levelId" value="<?php echo $levelId; ?>">編集</button>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Delete/confirm.php" name="levelId" value="<?php echo $levelId; ?>">削除</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <button class="btn btn-outline-primary" type="submit" formaction="Edit/input.php" name="levelId" value="multiple" onClick="return check();">選択項目を編集</button>
                <button class="btn btn-outline-primary" type="submit" formaction="Delete/confirm.php" name="levelId" value="multiple" onClick="return check();">選択項目を削除</button>
            </form>
        <?php else : ?>
            <p>データの取得に失敗しました</p>
        <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='Register/input.php'">新規登録</button>
    </div>
</body>
</html>