<script>
     $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:
            {
                type: "get",
                url: "/getNotes",
                data:"data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"writer"},
                {"data":"subject"},
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


    // Insert Record
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();

        var isUpdate    = $('#note_id').val();
        var method      = isUpdate ? 'PUT' : 'POST';
        var url         = isUpdate ?  "{{URL::asset('notes')}}" + '/' + isUpdate :  "{{URL::asset('notes')}}";
        $.ajax({
            method   : method,
            url      : url,
            data     : $('#NotesForm').serialize(),
            success  : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#NotesForm')[0].reset();
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
    // end insert record

    // edit notes
    function editRecord(id) {
        $.ajax({
            type: "get",
            url: "{{URL::asset('notes')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#notes_title').text('ویرایش یادداشت');
                $('#note_id').val(response.notes.id);
                $('#writer').val(response.notes.writer);
                $('#subject').val(response.notes.subject);
                $('#description').val(response.notes.description);
            }
        });
        
    }






     // delete notes
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
                    url             : "{{URL::asset('notes')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "یادداشت موفقانه حذف گردید !",
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