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
<title>ダイエット計算機　管理機能</title>
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
        <div class="smallTitle">ダイエット計算機　管理機能</div>
        <?php if($result = $databaseManager->selectAllAction()) : ?>
            <form action="" method="POST">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th scope="col">行動</th>
                            <th scope="col">1回あたりの時間（分）</th>
                            <th scope="col">運動強度（METs）</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <?php
                            $id = $row[$databaseManager->action_id];
                            $name = $row[$databaseManager->action_name];
                            $time = $row[$databaseManager->action_time];
                            $mets = $row[$databaseManager->action_mets];
                            ?>
                            <tr>
                                <td><input type="checkbox" class="form-check-input" name="idArray[]" value="<?php echo $id; ?>"></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $mets; ?></td>
                                <td>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Edit/input.php" name="id" value="<?php echo $id; ?>">編集</button>
                                    <button class="btn btn-outline-primary" type="submit" formaction="Delete/confirm.php" name="id" value="<?php echo $id; ?>">削除</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <button class="btn btn-outline-primary" type="submit" formaction="Edit/input.php" name="id" value="multiple" onClick="return check();">選択項目を編集</button>
                <button class="btn btn-outline-primary" type="submit" formaction="Delete/confirm.php" name="id" value="multiple" onClick="return check();">選択項目を削除</button>
            </form>
        <?php else : ?>
            <p>データの取得に失敗しました</p>
        <?php endif; ?>
        <button class="btn btn-outline-primary" type="button" onclick="location.href='Register/input.php'">新規登録</button>
    </div>
</body>
</html>