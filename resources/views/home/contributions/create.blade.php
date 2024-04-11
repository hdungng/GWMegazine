@extends('layouts.home')

@section('head.css')
    <!-- Include FilePond styles and scripts -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
@endsection

@section('body.content')
    <div class="col-md-9 col-lg-10">
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="alert alert-warning mb-5" role="alert">
                The deadline for submitting contribution is only {{ $dayLeft }} days {{ $hoursLeft }} hours away!
                Please complete your contribution as soon as
                possible.
            </div>

            <h1 class="fw-bold mt-3">Add Contribution</h1>

            <div class="card mt-5">
                <div class="card-body p-5">
                    <h3 class="card-title mb-5">Your Information</h3>
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            <label for="studentName" class="form-label">Student Name <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" id="studentName" name="studentName" type="text"
                                placeholder="{{ Auth::user()->fullname }}" disabled>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <label for="academicYear" class="form-label">Academic Year <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" id="academicYear" name="academicYear" type="text"
                                placeholder="{{ $currentAcademicYear }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-5">
                            <label for="studentEmail" class="form-label">Email <span class="text-danger">*</span></label>
                            <input class="form-control" id="studentEmail" name="studentEmail" type="email"
                                placeholder="{{ Auth::user()->email }}" disabled>
                        </div>
                        <div class="col-sm-6 mb-5">
                            <label for="studentFaculty" class="form-label">Faculty <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" id="studentFaculty" name="studentFaculty" type="text"
                                placeholder="{{ Auth::user()->faculty->name }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('home.contributions.store') }}" method="POST" class="mt-5" id="add-contribution"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-6 mb-5">
                        <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                        <input class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                            type="text" placeholder="Enter contribution title...">
                        @error('title')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-sm-6 mb-5">
                        <label for="wordDocument" class="form-label">Word Document <span
                                class="text-danger">*</span></label>
                        <input class="form-control @error('wordDocument') is-invalid @enderror" type="file"
                            id="wordDocument" name="wordDocument">
                        @error('wordDocument')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-6 mb-5">
                        <label for="contributionImage" class="form-label">Contribution Image <span
                                class="text-danger">*</span></label>
                        <input class="filepond @error('contributionImage') is-invalid @enderror" type="file"
                            id="contributionImage" name="contributionImage">
                        @error('contributionImage')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-5">
                        <label for="description" class="mb-2">Description <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control  @error('description') is-invalid @enderror main_content"
                            rows="5"></textarea>
                        @error('description')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="hstack mt-5">
                        <button class="btn btn-outline-primary square-btn ms-auto" type="button" data-bs-toggle="modal"
                            data-bs-target="#term&condition">Submit</button>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="term&condition" tabindex="-1" aria-labelledby="term&condition"
                    aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="term&condition">Term and Condition</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Welcome to Reddit! By accessing or using our website, products, or services, you
                                    agree to comply with and be bound by the following terms and conditions. If you do not
                                    agree to
                                    these terms, please do not use our services.</p>

                                <p><strong>1. Use of Our Services</strong></p>
                                <p>You must be at least 18 years old to use our services.</p>
                                <p>You are responsible for maintaining the confidentiality of your account and password.</p>

                                <p><strong>2. Intellectual Property</strong></p>
                                <p>All content and materials on our website are the property of Reddit and are
                                    protected by copyright, trademark, and other intellectual property laws.</p>

                                <p><strong>3. Privacy Policy</strong></p>
                                <p>Your use of our services is also governed by our Privacy Policy, which can be found
                                    here</a>.</p>

                                <p><strong>4. User Conduct</strong></p>
                                <p>You agree not to engage in any conduct that may disrupt or interfere with our services or
                                    violate any applicable laws.</p>

                                <p><strong>5. Limitation of Liability</strong></p>
                                <p>Reddit is not liable for any indirect, incidental, special, or consequential
                                    damages arising out of or in connection with our services.</p>

                                <p><strong>6. Governing Law</strong></p>
                                <p>These terms and conditions are governed by and construed in accordance with the laws of
                                    the
                                    world.</p>

                                <p><strong>7. Changes to Terms</strong></p>
                                <p>Reddit reserves the right to update or modify these terms and conditions at any
                                    time without prior notice.</p>

                                <p>By using our services, you acknowledge that you have read, understood, and agree to these
                                    terms
                                    and conditions. If you have any questions or concerns, please contact us www.reddit.com.
                                </p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn square-btn btn-outline-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn square-btn btn-outline-primary" id="button-submit">I
                                    agree
                                    and submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

            $(document).ready(function() {
                var contributionImageField = document.getElementById('contributionImage');
                // Select the file input and use create() to turn it into a pond
                FilePond.create(
                    contributionImageField, {
                        storeAsFile: true,
                    }
                );
            });
        });
    </script>
@endsection
