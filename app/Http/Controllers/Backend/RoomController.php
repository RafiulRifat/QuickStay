<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\Facility;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Models\RoomNumber;

class RoomController extends Controller
{

    public function EditRoom($id){
        $basic_facility = Facility::where('rooms_id', $id)->get();
        $multiimgs = MultiImage::where('rooms_id', $id)->get();
        $editData = Room::find($id);
        $allroomNo = RoomNumber::where('rooms_id',$id)->get();
        return view('backend.allroom.rooms.edit_rooms',compact('editData','basic_facility','multiimgs','allroomNo'));
    }
    




    public function UpdateRoom(Request $request, $id) {
        // Validate request
        $validated = $request->validate([
            'roomtype_id' => 'required|exists:room_types,id', 
            'total_adult' => 'required|integer',
            'total_child' => 'required|integer',
            'room_capacity' => 'required|integer',
            'price' => 'required|numeric',
            'size' => 'required|string',
            'view' => 'required|string',
            'bed_style' => 'required|string',
            'discount' => 'required|numeric',
            'short_desc' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        // Find room by ID
        $room = Room::find($id);
        if (!$room) {
            return response()->json(['message' => 'Room not found'], 404);
        }
    
        // Update room properties
        $room->roomtype_id = $request->roomtype_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity = $request->room_capacity;
        $room->price = $request->price;
        $room->size = $request->size;
        $room->view = $request->view;
        $room->bed_style = $request->bed_style;
        $room->discount = $request->discount;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description;
        $room->status = 1;
    
        // Image upload handling
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/roomimg'), $name_gen);
            $room->image = $name_gen;
        }
    
        $room->save();
    
        return response()->json(['message' => 'Room updated successfully']);






//// Update for Facility Table

if ($request->facility_name == NULL) {
    $notification = array(
        'message' => 'Sorry! Not Any Basic Facility Select',
        'alert-type' => 'error'
    );
    return redirect()->back()->with($notification);
} else {
    Facility::where('rooms_id', $id)->delete();
    $facilities = count($request->facility_name);
    for ($i = 0; $i < $facilities; $i++) {
        $fcount = new Facility();
        $fcount->rooms_id = $room->id;
        $fcount->facility_name = $request->facility_name[$i];
        $fcount->save();
    } // end for
} // end else




// Update Multi Image

if($room->save()){
    $files = $request->multi_img;
    if(!empty($files)){
        $subimage = MultiImage::where('rooms_id',$id)->get()->toArray();
        MultiImage::where('rooms_id',$id)->delete();
    }
}

if(!empty($files)){
    foreach($files as $file){
        $imgName = date('YmdHi').$file->getClientOriginalName();
        $file->move('upload/roomimg/multi_img/',$imgName);

        $subimage = new MultiImage();
        $subimage->rooms_id = $room->id;
        $subimage->multi_img = $imgName;
        $subimage->save();
    }
}

$notification = array(
    'message' => 'Room Updated Successfully',
    'alert-type' => 'success'
);

return redirect()->back()->with($notification);



    } //end method







    
    public function StoreRoomNumber(Request $request,$id){

        $data = new RoomNumber();
        $data->rooms_id = $id;
        $data->room_type_id = $request->room_type_id;
        $data->room_no = $request->room_no;
        $data->status = $request->status;
        $data->save();

        $notification = array(
            'message' => 'Room Number Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    }//End Method 



    public function EditRoomNumber($id){

        $editroomno = RoomNumber::find($id);
        return view('backend.allroom.rooms.edit_room_no',compact('editroomno'));

    }//End Method 

    public function UpdateRoomNumber(Request $request, $id){

        $data = RoomNumber::find($id);
        $data->room_no = $request->room_no;
        $data->status = $request->status;
        $data->save();

       $notification = array(
            'message' => 'Room Number Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification); 

    }//End Method 


    public function DeleteRoomNumber($id){

        RoomNumber::find($id)->delete();

        $notification = array(
            'message' => 'Room Number Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification); 

    }//End Method

    public function MultiImageDelete($id){

        $deletedata = MultiImage::where('id', $id)->first();
    
        if($deletedata){
    
            $imagePath = $deletedata->multi_img;
    
            // Check if the file exists before unlinking
            if (file_exists($imagePath)) {
                unlink($imagePath);
                echo "Image Unlinked Successfully";
            } else {
                echo "Image does not exist";
            }
    
            // Delete the record form database


            // Delete the record from database
             MultiImage::where('id', $id)->delete();


    }

    $notification = array(
        'message' => 'Multi Image Deleted Successfully',
        'alert-type' => 'success'
    );
    
    return redirect()->back()->with($notification);

}// end method



public function DeleteRoom(Request $request, $id)
{
    $room = Room::find($id);

    if (!$room) {
        return redirect()->back()->with([
            'message' => 'Room Not Found',
            'alert-type' => 'error'
        ]);
    }

    // Delete the main room image if it exists
    if (!empty($room->image) && file_exists(public_path('upload/roomimg/' . $room->image))) {
        @unlink(public_path('upload/roomimg/' . $room->image));
    }

    // Delete sub-images if they exist
    $subimages = MultiImage::where('rooms_id', $room->id)->get();
    foreach ($subimages as $subimage) {
        if (!empty($subimage->multi_img) && file_exists(public_path('upload/roomimg/multi_img/' . $subimage->multi_img))) {
            @unlink(public_path('upload/roomimg/multi_img/' . $subimage->multi_img));
        }
    }

    // Delete related records
    RoomType::where('id', $room->roomtype_id)->delete();
    MultiImage::where('rooms_id', $room->id)->delete();
    Facility::where('rooms_id', $room->id)->delete();
    

    // Delete the room
    $room->delete();

    // Prepare notification
    return redirect()->back()->with([
        'message' => 'Room Deleted Successfully',
        'alert-type' => 'success'
    ]);
}





  
}
