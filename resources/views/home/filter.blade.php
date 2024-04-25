@extends('layouts.home')

@section('body.content')
    <div class="col-md-9 col-lg-7">
        <!-- Page Content  -->

        <div id="content" class="ms-xl-0 ms-lg-5 p-4 p-md-5 pt-5">
            <div class="ms-4 d-flex justify-content-between flex-column flex-sm-row">
                <h2 class="fw-semibold fs-5">FILTER FACULTY <span class="ms-3 keyword">"{{ $filterFaculty->name }}"</span>
                </h2>

                <h2 class="fw-semibold fs-5 mt-3 mt-sm-0">FOUND <span
                        class="mx-3 keyword">{{ $contributions->count() }}</span> Contributions</h2>
            </div>

            <div class="list-contributions mt-5">
                @if ($contributions->count() > 0)
                    @foreach ($contributions as $contribution)
                        <div class="contribution-item mb-3">
                            <a href="{{ route('home.detail', $contribution->id) }}">
                                <div class="card mb-3 p-3">
                                    <div class="row g-1">
                                        <div class="col-4">
                                            <div class="card-body">
                                                <img src="{{ url($contribution->image_url) }}"
                                                    class="img-fluid rounded-start card-img" alt="...">
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="card-body">
                                                <h3 class="card-title fw-semibold">{{ $contribution->title }}</h3>
                                                <p class="card-desc">{{ $contribution->description }}</p>
                                                <p class="card-author"><span>{{ $contribution->student_name }}</span> -
                                                    <span>{{ (new DateTime($contribution->created_at))->format('F d, Y') }}</span>
                                                </p>
                                                <div class="hstack gap-5">
                                                    <div class="like-box hstack gap-3 ms-auto">
                                                        <span><i class="fa-solid fa-heart fa-xl"
                                                                style="color: #FC6589;"></i></span>
                                                        <span class="stats-num">{{ count($contribution->likes) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <!-- Horizontal line -->
                            <hr>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">No data currently available.</p>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="position-fixed">
            <div class="right-sidebar pe-3">
                <div class="menu my-5">
                    <form action="{{ route('home.search') }}" method="POST">
                        @csrf
                        <div id="search-box">
                            <div>
                                <h5 class="fw-semibold">What are you looking for? 🧐</h5>
                                <div class="search-input">
                                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    <input type="text" class="search-field" placeholder="Search..." name="searchQuery">

                                </div>
                            </div>
                        </div>
                    </form>

                    @if (Auth::user()->role->name != 'Guest')
                        <div class="recommended-topics-box mt-5">
                            <h5 class="fw-semibold">Faculties Available</h5>

                            @if ($faculties->count() > 0)
                                <div class="topics-container">
                                    @foreach ($faculties as $faculty)
                                        <a href="{{ route('home.filter', $faculty->id) }}" class="topic-item"
                                            style="background: {{ $faculty->chart_color }}">{{ $faculty->name }}</a>
                                    @endforeach
                                </div>
                            @else
                                <p class="mt-5">No faculties currently available.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
