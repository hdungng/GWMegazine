@extends('layouts.admin')

@section('head.css')
    <!-- Datatables css -->
    <link href="vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
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
                                        <div class="app-search">
                                            <form class="d-flex align-items-end gap-2">
                                                <div>
                                                    <label for="faculty" class="form-label">Faculty</label>
                                                    <select class="form-select" id="faculty">
                                                        <option>All</option>
                                                        <option>Business Administrator</option>
                                                        <option>Information Technology</option>
                                                        <option>Graphic Design</option>
                                                        <option>Marketing</option>
                                                        <option>Event Management</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Filter</button>
                                            </form>
                                        </div>
                                        <div class="app-operation">
                                            <button type="button" class="btn btn-outline-danger"><i
                                                    class="ri-equalizer-line me-1"></i> Download All</button>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <h5 class="mb-2">Contribution Files</h5>

                                        <div class="row mx-n1 g-0">
                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->

                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->


                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->


                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->



                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->



                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->



                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->



                                            <div class="col-xxl-3 col-lg-6">
                                                <div class="card m-1 shadow-none border">
                                                    <div class="p-2">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto">
                                                                <div class="avatar-sm">
                                                                    <span
                                                                        class="avatar-title bg-primary-subtle text-primary rounded">
                                                                        <i class="ri-folder-2-line fw-normal fs-20"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col ps-0">
                                                                <a href="{{ route('admin.contributions.detail', 1) }}"
                                                                    class="text-muted fw-bold">admin.zip</a>
                                                                <p class="mb-0 fs-13">45.1 MB</p>
                                                            </div>
                                                        </div> <!-- end row -->
                                                    </div> <!-- end .p-2-->
                                                </div> <!-- end col -->
                                            </div> <!-- end col-->
                                        </div> <!-- end row-->
                                    </div> <!-- end .mt-3-->
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
    <!-- Datatables js -->
    <script src="vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

    <!-- Datatable Demo App js -->
    <script src="js/pages/demo.datatable-init.js"></script>
@endsection
