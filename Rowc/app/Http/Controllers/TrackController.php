<?php

namespace App\Http\Controllers;

use App\CoachTrack;
use App\DataTables\TrackDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTrackRequest;
use App\Http\Requests\UpdateTrackRequest;
use App\Models\Coach;
use App\Repositories\TrackRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\Log;
use Response;

class TrackController extends AppBaseController
{
    /** @var  TrackRepository */
    private $trackRepository;

    public function __construct(TrackRepository $trackRepo)
    {
        $this->trackRepository = $trackRepo;
    }

    /**
     * Display a listing of the Track.
     *
     * @param TrackDataTable $trackDataTable
     * @return Response
     */
    public function index(TrackDataTable $trackDataTable)
    {
        return $trackDataTable->render('tracks.index');
    }

    /**
     * Show the form for creating a new Track.
     *
     * @return Response
     */
    public function create()
    {
        return view('tracks.create');
    }

    /**
     * Store a newly created Track in storage.
     *
     * @param CreateTrackRequest $request
     *
     * @return Response
     */
    public function store(CreateTrackRequest $request)
    {
        $input = $request->all();

        $track = $this->trackRepository->create($input);

        Log::info('Admin has been create new track is => '.$request->title);

        Flash::success('Track saved successfully.');

        return redirect(route('tracks.index'));
    }

    /**
     * Display the specified Track.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $track = $this->trackRepository->findWithoutFail($id);

        if (empty($track)) {
            Flash::error('Track not found');

            return redirect(route('tracks.index'));
        }

        return view('tracks.show')->with('track', $track);
    }

    /**
     * Show the form for editing the specified Track.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $track = $this->trackRepository->findWithoutFail($id);

        if (empty($track)) {
            Flash::error('Track not found');

            return redirect(route('tracks.index'));
        }
        $coach = Coach::where('is_admin',2)->get();
        if(sizeof($coach)>0) {
            foreach ($coach as $c) {
                 $exist = CoachTrack::where('coach_id',$c->id)->where('track_id',$id)->first();
                 if($exist) {
                     $c->is_selected = 1;
                 }else{
                     $c->is_selected = 0;
                 }
             }
        }


        return view('tracks.edit',compact('coach'))->with('track', $track);
    }

    /**
     * Update the specified Track in storage.
     *
     * @param  int              $id
     * @param UpdateTrackRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTrackRequest $request)
    {

        $track = $this->trackRepository->findWithoutFail($id);

        if (empty($track)) {
            Flash::error('Track not found');

            return redirect(route('tracks.index'));
        }

        $track = $this->trackRepository->update($request->all(), $id);

     if($request->coach_id !="" && $request->coach_id !=null){
         $track = CoachTrack::where('track_id',$id)->first();
         if($track) {
             $track->coach_id = $request->coach_id;
             $track->save();
         }else{
             $track = new CoachTrack();
             $track->coach_id = $request->coach_id;
             $track->track_id = $id;
             $track->save();
         }
     }
        Log::info('Admin has been update track detail for  => '.$request->title);
        Flash::success('Track updated successfully.');


        return redirect(route('tracks.index'));
    }

    /**
     * Remove the specified Track from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $track = $this->trackRepository->findWithoutFail($id);

        if (empty($track)) {
            Flash::error('Track not found');

            return redirect(route('tracks.index'));
        }

        $this->trackRepository->delete($id);

        Log::info('Admin has been deleted track detail is => '.$track->title);
        Flash::success('Track deleted successfully.');

        return redirect(route('tracks.index'));
    }
}
