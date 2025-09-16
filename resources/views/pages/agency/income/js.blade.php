<script>
    //document ready
    $(document).ready(function() {
        $('#datatable').DataTable({
        ajax:
            {
                type: "get",
                url: "/AgencyIncomes",
                data: "data",
                dataType: "json",

            },
            columns:
            [
                {"data":"id"},
                {"data":"name"},
                {"data":"amount"},
                {"data":"duration"},
                {"data":"date"},
                {"data":"description"},
                {
                    "data":null,
                    render: function(data,row,type){
                        return '<button class="btn btn-trans btn-sm btn-primary fa fa-pencil text-primary" data-toggle="collapse" data-target="#collapsable" onclick="editRecord('+data.id+')"></button>'
                    }
                    
                },
                {
                    "data":null,
                    render: function(data,row,type){
                        return '<button class="btn btn-trans btn-sm btn-danger fa fa-trash text-danger" onclick="deleteRecord('+data.id+')"></button>'
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

    // insert agency income
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var isUpdate    = $('#agencyIncome_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('agenciesIncome')}}" + '/' + isUpdate :  "{{URL::asset('agenciesIncome')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#agencyIncomeForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#agencyIncomeForm')[0].reset();
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
    // end insert agency income

    //edit agency incomes
    function editRecord(id) {
       
        $.ajax({
            type: "get",
            url: "{{URL::asset('agenciesIncome')}}"+'/'+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#agencyIncomeTitle').text('ویرایش درآمد');
                $('disabledOption').remove();
                $('#agencyIncome_id').val(response.AgencyIncome.id);
                $('#agency_id').val(response.AgencyIncome.agency_id);
                $('#amount').val(response.AgencyIncome.amount);
                $('#duration').val(response.AgencyIncome.duration);
                $('#date').val(response.AgencyIncome.date);
                $('#description').val(response.AgencyIncome.description);
            }
        });

    }

    //Delete agency incomes
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
                    method          : "DELETE",
                    url             : "{{URL::asset('agenciesIncome')}}"+'/'+id,
                    success         : function(data){
                        swal({
                            title               : "درآمد موفقانه حذف گردید !",
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