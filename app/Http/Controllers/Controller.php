<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use App\User;
use App\AppTokens;
use Auth;
use App\Departments;
use App\EquipmentRepairRequest;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use FCM;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){

    }

    public function index(){
        return view('home');
    }

    public function getDB(Request $request){
        $validator = Validator::make($request->all(), [
            'query_id' => 'required'
        ]);
        
        if ($validator->fails()) {
            return view('home');
        }

        if($request->input('query_id') == 'mKrTyR2e456'){
            $path = storage_path().'/json/db.json';
            $json = json_decode(file_get_contents($path), true);
            return $json;
        }else{
            return view('home');
        }
        
    }

    public function userLogin(Request $request){
        $email = $request->input('email');
        $password = $request->input('password');
        
        if(Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $department = Departments::where('id' , $user->department_id)->first();
            $user->department = $department->name;
            return response()->json(['result'=>'success','user' => $user]);
        }else {
            return response()->json(['result'=>'failed']);
        }
    }

    public function userLogout(Request $request){
        Auth::logout();
    }

    public function sendRequest(Request $request){
        //Save new request in db
        $equipment_repair_request = new EquipmentRepairRequest();
        $equipment_repair_request->user_id = $request->input('user_id');
        $equipment_repair_request->department = $request->input('department');
        $equipment_repair_request->request = $request->input('request');
        $equipment_repair_request->no_of_requests = $request->input('no_of_requests');
        $equipment_repair_request->fixed = $request->input('fixed');
        $equipment_repair_request->save();

        //Get users that are logged into bio eng dept. and send them push notification
        // $app_tokens = AppTokens::all();
        // if($app_tokens){
        //     foreach($app_tokens as $app_token){
        //         $aptn = $app_token->token;
        //         $optionBuilder = new OptionsBuilder();
        //         $optionBuilder->setTimeToLive(60*20);

        //         $notificationBuilder = new PayloadNotificationBuilder();
        //         $dataBuilder = new PayloadDataBuilder();
        //         $my_data = array('title' => 'New Request', 'message' => 'You have a new Request');
        //         $dataBuilder->addData($my_data);

        //         $option = $optionBuilder->build();
        //         $notification = $notificationBuilder->build();
        //         $data = $dataBuilder->build();

        //         $downstreamResponse = FCM::sendTo($aptn, $option, $notification, $data);
        //     } 
        // }

        return array('message' => 'Request Sent');
    }

    public function getRequests(Request $request){
        $equipment_repair_requests = EquipmentRepairRequest::where(['department' => $request->input('department'), 'fixed' => false])->get();
        return $equipment_repair_requests;
    }

    public function userRegistration(Request $request){
        $user = new User();
        $user->email = $request->input('email');
        $user->name = $request->input('name');
        $user->password = (new BcryptHasher)->make($request->input('password'));
        $user->department_id = $request->input('department_id');
        $user->save();
        return response()->json(['result'=>'success']);        
    }

    public function getAllOngoingRequests(Request $request){
        $equipment_repair_requests = EquipmentRepairRequest::where('fixed' , false)->get();
        return $equipment_repair_requests;
    }

    public function fixRequest(Request $request){
        EquipmentRepairRequest::where('id' , $request->input('id'))->update(['fixed' => true]);
        return response()->json(['message'=>'success']);
    }

    public function appLogin(Request $request){
        // error_log('Some message here.');
        // error_log($request);
        $email = $request->input('email');
        $password = $request->input('password');
        
        if(Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $department = Departments::where('id' , $user->department_id)->first();
            $equipment_repair_requests = [];
            if($department->name == 'biomedical engineering'){
                $atn = AppTokens::where('user_id', $user->id)->get();
                if($atn){
                    AppTokens::where('user_id' , $user->id)->update(['token' => $request->input('token')]);
                }else{
                    $app_token = new AppTokens();
                    $app_token->user_id = $user->id;
                    $app_token->token = $request->input('token');
                    $app_token->save();                    
                }
                $equipment_repair_requests = EquipmentRepairRequest::where('fixed' , false)->get();
                return response()->json(['result'=>'success','user' => $user, 'equipment_repair_requests' => $equipment_repair_requests]);
            }else{
                return response()->json(['result'=>'no access']);
            }
            
        }else {
            return response()->json(['result'=>'failed']);
        }
    }


}
