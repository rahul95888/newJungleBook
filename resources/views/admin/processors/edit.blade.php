@extends('admin.layouts.master')
@section('title')
    @include('admin.processors.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
	<link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.processors.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('processors.update', $processor->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first"  class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <h5 class="mb-0">Basic Details</h5>
                    <hr>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="equipment_name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="equipment_name" required id="equipment_name" value="{{ $processor->equipment_name }}" >
                            @error('equipment_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="description">Description <span class="text-danger">*</span></label>
                            <textarea  class="form-control" rows="10" cols="50"  name="description" required id="description" >{{ $processor->equipment_name }}</textarea>
                            @error('description')
                            
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="itinerary">Itinerary <span class="text-danger">*</span></label>
                            <textarea  class="form-control" rows="10" cols="50"  name="itinerary" required id="itinerary">{{ $processor->itinerary}}</textarea>
                            @error('itinerary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label" for="google_location">Location </label>
                            <input type="text" class="form-control" name="google_location" id="google_location" value="{{ $processor->google_location }}">
                            @error('google_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>  
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="total_area">Total Pax<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="total_area" required id="total_area" value="{{ $processor->total_area}}" >
                            @error('total_area')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bedroom">Total Days<span class="text-danger">*</span></label>
                            <input type="text"  class="form-control" name="bedroom" required id="bedroom" value="{{ $processor->bedroom }}" >
                            @error('bedroom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bathroom">Currency<span class="text-danger">*</span></label>
                            <select class="form-control" name='bathroom'>
                                <option value="$" {{ ( $processor->bathroom == '$') ? 'selected' : '' }}>$</option>
                                <option value="₹" {{ ( $processor->bathroom == '₹') ? 'selected' : '' }}>₹</option>
                                <option value="د.إ" {{ ( $processor->bathroom == 'د.إ') ? 'selected' : '' }}>د.إ</option>
                                <option value="£" {{ ( $processor->bathroom == '£') ? 'selected' : '' }}>£</option>
                                <option value="€" {{ ( $processor->bathroom == '€') ? 'selected' : '' }}>€</option>
                                <option value="XOF" {{ ( $processor->bathroom == 'XOF') ? 'selected' : '' }}>XOF</option>
                                <option value="XAF" {{ ( $processor->bathroom == 'XAF') ? 'selected' : '' }}>XAF</option>
                            </select>
                            
                           
                            @error('bathroom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="lounge">Amount<span class="text-danger">*</span></label>
                            <input type="number"  class="form-control" name="lounge" required id="lounge" value="{{ $processor->lounge }}" >
                            @error('Lounge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="thumb">Thumbnail</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="thumb" name="thumb"
                                    data-default-file="{{URL::to('/uploads/property/'.$processor->thumb)}}"/>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div>
                        @foreach($gallery as $value)
                        <img src="{{URL::to('/uploads/property/'.$value->image)}}" style="width:40px; height:40px;" />
                        @endforeach
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="address_document">Gallery</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="address_document" name="image[]" multiple/>
                                </div>
                            </div>
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
<script src="{{ asset('assets/plugins/dropify/js/dropify.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
    $(function() {
        $('#gst_number').keyup(function() {
            this.value = this.value.toLocaleUpperCase();
        });
    });
</script>
<script>
        $(document).ready(function(){
            CKEDITOR.replace('description');
            CKEDITOR.replace('itinerary');
            $(".dropify").dropify();
            $('.select2').select2({
                theme: 'bootstrap4',
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                placeholder: $(this).data('placeholder'),
                allowClear: Boolean($(this).data('allow-clear')),
            });
  
             
           
            
        })
    </script>
@endsection
