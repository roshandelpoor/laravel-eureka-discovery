# Register Laravel In Eureka (Netflix Eureka Spring Cloud)
This Package is a library that interacts with the Eureka Server to register, deregister, and discover other services. ( Spring Boot - Eureka Server is an application that holds the information about all client-service applications. Every Micro service will register into the Eureka server and Eureka server knows all the client applications running on each port and IP address. Eureka Server is also known as Discovery Server.)


# Installation
You can install this package using [Composer]:
```bash
composer require "roshandelpoor/laravel-eureka-discovery":"dev-main"
```

For Laravel <= 5.6 Add to your "providers" array in config/app.php this line:
```angular2html
roshandelpoor\Eureka\LaravelEureka\LaravelEurekaServiceProvider::class
```

# Documentation
## SetUp And Use it

```php

Your environment should provide variables:
    APP_URL=http://127.0.0.1:8000
    EUREKA_URL=http://localhost:8761/myeureka
    

Finally :: enable [ php artisan schedule:work ] 
    in your app that it is register your app in eureka every 60 second


enjoy it
```


# Contributing
If you find any bugs or have suggestions for new features, feel free to open an issue or submit a pull request on
GitHub.


# License
Super Tools is open-source software licensed under the MIT license.


## Laravel Package Boilerplate
This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
