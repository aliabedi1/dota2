<?php

class Tormentor
{
    // static properties of tormentor in patch 7.33c
    public const name = 'Tormentor ';
    public const magicResistPercentage = 55;
    public const armor = 20;
    private const baseHitPoint = 2500;
    private const HpIncreasePerRespawn = 200;
    public const hpRegen = 100;
    public const hpRegenIncreasePerRespawn = 100;
    public const firstRespawnTime = 1200;
    private const respawnTimeDuration = 600;
    public const returnDamagePercentage = 90;
    public const returnDamagePercentageIncreasePerDeath = 20;
    public const returnDamageTypes = [
        'PURE','PHYSICAL','MAGICAL'
    ];

    
    
    // dynamic properties of tormentor in patch 7.33c
    private $time;
    private $spawnedCount;
    private $diedAt;



    public function __construct(bool $start = true)
    {
       if($start)
       {
            $this->makeTorment();
       }
    }

    // manage game time
    private function startTime()
    {
        $this->time = 0;
    }
    private function setTime(int $time)
    {
        $this->time = $time;
    }

    private function getTime()
    {
        return $this->time;
    }

    private function setSpawnedCount(int $spawnedCount)
    {
        if($this->hasSpawnedYet(self::name . 'cant spawn before 20:00 minutes'))
        {
            $this->spawnedCount = 0;
        }
        $this->spawnedCount = $spawnedCount;
    }

    private function getSpawnedCount()
    {
        return $this->spawnedCount;
    }

    private function spawn() : bool
    {
        if($this->isSpawnable())
        {
            $this->spawnedCount ++;
            $this->setTimeForSpawns();
            echo self::name .'spawned\n';
            return true;
        }
        return false;
    }

    private function spawnMany($count) : bool
    {
        if($this->isSpawnable() && $this->isSpawnableManyTimes($count))
        {
            $this->spawnedCount += $count;
            $this->setTimeForSpawns($count);
            echo self::name .'spawned ' .$count . ' times';
            return true;
        }
        return false;
    }

    private function isSpawnable() : bool
    {
        if($this->hasSpawnedYet(self::name . 'cant respawn before 20:00 minutes\n'))
        {
            return false;
        }
        return true;
    }
    private function isSpawnableManyTimes($count) : bool
    {
        $sForTimes = $count == 1 ? ' time' : ' times';
        $message = self::name . ' cant spawn '. $count . $sForTimes;
        $availableTime = $this->getAvailableTime();
        if($availableTime <= 0)
        {
            echo $message;
            return false;
        }
        $availableCount = $availableTime / self::respawnTimeDuration; 
        return $count == $availableCount;
    }
    private function getAvailableTime()
    {
        if($this->hasSpawnedYet(self::name . ' didn\'t respawn'))
        {
            return 0;
        }
        if($this->diedAt)
        {
            return $availableTime = $this->time - $this->diedAt;  
        }
        
        return $availableTime = $this->time - self::firstRespawnTime;
    }

    private function setTimeForSpawns($count = null)
    {
        if($count)
        {
            if($this->diedAt)
            {
                return $this->setTime($this->diedAt + ($count * self::respawnTimeDuration));
            }
            return $this->setTime(self::firstRespawnTime + ($count * self::respawnTimeDuration));
            
        }
        else
        {
            return $this->setTime(self::firstRespawnTime);
        }
    }

    private function getNextRespawnTime()
    {
        if($this->hasSpawnedYet())
        {
            return self::firstRespawnTime;
        }
        if($this->diedAt)
        {
            return $this->diedAt + self::respawnTimeDuration;
        }
        return 0;
    }

    private function kill($time = null)
    {
        $timeNow = $time ?? $this->time;
        if($this->isKillabe())
        {
            $this->setTime($timeNow);
            $this->diedAt = $timeNow;
        }
        return false;
    }


    private function isKillabe() : bool
    {
        if($this->hasSpawnedYet("cant kill " . self::name .'because it has not been spawned yet'))
        {
            return false;
        }
        if($this->isRespawning(self::name .'is alraedy dead'))
        {
            return false;
        }
        return true;

    }

    private function getBaseHP()
    {
        return self::baseHitPoint;
    }

    private function getCurrentHP()
    {
        if($this->hasSpawnedYet(self::name ."has not been spawned yet"))
        {
            return 0;
        }
        if($this->isRespawning(self::name .'is dead and respawn in ' . $this->convertTime($this->getNextRespawnTime()) . " with " . $this->getFutureHP() .' hp'))
        {
            return 0;
        }
        return $this->calculateHP();
    }


    private function calculateHP($count = 0)
    {
        return self::baseHitPoint + (($this->spawnedCount + $count) * self::HpIncreasePerRespawn);
    }

    public function getFutureHP($count = 1)
    {
        if($this->hasSpawnedYet())
        {
            return self::baseHitPoint;
        }
        else
        {
            $this->calculateHP($count);
        }
    }

    private function hasSpawnedYet($message = null)
    {
        $condition = $this->time < self::firstRespawnTime;
        if($message && $condition)
        {
            echo $message . '\n';
        }
        return $condition;
    }

    private function isRespawning($message = null)
    {
        $condition = $this->time < $this->diedAt;
        if($message && $condition)
        {
            echo $message . '\n';
        }
        return $condition;
    }

    private function convertTime($seconds)
    {
        $minutes = $seconds / 60;
        return $minutes.":".($minutes%$seconds);
    }



    private function makeTorment()
    {
        $this->setTime(self::firstRespawnTime);
        $this->spawn();
    }

    
    private function addTime(int $time)
    {
        $this->time += $time; 
    }


    private function minusTime(int $time)
    {
        $this->time -= $time; 
    }


}