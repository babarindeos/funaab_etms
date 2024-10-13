<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cell;
use App\Models\User;
use App\Models\AnnouncementPermissions;

class Admin_PermissionController extends Controller
{
    //
    public function index(Cell $cell, User $user)
    {
        $announcement = AnnouncementPermissions::where('cell_id', $cell->id)
                                                ->where('user_id', $user->id)
                                                ->first();
        

        return view('admin.circles.permissions', compact('cell', 'user', 'announcement'));
    }

    public function create_announcement_set(Request $request, Cell $cell, User $user)
    {       
            $formFields = [
                'cell_id' => $cell->id,
                'user_id' => $user->id,
                'create' => true
            ];

            AnnouncementPermissions::create($formFields);

            return redirect()->back();
    }

    public function create_announcement_on(Request $request, Cell $cell, User $user)
    {
         $announcement_permission = $announcement = AnnouncementPermissions::where('cell_id', $cell->id)
                                                    ->where('user_id', $user->id)
                                                    ->first();
         $announcement_permission->create = true;
         $announcement_permission->save();

         return redirect()->back();

    }

    public function create_announcement_off(Request $request, Cell $cell, User $user)
    {
        
        $announcement_permission = $announcement = AnnouncementPermissions::where('cell_id', $cell->id)
                                                    ->where('user_id', $user->id)
                                                    ->first();
        $announcement_permission->create = false;
        $announcement_permission->save();

        return redirect()->back();
    }
}
