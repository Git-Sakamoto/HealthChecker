<?php
class Action
{
    private $id;
    private $name;
    private $time;
    private $mets;

    public function __construct($id, $name, $time, $mets)
    {
        $this->id = $id;
        $this->name = $name;
        $this->time = $time;
        $this->mets = $mets;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getTime()
    {
        return $this->time;
    }

    public function getMets()
    {
        return $this->mets;
    }

}