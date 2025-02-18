<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMeetingRequest;
use App\Http\Requests\UpdateMeetingRequest;
use App\Http\Resources\MeetingResource;
use App\Services\Meeting\MeetingService;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class MeetingController extends Controller
{
    public function __construct(protected MeetingService $service) {}

    public function store(StoreMeetingRequest $request){
        $meeting = $this->service->storeMeeting($request->validated());
        return (new MeetingResource($meeting))
        ->response()
        ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateMeetingRequest $request, int $id){
        $meeting = $this->service->updateMeeting($id, $request->all());
        return (new MeetingResource($meeting))
        ->response()
        ->setStatusCode(Response::HTTP_OK);
    }

}
