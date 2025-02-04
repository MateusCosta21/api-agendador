<?php

namespace App\Services\Room;

use App\Repositories\RoomRepository;
use App\Repositories\RoomRepositoryInterface;
use Illuminate\Support\Facades\DB;


class RoomService
{

    public function __construct(protected RoomRepository $repository){}

    public function storeRoom(array $data){
        DB::beginTransaction();
        $room = $this->repository->create($data);
        DB::commit();
        return $room;
    }

}