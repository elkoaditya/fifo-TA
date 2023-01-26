<?php
namespace App\Helper;
use http\Message\Body;
use Illuminate\Support\Facades\Http;

class ApiClient {
    protected $host;
    protected $api;

    public function __construct($host, $header) {
        $this->host = $host;
        $this->api = Http::withHeaders($header)->withOptions(['verify' => false]);
    }
    public function get($url, $body = []) {
        $response = $this->api->withBody(json_encode($body),  'application/json')->get($this->host.$url);
        return json_decode($response->body());
    }

}
