<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertReading;
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
     $group =  $this->mass->whereBetween('dailydate', [$nowdate, $date])->get();
     return  response()->json([
         'success'=>$group,
         'code'=>200
     ]);
   }

   public function searchreading(Request $request){
    $validator = Validator::make($request->all(),[
        'todaydate'=>'required|string',
       ]);
       if($validator->fails()){
        $errors = $validator->errors()->getMessages();
        return ['code'=>'1500', 'error'=>$errors];
       }
    $nowdate = Carbon::createFromFormat('d/m/Y', $request->todaydate)->format('Y-m-d');
     $newdate = Carbon::parse($nowdate);
     $presentdate = $newdate->addDay(0)->format('Y-m-d');
     $date = $newdate->addDay(7)->format('Y-m-d');
      $group =  $this->mass->whereBetween('dailydate', [$presentdate, $date])->get();
      return response()->json([
          "success"=>$group,
          'code'=>200
      ]);
    }

    public function lastrow(){
       $data = $this->mass->orderBy('id', 'desc')->get()->take(1);
       return response()->json([
           "success"=>$data,
           "code"=>200
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
        $donate->create($request->all());
       return ['success'=>'we have received the donation thank you for your support'];
   }

   public function insertreading( insertReading $request){
       $massreading =    new  massreading();
    $massreading->firstheading = $request->firstheading;
    $massreading->firstbody= $request->firstbody;
    $massreading->responsorialheading= $request->responsorialheading;
    $massreading->responsorialresponse = $request->responsorialresponse;
    $massreading->responsorialbody = $request->responsorialbody;
    $massreading->secondheading = $request->secondheading;
    $massreading->secondbody = $request->secondbody;
     $massreading->alleluiaheading = $request->alleluiaheading;
    $massreading->alleluiabody = $request->alleluiabody;
    $massreading->gospelaccheading = $request->gospelaccheading;
    $massreading->gospelaccbody = $request->gospelaccbody;
   $massreading->gospelheading = $request->gospelheading;
    $massreading->gospelbody = $request->gospelbody;
     $massreading->dailydate = $request->dailydate;
     $massreading->save();

    return response()->json(['success'=>'successful inserted mass reading']);
   }
}
