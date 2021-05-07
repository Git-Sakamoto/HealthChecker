<?php
require_once '../../auth.php';

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
<title>たんぱく質計算機　管理機能　新規登録</title>
</head>
<body>
    <?php include "../../header.html" ?>
    <div class="container">
        <div class="smallTitle">たんぱく質計算機　管理機能　新規登録</div>
        <form method="post" action="complete.php">
            <p>
            運動レベルID：
            <input type="text" name="levelId" required>
            </p>

            <p>
            運動レベル名：
            <input type="text" name="levelName" required>
            </p>

            <p>
            最小摂取たんぱく質量：
            <input type="number" step="0.1" name="min" required>
            g
            </p>

            <p>
            変更後の最大摂取たんぱく質量：
            <input type="number" step="0.1" name="max" required>
            g
            </p>
            
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <button class="btn btn-outline-primary" type="button" onclick="location.href='../top.php'">戻る</button>
            <input class="btn btn-outline-primary" type="submit" value="登録">
        </form>
    </div>
</body>
</html>