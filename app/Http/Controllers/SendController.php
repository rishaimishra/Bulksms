<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Config; // Added this line
use Twilio\Rest\Client;
use DB;

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md


class SendController extends Controller
{

    public function sendsms( Request $request ) {

       // dd('+'.(int)$request->custnumber);
       $sid= config('services.twilio.sid');
       $token= config('services.twilio.token');

       $twilio = new Client($sid, $token);

        $message = $twilio->messages
                  ->create('+'.(int)$request->custnumber, // to
                           ["body" => $request->msg, "from" => "+12058284240"]
                  );

        print($message->sid);
    }

    public function index(){
        $users = DB::table('users')
    			->where('guest','1')
                ->orderBy('created_at','desc')
                ->get();

        return view('admin.users.sendsms')->with('users', $users);
    }

    public function getnumber($id){
       echo json_encode(DB::table('users')->where('guest','1')->where('id',$id)->get());
    }

}




