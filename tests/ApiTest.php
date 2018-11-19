<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

final class ApiTest extends TestCase {

    public function test_token() {
        $token = "token";
        $status_api = new TotalVoiceStatusAPI($token);
        $this->assertEquals($token, $status_api->get_token());
    }

    public function test_host() {
        $token = "token";
        $status_api = new TotalVoiceStatusAPI($token);
        $this->assertEquals('api.totalvoice.com.br', $status_api->get_host());
    }

    public function test_get_status_request() {
        $token = "token";
        $status_api = new TotalVoiceStatusAPI($token);
        $request = $status_api->get_status();
        $this->assertEquals("GET /status HTTP/1.1\r\n", $request->get_request()[0]);
    }

}
