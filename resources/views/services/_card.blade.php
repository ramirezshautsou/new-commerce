<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2>{{ $service->name }}</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('services.show', $service->id) }}"
                       class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="{{ route('services.edit', $service->id) }}"
                       class="btn btn-sm btn-outline-secondary">Edit</a>
                </div>
                <small class="text-body-secondary">{{ $service->price }} BYN</small>
            </div>
        </div>
    </div>
</div>
