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
                                <form action="{{ route('admin.contributions.update', $contribution->id) }}" method="POST"
                                    id="add-contribution" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="studentName" class="form-label">Student Name <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="studentName" name="studentName" type="text"
                                                placeholder="{{ $contribution->student_name }}" disabled>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label for="studentEmail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="studentEmail" name="studentEmail" type="email"
                                                placeholder="{{ $contribution->email }}" disabled>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="studentFaculty" class="form-label">Faculty <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="studentFaculty" name="studentFaculty"
                                                type="text" placeholder="{{ $contribution->faculty_name }}" disabled>
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <label for="academicYear" class="form-label">Academic Year <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control" id="academicYear" name="academicYear" type="text"
                                                placeholder="{{ $contribution->academic_year_name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label for="title" class="form-label">Title <span
                                                    class="text-danger">*</span></label>
                                            <input class="form-control @error('title') is-invalid @enderror" id="title"
                                                name="title" type="text" placeholder="Enter contribution title..."
                                                value="{{ $contribution->title }}">
                                            @error('title')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-sm-6 mb-3">
                                            <label for="wordDocument" class="form-label">Word Document: <span
                                                    class="fst-italic text-primary">{{ basename($contribution->word_url) }}</span></label>
                                            <input class="form-control @error('wordDocument') is-invalid @enderror"
                                                type="file" id="wordDocument" name="wordDocument">
                                            @error('wordDocument')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="contributionImage" class="form-label">Contribution Image</label>
                                            <img src="{{ url($contribution->image_url) }}"
                                                class="contribution-update-preview" alt="">

                                            <input class="filepond @error('contributionImage') is-invalid @enderror"
                                                type="file" id="contributionImage" name="contributionImage">
                                            @error('contributionImage')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="description" class="mb-2">Description <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="description" class="form-control  @error('description') is-invalid @enderror main_content"
                                                rows="5">{{ $contribution->description }}</textarea>
                                            @error('description')
                                                <small class="form-text text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="hstack mt-5">
                                        <button class="btn btn-outline-primary ms-auto" type="submit">Save</button>
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
                var contributionImageField = document.getElementById('contributionImage');
                // Select the file input and use create() to turn it into a pond
                FilePond.create(
                    contributionImageField, {
                        storeAsFile: true,
                    },
                );
            });
        });
    </script>
@endsection
