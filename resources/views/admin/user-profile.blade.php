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
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Profile</h4>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xl-4 col-lg-5">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="{{ url(Auth::user()->avatar) }}" class="rounded-circle avatar-lg img-thumbnail"
                                alt="profile-image">

                            <h4 class="mb-1 mt-2">{{ Auth::user()->username }}</h4>
                            <p class="text-muted">{{ Auth::user()->role->name }}</p>

                            <div class="hstack mt-3">
                                <div class="mx-auto text-start">
                                    <p class="text-muted mb-2 fs-5"><span class="fw-semibold">Full Name :</span> <span
                                            class="ms-2">{{ Auth::user()->fullname }}</span></p>

                                    <p class="text-muted mb-2 fs-5"><span class="fw-semibold">Email :</span> <span
                                            class="ms-2">{{ Auth::user()->email }}</span>
                                    </p>

                                    @if (isset(Auth::user()->faculty))
                                        <p class="text-muted mb-1 fs-5"><span class="fw-semibold">Faculty :</span> <span
                                                class="ms-2">{{ Auth::user()->username }}</span></p>
                                    @endif
                                </div>
                            </div>

                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col-->

                <div class="col-xl-8 col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane show active" id="settings">
                                    <form class="mb-3" method="POST" enctype="multipart/form-data"
                                        action="{{ route('admin.profile.update-info', Auth::user()->id) }}">
                                        @csrf
                                        <h5 class="mb-4 text-uppercase"><i class="ri-contacts-book-2-line me-1"></i>
                                            Personal Info</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Username
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        id="username" placeholder="Enter username..." name="username"
                                                        value="{{ Auth::user()->username }}">
                                                    @error('username')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="fullname" class="form-label">Full Name
                                                        <span class="text-danger">*</span></label>
                                                    <input type="text"
                                                        class="form-control @error('fullname') is-invalid @enderror"
                                                        id="fullname" placeholder="Enter full name..." name="fullname"
                                                        value="{{ Auth::user()->fullname }}">
                                                    @error('fullname')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">Email Address
                                                        <span class="text-danger">*</span></label>
                                                    <input type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        id="useremail" placeholder="Enter email address..." name="email"
                                                        disabled value="{{ Auth::user()->email }}">
                                                    @error('email')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="avatar" class="form-label">Avatar</label>
                                                    <input class="@error('avatar') is-invalid @enderror" type="file"
                                                        id="avatar" name="avatar">
                                                    @error('avatar')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success mt-2"><i class="ri-save-line"></i>
                                                Save</button>
                                        </div>
                                    </form>

                                    <h5 class="mb-3 text-uppercase bg-light p-2"><i class="ri-lock-password-fill me-1"></i>
                                        Reset Password</h5>
                                    <form action="{{ route('admin.profile.update-password', Auth::user()->id  ) }}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password" class="form-label">Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        id="password" placeholder="Enter password..." name="password">
                                                    @error('password')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="password_confirmation" class="form-label">Confirm
                                                        Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        id="password_confirmation" placeholder="Enter confirm password..."
                                                        name="password_confirmation">
                                                    @error('password_confirmation')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success mt-2"><i
                                                        class="ri-save-line"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- end col -->
                                </div>
                            </div> <!-- end row -->
                        </div>
                        <!-- end settings content-->

                    </div> <!-- end tab-content -->
                </div> <!-- end card body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
@endsection


@section('body.javascript')
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
            );

            // Select the file input and use create() to turn it into a pond
            $(document).ready(function() {
                var avatarField = document.getElementById('avatar');

                FilePond.create(
                    avatarField, {
                        storeAsFile: true,
                    }
                );
            })

        });
    </script>
@endsection
