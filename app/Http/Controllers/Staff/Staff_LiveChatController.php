<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\LiveChat;

class Staff_LiveChatController extends Controller
{
    //
    public function index(Exam $exam)
    {
        $comments = LiveChat::orderBy('created_at', 'desc')->get();
        
        return view('staff.live_chat.index', compact('exam', 'comments'));
    }

    public function store(Request $request, Exam $exam)
    {
        $formFields = $request->validate([
            'message' => 'required'
        ]);

        $formFields['user_id'] = Auth::user()->id;
        $formFields['exam_id'] = $exam->id;

        try
        {
            LiveChat::create($formFields);
            
        }
        catch(\Exception $e)
        {

        }

        return redirect()->back();
    }

    public function destroy(LiveChat $comment)
    {
        $comment->delete();

        return redirect()->back();
    }
}
