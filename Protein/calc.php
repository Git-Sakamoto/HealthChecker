<?php
require "Protein.php";
require "../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<title>たんぱく質計算機</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
</head>
<body>
    <?php include "../header.html" ?>
    <?php if($result = $databaseManager->selectAllProtein()) : ?>
        <?php
        $proteinArray = array();
        
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $level = $row[$databaseManager->protein_level];
            $name = $row[$databaseManager->protein_name];
            $min = $row[$databaseManager->protein_intake_min];
            $max = $row[$databaseManager->protein_intake_max];
            
            $proteinArray += array($level=>new Protein($level, $name, $min, $max));
        }
        ?>
        
        <div class="container">
            <div class="smallTitle">たんぱく質計算機</div>
            <p>体重、運動レベルに応じて、1日に必要なたんぱく質量を計算します</p>

            <form method="post" action="calc.php">
                <div class="row mb-3">
                    <label class="col-sm-1 col-form-label">体重（kg）</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="number" step="0.1" min="1" name="weight" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-1 col-form-label">運動レベル</label>
                    <div class="col-sm-auto">
                        <select class="form-select" name="level">
                            <?php foreach($proteinArray as $level=>$protein) : ?>
                                <option value = <?php echo $level ?>><?php echo $protein->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <input type="submit" value="計算" class="btn btn-outline-primary">
                <input type="reset" value="クリア" class="btn btn-outline-primary">
            </form>

            <!- 結果表示 ->
            <?php if($_POST) : ?>
                <?php
                $weight = $_POST['weight'];
                $selectLevel = $_POST['level'];
                
                $protein = $proteinArray[$selectLevel];
                $name = $protein->getName();
                $intakeMin = $protein->getIntakeMin();
                $intakeMax = $protein->getIntakeMax();
                ?>
                <p><?php echo $name.$weight; ?>kgの人に必要な、たんぱく質量（目安）</p>
                <p>
                    体重×<?php echo $intakeMin; ?>g
                    （<?php echo $weight * $intakeMin; ?>g）
                     ～ 
                    体重×<?php echo $intakeMax; ?>g
                    （<?php echo $weight * $intakeMax; ?>g）
                </p>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <p>データを取得できませんでした</p>
    <?php endif; ?>
</body>
</html>