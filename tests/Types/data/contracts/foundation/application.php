<?php

use function PHPStan\Testing\assertType;

/** @var \Illuminate\Contracts\Foundation\Application $application */
/** @var string $dynamicDependency */
/** @var string|'test' $partiallyDynamicDependency */

assertType('Illuminate\Contracts\Pipeline\Pipeline', $application->make('Illuminate\Contracts\Pipeline\Pipeline'));
assertType('Illuminate\Contracts\Pipeline\Pipeline', $application->make('pipeline'));
assertType('mixed', $application->make($dynamicDependency));
assertType('mixed', $application->make($partiallyDynamicDependency));

assertType('Illuminate\Contracts\Pipeline\Pipeline', $application->get('Illuminate\Contracts\Pipeline\Pipeline'));
assertType('Illuminate\Contracts\Pipeline\Pipeline', $application->get('pipeline'));
assertType('mixed', $application->get($dynamicDependency));
assertType('mixed', $application->get($partiallyDynamicDependency));

// Core
assertType('Psr\Container\ContainerInterface', $application->make('app'));
assertType('Illuminate\Contracts\Auth\Factory', $application->make('auth'));
assertType('Illuminate\Contracts\Auth\Guard', $application->make('auth.driver'));
assertType('Illuminate\View\Compilers\BladeCompiler', $application->make('blade.compiler'));
assertType('Illuminate\Contracts\Cache\Factory', $application->make('cache'));
assertType('Psr\SimpleCache\CacheInterface', $application->make('cache.store'));
assertType('Psr\Cache\CacheItemPoolInterface', $application->make('cache.psr6'));
assertType('Illuminate\Contracts\Config\Repository', $application->make('config'));
assertType('Illuminate\Contracts\Cookie\Factory', $application->make('cookie'));
assertType('Illuminate\Database\ConnectionResolverInterface', $application->make('db'));
assertType('Illuminate\Database\ConnectionInterface', $application->make('db.connection'));
assertType('Illuminate\Database\Schema\Builder', $application->make('db.schema'));
assertType('Illuminate\Contracts\Encryption\Encrypter|Illuminate\Contracts\Encryption\StringEncrypter', $application->make('encrypter'));
assertType('Illuminate\Contracts\Events\Dispatcher', $application->make('events'));
assertType('Illuminate\Filesystem\Filesystem', $application->make('files'));
assertType('Illuminate\Contracts\Filesystem\Factory', $application->make('filesystem'));
assertType('Illuminate\Contracts\Filesystem\Filesystem', $application->make('filesystem.disk'));
assertType('Illuminate\Contracts\Filesystem\Cloud', $application->make('filesystem.cloud'));
assertType('Illuminate\Hashing\HashManager', $application->make('hash'));
assertType('Illuminate\Contracts\Hashing\Hasher', $application->make('hash.driver'));
assertType('Illuminate\Contracts\Translation\Translator', $application->make('translator'));
assertType('Psr\Log\LoggerInterface', $application->make('log'));
assertType('Illuminate\Contracts\Mail\Factory', $application->make('mail.manager'));
assertType('Illuminate\Contracts\Mail\Mailer|Illuminate\Contracts\Mail\MailQueue', $application->make('mailer'));
assertType('Illuminate\Contracts\Auth\PasswordBrokerFactory', $application->make('auth.password'));
assertType('Illuminate\Contracts\Auth\PasswordBroker', $application->make('auth.password.broker'));
assertType('Illuminate\Contracts\Queue\Factory|Illuminate\Contracts\Queue\Monitor', $application->make('queue'));
assertType('Illuminate\Contracts\Queue\Queue', $application->make('queue.connection'));
assertType('Illuminate\Queue\Failed\FailedJobProviderInterface', $application->make('queue.failer'));
assertType('Illuminate\Routing\Redirector', $application->make('redirect'));
assertType('Illuminate\Contracts\Redis\Factory', $application->make('redis'));
assertType('Illuminate\Contracts\Redis\Connection|Illuminate\Redis\Connections\Connection', $application->make('redis.connection'));
assertType('Symfony\Component\HttpFoundation\Request', $application->make('request'));
assertType('Illuminate\Contracts\Routing\BindingRegistrar|Illuminate\Contracts\Routing\Registrar', $application->make('router'));
assertType('Illuminate\Session\SessionManager', $application->make('session'));
assertType('Illuminate\Contracts\Session\Session', $application->make('session.store'));
assertType('Illuminate\Contracts\Routing\UrlGenerator', $application->make('url'));
assertType('Illuminate\Contracts\Validation\Factory', $application->make('validator'));
assertType('Illuminate\Contracts\View\Factory', $application->make('view'));

