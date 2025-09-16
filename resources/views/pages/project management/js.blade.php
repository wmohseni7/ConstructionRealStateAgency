<script>
    $(document).ready(function(params) {
        $('#datatable').DataTable({
            ajax:
            {
                type: "get",
                url: "/getprojects",
                data:"data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"agency_id"},
                {"data":"name"},
                {"data":"address"},
                {
                    "data":null,
                    render:function(data,row,type){
                        if(data.type==0){
                            return '<span class="text-warning"  >اجاره‌ای</span>'
                        }
                        else{
                            return '<span class="text-primary"  >شخصی</span> '
                        }
                    }
                },
                {"data":"area"},
                {
                    "data":null,
                    render:function(data,row,type){
                        if(data.unit==0)
                        {
                            return 'متر مربع'
                        }
                        else{
                            return 'متر'
                        }
                    }
                },
                {"data":"unitPrice"},
                {"data":"total"},
                {"data":"paid"},
                {"data":"remain"},
                {"data":"date"},
                {"data":"description"},
                {
                    "data":null,
                    render: function(data,row,type){
                        return '<a href="/projectconst/'+data.id+'"><button class="btn btn-sm btn-success fa fa-money text-primary"></button></a>'
                    }
                    
                },
                {
                    "data":null,
                    render: function(data,row,type){
                        return '<a href="/projectExp/'+data.id+'"><button class="btn btn-sm btn-warning fa fa-building text-primary" ></button><a>'
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
        $('[data-toggle="tooltip"]').tooltip(); 
    });



    // insert Project 
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#project_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('projectmanagement')}}" + '/' + isUpdate :  "{{URL::asset('projectmanagement')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#ProjectsForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#ProjectsForm')[0].reset();
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
    //edit project
    function editRecord(id) {
       
        $.ajax({
            type: "get",
            url: "{{URL::asset('projectmanagement')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#projectManagementTitle').text('ویرایش مشخصات پروژه');
                $('#project_id').val(response.projects.id);
                $('#agency_id').val(response.projects.agency_id);
                $('#name').val(response.projects.name);
                $('#address').val(response.projects.address);
                $('#type').val(response.projects.type);
                $('#area').val(response.projects.area);
                $('#unit').val(response.projects.unit);
                $('#floor').val(response.projects.floor);
                $('#apartment').val(response.projects.apartment);
                $('#unitPrice').val(response.projects.unitPrice);
                $('#total').val(response.projects.total);
                $('#paid').val(response.projects.paid);
                $('#remain').val(response.projects.remain);
                $('#date').val(response.projects.date);
                $('#description').val(response.projects.description);
                
            }
        });
    }

    // calculations
    $('#paid').on('input', function(e){
        var total=Number($('#total').val());
        var paid=Number($('#paid').val());
        var remain=total - paid;
        $('#remain').val(remain);
    });
    $('#unitPrice').on('input', function(e){
        var area=Number($('#area').val());
        var unitPrice=Number($('#unitPrice').val());
        var result=area * unitPrice;
        $('#total').val(result);
    });
    


    //delete project
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
                    url             : "{{URL::asset('projectmanagement')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "پروژه موفقانه حذف گردید !",
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