<?php
require "../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

const GENDER_MAN = "man";
const GENDER_WOMAN = "woman";

function calcMetabolism($gender, $age, $height, $bodyWeight)
{
    if(strcmp($gender, GENDER_MAN) == 0){
        //男性の基礎代謝の計算式　13.397×体重kg＋4.799×身長cm−5.677×年齢+88.362
        return 13.397 * $bodyWeight + 4.799 * $height - 5.677 * $age + 88.362;
    }else{
        //女性の基礎代謝の計算式　9.247×体重kg＋3.098×身長cm−4.33×年齢+447.593
        return 9.247 * $bodyWeight + 3.098 * $height - 4.33 * $age + 447.593;
    }
}

function calcTotalKcal($weight)
{
    $kcal = 7200; //脂肪1kgの消費に必要なカロリー数
    return $kcal * $weight;
}

function calcDailyKcal($totalKcal, $day)
{
    return $totalKcal / $day;
}

function calcActionKcal($mets, $bodyWeight, $time)
{
    return $mets * $bodyWeight * ($time / 60) * 1.05;
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<title>ダイエット計算機</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
</head>
<body>
    <?php include "../header.html" ?>
    
    <div class="container">
        <!- 入力欄 ->
        <div class="smallTitle">ダイエット計算機</div>
        <p>
            基礎代謝量、入力された脂肪量を消費するためのカロリーを計算します<br>
            7200kcal/脂肪1kgの消費に必要なカロリー
        </p>
        <form method="post" action="calc.php">
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-1 pt-0">性別</legend>
                <div class="col-sm-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="radioMan" value="<?php echo GENDER_MAN; ?>" checked="checked">
                    <label class="form-check-label" for="radioMan">男</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="radioWoman" value="<?php echo GENDER_WOMAN; ?>">
                    <label class="form-check-label" for="radioWoman">女</label>
                </div>
            </fieldset>

            <div class="row mb-3">
                <label class="col-sm-1 col-form-label">年齢</label>
                <div class="col-sm-2">
                    <input class="form-control" type="number" min="15" name="age" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label">身長（cm）</label>
                <div class="col-sm-2">
                    <input class="form-control" type="number" step="0.1" min="1" name="height" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-1 col-form-label">体重（kg）</label>
                <div class="col-sm-2">
                    <input class="form-control" type="number" step="0.1" min="1" name="bodyWeight" required>
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="col-sm-1 col-form-label">消費脂肪量（kg）</label>
                <div class="col-sm-2">
                    <input class="form-control" type="number" step="0.1" min="1" name="fatWeight" required>
                </div>
            </div>

            <input type="submit" value="計算" class="btn btn-outline-primary">
            <input type="reset" value="クリア" class="btn btn-outline-primary">
        </form>

        <!- 結果表示 ->
        <?php if($_POST) : ?>
            <?php
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $height = $_POST['height'];
            $bodyWeight = $_POST['bodyWeight'];
            $fatWeight = $_POST['fatWeight'];

            $metabolism = calcMetabolism($gender, $age, $height, $bodyWeight);
            $totalKcal = calcTotalKcal($fatWeight);
            ?>
            
            <!- 基礎代謝量 ->
            <div class="smallTitle">基礎代謝量</div>
            <?php
            if(strcmp($gender, GENDER_MAN) == 0){
                $displayGender = '男性';
            }else{
                $displayGender = '女性';
            }
            ?>
            <p><?php echo $age.'歳　'.$displayGender.'　'.$height.'cm　'.$bodyWeight.'kgの基礎代謝は<b>'.$metabolism.'kcal</b>です'; ?></p>

            <!- 必要消費カロリー ->
            <div class="smallTitle">必要消費カロリー</div>
            <p><b><?php echo $fatWeight; ?>kg</b>を消費するために必要なカロリーは、<b><?php echo $totalKcal; ?>kcal</b>です</p>
            
            <!- 期間別カロリー消費例 ->
            <div class="smallTitle">期間別カロリー消費例</div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">消費脂肪量</th>
                        <th scope="col">減量期間</th>
                        <th scope="col">1日あたりの消費カロリー数</th>
                    </tr>
                </thead>
                <tbody>
                    <!- 30日毎、90日分を表示 ->
                    <?php for($i = 30; $i <= 90; $i+=30) : ?>
                    <tr>
                        <td><?php echo $fatWeight; ?>kg</td>
                        <td><?php echo $i; ?>日</td>
                        <td>基礎代謝量（<?php echo $metabolism; ?>kcal）　＋　運動消費カロリー　－　摂取カロリー　＞　<?php echo calcDailyKcal($totalKcal, $i); ?>kcal</td>
                    </tr>
                    <?php endfor; ?>
                </tbody>
            </table>

            <!- 行動別カロリー消費例 ->
            <div class="smallTitle">行動別カロリー消費例</div>
            <?php if($result = $databaseManager->selectAllAction()) : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">行動</th>
                            <th scope="col">1回あたりの時間（分）</th>
                            <th scope="col">運動強度（METs）</th>
                            <th scope="col">体重が<?php echo $bodyWeight ?>kgの場合の消費エネルギー</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch(PDO::FETCH_ASSOC)) : ?>
                            <?php
                            $name = $row[$databaseManager->action_name];
                            $time = $row[$databaseManager->action_time];
                            $mets = $row[$databaseManager->action_mets];
                            ?>
                            <tr>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $time; ?></td>
                                <td><?php echo $mets; ?></td>
                                <td><?php echo calcActionKcal($mets, $bodyWeight, $time).'kcal'; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p>データを取得できませんでした</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>