@extends('layouts.home')


@section('head.css')
    <!-- Filebond -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('body.content')
    <div class="col-md-9 col-lg-8 offset-lg-1">
        <!-- Page Content  -->
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-xl-4 col-lg-5">
                    <div class="card text-center p-3 card-user-profile">
                        <div class="card-body">
                            <img src="{{ url(Auth::user()->avatar) }}" class="rounded-circle avatar-lg img-thumbnail"
                                alt="profile-image">

                            <h4 class="mb-1 mt-3">{{ Auth::user()->username }}</h4>
                            <p class="text-muted">{{ Auth::user()->role->name }}</p>


                            <div class="hstack mt-5">
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

                <div class="col-xl-8 col-lg-7 mt-md-3">
                    <div class="card p-3 card-user-profile">
                        <div class="card-body">
                            <div class="tab-content">
                                <!-- end timeline content-->
                                <div class="tab-pane show active" id="updateInfo">
                                    <form class="mb-3" method="POST" enctype="multipart/form-data"
                                        action="{{ route('home.profile.update-info', Auth::user()->id) }}">
                                        @csrf
                                        <h4 class="mb-5 text-uppercase fw-semibold">Personal Info</h4>
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
                                                    <div class="mb-3">
                                                        <label for="avatar" class="form-label">Avatar</label>
                                                        <input class="@error('avatar') is-invalid @enderror" type="file"
                                                            id="avatar" name="avatar">
                                                        @error('avatar')
                                                            <small class="form-text text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-outline-primary square-btn mt-5"></i>
                                                Save</button>
                                        </div>
                                    </form>
                                    <hr class="my-5">
                                    <form class="mb-3"
                                        action="{{ route('home.profile.update-password', Auth::user()->id) }}"
                                        method="POST">
                                        @csrf
                                        <h4 class="mb-5 text-uppercase fw-semibold">Reset
                                            Password</h4>
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
                                                <div class="mb-5">
                                                    <label for="cwebsite" class="form-label">Confirm
                                                        Password</label>
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        id="password_confirmation" placeholder="Enter confirm password..."
                                                        name="password_confirmation">
                                                    @error('password_confirmation')
                                                        <small class="form-text text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-outline-primary square-btn"></i>
                                                Reset</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- end settings content-->

                            </div> <!-- end tab-content -->
                        </div> <!-- end card body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row-->
        </div>
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
