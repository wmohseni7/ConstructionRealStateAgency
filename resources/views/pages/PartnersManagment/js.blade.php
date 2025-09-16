<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:
            {
                type: "get",
                url: "/getPartners",
                data:"data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"name"},
                {"data":"last_name"},
                {"data":"phone_number"},
                {"data":"email"},
                {"data":"address"},
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

     // Insert partner
     $("#saveOrUpdate").click(function(e){
        e.preventDefault();

        var isUpdate    = $('#partner_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('toPartnersReg')}}" + '/' + isUpdate :  "{{URL::asset('toPartnersReg')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#partnerForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#partnerForm')[0].reset();
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
    // end insert partner

    //edit partner
    function editRecord(id) {
        
        $.ajax({
            type: "get",
            url: "{{URL::asset('toPartnersReg')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#partner_title').text('ویرایش مشخصات شریک');
                $('#partner_id').val(response.partners.id);
                $('#name').val(response.partners.name);
                $('#last_name').val(response.partners.last_name);
                $('#phone_number').val(response.partners.phone_number);
                $('#email').val(response.partners.email);
                $('#address').val(response.partners.address);
                $('#date').val(response.partners.date);
                $('#description').val(response.partners.description);
            }
        });
        
    }
    //delete partners
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
                    url             : "{{URL::asset('toPartnersReg')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "شریک موفقانه حذف گردید !",
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