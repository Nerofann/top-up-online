<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class AdminProductController extends Controller
{
    public function index()
    {
        return view("admins.products.list", [
            'title' => "List Product",
            'heading' => "List Product"
        ]);
    }

    public function create(Product $product) {
        $icons = [];
        foreach(Storage::files('public/products/icon') as $icon) {
            $icons[] = Str::replace('public/products/icon/', '', $icon);
        }

        return view("admins.products.add", [
            'providers' => Provider::get(),
            'vendors'   => Vendor::get(),
            'types'     => Product::select('type')->groupBy('type')->get(),
            'icons'     => $icons
        ]);
    }

    public function store(Request $request, Product $product) {
        $validate = Validator::make($request->all(), [
            'vendor_id'         => ['required', 'numeric', 'exists:kategories,id'],
            'provider_id'       => ['required', 'numeric', 'exists:providers,id'],
            'type'              => ['required', 'string'],
            'name'              => ['required', 'string'],
            'price_vendor'      => ['required', 'numeric'],
            'price_real'        => ['required', 'numeric'],
            'price_discount'    => ['required', 'numeric'],
            'code'              => ['required', 'unique:products,code'],
            'extra'             => ['required'],
            'status'            => ['required', 'numeric', Rule::in([1, 2])],
        ]);

        if($validate->fails()) {
            return response()->json([
                'success'   => false,
                'errors'    => $validate->getMessageBag()->toArray(), 
                'message'   => "Validasi gagal, mohon cek kembali"
            ]);
        }

        $filename = $request->get('icon');
        if(!empty($request->file('icon-baru'))) {
            $provider = Provider::where('id', $request->get('provider_id'))->first();
            $filename = Str::slug($request->get('type')." ". $provider->pv_name) . "." . $request->file('icon-baru')->extension(); 
            if(!Storage::fileExists("public/products/icon/$filename")) {
                // $iconValidator = $request->validate(['icon-baru' => 'mimes:png,svg']);
                // print_r($iconValidator);
                // die;
    
                $uploadIcon = $request->file('icon-baru')->storePubliclyAs('public/products/icon', $filename);
                if(!$uploadIcon) {
                    return response()->json([
                        'success'   => false,
                        'errors'    => [], 
                        'message'   => "File gagal diupload, mohon coba lagi"
                    ]);
                }

                $filename = $uploadIcon;
            }
        }

        Product::create([
            'vendor_id'     => $request->get('vendor_id'),
            'provider_id'   => $request->get('provider_id'),
            'type'          => $request->get('type'),
            'name'          => $request->get('name'),
            'description'   => $request->get('description'),
            'price_vendor'  => $request->get('price_vendor'),
            'price_real'    => $request->get('price_real'),
            'price_discount'=> $request->get('price_discount'),
            'code'          => $request->get('code'),
            'extra'         => $request->get('extra'),
            'published'     => Auth::user()->uuid,
            'instructions'  => $request->get('instructions'),
            'icon'          => $filename,
            'status'        => ($request->get('status') == 1)? "tersedia" : "gangguan"
        ]);

        return response()->json([
            'success'   => true,
            'errors'    => [], 
            'message'   => "Product berhasil disimpan"
        ]);
    }

    public function getListProduct()
    {
        $result     = [];
        $columns    = ['*', 'products.type as product_type'];
        $products   = Product::select($columns)->with(['product_vendor', 'provider', 'product_published'])->get();

        foreach($products as $product) {
            $result[] = [
                'id'        => $product->id,
                'provider'  => $product->provider->pv_name,
                'code'      => $product->code,
                'type'      => $product->product_type,
                'product'   => $product->name ,
                'price_vendor' => "Rp ".number_format($product->price_vendor),
                'price_real' => "Rp ".number_format($product->price_real),
                'price_discount' => "Rp ".number_format($product->price_discount),
                'published' => ($product->product_published->first_name)
            ];
        }

        return response()->json([
            "data"              => $result
        ]);
    }
}
