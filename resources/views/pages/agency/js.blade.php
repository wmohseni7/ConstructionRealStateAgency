<script>
    
    $(document).ready(function() {

        $('#datatable').DataTable({ 
            ajax: 
                {
                    type: "GET",
                    url: "{{URL::asset('data')}}",
                    dataType: "json",
                },
                columns:
                [
                    {"data":"id"},
                    {"data":"name"},
                    {"data":"owner"},
                    {"data":"phone_number"},
                    {
                        "data": null,
                        render: function(data,row,type){
                            if(data.status==1){
                                return '<span class="text-success"> فعال</span>';
                            }
                            else
                            {
                                return '<span class="text-danger"> غیر فعال</span>';
                            }
                        }
                    },
                    {"data":"address"},
                    {
                        "data":null,
                        render: function(data,row,type){
                            return '<button class="btn btn-trans btn-sm btn-primary fa fa-pencil text-primary" data-toggle="collapse" data-target="#collapsable" onclick="editRecord('+(data.id)+')"></button>'
                        }
                        
                    },

                    {
                        "data":null,
                        render: function(data,row,type){
                            return '<button class="btn btn-trans btn-sm btn-danger fa fa-trash text-danger" onclick="deleteRecord('+(data.id)+')"></button>'
                        }
                        
                    },
                ],
                autofill: true,
                select: true,
                responsive: true,
                buttons: true,
                length: 10,
            
        });
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "{{ asset('assets/plugins/datatables/json/scroller-demo.json') }}", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    });
    // Insert Record
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();

        var isUpdate    = $('#agency_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('agencies')}}" + '/' + isUpdate :  "{{URL::asset('agencies')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#agencyForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#agencyForm')[0].reset();
                    $('#collapsable').collapse("hide");
                    toastr.success(response.success);
                    $('#datatable').DataTable().ajax.reload();
                }else if (!$.isEmptyObject(response.error)) {
                    $.each(response.error,function(key,value){
                        toastr.error(value);
                    });
                }
            },
            error   :function(error)
            {
                var errors = data.responseJSON;
                console.log(errors);
            }
        });
	});
    // end insert record

    // Edit Record
    function editRecord(id) {
        $.ajax({
            type: "GET",
            url: "agencies/"+id+"/edit",
            dataType: "json",
            success: function (response) {
                $('#agencyTitle').text('ویرایش نمایندگی');
                $('#agency_id').val(response.agencies.id);
                $('#name').val(response.agencies.name);
                $('#owner').val(response.agencies.owner);
                $('#address').val(response.agencies.address);
                $('#status').val(response.agencies.status);
                $('#phone_number').val(response.agencies.phone_number);
            }
        });
        
    }

    function deleteRecord(id) {
        swal({
            title               : "آیا مطمین هستید؟",
            text                : "این پروسه قابل بازگشت نمی باشد",
            buttons             : true,
            icon                : "error",          
            buttons             : ["انصراف!", "حذف"],
            dangerMode:         true,          
        }).then(function(isConfirm){
            if(isConfirm){
                $.ajax({
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    method          : "delete",
                    url             : "{{URL::asset('agencies')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "نمایندگی موفقانه حذف گردید !",
                            text                : "موفقانه حذف گردید !",
                            icon                : "success",
                            buttons             : 'close'
                        });
                        $('#datatable').DataTable().ajax.reload();
                    },
                    error  :function(err){
                        swal({
                            title               : " حذف نگردید!",
                            text                : "سرور مشکل دارد",
                            type                : "error",
                            confirmButtonText   : 'بستن ',
                            confirmButtonClass  : 'ladda-button btn btn-info mr-1 btn-rounded',
                            buttonsStyling: false
                        });
                    }
                })
            }
        });
    }

</script>