<?php

namespace App\Providers;

use App\Helper\ApiClient;
use http\Env;
use Illuminate\Support\Facades\Http;

class Scm {
    protected $api;
    public function __construct() {
        $this->api = new ApiClient('https://scm.elco.systems/api/v1', [
            'api-key' => 'agsodfjg203ng0imaksdmg109fmlasd'
        ]);
    }


    public function fullstack() {
        try {

            $res = $this->api->get('/fullstack/check', [
                'appKey' => \Illuminate\Support\Env::get('APP_KEY'),
                'hostname' => request()->getHost(),
            ]);
            return $res->data->status == 'active';
        } catch (\Exception $err) {
            dd($err);
        }
    }
}
