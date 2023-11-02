@extends('admin.layouts.master')
@section('title')
    @include('admin.processors.partials.title')
@endsection
@section('styles')
    
@endsection
@section('admin-content')
<div class="page-wrapper">
    <div class="page-content">
        @include('admin.processors.partials.header-breadcrumbs')
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="processors_table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Mobile Number</th>
                                <th>Name</th>
                                <th>No. of Farmers</th>
                                <th>Registered From</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')

<script>
    $(document).ready(function(){
        let processorsTable = $('table#processors_table').DataTable({
            language: {processing: "<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Loading Data..."},
            processing: true,
            serverSide: true,
            ajax: {url: "{{ route('processors.index') }}"},
            aLengthMenu: [[10,25, 50, 100, 1000, -1], [10,25, 50, 100, 1000, "All"]],
            buttons: [],
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'mobile_number', name: 'mobile_number'},
                {data: 'name', name: 'name'},
                {data: 'number_of_farmers', name: 'number_of_farmers'},
                {data: 'registered_from', name: 'registered_from'},
                {data: 'action', name: 'action'}
            ],
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1] /* 1st one, start by the right */
            }]
        });
    });
</script>
@endsection