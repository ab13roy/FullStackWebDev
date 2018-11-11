<?php

namespace App\Http\Controllers;

use App\Admin;
use App\DataTables\GeneralSettingDataTable;
use App\Helpers;
use App\Http\Requests;
use App\Http\Requests\CreateGeneralSettingRequest;
use App\Http\Requests\UpdateGeneralSettingRequest;
use App\Models\GeneralSetting;
use App\Repositories\GeneralSettingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;
use Response;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Auth;
use Illuminate\Support\Facades\Hash;
class GeneralSettingController extends AppBaseController
{
    /** @var  GeneralSettingRepository */
    private $generalSettingRepository;

    public function __construct(GeneralSettingRepository $generalSettingRepo)
    {
        $this->generalSettingRepository = $generalSettingRepo;
    }

    /**
     * Display a listing of the GeneralSetting.
     *
     * @param GeneralSettingDataTable $generalSettingDataTable
     * @return Response
     */
    public function index()
    {
        $generalSetting = $this->generalSettingRepository->findWithoutFail(1);
        return view('general_settings.edit')->with('generalSetting', $generalSetting);
    }

    /**
     * Show the form for creating a new GeneralSetting.
     *
     * @return Response
     */
    public function create()
    {
        return view('general_settings.create');
    }

    /**
     * Store a newly created GeneralSetting in storage.
     *
     * @param CreateGeneralSettingRequest $request
     *
     * @return Response
     */
    public function store(CreateGeneralSettingRequest $request)
    {

        $input = $request->all();

        $generalSetting = $this->generalSettingRepository->create($input);

        Flash::success('General Setting saved successfully.');

        return redirect(route('generalSettings.index'));
    }

