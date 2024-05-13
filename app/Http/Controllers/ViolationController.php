<?php

namespace App\Http\Controllers;

use App\Models\Violation;
use App\Models\User;
use App\Models\Order;
use App\Models\Comment;
use App\Exports\ViolationExport;
use Illuminate\Http\Request;
use App\Exports\ExportViolationsQuery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class ViolationController extends Controller
{
    //


    public function __construct()
    {
        $this->middleware('authAdmin')->except('createregister', 'register', 'login', 'auth', 'profile', 'logout', 'editProfile', 'updateProfile');
    }
    public function index(Request $request)
    {
        if (!empty($request->search)) {
            return view('admin.violation.index')->with([
                "violations" => Violation::where('id', 'like', "%{$request->search}%")
                    ->orWhere('name', 'like', "%{$request->search}%")
                    ->orWhere('type', 'like', "%{$request->search}%")
                    ->orWhere('penalty_type', 'like', "%{$request->search}%")
                    ->orWhere('submission_status', 'like', "%{$request->search}%")
                    ->paginate(5),
                'violationCount' => Violation::count(),
                'userWithViolationCount' => User::whereNotNull('violations')->count(),
            ]);
        } else {
            return view('admin.violation.index')->with([
                "violations" => Violation::latest()->paginate(6),
                'violationCount' => Violation::count(),
                'userWithViolationCount' => User::whereNotNull('violations')->count(),
            ]);
        }
    }
    public function removeViolation($id)
    {
        $violation = Violation::findOrFail($id);
        $violation->delete();
        return redirect()->route('violation.index')->with(['succes s' => 'Violation Deleted ']);
    }

    public function getUrchivedViolations()
    {
        return view('admin.violation.index')->with([
            "violations" => Violation::whereNotNull('deleted_at')->withTrashed()->paginate(5),
            'violationCount' => Violation::count(),
            'violationsArchivedCount' => User::whereNotNull('deleted_at')->withTrashed()->count(),
            'userWithViolationCount' => User::whereNotNull('violations')->count(),
        ]);
    }
    public function Unurchive($id)
    {
        $user = User::where('id', $id)->withTrashed()->first();
        $user->deleted_at = null;
        $user->save();
        return redirect()->route('users.index')->with(['success' => 'User Unarchived']);
    }




    /*************** User Excel methods *******************/
    // export all usres
    public function ExportAllViolation()
    {
        return Excel::download(new ViolationExport, 'violations-collection.xlsx'); // Export collection of violations
    }

    // export one user using query class
    public function ExportViolation($id)
    {
        $user = Violation::where('id', $id)->withTrashed()->first();
        return (new ExportViolationsQuery($id))->download($violation->name . '.xlsx');
    }



    public function create()
    {
        //render create user page

        return view('admin.violation.create');
    }

    // rgister function
    public function addViolation(Request $request)
    {
        // dd($request->year_level);
        $request->validate([
            'name' => 'required|max:60|string',
            'type' => 'required|max:60|string',
            'description' => 'required|max:240|string',
            'penalty_type' => 'required|max:60|string',
            'submission_status' => 'required|max:60|string',
        ]);
        Violation::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'penalty_type' => $request->penalty_type,
            'submission_status' => $request->submission_status,
        ]);
        return redirect()->route('violation.index')->with([
            'success' => 'Violation Created '
        ]);
    }    

    
    // edit user profile function
    public function editProfile($id)
    {
        $user = User::findOrFail($id);
        /*if ($user->admin) {
            return view('profiles.edit')->with(['admin' => $user]);
        } else {
            return view('profiles.edit')->with(['user' => $user]);
        }*/
        return view('profiles.edit')->with(['user' => $user]);
    }
}
