<?php

class SimpleRquest {

    private $host;
    private $request = array();
    private $socket;

    public function __construct($method, $host, $resource, $extra_headers = null, $body = null) {
        $this->host = $host;
        $this->request[] = "$method /$resource HTTP/1.1\r\n";
        $this->request[] = "Host: $host\r\n";
        if (is_array($extra_headers)) {
            foreach ($extra_headers as $key => $value) {
                $this->request[] = "$key: $value\r\n";
            }
        }
        $this->request[] = "Connection: Close\r\n\r\n";
    }

    public function get_request() {
        return $this->request;
    }

    public function send() {
        $result = array(
            'header' => array(),
            'body' => array()
        );

        try {
            $this->openSocket();
            fwrite($this->socket, $this->parse_request_to_string());
            $response_part = 'header';
            while (!feof($this->socket)) {
                $read = fgets($this->socket);
                if ($read == "\r\n") {
                    $response_part = 'body';
                    continue;
                }
                array_push($result[$response_part], $read);
            }
            $this->closeSocket();
            return $result;
        } catch (Exception $e) {
            echo print_r("Error: " . $e->getMessage());
        }
    }

    public function parse_request_to_string() {
        $parsed = '';
        foreach ($this->request as $value) {
            $parsed .= $value;
        }
        return $parsed;
    }

    private function openSocket() {
        $this->socket = fsockopen($this->host, 80, $errno, $errstr, 30);
        if (!$this->socket)
            throw new Exception("Error to open socket.");
    }

    private function closeSocket() {
        if (!$this->socket)
            throw new Exception("Error to close socket.");

        fclose($this->socket);
    }

}
