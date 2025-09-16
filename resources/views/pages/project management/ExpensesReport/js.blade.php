<script>
    //datatable
    $(document).ready(function(params) {
        $('#datatable').DataTable(
            {
                retrieve:true,
            ajax:
            {
                type: "get",
                url: "/getprojectExpReport",
                data: "data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"project_id"},
                {"data":"name"},
                {"data":"total"},
                {"data":"paid"},
                {"data":"remain"},
            ],
            autofill: true,
            select: true,
            responsive: true,
            buttons: true,
            length: 10,
        }
        );
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable();
        $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
       
    });

    // insert dates for report
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        $.ajax({
            method   : "get",
            url      : "/getprojectExpReport",
            data     : $('#projectExpenseReportForm').serialize(),
            success  : function(response){    
                
                if($.isEmptyObject(response.error)){
                    toastr.success(response.success);
                    // $('#datatable').DataTable().ajax.reload();
                    $('#collapsable').collapse('hide');
                    // $('#projectExpenseReportForm')[0].reset();
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
</script>