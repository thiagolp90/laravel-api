<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'from' => new UserResource(User::findOrFail($this->user_id)),
            'to' => new UserResource($this->messageable),
            'message' => $this->message,
            'attachments' => AttachmentResource::collection($this->attachments),
            'created_at' => $this->created_at
        ];
    }
}
