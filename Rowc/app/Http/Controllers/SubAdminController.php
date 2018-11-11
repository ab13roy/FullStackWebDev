<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DataTables\SubAdminDataTable;
use App\Helpers;
use App\Http\Requests;
use App\Http\Requests\CreateSubAdminRequest;
use App\Http\Requests\UpdateSubAdminRequest;

use App\Models\SubAdmin;
use App\Repositories\SubAdminRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Response;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Hash;
class SubAdminController extends AppBaseController
{
    /** @var  SubAdminRepository */
    private $subAdminRepository;

    public function __construct(SubAdminRepository $subAdminRepo)
    {
        $this->subAdminRepository = $subAdminRepo;
    }

    /**
     * Display a listing of the SubAdmin.
     *
     * @param SubAdminDataTable $subAdminDataTable
     * @return Response
     */
    public function index(SubAdminDataTable $subAdminDataTable)
    {


        return $subAdminDataTable->render('sub_admins.index');
    }

    /**
     * Show the form for creating a new SubAdmin.
     *
     * @return Response
     */
    public function create()
    {
        return view('sub_admins.create');
    }

    /**
     * Store a newly created SubAdmin in storage.
     *
     * @param CreateSubAdminRequest $request
     *
     * @return Response
     */
    public function store(CreateSubAdminRequest $request)
    {

        $rules = array(
            'name' =>'required|regex:/^[a-z0-9 .\-]+$/i',
            'email' => 'required|email|unique:admins',
            'phone' => 'required|regex:/^(?=.*[0-9])[- +()0-9]+$/|min:6|max:16|unique:admins',
            'password' => 'required',
            'conf_password' => 'required|same:password',
            'status' => 'required'
        );

        $message=[
            'name.required'=>'Enter a Name',
            'name.regex'=>'Enter a Valid Name',

            'email.required'=>'Enter an Email',
            'email.email'=>'Enter a Valid Email',
            'email.unique'=>'Email is Used. Try Another',

            'phone.required'=>'Enter a Phone',
            'phone.regex'=>'Enter a Valid Phone',
            'phone.min'=>'Enter a Valid Phone',
            'phone.max'=>'Enter a Valid Phone',
            'phone.unique'=>'Phone is Used. Try Another',

            'password.required'=>'Enter a Password',
            'password.regex'=>'Enter a Combination of at least Six Numbers, Letters and Special Characters',
            'conf_password.required'=>'Confirm a Password',
            'conf_password.same'=>"Passwords Don't Match",

            'status.required'=>"Choose a Status",

        ];

        $validator = Validator::make($request->all(), $rules,$message);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $input['password'] = ucwords(Hash::make($request->password));

        $subAdmin = $this->subAdminRepository->create($input);

        Log::info('Admin has been created new sub admin is => '.$request->email);
        Flash::success('Sub Admin has been added successfully.');

        return redirect(route('subAdmins.index'));
    }

    /**
     * Display the specified SubAdmin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subAdmin = $this->subAdminRepository->findWithoutFail($id);

        if (empty($subAdmin)) {
            Flash::error('Sub Admin not found');

            return redirect(route('subAdmins.index'));
        }

        return view('sub_admins.show')->with('subAdmin', $subAdmin);
    }

    /**
     * Show the form for editing the specified SubAdmin.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subAdmin = $this->subAdminRepository->findWithoutFail($id);

        if (empty($subAdmin)) {
            Flash::error('Sub Admin not found');

            return redirect(route('subAdmins.index'));
        }
        return view('sub_admins.edit')->with('subAdmin', $subAdmin);
    }

    /**
     * Update the specified SubAdmin in storage.
     *
     * @param  int              $id
     * @param UpdateSubAdminRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSubAdminRequest $request)
    {

        $rules = array(
            'name' =>'required|regex:/^[a-z0-9 .\-]+$/i',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(?=.*[0-9])[- +()0-9]+$/|min:6|max:16',
            'status' => 'required'
        );

        $message=[
            'name.required'=>'Enter a Name',
            'name.regex'=>'Enter a Valid Name',

            'email.required'=>'Enter an Email',
            'email.email'=>'Enter a Valid Email.',

            'phone.required'=>'Enter a Phone',
            'phone.regex'=>'Enter a Valid Phone',
            'phone.min'=>'Enter a Valid Phone',
            'phone.max'=>'Enter a Valid Phone',

            'status.required'=>"Choose a Status",

        ];

        $validator = Validator::make($request->all(), $rules,$message);


        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
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

        $subAdmin = $this->subAdminRepository->findWithoutFail($id);

        if (empty($subAdmin)) {
            Flash::error('Sub Admin not found');

            return redirect(route('subAdmins.index'));
        }
        $exist_email = SubAdmin::where('id','!=',$id)->where('email',$request->email)->exists();
        if($exist_email){
            Flash::error('Email is Used. Try Another');
            return  Redirect::back();
        }


        if($request->password == ""){
            $sub_admin_data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $request->status,
            ];
        }else{
            $sub_admin_data = [
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => $request->status,
            ];
        }


        $subAdmin = $this->subAdminRepository->update($sub_admin_data, $id);
        Log::info('Admin has been update sub admin detail for  => '.$request->email);

        Flash::success('Sub Admin has been updated successfully.');

        return redirect(route('subAdmins.index'));
    }

    /**
     * Remove the specified SubAdmin from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy_sub_admin(Request $request){
        $subAdmin = $this->subAdminRepository->findWithoutFail($request->id);

        if (empty($subAdmin)) {
            Flash::error('Sub Admin not found');

            return redirect(route('subAdmins.index'));
        }

        $this->subAdminRepository->delete($request->id);

        Log::info('Admin has been deleted Sub Admin user is => '.$subAdmin->email);
        Flash::success('Sub Admin deleted successfully.');

        return redirect(route('subAdmins.index'));
    }
    public function destroy(Request $request)
    {

        $subAdmin = $this->subAdminRepository->findWithoutFail($request->id);

        if (empty($subAdmin)) {
            Flash::error('Sub Admin not found');

            return redirect(route('subAdmins.index'));
        }

        $this->subAdminRepository->delete($request->id);

        Flash::success('Sub Admin deleted successfully.');

        return redirect(route('subAdmins.index'));
    }
    public function active_sub_admin(Request $request){

        $admin  = Admin::where('id',$request->status_id)->first();
        if($request->status == 0) {

            $status = "Active";
            Log::info('Admin has been active Sub Admin user of => '.$admin->email);
        }else{
            $status = "Not Active";
            Log::info('Admin has been de-active Sub Admin user of => '.$admin->email);
        }

        $status_data = [
            'status' => $status
        ];
        Admin::where('id',$request->status_id)->update($status_data);
        return 1;
    }
}
