@extends('layouts.admin')

@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<!-- Header -->
<div style="display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:1rem; margin-bottom:1.5rem;">
    <div>
        <h1 style="font-size:1.5rem; font-weight:700; color:#0f2557; font-family:'Outfit',sans-serif; margin:0;">Manage Services</h1>
        <p style="font-size:0.875rem; color:#64748b; margin:0.25rem 0 0;">{{ $services->total() }} services total</p>
    </div>
    <a href="{{ route('admin.services.create') }}" style="display:inline-flex; align-items:center; gap:0.5rem; padding:0.625rem 1.25rem; background:#0f2557; color:white; font-size:0.875rem; font-weight:600; border-radius:0.75rem; text-decoration:none; transition:all 0.2s;">
        <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        Add New Service
    </a>
</div>

<!-- Filters -->
<div class="content-card" style="padding:1rem; margin-bottom:1.5rem;">
    <form method="GET" action="{{ route('admin.services.index') }}" style="display:flex; flex-wrap:wrap; gap:0.75rem;">
        <div style="position:relative; flex:1; min-width:200px;">
            <div style="position:absolute; top:50%; left:0.75rem; transform:translateY(-50%); pointer-events:none;">
                <svg style="width:20px;height:20px;color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search services..."
                   style="width:100%; padding:0.625rem 1rem 0.625rem 2.5rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:0.75rem; font-size:0.875rem; outline:none;">
        </div>
        <select name="category" style="padding:0.625rem 1rem; background:#f8fafc; border:1px solid #e2e8f0; border-radius:0.75rem; font-size:0.875rem; outline:none;">
            <option value="">All Categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
            @endforeach
        </select>
        <button type="submit" style="padding:0.625rem 1.25rem; background:#f1f5f9; color:#475569; font-size:0.875rem; font-weight:500; border-radius:0.75rem; border:1px solid #e2e8f0; cursor:pointer;">
            Filter
        </button>
        @if(request('search') || request('category'))
            <a href="{{ route('admin.services.index') }}" style="padding:0.625rem 1.25rem; color:#64748b; font-size:0.875rem; font-weight:500; border-radius:0.75rem; text-decoration:none;">
                Clear
            </a>
        @endif
    </form>
</div>

