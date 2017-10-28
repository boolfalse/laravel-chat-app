<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;

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
            $image = $request->file('room_image');
            if(!empty($image)){ //ss TODO: check this and do with Laravel validation functionalities
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
                $access = "public"; // default public, we'll detect room access selected by user from front
                if($request->get('room_access') == "protected"){
                    $access = "protected";
                }
                if($request->get('room_access') == "private"){
                    $access = "private";
                }
                $token_key = $request->get('token_key');

                $room = new Room();
                $room->name = $request->get('room_name');
                if(!empty($image)){
                    $name_with_ext = $this->generateRandomString()  .'.'. $image->getClientOriginalExtension();
                    $path = public_path('uploads') . DIRECTORY_SEPARATOR . $name_with_ext;
                    Image::make($image->getRealPath())->resize(50, 50)->save($path);
                    $room->image = $name_with_ext;
                }
                if($access=="private" && !empty($token_key)){
                    $room->token_key = $token_key;
                }
                $room->access = $access;
                $room->user()->associate(Auth::user()->id);
                $room->save();

                return response()->json([
                    'success' => true,
                ]);
            }
        }
    }
}
