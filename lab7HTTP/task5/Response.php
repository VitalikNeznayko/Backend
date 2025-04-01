<?php
class Response
{
    private int $statusCode;
    private array $headers = [];

    public function setStatus(int $code): void
    {
        $this->statusCode = $code;
        header("HTTP/1.1 $code");
    }

    public function addHeader(string $header): void
    {
        $this->headers[] = $header;
    }

    public function send(string $content): void
    {
        ob_start(); 
        ob_clean();

        foreach ($this->headers as $header) {
            header($header);
        }

        echo $content;
        ob_end_flush(); 
    }
}

