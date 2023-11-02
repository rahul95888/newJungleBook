<!--breadcrumb-->
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Villages</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="bx bx-home-alt"></i></a>
                </li>
                @if (Route::is('villages.index'))
                    <li class="breadcrumb-item" aria-current="page">Village List</li>
                @elseif(Route::is('villages.create'))
                    <li class="breadcrumb-item" aria-current="page">Create New Village</li>
                @elseif(Route::is('villages.edit'))
                    <li class="breadcrumb-item" aria-current="page">Edit Village</li>
                @endif
            </ol>
        </nav>
    </div>
    <div class="ms-auto">
        <div class="btn-group">
            @if (Route::is('villages.index'))
                <a href="{{ route('villages.create') }}" class="btn btn-primary px-5"><i class="bx bx-plus"></i>Add Village</a>
            @elseif(Route::is('villages.create'))
                <a href="{{ route('villages.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Village List</a>
            @elseif(Route::is('villages.edit'))
                <a href="{{ route('villages.index') }}" class="btn btn-primary px-5"><i class="bx bx-list-ul"></i>Village List</a>
            @endif
            
        </div>
    </div>
</div>
<!--end breadcrumb-->