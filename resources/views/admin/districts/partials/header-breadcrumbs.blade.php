<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Districts</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('districts.index'))
                    <li class="breadcrumb-item" aria-current="page">District List</li>
                @elseif(Route::is('districts.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New District</li>
                @elseif(Route::is('districts.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit District</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('districts.index'))
                <a href="{{ route('districts.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add District</a>
            @elseif(Route::is('districts.create'))
                <a href="{{ route('districts.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>District List</a>
            @elseif(Route::is('districts.edit'))
                <a href="{{ route('districts.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>District List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->