@extends('layouts.home')

@section('body.content')
    <div class="col-md-9 col-lg-10">
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="alert alert-warning mb-5" role="alert">
                The deadline for submitting contribution is only {{ $dayLeft }} days {{ $hoursLeft }} hours away!
                Please complete your contribution as soon as
                possible.
            </div>

            <!-- Content -->
            <span id="turn-back" class="turn-back"><i class="fa-solid fa-arrow-left fa-2xl"></i></span>
            <h1 class="fw-bold mt-3">{{ $contribution->title }}</h1>

            <div class="contribution-info my-5">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th>Contribution ID</th>
                            <td>{{ $contribution->id }}</td>
                        </tr>
                        <tr>
                            <th>Contribution Title</th>
                            <td>{{ $contribution->title }}</td>
                        </tr>
                        <tr>
                            <th>Student Name</th>
                            <td>{{ $contribution->student_name }}</td>
                        </tr>
                        <tr>
                            <th>Submission status</th>
                            <td>
                                @switch($contribution->status)
                                    @case(0)
                                        <span class="badge text-bg-warning">Pending</span>
                                    @break

                                    @case(1)
                                        <span class="badge text-bg-success">Published</span>
                                    @break

                                    @case(2)
                                        <span class="badge text-bg-danger">Published For Guest</span>
                                    @break

                                    @case(3)
                                        <span class="badge text-bg-primary">Published All</span>
                                    @break

                                    @default
                                        <span class="badge text-bg-warning">Pending</span>
                                @endswitch
                            </td>
                        </tr>
                        <tr>
                            <th>Academic year</th>
                            <td>{{ $contribution->academic_year_name }}</td>
                        </tr>
                        <tr>
                            <th>Submited Date</th>
                            <td>{{ (new DateTime($contribution->created_at))->format('F d, Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Closure date</th>
                            <td>{{ (new DateTime($contribution->closure_date))->format('F d, Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Final closure date</th>
                            <td>{{ (new DateTime($contribution->final_closure_date))->format('F d, Y H:i:s') }}</td>
                        </tr>
                        <tr>
                            <th>Last modified</th>
                            <td>{{ (new DateTime($contribution->updated_at))->format('F d, Y H:i:s') }}</td>
                        </tr>
                        @if (!$closedContribution && $contribution->status == 0)
                            <tr>
                                <th>Edit</th>
                                <td>
                                    <a href="{{ route('home.contributions.edit', $contribution->id) }}"
                                        class="btn btn-outline-primary square-btn">Edit
                                        Contribution</a>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="card">
                <div class="card-body feedback">
                    <!-- end dropdown-->

                    <h4 class="mb-4 mt-0 fs-16 fw-bold">Comments</h4>

                    <div class="clearfix"></div>

                    @if ($comments->count() > 0)
                        @foreach ($comments as $comment)
                            <div class="d-flex align-items-start mt-5">
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

                    @if (!$disabledComment)
                        <div class="border rounded mt-4">
                            <form action="{{ route('home.contributions.comment', $contribution->id) }}" method="POST"
                                class="comment-area-box">
                                @csrf
                                <textarea rows="3" class="form-control @error('content') is-invalid @enderror border-0 resize-none"
                                    placeholder="Your comment..." name="content"></textarea>
                                @error('content')
                                    <small class="form-text text-danger">{{ $message }}</small>
                                @enderror

                                <div class="p-2 d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-sm btn-success"><i
                                            class="ri-send-plane-2 me-1"></i>Submit</button>
                                </div>
                            </form>
                        </div>
                    @endif
                    <!-- end .border-->
                </div>
                <!-- end card-body-->
            </div>
        </div>
    </div>
@endsection
