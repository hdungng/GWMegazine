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
                        @if (in_array(Auth::user()->role->name, ['Admin', 'Manager']))
                            <h4 class="page-title">Users</h4>
                        @else
                            <h4 class="page-title">Students</h4>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @if (Auth::user()->role->name == 'Admin')
                                <div class="hstack mb-3">
                                    <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary ms-auto">Add
                                        User</a>
                                </div>
                            @endif

                            @if ($users->count() > 0)
                                <table id="dataTable" class="table w-100 nowrap">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Faculty</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->fullname }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->role_name }}</td>
                                                <td>{{ $user->faculty_name }}</td>
                                                <td>
                                                    @if (Auth::user()->id != $user->id && Auth::user()->role->name == 'Admin')
                                                        <i class="ri-more-2-fill px-3" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                        </i>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.users.edit', $user->id) }}">Update</a>
                                                            </li>
                                                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                                                    data-bs-target="#userDeleteModal"
                                                                    data-fullName="{{ $user->fullname }}"
                                                                    data-userId="{{ $user->id }}">Delete</a>
                                                            </li>
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                @include('admin.users.delete-modal')
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
                columnDefs: [{
                        targets: 6,
                        orderable: false
                    } // Disable sorting for columns 1 and 2
                ]
            });
        });

        var userDeleteModal = document.getElementById('userDeleteModal');

        userDeleteModal.addEventListener('show.bs.modal', function(event) {
            var updateLinkElement = event.relatedTarget; // updateLinkElement that triggered the modal

            var userIdData = updateLinkElement.getAttribute('data-userId');
            var fullNameData = updateLinkElement.getAttribute('data-fullName');

            var userIdDeleteControl = document.getElementById('userIdDelete');
            var fullNameDeleteText = document.getElementById('fullNameDelete');

            userIdDeleteControl.value = userIdData;
            fullNameDeleteText.innerHTML = fullNameData;
        })
    </script>
@endsection
