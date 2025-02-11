<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\BookArea;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class TeamController extends Controller
{
    public function AllTeam()
    {
        $team = Team::latest()->get();
        return view('backend.team.all_team', compact('team'));
    }

    public function AddTeam()
    {
        return view('backend.team.add_team');
    }

    public function StoreTeam(Request $request)
    {
        if ($request->file('image')) {
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('upload/team/'), $name_gen);
            $save_url = 'upload/team/' . $name_gen;

            Team::create([
                'name' => $request->name,
                'position' => $request->position,
                'facebook' => $request->facebook,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
        }

        return redirect()->route('all.team')->with([
            'message' => 'Team Data Inserted Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function EditTeam($id)
    {
        $team = Team::findOrFail($id);
        return view('backend.team.edit_team', compact('team'));
    }

    public function UpdateTeam(Request $request)
    {
        $team_id = $request->id;
        $team = Team::findOrFail($team_id);

        if ($request->file('image')) {
            $name_gen = hexdec(uniqid()) . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('upload/team/'), $name_gen);
            $save_url = 'upload/team/' . $name_gen;

            $team->update([
                'image' => $save_url,
            ]);
        }

        $team->update([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'updated_at' => Carbon::now(),
        ]);

        return redirect()->route('all.team')->with([
            'message' => 'Team Updated Successfully',
            'alert-type' => 'success'
        ]);
    }

    public function DeleteTeam($id)
    {
        $item = Team::findOrFail($id);
        $img = $item->image;
        unlink($img);

        Team::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Team Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    // ================== Book Area ALL Methods ==================

    public function BookArea()
    {
        $book = BookArea::find(1);
        return view('backend.bookarea.book_area', compact('book'));
    }

    public function BookAreaUpdate(Request $request)
    {
        $book_id = $request->id;

        // Validate image input
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Initialize file path
        $save_url = null;

        // Check if image is uploaded
        if ($request->hasFile('image')) {
            // Store the image using Laravel's store() method
            try {
                $image = $request->file('image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                // Save image to public/bookarea folder
                $save_url = $image->storeAs('public/bookarea', $name_gen);
            } catch (\Exception $e) {
                // Log error
                \Log::error('Error uploading image: ' . $e->getMessage());
                return redirect()->back()->withErrors('Image upload failed. Please try again.');
            }
        }

        // Update the BookArea model
        try {
            BookArea::findOrFail($book_id)->update([
                'short_title' => $request->short_title,
                'main_title' => $request->main_title,
                'short_desc' => $request->short_desc,
                'link_url' => $request->link_url,
                'image' => $save_url,
            ]);
        } catch (\Exception $e) {
            // Log error
            \Log::error('Error updating BookArea: ' . $e->getMessage());
            return redirect()->back()->withErrors('Failed to update Book Area. Please try again.');
        }

        // Return success notification
        return redirect()->back()->with([
            'message' => 'Book Area Updated Successfully' . ($save_url ? ' with image' : ''),
            'alert-type' => 'success'
        ]);
    }
}
