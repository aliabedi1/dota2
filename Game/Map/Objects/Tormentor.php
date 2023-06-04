<?php

class Tormentor
{
    // static properties of tormentor in patch 7.33c
    const magicResist = 55;
    const baseHitPoint = 2500;
    const hpRegen = 100;
    const firstRespawnTime = 1200;

    
    
    // dynamic properties of tormentor in patch 7.33c
    private $time = 0;
    private $killedTime;
    private $nextRespawnTime = $this->killedTime + 600;
    private $spawn = 1;
    private $AdditionalHitPoint = ($this->spawn - 1) * 200 ;
    private $hpNow;


    public function __construct($spawn = null)
    {
        if ($spawn)
        {
            $this->spawn = $spawn;
        }
        $this->hpNow = self::baseHitPoint + $this->AdditionalHitPoint;
    }










}