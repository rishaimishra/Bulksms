<?php

namespace App\Http\Controllers;

use Exception;
use Excel;
use Illuminate\Http\Request;
use Config; // Added this line
use Twilio\Rest\Client;
use DB;
use App\Models\User;
use App\Models\Message;
use App\Models\AutoResponder;
use App\Imports\ExcelImport;
use Twilio\TwiML\MessagingResponse;

// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md


class SendController extends Controller
{

    public function sendsms( Request $request ) {

       // dd('+'.(int)$request->custnumber);
       $sid= config('services.twilio.sid');
       $token= config('services.twilio.token');

       $twilio = new Client($sid, $token);
       $account_number = DB::table('accounts')
       ->select('number')
       ->where('id',$request->account_number)
       ->first();

        $message = $twilio->messages
                  ->create('+'.(int)$request->custnumber, // to
                           ["body" => $request->msg, "from" => "$account_number->number"]
                  );


        return back()->with('success', 'Sms has been sent successfully.');
    }

    public function sendMessage($twilio, $data)
    {
        try {
            return $twilio->messages
                    ->create('+'.(int) $data['to'], array(
                            "body" => $data['body'],
                            "from" => '+'.(int) $data['from']
                        )
                    );
        } catch(Exception $ex) {

            dd($ex->getMessage());

        }
    }

    // Send Bulk SMS
    public function sendBulkSMS(Request $request)
    {
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');

        if(!$request->user_type_contacts && !$request->bulk_message_file){
            dd("Please select user type");
        }
        $account_number = DB::table('accounts')
        ->select('number')
        ->where('id',$request->account_number)
        ->first();

        //dd($account_number->number);

        $twilio = new Client($sid, $token);

        $data = array();
        $data['from'] = $account_number->number;
        $data['body'] = $request->custom_message;
        $data['attachment'] = $request->file('message_attachment');

        // If User selects from DB contatcs
        if($request->user_type_contacts){
            $users = User::whereIn('id', $request->user_type_contacts)->get();
            foreach($users as $user){
                $data['to'] = $user->phone;
                $message = $this->sendMessage($twilio, $data);
                Message::create($data);
            }
        }

        // If User uploads a Excel file
        if($request->bulk_message_file) {
            $users = Excel::toArray(new ExcelImport, $request->file('bulk_message_file'));
            $phones = array_map(function($iter){
                $numbers = array();
                foreach($iter as $key => $item){
                    if($key != 0){
                        $numbers[] = $item[0];
                    }
                }
                return $numbers;
            }, $users);
            array_walk_recursive($phones, function ($value, $key) use (&$numbers){
                $numbers[] = $value;
            }, $numbers);
            $numbers = array_unique($numbers);
            foreach($numbers as $number){
                $data['to'] = $number;
                $message = $this->sendMessage($twilio, $data);
                Message::create($data);
            }
        }

        return back()->with('success', "SMS's has been sent successfully.");
    }

    public function viewBulkSMS()
    {
        $users = DB::table('users')
                    ->where('guest','1')
                    ->where('status','1')
                    ->orderBy('created_at','desc')
                    ->get();

        $templates = DB::table('templates')->get();
        $num = DB::table('accounts')
                ->get();

        return view('admin.users.sendbulksms')->with(['users' => $users, 'templates' => $templates, 'num' => $num]);
    }

    public function index(){
        $users = DB::table('users')
                ->where('guest','1')
                ->where('status','1')
                ->orderBy('created_at','desc')
                ->get();

                $num = DB::table('accounts')
                ->get();

        return view('admin.users.sendsms')->with(['users' => $users, 'num' => $num]);
    }

    public function getAllSMS(Request $request)
    {
        $filter = array();
        $limit = $request->limit ? $request->limit : 20;
        if($request->dateSent){
            $filter['dateSent'] = new \DateTime($request->dateSent);
        }
        if($request->from){
            $filter['from'] = $request->from;
        }
        if($request->to){
            $filter['to'] = $request->to;
        }
        
        $users = DB::table('users')->where('guest','1')->where('status','1')->orderBy('created_at','desc')->get();
        $sid = config('services.twilio.sid');
        $token = config('services.twilio.token');

        $twilio = new Client($sid, $token);
        
        $messages = $twilio->messages->read($filter, $limit);
        
        return view('admin.users.smsinbox')->with(['users' => $users, 'messages' => $messages]);
    }

    public function blockNumber(){
        $users = DB::table('users')
                ->where('guest','1')
                ->where('status','0')
                ->orderBy('created_at','desc')
                ->get();

                $num = DB::table('accounts')
                ->get();

        return view('admin.users.blocklist')->with(['users' => $users, 'num' => $num]);
    }



    public function getnumber($id){
       echo json_encode(DB::table('users')->where('guest','1')->where('id',$id)->get());
    }

    public function sentSmsList(){
        $sms = Message::where('type', '=', 'SMS')->get();
        return view('admin.users.sentsmslist')->with(['sms' => $sms]);

    }

    public function reply()
    {
        if($message = AutoResponder::get()->first()){
            $message = $message->message;
        } else {
            $message = "The Robots are coming! Head for the hills!";
        }
        $response = new MessagingResponse();
        $response->message($message);
        return $response;
    }

}




