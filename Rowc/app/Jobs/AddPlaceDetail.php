<?php

namespace App\Jobs;

use App\DailyLog;
use App\Helpers;
use App\Models\EmailTemplate;
use App\Models\Places;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\Job;
use Mail;
use Log;
use DB;
use Config;


class AddPlaceDetail extends Job implements ShouldQueue
{

    use InteractsWithQueue, SerializesModels;

        /**
         * @var
         */
        protected $json;
        protected $type;
        protected $user_id;
        /**
         * @var
         */


        /**
         * Create a new job instance.
         * @param $user_id
         * @param $email_id
         * @param $subject
         * @param $message_body
         * @param $template
         * @param $api_name
         * @param $api_description
         */
        public function __construct($json,$user_id)
        {
            $this->json = $json;
            $this->user_id = $user_id;
        }

        /**
         * Execute the job.
         *
         * @return void
         */
        public function handle()
        {
            try {
                foreach ($this->json as $search_data) {
                    $place_detail = app('App\Http\Controllers\EventsController')->getPlaceDetailById($search_data['place_id']);
                    $exist_place_data = Places::where('place_id', $search_data['place_id'])->exists();
                    if (!$exist_place_data) {
                        $places = new Places();

                        $places->place_id = isset($search_data['place_id']) ? $search_data['place_id'] : '';
                        $places->place_name = isset($search_data['name']) ? $search_data['name'] : '';

                        $places->street_name = app('App\Http\Controllers\EventsController')->getAddressValue($place_detail, 'sublocality_level_1');
                        $places->locality = app('App\Http\Controllers\EventsController')->getAddressValue($place_detail, 'locality');
                        $places->country = app('App\Http\Controllers\EventsController')->getAddressValue($place_detail, 'country');
                        $places->postal_code = app('App\Http\Controllers\EventsController')->getAddressValue($place_detail, 'postal_code');
                        $places->formatted_address = isset($place_detail['result']['formatted_address']) ? $place_detail['result']['formatted_address'] : '';

                        $places->phone_number = isset($place_detail['result']['formatted_phone_number']) ? $place_detail['result']['formatted_phone_number'] : '';

                        $places->latitude = isset($search_data['geometry']['location']['lat']) ? $search_data['geometry']['location']['lat'] : '0.0';
                        $places->longitude = isset($search_data['geometry']['location']['lng']) ? $search_data['geometry']['location']['lng'] : '0.0';
                        $places->icon = isset($search_data['icon']) ? $search_data['icon'] : '';
                        $places->rating = isset($search_data['rating']) ? $search_data['rating'] : '0';

                        if (sizeof(isset($search_data['types'])) > 0) {
                            app('App\Http\Controllers\EventsController')->storeCategoryWithActivity($search_data['types'], $search_data['place_id'],$this->user_id);
                            $types = implode(",", $search_data['types']);
                        } else {
                            $types = "";
                        }
                        $places->types = $types;

                        $places->website = isset($place_detail['result']['website']) ? $place_detail['result']['website'] : '';
                        $places->place_url = isset($place_detail['result']['url']) ? $place_detail['result']['url'] : '';

                        $places->details = json_encode($search_data);

                        $places->save();

                        if (isset($place_detail['result']['photos'])) {
                            if (sizeof($place_detail['result']['photos']) > 0) {
                                app('App\Http\Controllers\EventsController')->storePlaceImages($place_detail['result']['photos'], $search_data['place_id']);
                            }
                        }
                    }
                }
            }catch (\Exception $e){
                Log::error('handle_add_place_detail', ['Exception' => $e->getMessage()]);
            }

        }

        /**
         *
         */
        public function failed()
        {
        }

}
