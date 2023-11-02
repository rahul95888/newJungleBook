@if (Route::is('districts.index'))
    Districts
@elseif(Route::is('districts.create'))
    Create New District
@elseif(Route::is('districts.edit'))
    Edit District
@endif
    | Admin Panel - 
    {{ config('app.name') }}