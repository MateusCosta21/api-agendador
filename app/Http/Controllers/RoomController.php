<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoomRequest;
use App\Http\Resources\RoomResource;
use App\Services\Room\RoomService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RoomController extends Controller
{
    public function __construct(protected RoomService $service) {}

    public function store(StoreRoomRequest $request)
    {
        $room = $this->service->storeRoom($request->validated());
        return (new RoomResource($room))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id)
    {
        $room = $this->service->updateRoom($id, $request->all());
        return (new RoomResource($room))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }
}
