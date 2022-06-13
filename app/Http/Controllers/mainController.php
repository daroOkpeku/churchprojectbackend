<?php

namespace App\Http\Controllers;

use App\Http\Requests\Authrequest;
use App\Http\Requests\loginrequest;
use App\Http\Resources\donateresource;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class mainController extends Controller
{
    public function adminsignup(User $user, Authrequest $request){
        $request->validated();
         $user->create([
         'name'=>$request->fullname,
         'email'=>$request->email,
         'password'=>Hash::make($request->password),
         'is_admin'=>1
         ]);

         return response()->json([
             'code'=>200,
             'success'=>'you have successfully signed up'
         ]);

     }


     public function adminlogin(User $user, loginrequest $request){
         $request->validated();
      $person = $user->where('email', $request->email)->first();
       if($person && Hash::check($request->password,  $person->password) &&   intval($person->is_admin) == 1 ){
            $data = [
             'id'=>$person->id,
             'email'=>$person->email,
             'token'=>$person->createToken('my-app-token')->plainTextToken
            ];
            return response()->json(['code'=>200,'success'=>$data]);
       }else{
         return response()->json(['error'=>'you are not an admin']);
       }
     }

     public function donation_made($page){
     $donate = Donation::orderBy('id', 'asc')->get();
     $data =  donateresource::collection($donate)->resolve();
     $answer = $page?$page:1;
      $info =  $this->paginate($data, 10, $answer);
      return response()->json(['success'=>$info]);
     }



}
