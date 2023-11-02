<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Pincodes</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('pincodes.index'))
                    <li class="breadcrumb-item" aria-current="page">Pincode List</li>
                @elseif(Route::is('pincodes.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Pincode</li>
                @elseif(Route::is('pincodes.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Pincode</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('pincodes.index'))
                <a href="{{ route('pincodes.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Pincode</a>
            @elseif(Route::is('pincodes.create'))
                <a href="{{ route('pincodes.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Pincode List</a>
            @elseif(Route::is('pincodes.edit'))
                <a href="{{ route('pincodes.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Pincode List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->