<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Mail;
use DB;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::AdditionalForm;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password'=>'required|confirmed|min:8|regex:/^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!$#%@]).*$/',

        ],[
                'password.regex'=>'Password must contain at least 1 Smallcase, 1 Uppercase, 1 Number and 1 Special character',
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $userData= Session::get('userDetail');
        $uploadedDocuments= DB::table('documents_upload')->select('documents')->where('email',$userData['email'])->first();
            //delete from document upload table
            DB::table('documents_upload')->where('email',$userData['email'])->delete();
            //delete from document upload table
        $Useremail= $userData['email'];
        $fromUser=\Config::get('mail.serveremail'); 

/*        $mailContent= EmailTemplate::GetEmailTemplate('register-user');
        $content['content'] = str_replace(array('{email}','{password}','{url}'), array($request['email'],$request['password'],url('/')), $mailContent->content);
        //$Useremail= $request['email'];
        //send mail using helper function
        Helper::mailSend($content,'Agency Login Detail',$Useremail); 
        //send mail using helper function
*/

        Mail::send('emails.registermail', $userData, function ($message) use ($Useremail,$fromUser) {
            $message->from('noreply@gmail.com', 'Cozy Appartment');
            $message->subject('Register Your Account');
            $message->to($Useremail);
        });
        Session::forget('userDetail');
        return User::create([
            'name' => $userData['name'],
            'email' => $userData['email'],
            'phone_num' => $userData['phone_num'],
            'fullphone_num' => $userData['fullphone_num'],
            'currencycode' => $userData['currencycode'],
            'agency' => $userData['Agency'],
            'civil_id' => $userData['civil_id'],
            'country' => $userData['country'],
            'state' => $userData['state'],
            'city' => $userData['city'],
            'appartment' => $userData['appartment'],
            'street' => $userData['street'],
            'unit' => $userData['unit'],
            'zipcode' => $userData['zipcode'],
            'image' => 'admin_design/img/user.jpg',
            'phone_verification' => $userData['phone_verification'],
            'password' => Hash::make($data['password']),
            'documents' => $uploadedDocuments->documents,
           // 'password_text' => $data['password'],
        ]);
    }
}
