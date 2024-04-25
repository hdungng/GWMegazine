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

                @if (!$closedContributionAdd && $startingDateOpen)
                    <a href="{{ route('home.contributions.create') }}" class="btn square-btn btn-outline-primary">Add
                        Contribution</a>
                @endif
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="show-large-panel" role="tabpanel" aria-labelledby="show-large"
                    tabindex="0">
                    @if ($contributions->count() > 0)
                        <div class="contribution-files my-5">
                            <!-- Element -->
                            @foreach ($contributions as $contribution)
                                <div class="card ">
                                    <a href="{{ route('home.contributions.detail', $contribution->id) }}">
                                        <img src="{{ url($contribution->image_url) }}" alt=""
                                            class="card-img-top contribution-file-image">
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
                        </div>
                    @else
                        <p class="text-center mt-5">No data currently available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
