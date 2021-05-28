<?php
require "../Class/DatabaseManager.php";
$databaseManager = new DatabaseManager();

const GENDER_MAN = "man";
const GENDER_WOMAN = "woman";

function calcBmi($cmHeight, $weight)
{
    //BMI ＝ 体重kg ÷ (身長m)2
    $mHeight = $cmHeight / 100;
    return $weight / ($mHeight * $mHeight);
}
?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<title>肥満チェック</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/HealthChecker/stylesheet.css">
</head>
<body>
    <?php include "../header.html" ?>
    
    <div class="container">
        <!- 入力欄 ->
        <div class="smallTitle">肥満チェック</div>
        
        <p>
        厚生労働省が公開している<a href="https://www.mhlw.go.jp/bunya/kenkou/eiyou/dl/h27-houkoku-05.pdf">身体状況調査の結果</a>を元に、簡易的に肥満の検査をします
        </p>
        
        <form method="post" action="calc.php">
            <p>
            性別：
            <input type="radio" name="gender" value="<?php echo GENDER_MAN; ?>" checked="checked">男
            <input type="radio" name="gender" value="<?php echo GENDER_WOMAN; ?>">女
            </p>
            <p>年齢：<input type="number" name="age" required>歳</p>
            <p>身長：<input type="number" step="0.1" name="height" required>cm</p>
            <p>体重：<input type="number" step="0.1" name="bodyWeight" required>kg</p>
            <input type="submit" value="計算" class="btn btn-outline-primary">
            <input type="reset" value="クリア" class="btn btn-outline-primary">
        </form>

        <!- 結果表示 ->
        <?php if($_POST) : ?>
            <?php
            $gender = $_POST['gender'];
            $age = $_POST['age'];
            $height = $_POST['height'];
            $weight = $_POST['weight'];

            if(strcmp($gender, GENDER_MAN) == 0){
                $displayGender = '男性';
            }else{
                $displayGender = '女性';
            }
            
            $row = $databaseManager->selectBmi($gender, $age);  
            $minAge = $row[$databaseManager->bmi_min_age];
            $maxAge = $row[$databaseManager->bmi_max_age];
            $total = $row[$databaseManager->bmi_total];
            $skinny = $row[$databaseManager->bmi_skinny];
            $normal = $row[$databaseManager->bmi_normal];
            $obesity = $row[$databaseManager->bmi_obesity];
            ?>
            
            <div class="smallTitle">BMI</div>

            <p>
            <?php
            if($maxAge == 0){
                echo $minAge.'歳以上　'.$displayGender.'の調査結果';
            }else{
                echo $minAge.'歳～'.$maxAge.'歳　'.$displayGender.'の調査結果';
            }
            ?>
            <br>
            総数：<?php echo $total; ?>人
            <br>
            やせ（BMI18.5未満）：<?php echo $skinny; ?>人（<?php $total / $skinny; ?>%）
            <br>
            普通（BMI18.5以上、25未満）：<?php echo $normal; ?>人（<?php $total / $normal; ?>%）
            <br>
            肥満（BMI25以上）：<?php echo $obesity; ?>人（<?php $total / $obesity; ?>%）
            </p>

            <p>
            あなたのBMI：<?php calcBmi($height, $weight); ?>
            </p>
        <?php endif; ?>
    </div>
</body>
</html>