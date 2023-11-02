@if (Route::is('services.index'))
    Services
@elseif(Route::is('services.create'))
    Create New Service
@elseif(Route::is('services.edit'))
    Edit Service
@endif
    | Admin Panel - 
    {{ config('app.name') }}