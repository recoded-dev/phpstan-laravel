<?php

use function PHPStan\Testing\assertType;

/** @var string $dynamicDependency */
/** @var string|'test' $partiallyDynamicDependency */

assertType('Illuminate\Contracts\Pipeline\Pipeline', app('Illuminate\Contracts\Pipeline\Pipeline'));
assertType('Illuminate\Contracts\Pipeline\Pipeline', app('pipeline'));
assertType('mixed', app($dynamicDependency));
assertType('mixed', app($partiallyDynamicDependency));

assertType('Illuminate\Contracts\Pipeline\Pipeline', resolve('Illuminate\Contracts\Pipeline\Pipeline'));
assertType('Illuminate\Contracts\Pipeline\Pipeline', resolve('pipeline'));
assertType('mixed', resolve($dynamicDependency));
assertType('mixed', resolve($partiallyDynamicDependency));

// Core
assertType('Psr\Container\ContainerInterface', app('app'));
assertType('Illuminate\Contracts\Auth\Factory', app('auth'));
assertType('Illuminate\Contracts\Auth\Guard', app('auth.driver'));
assertType('Illuminate\View\Compilers\BladeCompiler', app('blade.compiler'));
assertType('Illuminate\Contracts\Cache\Factory', app('cache'));
assertType('Psr\SimpleCache\CacheInterface', app('cache.store'));
assertType('Psr\Cache\CacheItemPoolInterface|Symfony\Component\Cache\Adapter\AdapterInterface|Symfony\Component\Cache\Adapter\Psr16Adapter', app('cache.psr6'));
assertType('Illuminate\Contracts\Config\Repository', app('config'));
assertType('Illuminate\Contracts\Cookie\Factory', app('cookie'));
assertType('Illuminate\Database\ConnectionResolverInterface', app('db'));
assertType('Illuminate\Database\ConnectionInterface', app('db.connection'));
assertType('Illuminate\Database\Schema\Builder', app('db.schema'));
assertType('Illuminate\Contracts\Encryption\Encrypter|Illuminate\Contracts\Encryption\StringEncrypter', app('encrypter'));
assertType('Illuminate\Contracts\Events\Dispatcher', app('events'));
assertType('Illuminate\Filesystem\Filesystem', app('files'));
assertType('Illuminate\Contracts\Filesystem\Factory', app('filesystem'));
assertType('Illuminate\Contracts\Filesystem\Filesystem', app('filesystem.disk'));
assertType('Illuminate\Contracts\Filesystem\Cloud', app('filesystem.cloud'));
assertType('Illuminate\Hashing\HashManager', app('hash'));
assertType('Illuminate\Contracts\Hashing\Hasher', app('hash.driver'));
assertType('Illuminate\Contracts\Translation\Translator', app('translator'));
assertType('Psr\Log\LoggerInterface', app('log'));
assertType('Illuminate\Contracts\Mail\Factory', app('mail.manager'));
assertType('Illuminate\Contracts\Mail\Mailer|Illuminate\Contracts\Mail\MailQueue', app('mailer'));
assertType('Illuminate\Contracts\Auth\PasswordBrokerFactory', app('auth.password'));
assertType('Illuminate\Contracts\Auth\PasswordBroker', app('auth.password.broker'));
assertType('Illuminate\Contracts\Queue\Factory|Illuminate\Contracts\Queue\Monitor', app('queue'));
assertType('Illuminate\Contracts\Queue\Queue', app('queue.connection'));
assertType('Illuminate\Queue\Failed\FailedJobProviderInterface', app('queue.failer'));
assertType('Illuminate\Routing\Redirector', app('redirect'));
assertType('Illuminate\Contracts\Redis\Factory', app('redis'));
assertType('Illuminate\Contracts\Redis\Connection|Illuminate\Redis\Connections\Connection', app('redis.connection'));
assertType('Symfony\Component\HttpFoundation\Request', app('request'));
assertType('Illuminate\Contracts\Routing\BindingRegistrar|Illuminate\Contracts\Routing\Registrar', app('router'));
assertType('Illuminate\Session\SessionManager', app('session'));
assertType('Illuminate\Contracts\Session\Session', app('session.store'));
assertType('Illuminate\Contracts\Routing\UrlGenerator', app('url'));
assertType('Illuminate\Contracts\Validation\Factory', app('validator'));
assertType('Illuminate\Contracts\View\Factory', app('view'));

