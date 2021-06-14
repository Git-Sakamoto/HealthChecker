<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<title>トップ</title>
</head>
<body>
    <?php include "header.html" ?>
    <div class="container">
        <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-header"><a href="Protein/calc.php">たんぱく質計算機</a></div>
            <div class="card-body text-primary">
                <p class="card-text">
                体重、運動レベルに応じて、1日に必要なたんぱく質量を計算します
                </p>
            </div>
        </div>
        
        <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-header"><a href="Diet/calc.php">ダイエット質計算機</a></div>
            <div class="card-body text-primary">
                <p class="card-text">
                基礎代謝量、入力された脂肪量を消費するためのカロリーを計算します
                </p>
            </div>
        </div>

        <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-header"><a href="Food/list.php">食品リスト</a></div>
            <div class="card-body text-primary">
                <p class="card-text">
                <a href="https://www.mext.go.jp/a_menu/syokuhinseibun/1365419.htm">日本食品標準成分表</a>から一部抜粋して、食品（100g）のカロリーとたんぱく質量を表示しています
                </p>
            </div>
        </div>

        <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-header"><a href="ObesityCheck/calc.php">肥満チェック</a></div>
            <div class="card-body text-primary">
                <p class="card-text">
                厚生労働省が公開している<a href="https://www.mhlw.go.jp/bunya/kenkou/eiyou/dl/h27-houkoku-05.pdf">身体状況調査の結果</a>を元に、簡易的に肥満の検査をします<br>
                ※使用データの都合上、15歳以上限定
                </p>
            </div>
        </div>

        <div class="card border-primary mb-3" style="max-width: 18rem;">
            <div class="card-header"><a href="Contact/form.php">お問い合わせ</a></div>
            <div class="card-body text-primary">
                <p class="card-text">
                お問い合わせ、要望、ご自由にどうぞ
                </p>
            </div>
        </div>
    </div>
</body>
</html>