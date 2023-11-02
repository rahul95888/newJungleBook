@if (Route::is('sub-districts.index'))
    Sub Districts
@elseif(Route::is('sub-districts.create'))
    Create New Sub District
@elseif(Route::is('sub-districts.edit'))
    Edit Sub District
@endif
    | Admin Panel - 
    {{ config('app.name') }}