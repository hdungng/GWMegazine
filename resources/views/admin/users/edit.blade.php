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
                                <li class="breadcrumb-item active">Edit User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit User</h4>
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
                                <form action="{{ route('admin.users.update', $user->id) }}" method="POST"
                                    id="add-contribution" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="username" class="form-label">Username <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('username') is-invalid @enderror"
                                                id="username" name="username" type="text"
                                                placeholder="Enter username..." @error('username') is-invalid @enderror
                                                value="{{ $user->username }}">
                                            @error('username')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="fullname" class="form-label">Full Name <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('fullname') is-invalid @enderror"
                                                id="fullname" name="fullname" type="text"
                                                placeholder="Enter full name..." value="{{ $user->fullname }}">
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
                                                value="{{ $user->email }}" disabled>
                                            @error('email')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="avatar" class="form-label">Avatar</label>
                                            <input class="@error('avatar') is-invalid @enderror" type="file"
                                                id="avatar" name="avatar">
                                            @error('avatar')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="role" class="form-label">Role <span
                                                    class="text-danger">*</span></label>
                                            <select class="form-select @error('role_id') is-invalid @enderror"
                                                aria-label="role" name="role_id" id="roleSelect" readonly="true" disabled>
                                                <option selected value="">Please choose a specific role...</option>
                                                @foreach ($roles as $role)
                                                    <option
                                                        value="{{ $role->id }}"{{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                        {{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('role_id')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3" id="dynamicSelectRow">
                                            @if ($user->role_id == $roles[1]->id)
                                                <!-- Form control for Coordinator -->
                                                <div class="form-group">
                                                    <label for="faculty" class="form-label">Faculty Available</label>
                                                    <!-- Your form control for Coordinator -->
                                                    <select class="form-select" aria-label="faculty_id" name="faculty_id">
                                                        <option selected value="">None</option>
                                                        @foreach ($facultiesAvailable as $facultyAvailable)
                                                            <option value="{{ $facultyAvailable->id }}"
                                                                {{ $user->id == $facultyAvailable->coordinator_id ? 'selected' : '' }}>
                                                                {{ $facultyAvailable->name }}</option>';
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @elseif (in_array($user->role_id, [$roles[2]->id, $roles[3]->id]))
                                                <div class="form-group">
                                                    <label for="faculty" class="form-label">Faculty
                                                        <span class="text-danger">*</span></label>
                                                    <!-- Your form control for Coordinator -->
                                                    <select class="form-select" aria-label="faculty_id" name="faculty_id">
                                                        @foreach ($faculties as $faculty)
                                                            <option value="{{ $faculty->id }}"
                                                                {{ $user->faculty_id == $faculty->id ? 'selected' : '' }}>
                                                                {{ $faculty->name }}</option>';
                                                        @endforeach
                                                    </select>
                                                </div>
                                            @endif
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
        });

        $(document).ready(function() {
            var avatarField = document.getElementById('avatar');
            FilePond.create(
                avatarField, {
                    storeAsFile: true,
                }
            );
        })
    </script>
@endsection
