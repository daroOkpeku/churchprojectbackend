<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\massreading;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class catholicMass extends Controller
{
    protected $mass;
   public function __construct(massreading $read)
   {
       $this->mass = $read;
   }


   public function reading(){
     $now = Carbon::now();
     $nowdate = $now->addDay(0)->format('Y-m-d');
     $date = $now->addDay(7)->format('Y-m-d');
     //single
    //$data =  massreading::where(['dailydate'=>$date])->first();
    //return $data;
    // $this->mass->all();
    //single
     $group =  $this->mass->whereBetween('dailydate', [$nowdate, $date])->get();
     return  response()->json([
         'success'=>$group,
         'code'=>200
     ]);
   }

    public function read($read){
     $newdate =  Carbon::parse($read)->format('Y-m-d');
       $data =  $this->mass->where(['dailydate'=>$newdate])->first();
       return  response()->json([
        'success'=>$data,
        'code'=>200
    ]);
    }

    public function paystack_verify($ref){
        $sercrtKey = "sk_test_8a40b954383a29bc20a711400387d2c3205478f9";
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/transaction/verify/$ref",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $sercrtKey",
            "Cache-Control: no-cache",
        ),
        ));

        $response = curl_exec($curl);
        return $response;

        $err = curl_error($curl);
        curl_close($curl);

}

   public function paymentdata(Donation $donate, Request $request){
    $validator = Validator::make($request->all(),[
        "fullname" => 'required|regex:/^[a-zA-Z ]*$/',
        "email" => 'required|email',
        "amount"=>'required|numeric',
        'reason'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
        'explain'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
        'message'=>'required|regex:/^[a-zA-Z0-9 ]*$/',
        'referencecode'=>'required|alpha_dash',
       ]);
       if($validator->fails()){
        $errors = $validator->errors()->getMessages();
        return ['code'=>'1500', 'error'=>$errors];
       }
        $donate->create([
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'amount'=>$request->amount,
            'reason'=>$request->reason,
            'explain'=>$request->explain,
            'message'=>$request->message,
            'referencecode'=>$request->referencecode
        ]);
       return ['success'=>'we have received the donation thank you for you support'];
   }
}
