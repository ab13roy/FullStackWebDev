<?php

namespace App\Http\Controllers;

use App\DataTables\EmailTemplateDataTable;
use App\Helpers;
use App\Http\Requests;
use App\Http\Requests\CreateEmailTemplateRequest;
use App\Http\Requests\UpdateEmailTemplateRequest;
use App\Repositories\EmailTemplateRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Redirect;
use Response;
use Validator;
class EmailTemplateController extends AppBaseController
{
    /** @var  EmailTemplateRepository */
    private $emailTemplateRepository;

    public function __construct(EmailTemplateRepository $emailTemplateRepo)
    {
        $this->emailTemplateRepository = $emailTemplateRepo;
    }

    /**
     * Display a listing of the EmailTemplate.
     *
     * @param EmailTemplateDataTable $emailTemplateDataTable
     * @return Response
     */
    public function index(EmailTemplateDataTable $emailTemplateDataTable)
    {
       // $permission_data = Helpers::getPermission('sub_admin');
        return $emailTemplateDataTable->render('email_templates.index');
    }

    /**
     * Show the form for creating a new EmailTemplate.
     *
     * @return Response
     */
    public function create()
    {
        return view('email_templates.create');
    }

    /**
     * Store a newly created EmailTemplate in storage.
     *
     * @param CreateEmailTemplateRequest $request
     *
     * @return Response
     */
    public function store(CreateEmailTemplateRequest $request)
    {
        $input = $request->all();

        $emailTemplate = $this->emailTemplateRepository->create($input);

        Flash::success('Email Template saved successfully.');

        return redirect(route('emailTemplates.index'));
    }

    /**
     * Display the specified EmailTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error('Email Template not found');

            return redirect(route('emailTemplates.index'));
        }

        return view('email_templates.show')->with('emailTemplate', $emailTemplate);
    }

    /**
     * Show the form for editing the specified EmailTemplate.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $id = \App\Helpers::DecryptId($id);
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error('Email Template not found');

            return redirect(route('emailTemplates.index'));
        }

        return view('email_templates.edit')->with('emailTemplate', $emailTemplate);
    }

    /**
     * Update the specified EmailTemplate in storage.
     *
     * @param  int              $id
     * @param UpdateEmailTemplateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateEmailTemplateRequest $request)
    {

       $input = $request->all();


    //   $input['content'] =htmlspecialchars_decode($input['content']);
//      // return $input;
        $rules = array(
            'subject' =>'required',
            'content' =>'required',
        );

        $message=[
            'subject.required'=>'Enter a Subject',
            'content.required'=>'Enter a Content.',
        ];

        $validator = Validator::make($input, $rules,$message);

        // If validation fails, we'll exit the operation now.
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }


        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error('Email Template not found');

            return redirect(route('emailTemplates.index'));
        }

        $emailTemplate = $this->emailTemplateRepository->update($request->all(), $id);

        Flash::success('Email Template has been updated successfully.');

        return redirect(route('emailTemplates.index'));
    }

    /**
     * Remove the specified EmailTemplate from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $emailTemplate = $this->emailTemplateRepository->findWithoutFail($id);

        if (empty($emailTemplate)) {
            Flash::error('Email Template not found');

            return redirect(route('emailTemplates.index'));
        }

        $this->emailTemplateRepository->delete($id);

        Flash::success('Email Template deleted successfully.');

        return redirect(route('emailTemplates.index'));
    }
}
