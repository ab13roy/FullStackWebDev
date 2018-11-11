
<div class="box-header with-border">
    <h3 class="box-title content-ttl"> </h3>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('search_radius', 'Search Radius Limit* :') !!}</label>
    <div class="col-sm-7">
        {!! Form::text('search_radius', \App\Helpers::generalSetting('SEARCH_RADIUS'), ['class' => 'form-control','placeholder'=>'Enter Search Radius Limit']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('google_image_count', 'Google Image Count* :') !!}</label>
    <div class="col-sm-7">
        {!! Form::text('google_image_count', \App\Helpers::generalSetting('GOOGLE_IMAGE_COUNT'), ['class' => 'form-control','placeholder'=>'Enter Google Image Count']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('admin_email', 'Admin Email* :') !!}</label>
    <div class="col-sm-7">
        {!! Form::text('admin_email',  \App\Helpers::generalSetting('ADMIN_EMAIL'), ['class' => 'form-control','placeholder'=>'Enter Admin Email']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('google_api_key', 'Google Api Key* :') !!}</label>
    <div class="col-sm-7">
        {!! Form::text('google_api_key',  \App\Helpers::generalSetting('GOOGLE_API_KEY'), ['class' => 'form-control','placeholder'=>'Enter Google Api Key']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('facebook_link', 'Facebook Link* :') !!}</label>
    <div class="col-sm-7">
        {!! Form::text('facebook_link',  \App\Helpers::generalSetting('FACEBOOK_LINK'), ['class' => 'form-control','placeholder'=>'Enter Facebook Link (ex.http://www.facebook.com)']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('twitter_link', 'Twitter Link* :') !!}</label>
    <div class="col-sm-7">
        {!! Form::text('twitter_link',  \App\Helpers::generalSetting('TWITTER_LINK'), ['class' => 'form-control','placeholder'=>'Enter Twitter Link (ex.http://www.twitter.com)']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">{!! Form::label('instagram_link', 'Instagram Link* :') !!}</label>
    <div class="col-sm-7">
        {!! Form::text('instagram_link', \App\Helpers::generalSetting('INSTAGRAM_LINK'), ['class' => 'form-control','placeholder'=>'Enter Instagram Link (ex.http://www.instagram.com)']) !!}
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label"> {!! Form::label('homepage_url_type', 'Homepage Banner* :') !!}</label>
    <div class="col-sm-10">
        <label class="radio-inline">
            <input name="homepage_url_type" type="radio" value="1" id="homepage_url_type" @if(\App\Helpers::generalSetting('HOMEPAGE_URL_TYPE') == 1) checked @endif > Image
        </label>
        <label class="radio-inline">
            <input name="homepage_url_type" type="radio" value="2" id="homepage_url_type" @if(\App\Helpers::generalSetting('HOMEPAGE_URL_TYPE') == 2) checked @endif> Video
        </label>
        <label class="radio-inline" style="display: none">
            <input  name="homepage_url_type" type="radio" value="3" id="homepage_url_type" @if(\App\Helpers::generalSetting('HOMEPAGE_URL_TYPE') == 3) checked @endif> Youtube
        </label>

    </div>
</div>
<div class="form-group" id="home_page_image">
    <label class="col-sm-2 control-label"> {!! Form::label('homepage_url', 'Homepage Image* :') !!}</label>
    <div class="col-sm-5">
        <input style="margin-top:7px;" class="form-control"  name="home_page_image" type="file" id="home_page_image" accept="image/*" >
    </div>
    <div class="col-sm-5">
        <div class="website_logo_preview">
            @if(\App\Helpers::generalSetting('HOMEPAGE_URL_TYPE') == 1)
                <img src="{{ asset('uploads/home_page/'.\App\Helpers::generalSetting('HOMEPAGE_URL')) }}" style="height: 70px;width: 100px;" alt="HomePage Image" >
            @else
                <img src="{{ asset('assets/images/no_image.jpg') }}" style="height: 70px;width: 100px;" alt="HomePage Image" >
            @endif
        </div>
    </div>
</div>
<div class="form-group" id="home_page_video" style="display: none">
    <label class="col-sm-2 control-label"> {!! Form::label('homepage_url', 'Homepage video* :') !!}</label>
    <div class="col-sm-5">

        <input style="margin-top:7px;" class="form-control"  name="home_page_video" type="file" id="home_page_video" accept="video/*">

    </div>
    <div class="col-sm-5">
        <div class="website_logo_preview">
            @if(\App\Helpers::generalSetting('HOMEPAGE_URL_TYPE') == 2)
                <video width="150" controls>
                    <source src="{{ asset('uploads/home_page/'.\App\Helpers::generalSetting('HOMEPAGE_URL')) }}">
                </video>
            @else
                <img src="{{ asset('assets/images/VideoUpload.jpg') }}" style="height: 70px;width: 100px;" alt="HomePage Video" >
            @endif
        </div>
    </div>
</div>

<div class="form-group" id="home_page_youtube" style="display: none">
    <label class="col-sm-2 control-label"> {!! Form::label('home_page_youtube', 'Youtube Video Link* :') !!}</label>
    <div class="col-sm-5">
        @if(\App\Helpers::generalSetting('HOMEPAGE_URL_TYPE') == 3)

            {!! Form::text('home_page_youtube', \App\Helpers::generalSetting('HOMEPAGE_URL'), ['class' => 'form-control']) !!}
        @else
            {!! Form::text('home_page_youtube', null, ['class' => 'form-control','placeholder'=>'Enter Youtube Video Link']) !!}
        @endif

    </div>
    <div class="col-sm-5">
        <div class="website_logo_preview">
                <img src="{{ asset('assets/images/youtube.png') }}" style="height: 70px;width: 100px;" alt="Youtube Video" >
        </div>
    </div>

</div>
<div class="box-footer">
    <div class="col-sm-2"></div>
    <div class="col-sm-8">
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
        <a href="{!! route('admin.dashboard') !!}" class="btn btn-danger">Cancel</a>
    </div>
</div>
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
   var homepage_url_type =  $("#homepage_url_type:checked").val();
   if(homepage_url_type == 1){
       $("#home_page_image").show();
       $("#home_page_video").hide();
       $("#home_page_youtube").hide();
   }else if(homepage_url_type == 2){
       $("#home_page_image").hide();
       $("#home_page_video").show();
       $("#home_page_youtube").hide();
   }else{
       $("#home_page_image").hide();
       $("#home_page_video").hide();
       $("#home_page_youtube").show();
   }

    $(document).ready(function(){

        $('input[type="radio"][name="homepage_url_type"]').click(function(){
            if($(this).attr("value")=="1"){
                $("#home_page_image").show();
                $("#home_page_video").hide();
                $("#home_page_youtube").hide();
            }
            if($(this).attr("value")=="2"){
                $("#home_page_image").hide();
                $("#home_page_video").show();
                $("#home_page_youtube").hide();
            }
            if($(this).attr("value")=="3"){
                $("#home_page_image").hide();
                $("#home_page_video").hide();
                $("#home_page_youtube").show();
            }

        });


//        $('input[type="radio"]').click(function(){
//            if($(this).attr("value")=="1"){
//                $(".red").hide();
//            }
//            if($(this).attr("value")=="2"){
//                $(".red").show();
//            }
//        });
    });
</script>