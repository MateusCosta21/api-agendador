<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository
{
    public function __construct(protected Room $model) {}
    
    public function create(array $data){
        return $this->model->create($data);
    }
    public function getById(int $id){
        return $this->model->find($id);
    }
    public function update(int $id, array $data){
        $this->model->where('id', $id)->update($data);
        return $this->model->find($id);
    }
}
