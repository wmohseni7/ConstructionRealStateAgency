<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            ajax:
            {
                type: "get",
                url: "/getDocs",
                data:"data",
                dataType:"json",
            },
            columns:
            [
                {"data":"id"},
                {"data":"agency_id"},
                {"data":"subject"},
                {"data":"date"},
                {"data":"category"},
                {"data":"description"},
                {
                    "data":null,
                    render: function(data,row,type){
                        return '<button class="btn btn-sm btn-info fa fa-file-image-o text-primary" data-toggle="modal" data-target="#modal" onclick="showRecord('+(data.id)+')"></button>'
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
    //insert doc
    $("#saveOrUpdate").click(function(e){
        e.preventDefault();
        var form         = $('#DocsForm')[0];
        var formData     = new FormData(form);
        var method       = 'POST';
        var url          = "{{URL::asset('toDocs')}}";
        $.ajax({
            method       : method,
            url          : url,
            data         : formData,
            processData  : false,
            contentType  : false,
            success      : function(response){    
                if($.isEmptyObject(response.error)){
                    $('#DocsForm')[0].reset();
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
    // end insert doc
    //edit doc
    function editRecord(id) {
        
        $.ajax({
            type: "get",
            url: "{{URL::asset('toDocs')}}/"+id+"/edit",
            data: "data",
            dataType: "json",
            success: function (response) {
                $('#docs_title').text('ویرایش مشخصات اسناد');
                $('#doc_id').val(response.docs.id);
                $('#agency').val(response.docs.agency_id);
                $('#subject').val(response.docs.subject);
                $('#category').val(response.docs.category);
                $('#date').val(response.docs.date);
                $('#description').val(response.docs.description);
                // $('#doc').val(response.docs.document);
            }
        });
        
    }

    //show image
    function showRecord(id)
    {
        $.ajax({
            type: "get",
            url: "{{URL::asset('toDocs')}}/"+id,
            data: "data",
            dataType: "json",
            success: function (response) {
                var image=response.docs.document;
                $('#photoModal').attr("src", image);
            }
        });
    }

    //delete doc
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
                    url             : "{{URL::asset('toDocs')}}/"+id,
                    success         : function(data){
                        swal({
                            title               : "سند موفقانه حذف گردید !",
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