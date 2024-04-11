@extends('layouts.admin')

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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contributions</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Contribution Overview</a></li>
                                <li class="breadcrumb-item active">Contribution Preview</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Contribution Preview</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- project card -->
                    <div class="card d-block">
                        <div class="card-body">
                            <div id="content" class="p-2">
                                <h1 class="fw-bold mt-3">{{ $contribution->title }}</h1>
                                <div class="author-contribution-info my-4">
                                    <p>Written by <span class="text-primary"> {{ $contribution->student_name }} </span> |
                                        Last updated:
                                        <span
                                            class="text-primary">{{ (new DateTime($contribution->updated_at))->format('F d, Y H:i:s') }}</span>
                                    </p>
                                </div>
                                <div class="background">
                                    <div id="gallery"></div>
                                </div>
                                <div class="detail-desc mt-5 preview-contribution">
                                    <div class="description my-3">{{ $contribution->description }}
                                    </div>
                                    @if (isset($htmlContent))
                                        {!! $htmlContent !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card-->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-4 mt-0 fs-16">Comments</h4>

                            <div class="clerfix"></div>

                            @if ($comments->count() > 0)
                                @foreach ($comments as $comment)
                                    <div class="d-flex align-items-start mt-3">
                                        <img class="me-2 rounded-circle" src="{{ url($comment->avatar) }}"
                                            alt="Generic placeholder image" height="32" />
                                        <div class="w-100 ms-3">
                                            <h5 class="mt-0 fw-semibold">{{ $comment->username }} <small
                                                    class="text-muted float-end">{{ (new DateTime($comment->created_at))->format('F d, Y') }}</small>
                                            </h5>
                                            <div class="desc">{{ $comment->content }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center">No comments currently available.</p>
                            @endif


                            <div class="border rounded mt-4">
                                <form action="{{ route('admin.contributions.comment', $contribution->id) }}" method="POST"
                                    class="comment-area-box">
                                    @csrf
                                    <textarea rows="3" class="form-control @error('content') is-invalid @enderror border-0 resize-none" placeholder="Your comment..." name="content"></textarea>
                                    @error('content')
                                        <small class="form-text text-danger">{{ $message }}</small>
                                    @enderror

                                    <div class="p-2 bg-light d-flex justify-content-between align-items-center">
                                        <button type="submit" class="btn btn-sm btn-success"><i
                                                class="ri-send-plane-2 me-1"></i>Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end .border-->
                        </div>
                        <!-- end card-body-->
                    </div>
                    <!-- end card-->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
@endsection
