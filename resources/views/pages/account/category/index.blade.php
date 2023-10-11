@extends('layouts.app',['title' => 'Category Menu'])

@section('content')

<div class="content">

    <div class="container-fluid">
        <div class="page-title-box">

            <div class="row align-items-center ">
                <div class="col-md-8">
                    <div class="page-title-box">
                        <h4 class="page-title">Data Table</h4>


                    </div>
                </div>

            </div>
        </div>
        <!-- end page-title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-toggle="modal"
                            data-target="#modalCategory">Tambah</button>

                        <table id="categorytable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="60%">Name</th>
                                    <th width="30%">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

        <!-- sample modal content -->
        <div id="modalCategory" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Modal Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="form-horizontal" id="goryForm" name="goryForm" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="id">
                            <div class="col-12">
                                <label for="username">Name</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text" id="name"
                                    placeholder="Name">
                                <span class="text-danger error-text name_error"></span>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save changes</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    </div>
    <!-- container-fluid -->

</div>
<!-- content -->

@endsection
@include('sweetalert::alert')
@section('script')

<script>
    $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                show_data_menu()
            });

            function show_data_menu() {
                $('#categorytable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{!! url()->current() !!}'
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },

                    ]
                })
            }

             //ADD AND STORE NEW MENUS
            $('#goryForm').on('submit', function(e) {
                e.preventDefault();
                var form = this;
                console.log(form);
                $.ajax({
                    url: "{{ route('account.category.store') }}",
                    // url:$(form).attr('action'),
                    method: $(form).attr('method'),
                    data: new FormData(form),
                    // data: new FormData(form),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(form).find('span.error-text').text('');
                    },

                    success: function(data) {
                       
                        if (data.code == 0) {                    
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $(form)[0].reset();
                          
                            $("#goryForm input:hidden").val('').trigger('change');
                            $('#categorytable').DataTable().ajax.reload(null, false);
                           //show success message
                        //    toastr.success(data.msg);
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: 'success',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $('#modalCategory').modal('hide');
                        }
                    }
                });
            });

            $('body').on('click', '#edit', function() {
                var id = $(this).data('id');
                var form = this;
              
                //alert(id);
                $.get("{{ route('account.category.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modalCategory').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    
                    
                })
                // $(form)[0].reset();
            });

            //DELETE MENUS RECORD
            $(document).on('click', '#delete', function() {
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete this Category ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('account.category.store') }}" + '/' + id,

                            success: function(data) {
                                console.log(data)
                                if (data.code == 1) {
                                    Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )
                                    $('#categorytable').DataTable().ajax.reload(null,
                                    false);
                                }
                            }
                        });

                    }
                })

            });
        });
</script>
@endsection