@extends('admin.layouts.master')
@section('title')
    @include('admin.traders.partials.title')
@endsection
@section('styles')
    <link href="{{ asset('assets/plugins/dropify/css/dropify.min.css') }}" rel="stylesheet" />
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.traders.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                @include('admin.layouts.partials.messages')
                <form action="{{ route('traders.update', $trader->id) }}" method="POST" enctype="multipart/form-data" data-parsley-validate data-parsley-focus="first" class="row g-3 needs-validation @if($errors->any())was-validated @endif">
                    @csrf
                    @method('put')
                    <h5 class="mb-0">Basic Details</h5>
                    <hr>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="mobile_number">Mobile Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" value="{{ $trader->user ? $trader->user->mobile_number : '' }}" required readonly>  
                            @error('mobile_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $trader->name }}" required>  
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="email">Email </label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $trader->email }}">  
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ $trader->date_of_birth ? $trader->date_of_birth->toDateString() : null }}">  
                            @error('date_of_birth')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="gst_number">GST Number </label>
                            <input type="text" class="form-control" name="gst_number" id="gst_number" value="{{ $trader->gst_number }}">  
                            @error('gst_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="address">Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ $trader->address }}" required>  
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bank_account_number">Bank Account Number</label>
                            <input type="text" class="form-control" name="bank_account_number" id="bank_account_number" value="{{ $trader->bank_account_number }}">  
                            @error('bank_account_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bank_name">Bank Name</label>
                            <input type="text" class="form-control" name="bank_name" id="bank_name" value="{{ $trader->bank_name }}">  
                            @error('bank_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="bank_ifsc">Bank IFSC</label>
                            <input type="text" class="form-control" name="bank_ifsc" id="bank_ifsc" value="{{ $trader->bank_ifsc }}">  
                            @error('bank_ifsc')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="turnover">Turnover</label>
                            <input type="text" class="form-control" name="turnover" id="turnover" value="{{ $trader->turnover }}">  
                            @error('turnover')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="ho_location">Branch Locations & Hubs Connected</label>
                            <input type="text" class="form-control" name="ho_location" id="ho_location" value="{{ $trader->ho_location }}">  
                            @error('ho_location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="form-label" for="trade_regions">Trade Regions</label>
                            <input type="text" class="form-control" name="trade_regions" id="trade_regions" value="{{ $trader->trade_regions }}">  
                            @error('trade_regions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <h5 class="mb-0">Trade Details</h5>
                    <hr>
                    <div class="col-md-12" id="cropPattern">
                        @if($trader->traderCropPatterns)
                            @php
                                $crop_count = count($trader->traderCropPatterns);
                            @endphp
                            @foreach($trader->traderCropPatterns as $cropKey => $crop_pattern)
                                
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
                                            <label class="form-label" for="factor_id">Factor</label>
                                            <select class="form-control factor_id" name="factor_id[]" id="factor_id">
                                                <option value="" selected> Select Factor</option>
                                                @if($factors)
                                                    @foreach($factors as $key =>  $factor)
                                                        @if($crop_pattern->factor_id == $factor->id)
                                                            <option value="{{ $factor->id }}" selected> {{$factor->name}}</option>
                                                        @else
                                                            <option value="{{ $factor->id }}"> {{$factor->name}}</option>
                                                        @endif    
                                                    @endforeach
                                                @endif
                                            </select> 
                                            @error('factor_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror  
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="tonnage_daily">Tonnage Daily</label>
                                            <input type="text" class="form-control" name="tonnage_daily[]" id="tonnage_daily" value="{{ $crop_pattern->tonnage_daily }}">  
                                            @error('tonnage_daily')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="tonnage_monthly">Tonnage Monthly</label>
                                            <input type="text" class="form-control" name="tonnage_monthly[]" id="tonnage_monthly" value="{{ $crop_pattern->tonnage_monthly }}">  
                                            @error('tonnage_monthly')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="tonnage_yearly">Tonnage Yearly</label>
                                            <input type="text" class="form-control" name="tonnage_yearly[]" id="tonnage_yearly" value="{{ $crop_pattern->tonnage_yearly }}">  
                                            @error('tonnage_yearly')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label" for="mandi_reg_details">Mandi Reg. Details</label>
                                            <input type="text" class="form-control" name="mandi_reg_details[]" id="mandi_reg_details" value="{{ $crop_pattern->mandi_reg_details }}">  
                                            @error('mandi_reg_details')
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
                                <div class="col-md-2 mb-2">
                                    <div class="form-group">
                                        <label class="form-label" for="factor_id">Factor</label>
                                        <select class="form-control" name="factor_id[]" id="factor_id">
                                            <option value="" selected> Select Factor</option>
                                                @if($factors)
                                                    @foreach($factors as $key =>  $factor)
                                                        <option value="{{ $factor->id }}" data-index="{{ $key }}"> {{$factor->name}}</option>
                                                    @endforeach
                                                @endif
                                        </select>
                                        @error('factor_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror 
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_daily">Tonnage Daily</label>
                                        <input type="text" class="form-control" name="tonnage_daily[]" id="tonnage_daily">  
                                        @error('tonnage_daily')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_monthly">Tonnage Monthly</label>
                                        <input type="text" class="form-control" name="tonnage_monthly[]" id="tonnage_monthly">  
                                        @error('tonnage_monthly')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="tonnage_yearly">Tonnage Yearly</label>
                                        <input type="text" class="form-control" name="tonnage_yearly[]" id="tonnage_yearly">  
                                        @error('tonnage_yearly')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="mandi_reg_details">Mandi Reg. Details</label>
                                        <input type="text" class="form-control" name="mandi_reg_details[]" id="mandi_reg_details">  
                                        @error('mandi_reg_details')
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
                        @if($trader->traderProcurementCenters)
                            @php
                                $procurementcenter_count = count($trader->traderProcurementCenters);
                            @endphp
                            @foreach($trader->traderProcurementCenters as $procurementcenterKey => $procurement_center)
                                
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
                        if($trader->traderDocuments){
                            
                            if(isset($trader->traderDocuments[0])){
                                $file_name_one = $trader->traderDocuments[0]->file_name;
                                $document_one = $trader->traderDocuments[0]->file;
                            }
                            if(isset($trader->traderDocuments[1])){
                                $file_name_two = $trader->traderDocuments[1]->file_name;
                                $document_two = $trader->traderDocuments[1]->file;
                            }
                            if(isset($trader->traderDocuments[2])){
                                $file_name_three = $trader->traderDocuments[2]->file_name;
                                $document_three = $trader->traderDocuments[2]->file;
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
                                    data-default-file="{{ $document_one != null ? asset('assets/uploaded_images/documents/traders/'.$document_one) : null }}" />
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
                                    data-default-file="{{ $document_two != null ? asset('assets/uploaded_images/documents/traders/'.$document_two) : null }}"/>
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
                                    data-default-file="{{ $document_three != null ? asset('assets/uploaded_images/documents/traders/'.$document_three) : null }}"/>
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
            let factors = <?php echo json_encode($factors); ?>;
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


                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="factor_id">Factor <span class="text-danger">*</span></label>'
                output += '<select class="form-control" name="factor_id[]" id="factor_id" required>'
                output += '<option value="" selected> Select Factor</option>'
                $.each(factors, function (index, value) {
                    output += '<option value="'+ value.id +'" data-index="'+ index +'"> '+ value.name +'</option>'
                });
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="variety_id">Variety</label>'
                output += '<select class="form-control variety_id" name="variety_id[]" id="variety_id">'
                output += '<option value="" selected> Select Variety</option>'
                output += '</select></div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_daily">Tonnage Daily</label>'
                output += '<input type="text" class="form-control" name="tonnage_daily[]" id="tonnage_daily"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_monthly">Tonnage Monthly</label>'
                output += '<input type="text" class="form-control" name="tonnage_monthly[]" id="tonnage_monthly"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="tonnage_yearly">Tonnage Yearly</label>'
                output += '<input type="text" class="form-control" name="tonnage_yearly[]" id="tonnage_yearly"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="mandi_reg_details">Mandi Reg. Details</label>'
                output += '<input type="text" class="form-control" name="mandi_reg_details[]" id="mandi_reg_details"> '
                output += '</div></div>'

                output += '<div class="col-md-2 mb-2"><div class="form-group"><label class="form-label" for="region">Region</label>'
                output += '<input type="text" class="form-control" name="region[]" id="region"> '
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