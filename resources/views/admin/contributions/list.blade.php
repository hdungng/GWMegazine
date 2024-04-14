@extends('layouts.admin')

@section('head.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
@endsection

@section('body.content')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">


            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                                <li class="breadcrumb-item active">Contribution Files</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Contribution Files</h4>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Left sidebar -->
                            <div class="row">
                                <div class="col-12">
                                    <div
                                        class="d-flex flex-sm-row flex-column justify-content-between align-items-end gap-3">
                                        <div class="app-operation">
                                            <button type="button" class="btn btn-outline-danger">Download All <i
                                                    class="ri-download-2-fill ms-1"></i> </button>
                                        </div>
                                    </div>

                                    @if ($contributions->count() > 0)
                                        <table id="dataTable" class="table w-100 nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Image</th>
                                                    <th>Title</th>
                                                    <th>By Student</th>
                                                    <th>Faculty</th>
                                                    <th>Status</th>
                                                    <th>Academic Year</th>
                                                    <th>Submited Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($contributions as $contribution)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <img src="{{ url($contribution->image_url) }}" alt=""
                                                                width="74">
                                                        </td>
                                                        <td>
                                                            <a
                                                                href="{{ route('admin.contributions.detail', $contribution->id) }}">{{ $contribution->title }}</a>
                                                        </td>
                                                        <td>{{ $contribution->student_name }}</td>
                                                        <td>{{ $contribution->faculty_name }}</td>
                                                        <td>
                                                            @switch($contribution->status)
                                                                @case(0)
                                                                    <span class="badge text-bg-warning">Pending</span>
                                                                @break

                                                                @case(1)
                                                                    <span class="badge text-bg-success">Published</span>
                                                                @break

                                                                @default
                                                                    <span class="badge text-bg-warning">Pending</span>
                                                            @endswitch
                                                        </td>
                                                        <td>{{ $contribution->academic_year_name }}</td>
                                                        <td>{{ (new DateTime($contribution->created_at))->format('F d, Y H:i:s') }}
                                                        </td>
                                                        <td>
                                                            <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                            </i>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item"
                                                                        href="{{ route('admin.contributions.preview', $contribution->id) }}">Preview</a>
                                                                </li>
                                                                @if ($contribution->status == 0)
                                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                            data-bs-target="#contributionPublishModal"
                                                                            data-contributionId="{{ $contribution->id }}"
                                                                            data-contributionName="{{ $contribution->title }}">Publish</a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="text-center">No data currently available.</p>
                                    @endif
                                    @include('admin.contributions.publish-modal')
                                </div>
                            </div>
                            <!-- end inbox-rightbar-->
                        </div>
                        <!-- end card-body -->
                        <div class="clearfix"></div>
                    </div> <!-- end card-box -->

                </div> <!-- end Col -->
            </div><!-- End row -->
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
            });
        });
    </script>

    <script>
        var contributionPublishModal = document.getElementById('contributionPublishModal');

        contributionPublishModal.addEventListener('show.bs.modal', function(event) {
            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var contributionIdData = updateLinkElement.getAttribute('data-contributionId');
            var contributionNameData = updateLinkElement.getAttribute('data-contributionName');


            var contributionIdControl = document.getElementById('contributionIdPublish');
            var contributionNameText = document.getElementById('contributionNamePublish');

            contributionIdControl.value = contributionIdData;
            contributionNameText.innerHTML = contributionNameData;
        })
    </script>
@endsection
