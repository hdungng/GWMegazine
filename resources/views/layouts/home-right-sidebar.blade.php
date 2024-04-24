<div class="menu-right my-5">
    <form action="{{ route('home.search') }}" method="POST">
        @csrf
        <div id="search-box">
            <div>
                <h5 class="fw-semibold">What are you looking for? 🧐</h5>
                <div class="search-input">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
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
