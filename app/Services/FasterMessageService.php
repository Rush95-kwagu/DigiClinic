<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use App\Models\Verification;
use Illuminate\Http\Exceptions\HttpResponseException;
use Mail;

class FasterMessageService{

    const CONNECT_USERNAME = "ornice97";
    const CONNECT_PASSWORD = "ornice97";
    const CONNECT_URI = "https://api.fastermessage.com/v1";

    protected $client;

    public function __construct()
    {
        $this->client =  Http::withBasicAuth(FasterMessageService::CONNECT_USERNAME, FasterMessageService::CONNECT_PASSWORD);
    }

   public function sendSMS($to, $message){

    try {
        $to = strlen($to) > 10 ? $to : '+229' . $to;
        info($to);
        $resources=[
            'to' => (int)$to,
            'from' => "FASTERMSG",
            'text' => $message,
        ];
        return $this->client->post(FasterMessageService::CONNECT_URI.'/sms/send', $resources)->json();
    } catch (\Throwable $th) {
        throw new HttpResponseException(response()->json([
            "success" => false,
            "error" => true,
            "message" => $th->getMessage(),
            "errorsList" => [],
        ], 500));
    }
    }



    public function createOTPExpirationTime($phone_number,$code)
    {
        try {
            $array = array(
                "code" => $code,
                "phone" => $phone_number,
                "expired_at" => date("Y-m-d H:i:s", strtotime("+5 minute", strtotime("now"))),
            );
             Verification::create($array);
            return true;
        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json([
                "success" => false,
                "error" => true,
                "message" => $th->getMessage(),
                "errorsList" => [],
            ], 500));
        }

    }

    public function verifyOTP($data) {
        try {
            $phone_number=$data['phone_number'];
            $phone_number = strlen($phone_number) > 8 ? $phone_number : '+229' . $phone_number;
            $verification = Verification::wherePhone($phone_number)->where('code',$data['verification_code'])->first();
            if ($verification) {
                $verification->delete();
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json([
                "success" => false,
                "error" => true,
                "message" => $th->getMessage(),
                "errorsList" => [],
            ], 500));
        }

    }


    function sendMailOTP(string $email,string $code)
    {

        try {
            if ($email == null) {
                return false;
            }

            $params = [
                "sender"=>"support@fastermessage.com",
                //"sender"=>"PAC OTP",
                "to"=>[["email"=>$email, "name" =>"Ornice"]],
                "subject"=>"Code OTP",
                "content"=> "Votre code OTP est le suivant: $code"
               ];

            $response=$this->client->accept('application/json')
                    ->withoutVerifying()
                    ->post("https://api.fastermessage.com/v1/mail/send",$params);

            info($response?->json());
            return $response?->json()['status']?true:false;

        } catch (\Throwable $th) {
            throw new HttpResponseException(response()->json([
                "success" => false,
                "error" => true,
                "message" => $th->getMessage(),
                "errorsList" => [],
            ], 500));
        }
    }

}
