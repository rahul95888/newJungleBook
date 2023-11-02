@extends('admin.layouts.master')
@section('title')
    @include('admin.states.partials.title')
@endsection
@section('styles')
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.states.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('states.update', $state->id) }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="state_name">State Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="state_name" id="state_name" value="{{ $state->state_name }}" required>
                            @error('state_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="state_code">State Code</label>
                            <input type="text" class="form-control" name="state_code" id="state_code" value="{{ $state->state_code }}">
                            @error('state_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="country_uid">Country <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="country_uid" id="country_uid">
                                <option value="" selected> Select Country</option>
                                @if($countries)
                                    @foreach($countries as $country)
                                        @if($state->country_uid == $country->country_uid)
                                            <option value="{{ $country->country_uid }}" selected>{{ $country->country_name }}</option>
                                        @else
                                            <option value="{{ $country->country_uid }}">{{ $country->country_name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            @error('country_uid')
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
