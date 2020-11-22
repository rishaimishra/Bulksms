<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Validator;
use Redirect;
use DB;
use Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;

class ContactController extends Controller
{



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {

            $data = [
                'name'  => $r->name,
                'email' => $r->email,
                'password'=>Hash::make('password'),
                'phone' => $r->phone,
                'guest' => $r->guest,
                'created_at' => Carbon::parse($r->date),
            ];

            $post = DB::table('users')->insertGetId($data);
            if ($post == 1)
                return  redirect()->back()->with(['success', 'Your message has been sent successfully!']);
            else
                return  redirect()->back()->with(['error' => 'Something Want Weong']);
        }
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r, $id)
    {
      //  dd($id);


        $validator = Validator::make($r->all(), [

            'name' => 'required',


                 ]);

             if ($validator->fails()) {
                 return Redirect::back()->withErrors($validator);

             }else{
                 if($r->email != ""){
                      $data = [

                     'name' => $r->name,

                     'phone' => $r->phone,
                     'guest'=>$r->guest

                      ];
                      try {

                        $post = DB::table('users')->where('id', $id)->update($data);

                       } catch(QueryException $ex){
                        return $ex->getMessage();
                     }


                 }else{
                    $data = [

                        'name' => $r->name,
                        'phone' => $r->phone,
                        'guest'=>$r->guest

                         ];

                         $post = DB::table('users')->where('id', $id)->update($data);
                         dd($post);

                 }




                  return  redirect()->route('admin.import.show')->with('success', 'Your message has been sent successfully!');
                  /* 	if($post == 1)
                             return  redirect()->route('manage.reward')->with('success', 'Your message has been sent successfully!');
                         else
                          return  redirect()->back()->with(['error' => 'Something Want Weong']); */
             }

        // return redirect()->route('admin.import.show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroying($id, Request $request)
    {

        if (Gate::denies('delete-users')) {
            return redirect()->route('admin.import.show');
        }

        $row = DB::table('users')
            ->where("id", $id)
            ->delete();
        // return response()->json(["message" => "Initiative Remove"]);
        $request->session()->flash('msg','Record has been deleted Successfully');
        return redirect()->route('admin.import.show');
    }

    public function unblocking($id, Request $request)
    {

        $row = DB::table('users')
            ->where("id", $id)
            ->update(array('status' => 1));
        // return response()->json(["message" => "Initiative Remove"]);
        $request->session()->flash('msg','Record has been Updated Successfully');
        return redirect()->route('admin.import.blocknumber');
    }


    // create new staff
    public function storing(Request $r)
    {


        $validator = Validator::make($r->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required',
            'password'=>'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {

            $data = [
                'name'  => $r->name,
                'email' => $r->email,
                'password'=>$r->password,
                'phone' => $r->phone,
                'created_at' => Carbon::parse($r->date),
            ];


            $post = DB::table('users')->insertGetId($data);
            if ($post == 1)
                return  redirect()->back()->with(['success', 'Your message has been sent successfully!']);
            else
                return  redirect()->back()->with(['error' => 'Something Want Weong']);
        }
    }
}