assertType('Psr\Container\ContainerInterface', resolve('app'));
assertType('Illuminate\Contracts\Auth\Factory', resolve('auth'));
assertType('Illuminate\Contracts\Auth\Guard', resolve('auth.driver'));
assertType('Illuminate\View\Compilers\BladeCompiler', resolve('blade.compiler'));
assertType('Illuminate\Contracts\Cache\Factory', resolve('cache'));
assertType('Psr\SimpleCache\CacheInterface', resolve('cache.store'));
assertType('Psr\Cache\CacheItemPoolInterface|Symfony\Component\Cache\Adapter\AdapterInterface|Symfony\Component\Cache\Adapter\Psr16Adapter', resolve('cache.psr6'));
assertType('Illuminate\Contracts\Config\Repository', resolve('config'));
assertType('Illuminate\Contracts\Cookie\Factory', resolve('cookie'));
assertType('Illuminate\Database\ConnectionResolverInterface', resolve('db'));
assertType('Illuminate\Database\ConnectionInterface', resolve('db.connection'));
assertType('Illuminate\Database\Schema\Builder', resolve('db.schema'));
assertType('Illuminate\Contracts\Encryption\Encrypter|Illuminate\Contracts\Encryption\StringEncrypter', resolve('encrypter'));
assertType('Illuminate\Contracts\Events\Dispatcher', resolve('events'));
assertType('Illuminate\Filesystem\Filesystem', resolve('files'));
assertType('Illuminate\Contracts\Filesystem\Factory', resolve('filesystem'));
assertType('Illuminate\Contracts\Filesystem\Filesystem', resolve('filesystem.disk'));
assertType('Illuminate\Contracts\Filesystem\Cloud', resolve('filesystem.cloud'));
assertType('Illuminate\Hashing\HashManager', resolve('hash'));
assertType('Illuminate\Contracts\Hashing\Hasher', resolve('hash.driver'));
assertType('Illuminate\Contracts\Translation\Translator', resolve('translator'));
assertType('Psr\Log\LoggerInterface', resolve('log'));
assertType('Illuminate\Contracts\Mail\Factory', resolve('mail.manager'));
assertType('Illuminate\Contracts\Mail\Mailer|Illuminate\Contracts\Mail\MailQueue', resolve('mailer'));
assertType('Illuminate\Contracts\Auth\PasswordBrokerFactory', resolve('auth.password'));
assertType('Illuminate\Contracts\Auth\PasswordBroker', resolve('auth.password.broker'));
assertType('Illuminate\Contracts\Queue\Factory|Illuminate\Contracts\Queue\Monitor', resolve('queue'));
assertType('Illuminate\Contracts\Queue\Queue', resolve('queue.connection'));
assertType('Illuminate\Queue\Failed\FailedJobProviderInterface', resolve('queue.failer'));
assertType('Illuminate\Routing\Redirector', resolve('redirect'));
assertType('Illuminate\Contracts\Redis\Factory', resolve('redis'));
assertType('Illuminate\Contracts\Redis\Connection|Illuminate\Redis\Connections\Connection', resolve('redis.connection'));
assertType('Symfony\Component\HttpFoundation\Request', resolve('request'));
assertType('Illuminate\Contracts\Routing\BindingRegistrar|Illuminate\Contracts\Routing\Registrar', resolve('router'));
assertType('Illuminate\Session\SessionManager', resolve('session'));
assertType('Illuminate\Contracts\Session\Session', resolve('session.store'));
assertType('Illuminate\Contracts\Routing\UrlGenerator', resolve('url'));
assertType('Illuminate\Contracts\Validation\Factory', resolve('validator'));
assertType('Illuminate\Contracts\View\Factory', resolve('view'));
