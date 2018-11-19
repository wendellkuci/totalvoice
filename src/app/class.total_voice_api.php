<?php

require_once 'class.simple_request.php';

class TotalVoiceStatusAPI {

    private $token = null;
    private $host = "api.totalvoice.com.br";

    public function __construct($token) {
        $this->token = $token;
    }

    public function set_token($token) {
        return $this->token = $token;
    }

    public function get_token() {
        return $this->token;
    }

    public function set_host($host) {
        $this->host = $host;
    }

    public function get_host() {
        return $this->host;
    }

    public function get_status() {
        return $this->create_request("GET", "status");
    }

    private function create_request($method, $resource, $body = null) {
        $headers = array('Access-Token' => $this->token);
        $request = new SimpleRquest($method, $this->get_host(), $resource, $headers, $body);
        return $request;
    }

}
