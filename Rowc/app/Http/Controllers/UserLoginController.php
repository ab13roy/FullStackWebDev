<?php

namespace App\Http\Controllers;

use App\Helpers;
use App\Models\CommonDocument;
use App\Models\EmailTemplate;
use App\Models\Section;
use App\Models\Student;
use App\StudentDocument;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Log;
use Auth;
use Exception;
use Config;
use Illuminate\Support\Facades\URL;
class UserLoginController extends Controller
{

//    use AuthenticatesUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */

    public function __construct()
    {

       // $this->middleware('guest', ['except' => 'logout']);
    }
    public function login(){

        if (!Auth::guard('business')->check()) {
            return view('users.login');
        }else{
            return redirect('/parent/dashboard');
        }

    }
    public function register(){
        if (!Auth::guard('business')->check()) {
            return view('users.register');
        }else{
            return redirect('/parent/dashboard');
        }

    }
    public function get_profile(){
        $user_detail = Helpers::getAuthUserDetailGuardWise('business');
        return view('users.user_profile',compact('user_detail'));
    }
    public function post_parent_data(Request $request){
       try{

          $exist_student_identity = Student::where('unique_identity',$request->student_identity)->exists();
          if($exist_student_identity) {

              $already_sigup = User::where('student_identity',$request->student_identity)->exists();
              if(!$already_sigup) {

                  $exist_email = User::where('email',$request->email)->exists();
                  if(!$exist_email) {
                      $user = new User();
                      $user->first_name = $request->fName;
                      $user->last_name = $request->lName;
                      $user->email = $request->email;
                      $user->password = Hash::make($request->uPass);
                      $user->phone = $request->phone;
                      $user->gender = $request->gender;
                      $user->student_identity = $request->student_identity;
                      $user->save();

                      Log::info($request->email.' parent has been new registration');
                      return Redirect::to('register')->with('success', 'Registration has been successfully')
                          ->with('message-type', 'success');
                  }else{
                      return Redirect::to('register')->with('error', 'You are already register with this email address.')
                          ->with('message-type', 'error')->withInput(Input::all());
                  }
              }else{
                  return Redirect::to('register')->with('error', 'You are already register with this student identity.')
                      ->with('message-type', 'error')->withInput(Input::all());
              }
          }else{
              return Redirect::to('register')->with('error', 'Student Identity Number not found.')
                  ->with('message-type', 'error')->withInput(Input::all());
          }


       }catch (Exception $e){
           return Redirect::to('register')->with('error', $e->getMessage())
               ->with('message-type', 'error')->withInput(Input::all());
       }
    }

    public function post_login_data(Request $request){
        try{

            if (auth()->guard('business')->attempt(['email' => $request->email, 'password' => $request->password])) {
                Log::info(Auth::guard('business')->user()->first_name.' parent has been login');
                return Redirect::to('parent/dashboard');
            } else {

                $exist_email = User::where('email',$request->email)->exists();
                if($exist_email) {
                    return Redirect::to('login')->with('error', 'Entered password is invalid.')
                        ->with('message-type', 'error')->withInput(Input::all());
                }else{
                    return Redirect::to('login')->with('error', 'Entered email address is invalid.')
                        ->with('message-type', 'error')->withInput(Input::all());
                }

            }

        }catch (Exception $e){
            return $e->getMessage();
        }
    }
    public function update_parent_data(Request $request){
        try{

            $user = User::firstOrNew(['id' => $request->user_id]);
            $user->first_name = $request->fName;
            $user->last_name = $request->lName;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->save();
            Log::info($request->fName.' parent detail has been updated');
            return Redirect::to('parent/get-profile')->with('success', 'User detail has been updated successfully')
                ->with('message-type', 'success');

        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    public function forgot_password(){
        return view('users.forgot-password');
    }
    public function post_forgot_password(Request $request){
        try{
            $user_detail = User::where('email',$request->email)->first();
            if($user_detail) {
                $password = $this->random_password(6);

                $user = User::firstOrNew(['id' => $user_detail->id]);
                $user->password =  Hash::make($password);
                $user->save();


                Helpers::sendForgotMail($password,$user_detail->email);
                return Redirect::to('forgot-password')->with('success', 'Reset password has been sent to your registered Email ID')
                    ->with('message-type', 'success');

            }else{
                return Redirect::to('forgot-password')->with('error', 'Email ID you have entered does not match with any account. Register for an account.')
                    ->with('message-type', 'error')->withInput(Input::all());
            }



        }catch (\Exception $e){
            Log::error('post_forgot_password', ['Exception' => $e->getMessage()]);
        }
    }
    function random_password( $length = 8 ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $password = substr( str_shuffle( $chars ), 0, $length );
        return $password;
    }

    public function dashboard(){

        return view('users.dashboard');
    }


    public function parent_logout(){
        try{
            Log::info(Auth::guard('business')->user()->first_name.' parent has been logout');
            Auth::guard('business')->logout();
                return redirect('/');
        }catch (\Exception $e){
            Log::error('parent_logout', ['Exception' => $e->getMessage()]);
        }
    }
    public function document_file(){
        return view('users.upload_document');
    }
    public function post_upload_document(Request $request){
       try{
          $user_detail = Auth::guard('business')->user();

           $file = $request->file('document_file');


               $destinationPath = public_path('/uploads/document/');
               $fileName  = Helpers::upload_images($file,$destinationPath);

               $doc = new StudentDocument();
               $doc->parent_id = $user_detail->id;
               $doc->document_type = $request->document_type;
               $doc->document_file = $fileName;
               $doc->save();
           Log::info($user_detail->fName.' parent has been upload new document');
           return Redirect::to('parent/upload-document')->with('success', 'Your document submitted successfully.')
               ->with('message-type', 'success');




       }catch (Exception $e){
           return $e->getMessage();
       }
    }
    public function document_list(){
        $user_detail = Auth::guard('business')->user();
        $student_documents = StudentDocument::where('parent_id',$user_detail->id)->get();

        return view('users.document_list',compact('student_documents'));
    }
    public function administrator_list(){

        $administrator_documents = CommonDocument::where('document_type','Parent')->get();

        return view('users.administratot_document_list',compact('administrator_documents'));
    }



}