<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CellUser;
use App\Models\Announcement;
use Carbon\Carbon;
use App\Http\Classes\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\AnnouncementComment;

class Staff_CircleAnnouncementController extends Controller
{
    //
    public function announcements(CellUser $circle)
    {
        

        $announcements = Announcement::where('cell_id', $circle->cell_id)
                                      ->orderBy('id', 'desc')
                                      ->paginate();
       


        return view('staff.circles.announcements')->with(['circle' => $circle, 'announcements' => $announcements]);
    }

    public function create_announcement(CellUser $circle)
    {
        return view('staff.circles.create_announcement', compact('circle'));
    }

    public function store_announcement(Request $request, CellUser $circle)
    {
        $formfields = $request->validate([
            'subject' => 'required',
            'message' => 'required|max:300'
        ]);

        $formfields['cell_id'] = $circle->cell_id;
        $formfields['link'] = $request->input('link');

        $file = '';
        $fileSize = '';
        $fileType = '';
        try
        {
            if ($request->hasFile('file'))
            {
                $currentDateTime = Carbon::now()->format('Ymd_His');
                $filename = $currentDateTime.'_'.$circle->cell_id.'_'.auth()->user()->id;
                $filename = $filename.".";
    
                $file = $request->file('file');
                $fileSize = Document::getDocumentSize($file);
                $fileType = Document::getDocumentType($file);
    
                $new_filename = $filename.$file->getClientOriginalExtension();
    
                $file->storeAs('announcements', $new_filename);    
            }

            $formfields['file'] = 'announcements/'.$new_filename;
            $formfields['filesize'] = $fileSize;
            $formfields['filetype'] = $fileType;
            $formfields['user_id'] = Auth::user()->id;


            $created = Announcement::create($formfields);

            if ($created)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Announcement has been successfully published'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred creating the Announcement'
                ];

            }

    
        }
        catch(\Exception $e)
        {

                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred -'.$e->getMessage()
                ];

        }

        return redirect()->back()->with($data);

    }


    public function show_announcement(CellUser $circle, Announcement $announcement)
    {
        $messages = AnnouncementComment::where('cell_id', $circle->cell_id)->orderBy('id', 'desc')->get();

        return view('staff.circles.show_announcement', compact('circle', 'announcement', 'messages'));
    }


    public function store_announcement_comment(Request $request, CellUser $circle, Announcement $announcement)
    {
        $formfields = $request->validate([
            'message' => 'required'
        ]);

        try
        {
            $formfields['cell_id'] = $circle->cell_id;
            $formfields['user_id'] = Auth::user()->id;

            AnnouncementComment::create($formfields);
        }
        catch(\Exception $e)
        {

        }

        return redirect()->back();
    }




}
