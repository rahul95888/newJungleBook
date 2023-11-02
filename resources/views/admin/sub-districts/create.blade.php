@extends('admin.layouts.master')
@section('title')
    @include('admin.sub-districts.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.sub-districts.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('sub-districts.store') }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="sub_district_name">Sub District Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sub_district_name" id="sub_district_name" value="{{ old('sub_district_name') }}" required>
                            @error('sub_district_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="district_uid">District <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="district_uid" id="district_uid" required>
                                <option value="" selected> Select District</option>
                                @if($districts)
                                    @foreach($districts as $district)
                                        <option value="{{ $district->district_uid }}" @if(old('district_uid') == $district->district_uid) selected @endif> {{$district->district_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('district_uid')
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
    </script>
@endsection
