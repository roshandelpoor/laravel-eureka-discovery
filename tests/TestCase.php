<?php

namespace Eureka\LaravelEureka\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $http;

    public function setUp(): void
    {
        $this->http = new \GuzzleHttp\Client(['base_uri' => 'http://localhost:8000/']);
    }

    public function tearDown(): void
    {
        $this->http = null;
    }
}
