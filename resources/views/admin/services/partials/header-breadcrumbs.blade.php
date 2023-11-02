<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Services</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('services.index'))
                    <li class="breadcrumb-item" aria-current="page">Service List</li>
                @elseif(Route::is('services.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Service</li>
                @elseif(Route::is('services.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Service</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('services.index'))
                <a href="{{ route('services.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Service</a>
            @elseif(Route::is('services.create'))
                <a href="{{ route('services.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Service List</a>
            @elseif(Route::is('services.edit'))
                <a href="{{ route('services.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Service List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->