<script>
    // append category
    var maxFieldLimits=10;
    var x=3;
    

    
    $('#submitCat').on('click', function () {
        $('#myModal').modal('hide');
       let catName=$('#categoryName').val();
       if (x < maxFieldLimits) {
           console.log(x);
           x++;
           $('#categories').append($('<option>', {
                value: x,
                text: catName,
            }));
       }
    });
    // append category end
    // append type
    var maxFieldLimitsType=10;
    var t=3;
    
    $('#submitType').on('click', function () {
        $('#typeModal').modal('hide');
       let typeName=$('#typeName').val();
       if (t < maxFieldLimitsType) {
           console.log(x);
           t++;
           $('#type').append($('<option>', {
                value: t,
                text: typeName,
            }));
       }
    });
    // append type end



    $(document).ready(function() {
        $('#datatable').DataTable(
            // {
            // ajax:
            // {
            //     type: "get",
            //     url: "/getprojectConst",
            //     data:"data",
            //     dataType:"json",
            // },
            // columns:
            // [
            //     {"data":"id"},
            //     {
            //         "data":null,
            //         render:function(data,type,row){
            //             if(data.category==1){
            //                 return '<span class="text-primary">نجاری</span>'
            //             }
            //             else if( data.category==2){
            //                 return '<span class="text-secondary">شیشه</span>  '
            //             }
            //             else if(data.category==3){
            //                 return '<span class="text-warning">آهن آلات</span>'
            //             }
            //             else{
            //                 return '<span class="text-secondary">متفرقه</span> '
            //             }
            //         }
            //     },
            //     {"data":"name"},
            //     {"data":"amount"},
            //     {
            //         "data":null,
            //         render:function(data,row,type){
            //             if(data.type==1){
            //                 return '<span class="text-primary">نوع اول</span>'
            //             }
            //             else if( data.type==2){
            //                 return '<span class="text-secondary">نوع دوم</span>  '
            //             }
            //             else if(data.type==3){
            //                 return '<span class="text-warning">نوع سوم</span>'
            //             }
            //             else{
            //                 return '<span class="text-secondary">متفرقه</span> '
            //             }
            //         }
            //     },
            //     {"data":"price"},
            //     {"data":"company_id"},
            //     {"data":"total"},
            //     {"data":"paid"},
            //     {
            //         "data":null,
            //         render:function(data,row,type){
            //             if(data.currency==1)
            //             {
            //                 return 'افغانی'
            //             }
            //             else{
            //                 return 'دالر'
            //             }
            //         }
            //     },
            //     {"data":"remain"},
            //     {"data":"bill"},
            //     {"data":"date"},
            //     {"data":"description"},
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
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#edit_project_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('projectconstruction')}}" + '/' + isUpdate :  "{{URL::asset('projectconstruction')}}";
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


    // calc 
    $('#price').on('input' ,function(e){
        var price=Number($('#price').val());
        var amount=Number($('#amount').val());
        var total= price * amount;
        $('#total').val(total);
    });
    $('#paid').on('input' ,function(e){
        var total=Number($('#total').val());
        var paid=Number($('#paid').val());
        var remain= total - paid;
        $('#remain').val(remain);
    });


    


    function editRecord(id){
        
        $.ajax({
            type: "get",
            url: "{{URL::asset('projectconstruction')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#project_construction_title').text('ویرایش مصارف اعمار');
                $('#edit_project_id').val(response.consts.id);
                $('#categories').val(response.consts.category);
                $('#name').val(response.consts.name);
                $('#amount').val(response.consts.amount);
                $('#type').val(response.consts.type);
                $('#price').val(response.consts.price);
                $('#company').val(response.consts.company_id);
                $('#total').val(response.consts.total);
                $('#paid').val(response.consts.paid);
                $('#remain').val(response.consts.remain);
                $('#currency').val(response.consts.currency);
                $('#date').val(response.consts.date);
                $('#bill').val(response.consts.bill);
                $('#description').val(response.consts.description);
            }
        });
        
    }


    //delete project constructions 
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
                    url             : "{{URL::asset('projectconstruction')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "مصارف موفقانه حذف گردید !",
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