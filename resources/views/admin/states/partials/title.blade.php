@if (Route::is('states.index'))
    States
@elseif(Route::is('states.create'))
    Create New State
@elseif(Route::is('states.edit'))
    Edit State
@endif
    | Admin Panel - 
    {{ config('app.name') }}