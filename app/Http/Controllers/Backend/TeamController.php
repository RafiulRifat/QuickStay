<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\BookArea; // Ensure this model exists
use Carbon\Carbon;

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

        public function DeleteTeam($id){

            $item = Team::findOrFail($id);
            $img = $item->image;
            unlink($img);

            Team::findOrFail($id)->delete();

            $notification = array(
                'message' => 'Team Image Deleted Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);


    
        }   // End Method 



// ================== Book Area ALL Methods ==================

public function BookArea() {
    $book = BookArea::find(1);
    return view('backend.bookarea.book_area', compact('book'));



} // End Method .







}

