<?php

namespace App\Http\Controllers;

use App\Models\paypal;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Stripe\StripeClient;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


   public function api (){
    $clientId = 'AYauehWxDIcW5N-L432YO1bcyGnqy4lzfx00pdgX5VLRlm0qQ48rKn4odTFy8J_bWdUi57eOAS8c1ato';
    $secret = 'EKSUKuMcZj4nZ6OP6ds2-ACeeokTQrhBffRhUo1QJPrQZnwbSuOgUV26jNebknQPGssePkGBRVRScAff';
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v1/oauth2/token',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_USERPWD => $clientId.":".$secret,
      CURLOPT_POSTFIELDS => 'grant_type=client_credentials',
      CURLOPT_HTTPHEADER => array(
        'Accept-Language: en_US',
        'Accept: application/json',
        'Content-Type: application/x-www-form-urlencoded'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return  json_decode($response);
   }

   public function onbording(){
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api-m.sandbox.paypal.com/v2/customer/partner-referrals',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "partner_config_override": {
        "partner_logo_url": "https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg",
        "return_url": "https://frontend.wholeorganic.adcreatorsdemo.com.au/for-business",
        "return_url_description": "the url to return the merchant after the paypal onboarding process.",
        "action_renewal_url": "https://testenterprises.com/renew-exprired-url",
        "show_add_credit_card": true
      },
        "operations": [
          {
            "operation": "API_INTEGRATION",
            "api_integration_preference": {
              "rest_api_integration": {
                "integration_method": "PAYPAL",
                "integration_type": "THIRD_PARTY",
                "third_party_details": {
                  "features": [
                    "PAYMENT",
                    "REFUND"
                 ]
                }
              }
            }
          }
        ],
        "products": [
          "EXPRESS_CHECKOUT"
        ],
        "legal_consents": [
          {
            "type": "SHARE_DATA_CONSENT",
            "granted": true
          }
        ]
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: Bearer A21AAIEze2mhxsYhtGJ67Y0G3kLg9wbAPjL8G3Ui7BC0pRpJU4CsoOB8iZ-ANHTxdtT_4TLLV6KvFsg0WPe0TI8tKeSqpKOEw'
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    return $response;
   }


     public function Address(){
    //     $api_key = "PCW2P-B32G7-8H9BN-ZY6LH";
    //     $country_code = "UK";
    //     $search_term = "NR14 7PZ";
    //    // $api_key = "PCW2P-B32G7-8H9BN-ZY6LH";
    //     // $country_code = "UK";
    //     // $search_term = "LE4 4HX";
    //   //  $email = "Le4 4hx";
    //     $ch = curl_init();

    //      $url = "https://ws.postcoder.com/pcw/$api_key/address/$country_code/" . urlencode($search_term);
    //      //$request_url = "https://ws.postcoder.com/pcw/$api_key/pafaddressbase/" . urlencode($search_term);
    //      //https://ws.postcoder.com/pcw/{apikey}/email/{email}
    //     //https://ws.postcoder.com/pcw/{apikey}/mobile/{mobilephonenumber}
    //     //https://ws.postcoder.com/pcw/{apikey}/pafaddressbase/{searchterm}
    //     curl_setopt($ch, CURLOPT_URL, $url);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //     $res = curl_exec($ch);
    //     $err = curl_errno($ch);
    //     curl_close($ch);
    //     if($err){
    //     echo "error".$err;
    //     }

    //     return $res;
    //     // $see = json_decode($res, TRUE);
    //     // echo json_encode($see);


//     $api_key = "PCW2P-B32G7-8H9BN-ZY6LH";
// $search_term = "LE4 4HX";
// $phone = '07517500957';
//
$api_key = '1397b381-28d1-477d-8135-55341ba8c854';
$url = "https://api.companieshouse.gov.uk/company/13893779";
$ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
      //  curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
      // CURLOPT_USERPWD => $clientId.":".$secret,
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept-Language: en_US',
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded',
          //  'Authorization: Basic 1397b381-28d1-477d-8135-55341ba8c854'
        ));
        curl_setopt($ch, CURLOPT_USERPWD, $api_key);
        $res = curl_exec($ch);
        $err = curl_errno($ch);
        curl_close($ch);
        if($err){
        echo "error".$err;
        }

        return $res;

     }

     public function explodefun(){
         //first way
        //  $string = 'beneficiary-random-909ea2b3-673c-42f8-b4b5-25e';
        //  $answer = explode('-', $string);
        //  return $answer[2].$answer[3].$answer[4].$answer[5].$answer[6];

        // //second way
        // $string = 'beneficiary-random-909ea2b3-673c-42f8-b4b5-25e';
        // $answer = explode('beneficiary-random-', $string);
        // return $answer[0];
        //stripe steps
        //first step
        // $stripe =  new StripeClient('sk_test_51L2XgNANbaRqueyVOtuRtJAHUVfczqDuVLs3H83aUnbMTSpNzbmJfPm55qbygK2ZwsCIzMJXDvmQEYVE36L3dXOS00rnKNNHVm');
        // $standand  =  $stripe->accounts->create(['type' => 'standard']);
        // return $standand;
        // first step

      //   $stripe = new StripeClient(
      //     'sk_test_51L2XgNANbaRqueyVOtuRtJAHUVfczqDuVLs3H83aUnbMTSpNzbmJfPm55qbygK2ZwsCIzMJXDvmQEYVE36L3dXOS00rnKNNHVm'
      //   );
      //  $standard = $stripe->accounts->create([
      //     'type' => 'standard',
      //     'country' => 'US',
      //     'email' => 'jenny.rosen@example.com',
      //     'capabilities' => [
      //       //'card_payments' => ['requested' => true],
      //       // 'transfers' => ['requested' => true],
      //     ],
      //   ]);
      //   return $standard['id'];
        //return $standard['email'];
       //acct_1L2kmGPDEZUGRhI5
        // third step
        $stripe =  new StripeClient('sk_test_51L2XgNANbaRqueyVOtuRtJAHUVfczqDuVLs3H83aUnbMTSpNzbmJfPm55qbygK2ZwsCIzMJXDvmQEYVE36L3dXOS00rnKNNHVm');
        $standand  = $stripe->accountLinks->create([
          //  'email' => 'jenny.rosen@example.com',
            'account' => 'acct_1L2kmGPDEZUGRhI5',
            'refresh_url' => 'https://example.com/reauth',
            'return_url' => 'https://example.com/return',
            'type' => 'account_onboarding',

          ]);
          return $standand;
     }


    public function paypaloath(){
        // dd($this->explodefun());

         $data = $this->explodefun();
        // return $data;
         //third
        return redirect($data['url']);
        //  paypal::create([
        // 'access_token'=>$data->access_token,
        // 'token_type'=>$data->token_type,
        // 'app_id'=>$data->app_id,
        // 'expires_in'=>$data->expires_in,
        //  ]);

        return view('index');
    }
}
