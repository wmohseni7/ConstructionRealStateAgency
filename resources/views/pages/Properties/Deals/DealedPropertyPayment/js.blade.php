<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    });
    //calculate payment
    $('#paid').on("input",function (e) {
        $total  = Number($('#total').val());
        $paid   = Number($('#paid').val());
        $remain = $total - $paid;
        $('#remain').val($remain);

    });

    //insert or update deal payment
    $("#saveOrUpdate").click(function(e){
        // e.preventDefault();
        var isUpdate    = $('#dealedProperty_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('dealedpropertypayment')}}" + '/' + isUpdate :  "{{URL::asset('dealedpropertypayment')}}";
        $.ajax({
            method   : method,
            url            : url,
            data         : $('#dealershipPaymentForm').serialize(),
            success  : function(response){   
                setTimeout(
                            function() 
                            {
                                location.reload();
                            }, 3000); 
                if($.isEmptyObject(response.error)){
                    $('#dealershipPaymentForm')[0].reset();
                    
                    toastr.success(response.success);
                    setTimeout(
                            function() 
                            {
                                location.reload();
                            }, 3000);
                    // $('#datatable').DataTable().ajax.reload();
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
    // end insert or update deal payment
 
    //edit deal payment
    function editRecord(id) {
        
        $.ajax({
            type: "get",
            url: "{{URL::asset('dealedpropertypayment')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#dealedProperty_id').val(response.payment.id);
                $('#date').val(response.payment.date);
                $('#paid').val(response.payment.paid);
                $('#remain').val(response.payment.remain);
            }
        });
        
    }
    //end edit

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
                    url             : "{{URL::asset('dealedpropertypayment')}}/"+id,
                    success         : function(data){
                        // location.reload();
                       
                        swal({
                            title               : "پرداختی موفقانه حذف گردید !",
                            text                : "موفقانه حذف گردید !",
                            icon                : "success",
                            buttons             : 'close'
                        });
                        setTimeout(
                            function() 
                            {
                                location.reload();
                            }, 3000);
                        // $('#datatable').DataTable().ajax.reload();
                       
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