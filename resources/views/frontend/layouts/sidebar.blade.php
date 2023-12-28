@auth
    <div class="d-grid gap-2 mb-4">
        <a href="{{ route('home') }}" class="btn btn-success">
            <i class="bi bi-bar-chart me-1"></i>
            Dashborad
        </a>
    </div>
@endauth

<div class="search-box mb-4">
    <h6 class="text-uppercase text-muted fw-bolder">
        <i class="bi bi-search me-1"></i> Search Posts
    </h6>

    <form method="GET">
        <div class="input-group mb-1">
            <input type="text" class="form-control" name="keyword" placeholder="search by title or desc...">
            <button class="btn btn-primary input-group-text">Search</button>
        </div>
    </form>

    @if (request("keyword"))
        <div class="search-keyword ms-1">
            <p class="mb-0" style="font-size: 12px">
                search by : <span class="fw-bold">"{{ request("keyword") }}"</span>
                <a href="{{ route('welcome') }}">
                    <i class="bi bi-x" style="color: #df0000;font-size :16px;"></i>
                </a>
            </p>
        </div>
    @endif
</div>

<div class="category-lists mb-4">
    <h6 class="text-uppercase text-muted fw-bolder">
        <i class="bi bi-stack me-1"></i> Category Lists
    </h6>
    <div class="list-group">
        <a href="{{ route('welcome') }}" class="list-group-item list-group-item-action {{ request()->url() === route('welcome') ? 'active' : '' }}" aria-current="true">
            All
        </a>
        @foreach ($categories as $category)
            <x-list-group-item item="{{ $category->title }}" :url="route('welcome.category',$category->slug)" />
        @endforeach

    </div>
</div>
