<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Marketing;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MarketingController extends Controller
{
    public function index()
    {
        $datas = Marketing::get();
        // if (request()->ajax()) {
        //     $marketings = Marketing::select('marketings.*');

        //     $datatable = DataTables::of($marketings)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('marketings.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit Marketing Details" href="' . route('marketings.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete Marketing" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
        //                 $delete_message = "You won't be able to revert this!";
        //                 $html .= '<script>
        //                     $("#deleteItem' . $row->id . '").click(function(){
        //                         swal.fire({ title: "Are you sure?",text: "' . $delete_message . '",type: "warning",showCancelButton: true,confirmButtonColor: "#DD6B55",confirmButtonText: "Yes, delete it!"
        //                         }).then((result) => { if (result.value) {$("#deleteForm' . $row->id . '").submit();}})
        //                     });
        //                 </script>';

        //                 $html .= '
        //                     <form id="deleteForm' . $row->id . '" action="' . $deleteRoute . '" method="post" style="display:none">' . $csrf . $method_delete . '
        //                         <button type="submit" class="btn waves-effect waves-light btn-rounded btn-success"><i
        //                                 class="icofont icofont-check"></i> Confirm Delete</button>
        //                         <button type="button" class="btn waves-effect waves-light btn-rounded btn-secondary" data-dismiss="modal"><i
        //                                 class="fa fa-times"></i> Cancel</button>
        //                     </form>';
        //                 return $html;
        //             }
        //         )
        //         ->editColumn('banner_image', function ($row) {
        //             if ($row->banner_image != null) {
        //                 return "<img src='" . get_file_from_aws($row->banner_image) . "' width='50' height='30'/>";
        //             }
        //             return '-';
        //         });
        //     $rawColumns = ['action', 'banner_image'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.marketings.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.marketings.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'banner_title' => 'required|string|min:3',
            'banner_description' => 'required|string',
            'banner_url' => 'required|url',
            'banner_image'  => 'required|image'
        ]);

        $exist = Marketing::where(['banner_title' => $request['banner_title']])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['banner_title' => 'This banner title already exists!'])->withInput();
        }

        $marketing_uid = get_random_id('marketings', 'marketing_uid');

        $marketing = new Marketing();
        $marketing->marketing_uid = $marketing_uid;
        $marketing->banner_title = $request->banner_title;
        $marketing->banner_url = $request->banner_url;
        $marketing->banner_description = $request->banner_description;

        if (!is_null($request->banner_image)) {
            $keyName = $marketing_uid . '/' . env('KEY_MARKETING');
            $marketing->banner_image = file_upload_on_aws($request->banner_image, $keyName);
        }
        $marketing->save();

        session()->flash('success', 'Marketing has been created successfully !!');
        return redirect()->route('marketings.index');
    }

    public function edit($id)
    {
        $marketing = Marketing::find($id);

        if (is_null($marketing)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('marketings.index');
        }
        return view('admin.marketings.edit', compact('marketing'));
    }

    public function update(Request $request, $id)
    {

        $marketing = Marketing::find($id);

        if (is_null($marketing)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('marketings.index');
        }

        $request->validate([
            'banner_image'  => 'nullable|image',
            'banner_url' => 'required|url',
            'banner_title' => 'required|string',
            'banner_description' => 'required|string'
        ]);

        $exist = Marketing::where(['banner_title' => $request['banner_title']])->where('marketing_uid', '!=', $marketing->marketing_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['banner_title' => 'This banner title already exists!'])->withInput();
        }

        $marketing_uid = $marketing->marketing_uid;
        $marketing->banner_title = $request->banner_title;
        $marketing->banner_description = $request->banner_description;
        $marketing->banner_url = $request->banner_url;
        if (!is_null($request->banner_image)) {
            $keyName = $marketing_uid . '/' . env('KEY_MARKETING');
            $marketing->banner_image = file_upload_on_aws($request->banner_image, $keyName);
        }
        //        else{
        //            return redirect()->back()->withErrors(['banner_image' => 'Banner Image Can\'t be Blank'])->withInput();
        //        }
        $marketing->save();

        session()->flash('success', 'Marketing has been updated successfully !!');
        return redirect()->route('marketings.index');
    }

    public function destroy($id)
    {
        $marketing = Marketing::find($id);

        if (is_null($marketing)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('marketings.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/marketing/' . $marketing->banner_image);

        $marketing->deleted_by = auth()->id();
        $marketing->save();

        // Delete Marketing
        $marketing->delete();

        session()->flash('success', 'Marketing has been deleted permanently !!');
        return redirect()->route('marketings.index');
    }
}
