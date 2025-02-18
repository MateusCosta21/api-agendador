<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeetingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'room'        => new RoomResource($this->whenLoaded('room')), // Carrega a relação da sala
            'user'        => $this->user_id,
            'title'       => $this->title,
            'description' => $this->description,
            'start_time'  => \Carbon\Carbon::parse($this->start_time)->format('Y-m-d H:i:s'),
            'end_time'    => \Carbon\Carbon::parse($this->end_time)->format('Y-m-d H:i:s'),
            'status'      => $this->status,
            'created_at'  => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at'  => \Carbon\Carbon::parse($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
