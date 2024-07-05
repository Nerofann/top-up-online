<?php

use App\Models\Kategory;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Vendor;
use App\Services\ApiTokoVoucher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::post('/kategory', function(Kategory $kategory) {
    $data = [];
    foreach($kategory::with('providers')->get() as $kat) {
        foreach($kat->providers as $prov) {
            $prov->pv_image = env('APP_URL') . Storage::url($prov->pv_image);
            $prov->pv_banner = env('APP_URL') . Storage::url($prov->pv_banner);
        }
        
        $data[] = $kat;
    }

    $response = [
        'success'   => true,
        'message'   => "Data Found",
        'data'      => $data
    ];

    return response($response, 200);
});

Route::post('/product/{pv_slug?}', function(?string $pv_slug = "-" , Provider $provider, Product $product) {
    $detailProvider = $provider::select()->with('kategory')->where('pv_slug', $pv_slug)->first();
    $products       = $product::where('provider_id', $detailProvider->id)->get();

    $response = [
        'success'   => true,
        'message'   => "Data Found",
        'data'      => [
            'provider'  => [
                'id'        => $detailProvider->id,
                'pv_code'   => $detailProvider->pv_code,
                'pv_name'   => $detailProvider->pv_name,
                'pv_dev'    => $detailProvider->pv_dev,
                'pv_image'  => Storage::url($detailProvider->pv_image),
                'pv_banner' => Storage::url($detailProvider->pv_banner)
            ],
            'kategori'  => $detailProvider->kategory,
            'products'  => $products->groupBy('type')
        ]
    ];

    return response($response, 200);
});


Route::get('/listProduk', function(ApiTokoVoucher $apiTokoVoucher) {
    $list = $apiTokoVoucher->get('produk', ['kode' => "CTA_"]);
    $data = [];
    foreach($list->data as $l) {
        // print_r($l);
        // [id] => 4385
        // [code] => MLBBWP
        // [category_name] => Topup Game
        // [operator_produk] => Mobile Legend
        // [jenis_name] => Mobile Legend New
        // [nama_produk] => Weekly Diamond Pass
        // [deskripsi] =>  
        // [price] => 26500
        // [status] => 1
        
        $status = ($l->status == 1)? "tersedia" : "gangguan";
        $searchProvider = Provider::where('pv_slug', Str::slug($l->operator_produk))->first();
        if(!$searchProvider) {
            continue;
        }

        if($status == "gangguan") {
            continue;
        }
        
        // if(strpos($l->operator_produk, "Azur") === FALSE) {
        //     continue;
        // }


        if(!Product::where('code', $l->code)->first()) {
            $data[] = [
                'vendor_id'     => 1,
                'provider_id'   => $searchProvider->id,
                'type'          => "crystals",
                'name'          => $l->nama_produk,
                'description'   => $l->deskripsi,
                'price_vendor'  => $l->price,
                'price_real'    => $l->price + 50,
                'price_discount'=> 0,
                'code'          => $l->code,
                // 'extra'         => "",
                'published'     => "52f97cea-3a2e-4688-b45f-c72a84985cf5",
                // 'instructions'  => ,
                // 'icon'          => $filename,
                'status'        => $status
            ];
        }
    }

    usort($data, function($arr, $arr2) {
        return $arr['price_vendor'] <=> $arr2['price_vendor'];
    });

    Product::insert($data);

    return $data;
    // return response()->json($list);
});
// Route::get('/provider/{kt_code}', function($kt_code, Kategory $kategory, Provider $provider) {
//     echo $kt_code;
//     $whereKategory = Kategory::select('id')->where('kt_code', $kt_code);
//     $provider = Provider::select(['pv_code', 'pv_name', 'pv_image', 'pv_slug'])
//     ->where('pv_kategoryid', $whereKategory)
//     ->toSql();

//     dd($provider);

//     return response([
//         'success'   => true,
//         'message'   => "Data Found",
//         'data'      => $provider->toArray()
//     ]);
// });
