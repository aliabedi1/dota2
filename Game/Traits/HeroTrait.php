<?php


namespace Game\Traits\HeroTrait;

trait HeroTrait
{
    protected const maxLevel = 30;
    protected const eachLevelXpBar = [
        1 => 240,
        2 => 400,
        3 => 520,
        4 => 600,
        5 => 680,
        6 => 760,
        7 => 800,
        8 => 900,
        9 => 1000,
        10 => 1100,
        11 => 1200,
        12 => 1300,
        13 => 1400,
        14 => 1500,
        15 => 1600,
        16 => 1700,
        17 => 1800,
        18 => 1900,
        19 => 2000,
        20 => 2200,
        21 => 2400,
        22 => 2600,
        23 => 2800,
        24 => 3000,
        25 => 4000,
        26 => 5000,
        27 => 6000,
        28 => 7000,
        29 => 7500,
        30 => 0
    ];

    public const talents = [
        1 => [1,2], 
        2 => [1,2], 
        3 => [1,2], 
        4 => [1,2], 
    ];

    public const baseHitPoint;
    public const baseHpRegen;
    public const baseMana;
    public const baseManaRegen;
    public const baseArmor;
    


}
