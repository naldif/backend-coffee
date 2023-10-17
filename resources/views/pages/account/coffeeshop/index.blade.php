@extends('layouts.app',['title' => 'Coffee Shop'])

@section('content')
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">List Coffee Shop</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <button type="button" class="btn btn-primary waves-effect waves-light mb-3" data-bs-toggle="modal"
                        data-bs-target="#modalCoffeeShop">Tambah</button>

                    <table id="coffeeshopTable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="10%">No</th>
                                <th width="30%">Name</th>
                                <th width="30%">Image</th>
                                <th width="20%">City</th>
                                <th width="20%">Aksi</th>
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
    <div id="modalCoffeeShop" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Modal CoffeeShop</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="form-horizontal" id="csForm" name="csForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-6">
                                <label for="username">Name</label>
                                <input class="form-control" name="name" type="text" id="name"
                                    placeholder="Name">
                                <span class="text-danger error-text name_error"></span>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-control select2insidemodal select2" id="city_id" name="city_id">
                                        <option>Select</option>
                                        @foreach ($city as $item)
                                        <option value="{{ $item->id }}">{{ $item->city_name }}</option>
                                        @endforeach

                                    </select>
                                    <span class="text-danger error-text city_id_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label>Description</label>
                                    <div>
                                        <textarea class="form-control" name="description" id="description"
                                            rows="5"></textarea>
                                        <span class="text-danger error-text description_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <label for="validationCustom01" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <input type="text" type="" class="form-control" id="image_old" name="image_old">
                                <span class="text-danger error-text image_error"></span>
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
    <!-- /.modal -->

</div> <!-- container-fluid -->
<!-- content -->

@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".select2insidemodal").select2({
            dropdownParent: $("#modalCoffeeShop")
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
            $('#coffeeshopTable').DataTable({
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
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'cities',
                        name: 'cities.city_name'
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
    $('#csForm').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        console.log(form);
        $.ajax({
            url: "{{ route('account.coffeeshop.store') }}",
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
                    
                    $("#csForm input:hidden").val('').trigger('change');
                    $("#city_id").val("Select").trigger( "change" );
                    $('#coffeeshopTable').DataTable().ajax.reload(null, false);
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
                    
                    $('#modalCoffeeShop').modal('hide');
                }
                
            }
        });
    });

    $('body').on('click', '#edit', function() {
        var id = $(this).data('id');
        var form = this;

        $('.name_error').html('');
        //alert(id);
        $.get("{{ route('account.coffeeshop.index') }}" + '/' + id + '/edit', function(data) {
            // alert(data.cities.city_name);
            $('#modalCoffeeShop').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#description').val(data.description);
            $('#image_old').val(data.image);
            $('#city_id').val(data.cities_id).trigger('change');
        })
    });

    //DELETE MENUS RECORD
    $(document).on('click', '#delete', function() {
            var id = $(this).data('id');
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
                        url: "{{ route('account.coffeeshop.store') }}" + '/' + id,

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
                                $('#coffeeshopTable').DataTable().ajax.reload(null,
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
        $('.city_id_error').html('');
    }
</script>
@endsection