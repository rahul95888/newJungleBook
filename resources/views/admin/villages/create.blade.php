@extends('admin.layouts.master')
@section('title')
    @include('admin.villages.partials.title')
@endsection
@section('styles')

@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.villages.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('villages.store') }}" method="POST" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="village_name">Village Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="village_name" id="village_name" value="{{ old('village_name') }}" required>
                            @error('village_name')
                                <div class="invalid-feedback mt-3">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="sub_district_uid">Sub District <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="sub_district_uid" id="sub_district_uid" required>
                                <option value="" selected> Select Sub District</option>
                                @if($sub_districts)
                                    @foreach($sub_districts as $sub_district)
                                        <option value="{{ $sub_district->sub_district_uid }}" @if(old('sub_district_uid') == $sub_district->sub_district_uid) selected @endif> {{$sub_district->sub_district_name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <br>
                    </div>
                    @error('sub_district_uid')
                    <div class="invalid-feedback mt-3">{{ $message }}</div>
                    @enderror
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
