<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'homePage',
        ]]);
    }

    public function homePage()
    {
        $rooms = Room::latest('created_at');
        return view('rooms', compact('rooms'));
    }
}
