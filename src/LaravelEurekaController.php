<?php

namespace Eureka\LaravelEureka;

class LaravelEurekaController
{
    public function actuator() {
        return json_decode(json_encode([
            "run" => "up"
        ]));
    }

    public function actuator_health() {
        return json_decode(json_encode([
            "run" => "up"
        ]));
    }
}
