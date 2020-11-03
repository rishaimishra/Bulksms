<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use Validator;
use Redirect;
use Exception;

class TemplateController extends Controller
{
    public function index()
    {
        $templates = Template::all();
        return view('admin.users.templates')->with(['templates' => $templates, 'types' => [Template::SMS, Template::EMAIL]]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'text' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            try {
                Template::create($request->all());
                return back()->with('success', 'Template created Successfully.');

            } catch(Exception $ex) {
                return back()->with('error', $ex->getMessage());
            }
        }        
    }

    public function delete($id)
    {
        try {
            $template = Template::find($id);
            $template->delete();
            return back()->with('success', 'Template deleted Successfully.');

        } catch(Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
}
