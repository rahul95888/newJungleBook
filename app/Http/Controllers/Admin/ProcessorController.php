<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
 
use App\Models\District;
use App\Models\Education;
 
use App\Models\ProcessCapability;
use App\Models\ProcessMethod;
use App\Models\Equipment;

 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Gallery;
class ProcessorController extends Controller
{
    public function index()
    {
        $datas = Equipment::get();
        return view('admin.processors.index', compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::with('varieties')->get();
         
        
         
        $process_methods = ProcessMethod::get();
        $process_capabilities = ProcessCapability::get();
        

        return view('admin.processors.create', compact('commodities' ,      'process_methods', 'process_capabilities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_name' => 'required|string',
            'description' => 'required|string',
        ]);
        try {
            DB::beginTransaction();
            $processor = new Equipment();
            $processor->equipment_name = $request->equipment_name;
            $processor->itinerary = $request->itinerary;
            $processor->description = $request->description;
            $processor->google_location = isset($request->google_location) ? $request->google_location : '';
            $processor->video = isset($request->video) ? $request->video : '';

            $processor->total_area = isset($request->total_area) ? $request->total_area : '';
            $processor->belcony_pets = isset($request->belcony_pets) ? $request->belcony_pets : '';
            $processor->bedroom = isset($request->bedroom) ? $request->bedroom : '';
            $processor->lounge = isset($request->lounge) ? $request->lounge : '';

             
            $processor->bathroom = isset($request->bathroom) ? $request->bathroom : '';
            $processor->gym_area = isset($request->gym_area) ? $request->gym_area : '';
            $processor->parking = isset($request->parking) ? $request->parking : '';

            $processor->property_for = isset($request->property_for) ? $request->property_for : '';
            $processor->status = isset($request->status) ? $request->status : '';

            if($request->hasfile('thumb')){
                $name = rand().'.'.$request->file('thumb')->extension();
                $request->file('thumb')->move(public_path('uploads/property'), $name);  
                $processor->thumb = $name;
             }
            $processor->save();
            if($request->hasfile('image')){
            foreach($request->file('image') as $image){
                $gallery = new Gallery();
                $name = rand().'.'.$image->extension();
                $image->move(public_path('uploads/property'), $name);  
                $gallery->property_id =  $processor->id;
                $gallery->image =  $name;
                $gallery->save();

            }
         }
         DB::commit();
            session()->flash('success', 'Processor has been created successfully !!');
            return redirect()->route('processors.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $processor = Equipment::find($id);
        $gallery = Gallery::where('property_id', $id)->get();
        
        if (is_null($processor)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('processors.index');
        }
        return view('admin.processors.edit', compact('processor','gallery'));
    }

    public function update(Request $request, $id)
    {
        $processor = Equipment::find($id);

        if (is_null($processor)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('processors.index');
        }

        $request->validate([
            'equipment_name' => 'required|string',
            'description' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $processor->equipment_name = $request->equipment_name;
            $processor->itinerary = $request->itinerary;
            $processor->description = $request->description;
            $processor->google_location = isset($request->google_location) ? $request->google_location : '';
            $processor->video = isset($request->video) ? $request->video : '';

            $processor->total_area = isset($request->total_area) ? $request->total_area : '';
            $processor->belcony_pets = isset($request->belcony_pets) ? $request->belcony_pets : '';
            $processor->bedroom = isset($request->bedroom) ? $request->bedroom : '';
            $processor->lounge = isset($request->lounge) ? $request->lounge : '';

             
            $processor->bathroom = isset($request->bathroom) ? $request->bathroom : '';
            $processor->gym_area = isset($request->gym_area) ? $request->gym_area : '';
            $processor->parking = isset($request->parking) ? $request->parking : '';

            $processor->property_for = isset($request->property_for) ? $request->property_for : '';
            $processor->status = isset($request->status) ? $request->status : '';

           if($request->hasfile('thumb')){
                $name = rand().'.'.$request->file('thumb')->extension();
                $request->file('thumb')->move(public_path('uploads/property'), $name);  
                $processor->thumb = $name;
             }

            

            

            

            
            $processor->save();
            if($request->hasfile('image')){
                foreach($request->file('image') as $image){
                    $gallery = new Gallery();
                    $name = rand().'.'.$image->extension();
                    $image->move(public_path('uploads/property'), $name);  
                    $gallery->property_id =  $processor->id;
                    $gallery->image =  $name;
                    $gallery->save();
    
                }
             }

             

             

            DB::commit();
            session()->flash('success', 'Processor has been updated successfully !!');
            return redirect()->route('processors.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $processor = Equipment::find($id);

         

        if (is_null($processor)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('processors.index');
        }
        // Remove Image
       

        

        // Delete processor
        $processor->deleted_by = auth()->id();
        $processor->save();
        $processor->delete();

        session()->flash('success', 'Package has been deleted permanently !!');
        return redirect()->route('processors.index');
    }
    public function featured($id){
        $processor = Equipment::find($id);
        if($processor->status==='Featured'){
            $processor->status = 'NoFeatured';
        }else{
            $processor->status = 'Featured';
        }
        
        $processor->save();

        return redirect()->route('processors.index');
    }
    public function processorKycList()
    {
        $datas = User::where('user_type', 'processor')->where(function ($query) {
            $query->where('gst_number', '!=', null)
                ->orWhere('account_number', '!=', null)
                ->orWhere('address_document_id_number', '!=', null);
        })->get();
        // if (request()->ajax()) {
        //     $processor_kycs = User::where('user_type', 'processor')->where(function ($query) {
        //         $query->where('aadhar_number', '!=', null)
        //             ->orWhere('account_number', '!=', null)
        //             ->orWhere('address_document_id_number', '!=', null);
        //     })->get();

        //     $datatable = DataTables::of($processor_kycs)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $html = '';
        //                 if ($row->kyc_status == 'pending') {
        //                     $html .= '<button class="btn btn-info btn-sm me-3 viewOrActionKyc" title="Approve / Reject KYC" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#kycModal">Approve/Reject</button>';
        //                 } else if ($row->kyc_status == 'accepted') {
        //                     $html .= '<button class="btn btn-info btn-sm me-3 viewOrActionKyc" title="View KYC" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#kycModal">View</button>';
        //                 } else if ($row->kyc_status == 'rejected') {
        //                     $html .= '<button class="btn btn-info btn-sm me-3 viewOrActionKyc" title="View KYC" data-id="' . $row->id . '" data-bs-toggle="modal" data-bs-target="#kycModal">View</button>';
        //                 }

        //                 return $html;
        //             }
        //         )

        //         ->editColumn('created_at', function ($row) {
        //             return $row->created_at ? $row->created_at->format('d/m/Y') : '';
        //         })
        //         ->editColumn('kyc_name', function ($row) {
        //             return $row->name;
        //         })
        //         ->editColumn('mobile_number', function ($row) {
        //             return $row->mobile_number;
        //         })
        //         ->editColumn('kyc_status', function ($row) {
        //             if ($row->kyc_status == 'pending') {
        //                 return '<span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span>';
        //             } else if ($row->kyc_status == 'accepted') {
        //                 return '<span class="badge bg-gradient-quepal text-white shadow-sm w-100">Accepted</span>';
        //             } else if ($row->kyc_status == 'rejected') {
        //                 return '<span class="badge bg-gradient-bloody text-white shadow-sm w-100">Rejected</span>';
        //             } else {
        //                 return '';
        //             }
        //             return $row->kyc_status;
        //         });
        //     $rawColumns = ['action', 'created_at', 'kyc_name', 'mobile_number', 'kyc_status'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.kycs.processor-kycs', compact('datas'));
    }

    public function getProcessorKycById(Request $request)
    {
        $data = [];
        $processor = User::where('id', $request->user_id)->first();
        if ($processor) {
            $data = [
                'id' => $processor->id,
                'name' => $processor->name,
                'mobile_number' => $processor->mobile_number,
                'gst_number' => $processor->gst_number,
                'account_number' => $processor->account_number,
                'account_holder_name' => $processor->account_holder_name,
                'ifsc_code' => $processor->ifsc_code,
                'bank_name' => $processor->bank_name,
                'branch_name' => $processor->branch_name,
                'address_document_type' => $processor->address_document_type,
                'address_document_id_number' => $processor->address_document_id_number,
                'kyc_status' => $processor->kyc_status,
                'gst_document' => $processor->gst_document ? get_file_from_aws($processor->gst_document) : '',
                'gst_file_name' => substr(html_entity_decode($processor->gst_document), 0, 20) . '...',
                'gst_upload_date' => $processor->gst_upload_date ? $processor->gst_upload_date->format('d/m/Y h:i A') : '',
                'bank_document' => $processor->bank_document ? get_file_from_aws($processor->bank_document) : '',
                'bank_file_name' => substr(html_entity_decode($processor->bank_document), 0, 20) . '...',
                'bank_upload_date' => $processor->bank_upload_date ? $processor->bank_upload_date->format('d/m/Y h:i A') : '',
                'address_document' => $processor->address_document ? get_file_from_aws($processor->address_document) : '',
                'address_file_name' => substr(html_entity_decode($processor->address_document), 0, 20) . '...',
                'address_upload_date' => $processor->address_upload_date ? $processor->address_upload_date->format('d/m/Y h:i A') : '',
            ];
        }
        return response()->json(['success' => true, 'message' => 'User KYC details get!', 'data' => $data], 200);
    }
    public function updateProcessorKycStatus(Request $request)
    {
        switch ($request->action) {
            case 'delete':
                $processor = User::where('id', $request->user_id)->first();
                if ($processor) {
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $processor->gst_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $processor->bank_document);
                    UploadHelper::deleteFile('assets/uploaded_images/documents/users/' . $processor->address_document);
                    $processor->update([
                        'kyc_status' => null,
                        'gst_document' => null,
                        'bank_document' => null,
                        'address_document' => null,
                    ]);
                }
                break;
            case 'reject':
                $processor = User::where('id', $request->user_id)->first();
                if ($processor) {
                    $processor->update(['kyc_status' => 'rejected']);
                }
                break;
            case 'accept':
                $processor = User::where('id', $request->user_id)->first();
                if ($processor) {
                    $processor->update(['kyc_status' => 'accepted']);
                }
                break;
        }
        return response()->json(['success' => true, 'message' => 'User KYC status updated!',], 200);
    }
}
