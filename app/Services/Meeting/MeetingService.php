<?php

namespace App\Services\Meeting;

use App\Repositories\MeetingRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class MeetingService
{

    public function __construct(protected MeetingRepository $repository){}

    public function storeMeeting(array $data)
    {
        DB::beginTransaction();
        $conflict = $this->repository->checkScheduleConflict($data['room_id'], $data['start_time'], $data['end_time']);
        if ($conflict) {
            throw ValidationException::withMessages([
                'start_time' => 'O horário selecionado já está reservado para esta sala.',
            ]);
        }
        $meeting = $this->repository->create($data);
        DB::commit();
        return $meeting;
    }

}