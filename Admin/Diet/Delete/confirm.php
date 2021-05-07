<?php
require_once '../../auth.php';
require "../../../Diet/Action.php";

require "../../../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

if($_POST['id'] == 'multiple'){
    //複数選択の場合
    $idArray = $_POST['idArray'];
}else{
    //単一選択の場合
    $idArray = array($_POST['id']);
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
<title>ダイエット計算機　管理機能　削除</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">ダイエット計算機　管理機能　削除</div>
        <p>以下の情報を削除します</p>
        <?php
        $deleteActionArray = array(); //完了画面で情報を表示するために使用
        $formCount = 0; //正常に情報を取得できたIDの数
        ?>
        <?php foreach($idArray as $id) : ?>
            <?php if($row = $databaseManager->selectAction($id)) : ?>
                <?php
                $formCount++;
                
                $name = $row[$databaseManager->action_name];
                $time = $row[$databaseManager->action_time];
                $mets = $row[$databaseManager->action_mets];

                $action = new Action($id, $name, $time, $mets);
                array_push($deleteActionArray, serialize($action));
                ?>
                
                <p>
                <b>（<?php echo $formCount; ?>）</b>
                <br>
                行動：<?php echo $name; ?>
                <br>
                1回あたりの時間（分）：<?php echo $time; ?>
                <br>
                運動強度（METs）：<?php echo $mets; ?>
                </p>
            <?php else : ?>
                <p>情報を取得できませんでした</p>
            <?php endif; ?>
        <?php endforeach; ?>

        <?php if($formCount > 0) : ?>
            <?php
            $_SESSION['formCount'] = $formCount;
            $_SESSION['deleteActionArray'] = $deleteActionArray;
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