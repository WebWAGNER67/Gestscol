<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Imports\UsersListImport;
use App\Models\Formation;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function index()
    {
        $this->authorize('viewImportForm', \App\Models\User::class);

        $users = User::orderBy('nom')->paginate(15);

        return view('users', compact('users'));
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    public function import(Request $request)
    {
        $request->validate([
            'import_file' => [
                'required',
                'file',
                'mimes:xlsx,xls',
            ]
        ]);

        Excel::import(new UsersListImport, $request->file('import_file'));

        return redirect()->back()->with('status', 'Importation réussie !');
    }
}
