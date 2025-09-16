<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    });
    //insert deal
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var form          = $('#dealershipForm')[0];
        var formData      = new FormData(form);
        var method        = 'POST';
        var url           = "{{URL::asset('dealership')}}";
        $.ajax({
            method           : method,
            url              : url,
            data             : formData,
            processData      : false,
            contentType      : false,
            success         : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#dealershipForm')[0].reset();
                    location.reload();
                    toastr.success(response.success);
                    // $('#datatable').DataTable().ajax.reload();
                    setTimeout(
                            function() 
                            {
                                location.reload();
                            }, 3000);
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
    // end insert deal


    //edit Deals
    function editRecord(id) {
       
        $.ajax({
            type: "get",
            url: "{{URL::asset('dealership')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#dealershipTitle').text('ویرایش مشخصات خانه')
                $('#editDealedProperty_id').val(response.dealerships.id);
                $('#customer').val(response.dealerships.customer);
                $('#phone_number').val(response.dealerships.phone_number);
                $('#floorNum').val(response.dealerships.floorNum);
                $('#apartmentNum').val(response.dealerships.apartmentNum);
                $('#deal').val(response.dealerships.deal);
                $('#amount').val(response.dealerships.amount);
                $('#description').val(response.dealerships.description);
                $('#date').val(response.dealerships.date);
            }
        });
    }


    //delete deals
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
                    url             : "{{URL::asset('dealership')}}/"+id,
                    success         : function(data){
                        location.reload();
                        swal({
                            title               : "ملک موفقانه حذف گردید !",
                            text                : "موفقانه حذف گردید !",
                            icon                : "success",
                            buttons             : 'close'
                        });
                        // $('#datatable').DataTable().ajax.reload();
                        setTimeout(
                            function() 
                            {
                                location.reload();
                            }, 3000);
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
    //show image
    function showImage(id){
        $.ajax({
            type: "get",
            url: "{{URL::asset('dealership')}}/"+id,
            data: "data",
            dataType: "json",
            success: function (response) {
                var image2=response.DealerImage.photo;
                console.log(image2);
                $('#toDisplayPhoto').attr("src", '{{URL::asset('') }}'+image2+''); 
                
            }
        });
    }
</script>