<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Contracts\Container\Container $container */
/** @var string $dynamicDependency */
/** @var string|'test' $partiallyDynamicDependency */

assertType('Illuminate\Contracts\Pipeline\Pipeline', $container->make('Illuminate\Contracts\Pipeline\Pipeline'));
assertType('Illuminate\Contracts\Pipeline\Pipeline', $container->make('pipeline'));
assertType('mixed', $container->make($dynamicDependency));
assertType('mixed', $container->make($partiallyDynamicDependency));

assertType('Illuminate\Contracts\Pipeline\Pipeline', $container->get('Illuminate\Contracts\Pipeline\Pipeline'));
assertType('Illuminate\Contracts\Pipeline\Pipeline', $container->get('pipeline'));
assertType('mixed', $container->get($dynamicDependency));
assertType('mixed', $container->get($partiallyDynamicDependency));

// Core
assertType('Psr\Container\ContainerInterface', $container->make('app'));
assertType('Illuminate\Contracts\Auth\Factory', $container->make('auth'));
assertType('Illuminate\Contracts\Auth\Guard', $container->make('auth.driver'));
assertType('Illuminate\View\Compilers\BladeCompiler', $container->make('blade.compiler'));
assertType('Illuminate\Contracts\Cache\Factory', $container->make('cache'));
assertType('Psr\SimpleCache\CacheInterface', $container->make('cache.store'));
assertType('Psr\Cache\CacheItemPoolInterface', $container->make('cache.psr6'));
assertType('Illuminate\Contracts\Config\Repository', $container->make('config'));
assertType('Illuminate\Contracts\Cookie\Factory', $container->make('cookie'));
assertType('Illuminate\Database\ConnectionResolverInterface', $container->make('db'));
assertType('Illuminate\Database\ConnectionInterface', $container->make('db.connection'));
assertType('Illuminate\Database\Schema\Builder', $container->make('db.schema'));
assertType('Illuminate\Contracts\Encryption\Encrypter|Illuminate\Contracts\Encryption\StringEncrypter', $container->make('encrypter'));
assertType('Illuminate\Contracts\Events\Dispatcher', $container->make('events'));
assertType('Illuminate\Filesystem\Filesystem', $container->make('files'));
assertType('Illuminate\Contracts\Filesystem\Factory', $container->make('filesystem'));
assertType('Illuminate\Contracts\Filesystem\Filesystem', $container->make('filesystem.disk'));
assertType('Illuminate\Contracts\Filesystem\Cloud', $container->make('filesystem.cloud'));
assertType('Illuminate\Hashing\HashManager', $container->make('hash'));
assertType('Illuminate\Contracts\Hashing\Hasher', $container->make('hash.driver'));
assertType('Illuminate\Contracts\Translation\Translator', $container->make('translator'));
assertType('Psr\Log\LoggerInterface', $container->make('log'));
assertType('Illuminate\Contracts\Mail\Factory', $container->make('mail.manager'));
assertType('Illuminate\Contracts\Mail\Mailer|Illuminate\Contracts\Mail\MailQueue', $container->make('mailer'));
assertType('Illuminate\Contracts\Auth\PasswordBrokerFactory', $container->make('auth.password'));
assertType('Illuminate\Contracts\Auth\PasswordBroker', $container->make('auth.password.broker'));
assertType('Illuminate\Contracts\Queue\Factory|Illuminate\Contracts\Queue\Monitor', $container->make('queue'));
assertType('Illuminate\Contracts\Queue\Queue', $container->make('queue.connection'));
assertType('Illuminate\Queue\Failed\FailedJobProviderInterface', $container->make('queue.failer'));
assertType('Illuminate\Routing\Redirector', $container->make('redirect'));
assertType('Illuminate\Contracts\Redis\Factory', $container->make('redis'));
assertType('Illuminate\Contracts\Redis\Connection|Illuminate\Redis\Connections\Connection', $container->make('redis.connection'));
assertType('Symfony\Component\HttpFoundation\Request', $container->make('request'));
assertType('Illuminate\Contracts\Routing\BindingRegistrar|Illuminate\Contracts\Routing\Registrar', $container->make('router'));
assertType('Illuminate\Session\SessionManager', $container->make('session'));
assertType('Illuminate\Contracts\Session\Session', $container->make('session.store'));
assertType('Illuminate\Contracts\Routing\UrlGenerator', $container->make('url'));
assertType('Illuminate\Contracts\Validation\Factory', $container->make('validator'));
assertType('Illuminate\Contracts\View\Factory', $container->make('view'));

