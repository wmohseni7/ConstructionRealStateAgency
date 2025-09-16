<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:
            {
                type: "get",
                url: "/getDebts",
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
            ]
        });
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    });
    // insert Alternative debts 
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#toEdit_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('toAltDebts')}}" + '/' + isUpdate :  "{{URL::asset('toAltDebts')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#AltDebtsForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#AltDebtsForm')[0].reset();
                    toastr.success(response.success);
                    $('#datatable').DataTable().ajax.reload();
                    $('#collapsable').collapse('hide')
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
    // end insert Alternative debts


    // edit Alternative debts
    function editRecord(id) {
        
        $.ajax({
            type: "get",
            url: "{{URL::asset('toAltDebts')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#AltDebts_title').text('ویرایش قرض');
                $('#toEdit_id').val(response.debts.id);
                $('#name').val(response.debts.name);
                $('#amount').val(response.debts.amount);
                $('#date').val(response.debts.date);
                $('#description').val(response.debts.description);
                
            }
        });
        
    }
    //delete Alt Debts
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
                    url             : "{{URL::asset('toAltDebts')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "قرض موفقانه حذف گردید !",
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