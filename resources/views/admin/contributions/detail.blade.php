@extends('layouts.admin')

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contributions</a></li>
                                <li class="breadcrumb-item active">Contribution Overview</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Contribution Overview</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- project card -->
                    <div class="card d-block">
                        <div class="card-body">
                            <!-- end form-check-->
                            <div class="clearfix"></div>

                            <h4 class="mt-2">{{ $contribution->title }}</h4>

                            <div class="row">
                                <div class="col-md-4">
                                    <!-- assignee -->
                                    <p class="mt-2 mb-1 text-muted">Submitted by</p>
                                    <div class="d-flex align-items-start">
                                        <img src="{{ url($contribution->student_avatar) }}" alt="Arya S"
                                            class="rounded-circle me-2" height="24" />
                                        <div class="w-100">
                                            <h5 class="mt-1">
                                                {{ $contribution->student_name }}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end assignee -->
                                </div>
                                <!-- end col -->

                                <div class="col-md-4">
                                    <!-- start due date -->
                                    <p class="mt-2 mb-1 text-muted">Faculty</p>
                                    <div class="d-flex align-items-start">
                                        <i class="ri-briefcase-line fs-18 text-success me-1"></i>
                                        <div class="w-100">
                                            <h5 class="mt-1">
                                                {{ $contribution->faculty_name }}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end due date -->
                                </div>

                                <div class="col-md-4">
                                    <!-- start due date -->
                                    <p class="mt-2 mb-1 text-muted">Submitted Date</p>
                                    <div class="d-flex align-items-start">
                                        <i class="ri-calendar-todo-line fs-18 text-success me-1"></i>
                                        <div class="w-100">
                                            <h5 class="mt-1">
                                                {{ (new DateTime($contribution->created_at))->format('F d, Y H:i:s') }}
                                            </h5>
                                        </div>
                                    </div>
                                    <!-- end due date -->
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                            <h5 class="mt-3">Overview:</h5>

                            <div class="contribution-info">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Contribution ID</th>
                                            <td>{{ $contribution->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Contribution Title</th>
                                            <td>{{ $contribution->title }}</td>
                                        </tr>
                                        <tr>
                                            <th>Submission status</th>
                                            <td>
                                                @switch($contribution->status)
                                                    @case(0)
                                                        <span class="badge text-bg-warning">Pending</span>
                                                    @break

                                                    @case(1)
                                                        <span class="badge text-bg-success">Published</span>
                                                    @break

                                                    @case(2)
                                                        <span class="badge text-bg-danger">Published For Guest</span>
                                                    @break

                                                    @case(3)
                                                        <span class="badge text-bg-primary">Published All</span>
                                                    @break

                                                    @default
                                                        <span class="badge text-bg-warning">Pending</span>
                                                @endswitch
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Academic year</th>
                                            <td>{{ $contribution->academic_year_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Closure date</th>
                                            <td>{{ (new DateTime($contribution->closure_date))->format('F d, Y H:i:s') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Final closure date</th>
                                            <td>{{ (new DateTime($contribution->final_closure_date))->format('F d, Y H:i:s') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Last modified</th>
                                            <td>{{ (new DateTime($contribution->updated_at))->format('F d, Y H:i:s') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            @if (!in_array(Auth::user()->role->name, ['Admin', 'Manager']))
                                                <th>Edit</th>
                                                <td>
                                                    <a href="{{ route('admin.contributions.edit', $contribution->id) }}"
                                                        class="btn btn-outline-primary">Edit
                                                        Contribution</a>
                                                </td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Preview</th>
                                            <td>
                                                <a href="{{ route('admin.contributions.preview', $contribution->id) }}"
                                                    class="btn btn-outline-primary">Preview</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end sub tasks/checklists -->
                        </div>
                        <!-- end card-body-->
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
