@extends('layouts.admin')

@section('head.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
@endsection

@section('body.content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">System </a></li>
                                @if (Auth::user()->role->name == 'Admin')
                                    <li class="breadcrumb-item active">Activity Logs</li>
                                @else
                                    <li class="breadcrumb-item active">Contribution Logs</li>
                                @endif
                            </ol>
                        </div>
                        @if (Auth::user()->role->name == 'Admin')
                            <h4 class="page-title">Activity Logs</h4>
                        @else
                            <h4 class="page-title">Contribution Logs</h4>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if ($activityLogs->count() > 0)
                                <table id="dataTable" class="table w-100 nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Content</th>
                                            <th>Date</th>
                                            <th>By User</th>
                                        </tr>
                                    </thead>


                                    <tbody>
                                        @foreach ($activityLogs as $log)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $log->content }}</td>
                                                <td>{{ (new DateTime($log->created_at))->format('F d, Y H:i:s') }}</td>
                                                <td>{{ $log->user->fullname }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-center">No data currently available.</p>
                            @endif
                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div> <!-- end row-->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection


@section('body.javascript')
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                lengthChange: false,
                scrollX: true,
                pageLength: 30
            });
        });
    </script>
@endsection
