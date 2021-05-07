<?php
class DatabaseManager
{
    
    //proteinテーブル
    public $protein_table = 'protein';
    public $protein_level = 'level'; //運動レベル　主キー
    public $protein_name = 'name'; //運動レベル名
    public $protein_intake_min = 'intake_min'; //最低摂取たんぱく質量
    public $protein_intake_max = 'intake_max'; //最大摂取たんぱく質量

    //actionテーブル
    public $action_table = 'action';
    public $action_id = 'id';
    public $action_name = 'name'; //行動名
    public $action_time = 'time'; //1回あたりの時間（分）
    public $action_mets = 'mets'; //運動強度

    //food_categoryテーブル
    public $food_category_table = 'food_category';
    public $food_category_category_id = 'category_id';
    public $food_category_category_name = 'category_name'; //食品分類名

    //foodテーブル
    public $food_table = 'food';
    public $food_category_id = 'category_id';
    public $food_name = 'name'; //食品名
    public $food_kcal = 'kcal'; //100gあたりのカロリー
    public $food_protein = 'protein'; //100gあたりのたんぱく質

    //userテーブル
    public $user_table = 'user';
    public $user_user_name = 'user_name';
    public $user_password = 'password';

    private function openDB()
    {
        $dbName = 'sakamototest_health';
        $host = 'mysql1.php.xdomain.ne.jp';
        $user = 'sakamototest_1';
        $password = 'testuser';

        $dsn = "mysql:dbname=$dbName;host=$host";
        
        return new PDO($dsn, $user, $password);
    }

    public function selectAllProtein()
    {
        $dbh = $this->openDB();
        $sth = $dbh->prepare("SELECT * FROM $this->protein_table order by $this->protein_intake_min ASC");
        $sth->execute();
        return $sth;
    }

    public function selectProtein($level)
    {
        $sql = "
        SELECT *
        FROM $this->protein_table
        WHERE $this->protein_level = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$level);

        $sth->execute();
        return $sth;
    }

    public function insertProtein($level, $name, $min, $max)
    {
        $sql = "
        INSERT INTO $this->protein_table
        VALUES(?,?,?,?)
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$level);
        $sth->bindValue(2,$name);
        $sth->bindValue(3,$min);
        $sth->bindValue(4,$max);
        
        return $sth->execute();
    }
    
    public function updateProtein($level, $name, $min, $max)
    {
        $sql = "
        UPDATE $this->protein_table
        SET $this->protein_name = ?,$this->protein_intake_min = ?,$this->protein_intake_max = ?
        WHERE $this->protein_level = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$name);
        $sth->bindValue(2,$min);
        $sth->bindValue(3,$max);
        $sth->bindValue(4,$level);
        
        return $sth->execute();
    }

    public function deleteProtein($level)
    {
        $sql = "
        DELETE FROM $this->protein_table
        WHERE $this->protein_level = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$level);
        
        return $sth->execute();
    }

    public function selectAllAction()
    {
        $dbh = $this->openDB();
        $sth = $dbh->prepare("SELECT * FROM $this->action_table order by $this->action_mets asc");
        $sth->execute();
        return $sth;
    }

    public function selectAction($id)
    {
        $sql = "
        SELECT *
        FROM $this->action_table
        WHERE $this->action_id = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$id);

        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function insertAction($name, $time, $mets)
    {
        $sql = "
        INSERT INTO $this->action_table ($this->action_name, $this->action_time, $this->action_mets)
        VALUES(?,?,?)
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$name);
        $sth->bindValue(2,$time);
        $sth->bindValue(3,$mets);
        
        return $sth->execute();
    }

    public function updateAction($id, $name, $time, $mets)
    {
        $sql = "
        UPDATE $this->action_table
        SET $this->action_name = ?,$this->action_time = ?,$this->action_mets = ?
        WHERE $this->action_id = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$name);
        $sth->bindValue(2,$time);
        $sth->bindValue(3,$mets);
        $sth->bindValue(4,$id);
        
        return $sth->execute();
    }

    public function deleteAction($id)
    {
        $sql = "
        DELETE FROM $this->action_table
        WHERE $this->action_id = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$id);
        
        return $sth->execute();
    }

    public function selectAllFoodCategory()
    {
        $sql = "
        SELECT *
        FROM $this->food_category_table
        ORDER BY $this->food_category_category_name = '穀類' DESC
        ";
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        $sth->execute();
        return $sth;
    }

    public function selectFoodCategory($categoryId)
    {
        $sql = "
        SELECT *
        FROM $this->food_category_table
        WHERE $this->food_category_category_id = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$categoryId);

        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public function insertFoodCategory($categoryId, $categoryName)
    {
        $sql = "
        INSERT INTO $this->food_category_table
        VALUES(?,?)
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$categoryId);
        $sth->bindValue(2,$categoryName);
        
        return $sth->execute();
    }

    public function updateFoodCategory($categoryId, $categoryName)
    {
        $sql = "
        UPDATE $this->food_category_table
        SET $this->food_category_category_id = ?,$this->food_category_category_name = ?
        WHERE $this->food_category_category_id = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$categoryId);
        $sth->bindValue(2,$categoryName);
        
        return $sth->execute();
    }

    public function updateFoodTableCategoryId($categoryId)
    {
        $sql = "
        UPDATE $this->food_table
        SET $this->food_category_id = ?
        WHERE $this->food_category_id = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$categoryId);
        $sth->bindValue(2,$categoryId);
        
        return $sth->execute();
    }

    //DBに外部キーが設定できないため、削除するカテゴリーIDが使用中か確認する
    //削除件数をreturnする
    public function deleteFoodCategory($categoryId)
    {
        $sql = "
        DELETE food_category
        FROM food_category
        LEFT OUTER JOIN food
        ON  food_category.category_id = food.category_id
        WHERE food_category.category_id = ?
        AND food.category_id IS NULL
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$categoryId);
        
        $sth->execute();
        return $sth->rowCount();
    }
    
    public function selectAllFood()
    {
        $sql = "
        SELECT food_category.category_name, food.name, food.kcal, food.protein
        FROM food
        INNER JOIN food_category
        USING ( category_id )
        ORDER BY category_name = '穀類' DESC
        ";
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        $sth->execute();
        return $sth;
    }

    public function userSearch($userName, $password)
    {
        $sql = "
        SELECT *
        FROM $this->user_table
        WHERE $this->user_user_name = ? AND $this->user_password = ?
        ";
        
        $dbh = $this->openDB();
        $sth = $dbh->prepare($sql);
        
        $sth->bindValue(1,$userName);
        $sth->bindValue(2,$password);
        
        $sth->execute();
        $result = $sth->fetch();
        return $result;
    }
    
}