assertType('Psr\Container\ContainerInterface', $container->get('app'));
assertType('Illuminate\Contracts\Auth\Factory', $container->get('auth'));
assertType('Illuminate\Contracts\Auth\Guard', $container->get('auth.driver'));
assertType('Illuminate\View\Compilers\BladeCompiler', $container->get('blade.compiler'));
assertType('Illuminate\Contracts\Cache\Factory', $container->get('cache'));
assertType('Psr\SimpleCache\CacheInterface', $container->get('cache.store'));
assertType('Psr\Cache\CacheItemPoolInterface', $container->get('cache.psr6'));
assertType('Illuminate\Contracts\Config\Repository', $container->get('config'));
assertType('Illuminate\Contracts\Cookie\Factory', $container->get('cookie'));
assertType('Illuminate\Database\ConnectionResolverInterface', $container->get('db'));
assertType('Illuminate\Database\ConnectionInterface', $container->get('db.connection'));
assertType('Illuminate\Database\Schema\Builder', $container->get('db.schema'));
assertType('Illuminate\Contracts\Encryption\Encrypter|Illuminate\Contracts\Encryption\StringEncrypter', $container->get('encrypter'));
assertType('Illuminate\Contracts\Events\Dispatcher', $container->get('events'));
assertType('Illuminate\Filesystem\Filesystem', $container->get('files'));
assertType('Illuminate\Contracts\Filesystem\Factory', $container->get('filesystem'));
assertType('Illuminate\Contracts\Filesystem\Filesystem', $container->get('filesystem.disk'));
assertType('Illuminate\Contracts\Filesystem\Cloud', $container->get('filesystem.cloud'));
assertType('Illuminate\Hashing\HashManager', $container->get('hash'));
assertType('Illuminate\Contracts\Hashing\Hasher', $container->get('hash.driver'));
assertType('Illuminate\Contracts\Translation\Translator', $container->get('translator'));
assertType('Psr\Log\LoggerInterface', $container->get('log'));
assertType('Illuminate\Contracts\Mail\Factory', $container->get('mail.manager'));
assertType('Illuminate\Contracts\Mail\Mailer|Illuminate\Contracts\Mail\MailQueue', $container->get('mailer'));
assertType('Illuminate\Contracts\Auth\PasswordBrokerFactory', $container->get('auth.password'));
assertType('Illuminate\Contracts\Auth\PasswordBroker', $container->get('auth.password.broker'));
assertType('Illuminate\Contracts\Queue\Factory|Illuminate\Contracts\Queue\Monitor', $container->get('queue'));
assertType('Illuminate\Contracts\Queue\Queue', $container->get('queue.connection'));
assertType('Illuminate\Queue\Failed\FailedJobProviderInterface', $container->get('queue.failer'));
assertType('Illuminate\Routing\Redirector', $container->get('redirect'));
assertType('Illuminate\Contracts\Redis\Factory', $container->get('redis'));
assertType('Illuminate\Contracts\Redis\Connection|Illuminate\Redis\Connections\Connection', $container->get('redis.connection'));
assertType('Symfony\Component\HttpFoundation\Request', $container->get('request'));
assertType('Illuminate\Contracts\Routing\BindingRegistrar|Illuminate\Contracts\Routing\Registrar', $container->get('router'));
assertType('Illuminate\Session\SessionManager', $container->get('session'));
assertType('Illuminate\Contracts\Session\Session', $container->get('session.store'));
assertType('Illuminate\Contracts\Routing\UrlGenerator', $container->get('url'));
assertType('Illuminate\Contracts\Validation\Factory', $container->get('validator'));
assertType('Illuminate\Contracts\View\Factory', $container->get('view'));
