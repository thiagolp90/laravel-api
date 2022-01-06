<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MessagesController extends Controller
{
    // public function index($from, $to)
    public function index()
    {
        $users = User::all();
        $from = $users->first()->id;
        $to = $users->last()->id;

        $messages = Cache::remember('messages', 60, function () use($from, $to) {
            return Message::where(function($query) use($from, $to){
                $query->where('user_id', $from)
                    ->where('messageable_type', 'App\Models\User')
                    ->where('messageable_id', $to);
            })->orWhere(function($query) use($from, $to){
                $query->where('user_id', $to)
                    ->where('messageable_type', 'App\Models\User')
                    ->where('messageable_id', $from);
            })
                ->oldest()
                ->get();
        });


        return MessageResource::collection($messages);
    }
}
