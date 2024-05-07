<?php

class Farmers extends Models{
    public function farmers(){
        $stmt = $this->pdo->prepare("SELECT * FROM farmers
        JOIN crops ON farmers.crops = crops.id
        JOIN barangay ON farmers.barangay = barangay.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}