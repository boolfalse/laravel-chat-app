<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $rooms = Room::all();
        return view('rooms', compact('rooms'));
    }

    public function generateRandomString($defLength = 10) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $length = strlen($chars);
        $string = '';
        for ($i=0; $i<$defLength; $i++) {
            $string .= $chars[rand(0, $length-1)];
        }
        return $string;
    }

    public function addRoom(Request $request)
    {
        if($request->ajax()){
            $rules = [
                'room_name' => 'required|max:100',
            ];
            $messages = [
                'room_name.required' => 'Room Name required!',
                'room_name.max' => 'Room Name can contain max 100 characters!',
            ];
            if(!empty($request->room_image)){ //ss TODO: check this and do with Laravel validation functionalities
                $rules['room_image'] = 'image|mimes:jpg,jpeg,png|max:1048576';
                $messages['room_image.mimes'] = 'Image can have "JP(E)G", "PNG" extension!';
                $messages['room_image.max'] = 'Image is too big!';
            }
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ]);
            }else{
                $access = "public"; // default public
                if($request->get('room_access') == "protected"){
                    $access = "protected";
                }
                if($request->get('room_access') == "private"){
                    $access = "private";
                }
                $token_key = $request->get('token_key');

                $room = new Room();
                $room->name = $request->get('room_name');
                $file = $request->room_image;
                if(!empty($file)){
                    $random_token = $this->generateRandomString();
                    $fileName = $random_token.'.'.$file->getClientOriginalExtension();
                    $room->image = $fileName;
                }
                if($access=="private" && strlen($token_key)>0){
                    $room->token_key = $token_key;
                }
                $room->access = $access;
                $room->user()->associate(Auth::user()->id);
                $room->save();

                if(!empty($file)){
                    $file->move(public_path('uploads'), $fileName);
                }
                return response()->json([
                    'success' => true,
                ]);
            }
        }
    }
}
