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

                            <h4 class="mt-2">How to pass the exam with flying colors?</h4>

                            <div class="row">
                                <div class="col-md-4">
                                    <!-- assignee -->
                                    <p class="mt-2 mb-1 text-muted">Submitted by</p>
                                    <div class="d-flex align-items-start">
                                        <img src="{{ url('public/admin/images/users/avatar-9.jpg') }}" alt="Arya S"
                                            class="rounded-circle me-2" height="24" />
                                        <div class="w-100">
                                            <h5 class="mt-1">
                                                Jonathan Andrews
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
                                                Examron Envirenment
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
                                                20/11/2024 10:00:00
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
                                            <td>ABCDEFGH0123456789</td>
                                        </tr>
                                        <tr>
                                            <th>Contribution Name</th>
                                            <td>How to pass the exam with flying colors?</td>
                                        </tr>
                                        <tr>
                                            <th>Submission status</th>
                                            <td><span class="badge text-bg-warning fs-5 fw-normal">Not
                                                    Yet</span></td>
                                        </tr>
                                        <tr>
                                            <th>Due date</th>
                                            <td>Sunday, 17 December 2023, 11:59 PM</td>
                                        </tr>
                                        <tr>
                                            <th>Last modified</th>
                                            <td>Thursday, 20 February 2024, 10:57 PM</td>
                                        </tr>
                                        <tr>
                                            <th>Contribution File</th>
                                            <td><a class="contribution-link" href="#">yourwordfile.doc</a></td>
                                        </tr>
                                        <tr>
                                            <th>Edit</th>
                                            <td>
                                                <a href="{{ route('admin.contributions.edit', 1) }}" class="btn btn-outline-primary">Edit
                                                    Contribution</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Preview</th>
                                            <td>
                                                <a href="{{ route('admin.contributions.preview', 1) }}"
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

