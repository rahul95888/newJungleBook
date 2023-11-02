<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">States</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('states.index'))
                    <li class="breadcrumb-item" aria-current="page">State List</li>
                @elseif(Route::is('states.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New State</li>
                @elseif(Route::is('states.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit State</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('states.index'))
                <a href="{{ route('states.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add State</a>
            @elseif(Route::is('states.create'))
                <a href="{{ route('states.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>State List</a>
            @elseif(Route::is('states.edit'))
                <a href="{{ route('states.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>State List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->