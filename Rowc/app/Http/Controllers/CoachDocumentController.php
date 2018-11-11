<?php

namespace App\Http\Controllers;

use App\DataTables\CoachDocumentDataTable;
use App\Helpers;
use App\Http\Requests;
use App\Http\Requests\CreateCoachDocumentRequest;
use App\Http\Requests\UpdateCoachDocumentRequest;
use App\Models\CoachDocument;
use App\Repositories\CoachDocumentRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Auth;
use Response;

class CoachDocumentController extends AppBaseController
{
    /** @var  CoachDocumentRepository */
    private $coachDocumentRepository;

    public function __construct(CoachDocumentRepository $coachDocumentRepo)
    {
        $this->coachDocumentRepository = $coachDocumentRepo;
    }

    /**
     * Display a listing of the CoachDocument.
     *
     * @param CoachDocumentDataTable $coachDocumentDataTable
     * @return Response
     */
    public function index(CoachDocumentDataTable $coachDocumentDataTable)
    {
        return $coachDocumentDataTable->render('coach_documents.index');
    }

    /**
     * Show the form for creating a new CoachDocument.
     *
     * @return Response
     */
    public function create()
    {
        return view('coach_documents.create');
    }

    /**
     * Store a newly created CoachDocument in storage.
     *
     * @param CreateCoachDocumentRequest $request
     *
     * @return Response
     */
    public function store(CreateCoachDocumentRequest $request)
    {
        $input = $request->all();

        $file = $request->file('document_file');


        $destinationPath = public_path('/uploads/document');
        $fileName  = Helpers::upload_images($file,$destinationPath);
        $input['document_file'] = $fileName;
        $input['coach_id'] = Auth::guard('admin')->user()->id;

        $coachDocument = $this->coachDocumentRepository->create($input);

        Flash::success('Coach Document saved successfully.');

        return redirect(route('coachDocuments.index'));
    }

    /**
     * Display the specified CoachDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coachDocument = $this->coachDocumentRepository->findWithoutFail($id);

        if (empty($coachDocument)) {
            Flash::error('Coach Document not found');

            return redirect(route('coachDocuments.index'));
        }


        return view('coach_documents.show')->with('coachDocument', $coachDocument);
    }

    /**
     * Show the form for editing the specified CoachDocument.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coachDocument = $this->coachDocumentRepository->findWithoutFail($id);

        if (empty($coachDocument)) {
            Flash::error('Coach Document not found');

            return redirect(route('coachDocuments.index'));
        }

        return view('coach_documents.edit')->with('coachDocument', $coachDocument);
    }

    /**
     * Update the specified CoachDocument in storage.
     *
     * @param  int              $id
     * @param UpdateCoachDocumentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCoachDocumentRequest $request)
    {
        $coachDocument = $this->coachDocumentRepository->findWithoutFail($id);
        $input = $request->all();
        if (empty($coachDocument)) {
            Flash::error('Coach Document not found');

            return redirect(route('coachDocuments.index'));
        }

        if ($request->hasFile('document_file') != "") {
            $file = $request->file('document_file');


            $destinationPath = public_path('/uploads/document');
            $fileName  = Helpers::upload_images($file,$destinationPath);
            $input['document_file'] = $fileName;
        }

        $coachDocument = $this->coachDocumentRepository->update($input, $id);

        Flash::success('Coach Document updated successfully.');

        return redirect(route('coachDocuments.index'));
    }

    /**
     * Remove the specified CoachDocument from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coachDocument = $this->coachDocumentRepository->findWithoutFail($id);

        if (empty($coachDocument)) {
            Flash::error('Coach Document not found');

            return redirect(route('coachDocuments.index'));
        }

        $this->coachDocumentRepository->delete($id);

        Flash::success('Coach Document deleted successfully.');

        return redirect(route('coachDocuments.index'));
    }
}
