<?php

class Tormentor
{
    // static properties of tormentor in patch 7.33c
    const name = 'Tormentor ';
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
            return self::name . 'cant respawn before 20:00 minute\n';
        }
        $this->$this = $spawnedCount;
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


    // todo: update time at killing or spawning








}