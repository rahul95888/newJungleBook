@extends('admin.layouts.master')
@section('title')
    @include('admin.news.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.news.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="title">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $news->title }}" required>  
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="commodity_uid">Category <span class="text-danger">*</span></label>
                            <select class="form-control select2" name="commodity_uid" id="commodity_uid">
                                <option value="" selected> Select Variety</option>
                                @if($commodities)
                                    @foreach($commodities as $commodity)
                                        @if($news->commodity_uid == $commodity->commodity_uid)
                                            <option value="{{ $commodity->commodity_uid }}" selected>{{ $commodity->name }}</option>
                                        @else
                                            <option value="{{ $commodity->commodity_uid }}">{{ $commodity->name }}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select> 
                            @error('commodity_uid')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="news_content">Content <span class="text-danger">*</span></label>
                            <textarea name="content" id="news_content" cols="30" rows="10" required>{{ $news->content }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror  
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label" for="image">Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control dropify" data-height="150" id="image" name="image" 
                            data-allowed-file-extensions="png jpg jpeg webp svg" 
                            data-default-file="{{ $news->image != null ? '/uploads/category/'.$news->image : null }}"/>
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
    <script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script> 
    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'news_content' );
            $(".dropify").dropify();
            $('.select2').select2(
                {
                    theme: 'bootstrap4',
                }
            );
        });
    </script>
@endsection