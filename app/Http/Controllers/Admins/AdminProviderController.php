<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Kategory;
use App\Models\Provider;
use App\Services\AppGlobals;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminProviderController extends Controller
{
    public function __construct(public AppGlobals $appGlobals) {
        
    }

    public function index()
    {
        return view('admins.providers.list', [
            'title' => "Providers",
            'providers' => Provider::with('kategory')->get()
        ]);
    }

    public function data()
    {
        $provider   = [];
        foreach(Provider::with('kategory')->get() as $pro) {
            $provider[] = [
                'pv_slug'   => $pro->pv_slug,
                'created_at' => date("Y-m-d H:i:s", strtotime($pro->created_at)),
                'kategory' => $pro->kategory->kt_name,
                'pv_code' => $pro->pv_code,
                'pv_name' => $pro->pv_name,
                'pv_image' => Storage::url($pro->pv_image)
            ];
        }

        return response()->json([
            'data'  => $provider
        ]);
    }
    
    public function create() 
    {
        return view('admins.providers.add', [
            'kategory' => Kategory::get(),
        ]);
    }

    public function edit($code) 
    {
        $provider = Provider::where('pv_slug', $code)->first();
        if(!$provider) {
            return redirect()->to('/provider')->with('danger', 'Provider tidak ditemukan');
        }

        return view('admins.providers.edit', [
            'title' => "Update Provider",
            'provider' => $provider,
            'kategory' => Kategory::get(),
        ]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->only(['prov_kategory', 'prov_code', 'prov_nama', 'prov_dev']), [
            'prov_kategory' => ['required', 'exists:kategories,id'],
            'prov_code'     => ['required', 'string', 'unique:providers,pv_code'],
            'prov_nama'     => ['required', 'string'],
            'prov_dev'      => ['required', 'string']
        ]);

        if($validate->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Incomplete FormData",
            ]);
        }

        if(empty($request->file('prov_image'))) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Mohon upload foto provider",
            ]);
        }

        if(empty($request->file('prov_banner'))) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Mohon upload foto banner",
            ]);
        }

        /**Upload Foto Produk */
        $storeFotoProvider  = $request->file('prov_image')->storePublicly('public/products/provider');
        if(!$storeFotoProvider) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Gagal upload foto produk",
            ]);
        }

        /**Upload Foto Banner */
        $storeFotoBanner = $request->file('prov_banner')->storePublicly('public/products/banner');
        if(!$storeFotoBanner) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->errors(),
                'message'   => "Gagal upload foto banner",
            ]);
        }

        $insert = Provider::create([
            'pv_kategoryid' => $request->get('prov_kategory'),
            'pv_code'       => $request->get('prov_code'),
            'pv_name'       => $request->get('prov_nama'),
            'pv_dev'        => $request->get('prov_dev'),
            'pv_image'      => $storeFotoProvider,
            'pv_banner'     => $storeFotoBanner,
            'pv_slug'       => Str::slug($request->get('prov_code')),
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'success'   => true,
            'errors'    => [],
            'message'   => "Berhasil menambahkan provider",
        ]);
        return redirect()->back()->with('success', "");
    }

    public function update($slug, Request $request)
    {
        $update_array = [];
        $validate = Validator::make($request->only(['prov_kategory', 'prov_code', 'prov_nama', 'prov_dev']), [
            'prov_kategory' => ['required', 'exists:kategories,id'],
            'prov_code'     => [
                'required', 
                'string', 
                function($attribute, $value, $fail) use ($request, $slug) {
                    if(Provider::where('pv_code', $request->get('prov_code'))->where('pv_slug', '!=', $slug)->first()) {
                        $fail("Provider code sudah digunakan / terdaftar");
                    }
                }
            ],
            'prov_nama'     => ['required', 'string'],
            'prov_dev'      => ['required', 'string']
        ]);

        if($validate->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(),
                'message'   => "Incomplete Validation",
            ]);
        }

        $provider   = Provider::where('pv_slug', $slug)->first();
        if(!$provider) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Invalid Provider",
            ]);
        }

        if(!empty($request->file('prov_image'))) {
            /**Upload Foto Produk */
            $file   = $request->file('prov_image');
            $storeFotoProvider  = $file->storeAs('public/products/provider', Str::slug($request->get('prov_code')) . "." . $file->getClientOriginalExtension());
            if(!$storeFotoProvider) {
                return response()->json([
                    'success'   => false,
                    'errors'    => [],
                    'message'   => "Gagal upload foto produk",
                ]);
            }

            Storage::delete($provider->pv_image);
            $update_array = array_merge($update_array, ['pv_image' => $storeFotoProvider]);
        }

        if(!empty($request->file('prov_banner'))) {
            /**Upload Foto Banner */
            $file   = $request->file('prov_banner');
            $storeFotoBanner = $file->storeAs('public/products/banner', Str::slug($request->get('prov_code')) . "." . $file->getClientOriginalExtension());
            if(!$storeFotoBanner) {
                return response()->json([
                    'success'   => false,
                    'errors'    => [],
                    'message'   => "Gagal upload foto banner",
                ]);
            }

            Storage::delete($provider->pv_banner);
            $update_array = array_merge($update_array, ['pv_banner' => $storeFotoBanner]);
        }
        
        $update_array = array_merge($update_array, [
            'pv_kategoryid' => $request->get('prov_kategory'),
            'pv_code'       => $request->get('prov_code'),
            'pv_name'       => $request->get('prov_nama'),
            'pv_dev'        => $request->get('prov_dev'),
            'pv_slug'       => Str::slug($request->get('prov_code')),
            'created_at'    => date('Y-m-d H:i:s')
        ]);

        Provider::where('pv_slug', $slug)->update($update_array);

        return response()->json([
            'success'   => true,
            'errors'    => [],
            'message'   => "Berhasil memperbarui data provider: ".$provider->pv_name,
        ]);
    }

    public function delete($slug, Request $request)
    {
        $provider = Provider::where('pv_slug', $slug)->first();
        if(!$provider) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Invalid Provider",
            ]);
        }
        
        $delete = Provider::where('id', $provider->id)->delete();
        if(!$delete) {
            return response()->json([
                'success'   => false,
                'errors'    => [],
                'message'   => "Gagal menghapus provider",
            ]);
        }

        return response()->json([
            'success'   => true,
            'errors'    => [],
            'message'   => "Provider berhasil dihapus",
        ]);
    }
}