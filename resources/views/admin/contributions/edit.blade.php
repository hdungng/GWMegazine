@extends('layouts.admin')

@section('head.css')
    <!-- Include FilePond styles and scripts -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet">
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contribution</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contribution Overview</a></li>
                                <li class="breadcrumb-item active">Edit Contribution</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Edit Contribution</h4>
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
                                <form action="" method="post" id="add-contribution">
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="studentName" class="form-label">Student Name <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="studentName" name="studentName" type="text"
                                                placeholder="John Doe" disabled>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="studentID" class="form-label">Student ID <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="studentID" name="studentID" type="text"
                                                placeholder="GCS2108xx" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="studentEmail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="studentEmail" name="studentEmail" type="email"
                                                placeholder="johndoe@gmail.com" disabled>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="studentFaculty" class="form-label">Faculty <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="studentFaculty" name="studentFaculty"
                                                type="text" placeholder="Information Techonology" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="status" class="form-label">Contribution Status
                                                <span class="text-danger">*</span></label>
                                            <select class="form-select" name="status">
                                                <option value="0">Pending</option>
                                                <option value="1">Fixed</option>
                                                <option value="2">Done</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <label for="academicYear" class="form-label">Academic Year <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="academicYear" name="academicYear" type="text"
                                                placeholder="Summer" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="contributionName" class="form-label">Contribution Name
                                                <span class="text-danger">*</span></label>
                                            <input class="form-control" id="contributionName" name="contributionName"
                                                type="text" placeholder="Enter contribution name...">
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="wordDocument" class="form-label">Word Document <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" type="file" id="wordDocument">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="contributionImages" class="form-label">Contribution
                                                Images <span class="text-danger">*</span></label>
                                            <input class="filepond" type="file" id="contributionImages" multiple>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="description" class="mb-2">Contribution Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control main_content" rows="5"></textarea>
                                            <div class="hstack mt-5">
                                                <button class="btn btn-outline-primary ms-auto"
                                                    type="submit">Submit</button>
                                            </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            FilePond.registerPlugin(
                FilePondPluginImagePreview,
            );

            // Select the file input and use create() to turn it into a pond
            FilePond.create(
                document.getElementById('contributionImages')
            );

            // Set up image preview container
            const imagePreviewContainer = document.getElementById('image-preview-container');

        });
    </script>
@endsection
