<?php

class Tormentor
{
    // static properties of tormentor in patch 7.33c
    const name = 'Tormentor';
    const magicResist = 55;
    const baseHitPoint = 2500;
    const hpRegen = 100;
    const firstRespawnTime = 1200;
    const respawnTimeDuration = 600;

    
    
    // dynamic properties of tormentor in patch 7.33c
    private $time;
    private $spawnedCount;
    private $diedAt;
    private $nextRespawnTime;



    public function __construct($time = 0)
    {
       $this->startTime();
    }

    // manage game time
    public function startTime()
    {
        $this->time = 0;
    }
    public function setTime(int $time)
    {
        $this->time = $time;
    }

    public function getTime()
    {
        return $this->time;
    }

    











}