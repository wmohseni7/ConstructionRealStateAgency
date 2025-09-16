<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').DataTable({
        ajax:
        
            {
                type    : "get",
                url     : "{{URL::asset('AgencyExpenses')}}",
                dataType: "json",
            },
            columns: 
            [
                {"data":"id"},
                {"data":"name"},
                {"data":"amount"},
                {"data":"date"},
                {"data":"description"},
                {
                    "data": null,
                    render: function(data,row,type){
                        return '<button class="btn btn-trans btn-sm btn-primary fa fa-pencil text-primary" data-toggle="collapse" data-target="#collapsable"  onclick="editRecord('+data.id+')"></button>'
                    }
                    
                },
                {
                    "data": null,
                    render: function(data,row,type){
                        return '<button class="btn btn-trans btn-sm btn-danger fa fa-trash text-danger" onclick="deleteRecord('+data.id+')"></button>'
                    }
                    
                },
            ],
            autofill: true,
            select: true,
            responsive: true,
            buttons: true,
            length: 10,
        }
        );
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "{{ asset('assets/plugins/datatables/json/scroller-demo.json') }}", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    });



    // Insert Record
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();

        var isUpdate    = $('#agencyExp_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('agenciesExp')}}" + '/' + isUpdate :  "{{URL::asset('agenciesExp')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#agencyExpForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#agencyExpForm')[0].reset();
                    toastr.success(response.success);
                    $('#datatable').DataTable().ajax.reload();
                    $('#collapsable').collapse('hide');
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

    function editRecord(id) {
        $.ajax({
            type: "get",
            url: "{{URL::asset('agenciesExp')}}"+"/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#agencyExpTitle').text('ویرایش مصارف');
                $('#agencyExp_id').val(response.agencyExp.id)
                $('#agency_id').val(response.agencyExp.agency_id);
                $('#amount').val(response.agencyExp.amount);
                $('#date').val(response.agencyExp.date);
                $('#description').val(response.agencyExp.description);
            }
        });
    }

//delete agency expeditures
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
                    method          : "DELETE",
                    url             : "{{URL::asset('agenciesExp')}}"+'/'+id,
                    success         : function(data){
                        swal({
                            title               : "مصرف موفقانه حذف گردید  !",
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