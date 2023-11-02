@extends('admin.layouts.master')
@section('title')
    @include('admin.cities.partials.title')
@endsection
@section('styles')
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.cities.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('cities.update', $city->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="city_name">City Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="city_name" id="city_name" value="{{ $city->city_name }}" required>
                            @error('city_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="city_code">City Code</label>
                            <input type="text" class="form-control" name="city_code" id="city_code" value="{{ $city->city_code }}">
                            @error('city_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="state_uid">State <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="state_uid" id="state_uid">
                                <option value="" selected> Select State</option>
                                @if($states)
                                    @foreach($states as $state)
                                        @if($city->state_uid == $state->state_uid)
                                            <option value="{{ $state->state_uid }}" selected>{{ $state->state_name }}</option>
                                        @else
                                            <option value="{{ $state->state_uid }}">{{ $state->state_name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('state_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="latitude">Latitude<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="latitude" id="latitude" value="{{ $city->latitude }}" required>
                            @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="longitude">Longitude<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="longitude" id="longitude" value="{{ $city->longitude }}" required>
                            @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.select2').select2(
                {
                    theme: 'bootstrap4',
                }
            );
        });
    </script>
@endsection
