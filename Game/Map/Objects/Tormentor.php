<?php

class Tormentor
{
    // static properties of tormentor in patch 7.33c
    const magicResist = 55;
    const baseHitPoint = 2500;
    const hpRegen = 100;



    // dynamic properties of tormentor in patch 7.33c
    private $spawn;
    private $AdditionalHitPoint = ($this->spawn - 1) * 200 ;
    private $hpNow;


    public function __construct($spawn = null)
    {
        if (!$spawn)
        {
            $this->spawn = 0;
        }
        else
        {
            
        }
        $this->hpNow = self::baseHitPoint + $this->AdditionalHitPoint;
    }




    

    
}