<!-- Services List -->
<div class="content-card" style="overflow:hidden;">
    <!-- Desktop Table -->
    <div style="overflow-x:auto; display:none;" class="desktop-table">
        <table style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="background:#f8fafc; border-bottom:1px solid #e2e8f0;">
                    <th style="text-align:left; padding:0.875rem 1.25rem; font-size:0.75rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Service</th>
                    <th style="text-align:left; padding:0.875rem 1.25rem; font-size:0.75rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Category</th>
                    <th style="text-align:left; padding:0.875rem 1.25rem; font-size:0.75rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Duration</th>
                    <th style="text-align:left; padding:0.875rem 1.25rem; font-size:0.75rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Price</th>
                    <th style="text-align:center; padding:0.875rem 1.25rem; font-size:0.75rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Status</th>
                    <th style="text-align:right; padding:0.875rem 1.25rem; font-size:0.75rem; font-weight:600; color:#64748b; text-transform:uppercase; letter-spacing:0.05em;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                    <tr style="border-bottom:1px solid #f1f5f9;" id="service-row-{{ $service->id }}">
                        <td style="padding:1rem 1.25rem;">
                            <div style="display:flex; align-items:center; gap:0.75rem;">
                                <div style="width:36px; height:36px; border-radius:0.5rem; background:#eff6ff; display:flex; align-items:center; justify-content:center; color:#0f2557; flex-shrink:0;">
                                    @include('components.service-icon', ['icon' => $service->icon])
                                </div>
                                <span style="font-weight:600; color:#1e293b; font-size:0.875rem;">{{ $service->name }}</span>
                            </div>
                        </td>
                        <td style="padding:1rem 1.25rem;">
                            <span style="display:inline-flex; padding:0.25rem 0.625rem; font-size:0.75rem; font-weight:500; border-radius:0.5rem; background:#f1f5f9; color:#475569;">
                                {{ ucfirst($service->category) }}
                            </span>
                        </td>
                        <td style="padding:1rem 1.25rem; font-size:0.875rem; color:#475569;">{{ $service->formatted_duration }}</td>
                        <td style="padding:1rem 1.25rem; font-size:0.875rem; font-weight:600; color:#0f2557;">{{ number_format($service->price_rwf) }} RWF</td>
                        <td style="padding:1rem 1.25rem; text-align:center;">
                            <button onclick="toggleActive({{ $service->id }})"
                                    id="status-btn-{{ $service->id }}"
                                    style="display:inline-flex; padding:0.375rem 0.75rem; font-size:0.75rem; font-weight:600; border-radius:9999px; cursor:pointer; border:none; transition:all 0.2s;
                                    {{ $service->is_active ? 'background:#ecfdf5; color:#047857;' : 'background:#fef2f2; color:#dc2626;' }}">
                                {{ $service->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td style="padding:1rem 1.25rem; text-align:right;">
                            <div style="display:flex; align-items:center; gap:0.25rem; justify-content:flex-end;">
                                <a href="{{ route('admin.services.edit', $service) }}" style="padding:0.5rem; border-radius:0.5rem; color:#94a3b8; text-decoration:none; display:inline-flex;" title="Edit">
                                    <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                      onsubmit="return confirm('Delete this service?')" style="display:inline; margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="padding:0.5rem; border-radius:0.5rem; color:#94a3b8; background:none; border:none; cursor:pointer; display:inline-flex;" title="Delete">
                                        <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="padding:4rem; text-align:center;">
                            <p style="color:#64748b; font-weight:500;">No services found</p>
                            <a href="{{ route('admin.services.create') }}" style="color:#0f2557; font-size:0.875rem; font-weight:500;">Add your first service</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card List -->
    <div class="mobile-cards" style="display:block;">
        @forelse($services as $service)
            <div style="padding:1rem 1.25rem; border-bottom:1px solid #f1f5f9;">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; gap:0.75rem;">
                    <div style="display:flex; align-items:center; gap:0.75rem; flex:1; min-width:0;">
                        <div style="width:36px; height:36px; border-radius:0.5rem; background:#eff6ff; display:flex; align-items:center; justify-content:center; color:#0f2557; flex-shrink:0;">
                            @include('components.service-icon', ['icon' => $service->icon])
                        </div>
                        <div style="min-width:0;">
                            <p style="font-weight:600; color:#1e293b; font-size:0.875rem; margin:0; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $service->name }}</p>
                            <p style="font-size:0.75rem; color:#94a3b8; margin:0.125rem 0 0;">{{ ucfirst($service->category) }} · {{ $service->formatted_duration }}</p>
                        </div>
                    </div>
                    <div style="display:flex; align-items:center; gap:0.25rem; flex-shrink:0;">
                        <a href="{{ route('admin.services.edit', $service) }}" style="padding:0.5rem; color:#64748b; text-decoration:none; display:inline-flex;">
                            <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Delete this service?')" style="display:inline;margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="padding:0.5rem; color:#94a3b8; background:none; border:none; cursor:pointer; display:inline-flex;">
                                <svg style="width:16px;height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <div style="display:flex; align-items:center; justify-content:space-between; margin-top:0.5rem; padding-left:3rem;">
                    <span style="font-size:0.875rem; font-weight:600; color:#0f2557;">{{ number_format($service->price_rwf) }} RWF</span>
                    <button onclick="toggleActive({{ $service->id }})"
                            id="status-btn-{{ $service->id }}"
                            style="display:inline-flex; padding:0.25rem 0.625rem; font-size:0.7rem; font-weight:600; border-radius:9999px; cursor:pointer; border:none;
                            {{ $service->is_active ? 'background:#ecfdf5; color:#047857;' : 'background:#fef2f2; color:#dc2626;' }}">
                        {{ $service->is_active ? 'Active' : 'Inactive' }}
                    </button>
                </div>
            </div>
        @empty
            <div style="padding:4rem; text-align:center;">
                <p style="color:#64748b; font-weight:500;">No services found</p>
                <a href="{{ route('admin.services.create') }}" style="color:#0f2557; font-size:0.875rem; font-weight:500;">Add your first service</a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($services->hasPages())
        <div style="padding:1rem 1.25rem; border-top:1px solid #e2e8f0;">
            {{ $services->withQueryString()->links() }}
        </div>
    @endif
</div>

<style>
    /* Show table on desktop, cards on mobile */
    @media (min-width: 768px) {
        .desktop-table { display: block !important; }
        .mobile-cards { display: none !important; }
    }
</style>

@push('scripts')
<script>
    function toggleActive(serviceId) {
        const btn = document.getElementById('status-btn-' + serviceId);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        fetch('/admin/services/' + serviceId + '/toggle-active', {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.success) {
                if (data.is_active) {
                    btn.textContent = 'Active';
                    btn.style.background = '#ecfdf5';
                    btn.style.color = '#047857';
                } else {
                    btn.textContent = 'Inactive';
                    btn.style.background = '#fef2f2';
                    btn.style.color = '#dc2626';
                }
            }
        })
        .catch(function(err) { console.error('Error:', err); });
    }
</script>
@endpush
@endsection
