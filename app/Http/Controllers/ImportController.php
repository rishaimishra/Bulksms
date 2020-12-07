<?php

namespace App\Http\Controllers;

use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function show(Request $request){

        if($request->has('q')){
            $q=$request->q;
            //dd($q);
            $users=User::where('name','like','%'.$q.'%')->orderBy('id','desc')->get();
            //dd($users);
		}else{
            
        $users = User::where('guest', 1)->orderBy('id', 'desc')->get();
       }
        return view('import.usersimport')->with(['users'=>$users]);
    }

    public function store(Request $request){
        $file = $request->file('fileimport');
        Excel::import(new UsersImport,$file);

        return back()->withStatus('Excel file imported successfully');
    }
}
