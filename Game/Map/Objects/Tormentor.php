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
    private $killedTime = 0;
    private $nextRespawnTime = $this->killedTime + 600;
    private $spawn;
    private $AdditionalHitPoint = ($this->spawn - 1) * 200 ;
    private $hpNow;


    public function __construct($time = 0)
    {
        if($time >= self::firstRespawnTime)
        {
            if($this->killedTime && $time > $this->killedTime)
            {
                $this->spawn += 1;
            }
            $this->spawn = 1;
        }
        else
        {
            $this->spawn = 0;
            $this->notRespawned();
        }

        $this->hpNow = self::baseHitPoint + $this->AdditionalHitPoint;
    }

    private function kill($time)
    {
        $this->killedTime = $time;
    }
    private function spawn()
    {
        $this->spawn += 1;
    }


    private function notRespawned()
    {
        return self::name . 'is not spawned';
    }










}