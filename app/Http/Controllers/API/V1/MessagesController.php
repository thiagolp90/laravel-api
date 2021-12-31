<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index($from, $to)
    {
        $messages = Message::where(function($query) use($from, $to){
            $query->where('user_id', $from)
                ->where('messageable_type', 'App\Models\User')
                ->where('messageable_id', $to);
        })->orWhere(function($query) use($from, $to){
            $query->where('user_id', $to)
                ->where('messageable_type', 'App\Models\User')
                ->where('messageable_id', $from);
        })
            ->get();

        return MessageResource::collection($messages);
    }
}
