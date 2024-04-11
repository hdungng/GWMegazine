@extends('layouts.admin')

@section('head.css')
    <!-- Include FilePond styles and scripts -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Add User</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- project card -->
                    <div class="card d-block">
                        <div class="card-body">
                            <div id="content" class="p-2">
                                <!-- Content -->
                                <form action="{{ route('admin.users.store') }}" method="POST" id="add-contribution"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="username" class="form-label">Username <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('username') is-invalid @enderror"
                                                id="username" name="username" type="text"
                                                placeholder="Enter username..." @error('username') is-invalid @enderror
                                                value="{{ old('username') }}">
                                            @error('username')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="fullname" class="form-label">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('fullname') is-invalid @enderror"
                                                id="fullname" name="fullname" type="text"
                                                placeholder="Enter full name..." value="{{ old('fullname') }}">
                                            @error('fullname')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="email" class="form-label">Email Address <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('email') is-invalid @enderror" id="email"
                                                name="email" type="email" placeholder="Enter email address..."
                                                value="{{ old('email') }}">
                                            @error('email')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="password" class="form-label">Password
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                id="password" name="password" type="password"
                                                placeholder="Enter password..." value="{{ old('password') }}">
                                            @error('password')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="avatar" class="form-label">Avatar</label>
                                            <input class="@error('avatar') is-invalid @enderror" type="file"
                                                id="avatar" name="avatar">
                                            @error('avatar')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="role" class="form-label">Role <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('role_id') is-invalid @enderror"
                                                aria-label="role" name="role_id" id="roleSelect">
                                                <option selected value="">Please choose a specific role...</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3" id="dynamicSelectRow">
                                            @error('faculty_id')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="hstack">
                                        <div class="ms-auto">
                                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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


@section('body.javascript')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
            );

            $(document).ready(function() {
                var avatarField = document.getElementById('avatar');
                // Select the file input and use create() to turn it into a pond
                FilePond.create(
                    avatarField, {
                        storeAsFile: true,
                    }
                );

                $('#roleSelect').change(function() {
                    var roleSelectValue = $(this).val();
                    var dynamicSelectRow = $('#dynamicSelectRow');

                    dynamicSelectRow.empty();


                    const ROLES_ENUM = Object.freeze({
                        MANAGER: 'f98fd3df-e7e7-11ee-b3b3-dc21486e292b',
                        COORDINATOR: '200e9da4-e7e8-11ee-b3b3-dc21486e292b',
                        STUDENT: '200eab09-e7e8-11ee-b3b3-dc21486e292b',
                        GUEST: '200eb6b6-e7e8-11ee-b3b3-dc21486e292b',
                    });

                    if ([ROLES_ENUM.STUDENT, ROLES_ENUM.GUEST].includes(roleSelectValue)) {
                        dynamicSelectRow.append(
                            '<label for="faculty" class="form-label">Faculty <span class="text-danger">*</span></label>'
                        );
                        var facultyDynamicSelect = $(
                            '<select class="form-select @error('role_id') is-invalid @enderror" aria-label="facultyId" name="faculty_id">'
                        );

                        let facultiesSelectString =
                            '<option value="">Please choose an available faculty...</option>';
                        @foreach ($faculties as $faculty)
                            facultiesSelectString +=
                                '<option value="{{ $faculty->id }}">{{ $faculty->name }}</option>';
                        @endforeach

                        @error('faculty_id')
                            facultiesSelectString +=
                                '<small class="form-text text-danger">{{ $message }}</small>';
                        @enderror

                        facultyDynamicSelect.append(facultiesSelectString);
                        dynamicSelectRow.append(facultyDynamicSelect);


                    } else if ([ROLES_ENUM.COORDINATOR].includes(roleSelectValue)) {
                        dynamicSelectRow.append(
                            '<label for="faculty" class="form-label">Faculty Available</label>');
                        var facultyDynamicSelect = $(
                            '<select class="form-select" aria-label="facultyId" name="faculty_id">'
                        );

                        let facultiesSelectString = '<option value="">None</option>';
                        @foreach ($facultiesAvailable as $facultyAvailable)
                            facultiesSelectString +=
                                '<option value="{{ $facultyAvailable->id }}">{{ $facultyAvailable->name }}</option>';
                        @endforeach

                        facultyDynamicSelect.append(facultiesSelectString);
                        dynamicSelectRow.append(facultyDynamicSelect);
                    }
                });
            });
        });
    </script>
@endsection
