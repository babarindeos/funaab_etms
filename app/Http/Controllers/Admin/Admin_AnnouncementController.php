<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Carbon\Carbon;
use App\Http\Classes\Document;
use Illuminate\Support\Facades\Auth;
use App\Models\AnnouncementComment;

class Admin_AnnouncementController extends Controller
{
    ////
        //
        public function index()
        {
            
    
            $announcements = Announcement::orderBy('id', 'desc')->paginate(20);
           
    
            return view('admin.announcements.index')->with(['announcements' => $announcements]);
        }
    
        public function create()
        {
            return view('admin.announcements.create');
        }
    
        public function store(Request $request)
        {
            $formFields = $request->validate([
                'subject' => 'required',
                'message' => 'required|max:2000'
            ]);
    
            
            $formFields['link'] = $request->input('link');
    
            $file = '';
            $fileSize = '';
            $fileType = '';
            try
            {
                if ($request->hasFile('file'))
                {
                    $currentDateTime = Carbon::now()->format('Ymd_His');
                    $filename = $currentDateTime.'_'.auth()->user()->id;
                    $filename = $filename.".";
        
                    $file = $request->file('file');
                    $fileSize = Document::getDocumentSize($file);
                    $fileType = Document::getDocumentType($file);
        
                    $new_filename = $filename.$file->getClientOriginalExtension();
        
                    $file->storeAs('announcements', $new_filename);    

                    $formFields['file'] = 'announcements/'.$new_filename;
                    $formFields['filesize'] = $fileSize;
                    $formFields['filetype'] = $fileType;
                }
    
               
                $formFields['user_id'] = Auth::user()->id;
    
    
                $created = Announcement::create($formFields);
    
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
    
    
        public function show(Announcement $announcement)
        {
            
            $comments = AnnouncementComment::where('announcement_id', $announcement->id)
                                             ->orderBy('id', 'desc')
                                             ->get();
    
            //$msg_body = $announcement->message;
    
            return view('admin.announcements.show', compact('announcement', 'comments'));
        }



        public function edit(Announcement $announcement)
        {
            return view('admin.announcements.edit', compact('announcement'));
        }
    

        public function update(Request $request, Announcement $announcement)
        {   
            
            //dd($request);

            $formfields = $request->validate([
                'subject' => 'required',
                'message' => 'required|max:2000'
            ]);
    
            
            $formfields['link'] = $request->input('link');
    
            $file = $announcement->file;
            $fileSize = $announcement->filesize;
            $fileType = $announcement->filetype;

            

            try
            {
                if ($request->hasFile('file'))
                {
                    $currentDateTime = Carbon::now()->format('Ymd_His');
                    $filename = $currentDateTime.'_'.auth()->user()->id;
                    $filename = $filename.".";
        
                    $file = $request->file('file');
                    $fileSize = Document::getDocumentSize($file);
                    $fileType = Document::getDocumentType($file);
        
                    $new_filename = $filename.$file->getClientOriginalExtension();
        
                    $file->storeAs('announcements', $new_filename);    

                    $formfields['file'] = 'announcements/'.$new_filename;
                    $formfields['filesize'] = $fileSize;
                    $formfields['filetype'] = $fileType;
                    $formfields['user_id'] = Auth::user()->id;
                }
    
                
                
    
    
                $update = $announcement->update($formfields);
    
                if ($update)
                {
                    $data = [
                        'error' => true,
                        'status' => 'success',
                        'message' => 'The Announcement has been successfully updated'
                    ];
                }
                else
                {
                    $data = [
                        'error' => true,
                        'status' => 'fail',
                        'message' => 'An error occurred updating the Announcement'
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
    
            }
    
            return redirect()->back();
        }
    

        public function delete_comment(AnnouncementComment $comment)
        {
            $comment->delete();
            return redirect()->back();
        }

        public function delete_file(Request $request)
        {
            dd($request);
        }

        public function confirm_delete(Announcement $announcement)
        {
            return view('admin.announcements.confirm_delete', compact('announcement'));
        }

        public function destroy(Announcement $announcement)
        {
            $announcement->delete();

            return redirect()->route('admin.announcements.index');
        }
}
