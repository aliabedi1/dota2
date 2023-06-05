<?php

class Tormentor
{
    // static properties of tormentor in patch 7.33c
    const name = 'Tormentor ';
    const magicResistPercentage = 55;
    const baseHitPoint = 2500;
    const HpIncreasePerRespawn = 200;
    const hpRegen = 100;
    const firstRespawnTime = 1200;
    const respawnTimeDuration = 600;
    const returnDamagePercentage = 80;
    const returnDamageTypes = [
        'PURE','PHYSICAL','MAGICAL'
    ];

    
    
    // dynamic properties of tormentor in patch 7.33c
    private $time;
    private $spawnedCount;
    private $diedAt;



    public function __construct($time = 0)
    {
       $this->startTime();
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
        if($this->time < self::firstRespawnTime)
        {
            return self::name . 'cant spawn before 20:00 minutes\n';
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
            echo self::name .'spawned';
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
        if($this->time < self::firstRespawnTime)
        {
            echo self::name . 'cant respawn before 20:00 minute\n';
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
        if($this->time < self::firstRespawnTime)
        {
            echo self::name . ' didn\'t respawn';
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
        if($this->time < self::firstRespawnTime)
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
        if($this->time < self::firstRespawnTime)
        {
            echo "cant kill " . self::name .'because it has not been spawned yet';
            return false;
        }
        if($this->time < $this->diedAt)
        {
            echo self::name .'is alraedy dead';
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
        $x= 'time';
        if($this->time < self::firstRespawnTime)
        {
            echo self::name ."has not been spawned yet";
            return 0;
        }
        if($this->time < $this->diedAt)
        {
            echo self::name .'is dead and respawn in ' . $x. " with" .$x .' hp';
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
        if($this->time < self::firstRespawnTime)
        {
            return self::baseHitPoint;
        }
        else
        {
            $this->calculateHP($count);
        }
    }







}