<script>
     $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:
            {
                type:"get",
                url: "/getClaims",
                data:"data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"name"},
                {"data":"amount"},
                {"data":"date"},
                {"data":"description"},
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
        $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    });


    // insert Alternative claim 
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#toEdit_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('toAltClaims')}}" + '/' + isUpdate :  "{{URL::asset('toAltClaims')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#AltClaimsForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#AltClaimsForm')[0].reset();
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
    // end insert Alternative claim

    //edit alt claims
    function editRecord(id) {
       
        $.ajax({
            type: "get",
            url: "{{URL::asset('toAltClaims')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#AltClaims_title').text('ویرایش طلب')
                $('#toEdit_id').val(response.claims.id);
                $('#name').val(response.claims.name);
                $('#amount').val(response.claims.amount);
                $('#date').val(response.claims.date);
                $('#description').val(response.claims.description);
            }
        });
    }
    //delete Alternative Claims
    function deleteRecord(id) {
        swal({
            title               : "آیا مطمئن هستید؟",
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
                    url             : "{{URL::asset('toAltClaims')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "طلب موفقانه حذف گردید !",
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