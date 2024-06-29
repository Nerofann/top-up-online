<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use stdClass;

class ApiTokoVoucherImplement implements ApiTokoVoucher {
    public $memberCode  = "M240520UBTO6733IU";
    public $signature   = "62918125c94021fbfc8710afeec79751";


    public function endpoint(): string
    {
        return "https://api.tokovoucher.id/";
    }

    private function checkKey(array $keys, array|object $data)
    {
        foreach($keys as $key) {
            if(is_array($data)) {
                if(!array_key_exists($key, $data)) {
                    return "Key not exists: {$key}";
                }
            
            } else if(is_object($data)) {
                if(!property_exists($data, $key)) {
                    return "Property not exists: {$key}";
                }
            }
        }

        return true;
    }

    public function get(string $query, array $data, $create = false):object
    {
        $data['member_code']    = $this->memberCode;
        $data['signature']      = $this->signature;
        
        try {
            $url        = $this->endpoint() . $query . "/code?";
            $response   = Http::connectTimeout(20)->timeout(10)->acceptJson()->get($url, $data);            
            $products   = $response->object();

            if($create) {
                $filename   = "public/TKV-".$data['kode'].".json";
                Storage::delete([$filename]); 
                Storage::append($filename, json_encode($products->data, JSON_PRETTY_PRINT));
            }


            if($response->clientError()) {
                return (object) [
                    'success'   => false,
                    'message'   => (!app()->environment(['production'])) ?  $response->body() : '[CLIENT_ERROR] Client return errors',
                    'data'      => [] 
                ];
            }

            if ($response->serverError()) {
                return (object) [
                    'success'   => false,
                    'message'   => (!app()->environment(['production'])) ?  $response->body() : '[SERVER_ERROR] Server is returning errors',
                    'data'      => []
                ];
            }

            if(!is_object($products)) {
                return (object) [
                    'success'   => false,
                    'message'   => "Invalid Response",
                    'data'      => []
                ];
            }
            
            $checkKey   = $this->checkKey(['status', 'rc', 'message', 'data'], $products);
            if($checkKey !== TRUE) {
                return (object) [
                    'success'   => false,
                    'message'   => $checkKey ?? "Invalid Key",
                    'data'      => []
                ];
            }

            return (object) [
                'success'   => true,
                'message'   => $products->message,
                'data'      => $products->data
            ];


        } catch (\Illuminate\Http\Client\ConnectionException $c) {
            return (object) [
                'success'   => true,
                'message'   => (!app()->environment(['production']))? $c->getMessage() : $c->getCode(),
                'data'      => []
            ];
        }
    }
}