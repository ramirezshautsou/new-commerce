<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2>{{ $user->name }}</h2>
            <p class="card-text">{{ $user->email }}</p>
            <p class="card-text">{{ $user->password }}</p>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('admin.users.show', $user->id) }}"
                       class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="btn btn-sm btn-outline-secondary">Edit</a>
                </div>
                <small class="text-body-secondary">{{ $user->role_id }} BYN</small>
            </div>
        </div>
    </div>
</div>
