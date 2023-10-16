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
                <form class="form-horizontal" id="goryForm" name="goryForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col-6">
                                <label for="username">Name</label>
                                <input class="form-control" name="name" value="{{ old('name') }}" type="text" id="name"
                                    placeholder="Name">
                                <span class="text-danger error-text name_error"></span>

                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <select class="form-control select2insidemodal select2" id="city_id" name="city _id">
                                        <option>Select</option>
                                        @foreach ($city as $item)
                                            <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
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
                                        <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                                        <span class="text-danger error-text description_error"></span>
                                    </div>
                                </div>
                            </div>
                             <div class="col-6">
                                <label for="validationCustom01" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
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
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            })
        }
    });

    function resetErr() {
        $('.name_error').html('');
        $('.image_error').html('');
        $('.price_error').html('');
    }
</script>
@endsection