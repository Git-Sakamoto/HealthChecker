<?php
require_once '../../auth.php';
require "../../../Diet/Action.php";

$formCount = $_SESSION['formCount'];
$beforeInfoArray = $_SESSION['beforeInfoArray'];
$afterNameArray = $_POST['afterNameArray'];
$afterTimeArray = $_POST['afterTimeArray'];
$afterMetsArray = $_POST['afterMetsArray'];

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
<title>ダイエット計算機　管理機能　編集</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">ダイエット計算機　管理機能　編集</div>
        <p>以下の内容で情報を更新します</p>
            <?php
            $afterInfoArray = array();
            ?>
            <?php for($i = 0; $i < $formCount; $i++) : ?>
                <?php
                $beforeInfo = unserialize($beforeInfoArray[$i]);
                $id = $beforeInfo->getId();
                
                $afterName = $afterNameArray[$i];
                $afterTime = $afterTimeArray[$i];
                $afterMets = $afterMetsArray[$i];

                $afterInfo = new Action($id, $afterName, $afterTime, $afterMets);
                array_push($afterInfoArray, serialize($afterInfo));
                ?>
                
                <p>
                <b>（<?php echo $i + 1; ?>）</b>
                <br>
                <b>更新前</b>
                <br>
                行動：<?php echo $beforeInfo->getName(); ?>
                <br>
                1回あたりの時間（分）：<?php echo $beforeInfo->getTime(); ?>
                <br>
                運動強度（METs）：<?php echo $beforeInfo->getMets(); ?>
                </p>
                
                <p>
                <b>更新後</b>
                <br>
                行動：<?php echo $afterName; ?>
                <br>
                1回あたりの時間（分）：<?php echo $afterTime; ?>
                <br>
                運動強度（METs）：<?php echo $afterMets; ?>
                </p>
            <?php endfor; ?>
            <?php $_SESSION['afterInfoArray'] = $afterInfoArray; ?>
            <form action = "complete.php" method="POST">
                <input type="hidden" name="token" value="<?php echo $token; ?>">
                <button class="btn btn-outline-primary" type="button" onclick="history.back();">戻る</button>
                <input class="btn btn-outline-primary" type="submit" value="確定">
            </form>
    </div>
</body>
</html>