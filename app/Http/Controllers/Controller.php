<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\User;
use Auth;

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
            return response()->json(['result'=>'success']);
        }else {
            return response()->json(['result'=>'failed']);
        }
    }

    public function sendRequest(Request $request){
        // $new_user = new User();
        // $new_user->
        // return array('message' => 'Send Request Successful');
    }
}
