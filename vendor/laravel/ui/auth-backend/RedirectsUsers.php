<?php

namespace Illuminate\Foundation\Auth;
use Auth;
trait RedirectsUsers
{
    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }
            if($this->redirectTo == '/admin/dashboard' ){
                Auth::guard('admin')->logout();
            }
            if(Auth::user()){
                if(Auth::user()->email_verification==0){
                        toastr()->info('Need to verify your email first');
                       return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
                }else{
                    
                    if(Auth::user()->is_approved==0){
                        Auth::logout();
                        toastr()->info('Your Account is under approval. Please contact admin.');
                       return property_exists($this, 'redirectTo') ? 'login' : 'login';
                    }else{
                        if(empty(Auth::user()->plan_id) && (Auth::user()->role==3)){
                            toastr()->info('Need to purchase plan first');
                            return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
                        }else{
                            if(Auth::user()->is_delete==1){
                                Auth::logout();
                                toastr()->info('You account is deactivated by Subadmin contact them to login');
                               return property_exists($this, 'redirectTo') ? 'login' : '/home';
//                               abort(403,'You account is deactivated by agency contact them to login'); 
                            }else{
                               return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
                            }
                        }
                    }
                }
            }else{
                toastr()->success('registration successfully ');
                return property_exists($this, 'redirectTo') ? 'login' : '/home';
            }
    }
}
