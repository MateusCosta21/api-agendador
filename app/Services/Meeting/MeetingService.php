<?php

namespace App\Services\Meeting;

use App\Repositories\MeetingRepository;
use Illuminate\Support\Facades\DB;

class MeetingService
{

    public function __construct(protected MeetingRepository $repository){}

    public function storeMeeting(array $data){
        DB::beginTransaction();
        $meeting = $this->repository->create($data);
        DB::commit();
        return $meeting;
    }

}