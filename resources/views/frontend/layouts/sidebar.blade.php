<div class="search-box mb-3">
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


<div class="category-lists">
    <h6 class="text-uppercase text-muted fw-bolder">
        <i class="bi bi-card-list me-1"></i> Category Lists
    </h6>
    <div class="list-group">
        <a href="{{ route('welcome') }}" class="list-group-item list-group-item-action {{ request()->is('/') ? 'active' : '' }}" aria-current="true">
            All
        </a>
        @foreach (\App\Models\Category::all() as $category)
            <a href="{{ route('welcome.category',$category->slug) }}" class="list-group-item list-group-item-action {{ request()->is('categories/'.$category->slug) ? 'active' : '' }}">
                {{-- <i class="bi bi-card-text ms-2" style="font-size: 12px"></i> --}}
                {{ $category->title }}
            </a>
        @endforeach

    </div>
</div>
