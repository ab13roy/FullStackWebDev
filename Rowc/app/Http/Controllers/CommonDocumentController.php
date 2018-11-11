<?php

namespace App\Http\Controllers;

use App\DataTables\CommonDocumentDataTable;
use App\Helpers;
use App\Http\Requests;
use App\Http\Requests\CreateCommonDocumentRequest;
use App\Http\Requests\UpdateCommonDocumentRequest;
use App\Repositories\CommonDocumentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Response;

class CommonDocumentController extends AppBaseController
{
    /** @var  CommonDocumentRepository */
    private $commonDocumentRepository;

    public function __construct(CommonDocumentRepository $commonDocumentRepo)
    {
        $this->commonDocumentRepository = $commonDocumentRepo;
    }

    /**
     * Display a listing of the CommonDocument.
     *
     * @param CommonDocumentDataTable $commonDocumentDataTable
     * @return Response
     */
    public function index(CommonDocumentDataTable $commonDocumentDataTable)
    {
        return $commonDocumentDataTable->render('common_documents.index');
    }

    /**
     * Show the form for creating a new CommonDocument.
     *
     * @return Response
     */
    public function create()
    {
        return view('common_documents.create');
    }

    /**
     * Store a newly created CommonDocument in storage.
     *
     * @param CreateCommonDocumentRequest $request
     *
     * @return Response
     */
    public function store(CreateCommonDocumentRequest $request)
    {
        $input = $request->all();

        $file = $request->file('common_file');


        $destinationPath = public_path('/uploads/document/common');
        $fileName  = Helpers::upload_images($file,$destinationPath);
        $input['common_file'] = $fileName;


        $commonDocument = $this->commonDocumentRepository->create($input);

        if (Auth::guard('admin')->user()->is_admin == 2) {
            Log::info(Auth::guard('admin')->user()->name.' coach has been add new medical document');
        } else {
            Log::info(Auth::guard('admin')->user()->name.' admin has been add new medical document');
        }
        Flash::success('Common Document saved successfully.');

        return redirect(route('commonDocuments.index'));
    }

    /**
     * Display the specified CommonDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $commonDocument = $this->commonDocumentRepository->findWithoutFail($id);

        if (empty($commonDocument)) {
            Flash::error('Common Document not found');

            return redirect(route('commonDocuments.index'));
        }

        return view('common_documents.show')->with('commonDocument', $commonDocument);
    }

    /**
     * Show the form for editing the specified CommonDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $commonDocument = $this->commonDocumentRepository->findWithoutFail($id);

        if (empty($commonDocument)) {
            Flash::error('Common Document not found');

            return redirect(route('commonDocuments.index'));
        }

        return view('common_documents.edit')->with('commonDocument', $commonDocument);
    }

    /**
     * Update the specified CommonDocument in storage.
     *
     * @param  int              $id
     * @param UpdateCommonDocumentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCommonDocumentRequest $request)
    {
        $commonDocument = $this->commonDocumentRepository->findWithoutFail($id);
        $input = $request->all();
        if (empty($commonDocument)) {
            Flash::error('Common Document not found');

            return redirect(route('commonDocuments.index'));
        }
        if ($request->hasFile('common_file') != "") {
            $file = $request->file('common_file');


            $destinationPath = public_path('/uploads/document/common');
            $fileName  = Helpers::upload_images($file,$destinationPath);
            $input['common_file'] = $fileName;
        }

        if (Auth::guard('admin')->user()->is_admin == 2) {
            Log::info(Auth::guard('admin')->user()->name.' coach has been update medical document');
        } else {
            Log::info(Auth::guard('admin')->user()->name.' admin has been update medical document');
        }

        $commonDocument = $this->commonDocumentRepository->update($input, $id);

        Flash::success('Common Document updated successfully.');

        return redirect(route('commonDocuments.index'));
    }

    /**
     * Remove the specified CommonDocument from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $commonDocument = $this->commonDocumentRepository->findWithoutFail($id);

        if (empty($commonDocument)) {
            Flash::error('Common Document not found');

            return redirect(route('commonDocuments.index'));
        }

        $this->commonDocumentRepository->delete($id);

        if (Auth::guard('admin')->user()->is_admin == 2) {
            Log::info(Auth::guard('admin')->user()->name.' coach has been delete medical document');
        } else {
            Log::info(Auth::guard('admin')->user()->name.' admin has been delete medical document');
        }

        Flash::success('Common Document deleted successfully.');

        return redirect(route('commonDocuments.index'));
    }
}
