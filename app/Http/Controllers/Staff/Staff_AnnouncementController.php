<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Models\AnnouncementComment;
use Illuminate\Support\Facades\Auth;


class Staff_AnnouncementController extends Controller
{
    //
    public function index()
    {
        $announcements = Announcement::orderBy('id', 'desc')->paginate(20);
           
    
        return view('staff.announcements.index')->with(['announcements' => $announcements]);
    }

    public function show(Announcement $announcement)
    {
        
        $comments = AnnouncementComment::where('announcement_id', $announcement->id)
                                         ->orderBy('id', 'desc')
                                         ->get();

        //$msg_body = $announcement->message;

        return view('staff.announcements.show', compact('announcement', 'comments'));
    }

    public function store_comment(Request $request, Announcement $announcement)
    {

        $formfields = $request->validate([
            'message' => 'required'
        ]);

        try
        {
            $formfields['announcement_id'] = $announcement->id;
            $formfields['user_id'] = Auth::user()->id;           

            AnnouncementComment::create($formfields);
        }
        catch(\Exception $e)
        {
            dd($e->getMessage());
        }

        return redirect()->back();
    }


    public function delete_comment(AnnouncementComment $comment)
    {
        $comment->delete();
        return redirect()->back();
    }


    

   
}
