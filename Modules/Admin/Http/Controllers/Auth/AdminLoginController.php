<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use Illuminate\Auth\SessionGuard;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AdminLoginController extends Controller
{
    use ValidatesRequests;
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['web','guest:admin'])->except('logout');
    }
   
    
    
    /**
     * Display a login page.
     * @return Response
     */
    public function showLoginForm()
    {
        return view('admin::Auth.login');
    }
    
    /**
     * implement login.
     * @return Response
     */
    public function loginAction(Request $request)
    {
        //validate the form data
        
        $this->validate($request, [
          'email'=> 'required|email',
          'password' => 'required|min:6'  
        ]);
        
        //attempt to log user
        if(Auth::guard('admin')->attempt(['email'=> $request->email, 'password'=> $request->password ],$request->remember)) {
            //if successfull , then redirect to intend location
            return redirect()->intended(route('admin.dashboard'));
        }
        //if unsucessfull, redirect back
            return redirect()->back()->withInput($request->only('email','remember'));
        
    }
    
     /**
     * implement logout.
     * @return Response
     */
    public function logoutAdminAction()
    {
        Auth:guard('admin')->logout();
        return redirect('/');
    }

    
}
