<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EquipmentController extends Controller
{
    public function index()
    {
        $datas = Equipment::get();
        // if (request()->ajax()) {
        //     $equipments = Equipment::select('equipments.*');
        //     $datatable = DataTables::of($equipments)
        //         ->addIndexColumn()
        //         ->addColumn(
        //             'action',
        //             function ($row) {
        //                 $csrf = "" . csrf_field() . "";
        //                 $method_delete = "" . method_field("delete") . "";
        //                 $html = '';
        //                 $deleteRoute =  route('equipments.destroy', [$row->id]);
        //                 $html .= '<a class="btn btn-primary btn-sm me-3" equipment_name="Edit Equipment Details" href="' . route('equipments.edit', $row->id) . '"><i class="bx bx-edit"></i></a>';
        //                 $html .= '<a class="btn btn-danger btn-sm" equipment_name="Delete Equipment" id="deleteItem' . $row->id . '"><i class="bx bx-trash"></i></a>';
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
        //         ->editColumn('description', function ($row) {
        //             return $row->description ? mb_strimwidth(strip_tags($row->description), 0, 97, '...') : '';
        //             // return strip_tags($row->description);
        //         });
        //     $rawColumns = ['action', 'description'];
        //     return $datatable->rawColumns($rawColumns)->make(true);
        // }

        return view('admin.equipments.index',compact('datas'));
    }

    public function create()
    {
        return view('admin.equipments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "equipment_name" => "required|string|unique:equipments,equipment_name,NULL,id,deleted_at,NULL",
        ]);

        $equipment_uid = get_random_id('equipments', 'equipment_uid');

        $equipment = new Equipment();
        $equipment->equipment_uid = $equipment_uid;
        $equipment->equipment_name = $request->equipment_name;
        $equipment->description = $request->description ?? null;
        $equipment->save();

        session()->flash('success', 'Equipment has been created successfully !!');
        return redirect()->route('equipments.index');
    }

    public function edit($id)
    {
        $equipment = Equipment::find($id);

        if (is_null($equipment)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('equipments.index');
        }

        return view('admin.equipments.edit', compact('equipment'));
    }

    public function update(Request $request, $id)
    {
        $equipment = Equipment::find($id);

        if (is_null($equipment)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('equipments.index');
        }

        $request->validate([
            'equipment_name' => "required|string|unique:equipments,equipment_name,{$equipment->id},id,deleted_at,NULL",
        ]);

        $equipment->equipment_name = $request->equipment_name;
        $equipment->description = $request->description ?? null;
        $equipment->save();

        session()->flash('success', 'Equipment has been updated successfully !!');
        return redirect()->route('equipments.index');
    }

    public function destroy($id)
    {
        $equipment = Equipment::find($id);

        if (is_null($equipment)) {
            session()->flash('error', "The page is not found !");
            return redirect()->route('equipments.index');
        }

        $equipment->deleted_by = auth()->id();
        $equipment->save();

        // Delete Equipment
        $equipment->delete();

        session()->flash('success', 'Equipment has been deleted permanently !!');
        return redirect()->route('equipments.index');
    }
}
