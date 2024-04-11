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
            <div class="heading d-flex justify-content-between align-items-center mb-3">
                <h1 class="fw-bold">My Contributions</h1>

                @if (!$closedContributionAdd)
                    <a href="{{ route('home.contributions.create') }}" class="btn square-btn btn-outline-primary">Add
                        Contribution</a>
                @endif
            </div>

            <div class="contribution-files-tabs my-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="show-large" data-bs-toggle="tab"
                            data-bs-target="#show-large-panel" type="button" role="tab"
                            aria-controls="show-large-panel" aria-selected="true">
                            <i class="fa-solid fa-file fa-xl"></i>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="show-small" data-bs-toggle="tab" data-bs-target="#show-small-panel"
                            type="button" role="tab" aria-controls="show-small-panel" aria-selected="false">
                            <i class="fa-solid fa-list fa-xl"></i>
                        </button>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="show-large-panel" role="tabpanel" aria-labelledby="show-large"
                    tabindex="0">
                    <div class="contribution-files my-5">
                        <!-- Element -->

                        @if ($contributions->count() > 0)
                            @foreach ($contributions as $contribution)
                                <div class="card ">
                                    <a href="{{ route('home.contributions.detail', $contribution->id) }}">
                                        <img src="{{ url('public/home/images/folder.svg') }}" alt=""
                                            class="card-img-top">
                                        <div class="media__cap">
                                            <div>
                                                <div>
                                                    <span class="text-truncate">{{ $contribution->title }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No data currently available.</p>
                        @endif
                    </div>
                </div>
                <div class="tab-pane fade" id="show-small-panel" role="tabpanel" aria-labelledby="show-small"
                    tabindex="0">
                    <div class="contribution-file-sm-header hstack gap-5">
                        <span>File Image</span>
                        <span>Name</span>
                        <span class="ms-auto">Operation</span>
                    </div>
                    <div class="contribution-files-list">


                        @if ($contributions->count() > 0)
                            @foreach ($contributions as $contribution)
                                <div class="list-group-item">
                                    <div class="contribution-file-sm hstack gap-5">
                                        <a href="{{ route('home.contributions.detail', $contribution->id) }}">
                                            <img src="{{ url('public/home/images/folder.svg') }}" class="card-img-top"
                                                alt="">
                                        </a>
                                        <span class="filename"><a
                                                href="{{ route('home.contributions.detail', $contribution->id) }}">{{ $contribution->title }}</a></span>
                                        <div class="ms-auto">
                                            <i class="fa-solid fa-ellipsis-vertical fa-lg operation-btn"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            </i>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item"
                                                        href="{{ route('home.contributions.edit', $contribution->id) }}">Update</a>
                                                </li>
                                                {{-- <li><a class="dropdown-item" href="#">Delete</a></li> --}}
                                            </ul>
                                            </a>
                                        </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No data currently available.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
