<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use App\Models\AvailabilityList;
use App\Models\FailUpload;

class Admin_AvailabilityListController extends Controller
{
    //
    public function index()
    {
        $availability_list = AvailabilityList::with(['staff.department'])
                            ->whereHas('staff')
                            ->join('staff', 'availability_lists.user_id', '=', 'staff.user_id')
                            ->join('departments', 'staff.department_id', '=', 'departments.id')
                            ->join('colleges', 'departments.college_id', '=', 'colleges.id')
                            ->select(
                                'availability_lists.*',
                                'staff.fileno',
                                'staff.surname',
                                'staff.firstname',
                                'departments.name as department_name',
                                'departments.code as department_code',
                                'colleges.name as college_name',
                                'colleges.code as college_code'
                            )
                            ->orderBy('departments.name')
                            ->orderBy('staff.fileno')
                            ->get();

        


        return view('admin.availability_list.index', compact('availability_list'));
    }

    public function create()
    {
        $availability_list = AvailabilityList::with(['staff.department'])
                            ->whereHas('staff')
                            ->join('staff', 'availability_lists.user_id', '=', 'staff.user_id')
                            ->join('departments', 'staff.department_id', '=', 'departments.id')
                            ->join('colleges', 'departments.college_id', '=', 'colleges.id')
                            ->select(
                                'availability_lists.*',
                                'staff.fileno',
                                'staff.surname',
                                'staff.firstname',
                                'departments.name as department_name',
                                'departments.code as department_code',
                                'colleges.name as college_name',
                                'colleges.code as college_code'
                            )
                            ->orderBy('departments.name')
                            ->orderBy('staff.fileno')
                            ->get();
        
        $failuploads = FailUpload::get();

        return view('admin.availability_list.create', compact('availability_list', 'failuploads'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        // Read the CSV document file
        $file = $request->file('document');

        $filePath = $file->getRealPath();
        $data = array_map('str_getcsv', file($filePath));

        if (count($data) > 0)
        {
            $header = ["fileno"];

            $formFields = array();
            $failedRecords = array();

            foreach($data as $row)
            {
                $row = array_combine($header, $row);
                $doc_fileno = $row['fileno'];

                // getm the user record using fileno
                $staff = Staff::where('fileno', $doc_fileno)->first();

                if ($staff != null)
                {
                    $user_id = $staff->user->id;
                    array_push($formFields, $user_id);
                }
                else
                {
                    array_push($failedRecords, $doc_fileno);
                }
            }

            // Record the failed transactions
            foreach($failedRecords as $fail)
            {
                FailUpload::create([
                    'fileno' => $fail
                ]);
            }


            // Create a transaction and insert the operation data into the database

            DB::beginTransaction();

            try
            {
                foreach($formFields as $row)
                {
                    AvailabilityList::create([
                        'user_id' => $row
                    ]);
                    
                }
                DB::commit();
            }
            catch(\Exception $e)
            {
                DB::rollBack();
                
                $data = [
                    'error'=>true,
                    'status' => 'fail',
                    'message' => $e->getMessage()
                ];

                return redirect()->back()->with($data);
            }

            return redirect()->back();
        }
    }

    public function destroy(AvailabilityList $user)
    {
        $user->delete();

        return redirect()->back();
    }

    public function confirm_truncate()
    {
        return view('admin.availability_list.confirm_truncate');
    }

    public function truncate_list()
    {
        AvailabilityList::truncate();

        return redirect()->route('admin.exams.availability_list.index');
    }
}
