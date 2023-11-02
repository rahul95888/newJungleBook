<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Cities</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('cities.index'))
                    <li class="breadcrumb-item" aria-current="page">City List</li>
                @elseif(Route::is('cities.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New City</li>
                @elseif(Route::is('cities.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit City</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('cities.index'))
                <a href="{{ route('cities.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add City</a>
            @elseif(Route::is('cities.create'))
                <a href="{{ route('cities.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>City List</a>
            @elseif(Route::is('cities.edit'))
                <a href="{{ route('cities.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>City List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->