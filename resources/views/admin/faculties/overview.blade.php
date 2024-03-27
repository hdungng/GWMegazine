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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">App</a></li>
                                <li class="breadcrumb-item active">Faculty</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Faculty</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Add Faculty</h4>
                            <div id="content" class="p-3">
                                <!-- Content -->
                                <form action="" method="post" id="add-contribution">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="facultyName" name="name">
                                        <label for="facultyName">Faculty Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="facultyName" name="short_name">
                                        <label for="facultyName">Faculty Short Name <span
                                                class="text-danger">*</span></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="coordinatorEdit" aria-label="coordinatorEdit" name="coordinator_id">
                                            <option selected value="">None</option>
                                            <option value="0">Tiger Nixon</option>
                                            <option value="1">Garrett Winters</option>
                                            <option value="2">Ashton Cox</option>
                                            <option value="3">Cedric Kelly</option>
                                            <option value="4">Brielle Williamson</option>
                                        </select>
                                        <label for="coordinatorEdit">Coordinator</label>
                                    </div>
                                    <div class="hstack">
                                        <button class="btn btn-outline-primary ms-auto" type="submit">Create</button>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->

                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <table id="dataTable" class="table w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Faculty Name</th>
                                        <th>Short Name</th>
                                        <th>Coordinator</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Marketing</td>
                                        <td>Marketing</td>
                                        <td>Tiger Nixon</td>
                                        <td>
                                            <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown" aria-expanded="false">
                                            </i>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyEditModal" data-facultyName="Marketing"
                                                        data-shortName="Marketing" data-coordinator="0">Update</a></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyDeleteModal" data-facultyName="Marketing"
                                                        data-facultyId="1">Delete</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Business Administration</td>
                                        <td>Business</td>
                                        <td>Garrett Winters</td>
                                        <td>
                                            <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown" aria-expanded="false">
                                            </i>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyEditModal"
                                                        data-facultyName="Business Administration" data-shortName="Business"
                                                        data-coordinator="1">Update</a></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyDeleteModal"
                                                        data-facultyName="Business Administration"
                                                        data-facultyId="2">Delete</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Information Technology</td>
                                        <td>IT</td>
                                        <td>Ashton Cox</td>
                                        <td>
                                            <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown" aria-expanded="false">
                                            </i>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyEditModal"
                                                        data-facultyName="Information Technology" data-shortName="IT"
                                                        data-coordinator="2">Update</a></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyDeleteModal"
                                                        data-facultyName="Information Technology"
                                                        data-facultyId="3">Delete</a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Graphic Design</td>
                                        <td>Design</td>
                                        <td>Cedric Kelly</td>
                                        <td>
                                            <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            </i>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyEditModal"
                                                        data-facultyName="Graphic Design" data-shortName="Design"
                                                        data-coordinator="3">Update</a></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyDeleteModal"
                                                        data-facultyName="Graphic Design" data-facultyId="4">Delete</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Event Management</td>
                                        <td>Event</td>
                                        <td>Brielle Williamson</td>
                                        <td>
                                            <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                            </i>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyEditModal"
                                                        data-facultyName="Event Management" data-shortName="Event"
                                                        data-coordinator="4">Update</a></li>
                                                <li><a class="dropdown-item" data-bs-toggle="modal"
                                                        data-bs-target="#facultyDeleteModal"
                                                        data-facultyName="Event Management" data-facultyId="5">Delete</a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            {{-- Edit Modal --}}
                            @include('admin.faculties.edit-modal')
                            @include('admin.faculties.delete-modal')

                        </div> <!-- end card-body -->
                    </div> <!-- end card-->
                </div> <!-- end col -->
            </div> <!-- end row -->
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
                columnDefs: [{
                    targets: 3,
                    orderable: false
                }]
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#scroll-horizontal-datatable_length').parent('.col-sm-12.col-md-6').hide();
        });

        var facultyEditModal = document.getElementById('facultyEditModal');
        var facultyDeleteModal = document.getElementById('facultyDeleteModal');

        facultyEditModal.addEventListener('show.bs.modal', function(event) {
            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var facultyNameData = updateLinkElement.getAttribute('data-facultyName');
            var shortNameData = updateLinkElement.getAttribute('data-shortName');
            var coordinatorData = updateLinkElement.getAttribute('data-coordinator');

            var facultyNameEditControl = document.getElementById('facultyNameEdit');
            var facultyShortNameEditControl = document.getElementById('facultyShortNameEdit');
            var coordinatorEditControl = document.getElementById('coordinatorEdit');

            facultyNameEditControl.value = facultyNameData;
            coordinatorEditControl.value = coordinatorData;
            facultyShortNameEditControl.value = shortNameData;
        });


        facultyDeleteModal.addEventListener('show.bs.modal', function(event) {
            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var facultyIdData = updateLinkElement.getAttribute('data-facultyId');
            var facultyNameData = updateLinkElement.getAttribute('data-facultyName');

            var facultyIdDeleteControl = document.getElementById('facultyIdDelete');
            var facultyNameDeleteControl = document.getElementById('facultyNameDelete');

            facultyIdDeleteControl.value = facultyIdData;
            facultyNameDeleteControl.innerHTML = facultyNameData;
        });
    </script>
@endsection
