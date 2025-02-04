<?php

namespace App\Services\Room;

use App\Repositories\RoomRepository;
use App\Repositories\RoomRepositoryInterface;
use Exception;
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
    public function updateRoom(int $id, array $data){
        DB::beginTransaction();
        $room = $this->repository->getById($id);
        if(!$room){
            DB::rollBack();
            throw new Exception("O id não existe");
        }
        DB::commit();
        return $this->repository->update(id: $room->id, data: $data);
    }

}