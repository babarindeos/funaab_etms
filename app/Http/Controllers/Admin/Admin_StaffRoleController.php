<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StaffRole;
use App\Models\Staff;
use App\Models\AssignRole;

class Admin_StaffRoleController extends Controller
{
    //
    public function index()
    {
        $roles = StaffRole::orderBy('name','asc')->paginate(20);
        return view('admin.roles.index', compact('roles'));
    }

    public function assign_role(StaffRole $role)
    {
        $staff = Staff::orderBy('surname', 'asc')->get();
        $assigned = AssignRole::orderBy('created_at', 'desc')->get();

        return view('admin.roles.assign_role', compact('staff', 'role', 'assigned'));
    }

    public function store_assign_role(Request $request, StaffRole $role)
    {
        $request->validate([
            'user' => 'required|string'
        ]);

        try
        {
            $create = AssignRole::create([
                'staff_role_id' => $role->id,
                'user_id' => $request->user
            ]);

            if ($create)
            {
                $data = [
                    'error' => true,
                    'status' => 'success',
                    'message' => 'The Staff has been assigned to the role'
                ];
            }
            else
            {
                $data = [
                    'error' => true,
                    'status' => 'fail',
                    'message' => 'An error occurred assigning the role to the Staff'
                ];

            }

        }
        catch(\Exception $e)
        {
            $data = [
                'error' => true,
                'status' => 'fail',
                'message' => $e->getMessage()
            ];
        }

        return redirect()->back()->with($data);

    }

    public function remove_assigned_role(AssignRole $assigned_role)
    {
        $assigned_role->delete();

        return redirect()->back();
    }
}
