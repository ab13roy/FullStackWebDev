<?php

namespace App\Http\Controllers;

use App\DataTables\CoachDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCoachRequest;
use App\Http\Requests\UpdateCoachRequest;
use App\Models\Coach;
use App\Models\CoachDocument;
use App\Repositories\CoachRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Response;
use Validator;
use Redirect;
class CoachController extends AppBaseController
{
    /** @var  CoachRepository */
    private $coachRepository;

    public function __construct(CoachRepository $coachRepo)
    {
        $this->coachRepository = $coachRepo;
    }

    /**
     * Display a listing of the Coach.
     *
     * @param CoachDataTable $coachDataTable
     * @return Response
     */
    public function index(CoachDataTable $coachDataTable)
    {
        return $coachDataTable->render('coaches.index');
    }

    /**
     * Show the form for creating a new Coach.
     *
     * @return Response
     */
    public function create()
    {
        return view('coaches.create');
    }

    /**
     * Store a newly created Coach in storage.
     *
     * @param CreateCoachRequest $request
     *
     * @return Response
     */
    public function store(CreateCoachRequest $request)
    {


        $rules = array(
            'name' =>'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name' =>'required|regex:/^[a-z0-9 .\-]+$/i',
            'email' => 'required|email|unique:admins',
            'phone' => 'required|regex:/^(?=.*[0-9])[- +()0-9]+$/|min:6|max:16',
            'password' => 'required',
            'conf_password' => 'required|same:password',
            'gender' => 'required',
            'language' => 'required'
        );

        $message=[
            'name.required'=>'Enter a First Name',
            'last_name.required'=>'Enter a Last Name',
            'name.regex'=>'Enter a Valid First Name',
            'last_name.regex'=>'Enter a Valid Last Name',

            'email.required'=>'Enter an Email',
            'email.email'=>'Enter a Valid Email',
            'email.unique'=>'Email is Used. Try Another',

            'phone.required'=>'Enter a Phone',
            'phone.regex'=>'Enter a Valid Phone',
            'phone.min'=>'Enter a Valid Phone',
            'phone.max'=>'Enter a Valid Phone',
            'phone.unique'=>'Phone is Used. Try Another',

            'password.required'=>'Enter a Password',
            'conf_password.required'=>'Confirm a Password',
            'conf_password.same'=>"Passwords Don't Match",

            'gender.required'=>"Choose a Gender",
            'language.required'=>"Choose a Language",

        ];

        $validator = Validator::make($request->all(), $rules,$message);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        $input = $request->all();
        $input['password'] = ucwords(Hash::make($request->password));
        if(count($request->language)>0){
            $str = implode (",", $request->language);
            $input['language'] = $str;
        };



        $coach = $this->coachRepository->create($input);

        Flash::success('Coach saved successfully.');

        Log::info('Admin has been create new coach user is => '.$request->email);

        return redirect(route('coaches.index'));
    }

    /**
     * Display the specified Coach.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coach = $this->coachRepository->findWithoutFail($id);

        if (empty($coach)) {
            Flash::error('Coach not found');

            return redirect(route('coaches.index'));
        }
        $document_list = CoachDocument::where('coach_id',$id)->get();

        return view('coaches.show',compact('document_list'))->with('coach', $coach);
    }

    /**
     * Show the form for editing the specified Coach.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coach = $this->coachRepository->findWithoutFail($id);


        if (empty($coach)) {
            Flash::error('Coach not found');

            return redirect(route('coaches.index'));
        }

        $languages = explode(',', $coach->language);

        return view('coaches.edit',compact('languages'))->with('coach', $coach);
    }

    /**
     * Update the specified Coach in storage.
     *
     * @param  int              $id
     * @param UpdateCoachRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoachRequest $request)
    {
        $coach = $this->coachRepository->findWithoutFail($id);

        if (empty($coach)) {
            Flash::error('Coach not found');

            return redirect(route('coaches.index'));
        }



        $rules = array(
            'name' =>'required|regex:/^[a-z0-9 .\-]+$/i',
            'last_name' =>'required|regex:/^[a-z0-9 .\-]+$/i',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(?=.*[0-9])[- +()0-9]+$/|min:6|max:16',
            'gender' => 'required',
            'language' => 'required'
        );

        $message=[
            'name.required'=>'Enter a First Name',
            'last_name.required'=>'Enter a Last Name',
            'first_name.regex'=>'Enter a Valid First Name',
            'last_name.regex'=>'Enter a Valid Last Name',

            'email.required'=>'Enter an Email',
            'email.email'=>'Enter a Valid Email',
            'email.unique'=>'Email is Used. Try Another',

            'phone.required'=>'Enter a Phone',
            'phone.regex'=>'Enter a Valid Phone',
            'phone.min'=>'Enter a Valid Phone',
            'phone.max'=>'Enter a Valid Phone',
            'phone.unique'=>'Phone is Used. Try Another',

            'gender.required'=>"Choose a Gender",
            'language.required'=>"Choose a Language",

        ];

        $validator = Validator::make($request->all(), $rules,$message);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput($request->all());
        }

        if($request->password != ""){

            $rules = array(
                'password' => 'required',
                'conf_password' => 'required|same:password',
            );

            $message=[
                'password.required'=>'Enter a Password .',
                'conf_password.required'=>'Confirm a Password.',
                'conf_password.same'=>"Passwords Don't Match.",
            ];
            $validator = Validator::make($request->all(), $rules,$message);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }
        }

        $exist_email = Coach::where('id','!=',$id)->where('email',$request->email)->exists();
        if($exist_email){
            Flash::error('Email is Used. Try Another');
            return  Redirect::back();
        }


        if($request->password == ""){
            $coach_data = [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'gender' => $request->gender,
                'language' => $request->language,

            ];
        }else{
            $coach_data = [
                'name' => $request->name,
                'last_name' => $request->last_name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'language' => $request->language,

            ];
        }
        if(count($request->language)>0){
            $str = implode (",", $request->language);
            $coach_data['language'] = $str;
        };

        $coach = $this->coachRepository->update($coach_data, $id);

        Log::info('Admin has been update coach detail for  => '.$request->email);

        Flash::success('Coach updated successfully.');

        return redirect(route('coaches.index'));
    }

    /**
     * Remove the specified Coach from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coach = $this->coachRepository->findWithoutFail($id);

        if (empty($coach)) {
            Flash::error('Coach not found');

            return redirect(route('coaches.index'));
        }

        $this->coachRepository->delete($id);

        Log::info('Admin has been deleted coach user is => '.$coach->email);
        Flash::success('Coach deleted successfully.');

        return redirect(route('coaches.index'));
    }
}
