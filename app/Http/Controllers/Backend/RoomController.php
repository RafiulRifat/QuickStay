<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function editRoom($id)
    {
        $basic_facility = Facility::where('rooms_id', $id)->get();
        $multiimgs = MultiImage::where('rooms_id', $id)->get();
        $editData = Room::findOrFail($id);
        return view('backend.allroom.rooms.edit_rooms', compact('editData', 'basic_facility', 'multiimgs'));
    }

    public function updateRoom(Request $request, $id)
    {
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

        $room = Room::findOrFail($id);
        $room->update($request->except('image', 'facility_name', 'multi_img'));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('upload/roomimg'), $name_gen);
            $room->update(['image' => $name_gen]);
        }

        if ($request->facility_name) {
            Facility::where('rooms_id', $id)->delete();
            foreach ($request->facility_name as $facility) {
                Facility::create(['rooms_id' => $room->id, 'facility_name' => $facility]);
            }
<<<<<<< Updated upstream
    
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



    




  
=======
        }

        if ($request->multi_img) {
            MultiImage::where('rooms_id', $id)->delete();
            foreach ($request->multi_img as $file) {
                $imgName = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('upload/roomimg/multi_img/'), $imgName);
                MultiImage::create(['rooms_id' => $room->id, 'multi_img' => $imgName]);
            }
        }

        return redirect()->back()->with(['message' => 'Room Updated Successfully', 'alert-type' => 'success']);
    }

    public function multiImageDelete($id)
    {
        $deletedata = MultiImage::findOrFail($id);
        if (file_exists(public_path('upload/roomimg/multi_img/' . $deletedata->multi_img))) {
            unlink(public_path('upload/roomimg/multi_img/' . $deletedata->multi_img));
        }
        $deletedata->delete();
        return redirect()->back()->with(['message' => 'Multi Image Deleted Successfully', 'alert-type' => 'success']);
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        if (!empty($room->image) && file_exists(public_path('upload/roomimg/' . $room->image))) {
            unlink(public_path('upload/roomimg/' . $room->image));
        }

        $subimages = MultiImage::where('rooms_id', $room->id)->get();
        foreach ($subimages as $subimage) {
            if (file_exists(public_path('upload/roomimg/multi_img/' . $subimage->multi_img))) {
                unlink(public_path('upload/roomimg/multi_img/' . $subimage->multi_img));
            }
        }

        MultiImage::where('rooms_id', $room->id)->delete();
        Facility::where('rooms_id', $room->id)->delete();
        $room->delete();

        return redirect()->back()->with(['message' => 'Room Deleted Successfully', 'alert-type' => 'success']);
    }
>>>>>>> Stashed changes
}
