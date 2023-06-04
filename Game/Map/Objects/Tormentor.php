<?php

class Tormentor
{
    // static properties of tormentor in patch 7.33c
    const name = 'Tormentor';
    const magicResist = 55;
    const baseHitPoint = 2500;
    const hpRegen = 100;
    const firstRespawnTime = 1200;

    
    
    // dynamic properties of tormentor in patch 7.33c
    private $time = 0;
    private $killedTime;
    private $nextRespawnTime = $this->killedTime + 600;
    private $spawn = 0;
    private $AdditionalHitPoint = ($this->spawn - 1) * 200 ;
    private $hpNow;


    public function __construct($time = 0)
    {
        if ($time > 0)
        {
            if($time >= self::firstRespawnTime)
            {
                if($this->killedTime && $time > $this->killedTime)
                {
                    $this->spawn += 1;
                }
                $this->spawn = 1;
            }
            $this->spawn = 0;
            $this->notRespawned();
        }
        else
        {
            $this->time = 0;
        }
        $this->hpNow = self::baseHitPoint + $this->AdditionalHitPoint;
    }



    private function notRespawned()
    {
        return self::name . 'is not spawned';
    }










}