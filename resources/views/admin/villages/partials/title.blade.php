@if (Route::is('villages.index'))
    Villages
@elseif(Route::is('villages.create'))
    Create New Village
@elseif(Route::is('villages.edit'))
    Edit Village
@endif
    | Admin Panel - 
    {{ config('app.name') }}