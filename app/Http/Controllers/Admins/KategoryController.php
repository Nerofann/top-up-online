<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Kategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KategoryController extends Controller
{
    public function index()
    {
        return view('admins.kategory.list', [
            'title' => "Kategori"
        ]);
    }

    public function data()
    {
        $kategory = [];
        foreach(Kategory::get() as $kat) {
            $kategory[] = [
                'id' => md5(md5($kat->id)),
                'created_at' => date("Y-m-d H:i:s", strtotime($kat->created_at)),
                'name'  => $kat->kt_name,
                'code'  => $kat->kt_code,
            ];
        }

        return response()->json([
            'data' => $kategory
        ]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->only('add_name'), [
            'add_name' => [
                'required', 
                'string', 
                function($attributes, $value, $fail) use ($request) {
                    if(Kategory::where('kt_name', strtoupper($request->get('add_name')))->first()) {
                        $fail("Nama Kategori sudah terdaftar");
                    }
                }
            ]
        ]);

        if($validate->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Incomplite Validation"
            ]);
        }

        $insert = Kategory::create([
            'kt_name' => strtoupper($request->get('add_name')),
            'kt_code' => rtrim(base64_encode($request->get('add_name')), "="),
            'created_at' => date("Y-m-d H:i:s") 
        ]);

        if(!$insert) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Gagal menyimpan kategory"
            ]);
        }

        return response()->json([
            'success'   => true,
            'errors'    => [],
            'message'   => "Kategori ".strtoupper($request->get('add_name'))." berhasil ditambahkan"
        ]);
    }

    public function edit($md5Id)
    {
        $kategory = Kategory::where(DB::raw('MD5(MD5(id))'), $md5Id)->first();
        if(!$kategory) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Kategori tidak ditemukan"
            ]);
        }

        return response()->json([
            'success'   => true,
            'errors'    => [],
            'message'   => [
                'name'  => $kategory->kt_name
            ]
        ]);
    }

    public function update(Request $request)
    {
        $validate = Validator::make($request->only(['edit_name', 'edit_id']), [
            'edit_name' => ['required', 'string', 'unique:kategories,kt_name'],
            'edit_id' => [
                'required',
                'string',
                function($attributes, $value, $fail) use ($request) {
                    if(
                        Kategory::where('kt_name', strtoupper($request->get('edit_name')))
                            ->where(DB::raw('MD5(MD5(id))'), '!=', $request->get("edit_id"))
                            ->first()
                    )
                    {
                        $fail("Nama Kategori sudah terdaftar");
                    }
                }
            ]
        ]);

        if($validate->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Incomplite Validation"
            ]);
        }

        $update = Kategory::where(DB::raw('MD5(MD5(id))'), $request->get('edit_id'))->update([
            'kt_name'   => $request->get('edit_name'),
            'kt_code'   => rtrim(base64_encode($request->get('edit_name')), "=")
        ]);
        
        if(!$update) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Gagal memperbarui nama kategory"
            ]);
        }

        return response()->json([
            'success'   => true,
            'errors'    => [],
            'message'   => "Berhasil memperbarui data"
        ]);
    }

    public function delete($md5Id)
    {
        $kategory = Kategory::where(DB::raw('MD5(MD5(id))'), $md5Id)->first();
        if(!$kategory) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Kategori tidak ditemukan"
            ]);
        }

        $delete = Kategory::where(DB::raw('MD5(MD5(id))'), $md5Id)->delete();
        if(!$delete) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Gagal menghapus kategori"
            ]);
        } 

        return response()->json([
            'success'   => true,
            'errors'    => [],
            'message'   => "Kategori berhasil dihapus"
        ]);
    }
}
