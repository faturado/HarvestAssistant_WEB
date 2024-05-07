<?php

class Harvest extends Models
{
    public function harvests()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `harvests` 
        INNER JOIN farmers on harvests.farmer = farmers.id
        INNER JOIN crops on harvests.crop = crops.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
