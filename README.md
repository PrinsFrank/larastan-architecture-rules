# larastan-architecture-rules

## NoHelperDependingOnBootedApplicationUsageRule

Except for a small subset of functions, most of the global helpers in laravel are dependent in some way or another on the state of a booted application. And while these functions are convenient ways to shorten the amount of code you have to write, they couple your code with the Laravel codebase. And furthermore, they decrease the testability of your codebase. This rule prevents the usage of those specific coupled helper methods, while still allowing usage of the other functions that don't rely on a booted application. for more information, see this [blog post](https://prinsfrank.nl/2022/09/20/How-to-write-decoupled-unit-tests-in-Laravel).

This rule is enabled by default. You can disable it by adding
```neon
parameters:
    disallowedHelpersDependingOnBootedApplication: false
```
to your `phpstan.neon` file.

### Examples

<details>
    <summary>Expand code sample</summary>

    The following code

    app_path();
    base_path();
    config_path();
    database_path();
    resource_path();
    public_path();
    lang_path();
    storage_path();
    resolve();
    app();
    abort_if();
    abort_unless();
    __();
    trans();
    trans_choice();
    action();
    asset();
    secure_asset();
    route();
    url();
    secure_url();
    redirect();
    to_route();
    back();
    config();
    logger();
    info();
    rescue();
    request();
    old();
    response();
    mix();
    auth();
    cookie();
    encrypt();
    decrypt();
    bcrypt();
    session();
    csrf_token();
    csrf_field();
    broadcast();
    dispatch();
    event();
    policy();
    view();
    validator();
    cache();
    env();
    abort();
    
    Will result in the following errors:
    
    Usage of the global function "app_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "path".
    Usage of the global function "base_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "basePath".
    Usage of the global function "config_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "configPath".
    Usage of the global function "database_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "databasePath".
    Usage of the global function "resource_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "resourcePath".
    Usage of the global function "public_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "publicPath".
    Usage of the global function "lang_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "langPath".
    Usage of the global function "storage_path" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "storagePath".
    Usage of the global function "resolve" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "make".
    Usage of the global function "app" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "make".
    Usage of the global function "abort_if" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "abort" within an if statement.
    Usage of the global function "abort_unless" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "abort" within an if statement.
    Usage of the global function "__" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Translation\Translator and use method "translate".
    Usage of the global function "trans" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Translation\Translator and use method "translate".
    Usage of the global function "trans_choice" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Translation\Translator and use method "choice".
    Usage of the global function "action" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Routing\UrlGenerator and use method "action".
    Usage of the global function "asset" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Routing\UrlGenerator and use method "asset".
    Usage of the global function "secure_asset" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Routing\UrlGenerator and use method "asset" with the second parameter set to "true".,
    Usage of the global function "route" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Routing\UrlGenerator and use method "route".
    Usage of the global function "url" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Routing\UrlGenerator and use method "url", "current" for the current url, "full" for the full url or "previous" for the previous url.
    Usage of the global function "secure_url" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Routing\UrlGenerator and use method "url" with the third parameter set to "true".
    Usage of the global function "redirect" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Routing\Redirector and use method "to".
    Usage of the global function "to_route" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Routing\Redirector and use method "route".
    Usage of the global function "back" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Routing\Redirector and use method "back".
    Usage of the global function "config" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Config\Repository and use method "all" or "get".
    Usage of the global function "logger" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Log\LogManager and use method "debug" or the class itself when currently called without parameters.
    Usage of the global function "info" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Log\LogManager and use method "info".
    Usage of the global function "rescue" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Debug\ExceptionHandler and use method "report" within a try-catch.
    Usage of the global function "request" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Http\Request.
    Usage of the global function "old" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Http\Request and use method "old".
    Usage of the global function "response" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Routing\ResponseFactory and use the class itself or method "make" when originally called with arguments.
    Usage of the global function "mix" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Foundation\Mix and invoke the class: "$mix()".
    Usage of the global function "auth" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Auth\Factory and use the class itself or method "guard" when originally called with arguments.
    Usage of the global function "cookie" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Cookie\Factory and use the class itself or method "make" when originally called with arguments.
    Usage of the global function "encrypt" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Encryption\Encrypter and use method "encrypt".
    Usage of the global function "decrypt" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Encryption\Encrypter and use method "decrypt".
    Usage of the global function "bcrypt" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Hashing\HashManager and use "->driver('bcrypt')->make()".
    Usage of the global function "session" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Session\SessionManager and use the class itself or method "get" when originally called with arguments.
    Usage of the global function "csrf_token" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Session\SessionManager and use method "token".
    Usage of the global function "csrf_field" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Session\SessionManager and use "new HtmlString('<input type="hidden" name="_token" value="' . $sessionManager->token() . '">')".
    Usage of the global function "broadcast" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Broadcasting\BroadcastManager and use method "event".
    Usage of the global function "dispatch" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Bus\Dispatcher and use method "dispatch".
    Usage of the global function "event" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Events\Dispatcher and use method "dispatch".
    Usage of the global function "policy" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Auth\Access\Gate and use method "getPolicyFor".
    Usage of the global function "view" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\View\Factory and use method "make".
    Usage of the global function "validator" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Validation\Factory and use method "make".
    Usage of the global function "cache" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Cache\CacheManager and use method "get".
    Usage of the global function "env" is highly dependent on a booted application and makes this code tightly coupled. Instead, Set the environment key in a configuration file so configuration caching doesn't break your application, inject Illuminate\Config\Repository and use method "get".
    Usage of the global function "abort" is highly dependent on a booted application and makes this code tightly coupled. Instead, Inject Illuminate\Contracts\Foundation\Application and use method "abort".
</details>
