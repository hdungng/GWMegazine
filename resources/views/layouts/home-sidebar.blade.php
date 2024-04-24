<div class="p-2">
    <div class="menu my-5">
        <div
            class="{{ request()->routeIs('home.main-page', 'home.detail', 'home.search', 'home.filter') ? 'active' : '' }} item">
            <a href="{{ route('home.main-page') }}">
                <div class="icon">
                    <i class="fa-solid fa-home fa-xl"></i>
                </div>
                Home
            </a>
        </div>
        @if (Auth::check() && Auth::user()->role->name == 'Student' && $startingDateOpen)
            <div
                class="{{ request()->routeIs('home.contributions.index', 'home.contributions.create', 'home.contributions.detail', 'home.contributions.edit') ? 'active' : '' }} item">
                <a href="{{ route('home.contributions.index') }}">
                    <div class="icon">
                        <i class="fa-solid fa-folder-open fa-xl"></i>
                    </div>
                    My Contributions
                </a>
            </div>
        @endif
        <div class="{{ request()->routeIs('home.content-policy') ? 'active' : '' }} item">
            <a href="{{ route('home.content-policy') }}">
                <div class="icon">
                    <i class="fa-solid fa-file-circle-exclamation fa-xl"></i>
                </div>
                Content Policy
            </a>
        </div>
        <div class="{{ request()->routeIs('home.user-agreement') ? 'active' : '' }} item">
            <a href="{{ route('home.user-agreement') }}">
                <div class="icon">
                    <i class="fa-solid fa-user-lock fa-xl"></i>
                </div>
                User Agreement
            </a>
        </div>
        <div class="{{ request()->routeIs('home.help') ? 'active' : '' }} item">
            <a href="{{ route('home.help') }}">
                <div class="icon">
                    <i class="fa-solid fa-circle-question fa-xl"></i>
                </div>
                Help
            </a>
        </div>
    </div>
    <div class="mb-5 copyright">
        <p class="text-primary px-md copyright-desc">GWMegazine, Inc. © 2024. All rights reserved.</p>
    </div>
</div>
