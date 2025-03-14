<div class="col">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2>{{ $serviceType->name }}</h2>
            <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                    <a href="{{ route('service-types.show', $serviceType->id) }}" class="btn btn-sm btn-outline-secondary">View</a>
                    <a href="{{ route('service-types.edit', $serviceType->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
