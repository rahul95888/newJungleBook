<?php

namespace App\Http\Controllers\Admin;

use App\Helper\UploadHelper;
use App\Http\Controllers\Controller;
use App\Models\Commodity;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

 
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    
    public function index()
    {
        $datas  = News::get();
        // if (request()->ajax()) {
        //     $news = News::with('commodity')->select('news.*');

        //     $datatable = DataTables::of($news)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('news.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" title="Edit News Details" href="' . route('news.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" title="Delete News" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('image', function ($row) {
        //             if ($row->image != null) {
        //                 return "<img src='" . get_file_from_aws($row->image) . "' width='50' height='30'/>";
        //             }
        //             return '-';
        //         });
        //     $rawColumns = ['action', 'image'];
        //     return $datatable->rawColumns($rawColumns)
        //         ->make(true);
        // }

        return view('admin.news.index',compact('datas'));
    }

    public function create()
    {
        $commodities = Commodity::all();
        return view('admin.news.create', compact('commodities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'required|string',
            'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            'content'  => 'required',
            'image'  => 'nullable|image'
        ], [
            'commodity_uid.required' => 'Commodity is required!',
            'commodity_uid.exists' => "Commodity doesn't exists!",
        ]);
        $exist = News::where(['title' => $request->title, 'commodity_uid' => $request->commodity_uid])->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['commodity_uid' => 'This title with same commodity name already exists!'])->withInput();
        }

        try {
            DB::beginTransaction();

            $news_uid = get_random_id('news', 'news_uid');

            $news = new News();
            $news->news_uid = $news_uid;
            $news->title = $request->title;
            $news->commodity_uid = $request->commodity_uid;
            $news->content = $request->content;

            if (!is_null($request->image)) {
                $imageName = time().'.'.$request->file('image')->extension();
                request()->image->move(public_path('uploads/category'), $imageName);
                $news->image  =   $imageName;

            }
            $news->save();

            DB::commit();
            session()->flash('success', 'News has been created successfully !!');
            return redirect()->route('news.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function edit($id)
    {
        $news = News::find($id);

        if (is_null($news)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('news.index');
        }
        $commodities = Commodity::all();
        return view('admin.news.edit', compact('news', 'commodities'));
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);

        if (is_null($news)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('news.index');
        }

        $request->validate([
            'title'  => 'required|string',
            'commodity_uid'  => 'required|string|exists:commodities,commodity_uid,deleted_at,NULL',
            'content'  => 'required|string',
            'image'  => 'nullable|image'
        ], [
            'commodity_uid.required' => 'Commodity is required!',
            'commodity_uid.exists' => "Commodity doesn't exists!",
        ]);
        
        $exist = News::where(['title' => $request->title, 'commodity_uid' => $request->commodity_uid])->where('news_uid', '!=', $news->news_uid)->exists();
        if ($exist == true) {
            return redirect()->back()->withErrors(['commodity_uid' => 'This title with same commodity name already exists!'])->withInput();
        }

        try {
            DB::beginTransaction();

            $news_uid = $news->news_uid;
            $news->title = $request->title;
            $news->commodity_uid = $request->commodity_uid;
            $news->content = $request->content;

            if (!is_null($request->image)) {
                $imageName = time().'.'.$request->file('image')->extension();
                request()->image->move(public_path('uploads/category'), $imageName);
                $news->image  =   $imageName;

            }
            $news->save();
            DB::commit();
            session()->flash('success', 'News has been updated successfully !!');
            return redirect()->route('news.index');
        } catch (\Exception $e) {
            session()->flash('sticky_error', $e->getMessage());
            DB::rollBack();
            return back();
        }
    }

    public function destroy($id)
    {
        $news = News::find($id);

        if (is_null($news)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('news.index');
        }
        // Remove Image
        UploadHelper::deleteFile('assets/uploaded_images/news/' . $news->image);

        $news->deleted_by = auth()->id();
        $news->save();

        // Delete News
        $news->delete();

        session()->flash('success', 'News has been deleted permanently !!');
        return redirect()->route('news.index');
    }
}
