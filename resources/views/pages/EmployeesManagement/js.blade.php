<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:
            {
                type:"get",
                url: "/getEmployees",
                data: "data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"agency_id"},
                {"data":"project_id"},
                {"data":"name"},
                {"data":"phone_number"},
                {"data":"address"},
                {
                    "data":null,
                    render:function(data,row,type){
                        if(data.title==1){
                            return '<span class="text-info">سرکارگر</span>'
                        }
                        else if(data.title==2){
                            return '<span class="text-info">کارگر نیمه وقت</span>'
                        }
                        else if(data.title==3){
                            return '<span class="text-info">کارگر تمام وقت</span>'
                        }
                    }
                },
                {"data":"total"},
                {"data":"paid"},
                {"data":"remain"},
                {"data":"date"},
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

    //calc
    $('#paid').on('input',function (e) {
        $total   =$('#total').val();
        $paid    =$('#paid').val();
        $remain =$total - $paid;
        $('#remain').val($remain);
    });


    // Insert partner
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();

        var isUpdate    = $('#Employee_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('toEmployees')}}" + '/' + isUpdate :  "{{URL::asset('toEmployees')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#EmployeeForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#EmployeeForm')[0].reset();
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
    //editRecord
    function editRecord(id) {
       
        $.ajax({
            type: "get",
            url: "{{URL::asset('toEmployees')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#EmployeesTitle').text('ویرایش مشخصات کارمند');
                $('#Employee_id').val(response.employees.id);
                $('#agency').val(response.employees.agency_id);
                $('#project').val(response.employees.project_id);
                $('#name').val(response.employees.name);
                $('#phone_number').val(response.employees.phone_number);
                $('#address').val(response.employees.address);
                $('#title').val(response.employees.title);
                $('#total').val(response.employees.total);
                $('#paid').val(response.employees.paid);
                $('#remain').val(response.employees.remain);
                $('#date').val(response.employees.date);
            }
        });
    }


    //deleterocrd
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
                    url             : "{{URL::asset('toEmployees')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "کارمند موفقانه حذف گردید !",
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