<?php

namespace App\Http\Controllers;

use Exception;
use Excel;
use App\Models\User;
use App\Models\Message;
use App\Imports\ExcelImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        if(!$request->custemail){
            dd("Please send email");
        }

        $body = array(
            'bodyMessage' => $request->custom_message
        );

        $user = User::find($request->custname);
        $data = array();
        $data['to'] = $request->custemail;
        $data['to_name'] = ucfirst($user->name);
        $data['type'] = Message::EMAIL;
        $data['from'] = env('MAIL_FROM_ADDRESS', 'rishimishra7872@gmail.com');
        $data['from_name'] = env('MAIL_FROM_NAME', 'Rishav kumar');
        $data['subject'] = $request->message_subject;
        $data['body'] = $request->custom_message;
        $data['attachment'] = $request->file('message_attachment');

        $this->sendEmail($data);

        return back()->with('success', 'Email has been sent successfully.');
    }

    public function index(){
        $users = DB::table('users')
    			->where('guest','1')
                ->orderBy('created_at','desc')
                ->get();

        $templates = DB::table('templates')->get();

        return view('admin.users.sendemail')->with(['users' => $users, 'templates' => $templates]);
    }

    public function sendEmail($data)
    {
        try {
            $body = array('bodyMessage' => $data['body']);
            Mail::send('email', $body, function ($message) use ($data) {

                $message->from($data['from'], $data['from_name']);
                $message->to($data['to'], $data['to_name']);
                $message->priority(3);

                if(!empty($data['cc'])){
                    $message->cc($data['cc'], 'CC John Doe');
                }
                if(!empty($data['bcc'])){
                    $message->bcc($data['bcc'], 'BCC John Doe');
                }
                if(!empty($data['reply_to'])){
                    $message->replyTo($data['reply_to'], 'Reply to John Doe');
                }
                if(!empty($data['subject'])){
                    $message->subject($data['subject']);
                }
                if(!empty($data['attachment'])){
                    $file = $data['attachment'];
                    $message->attach($file->getRealPath(), [
                        'as' => $file->getClientOriginalName(),
                        'mime' => $file->getMimeType(),
                    ]);
                }
            });

        } catch(Exception $ex) {

            dd($ex->getMessage());

        }
    }

    public function viewBulkEmail()
    {
        $users = DB::table('users')
                    ->where('guest','1')
                    ->orderBy('created_at','desc')
                    ->get();

        $templates = DB::table('templates')->get();

        return view('admin.users.sendbulkemail')->with(['users' => $users, 'templates' => $templates]);
    }

    public function sendBulkMail(Request $request)
    {
        $success = false;
        $emails = array();

        if(!$request->user_type_contacts && !$request->bulk_message_file){
            dd("Please select user type");
        }

        $data = array();
        $data['type'] = Message::EMAIL;
        $data['from'] = env('MAIL_FROM_ADDRESS');
        $data['from_name'] = env('MAIL_FROM_NAME');
        $data['body'] = $request->custom_message;
        $data['subject'] = $request->message_subject;
        $data['attachment'] = $request->file('message_attachment');

       

        // If User selects from DB contatcs
        if($request->user_type_contacts){
            $users = User::whereIn('id', $request->user_type_contacts)->get();
            foreach($users as $user){
                $data['to'] = $user->email;
                $data['to_name'] = ucfirst($user->name);
                $this->sendEmail($data);
                Message::create($data);
            }
        }

        // If User uploads a Excel file
        if($request->bulk_message_file) {
            $user_emails = Excel::toArray(new ExcelImport, $request->file('bulk_message_file'));
            array_walk_recursive($user_emails, function ($value, $key) use (&$emails){
                $emails[] = $value;
            }, $emails);
            $emails = array_unique($emails);
            foreach($emails as $email){
                $data['to'] = $email;
                $data['to_name'] = 'John Doe';
                $this->sendEmail($data);
                Message::create($data);
            }
        }

        return back()->with('success', 'Emails has been sent successfully.');
    }

    public function getEmail($id){
        echo json_encode(DB::table('users')->where('guest','1')->where('id',$id)->get());
     }
}
