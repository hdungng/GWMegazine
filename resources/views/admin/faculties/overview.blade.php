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
                                <form action="{{ route('admin.faculty.store') }}" method="post" id="add-contribution">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="facultyName" name="name">
                                        @error('name')
                                            <small class="form-text text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="facultyName">Faculty Name <span class="text-danger">*</span></label>
                                    </div>
                                    <label for="facultyName" class="mb-2" data-bs-toggle="tooltip"
                                        data-bs-placement="right"
                                        data-bs-title="You must choose the color since the default is #000000 that will be error.">Chart
                                        Label <span class="text-danger">*</span></label>

                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input type="color" class="form-control form-control-color" id="chart_color"
                                                title="Choose your color" name="chart_color" required>
                                        </div>
                                        <input type="text" class="form-control @error('short_name') is-invalid @enderror"
                                            id="facultyName" name="short_name">
                                    </div>
                                    @error('short_name')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                    @error('chart_color')
                                        <small class="form-text text-danger d-block ">{{ $message }}</small>
                                    @enderror

                                    <div class="form-floating my-3">
                                        <select class="form-select" id="coordinatorEdit" aria-label="coordinatorEdit"
                                            name="coordinator_id">
                                            <option value="">None</option>
                                            @foreach ($coordinatorsAvailable as $coordinatorAvailable)
                                                <option value={{ $coordinatorAvailable->id }}>
                                                    {{ $coordinatorAvailable->fullname }}</option>;
                                            @endforeach

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
                                        <th>Chart Label</th>
                                        <th>Coordinator</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faculties as $faculty)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $faculty->name }}</td>
                                            <td class="d-flex justify-content-between">{{ $faculty->short_name }} <span
                                                    class="btn p-2" style="background: {{ $faculty->chart_color }}"></span>
                                            </td>
                                            <td>{{ $faculty->coordinator_name }}</td>
                                            <td>
                                                <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                </i>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#facultyEditModal"
                                                            data-facultyId="{{ $faculty->id }}"
                                                            data-facultyName="{{ $faculty->name }}"
                                                            data-shortName="{{ $faculty->short_name }}"
                                                            data-chartColor="{{ $faculty->chart_color }}"
                                                            data-currentCoordinatorId="{{ $faculty->coordinator_id }}"
                                                            data-currentCoordinatorName="{{ $faculty->coordinator_name }}">Update</a>
                                                    </li>
                                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#facultyDeleteModal"
                                                            data-facultyName="{{ $faculty->name }}"
                                                            data-facultyId="{{ $faculty->id }}">Delete</a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @endforeach
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
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    </script>

    <script>
        $(document).ready(function() {
            $('#scroll-horizontal-datatable_length').parent('.col-sm-12.col-md-6').hide();
        });

        var facultyEditModal = document.getElementById('facultyEditModal');
        var facultyDeleteModal = document.getElementById('facultyDeleteModal');

        facultyEditModal.addEventListener('show.bs.modal', function(event) {
            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var facultyIdData = updateLinkElement.getAttribute('data-facultyId');

            var currentCoordinatorIdData = updateLinkElement.getAttribute('data-currentCoordinatorId');
            var currentCoordinatorNameData = updateLinkElement.getAttribute('data-currentCoordinatorName');
            var facultyNameData = updateLinkElement.getAttribute('data-facultyName');
            var shortNameData = updateLinkElement.getAttribute('data-shortName');
            var chartColorData = updateLinkElement.getAttribute('data-chartColor');

            var facultyIdEditControl = document.getElementById('facultyIdEdit');
            var facultyNameEditControl = document.getElementById('facultyNameEdit');
            var facultyShortNameEditControl = document.getElementById('facultyShortNameEdit');
            var chartColorEditControl = document.getElementById('chartColorEdit');
            var coordinatorEditControl = document.getElementById('coordinatorEdit');
            var currentCoordinatorOption = document.getElementById('currentCoordinatorOption');

            // Get reference to the option you want to select (in this case, the second option)
            var noneSelect = coordinatorEditControl.options[0];

            facultyIdEditControl.value = facultyIdData;
            facultyNameEditControl.value = facultyNameData;
            facultyShortNameEditControl.value = shortNameData;
            chartColorEditControl.value = chartColorData;

            if (currentCoordinatorIdData && currentCoordinatorNameData) {
                noneSelect.selected = false;
                currentCoordinatorOption.style.display = "block";


                currentCoordinatorOption.selected = true;
                currentCoordinatorOption.value = currentCoordinatorIdData;
                currentCoordinatorOption.textContent = currentCoordinatorNameData;
            } else {
                noneSelect.selected = true;
                currentCoordinatorOption.selected = false;
                currentCoordinatorOption.style.display = "none";
            }
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
