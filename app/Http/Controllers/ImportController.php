<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function show(){
        $users = User::where('guest', 1)
        ->orderBy('id', 'desc')
        ->paginate(4);

        return view('import.usersimport')->with('users', $users);
    }

    public function store(Request $request){
        $file = $request->file('fileimport');
        Excel::import(new UsersImport,$file);

        return back()->withStatus('Excel file imported successfully');
    }
}
