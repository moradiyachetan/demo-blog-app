@extends('layouts.app')

@push('style')
    <link href="{{ asset('assets/libs/jquery-vectormap/jquery-jvectormap-1.2.2.css')}}" rel="stylesheet"
          type="text/css"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/libs/datatables/dataTables.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/datatables/responsive.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/datatables/buttons.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/datatables/select.bootstrap4.css')}}" rel="stylesheet" type="text/css"/>

    <!-- Layout styles -->
    {{--    <link rel="stylesheet" href="{{ asset('assets/css/custom.css')}}">--}}
    <!-- End Layout styles -->
@endpush

@push('script')
    <!-- Third Party js-->
    <script src="{{ asset('assets/libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/buttons.flash.min.js')}}"></script>
    {{--    <script src="{{ asset('assets/libs/datatables/buttons.print.min.js')}}"></script>--}}
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{ asset('assets/libs/datatables/dataTables.select.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    {{--        <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>--}}
    <script src="{{ asset('assets/libs/pdfmake/vfs_fonts.js')}}"></script>

    <script type="text/javascript">

        $(function () {

            $('#resetFilter').click(function() {
                $('input[type=text]').val('').change();
                $('#fil_status').val('').change();
                table
                    .search('')
                    .columns().search('')
                    .draw();
            });

            var table = $('.data-table').DataTable({
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                stateSave: true,
                stateSaveParams: function (settings, data) {
                    data.fil_status = $('#fil_status').val();
                    data.fil_name = $('#fil_name').val();
                },
                stateLoadParams: function (settings, data) {
                    $('#fil_status').val(data.fil_status);
                    $('#fil_name').val(data.fil_name);
                },
                stateSaveCallback: function (settings, data) {
                    localStorage.setItem('subcategory_Datatable_' + settings.sInstance, JSON.stringify(data))
                },
                stateLoadCallback: function (settings) {
                    return JSON.parse(localStorage.getItem('subcategory_Datatable_' + settings.sInstance))
                },
                ajax: {
                    url: "{{ route('subcategory.index') }}",
                    data: function (d) {
                        d.status = $('#fil_status').val(),
                            d.name = $('#fil_name').val(),
                            d.search = $('input[type="search"]').val()
                    }
                },
                columns: [
                    {data: 'id', name: 'id', orderable: false},
                    {data: 'category_name', name: 'category_name'},
                    {data: 'name', name: 'name'},
                    {data: 'status', name: 'status', orderable: false,
                        render: function ( data, type, row ) {
                            if (data == 'Active')
                                return '<span class="badge badge-primary">' + data + '</span>';
                            else
                                return '<span class="badge badge-danger">' + data + '</span>';
                        }
                    },
                ],
                order: [[ 1, 'asc' ]],
                lengthChange: 1,
                buttons: [
                    {
                        extend: 'print',
                        title: 'Sub Category List',
                        customize: function (win) {
                            $(win.document.body)
                                .css('font-size', '10pt')
                                .prepend(
                                    '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                                );

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Sub Category List',
                    },
                    {
                        extend: 'excel',
                        title: 'Sub Category List',
                    },
                    {
                        extend: 'csv',
                        title: 'Sub Category List',
                    }
                ],
                // buttons: ["copy", "print", "pdf"],
                language: {
                    paginate: {
                        previous: "<i class='mdi mdi-chevron-left'>",
                        next: "<i class='mdi mdi-chevron-right'>"
                    }
                },
                drawCallback: function () {
                    $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
                }
            });

            $('#fil_status,#fil_name').change(function () {
                table.draw();
            });


        });
    </script>
    {{--    <script src="{{ asset('assets/js/custom.js')}}"></script>--}}
@endpush

@section('header')
    <header id="topnav">
        <x-navbar/>
        <x-menubar name="dsdsds"/>
    </header>
@stop


@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Upvex</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>
                <h4 class="page-title">Sub Category List</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card-box">
        <div class="row">
            <div class="col-lg-8">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="fil_name" class="sr-only">Name</label>
                        <input id='fil_name' type="text" class="form-control"/>
                    </div>
                    <div class="form-group mx-sm-3">
                        <label for="fil_status  " class="mr-2">Sort By</label>
                        <select id='fil_status' class="form-control">
                            <option value="">--Select Status--</option>
                            <option value="Active">Active</option>
                            <option value="Deactive">Deactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="text-lg-right mt-3 mt-lg-0">
                    <button type="button" class="btn btn-danger waves-effect waves-light mr-1" id="resetFilter"><i class="mdi mdi-filter"></i> Reset Filters</button>
                </div>
            </div><!-- end col-->
        </div> <!-- end row -->
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table data-table" width="100%">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th width="100px">Status</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>




@stop
