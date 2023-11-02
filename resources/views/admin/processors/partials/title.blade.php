@if (Route::is('processors.index'))
    Property
@elseif(Route::is('processors.create'))
    Create New Processor
@elseif(Route::is('processors.edit'))
    Edit Processor
@endif
    | Admin Panel - 
    {{ config('app.name') }}