<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class MailController extends Controller
{

    public function sendMail(Request $request){

        $data = array(
            'bodyMessage' => $request->msg
        );


        Mail::send('email', $data, function ($message) use ($request) {

            $message->from('rishimishra7872@gmail.com', 'Just Laravel Doe');
            $message->to($request->custemail, 'Rishav Doe');
            // $message->cc('john@johndoe.com', 'John Doe');
            // $message->bcc('john@johndoe.com', 'John Doe');
            // $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Subject');
            // $message->priority(3);
            // $message->attach('pathToFile');
        });



        dd('email sent');
    }

    public function index(){
        $users = DB::table('users')
    			->where('guest','1')
                ->orderBy('created_at','desc')
                ->get();

        return view('admin.users.sendemail')->with('users', $users);
    }

    public function getEmail($id){
        echo json_encode(DB::table('users')->where('guest','1')->where('id',$id)->get());
     }
}
