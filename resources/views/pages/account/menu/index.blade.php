@extends('layouts.app',['title' => 'Menu'])

@section('content')

<div class="content">

    <div class="container-fluid">
        <div class="page-title-box">

            <div class="row align-items-center ">
                <div class="col-md-8">
                    <div class="page-title-box">
                        <h4 class="page-title">Data Table</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Zegva</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Tables</a>
                            </li>
                            <li class="breadcrumb-item active">Data Table</li>
                        </ol>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="float-right d-none d-md-block app-datepicker">
                        <input type="text" class="form-control" data-date-format="MM dd, yyyy" readonly="readonly" id="datepicker">
                        <i class="mdi mdi-chevron-down mdi-drop"></i>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page-title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">Default Datatable</h4>
                        <p class="sub-title">DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction function: <code>$().DataTable();</code>.
                        </p>

                        <table id="menutable" class="table table-bordered dt-responsive nowrap"
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
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

    </div>
    <!-- container-fluid -->

</div>
<!-- content -->

@endsection

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
                $('#menutable').DataTable({
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
    </script>
@endsection