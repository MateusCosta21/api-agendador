<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository
{
    public function __construct(protected Room $model) {}
    
    public function create(array $data){
        return $this->model->create($data);
    }
}
