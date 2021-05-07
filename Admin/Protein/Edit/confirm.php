<?php
require_once '../../auth.php';
require "../../../Protein/Protein.php";

$formCount = $_SESSION['formCount'];
$beforeInfoArray = $_SESSION['beforeInfoArray'];
$afterLevelNameArray = $_POST['afterLevelNameArray'];
$afterMinArray = $_POST['afterMinArray'];
$afterMaxArray = $_POST['afterMaxArray'];

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
<title>たんぱく質計算機　管理機能　編集</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">たんぱく質計算機　管理機能　編集</div>
        <p>以下の内容で情報を更新します</p>
            <?php $afterInfoArray = array(); ?>
            <?php for($i = 0; $i < $formCount; $i++) : ?>
                <?php
                $beforeInfo = unserialize($beforeInfoArray[$i]);
                $levelId = $beforeInfo->getLevel();
                
                $afterLevelName = $afterLevelNameArray[$i];
                $afterMin = $afterMinArray[$i];
                $afterMax = $afterMaxArray[$i];

                $afterInfo = new Protein($levelId, $afterLevelName, $afterMin, $afterMax);
                array_push($afterInfoArray, serialize($afterInfo));
                ?>
                <p>
                <b>（<?php echo $i + 1; ?>）</b>
                <br>
                運動レベルID：<?php echo $beforeInfo->getLevel(); ?>
                </p>
                <p>
                <b>更新前</b>
                <br>
                運動レベル名：<?php echo $beforeInfo->getName(); ?>
                <br>
                最小摂取たんぱく質量：<?php echo $beforeInfo->getIntakeMin(); ?>g
                <br>
                最大摂取たんぱく質量：<?php echo $beforeInfo->getIntakeMax(); ?>g
                </p>
                
                <p>
                <b>更新後</b>
                運動レベル名：<?php echo $afterLevelName; ?>
                <br>
                最小摂取たんぱく質量：<?php echo $afterMin; ?>g
                <br>
                最大摂取たんぱく質量：<?php echo $afterMax; ?>g
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