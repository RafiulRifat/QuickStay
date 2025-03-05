<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Facility;
use App\Models\MultiImage;
use Intervention\Image\Facades\Image;
use DB; // Import for using raw SQL queries

class RoomController extends Controller
{
    // Show Edit Room Page
    public function EditRoom($id)
    {
        $editData = DB::table('rooms as r')
            ->leftJoin('facilities as f', 'r.id', '=', 'f.rooms_id')
            ->leftJoin('multi_images as m', 'r.id', '=', 'm.rooms_id')
            ->select(
                'r.id',
                'r.roomtype_id',
                'r.total_adult',
                'r.total_child',
                'r.room_capacity',
                'r.price',
                'r.size',
                'r.view',
                'r.bed_style',
                'r.discount',
                'r.short_desc',
                'r.description',
                DB::raw('GROUP_CONCAT(DISTINCT f.facility_name) as facilities'),
                DB::raw('GROUP_CONCAT(DISTINCT m.multi_img) as multi_images')
            )
            ->where('r.id', $id)
            ->groupBy(
                'r.id', 
                'r.roomtype_id', 
                'r.total_adult', 
                'r.total_child', 
                'r.room_capacity', 
                'r.price', 
                'r.size', 
                'r.view', 
                'r.bed_style', 
                'r.discount', 
                'r.short_desc', 
                'r.description'
            )
            ->first();

        if (!$editData) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        // Convert facilities and multi_images from comma-separated string to array
        $editData->facilities = explode(',', $editData->facilities);
        $editData->multi_images = explode(',', $editData->multi_images);

        return view('backend.allroom.rooms.edit_rooms', compact('editData'));
    }

    // Update Room Information
    public function UpdateRoom(Request $request, $id)
    {
        // Validate Input
        $request->validate([
            'roomtype_id' => 'required|integer',
            'total_adult' => 'required|integer',
            'total_child' => 'nullable|integer',
            'room_capacity' => 'required|integer',
            'price' => 'required|numeric',
            'size' => 'required|string',
            'view' => 'required|string',
            'bed_style' => 'required|string',
            'discount' => 'nullable|numeric',
            'short_desc' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'multi_img.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'facility_name' => 'nullable|array',
        ]);

        $room = Room::find($id);
        if (!$room) {
            return redirect()->back()->with('error', 'Room not found.');
        }

        // Update Room Fields
        $room->update([
            'roomtype_id' => $request->roomtype_id,
            'total_adult' => $request->total_adult,
            'total_child' => $request->total_child,
            'room_capacity' => $request->room_capacity,
            'price' => $request->price,
            'size' => $request->size,
            'view' => $request->view,
            'bed_style' => $request->bed_style,
            'discount' => $request->discount,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
        ]);

        // Handle Single Image Upload (Trigger updates multi-images automatically)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(550, 850)->save('upload/roomimg/' . $imageName);
            $room->update(['image' => $imageName]);
        }

        // Update Facilities (Trigger auto-deletes old ones)
        if (!empty($request->facility_name)) {
            foreach ($request->facility_name as $facility) {
                Facility::create([
                    'rooms_id' => $room->id,
                    'facility_name' => $facility
                ]);
            }
        }

        // Handle Multi-Image Upload (Trigger auto-deletes old ones)
        if ($request->hasFile('multi_img')) {
            foreach ($request->file('multi_img') as $file) {
                $imgName = date('YmdHi') . $file->getClientOriginalName();
                $file->move('upload/roomimg/multi_img/', $imgName);

                MultiImage::create([
                    'rooms_id' => $room->id,
                    'multi_img' => $imgName
                ]);
            }
        }

        return redirect()->back()->with('success', 'Room Updated Successfully');
    }
}
