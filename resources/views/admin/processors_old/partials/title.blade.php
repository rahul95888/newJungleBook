@if (Route::is('processors.index'))
    Properties
@elseif(Route::is('processors.create'))
    Create New Property
@elseif(Route::is('processors.edit'))
    Edit Property
@endif
    | Admin Panel - 
    {{ config('app.name') }}