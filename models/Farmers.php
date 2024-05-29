<?php

class Farmers extends Models{
    public function __construct($table = 'farmers') {
        parent::__construct($table);
    }
    
    public function crops(){
        $sql = "SELECT * FROM farmers
        JOIN crops ON farmers.crops = crops.id
        JOIN barangay ON farmers.barangay = barangay.id";

        $this->stmt = $sql; 

        return $this;
    }

    public function farmers($page = 1, $item_per_page = 10){
        $page = $page <= 0 ? 1 : $page; 
        $offset = ($page - 1) * $item_per_page;
        $sql = "SELECT farmers.*, barangay.barangay_name, user_levels.role, crops.crop_name FROM farmers
                JOIN crops ON farmers.crop_id = crops.id
                JOIN barangay ON farmers.barangay_id = barangay.id
                JOIN user_levels ON farmers.role_id = user_levels.id
                ORDER BY rsbsa_num ASC 
                LIMIT $item_per_page
                OFFSET $offset";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function farmer($rsbsa_num){
        $sql = "SELECT farmers.*, barangay.barangay_name, user_levels.role, crops.crop_name FROM farmers
                JOIN crops ON farmers.crop_id = crops.id
                JOIN barangay ON farmers.barangay_id = barangay.id
                JOIN user_levels ON farmers.role_id = user_levels.id
                WHERE rsbsa_num = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$rsbsa_num]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function role($info){
        $farmers = array_map(function($query){
            $stmt = $this->pdo->prepare("SELECT user_levels.role FROM {$this->table} JOIN user_levels ON farmers.role = user_levels.id WHERE rsbsa_num = ?");
            $stmt->execute([$query['rsbsa_num']]);
            $role = $stmt->fetch(PDO::FETCH_ASSOC);
            return [
                ...$query,
                ...$role
            ];
        }, $info);

        return $farmers;
    }
}