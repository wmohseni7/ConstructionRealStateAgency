<script>
 //document ready
 $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:
            {
                type: "get",
                url: "/getProperties",
                data:"data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"agency_id"},
                {"data":"name"},
                {"data":"floor"},
                {"data":"apartment"},
                {"data":"address"},
                {
                    "data":null,
                    render: function(data,row,type){
                        return '<a href="{{URL::asset('dealer')}}/'+data.id+'"><button class="btn btn-sm btn-success fa fa-plus">&nbspمعامله</button></a>'
                    }
                    
                },
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

    // insert property 
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#property_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('properties')}}" + '/' + isUpdate :  "{{URL::asset('properties')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#propertiesForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#propertiesForm')[0].reset();
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
    // end insert property

    

    //edit property
    function editRecord(id){
        
        $.ajax({
            type: "get",
            url: "{{URL::asset('properties')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#propertyDisabledItem').remove();
                $('#property_id').val(response.properties.id);
                $('#agency_id').val(response.properties.agency_id);
                $('#name').val(response.properties.name);
                $('#floor').val(response.properties.floor);
                $('#apartment').val(response.properties.apartment);
                $('#address').val(response.properties.address);
                $('#PropertiesTitle').text('ویرایش معلومات خانه');
            }
        });
    }


    //delete property
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
                    url             : "{{URL::asset('properties')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "ملک موفقانه حذف گردید !",
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