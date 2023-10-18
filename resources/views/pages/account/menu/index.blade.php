@extends('layouts.app',['title' => 'Menu'])

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">List Menu {{ $coffeeshop->name }}</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  
                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3 mt-10" data-bs-toggle="modal"
                        data-bs-target="#modalMenu">Tambah</button>

                    <table id="menuTable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="40%">Name</th>
                                <th width="20%">Category</th>
                                <th width="20%">Image</th>
                                <th width="30%">Price</th>
                                <th width="30%">Aksi</th>
                            </tr>
                        </thead>


                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- sample modal content -->
    <div id="modalMenu" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">Modal Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal" action="{{ route('account.coffeeshop.menu.store', $coffeeshop->id) }}" id="menuForm" name="menuForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <input type="hidden" name="coffeeshop_id" id="coffeeshop_id" value="{{ $coffeeshop->id }}">
        
                        <div class="row">
                            <div class="col-6">
                                <label for="username">Coffee Name</label>
                               
                                <input type="text" class="form-control" name="coffeeshop_name" id="coffeeshop_name" value="{{ $coffeeshop->name }}" @readonly(true)>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="username">Name</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text" id="name"
                                    placeholder="Name">
                                <span class="text-danger error-text name_error"></span>

                            </div>
                            <div class="col-6">
                                <label for="validationCustom01" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <input type="text" type="" class="form-control" id="image_old" name="image_old">
                                <span class="text-danger error-text image_error"></span>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select class="form-control select2insidemodal select2" id="category_id"
                                        name="category_id">
                                        <option>Select</option>
                                        @foreach ($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger error-text category_id_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="validationCustom01" class="form-label">Price</label>
                                <input type="number" name="price" id="price" class="form-control"
                                    value="{{ old('price') }}" placeholder="Price">
                                <span class="text-danger error-text price_error"></span>
                            </div>
                        </div>
          
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal"
                            onclick="resetErr()">Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save
                            changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>

<!-- content -->

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".select2insidemodal").select2({
            dropdownParent: $("#modalMenu")
        });
    });
</script>
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
            $('#menuTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{!! url()->current() !!}'
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'category',
                        name: 'category.name'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },

                ]
            })
        }

    });

    //ADD AND STORE NEW MENUS
    $('#menuForm').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        var coffeeshop_id = $('#coffeeshop_id').val();
        console.log(form);
        $.ajax({
            url:$(form).attr('action'),
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
                    
                    $("#menuForm input:hidden").val('').trigger('change');
                    $("#category_id").val("Select").trigger( "change" );
                   
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
                    $('#menuTable').DataTable().ajax.reload(null, false);
                    $('#modalMenu').modal('hide');

                    $('#coffeeshop_id').val(coffeeshop_id);
                }
                
            }
        });
    });

    $('body').on('click', '#edit', function() {
        var id = $(this).data('id');
        // var coffeeshop_id = $('#coffeeshop_id input:hidden').val();
        var coffeeshop_id = document.getElementById("coffeeshop_id").value;
        // alert(coffeeshop_id)
        $.get("{{ route('account.coffeeshop.index') }}" + '/' + coffeeshop_id +'/menu'+'/'+ id +'/edit', function(data) {
            console.log(data);
            $('#modalMenu').modal('show');

            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#image_old').val(data.image);
            $('#category_id').val(data.category_id).trigger('change');
            $('#price').val(data.price);
            
        })
        // $(form)[0].reset();
    });

    //DELETE MENUS RECORD
    $(document).on('click', '#delete', function() {
        var id = $(this).data('id');
        var coffeeshop_id = $('#coffeeshop_id').val();
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this Coffee Shop ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('account.coffeeshop.index') }}" + '/' + coffeeshop_id +'/menu' + '/' + id,

                    success: function(data) {
                        console.log(data)
                        if (data.code == 1) {
                            Swal.fire({
                                type: 'success',
                                icon: 'success',
                                title: 'success',
                                text: `${data.msg}`,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $('#menuTable').DataTable().ajax.reload(null,
                                false);
                        }
                    }
                });

            }
        })

    });
  

    function resetErr() {
        $('.name_error').html('');
        $('.image_error').html('');
        $('.price_error').html('');

        $('#menuForm')[0].reset();
        $('#category_id').val('Select').trigger('change');
    }
</script>
@endsection