@extends('admin.layouts.master')
@section('title')
    @include('admin.pincodes.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.pincodes.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('pincodes.store') }}" id="pincode_form" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="pincode">Pincode <span class="text-danger">*</span></label>
                            <input type="text" onkeypress="return /[0-9 ]/i.test(event.key)" maxlength="6" class="form-control " name="pincode" id="pincode" value="{{ old('pincode') }}" required>
                            <span class="text-danger text-sm" id="PinError"></span>
                            @error('pincode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="city_uid">City <span class="text-danger">*</span></label>
                            <select class="form-control select2 " name="city_uid" id="city_uid" required>
                                <option value="" selected> Select City</option>
                                @if($cities)
                                    @foreach($cities as $city)
                                        <option value="{{ $city->city_uid }}" @if(old('city_uid') == $city->city_uid) selected @endif> {{$city->city_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('city_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
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
        $(document).on('keyup', '#pincode', function () {
            var Box = $('#PinError');
            if ($('#pincode').val().length == '6') {
              Box.empty();
            } else {
                Box.empty();
                Box.html("Pin Code should be equal to 6 digits");
            }


        });
    </script>
@endsection