assertType('Psr\Container\ContainerInterface', $application->get('app'));
assertType('Illuminate\Contracts\Auth\Factory', $application->get('auth'));
assertType('Illuminate\Contracts\Auth\Guard', $application->get('auth.driver'));
assertType('Illuminate\View\Compilers\BladeCompiler', $application->get('blade.compiler'));
assertType('Illuminate\Contracts\Cache\Factory', $application->get('cache'));
assertType('Psr\SimpleCache\CacheInterface', $application->get('cache.store'));
assertType('Psr\Cache\CacheItemPoolInterface', $application->get('cache.psr6'));
assertType('Illuminate\Contracts\Config\Repository', $application->get('config'));
assertType('Illuminate\Contracts\Cookie\Factory', $application->get('cookie'));
assertType('Illuminate\Database\ConnectionResolverInterface', $application->get('db'));
assertType('Illuminate\Database\ConnectionInterface', $application->get('db.connection'));
assertType('Illuminate\Database\Schema\Builder', $application->get('db.schema'));
assertType('Illuminate\Contracts\Encryption\Encrypter|Illuminate\Contracts\Encryption\StringEncrypter', $application->get('encrypter'));
assertType('Illuminate\Contracts\Events\Dispatcher', $application->get('events'));
assertType('Illuminate\Filesystem\Filesystem', $application->get('files'));
assertType('Illuminate\Contracts\Filesystem\Factory', $application->get('filesystem'));
assertType('Illuminate\Contracts\Filesystem\Filesystem', $application->get('filesystem.disk'));
assertType('Illuminate\Contracts\Filesystem\Cloud', $application->get('filesystem.cloud'));
assertType('Illuminate\Hashing\HashManager', $application->get('hash'));
assertType('Illuminate\Contracts\Hashing\Hasher', $application->get('hash.driver'));
assertType('Illuminate\Contracts\Translation\Translator', $application->get('translator'));
assertType('Psr\Log\LoggerInterface', $application->get('log'));
assertType('Illuminate\Contracts\Mail\Factory', $application->get('mail.manager'));
assertType('Illuminate\Contracts\Mail\Mailer|Illuminate\Contracts\Mail\MailQueue', $application->get('mailer'));
assertType('Illuminate\Contracts\Auth\PasswordBrokerFactory', $application->get('auth.password'));
assertType('Illuminate\Contracts\Auth\PasswordBroker', $application->get('auth.password.broker'));
assertType('Illuminate\Contracts\Queue\Factory|Illuminate\Contracts\Queue\Monitor', $application->get('queue'));
assertType('Illuminate\Contracts\Queue\Queue', $application->get('queue.connection'));
assertType('Illuminate\Queue\Failed\FailedJobProviderInterface', $application->get('queue.failer'));
assertType('Illuminate\Routing\Redirector', $application->get('redirect'));
assertType('Illuminate\Contracts\Redis\Factory', $application->get('redis'));
assertType('Illuminate\Contracts\Redis\Connection|Illuminate\Redis\Connections\Connection', $application->get('redis.connection'));
assertType('Symfony\Component\HttpFoundation\Request', $application->get('request'));
assertType('Illuminate\Contracts\Routing\BindingRegistrar|Illuminate\Contracts\Routing\Registrar', $application->get('router'));
assertType('Illuminate\Session\SessionManager', $application->get('session'));
assertType('Illuminate\Contracts\Session\Session', $application->get('session.store'));
assertType('Illuminate\Contracts\Routing\UrlGenerator', $application->get('url'));
assertType('Illuminate\Contracts\Validation\Factory', $application->get('validator'));
assertType('Illuminate\Contracts\View\Factory', $application->get('view'));
