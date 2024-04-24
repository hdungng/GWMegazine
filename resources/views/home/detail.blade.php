@extends('layouts.home')

@section('body.content')
    <div class="col-md-9 col-lg-7">
        <!-- Page Content  -->

        <div id="content" class="ms-xl-0 ms-lg-5 p-4 p-md-5 pt-5">
            <h1 class="fw-bold mt-3">{{ $contribution->title }}</h1>
            <div class="author-contribution-info my-4">
                <p>Written by <span>{{ $contribution->student_name }}</span> | Last updated:
                    <span>{{ (new DateTime($contribution->updated_at))->format('F d, Y H:i:s') }}</span>
                </p>
            </div>

            <div class="detail-desc my-5 preview-contribution">
                <div class="description my-5 text-truncate">{{ $contribution->description }}</div>

                @if (isset($htmlContent))
                    {!! $htmlContent !!}
                @endif
            </div>
            <div class="contribution-stats">
                <div class="hstack gap-5 justify-content-end">
                    @if (Auth::check())
                        <div class="like-box hstack gap-3">
                            <span><i class="fa-solid fa-heart fa-xl" id="like-btn"
                                    data-id="{{ $contribution->id }}"></i></span>
                            <span id="like-count"></span>
                        </div>
                    @else
                        <div class="like-box hstack gap-3">
                            <span><i class="fa-solid fa-heart fa-xl active" id="show-like"
                                    data-id="{{ $contribution->id }}"></i></span>
                            <span id="like-count"></span>
                        </div>
                    @endif
                    <span class="share-btn"><i class="fa-solid fa-share-nodes fa-xl"></i></span>
                </div>
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

@section('body.javascript')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.x.x/dist/jquery.min.js"></script>

    <script>
        async function getTotalLikes() {
            var likeBtn = document.getElementById('like-btn');
            var likeCount = document.getElementById('like-count');

            fetch('{{ route('home.getTotalLike', $contribution->id) }}', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': '*/*'
                    }

                }).then(data => data.json())
                .then(result => {
                    likeCount.innerHTML = result.likeCount;

                    if (!result.notLiked) {
                        likeBtn.classList.add("active");
                    }
                })
        }
        getTotalLikes();
    </script>
    <script>
        $(document).ready(function() {
            $('#like-btn').click(function(event) {
                event.preventDefault();

                var contributionId = $(this).data('id');

                $.ajax({
                    url: "{{ route('home.like') }}",
                    type: "POST",
                    data: {
                        id: contributionId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#like-count').text(response.likeCount);
                            if (!response.notLiked) {
                                $('#like-btn').addClass("active");
                            } else {
                                $('#like-btn').removeClass("active");
                            }
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
