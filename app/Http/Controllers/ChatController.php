<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $roomsCountInPage = 5;

    public function roomsPage(Request $request)
    {
        $rooms = Room::latest('created_at')->paginate($this->roomsCountInPage); // distinct for removing repetitions
        if ($request->ajax()) {
            return view('load_rooms', compact('rooms'))->render();
        }else{
            return view('rooms', compact('rooms'));
        }
    }
}
