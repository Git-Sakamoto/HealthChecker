<?php
class Protein
{
    private $level;
    private $name;
    private $intake_min;
    private $intake_max;

    public function __construct($level, $name, $intake_min, $intake_max)
    {
        $this->level = $level;
        $this->name = $name;
        $this->intake_min = $intake_min;
        $this->intake_max = $intake_max;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getIntakeMin()
    {
        return $this->intake_min;
    }

    public function getIntakeMax()
    {
        return $this->intake_max;
    }

}