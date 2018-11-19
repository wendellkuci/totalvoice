<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;

final class RequestTest extends TestCase {

    public function test_get_mehtod() {
        $request = new SimpleRquest('GET', 'api.totalvoice.com.br', 'resource');
        $this->assertEquals("GET /resource HTTP/1.1\r\n", $request->get_request()[0]);
    }

    public function test_access_token() {
        $headers = array('Access-Token' => 'token');
        $request = new SimpleRquest('GET', 'api.totalvoice.com.br', 'resource', $headers);
        $this->assertContains("Access-Token: token\r\n", $request->get_request());
    }

    public function test_host() {
        $request = new SimpleRquest('GET', 'api.totalvoice.com.br', '/status');
        $this->assertContains("Host: api.totalvoice.com.br\r\n", $request->get_request());
    }

    public function test_parse_request_to_string() {
        $result = "GET /resource HTTP/1.1\r\nHost: api.totalvoice.com.br\r\nAccess-Token: token\r\nConnection: Close\r\n\r\n";
        $headers = array('Access-Token' => 'token');
        $request = new SimpleRquest('GET', 'api.totalvoice.com.br', 'resource', $headers);
        $this->assertContains($result, $request->parse_request_to_string());
    }

}
