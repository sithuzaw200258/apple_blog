<div class="list-group mb-3">
    <a href="{{ route('home') }}" class="list-group-item list-group-item-action text-muted {{ request()->is('home') ? 'active' : '' }}">
        <i class="bi bi-house-door"></i> Home
    </a>
    <a href="#" class="list-group-item list-group-item-action text-muted">A second link item</a>
</div>

<p class="text-muted mb-0">Manage Categories</p>
<div class="list-group mb-3">
    <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action text-muted {{ request()->is('categories') ? 'active' : '' }}">
        <i class="bi bi-list-task"></i> Category Lists
    </a>
    <a href="{{ route('categories.create') }}" class="list-group-item list-group-item-action text-muted {{ request()->is('categories/create') ? 'active' : '' }}"><i class="bi bi-plus-square"></i> Create Category</a>
</div>

<p class="text-muted mb-0">Manage Posts</p>
<div class="list-group mb-3">
    <a href="{{ route('posts.index') }}" class="list-group-item list-group-item-action text-muted {{ request()->is('posts') ? 'active' : '' }}">
        <i class="bi bi-list-task"></i> Post Lists
    </a>
    <a href="{{ route('posts.create') }}" class="list-group-item list-group-item-action text-muted {{ request()->is('posts/create') ? 'active' : '' }}"> <i class="bi bi-plus-square"></i> Create Post</a>
</div>
    
@if (Auth::user()->isAdmin())
    <p class="text-muted mb-0">Manage Users</p>
    <div class="list-group mb-3">
        <a href="{{ route('users.index') }}" class="list-group-item list-group-item-action text-muted {{ request()->is('users') ? 'active' : '' }}">
            <i class="bi bi-list-task"></i> User Lists
        </a>
        <a href="{{ route('users.create') }}" class="list-group-item list-group-item-action text-muted {{ request()->is('users/create') ? 'active' : '' }}"> <i class="bi bi-plus-square"></i> Create User</a>
    </div>
@endif