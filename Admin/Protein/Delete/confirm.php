<?php
require_once '../../auth.php';
require "../../../Protein/Protein.php";

require "../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

if($_POST['levelId'] == 'multiple'){
    //複数選択の場合
    $levelIdArray = $_POST['idArray'];
}else{
    //単一選択の場合
    $levelIdArray = array($_POST['levelId']);
}

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
<title>たんぱく質計算機　管理機能　削除</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">たんぱく質計算機　管理機能　削除</div>
        <p>以下の情報を削除します</p>
        <?php
        $deleteLevelArray = array(); //完了画面で情報を表示するために使用
        $formCount = 0; //正常に情報を取得できたレベルIDの数
        ?>
        <?php foreach($levelIdArray as $levelId) : ?>
            <?php if($result = $databaseManager->selectProtein($levelId)) : ?>
                <?php
                $formCount++;

                $row = $result->fetch(PDO::FETCH_ASSOC);
                $levelName = $row[$databaseManager->protein_name];
                $min = $row[$databaseManager->protein_intake_min];
                $max = $row[$databaseManager->protein_intake_max];

                $protein = new Protein($levelId, $levelName, $min, $max);
                array_push($deleteLevelArray, serialize($protein));
                ?>
                    
                <p>
                <b>（<?php echo $formCount; ?>）</b>
                <br>
                運動レベルID：<?php echo $levelId; ?>
                <br>
                運動レベル名：<?php echo $levelName; ?>
                <br>
                最小摂取たんぱく質量：<?php echo $min; ?>g
                <br>
                最大摂取たんぱく質量：<?php echo $max; ?>g
                </p>
            <?php else : ?>
                <p>運動レベル：<?php echo $levelId; ?>の情報を取得できませんでした</p>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if($formCount > 0) : ?>
            <?php
            $_SESSION['formCount'] = $formCount;
            $_SESSION['deleteLevelArray'] = $deleteLevelArray;
            ?>
            <form method="post" action="complete.php">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
            <input class="btn btn-outline-primary" type="submit" value="確定">
        </form>
        <?php else : ?>
            <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
        <?php endif; ?>  
    </div>
</body>
</html>