    /**
     * Display the specified GeneralSetting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $generalSetting = $this->generalSettingRepository->findWithoutFail($id);

        if (empty($generalSetting)) {
            Flash::error('General Setting not found');

            return redirect(route('generalSettings.index'));
        }

        return view('general_settings.show')->with('generalSetting', $generalSetting);
    }

    /**
     * Show the form for editing the specified GeneralSetting.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
//         return Admin::where('id',Auth::guard('admin')->user()->id)->with('rolePermission')->first();
        $generalSetting = $this->generalSettingRepository->findWithoutFail($id);


        return view('general_settings.edit')->with('generalSetting', $generalSetting);
    }

    /**
     * Update the specified GeneralSetting in storage.
     *
     * @param  int              $id
     * @param UpdateGeneralSettingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGeneralSettingRequest $request)
    {
        try {


            $rules = array(
                'home_page_youtube' => 'required_if:homepage_url_type,3',
                'homepage_url_type' => 'required',
                'search_radius' => 'required|min:1|numeric|between:0,9999.99|regex:/^[0-9.\-]+$/i',
                'facebook_link' => 'required|url',
                'twitter_link' => 'required|url',
                'instagram_link' => 'required|url',
                'google_image_count' => 'required|min:1|integer|between:0,9999|regex:/^[0-9.\-]+$/i',
                'admin_email' => 'required|email',
                'google_api_key' => 'required',
            );

            $message=[
                'search_radius.required'=>'Enter a Radius Limit',
                'search_radius.min'=>'Enter a Valid Radius Limit',
                'search_radius.between'=>'Enter a Valid Radius Limit',
                'search_radius.regex'=>'Enter a Valid Radius Limit',
                'search_radius.numeric'=>'Enter a Valid Radius Limit',

                'google_image_count.required'=>'Enter a Google Image Count',
                'google_image_count.integer'=>'Enter a Valid Google Image Count',
                'google_image_count.min'=>'Enter a Valid Google Image Count',
                'google_image_count.regex'=>'Enter a Valid Google Image Count',
                'google_image_count.between'=>'Enter a Valid Google Image Count',

                'admin_email.required'=>'Enter an Email ID',
                'admin_email.email'=>'Enter a Valid Email ID',

                'google_api_key.required'=>'Enter a Google API Key',

                'facebook_link.required'=>'Enter a Facebook Link',
                'facebook_link.url'=>'Enter a Valid Facebook Link',

                'twitter_link.required'=>'Enter a Twitter Link',
                'twitter_link.url'=>'Enter a Valid Twitter Link',

                'instagram_link.required'=>'Enter an Instagram Link',
                'instagram_link.url'=>'Enter a Valid Instagram Link',


            ];


            $validator = Validator::make($request->all(), $rules,$message);


            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }

            if($request->search_radius < 0){
                Flash::error('Enter a Valid Radius Limit');
                return redirect(route('generalSettings.index' ));
            }
            if($request->google_image_count < 1){
                Flash::error('Enter a Valid Google Image Count');
                return redirect(route('generalSettings.index' ));
            }


            $destinationPath = public_path('/uploads/home_page/');
            $generalSetting  = GeneralSetting::where('setting_key', 'HOMEPAGE_URL_TYPE')->first();

            if ($request->homepage_url_type == 1) {

                if($request->homepage_url_type == $generalSetting->value) {

                    if ($file = $request->file('home_page_image')) {


                        $rules = array(
                            'home_page_image' => 'image|mimes:jpeg,png,jpg',
                        );

                        $message=[
                           'home_page_image.image'=>'Upload a Valid Homepage Image',
                           'home_page_image.mimes'=>'Upload a Valid Homepage Image'
                        ];


                        $validator = Validator::make($request->all(), $rules,$message);

                        if ($validator->fails()) {
                            return Redirect::back()->withErrors($validator)->withInput();
                        }

                        $generalSetting_home_page_url  = GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->first();
                        Helpers::unlinkImages($destinationPath . $generalSetting_home_page_url->value);

                        $fileName = Helpers::upload_images($file, $destinationPath);

                        GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->update(['value' => $fileName]);

                    }
                }else{
                    if ($file = $request->file('home_page_image')) {

                        $generalSetting_home_page_url  = GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->first();
                        Helpers::unlinkImages($destinationPath . $generalSetting_home_page_url->value);

                        $fileName = Helpers::upload_images($file, $destinationPath);

                        GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->update(['value' => $fileName]);

                    }else {

                        $rules = array(
                            'home_page_image' =>  'required|image|mimes:jpeg,png,jpg',
                        );

                        $message=[
                            'home_page_image.image'=>'Upload a Valid Homepage Image',
                            'home_page_image.mimes'=>'Upload a Valid Homepage Image',
                        ];
                        $validator = Validator::make($request->all(), $rules,$message);
                        if ($validator->fails()) {
                            return Redirect::back()->withErrors($validator)->withInput();
                        }
                    }


                }

            } else if ($request->homepage_url_type == 2) {

                if($request->homepage_url_type == $generalSetting->value) {

                    if ($file = $request->file('home_page_video')) {

                        $rules = array(
                            'home_page_video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
                        );

                        $message=[
                            'home_page_video.mimes'=>'Upload a Valid Homepage Video',
                        ];
                        $validator = Validator::make($request->all(), $rules,$message);

                        if ($validator->fails()) {
                            return Redirect::back()->withErrors($validator)->withInput();
                        }

                        $generalSetting_home_page_url  = GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->first();
                        Helpers::unlinkImages($destinationPath . $generalSetting_home_page_url->value);

                        $fileName = Helpers::upload_images($file, $destinationPath);

                        GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->update(['value' => $fileName]);

                    }
                }else{
                    if ($file = $request->file('home_page_video')) {

                        $rules = array(
                            'home_page_video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
                        );

                        $message=[
                            'home_page_video.mimes'=>'Upload a Valid Homepage Video',
                        ];
                        $validator = Validator::make($request->all(), $rules,$message);

                        if ($validator->fails()) {
                            return Redirect::back()->withErrors($validator)->withInput();
                        }

                        $generalSetting_home_page_url  = GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->first();
                        Helpers::unlinkImages($destinationPath . $generalSetting_home_page_url->value);

                        $fileName = Helpers::upload_images($file, $destinationPath);

                        GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->update(['value' => $fileName]);

                    }else {

                        $rules = array(
                            'home_page_video' => 'required|mimes:mp4,ogx,oga,ogv,ogg,webm',
                        );

                        $message=[
                            'home_page_video.mimes'=>'Upload a Valid Homepage Video',
                        ];
                        $validator = Validator::make($request->all(), $rules,$message);

                        if ($validator->fails()) {
                            return Redirect::back()->withErrors($validator)->withInput();
                        }
                    }


                }
            } else {
                GeneralSetting::where('setting_key', 'HOMEPAGE_URL')->update(['value' => $request->home_page_youtube]);
            }
            GeneralSetting::where('setting_key','SEARCH_RADIUS')->update(['value' => $request->search_radius]);
            GeneralSetting::where('setting_key','HOMEPAGE_URL_TYPE')->update(['value' => $request->homepage_url_type]);
            GeneralSetting::where('setting_key','FACEBOOK_LINK')->update(['value' => $request->facebook_link]);
            GeneralSetting::where('setting_key','TWITTER_LINK')->update(['value' => $request->twitter_link]);
            GeneralSetting::where('setting_key','INSTAGRAM_LINK')->update(['value' => $request->instagram_link]);
            GeneralSetting::where('setting_key','GOOGLE_IMAGE_COUNT')->update(['value' => $request->google_image_count]);
            GeneralSetting::where('setting_key','ADMIN_EMAIL')->update(['value' => $request->admin_email]);
            GeneralSetting::where('setting_key','GOOGLE_API_KEY')->update(['value' => $request->google_api_key]);



          //  $generalSetting = $this->generalSettingRepository->update($general_data, $id);

            Flash::success('General Setting has been updated successfully.');

            return redirect(route('generalSettings.index' ));
        }catch (Exception $e){
            Log::error('update', ['Exception' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified GeneralSetting from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $generalSetting = $this->generalSettingRepository->findWithoutFail($id);

        if (empty($generalSetting)) {
            Flash::error('General Setting not found');

            return redirect(route('generalSettings.index'));
        }

        $this->generalSettingRepository->delete($id);

        Flash::success('General Setting deleted successfully.');

        return redirect(route('generalSettings.index'));
    }
}
