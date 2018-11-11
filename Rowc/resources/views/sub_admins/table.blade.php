@section('css')
    @include('layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

@section('scripts')
    @include('layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection
<script>
    function confirmDelete(id) {
        swal({
                title: "",
                text: "Are you sure that you want to delete this Sub Admin?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            },
            function(isConfirm){

                if (isConfirm) {


                    swal({
                        title: '',
                        text: 'Sub Admin has been deleted successfully',
                        type: 'success'

                    }, function () {
                        var url_link = "{{ URL::to('admin/destroy-sub-admin') }}";
                        $.post(url_link, { id: id }, function(data) {
                            $("#is_deleted_"+id).remove();
                        }, "json");

                        return true;

                    });

                }
            });
    }
    function activeStatus(status_id,status) {
        if (status == 0) {

            swal({
                    title: "",
                    text: "Are you sure that you want to Activate this Sub Admin account?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function (isConfirm) {

                    if (isConfirm) {


                        swal({
                            title: '',
                            text: 'Sub Admin account has been activated successfully.',
                            type: 'success'

                        }, function () {
                            var url_link = "{{ URL::to('admin/active-sub-admin') }}";
                            $.post(url_link, { status_id: status_id,status:status }, function(data) {

                                $("#active_"+status_id).replaceWith('<span id="active_'+status_id+'"><a onclick="activeStatus('+status_id+',1)"  class="label label-success"  style="padding:7px; font-size:14px;">Active</a></span>');
                            }, "json");

                            return true;

                        });

                    }
                });
        }else{

            swal({
                    title: "",
                    text: "Are you sure that you want to Deactivate this Sub Admin account?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function (isConfirm) {
                    if (isConfirm) {
                        swal({
                            title: '',
                            text: 'Sub Admin account has been deactivated successfully.',
                            type: 'success'

                        }, function () {
//                            $("#active_"+status_id).replaceWith("<span id='' + status_id + ''><a  class='label label-danger' onclick='activeStatus(' + status_id + ',1)' style='padding:7px; font-size:14px;'>Not Active</a></span>");
                            var url_link = "{{ URL::to('admin/active-sub-admin') }}";
                            $.post(url_link, { status_id: status_id,status:status }, function(data) {
                                $("#active_"+status_id).replaceWith('<span id="active_'+status_id+'" ><a onclick="activeStatus('+status_id+',0)" class="label label-danger"  style="padding:7px; font-size:14px;">In-Active</a></span>');
                            }, "json");



                            return true;
                        });

                    }
                });
        }

    }
</script>