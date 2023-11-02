<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\Pop;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PopController extends Controller
{
    public function index()
    {
        $datas = Pop::orderBy('id', 'desc')->get();
        // if (request()->ajax()) {
        //     $pops = Pop::orderBy('id', 'desc')->get();

        //     $datatable = DataTables::of($pops)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('pops.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit POP Details" href="' . route('pops.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete POP" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('title', function ($row) {
        //             return $row->title;
        //         })
        //         ->editColumn('commodity_uid', function ($row) {
        //             return $row->commodity ? $row->commodity->name : '';
        //         })
        //         ->editColumn('section_uid', function ($row) {
        //             return $row->section ? $row->section->name : '';
        //         })
        //         ->editColumn('image', function ($row) {
        //             if ($row->image != null) {
        //                 return "<img src='" . asset('assets/uploaded_images/pops/' . $row->image) . "' width='50' height='30'/>";
        //             }
        //             return '-';
        //         });
        //     $rawColumns = ['action', 'title', 'commodity_uid', 'section_uid', 'image'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.pops.index',compact('datas'));
    }

    public function create()
    {
        $sections = Section::all();
        $commodities = Commodity::all();
        return view('admin.pops.create', compact('commodities', 'sections'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title'  => 'required|string',      
                'content'  => 'required|string',
                'image'  => 'nullable|file|mimes:jpg,png,jpeg,bmp',
            ],
           
        );
         
         
        
        try {
            DB::beginTransaction();

            $pop_uid = get_random_id('pops', 'pop_uid');

            $pop = new Pop();
            $pop->pop_uid = $pop_uid;
            $pop->title = $request->title;
            $pop->content = $request->content;
            if (!is_null($request->image)) {
                $imageName = time().'.'.$request->file('image')->extension();
                request()->image->move(public_path('uploads/slider'), $imageName);
                $pop->image  =   $imageName;

            }


            $pop->save();

            

            DB::commit();
            session()->flash('success', 'Slider has been created successfully !!');
            return redirect()->route('pops.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $pop = Pop::find($id);

        if (is_null($pop)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pops.index');
        }
        $sections = Section::all();
        $commodities = Commodity::all();
        return view('admin.pops.edit', compact('pop', 'commodities', 'sections'));
    }

    public function update(Request $request, $id)
    {
        $pop = Pop::find($id);

        if (is_null($pop)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pops.index');
        }

        $request->validate(
            [
                'title'  => 'required|string',
                'content'  => 'required|string',
                'image'  => 'nullable|image',
            ],
             
        );
         
        try {
            DB::beginTransaction();

            $pop->title = $request->title;
            $pop->content = $request->content;

             
            if($request->hasfile('image')){
                $name = rand().'.'.$request->file('image')->extension();
                $request->file('image')->move(public_path('uploads/property'), $name);  
                $pop->image = $name;
             }

             
            $pop->save();

            

            DB::commit();
            session()->flash('success', 'Testimonial has been updated successfully !!');
            return redirect()->route('pops.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $pop = Pop::find($id);

        if (is_null($pop)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('pops.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/pops/' . $pop->image);

        $pop->deleted_by = auth()->id();
        $pop->save();

        // Delete Pop
        $pop->delete();

        session()->flash('success', 'POP has been deleted permanently !!');
        return redirect()->route('pops.index');
    }
}
