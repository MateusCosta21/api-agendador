<?php

namespace App\Repositories;

use App\Models\Meeting;

class MeetingRepository
{

    public function __construct(protected Meeting $model){}

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
