<script>
    // append floor
    var maxFieldLimits=50;
    var x=5;
    

    
    $('#appendFloor').on('click', function () {
       if (x < maxFieldLimits) {
           x++;
           $('#floor').append($('<option>', {
                value: x,
                text: 'طبقه '+x+'',
            }));
       }
    });
    // append floor end
    // append floor
    var maxFieldLimitsApartment=50;
    var a=6;
    

    
    $('#append_apartment').on('click', function () {
       if (a < maxFieldLimitsApartment) {
           a++;
           $('#apartment').append($('<option>', {
                value: a,
                text: 'واحد '+a+'',
            }));
       }
    });
    // append floor end


    $(document).ready(function() {
        $('#datatable').DataTable(
            // {
            // ajax:
            // {
            //     type: "get",
            //     url: "/getprojectExp",
            //     data:"data",
            //     dataType:"json",
            // },
            // columns:
            // [
            //     {"data":"id"},
            //     {"data":"project_id"},
            //     {"data":"floor"},
            //     {"data":"apartment"},
            //     {"data":"bedroom"},
            //     {"data":"bathroom"},
            //     {"data":"toilet"},
            //     {"data":"kitchen"},
            //     {"data":"salon"},
            //     {
            //         "data":null,
            //         render: function(data,row,type){
            //             return '<button class="btn btn-trans btn-sm btn-primary fa fa-pencil text-primary" data-toggle="collapse" data-target="#collapsable" onclick="editRecord('+(data.id)+')"></button>'
            //         }
                    
            //     },

            //     {
            //         "data":null,
            //         render: function(data,row,type){
            //             return '<button class="btn btn-trans btn-sm btn-danger fa fa-trash text-danger" onclick="deleteRecord('+(data.id)+')"></button>'
            //         }
                    
            //     },
            // ],
            // autofill: true,
            // select: true,
            // responsive: true,
            // buttons: true,
            // length: 10,
        // }
        );
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    });
    // insert project expense
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#edit_projectExp_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('projectExpenses')}}" + '/' + isUpdate :  "{{URL::asset('projectExpenses')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#projectConstructionForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#projectConstructionForm')[0].reset();
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

    //edit project expenses
    function editRecord(id){
        
        $.ajax({
            type: "get",
            url: "{{URL::asset('projectExpenses')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#project_construction_title').text('ویرایش مشخصات اعمار واحد');
                $('#edit_projectExp_id').val(response.expenses.id);
                $('#projectExp_id').val(response.expenses.project_id);
                $('#floor').val(response.expenses.floor);
                $('#apartment').val(response.expenses.apartment);
                $('#bedroom').val(response.expenses.bedroom);
                $('#bathroom').val(response.expenses.bathroom);
                $('#toilet').val(response.expenses.toilet);
                $('#kitchen').val(response.expenses.kitchen);
                $('#salon').val(response.expenses.salon);
            }
        });
    }
    // delete project expenses
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
                    url             : "{{URL::asset('projectExpenses')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "پروژه موفقانه حذف گردید !",
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
</script>