<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\BookArea;
use App\Models\Room;
use Carbon\Carbon;
use Intervention\Image\Facades\Image; 

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allData = RoomType::orderBy('id','desc')->get();
        return view('backend.allroom.roomtype.view_roomtype',compact('allData'));

    
}
public function AddRoomType(){
    return view('backend.allroom.roomtype.add_roomtype');
}// End Method 
public function RoomTypeStore(Request $request){

   
    $roomtype_id = RoomType::insertGetId([
        'name' => $request->name,
        'created_at' => Carbon::now(),
    ]);
    
    Room::insert([
        'roomtype_id' => $roomtype_id,
    ]);






    $notification = array(
        'message' => 'RoomType Inserted Successfully',
        'alert-type' => 'success'
    );

    return redirect()->route('room.type.list')->with($notification);
}// End Method 

}
