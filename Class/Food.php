<?php
class Food
{
    private $foodId;
    private $categoryId;
    private $categoryName;
    private $foodName;
    private $kcal;
    private $protein;

    public function __construct($foodId, $categoryId, $categoryName, $foodName, $kcal, $protein)
    {
        $this->foodId = $foodId;
        $this->categoryId = $categoryId;
        $this->categoryName = $categoryName;
        $this->foodName = $foodName;
        $this->kcal = $kcal;
        $this->protein = $protein;
    }

    public function getFoodId()
    {
        return $this->foodId;
    }
    
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getCategoryName()
    {
        return $this->categoryName;
    }

    public function getFoodName()
    {
        return $this->foodName;
    }

    public function getKcal()
    {
        return $this->kcal;
    }

    public function getProtein()
    {
        return $this->protein;
    }
    
}