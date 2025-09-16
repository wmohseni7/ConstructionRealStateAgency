<script>
      $(document).ready(function(params) {
        $('#datatable').DataTable({
            ajax:
            {
                type: "get",
                url: "/getcompanies",
                data: "data",
                dataType: "json",
            },
            columns:
            [
                {"data":"id"},
                // {"data":"agency_id"},
                {"data":"name"},
                {"data":"phone_number"},
                {"data":"address"},
                {"data":"owner"},
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
    // insert Project 
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#company_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('companies')}}" + '/' + isUpdate :  "{{URL::asset('companies')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#companiesForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#companiesForm')[0].reset();
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
    // end insert Project
    // edit records
    function editRecord(id){
      
      $.ajax({
          type: "get",
          url: "{{URL::asset('companies')}}/"+id+"/edit",
          data: "data",
          dataType: "json",
          success: function (response) {
            $('#projectManagementTitle').text('ویرایش مشخصات کمپنی');
            $('#company_id').val(response.companies.id);
            $('#agency_id').val(response.companies.agency_id);
            $('#name').val(response.companies.name);
            $('#phone_number').val(response.companies.phone_number);
            $('#address').val(response.companies.address);
            $('#owner').val(response.companies.owner);
          }
      });
    }
    //end edit records

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
                    url             : "{{URL::asset('companies')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "کمپنی موفقانه حذف گردید !",
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
