<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Attendence;
use App\CoachTrack;
use App\Helpers;
use App\Models\Coach;
use App\Models\EmailTemplate;
use App\Models\Section;
use App\Models\Student;
use App\Models\Track;
use App\SectionTrack;
use App\StudentTrack;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Hash;
use Auth;
use Illuminate\Support\Facades\Log;
use Exception;
use Config;
class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('admin', ['except' => 'logout']);
    }

    public function getAdminLogin()
    {
        try {

            if (auth()->guard('admin')->user()) return redirect()->route('admin.dashboard');
            return view('auth.login');
        }catch (\Exception $e){
            Log::error('getAdminLogin', ['Exception' => $e->getMessage()]);
        }
    }
    public function dashboard(){
        try {
           if (auth()->guard('admin')->user()) {
                $section = Section::all();
               return view('dashboard',compact('section'));
           }else{
               return view('admin.login');
           }

        }catch (\Exception $e){
            Log::error('getAdminLogin', ['Exception' => $e->getMessage()]);
        }
    }
    public function get_section_data(Request $request){
        try {
            $track_data_array = array();
            $track_list =  SectionTrack::with('getTrackDetail','getTrackCoachDetail')->where('section_id',$request->sectionID)->get();
            if(sizeof($track_list)>0){
                foreach ($track_list as $track){
                    $track_data['track_id'] = $track->track_id;
                    $track_data['section_id'] = $track->section_id;
                    if($track->getTrackDetail) {
                        $track_data['track_name'] = $track->getTrackDetail->title;
                    }else{
                        $track_data['track_name'] = "";
                    }
                    if($track->getTrackCoachDetail){
                        $coach_detail = Coach::where('id',$track->getTrackCoachDetail->coach_id)->first();
                        if($coach_detail){
                            $track_data['track_coach_name'] = $coach_detail->name;
                        }else{
                            $track_data['track_coach_name'] ="";
                        }

                    }else{
                        $track_data['track_coach_name'] ="";
                    }
                    $track_data['student_count'] = StudentTrack::where('track_id',$track->track_id)->count();
                    $track_data_array[] = $track_data;
                }
            }
            return $track_data_array;



        }catch (\Exception $e){
            Log::error('get_section_data', ['Exception' => $e->getMessage()]);
        }
    }
    public function get_track_student($id){
          $student_track = StudentTrack::with('getStudentDetail','getTrackDetail')->where('track_id',$id)->get();
    }

    public function adminAuth(Request $request)
    {
        try {

            $rules = array(
                'email' => 'required|email',
                'password' => 'required|max:30|min:5'
            );

            $message=[
                'email.required'=>'Enter an Email ID.',
                'email.email'=>'Enter a Valid Email ID.',
                'password.required'=>'Enter a Password.'
            ];

            $validator = Validator::make($request->all(), $rules,$message);

            // If validation fails, we'll exit the operation now.
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

//            if ($validator->fails()) {
//                return back()->with('error', 'Invalid username or password.');
//            }

            if (auth()->guard('admin')->attempt(['email' => $request->input('email'), 'password' => $request->input('password'),'status' => 'Active'])) {
                if (Auth::guard('admin')->user()->is_admin == 2) {
                    Log::info(Auth::guard('admin')->user()->name.' coach has been login');
                } else {
                    Log::info(Auth::guard('admin')->user()->name.' admin has been login');
                }
                return redirect()->route('admin.dashboard');
            } else {
                $exist_email = Admin::where('email',$request->input('email'))->first();
                if($exist_email){
                    if($exist_email->status == "Not Active"){
                        return back()->with('error', "Account is Deactivated.");
                    }else{
                        return back()->with('error', "Wrong Password. Try Again or Check for Forgot Password.");
                    }

                }else{
                    return back()->with('error', "Email ID you have entered doesn't match with any account. Register for an account.");
                }


            }
        }catch (\Exception $e){
            Log::error('adminAuth', ['Exception' => $e->getMessage()]);
        }

    }
	 public function logout(Request $request)
    {
        try {
            $user = Auth::guard('admin')->user();
            if (Auth::guard('admin')->user()->is_admin == 2) {
                Log::info(Auth::guard('admin')->user()->name.' coach has been logout');
            } else {
                Log::info(Auth::guard('admin')->user()->name.' admin has been logout');
            }
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        }catch (\Exception $e){
            Log::error('logout', ['Exception' => $e->getMessage()]);
        }
    }
    public function access_denide(){
          return view('access_denide.access_denide');
    }
    public function get_profile(){
        try {
            $user_detail = Auth::guard('admin')->user();
            if($user_detail->language !="" && $user_detail->language !=null ) {
                $languages = explode(',', $user_detail->language);
            }else{
                $languages = array();
            }
            return view('admin_profile',compact('user_detail','languages'));
        }catch (\Exception $e){
            Log::error('get_profile', ['Exception' => $e->getMessage()]);
        }
    }
    public function update_profile(Request $request){
        try {

            if(Auth::guard('admin')->user()->is_admin == 2) {

                $rules = array(
                    'name' => 'required|regex:/^[a-z0-9 .\-]+$/i',
                    'last_name' => 'required|regex:/^[a-z0-9 .\-]+$/i',
                    'phone' => 'required|max:16|regex:/[0-9]{6}/',
                    'email' => 'required|email',
                    'profile' => 'mimes:jpeg,jpg,png | max:500',
                    'gender' => 'required',
                    'language' => 'required'
                );

                $message = [
                    'name.required' => 'Enter a First Name',
                    'last_name.required' => 'Enter a Last Name',
                    'name.regex' => 'Enter a Valid Name',
                    'last_name.regex' => 'Enter a Valid Last Name',
                    'email.required' => 'Enter an Email ID',
                    'email.email' => 'Enter a Valid Email ID',
                    'phone.required' => 'Enter a Phone Number',
                    'phone.regex' => 'Enter a Valid Phone Number',
                    'phone.max' => 'Enter a Valid Phone Number',
                    'profile.mimes' => 'Upload a Valid Profile Photo',
                    'gender.required'=>"Choose a Gender",
                    'language.required'=>"Choose a Language",
                ];
            }else{
                $rules = array(
                    'name' => 'required|regex:/^[a-z0-9 .\-]+$/i',
                    'phone' => 'required|max:16|regex:/[0-9]{6}/',
                    'email' => 'required|email',
                    'profile' => 'mimes:jpeg,jpg,png | max:500',
                );

                $message = [
                    'name.required' => 'Enter a Name',
                    'name.regex' => 'Enter a Valid Name',
                    'email.required' => 'Enter an Email ID',
                    'email.email' => 'Enter a Valid Email ID',
                    'phone.required' => 'Enter a Phone Number',
                    'phone.regex' => 'Enter a Valid Phone Number',
                    'phone.max' => 'Enter a Valid Phone Number',
                    'profile.mimes' => 'Upload a Valid Profile Photo',
                ];
            }





            $validator = Validator::make($request->all(), $rules,$message);

                if ($validator->fails()) {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                $exist_admin = Admin::where('id','!=',$request->id)->where('email',$request->email)->exists();
                if($exist_admin){
                    return Redirect::back()->withErrors("Email ID is Used. Try Another")->withInput();
                }
            $exist_phone = Admin::where('id','!=',$request->id)->where('phone',$request->phone)->exists();
            if($exist_phone){
                return Redirect::back()->withErrors("Phone Number is Used. Try Another")->withInput();
            }




            $user_detail = Admin::firstOrNew(['id' => $request->id]);
            $user_detail->email =$request->email;
            $user_detail->phone =$request->phone;
            $user_detail->name = $request->name;
            if(Auth::guard('admin')->user()->is_admin == 2) {
                $str = implode (",", $request->language);
                $user_detail->gender =$request->gender;
                $user_detail->last_name = $request->last_name;
                $user_detail->language = $str;
            }
            if ($file = $request->file('profile')) {
                $rules = array(
                    'profile' => 'mimes:jpeg,jpg,png | max:2048',
                );

                $message=[
                    'profile.mimes'=>'Upload a Valid Profile Photo'
                ];

                $validator = Validator::make($request->all(), $rules,$message);
                $destinationPath = public_path('/uploads/admin/');
                $fileName  = Helpers::upload_images($file,$destinationPath);
                $user_detail->profile = $fileName;
                Helpers::unlinkImages($destinationPath.$request->old_image_name);
            }
            $user_detail->save();



            if (Auth::guard('admin')->user()->is_admin == 2) {
                Log::info(Auth::guard('admin')->user()->name.' coach has been update his profile detail');
            } else {
                Log::info(Auth::guard('admin')->user()->name.' admin has been update his profile detail');
            }

                return   Redirect::to('admin/profile')->with('success', 'Profile has been updated successfully')
                    ->with('message-type', 'success');

        }catch (\Exception $e){
            Log::error('update_profile', ['Exception' => $e->getMessage()]);
            return Redirect::back()->withErrors($e->getMessage())->withInput();
        }

    }
    public function change_password(){
        try {
            $user_detail = Auth::guard('admin')->user();
            return view('admin_change_password',compact('user_detail'));
        }catch (\Exception $e){
            Log::error('change_password', ['Exception' => $e->getMessage()]);
        }
    }
    public function update_password(Request $request){
        try{
            $rules = array(
                'old_password' =>'required',
                'new_password' => 'required|min:6',
                'retype_password' => 'required|min:6|same:new_password'
            );

            $message=[
                'old_password.required'=>'Enter Old Password.',
                'new_password.required'=>'Enter a New Password.',
                'new_password.same'=>"Passwords Don't Match.",
                'retype_password.required'=>'Confirm a Password.'
            ];

            $validator = Validator::make($request->all(), $rules,$message);

            // If validation fails, we'll exit the operation now.
            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $user = Admin::where('id',$request->id)->first();
            if (Hash::check($request->get('old_password'),$user->password)) {
                $new_password = Hash::make($request->new_password);
                $data = [
                    'password' => $new_password
                ];
                Admin::Where('id', $request->id)->update($data);

            }else{
                return Redirect::back()->withErrors("Wrong Old Password")->withInput();
            }

            if (Auth::guard('admin')->user()->is_admin == 2) {
                Log::info(Auth::guard('admin')->user()->name.' coach has been update his password detail');
            } else {
                Log::info(Auth::guard('admin')->user()->name.' admin has been update his password detail');
            }

            return   Redirect::to('admin/change-password')->with('success', 'Your password has been changed successfully.')
                ->with('message-type', 'success');

        }catch (\Exception $e){
            Log::error('update_password', ['Exception' => $e->getMessage()]);
            return Redirect::back()->withErrors($e->getMessage())->withInput();
        }
    }
    public function reset_password(){
        try {
            return view('auth.passwords.email');
        }catch (\Exception $e){
            Log::error('reset_password', ['Exception' => $e->getMessage()]);
        }
    }
    public function post_reset_password(Request $request){
        try {

            $rules = array(
                'email' =>'required|email'
            );

            $message=[
                'email.required'=>'Enter an Email ID',
                'email.email'=>'Enter a Valid Email ID'
            ];

            $validator = Validator::make($request->all(), $rules,$message);


            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            $email_exist = Admin::where('email', $request->email)->where('status', 'Active')->exists();
            if (!$email_exist) {
                return Redirect::to('admin/password/reset')->with('status', "Email ID you have entered doesn't match.")
                    ->with('message-type', 'status');
            }

            $email_data = Admin::where('email', $request->email)->first();
            if($email_data){
                $password =  app('App\Http\Controllers\UserLoginController')->random_password(6);

                $user = Admin::firstOrNew(['id' => $email_data->id]);
                $user->password =  Hash::make($password);
                $user->save();


                Helpers::sendForgotMail($password,$email_data->email);
                return Redirect::to('admin/password/reset')->with('success', 'Reset password has been sent to your registered Email ID')
                    ->with('message-type', 'success');
            }

            if (Auth::guard('admin')->user()->is_admin == 2) {
                Log::info(Auth::guard('admin')->user()->name.' coach has been reset his profile password');
            } else {
                Log::info(Auth::guard('admin')->user()->name.' admin has been update his profile password');
            }

            return Redirect::to('admin/password/reset')->with('success', 'Reset password link has been sent to your registered Email ID.')
                ->with('message-type', 'success');
        }catch (\Exception $e){
            Log::error('post_reset_password', ['Exception' => $e->getMessage()]);
        }

    }
    public function get_reset_password($token){

        try{
            $current_time = date(Config::get('constant.DATE_FORMAT'));
            $exist_data = DB::table('reset_token')->where('token',$token)->first();
            if($exist_data){
                if($exist_data->token_expire >= $current_time) {
                    $user_detail = Admin::where('email',$exist_data->email)->first();
                    $valid = 1;
                }else{
                    $user_detail = json_decode("{}");
                    $valid = 2;
                }
            }else{
                $user_detail = json_decode("{}");
                $valid =0;
            }

            return view('auth.passwords.reset',compact('user_detail','valid'));
        }catch (Exception $e){
            Log::error('get_reset_password', ['Exception' => $e->getMessage()]);
        }

    }
    public function update_reset_password(Request $request){
       try{

           $rules = array(
               'password' =>'required',
               'password_confirmation' => 'required|same:password'
           );

           $message=[
               'password.required'=>'Enter a Password',
               'password_confirmation.required'=>'Confirm a Password',
               'password_confirmation.same'=>"Password Don't Match"
           ];

           $validator = Validator::make($request->all(), $rules,$message);


           if ($validator->fails()) {
               return Redirect::back()->withErrors($validator)->withInput();
           }

           $user_detail = Admin::firstOrNew(['id' => $request->user_id]);
           $user_detail->password = Hash::make($request->password);
           $user_detail->save();
           return Redirect::back()->with('success', 'Your password has been successfully changed.')
               ->with('message-type', 'success');

       }catch (Exception $e){
           Log::error('update_reset_password', ['Exception' => $e->getMessage()]);
       }
    }
    public function pool_shuffle(Request $request){
        try{

            $track_students = StudentTrack::all();
            if(sizeof($track_students)>0){
                $stud_ids = array_pluck($track_students,'student_id');
                $student = Student::whereNotIn('id',$stud_ids)->get();
            }else{
                $student = Student::all();
            }


            if(Auth::guard('admin')->user()->is_admin == 2){
                $track_detail = CoachTrack::with('getTrackDetail')->where('coach_id',Auth::guard('admin')->user()->id)->get();
            }else{
                $track_detail = Track::all();
            }


            return view('pool_shuffle.index',compact('student','track_detail'));

        }catch (Exception $e){
            Log::error('pool_shuffle', ['Exception' => $e->getMessage()]);
        }
    }
    public function add_track_student(Request $request){
        try{

            $exist_student = StudentTrack::where('student_id',$request->student_id)->exists();
            if($exist_student){
                return json_encode(array('status' => 0,  'msg' => "This Student already added by other one,Please refresh this list",'data'=>""));

            }
            $stud = new StudentTrack();
            $stud->track_id = $request->track_id;
            $stud->student_id = $request->student_id;
            $stud->save();

           $student_count = StudentTrack::where('track_id',$request->track_id)->count();
            $track_detail = Track::where('id',$request->track_id)->first();
            if($track_detail) {
                if (Auth::guard('admin')->user()->is_admin == 2) {
                    Log::info(Auth::guard('admin')->user()->name.' coach has been add new student into "'. $track_detail->title.'" track');
                } else {
                    Log::info(Auth::guard('admin')->user()->name.' admin has been add new student into "'.$track_detail->title.'" track');
                }
            }

            return json_encode(array('status' => 1,  'msg' => "Student has been added to track successfully",'data'=>$student_count));

        }catch (Exception $e){
            Log::error('add_track_student', ['Exception' => $e->getMessage()]);
            return json_encode(array('status' => 0,  'msg' => $e->getMessage(),'data'=>""));
        }
    }
    public function track_students_list($track_id){
        try{

            $track_detail = Track::where('id',$track_id)->first();
            $student_list = StudentTrack::with('getStudentDetail')->where('track_id',$track_id)->get();
            $student_list->map(function ($student_list){
                $date = date('Y-m-d');
                $present_student = Attendence::where('track_id',$student_list->track_id)->where('student_id',$student_list->student_id)->where('date',$date)->exists();
                if($present_student) {
                    $student_list->attendence = 1;
                }else{
                    $student_list->attendence = 0;
                }

                $present_student_sum = Attendence::where('track_id',$student_list->track_id)->where('student_id',$student_list->student_id)->sum('hour');
                $present_student_count = Attendence::where('track_id',$student_list->track_id)->where('student_id',$student_list->student_id)->count();
                $student_list->present_student_sum = $present_student_sum;
                $student_list->present_student_count = $present_student_count;



            });


            return view('pool_shuffle.track_student_list',compact('student_list','track_id','track_detail'));

        }catch (Exception $e){
            Log::error('add_track_student', ['Exception' => $e->getMessage()]);
        }
    }
    public function delete_track_student(Request $request){
        try{

            StudentTrack::where('id',$request->student_track_id)->delete();
             if (Auth::guard('admin')->user()->is_admin == 2) {
                    Log::info(Auth::guard('admin')->user()->name.' coach has been deleted student into track');
                } else {
                    Log::info(Auth::guard('admin')->user()->name.' admin has been deleted student into track');
             }

            return json_encode(array('status' => 1,  'msg' => "Student has been deleted to track successfully",'data'=>""));


        }catch (Exception $e){
            Log::error('add_track_student', ['Exception' => $e->getMessage()]);
            return json_encode(array('status' => 0,  'msg' => $e->getMessage(),'data'=>""));
        }
    }
    public function add_student_attendance(Request $request){
        try{
            $date = date('Y-m-d');

           $attend = new Attendence();
           $attend->track_id = $request->track_id;
           $attend->student_id = $request->student_id;
           $attend->hour = 6;
           $attend->date = $date;
           $attend->save();

           Log::info(Auth::guard('admin')->user()->name.' coach has been student attendance into track');

            return json_encode(array('status' => 1,  'msg' => "Student Attendance add to track successfully",'data'=>""));


        }catch (Exception $e){
            Log::error('add_student_attendance', ['Exception' => $e->getMessage()]);
            return json_encode(array('status' => 0,  'msg' => $e->getMessage(),'data'=>""));
        }
    }
    public function get_student_history($id){
      $attendance = Attendence::where('student_id',$id)->with('getTrackDetail')->groupBy('track_id')->get();
        $attendance->map(function ($attendance){

            $present_student_sum = Attendence::where('track_id',$attendance->track_id)->where('student_id',$attendance->student_id)->sum('hour');
            $attendance->present_student_sum = $present_student_sum;
        });
        $total_sum = Attendence::where('student_id',$id)->sum('hour');
        return view('pool_shuffle.student_history',compact('attendance','total_sum'));

    }





}