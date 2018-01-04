<p align="center"><h1 align="center">Ripple Admin Package</h1></p>
<p align="center">

<a href="https://packagist.org/packages/ypc/ripple"><img src="https://poser.pugx.org/yp-code/ripple/v/stable" alt=""></a>
<a href="https://packagist.org/packages/ypc/ripple"><img src="https://poser.pugx.org/yp-code/ripple/v/unstable" alt=""></a>
<a href="https://packagist.org/packages/ypc/ripple"><img src="https://poser.pugx.org/yp-code/ripple/downloads" alt=""></a>
<a href="https://packagist.org/packages/ypc/ripple"><img src="https://poser.pugx.org/yp-code/ripple/license" alt=""></a>
</p>

# Ripple

<strong>Ripple</strong> is a <strong>Laravel Admin Package</strong> that includes BREAD(CRUD), Operations, View Generator, Executing Artisan Commands and much more.
<hr>
Ripple Admin Panel & BREAD System, made for laravel 5.3 to 5.5.

After creating your laravel application you can add Ripple Admin Panel to your Application with the following command
```
composer require ypc/ripple:"dev-dev"
```

After installing Ripple Make sure you have running database connection that you can create by setting up your database details in your <code>.env</code> file

If your application is running below laravel v5.5 then you have to add <strong>Ripple Service Provider</strong> in your <code>config/app.php</code> file in the <code>providers</code> array.

```php

'providers' => [
    // Laravel Framework Service Providers...
    //...
    
    // Package Service Providers
    YPC\Ripple\Providers\RippleServiceProvider::class,
    // ...
    
    // Application Service Providers
    // ...
],

```

If your <code>Laravel</code> version is <code>5.5</code> then don't follow above process Laravel will auto discover the Ripple Admin Package.

Before using Ripple Admin Package we suggest you to run these commands : -

```
php artisan ripple:install
```

<code>ripple:install</code> command will copy all neccessary config files and assets to your public and config directory that will help to run our Admin Package without any errors.

<code>
as now Ripple is under development process so we suggest you not to install it in your Laravel Application we are releasing it's first beta version very soon.
</code>


