<div class="list-group mb-3">
    <x-list-group-item item="Home" :url="route('home')"> 
        <i class="bi bi-house-door"></i> 
    </x-list-group-item>

    <x-list-group-item item="Go To Welcome Page" :url="route('welcome')"> 
        <i class="bi bi-arrow-left-circle"></i>
    </x-list-group-item>

    <x-list-group-item item="Gallary" :url="route('photos.index')"> 
        <i class="bi bi-image"></i>
    </x-list-group-item>
</div>

<p class="text-muted text-uppercase fs-6 mb-0"><i class="bi bi-stack me-1"></i>Manage Categories</p>
<div class="list-group mb-3">
    <x-list-group-item item="Category Lists" :url="route('categories.index')"> 
        <i class="bi bi-list-task"></i> 
    </x-list-group-item>

    <x-list-group-item item="Create Category" :url="route('categories.create')"> 
        <i class="bi bi-plus-square"></i>
    </x-list-group-item>
    
</div>

<p class="text-muted text-uppercase fs-6 mb-0"><i class="bi bi-postcard-fill me-1"></i>Manage Posts</p>
<div class="list-group mb-3">
    <x-list-group-item item="Post Lists" :url="route('posts.index')"> 
        <i class="bi bi-list-task"></i>
    </x-list-group-item>

    <x-list-group-item item="Create Post" :url="route('posts.create')"> 
        <i class="bi bi-plus-square"></i>
    </x-list-group-item>
</div>
    
@admin
    <p class="text-muted text-uppercase fs-6 mb-0"><i class="bi bi-person-vcard me-1"></i>Manage Users</p>
    <div class="list-group mb-3">
        <x-list-group-item item="User Lists" :url="route('users.index')"> 
            <i class="bi bi-list-task"></i>
        </x-list-group-item>
        
        <x-list-group-item item="Create User" :url="route('users.create')"> 
            <i class="bi bi-plus-square"></i>
        </x-list-group-item>
    </div>
@endadmin


<div class="d-grid gap-2">
    <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right me-1"></i>{{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>