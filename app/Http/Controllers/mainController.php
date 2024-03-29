<?php

namespace App\Http\Controllers;

use App\Events\contactEvent;
use App\Http\Requests\Authrequest;
use App\Http\Requests\contactrequest;
use App\Http\Requests\Eventreq;
use App\Http\Requests\loginrequest;
use App\Http\Resources\donateresource;
use App\Models\contact;
use App\Models\Donation;
use App\Models\EventContent;
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
         'is_admin'=>true
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


     public function eventplace(Eventreq $request, EventContent $eventContent){

       $answer = $this->sendimage($request->imgone);
       // $second = $this->sendimage($request->imgtwo);
       $eventContent->create([
        'titleevent'=>$request->titleevent,
        'imgone'=>$answer,
        'imgtwo'=>$answer ,
        'eventdetailone'=>$request->eventdetailone,
        'eventdetailtwo'=>$request->eventdetailtwo,
        'dailydate'=>$request->dailydate
       ]);
       return response()->json(['success'=>'you have inserted an event']);

     }


     public function search_donation($search){
        if ($search) {
            $data = Donation::search($search)->take(10)->get();
            $more =  donateresource::collection($data)->resolve();
             return response()->json($more);
        }
     }


     public function eventdetails($page, EventContent $eventContent){
     $data = $eventContent->orderBy('id', 'asc')->get()->toArray();
     $answer = $page?$page:1;
     $info =  $this->paginate($data, 10, $answer);
     return response()->json(['success'=>$info]);
     }

     public function eventfind($id, EventContent $eventContent){
       $data = $eventContent->find($id);
       return response()->json(['success'=>$data]);
     }


     public function logout(){
      auth()->user()->tokens()->delete();
      return response()->json(['success'=>'logged out']);
    }

    public function contact(contact $contact, contactrequest $request){
      $contact->create([
           'fullname'=>$request->fullname,
            'email'=>$request->email,
            'subject'=>$request->subject,
           'message'=>$request->message,
      ]);
       event(new contactEvent($request->fullname, $request->email, $request->subject, $request->message ));
       return response()->json(['success'=>'you message have being sent']);
    }

}
