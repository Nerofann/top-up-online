<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\get;

class VendorController extends Controller
{
    public function index() {
        return view('admins.vendor.add');
    }

    public function store(Request $request) {
        $validate = Validator::make($request->all(), [
            'name'          => ['required', 'string'],
            'endpoint'      => ['required', 'string'],
            'api_key'       => ['required', 'string'],
            'private_key'   => ['required', 'string'],
            'description'   => ['required', 'string'],
        ]);

        if($validate->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Validasi form gagal",
            ]);
        }

        /** Validate Name by slug */
        $searchSlug = Vendor::where('v_slug', Str::slug($request->get('name')))->first();
        if($searchSlug) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Nama Vendor sudah terdaftar",
            ]);
        }

        Vendor::create([
            'v_name'        => $request->get('name'),
            'v_description' => $request->get('description'),
            'v_api_url'     => $request->get('endpoint'),
            'v_api_key'     => $request->get('api_key'),
            'v_private_key' => $request->get('private_key'),
            'v_slug'        => Str::slug($request->get('name')),
            'created_at'    => date("Y-m-d H:i:s"),
        ]);

        return response()->json([
            'success'   => true,
            'errors'    => "",
            'message'   => "Vendor {$request->get('name')} berhasil didaftarkan",
        ]);
    }

    public function update(string $slug, Request $request) {
        $validate = Validator::make($request->all(), [
            'name'          => ['required', 'string'],
            'endpoint'      => ['required', 'string'],
            'api_key'       => ['required', 'string'],
            'private_key'   => ['required', 'string'],
            'description'   => ['required', 'string'],
        ]);

        if($validate->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Validasi form gagal",
            ]);
        }

        /** Validate Name by slug */
        $searchSlug = Vendor::where('v_slug', Str::slug($request->get('name')))->where('v_slug', '!=', $slug)->first();
        if($searchSlug) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Nama Vendor sudah terdaftar",
            ]);
        }

        Vendor::where('v_slug', $slug)->update([
            'v_name'        => $request->get('name'),
            'v_description' => $request->get('description'),
            'v_api_url'     => $request->get('endpoint'),
            'v_api_key'     => $request->get('api_key'),
            'v_private_key' => $request->get('private_key'),
            'v_slug'        => Str::slug($request->get('name')),
        ]);

        return response()->json([
            'success'   => true,
            'errors'    => "",
            'message'   => "Data vendor {$request->get('name')} berhasil diperbarui",
        ]);
    }

    public function delete($slug) {
        /** Validate Name by slug */
        $searchSlug = Vendor::where('v_slug', $slug)->first();
        if(!$searchSlug) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Vendor tidak ditemukan",
            ]);
        }

        Vendor::where('id', $searchSlug->id)->delete();

        return response()->json([
            'success'   => true,
            'errors'    => "",
            'message'   => "Vendor {$searchSlug->v_name} berhasil dihapus",
        ]);
    }

    public function data() {
        $data = [];
        foreach(Vendor::select(['v_name', 'created_at', 'v_description'])->get() as $vendor) {
            $data[] = $vendor;
        }

        return response(['data' => Vendor::get()]);
    }

    public function edit(string $slug) {
        $vendor = Vendor::where('v_slug', $slug)->first();
        if(!$vendor) {
            return redirect()->back()->with('warning', 'Invalid Vendor');
        }

        return view('admins.vendor.edit', [
            'vendor' => $vendor
        ]);
    }
}
