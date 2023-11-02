@extends('admin.layouts.master')
@section('title')
    @include('admin.processors.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
    <style>
        .dropify-wrapper p{
            display: none !important;
        }
    </style>
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.processors.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('processors.update', $processor->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <h5 class="mb-0">Basic Details</h5>
                    <hr>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="mobile_number">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ $processor->user ? $processor->user->mobile_number : '' }}" required readonly>  
                            @error('mobile_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $processor->name }}" required>  
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="email">Email </label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $processor->email }}">  
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ $processor->date_of_birth ? $processor->date_of_birth->toDateString() : null }}">  
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="gst_number">GST Number </label>
                            <input type="text" class="form-control" name="gst_number" id="gst_number" value="{{ $processor->gst_number }}">  
                            @error('gst_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="number_of_farmers">No. of Farmers<span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" name="number_of_farmers" id="number_of_farmers" value="{{ $processor->number_of_farmers }}" required>  
                            @error('number_of_farmers')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $processor->address }}" required>  
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bank_account_number">Bank Account Number</label>
                            <input type="text" class="form-control" name="bank_account_number" id="bank_account_number" value="{{ $processor->bank_account_number }}">  
                            @error('bank_account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bank_name">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $processor->bank_name }}">  
                            @error('bank_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bank_ifsc">Bank IFSC</label>
                            <input type="text" class="form-control" name="bank_ifsc" id="bank_ifsc" value="{{ $processor->bank_ifsc }}">  
                            @error('bank_ifsc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="loan_details">Loan Details</label>
                            <textarea class="form-control" name="loan_details" id="loan_details" >{{ $processor->loan_details }}</textarea>  
                            @error('loan_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="job_works">Job work Vs own</label>
                            <input class="form-control" name="job_works" id="job_works" value="{{ $processor->job_works }}"></input>  
                            @error('job_works')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h5 class="mb-0">Service Details</h5>
                    <hr>
                    <div class="col-md-12" id="cropPattern">
                        @if($processor->processorCropPatterns)
                            @php
                                $crop_count = count($processor->processorCropPatterns);
                            @endphp
                            @foreach($processor->processorCropPatterns as $cropKey => $crop_pattern)
                                
                                <div class="row crop-class @if($cropKey != 0) next-referral @endif" >
                                    <hr class="mb-2 mt-2">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="crop_id">Commodity <span class="text-danger">*</span></label>
                                            <select class="form-control crop_id" name="crop_id[]" id="crop_id" required>
                                                <option value="" selected> Select Commodity</option>
                                                @if($commodities)
                                                    @foreach($commodities as $key =>  $commodity)
                                                        @if($crop_pattern->crop_id == $commodity->commodity_uid)
                                                            <option value="{{ $commodity->commodity_uid }}" data-index="{{ $key }}" data-commodity = "{{ $crop_pattern->crop_id }}"  data-variety = "{{ $crop_pattern->variety_id }}" selected> {{$commodity->name}}</option>
                                                        @else
                                                            <option value="{{ $commodity->commodity_uid }}" data-index="{{ $key }}"> {{$commodity->name}}</option>
                                                        @endif    
                                                    @endforeach
                                                @endif
                                            </select> 
                                            @error('crop_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="variety_id">Variety</label>
                                            <select class="form-control variety_id" name="variety_id[]" id="variety_id">
                                                <option value="" selected> Select Variety</option>
                                            </select>
                                            @error('variety_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="acreage">Acreage</label>
                                            <input type="text" class="form-control" name="acreage[]" id="acreage" value="{{ $crop_pattern->acreage }}">  
                                            @error('acreage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="region">Region</label>
                                            <input type="text" class="form-control" name="region[]" id="region" value="{{ $crop_pattern->region }}">  
                                            @error('region')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="process_capabality">Process Capability</label>
                                            <input type="text" class="form-control" name="process_capabality[]" id="process_capabality" value="{{ $crop_pattern->process_capabality }}">  
                                            @error('process_capabality')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="plant_capabality">Plant Capacity</label>
                                            <input type="text" class="form-control" name="plant_capabality[]" id="plant_capabality" value="{{ $crop_pattern->plant_capabality }}">  
                                            @error('plant_capabality')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="product">Product</label>
                                            <input type="text" class="form-control" name="product[]" id="product" value="{{ $crop_pattern->product }}">  
                                            @error('plant_capabality')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    @if($cropKey == 0)
                                        <div class="col-md-12 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="primary_processing_method[]" @if($crop_pattern->primary_processing_method == 1) checked @endif value="1">
                                                <label class="form-check-label" >Primary Processing Method</label>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="row crop-class" >
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="crop_id">Commodity <span class="text-danger">*</span></label>
                                        <select class="form-control crop_id" name="crop_id[]" id="crop_id" required>
                                            <option value="" selected> Select Commodity</option>
                                            @if($commodities)
                                                @foreach($commodities as $key =>  $commodity)
                                                    <option value="{{ $commodity->commodity_uid }}" data-index="{{ $key }}"> {{$commodity->name}}</option>
                                                @endforeach
                                            @endif
                                        </select> 
                                        @error('crop_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="variety_id">Variety</label>
                                        <select class="form-control variety_id" name="variety_id[]" id="variety_id">
                                            <option value="" selected> Select Variety</option>
                                        </select>
                                        @error('variety_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="acreage">Acreage</label>
                                        <input type="text" class="form-control" name="acreage[]" id="acreage">  
                                        @error('acreage')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="region">Region</label>
                                        <input type="text" class="form-control" name="region[]" id="region">  
                                        @error('region')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="process_capabality">Process Capability</label>
                                        <input type="text" class="form-control" name="process_capabality[]" id="process_capabality">  
                                        @error('process_capabality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="plant_capabality">Plant Capacity</label>
                                        <input type="text" class="form-control" name="plant_capabality[]" id="plant_capabality">  
                                        @error('plant_capabality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="product">Product</label>
                                        <input type="text" class="form-control" name="product[]" id="product">  
                                        @error('plant_capabality')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="primary_processing_method[]" value="1">
                                        <label class="form-check-label" >Primary Processing Method</label>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-primary px-5" id="addNewCrop"><i class="bx bx-plus"></i>Add</button>
                        <button type="button" class="btn btn-primary px-5 remove-crop @if(isset($crop_count) && $crop_count == 1)d-none @endif" id="removeCrop"><i class="bx bx-minus"></i>Remove</button>
                    </div>
                    <h5 class="mb-0">Procurement Center Info</h5>
                    <hr>
                    <div class="col-md-12" id="procurementCenter">
                        @if($processor->processorProcurementCenters)
                            @php
                                $procurementcenter_count = count($processor->processorProcurementCenters);
                            @endphp
                            @foreach($processor->processorProcurementCenters as $procurementcenterKey => $procurement_center)
                                
                                <div class="row procurementcenter-class @if($procurementcenterKey != 0) next-referral @endif" >
                                    <!-- <hr class="mb-2 mt-2"> -->
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="warehouse_address">Warehouse Address <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_address[]" id="warehouse_address" value="{{ $procurement_center->warehouse_address ? $procurement_center->warehouse_address : null }}">
                                            @error('warehouse_address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="warehouse_capacity">Warehouse Capacity <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_capacity[]" id="warehouse_capacity" value="{{ $procurement_center->warehouse_capacity ? $procurement_center->warehouse_capacity : null }}">
                                            @error('warehouse_capacity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="capacity_unit">Capacity Unit <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="capacity_unit[]" id="capacity_unit" value="{{ $procurement_center->capacity_unit ? $procurement_center->capacity_unit : null }}">  
                                            @error('capacity_unit')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <div class="form-group">
                                            <label class="form-label" for="warehouse_type">Warehouse Type <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_type[]" id="warehouse_type" value="{{ $procurement_center->warehouse_type ? $procurement_center->warehouse_type : null }}">  
                                            @error('warehouse_type')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>                                    
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="procurementcenter_state_id">State <span class="text-danger">*</span></label>
                                            <select class="form-control state_id" name="procurementcenter_state_id[]" id="procurementcenter_state_id"  required>
                                                <option value="" selected> Select State</option>
                                                @if($states)
                                                    @foreach($states as $key =>  $state)
                                                        @if($procurement_center->state_id == $state->id)
                                                            <option value="{{ $state->id }}" data-index="{{ $key }}" selected> {{$state->state_name}}</option>
                                                        @else
                                                            <option value="{{ $state->id }}" data-index="{{ $key }}"> {{$state->state_name}}</option>
                                                        @endif    
                                                    @endforeach
                                                @endif
                                            </select> 
                                            @error('state_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="procurementcenter_district_id">District <span class="text-danger">*</span></label>
                                            <select class="form-control district_id" name="procurementcenter_district_id[]" id="procurementcenter_district_id"  required>
                                                <option value="" selected> Select District</option>
                                                @if($districts)
                                                    @foreach($districts as $key =>  $district)
                                                        @if($procurement_center->district_id == $district->id)
                                                            <option value="{{ $district->id }}" data-index="{{ $key }}" selected> {{$district->district_name}}</option>
                                                        @else
                                                            <option value="{{ $district->id }}" data-index="{{ $key }}"> {{$district->district_name}}</option>
                                                        @endif    
                                                    @endforeach
                                                @endif
                                            </select> 
                                            @error('district_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="procurementcenter_sub_district_id">Sub-district <span class="text-danger">*</span></label>
                                            <select class="form-control sub_district_id" name="procurementcenter_sub_district_id[]" id="procurementcenter_sub_district_id"  required>
                                                <option value="" selected> Select Sub-district</option>
                                                @if($subdistricts)
                                                    @foreach($subdistricts as $key =>  $subdistrict)
                                                        @if($procurement_center->sub_district_id == $subdistrict->id)
                                                            <option value="{{ $subdistrict->id }}" data-index="{{ $key }}" selected> {{$subdistrict->sub_district_name}}</option>
                                                        @else
                                                            <option value="{{ $subdistrict->id }}" data-index="{{ $key }}"> {{$subdistrict->sub_district_name}}</option>
                                                        @endif    
                                                    @endforeach
                                                @endif
                                            </select> 
                                            @error('sub_district_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror  
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="procurementcenter_village_id">Village <span class="text-danger">*</span></label>
                                            <select class="form-control village_id" name="procurementcenter_village_id[]" id="procurementcenter_village_id"  required>
                                                <option value="" selected> Select Village</option>
                                                @if($villages)
                                                    @foreach($villages as $key =>  $village)
                                                        @if($procurement_center->village_id == $village->id)
                                                            <option value="{{ $village->id }}" data-index="{{ $key }}" selected> {{$village->village_name}}</option>
                                                        @else
                                                            <option value="{{ $village->id }}" data-index="{{ $key }}"> {{$village->village_name}}</option>
                                                        @endif    
                                                    @endforeach
                                                @endif
                                            </select> 
                                            @error('village_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror  
                                        </div>
                                    </div>                                     
                                </div>
                            @endforeach
                        @else
                            <div class="row procurementcenter-class" >
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="warehouse_address">Warehouse Address <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="warehouse_address[]" id="warehouse_address">  
                                        @error('warehouse_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="warehouse_capacity">Warehouse Capacity <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="warehouse_capacity[]" id="warehouse_capacity">  
                                        @error('warehouse_capacity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="capacity_unit">Capacity Unit <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="capacity_unit[]" id="capacity_unit">  
                                        @error('capacity_unit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="warehouse_type">Warehouse Type <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="warehouse_type[]" id="warehouse_type">  
                                        @error('warehouse_type')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>                            
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurementcenter_state_id">State <span class="text-danger">*</span></label>
                                        <select class="form-control state_id" name="procurementcenter_state_id[]" id="procurementcenter_state_id" >
                                            <option value="" selected> Select State</option>
                                            @if($states)
                                                @foreach($states as $key =>  $state)
                                                    <option value="{{ $state->id }}" data-index="{{ $key }}"> {{$state->state_name}}</option>
                                                @endforeach
                                            @endif
                                        </select> 
                                        @error('state_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurementcenter_district_id">District <span class="text-danger">*</span></label>
                                        <select class="form-control district_id" name="procurementcenter_district_id[]" id="procurementcenter_district_id" >
                                            <option value="" selected> Select District</option>
                                            @if($districts)
                                                @foreach($districts as $key =>  $district)
                                                    <option value="{{ $district->id }}" data-index="{{ $key }}"> {{$district->district_name}}</option>
                                                @endforeach
                                            @endif
                                        </select> 
                                        @error('district_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurementcenter_sub_district_id">Sub-district <span class="text-danger">*</span></label>
                                        <select class="form-control sub_district_id" name="procurementcenter_sub_district_id[]" id="procurementcenter_sub_district_id" >
                                            <option value="" selected> Select Sub-district</option>
                                            @if($subdistricts)
                                                @foreach($subdistricts as $key =>  $subdistrict)
                                                    <option value="{{ $subdistrict->id }}" data-index="{{ $key }}"> {{$subdistrict->sub_district_name}}</option>
                                                @endforeach
                                            @endif
                                        </select> 
                                        @error('sub_district_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror  
                                    </div>
                                </div>                             
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="procurementcenter_village_id">Village <span class="text-danger">*</span></label>
                                        <select class="form-control village_id" name="procurementcenter_village_id[]" id="procurementcenter_village_id">
                                            <option value="" selected> Select Village</option>
                                            @if($villages)
                                                @foreach($villages as $key =>  $village)
                                                    <option value="{{ $village->id }}" data-index="{{ $key }}"> {{$village->village_name}}</option>
                                                @endforeach
                                            @endif                                        
                                        </select>
                                        @error('village_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>                    
                    <div class="col-md-12 text-end">
                        <button type="button" class="btn btn-primary px-5" id="addNewProcurement"><i class="bx bx-plus"></i>Add</button>
                        <button type="button" class="btn btn-primary px-5 remove-procurement @if(isset($procurementcenter_count) && $procurementcenter_count == 1)d-none @endif" id="removeProcurement"><i class="bx bx-minus"></i>Remove</button>
                    </div>                    
                    <h5 class="mb-0">Documents</h5>
                    <hr>
                    @php
                        $file_name_one = null;
                        $document_one = null;
                        $file_name_two = null;
                        $document_two = null;
                        $file_name_three = null;
                        $document_three = null;
                        if($processor->processorDocuments){
                            
                            if(isset($processor->processorDocuments[0])){
                                $file_name_one = $processor->processorDocuments[0]->file_name;
                                $document_one = $processor->processorDocuments[0]->file;
                            }
                            if(isset($processor->processorDocuments[1])){
                                $file_name_two = $processor->processorDocuments[1]->file_name;
                                $document_two = $processor->processorDocuments[1]->file;
                            }
                            if(isset($processor->processorDocuments[2])){
                                $file_name_three = $processor->processorDocuments[2]->file_name;
                                $document_three = $processor->processorDocuments[2]->file;
                            }
                        }   
                    @endphp
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="file_name">File Name</label>
                                    <input type="text" class="form-control" name="file_name[]" id="file_name" value="{{ $file_name_one }}">  
                                    @error('file_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="image">Document</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image[]"
                                    data-default-file="{{ $document_one != null ? asset('assets/uploaded_images/documents/processors/'.$document_one) : null }}" />
                                    <input type="hidden" name="old_image[]" value="{{ $document_one }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="file_name">File Name</label>
                                    <input type="text" class="form-control" name="file_name[]" id="file_name" value="{{ $file_name_two }}">  
                                    @error('file_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="image">Document</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image[]"
                                    data-default-file="{{ $document_two != null ? asset('assets/uploaded_images/documents/processors/'.$document_two) : null }}"/>
                                    <input type="hidden" name="old_image[]" value="{{ $document_two }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <div class="form-group">
                                    <label class="form-label" for="file_name">File Name</label>
                                    <input type="text" class="form-control" name="file_name[]" id="file_name" value="{{ $file_name_three }}">  
                                    @error('file_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="image">Document</label>
                                    <input type="file" class="form-control dropify" data-height="150" data-allowed-file-extensions="png jpg jpeg webp" id="image" name="image[]"
                                    data-default-file="{{ $document_three != null ? asset('assets/uploaded_images/documents/processors/'.$document_three) : null }}"/>
                                    <input type="hidden" name="old_image[]" value="{{ $document_three }}">
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
    <script>
          $(document).ready(function(){
            $(".dropify").dropify();
            let commodities = <?php echo json_encode($commodities); ?>;
            let states = <?php echo json_encode($states); ?>;
            let districts = <?php echo json_encode($districts); ?>;
            let subdistricts = <?php echo json_encode($subdistricts); ?>;
            let villages = <?php echo json_encode($villages); ?>;             

            $(document).on('change','.crop_id',function () {
                let parent_id = $(this).val();
                if ($(this).val() != '' && $(this).val() != 'Select Commodity') {
                    let index = $(this).find(':selected').data('index');
                    let commodity = $(this).find(':selected').data('commodity');
                    let variety = $(this).find(':selected').data('variety');
                    let varieties = commodities[index].varieties;
                    let output = '<option value="">Select Variety</option>'
                    $.each(varieties, function (index, value) {
                        if((parent_id == commodity) && (variety == value.id)){
                            output +='<option value="' + value.id + '" selected>' + value.name + '</option>'
                        }else{
                            output +='<option value="' + value.id + '">' + value.name + '</option>'
                        }
                    });
                    $(this).closest('.crop-class').find('.variety_id').html(output);
                }
            });

            $('.crop_id').trigger('change');

            $("#addNewCrop").click(function(e) {
                $(".remove-crop").removeClass("d-none");

                let output = '';
                output = '<div class="row next-referral crop-class"><hr class="mb-2 mt-2">';
                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="crop_id">Commodity <span class="text-danger">*</span></label>'
                output += '<select class="form-control crop_id" name="crop_id[]" id="crop_id" required>'
                output += '<option value="" selected> Select Commodity</option>'
                $.each(commodities, function (index, value) {
                    output += '<option value="'+ value.commodity_uid +'" data-index="'+ index +'"> '+ value.name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="variety_id">Variety</label>'
                output += '<select class="form-control variety_id" name="variety_id[]" id="variety_id">'
                output += '<option value="" selected> Select Variety</option>'
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="acreage">Acreage</label>'
                output += '<input type="text" class="form-control" name="acreage[]" id="acreage"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="region">Region</label>'
                output += '<input type="text" class="form-control" name="region[]" id="region"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="process_capabality">Process Capabality</label>'
                output += '<input type="text" class="form-control" name="process_capabality[]" id="process_capabality"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="plant_capabality">Plant Capabality</label>'
                output += '<input type="text" class="form-control" name="plant_capabality[]" id="plant_capabality"> '
                output += '</div></div>'
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="product">Product</label>'
                output += '<input type="text" class="form-control" name="product[]" id="product"> '
                output += '</div></div>'

                // output += '<div class="col-md-2 mb-2"><div class="form-check">'
                // output += '<input class="form-check-input" type="checkbox" name="primary_processing_method[]" value="1">'
                // output += '<label class="form-check-label" >Primary Processing Method</label>'
                // output += '</div></div>'

                output += '</div>'


                $("#cropPattern").append(output);
            });
            $("body").on("click", ".remove-crop", function(e) {
                $(".next-referral").last().remove();
            });

            $("#addNewProcurement").click(function(e) {
                $(".remove-procurement").removeClass("d-none");

                let output = '';
                output = '<div class="row next-referral procurementcenter-class"><hr class="mb-2 mt-2">';
                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_address">Warehouse Address <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="warehouse_address[]" id="warehouse_address">'
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_capacity">Warehouse Capacity <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="warehouse_capacity[]" id="warehouse_capacity"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="capacity_unit">Capacity Unit <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="capacity_unit[]" id="capacity_unit"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="warehouse_type">Warehouse Type <span class="text-danger">*</span></label>'
                output += '<input type="text" class="form-control" name="warehouse_type[]" id="warehouse_type"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurementcenter_state_id">State <span class="text-danger">*</span></label>'
                output += '<select class="form-control state_id" name="procurementcenter_state_id[]" id="procurementcenter_state_id" >'
                output += '<option value="" selected> Select State</option>'
                $.each(states, function (index, value) {
                    output += '<option value="'+ value.id +'" data-index="'+ index +'"> '+ value.state_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurementcenter_district_id">District <span class="text-danger">*</span></label>'
                output += '<select class="form-control district_id" name="procurementcenter_district_id[]" id="procurementcenter_district_id" >'
                output += '<option value="" selected> Select District</option>'
                $.each(districts, function (index, value) {
                    output += '<option value="'+ value.id +'" data-index="'+ index +'"> '+ value.district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurementcenter_sub_district_id">Sub-district <span class="text-danger">*</span></label>'
                output += '<select class="form-control sub_district_id" name="procurementcenter_sub_district_id[]" id="procurementcenter_sub_district_id" >'
                output += '<option value="" selected> Select Sub-district</option>'
                $.each(subdistricts, function (index, value) {
                    output += '<option value="'+ value.id +'" data-index="'+ index +'"> '+ value.sub_district_name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="procurementcenter_village_id">Village <span class="text-danger">*</span></label>'
                output += '<select class="form-control village_id" name="procurementcenter_village_id[]" id="procurementcenter_village_id">'
                output += '<option value="" selected> Select Village</option>'
                $.each(villages, function (index, value) {
                    output += '<option value="'+ value.id +'" data-index="'+ index +'"> '+ value.village_name +'</option>'
                });
                output += '</select></div></div>'                                


                output += '</div>'

                $("#procurementCenter").append(output);
            });
            $("body").on("click", ".remove-procurement", function(e) {
                $(".next-referral").last().remove();
            });             
        })  
    </script>
@endsection