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

    public function checkScheduleConflict($roomId, $startTime, $endTime)
    {
        return Meeting::where('room_id', $roomId)
            ->where('status', '!=', 'canceled') 
            ->where(function ($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime])
                      ->orWhere(function ($q) use ($startTime, $endTime) {
                          $q->where('start_time', '<=', $startTime)
                            ->where('end_time', '>=', $endTime);
                      });
            })
            ->exists();
    }
   
}
