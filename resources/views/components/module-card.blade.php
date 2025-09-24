@props(['module', 'isAssigned' => false, 'showAssignButton' => false])

<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
    <div class="card custom-card">
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-md bg-primary-transparent rounded-circle me-3">
                        <i class="{{ $module->icon ?? 'ti ti-package' }} fs-18"></i>
                    </div>
                    <div>
                        <h6 class="mb-0 fw-semibold">{{ $module->name }}</h6>
                        <span class="text-muted fs-12">{{ $module->category ?? 'General' }}</span>
                    </div>
                </div>
                @if($isAssigned)
                    <span class="badge bg-success-transparent">
                        <i class="ti ti-check me-1"></i>Assigned
                    </span>
                @endif
            </div>
            
            <p class="text-muted mb-3 fs-13">{{ Str::limit($module->description, 80) }}</p>
            
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <span class="text-muted fs-12">
                        <i class="ti ti-users me-1"></i>
                        {{ $module->user_count ?? 0 }} Users
                    </span>
                </div>
                
                @if($showAssignButton && !$isAssigned)
                    <button class="btn btn-sm btn-primary" onclick="assignModule({{ $module->id }})">
                        <i class="ti ti-plus me-1"></i>Assign
                    </button>
                @elseif($isAssigned)
                    <button class="btn btn-sm btn-outline-danger" onclick="unassignModule({{ $module->id }})">
                        <i class="ti ti-x me-1"></i>Remove
                    </button>
                @else
                    <a href="{{ route('user.module', $module->id) }}" class="btn btn-sm btn-primary">
                        <i class="ti ti-arrow-right me-1"></i>Access
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
