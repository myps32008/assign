<?php

namespace App\Http\Controllers;

use App\Objects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ObjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allMenu = Objects::with('parentMenu')->get();
        return view('object.index', compact('allMenu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    public function ajaxStore(Request $request)
    {
        try {
            $data = json_decode($request->json()->all());
            DB::table('objects')->insert($data);
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Thêm menu mới thất bại. " . $th->getMessage(),
                'status' => 400
            ]);
        }
        $lastID =DB::table('objects')->orderByDesc('id')->select('id')->first();
        return Response()->json([
            'message' => "Thêm menu mới thành công. ",
            'newID' => $lastID,
            'status' => 200
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function updateStatus(Request $request)
    {
        try {
            $menu = Objects::find($request->get('id'));
            if ($menu->status) {
                $menu->status = false;
            } else {
                $menu->status = true;
            }
            $menu->save();
            return Response()->json([
                'message' => "Cập nhật trạng thái menu" . $menu->object_name . " thành công.",
                'wish' => $menu->status,
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Cập nhật trạng thái menu thất bại. " . $th->getMessage(),
                'status' => 404
            ]);
        }
    }

    public function updateShow(Request $request)
    {
        try {
            $menu = Objects::find($request->get('id'));
            if ($menu->show_menu) {
                $menu->show_menu = false;
            } else {
                $menu->show_menu = true;
            }
            $menu->save();
            return Response()->json([
                'message' => "Cập nhật trạng thái menu" . $menu->object_name . " thành công.",
                'wish' => $menu->show_menu,
                'status' => 200
            ]);
        } catch (\Throwable $th) {
            return Response()->json([
                'message' => "Cập nhật trạng thái menu thất bại. " . $th->getMessage(),
                'status' => 404
            ]);
        }
    }
}
