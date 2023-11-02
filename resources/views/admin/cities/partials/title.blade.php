@if (Route::is('cities.index'))
    Cities 
@elseif(Route::is('cities.create'))
    Create New City
@elseif(Route::is('cities.edit'))
    Edit City
@endif
    | Admin Panel - 
    {{ config('app.name') }}