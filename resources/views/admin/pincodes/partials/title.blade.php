@if (Route::is('pincodes.index'))
    Pincodes
@elseif(Route::is('pincodes.create'))
    Create New Pincode
@elseif(Route::is('pincodes.edit'))
    Edit Pincode
@endif
    | Admin Panel - 
    {{ config('app.name') }}