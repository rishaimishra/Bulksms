<?php

namespace App\Http\Controllers;

use Exception;
use Validator;
use App\Models\AutoResponder;
use Illuminate\Http\Request;

class AutoResponderController extends Controller
{
    public function index()
    {
        $autoresponders = AutoResponder::all();

        return view('admin.users.autoresponder')->with(['autoresponders' => $autoresponders]);
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'keyword' => 'required',
                'message' => 'required',
            ]);

            if($validator->fails()){
                return back()->withErrors($validator);
            } else {
                if(AutoResponder::create($request->all())){
                    return  back()->with('success', 'Autoresponder keyword created successfully');
                } else {
                    return  back()->with('error', 'Something went wrong');
                }
            }
        } catch(Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            if($autoResponder = AutoResponder::find($id)){
                $autoResponder->keyword = $request->keyword;
                $autoResponder->message = $request->message;
                $autoResponder->save();

                return back()->with('success', 'Autoresponder keyword updated successfully.');
            } else {
                return back()->with('error', 'No Autoresponder keyword found.');
            }

        } catch(Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }   
    }

    public function delete($id)
    {
        try {
            $autoResponder = AutoResponder::find($id);
            $autoResponder->delete();
            return back()->with('success', 'Autoresponder keyword deleted Successfully.');

        } catch(Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
}
