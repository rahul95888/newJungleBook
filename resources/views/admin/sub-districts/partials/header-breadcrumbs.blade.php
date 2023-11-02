<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Sub Districts</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('sub-districts.index'))
                    <li class="breadcrumb-item" aria-current="page">Sub District List</li>
                @elseif(Route::is('sub-districts.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Sub District</li>
                @elseif(Route::is('sub-districts.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Sub District</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('sub-districts.index'))
                <a href="{{ route('sub-districts.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Sub District</a>
            @elseif(Route::is('sub-districts.create'))
                <a href="{{ route('sub-districts.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Sub District List</a>
            @elseif(Route::is('sub-districts.edit'))
                <a href="{{ route('sub-districts.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Sub District List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->