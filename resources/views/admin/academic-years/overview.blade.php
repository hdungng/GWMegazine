@extends('layouts.admin')

@section('head.css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" />
    <!-- Flatpickr Timepicker css -->
    <link href="{{ url('public/admin/vendor/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
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
                                <li class="breadcrumb-item active">Academic Year</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Academic Year</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="academicYearContainer">
                            <div class="row">
                                {{-- <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="header-title">Add Academic Year</h4>
                                            <div id="content" class="p-3">
                                                <!-- Content -->
                                                <form action="{{ route('admin.academic-year.store') }}" method="post"
                                                    id="add-contribution">
                                                    @csrf
                                                    <div class="form-floating mb-3">
                                                        <input type="text"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            id="academicYearName" name="name">
                                                        @error('name')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                        <label for="academicYearName">Academic Year
                                                            Name <span class="text-danger">*</span></label>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Starting Date <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="datetimepicker"
                                                            class="form-control @error('starting_date') is-invalid @enderror"
                                                            name="starting_date" placeholder="Choose starting date...">
                                                        @error('starting_date')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Closure Date <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="datetimepicker"
                                                            class="form-control @error('closure_date') is-invalid @enderror"
                                                            name="closure_date" placeholder="Choose closure date...">
                                                        @error('closure_date')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label">Final Closure Date <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" id="datetimepicker"
                                                            class="form-control @error('final_closure_date') is-invalid @enderror"
                                                            name="final_closure_date"
                                                            placeholder="Choose final closure date...">
                                                        @error('final_closure_date')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>

                                                    <div class="hstack">
                                                        <button class="btn btn-outline-primary ms-auto"
                                                            type="submit">Create</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div> <!-- end card-body -->
                                    </div> <!-- end card-->
                                </div> --}}
                                <div class="hstack mb-3">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#academicYearAddModal"
                                        class="btn btn-outline-primary ms-auto">Add
                                        Academic Year</a>
                                </div>

                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body academicYearTableWrapper">
                                            @if ($academicYears->count() > 0)
                                                <table id="dataTable" class="table w-100 nowrap">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Academic Year Name</th>
                                                            <th>Starting Date</th>
                                                            <th>Closure Date</th>
                                                            <th>Final Closure Date</th>
                                                            <th></th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($academicYears as $academicYear)
                                                            <tr>
                                                                <td>{{ $loop->iteration }}</td>
                                                                <td>{{ $academicYear->name }}</td>
                                                                <td>{{ (new DateTime($academicYear->starting_date))->format('F d, Y H:i:s') }}
                                                                </td>
                                                                <td>{{ (new DateTime($academicYear->closure_date))->format('F d, Y H:i:s') }}
                                                                </td>
                                                                <td>{{ (new DateTime($academicYear->final_closure_date))->format('F d, Y H:i:s') }}
                                                                </td>
                                                                <td>
                                                                    @if ($academicYear->status == 0)
                                                                        <button class="btn btn-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#academicYearStatusModal"
                                                                            data-academicYearId="{{ $academicYear->id }}"
                                                                            data-academicYearName="{{ $academicYear->name }}">Select</button>
                                                                    @else
                                                                        <button class="btn btn-outline-primary"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#academicYearStatusModal"
                                                                            data-academicYearId="{{ $academicYear->id }}"
                                                                            data-academicYearName="{{ $academicYear->name }}"
                                                                            disabled>Selected</button>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown"
                                                                        aria-expanded="false">
                                                                    </i>
                                                                    <ul class="dropdown-menu">
                                                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                                data-bs-target="#academicYearEditModal"
                                                                                data-academicYearId="{{ $academicYear->id }}"
                                                                                data-academicYearName="{{ $academicYear->name }}"
                                                                                data-startingDate="{{ (new DateTime($academicYear->starting_date))->format('F d, Y H:i:s') }}"
                                                                                data-closureDate="{{ (new DateTime($academicYear->closure_date))->format('F d, Y H:i:s') }}"
                                                                                data-finalClosureDate="{{ (new DateTime($academicYear->final_closure_date))->format('F d, Y H:i:s') }}">Update</a>
                                                                        </li>
                                                                        <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                                data-bs-target="#academicYearDeleteModal"
                                                                                data-academicYearName="{{ $academicYear->name }}"
                                                                                data-academicYearId="{{ $academicYear->id }}">Delete</a>
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            @else
                                                <p class="text-center">No data currently available.</p>
                                            @endif
                                            @include('admin.academic-years.add-modal')
                                            <!-- Modal -->
                                            @include('admin.academic-years.edit-modal')

                                            @include('admin.academic-years.delete-modal')

                                            @include('admin.academic-years.status-modal')

                                        </div> <!-- end card-body -->
                                    </div> <!-- end card-->
                                </div> <!-- end col -->
                            </div>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card-->
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
                    targets: [4, 5],
                    orderable: false
                }]
            });
        });
    </script>

    <!-- Flatpickr Timepicker Plugin js -->
    <script src="{{ url('public/admin/vendor/flatpickr/flatpickr.min.js') }}"></script>

    <script>
        var academicYearAddModal = document.getElementById('academicYearAddModal');
        var academicYearEditModal = document.getElementById('academicYearEditModal');
        var academicYearDeleteModal = document.getElementById('academicYearDeleteModal');
        var academicYearStatusModal = document.getElementById('academicYearStatusModal');


        academicYearAddModal.addEventListener('show.bs.modal', function(event) {
            flatpickr(".datetimepickerAdd", {
                enableTime: true,
                dateFormat: "F j, Y H:i:S", // Adjust the date format here
                time_24hr: true,
                onReady: function(selectedDates, dateStr, instance) {
                    if (dateStr) {
                        instance.jumpToDate(new Date(dateStr));
                    }
                }
            });
        });


        academicYearEditModal.addEventListener('show.bs.modal', function(event) {

            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var academicYearIdData = updateLinkElement.getAttribute('data-academicYearId');
            var academicYearNameData = updateLinkElement.getAttribute('data-academicYearName');
            var startingDateData = updateLinkElement.getAttribute('data-startingDate');
            var closureDateData = updateLinkElement.getAttribute('data-closureDate');
            var finalClosureDateData = updateLinkElement.getAttribute('data-finalClosureDate');


            var academicYearIdEditControl = document.getElementById('academicYearIdEdit');
            var academicYearNameEditControl = document.getElementById('academicYearNameEdit');
            var startingDateEditControl = document.getElementById('startingDateEdit');
            var closureDateEditControl = document.getElementById('closureDateEdit');
            var finalClosureDateEditControl = document.getElementById('finalClosureDateEdit');

            academicYearIdEditControl.value = academicYearIdData;
            academicYearNameEditControl.value = academicYearNameData;
            startingDateEditControl.value = startingDateData;
            closureDateEditControl.value = closureDateData;
            finalClosureDateEditControl.value = finalClosureDateData;

            flatpickr(".datetimepickerEdit", {
                enableTime: true,
                dateFormat: "F j, Y H:i:S", // Adjust the date format here
                time_24hr: true,
                onReady: function(selectedDates, dateStr, instance) {
                    if (dateStr) {
                        instance.jumpToDate(new Date(dateStr));
                    }
                }
            });
        });


        academicYearDeleteModal.addEventListener('show.bs.modal', function(event) {
            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var academicYearIdData = updateLinkElement.getAttribute('data-academicYearId');
            var academicYearNameData = updateLinkElement.getAttribute('data-academicYearName');

            var academicYearIdDeleteControl = document.getElementById('academicYearIdDelete');
            var academicYearNameDeleteText = document.getElementById('academicYearNameDelete');

            academicYearIdDeleteControl.value = academicYearIdData;
            academicYearNameDeleteText.innerHTML = academicYearNameData;
        })



        academicYearStatusModal.addEventListener('show.bs.modal', function(event) {
            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var academicYearIdData = updateLinkElement.getAttribute('data-academicYearId');
            var academicYearNameData = updateLinkElement.getAttribute('data-academicYearName');

            var academicYearIdStatusControl = document.getElementById('academicYearIdStatus');
            var academicYearNameStatusText = document.getElementById('academicYearNameStatus');

            academicYearIdStatusControl.value = academicYearIdData;
            academicYearNameStatusText.innerHTML = academicYearNameData;
        })
    </script>
@endsection
