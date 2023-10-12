<?php

namespace Eureka\LaravelEureka\Tests;

use GuzzleHttp\Exception\GuzzleException;

class ActuatorTest extends TestCase
{
    /**
     * @throws GuzzleException
     */
    public function test_actuator()
    {
        $response = $this->http->request('GET', 'actuator');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }

    /**
     * @throws GuzzleException
     */
    public function test_actuator_health()
    {
        $response = $this->http->request('GET', 'actuator/health');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);
    }
}
