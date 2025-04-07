<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2>{{ $producer->name }}</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('producers.show', $producer->id) }}"
                       class="btn btn-sm btn-outline-secondary" style="text-decoration: none; color: #007bff;">View</a>
                    <a href="{{ route('producers.edit', $producer->id) }}"
                       class="btn btn-sm btn-outline-secondary" style="text-decoration: none; color: #007bff;">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
