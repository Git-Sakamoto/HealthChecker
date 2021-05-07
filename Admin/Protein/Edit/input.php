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
        <form method="post" action="confirm.php">
            <?php
            $beforeInfoArray = array(); //編集確認画面、編集完了画面で、変更前の情報と変更後の情報を比較表示するために使用
            $formCount = 0; //フォーム生成数（正常に情報を取得できたレベルIDの数）
            ?>
            <?php foreach($levelIdArray as $levelId) : ?>
                <?php if($result = $databaseManager->selectProtein($levelId)) : ?>
                    <?php
                    $formCount++;

                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $levelName = $row[$databaseManager->protein_name];
                    $min = $row[$databaseManager->protein_intake_min];
                    $max = $row[$databaseManager->protein_intake_max];

                    $beforeInfo = new Protein($levelId, $levelName, $min, $max);
                    array_push($beforeInfoArray, serialize($beforeInfo));
                    ?>
                    <p>
                    <b>更新前</b>
                    <b>（<?php echo $formCount; ?>）</b>
                    <br>
                    運動レベルID：<?php echo $levelId; ?>
                    </p>
                    <p>
                    変更前の運動レベル名：<?php echo $levelName; ?>
                    <br>
                    変更前の最小摂取たんぱく質量：<?php echo $min; ?>g
                    <br>
                    変更前の最大摂取たんぱく質量：<?php echo $max; ?>g
                    </p>
                    
                    <?php if(isset($_SESSION['afterInfoArray'])) : ?>
                        <?php $afterInfo = unserialize($afterInfo[$formCount-1]); ?>
                        <p>
                        <b>更新後</b>
                        運動レベル名：
                        <input type="text" name="afterLevelNameArray[]" value="<?php echo $afterInfo->getLevel(); ?>" required>
                        </p>
                        <p>
                        最小摂取たんぱく質量：
                        <input type="number" step="0.1" name="afterMinArray[]" value="<?php echo $afterInfo->getIntakeMin(); ?>" required>
                        g
                        </p>
                        <p>
                        最大摂取たんぱく質量：
                        <input type="number" step="0.1" name="afterMaxArray[]" value="<?php echo $afterInfo->getIntakeMax(); ?>" required>
                        g
                        </p>
                    <?php else : ?>
                        <p>
                        <b>更新後</b>
                        運動レベル名：
                        <input type="text" name="afterLevelNameArray[]" value="<?php echo $levelName; ?>" required>
                        </p>
                        <p>
                        最小摂取たんぱく質量：
                        <input type="number" step="0.1" name="afterMinArray[]" value="<?php echo $min; ?>" required>
                        g
                        </p>
                        <p>
                        最大摂取たんぱく質量：
                        <input type="number" step="0.1" name="afterMaxArray[]" value="<?php echo $max; ?>" required>
                        g
                        </p>
                    <?php endif; ?>
                <?php else : ?>
                    <p>レベルID：<?php echo $levelId; ?>の情報を取得できませんでした</p>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if($formCount > 0) : ?>
                <?php
                $_SESSION['formCount'] = $formCount;
                $_SESSION['beforeInfoArray'] = $beforeInfoArray;
                ?>
                <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
                <input class="btn btn-outline-primary" type="submit" value="更新">
            <?php else : ?>
                <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>