@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1 class="pull-left">Dashboard</h1>
    </section>
    <div class="content">
       <br>
       <br>
       <br>
        <div class="row">
            <form id="sectionFilter">
            <div class="col-md-4">

                <div class="form-group input-group">


                        <label>Select Section</label>
                        <select id="sectionSelector" class="form-control" style="width: 100%;" onchange="submit_form_data()">
                             @foreach($section as $s)
                                 <option value="{{$s->id}}">{{$s->name}}</option>
                              @endforeach
                        </select>
                        <span class="input-group-btn">
                      {{--<button type="submit" style="margin-left: 3px;margin-top: 25px;" class="btn btn-info btn-flat">Load</button>--}}
                    </span>
                    </div>
            </div>
                <!-- /.form-group -->
                </form>
                <!-- /.form-group -->


        </div>
        <div id="panels" class="row">


        </div>
        </div>

    <script>
        function submit_form_data() {
            $('#sectionFilter').submit();
        }
        $(document).ready(function (){
            console.log("6");

            $(function() {
                $('#sectionFilter').submit();
            });

            $('#sectionFilter').on('submit', function(e) {
                e.preventDefault();
                var sectionID = $('#sectionSelector').val();
                var load_url = "{{ URL::to('admin/get-section-data') }}";
                $.ajax({
                    type: "POST",
                    url: load_url,
                    data: {sectionID: sectionID},
                    dataType: 'json',
                    success: function (data) {
                        drawDash(data);
                    }
                })
            });



            function drawDash(users) {
                $('#panels').empty();
                //console.log(users);
                var pnltype = 'class="panel panel-primary"';

                for (i = 0; i < users.length; i++) {
                    //console.log(users[i]);
                    if (users[i]['student_count']=== 0){
                        pnltype = 'class="panel panel-danger"';
                    }else {
                        pnltype = 'class="panel panel-primary"';
                    }
                    var load_url = "{{ URL::to('admin/track-students-list') }}"+'/'+users[i]['track_id'];
                    var box = "<div class=\"col-lg-4 col-md-6\">\n" +
                        "                    <div "+pnltype+">\n" +
                        "                        <div class=\"panel-heading\">\n" +
                        "                            <div class=\"row\">\n" +
                        "                                <div class=\"col-xs-4\">\n" +
                        "                                    <div class=\"huge\">Total Student : "+users[i]['student_count']+" </div>\n" +
                        "                                </div>\n" +
                        "                                <div class=\"col-xs-8 text-right\">\n" +
                        "                                    <h3>"+users[i]['track_name']+"</h3>\n" +
                        "                                    <div>"+users[i]['track_coach_name']+"</div>\n" +
                        "                                </div>\n" +
                        "                            </div>\n" +
                        "                        </div>\n" +
                        "                       <a href='"+load_url+"' class='pnlButton btn-block'>\n" +
                        "                           <input hidden aria-hidden='true' name='id' value='"+users[i]['section_id']+"'>\n"+
                        "                            <div class=\"panel-footer\">\n" +
                        "                                <span class=\"pull-left\">View Details</span>\n" +
                        "                                <span class=\"pull-right\"><i class=\"fa fa-arrow-circle-right\"></i></span>\n" +
                        "                                <div class=\"clearfix\"></div>\n" +
                        "                            </div>\n" +
                        "                        </a>\n" +
                        "                    </div>\n" +
                        "                </div>";
                    $("#panels").append(box);
                }

            }



        });
    </script>
@endsection
