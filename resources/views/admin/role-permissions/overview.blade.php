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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">System</a></li>
                                <li class="breadcrumb-item active">Role & Permissions</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Role & Permissions</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-sm-row flex-column justify-content-between align-items-center gap-3">
                            <div class="app-search">
                                <form class="d-flex align-items-end gap-2">
                                    <div>
                                        <label for="role" class="form-label">Role <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" aria-label="role" name="role" id="roleSelect">
                                            <option selected>Please choose a specific role...</option>
                                            <option value="0">Admin</option>
                                            <option value="1">Coordinator</option>
                                            <option value="2">Student</option>
                                            <option value="3">Guest</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Select</button>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <!-- project card -->
                                <div class="perms-card card d-block">
                                    <div class="card-body">
                                        <h4 class="mt-2">Permissions</h4>
                                        <div id="content" class="p-2">
                                            <!-- Content -->
                                            <form action="" method="post" class="border-2">
                                                <div class="perms-container overflow-auto px-2 mt-3">
                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Admin: Dashboard</h4>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Admin: Contributions</h4>

                                                        <div class="hstack gap-3 mb-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Upload</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Delete</label>
                                                            </div>
                                                        </div>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Publish</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Download</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update Status</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Comment</label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Admin: Users</h4>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Create</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Delete</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Admin: Faculty</h4>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Create</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Delete</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Admin: Activity Logs</h4>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Admin: Academic Year</h4>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Create</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Delete</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Admin: Role & Permissions</h4>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <hr>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Home: Main Page</h4>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View All</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View Limit</label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <h4 class="header-title mb-2 fs-5 fw-semibold">
                                                            Home: Contributions</h4>

                                                        <div class="hstack gap-3 mb-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">View</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Upload</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Delete</label>
                                                            </div>
                                                        </div>

                                                        <div class="hstack gap-3">
                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Publish</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Download</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Update Status</label>
                                                            </div>

                                                            <div class="form-check form-switch">
                                                                <input type="checkbox" class="form-check-input"
                                                                    id="customSwitch1" checked>
                                                                <label class="form-check-label fw-normal"
                                                                    for="customSwitch1">Comment</label>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="hstack mt-3">
                                                    <div class="ms-auto">
                                                        <button type="submit"
                                                            class="btn btn-outline-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- end card-body-->
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
            </div> <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection

