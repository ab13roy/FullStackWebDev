<?php

namespace App\Http\Controllers;

use App\DataTables\SectionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Track;
use App\Repositories\SectionRepository;
use App\SectionTrack;
use Illuminate\Support\Facades\Log;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SectionController extends AppBaseController
{
    /** @var  SectionRepository */
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepo)
    {
        $this->sectionRepository = $sectionRepo;
    }

    /**
     * Display a listing of the Section.
     *
     * @param SectionDataTable $sectionDataTable
     * @return Response
     */
    public function index(SectionDataTable $sectionDataTable)
    {
        return $sectionDataTable->render('sections.index');
    }

    /**
     * Show the form for creating a new Section.
     *
     * @return Response
     */
    public function create()
    {

        return view('sections.create');
    }

    /**
     * Store a newly created Section in storage.
     *
     * @param CreateSectionRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionRequest $request)
    {
        $input = $request->all();

        $section = $this->sectionRepository->create($input);


        Log::info('Admin has been create new section like => '.$request->name);


        Flash::success('Section saved successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Display the specified Section.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        return view('sections.show')->with('section', $section);
    }

    /**
     * Show the form for editing the specified Section.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }
        $track = Track::all();
        $section_track = SectionTrack::where('section_id',$id)->get();
        if(sizeof($section_track)>0){
            $track_ids = array_pluck($section_track,'track_id');
        }else{
            $track_ids = [];
        }

        return view('sections.edit',compact('track','track_ids'))->with('section', $section);
    }

    /**
     * Update the specified Section in storage.
     *
     * @param  int              $id
     * @param UpdateSectionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionRequest $request)
    {

        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        $section = $this->sectionRepository->update($request->all(), $id);

        if(sizeof($request->track)>0){
             SectionTrack::where('section_id',$id)->delete();
            foreach ($request->track as $track=>$t){
                    $track = new SectionTrack();
                    $track->section_id = $id;
                    $track->track_id = $t;
                    $track->save();
            }

        }


        Log::info('Admin has been update Section detail for  => '.$request->name);
        Flash::success('Section updated successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified Section from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        $this->sectionRepository->delete($id);
        Log::info('Admin has been deleted section detail is => '.$section->name);
        Flash::success('Section deleted successfully.');

        return redirect(route('sections.index'));
    }
}
