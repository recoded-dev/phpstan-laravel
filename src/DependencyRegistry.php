<?php

declare(strict_types=1);

namespace Recoded\PHPStanLaravel;

use PHPStan\PhpDoc\TypeStringResolver;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;

final class DependencyRegistry
{
    /**
     * @see \Illuminate\Foundation\Application::registerCoreContainerAliases()
     * @const array<string, list<class-string>>
     */
    private const CORE_DEPENDENCIES = [
        //<editor-fold desc="Core dependencies">
        'app' => [\Illuminate\Foundation\Application::class, \Illuminate\Contracts\Container\Container::class, \Illuminate\Contracts\Foundation\Application::class, \Psr\Container\ContainerInterface::class],
        'auth' => [\Illuminate\Auth\AuthManager::class, \Illuminate\Contracts\Auth\Factory::class],
        'auth.driver' => [\Illuminate\Contracts\Auth\Guard::class],
        'blade.compiler' => [\Illuminate\View\Compilers\BladeCompiler::class],
        'cache' => [\Illuminate\Cache\CacheManager::class, \Illuminate\Contracts\Cache\Factory::class],
        'cache.store' => [\Illuminate\Cache\Repository::class, \Illuminate\Contracts\Cache\Repository::class, \Psr\SimpleCache\CacheInterface::class],
        'cache.psr6' => [\Symfony\Component\Cache\Adapter\Psr16Adapter::class, \Symfony\Component\Cache\Adapter\AdapterInterface::class, \Psr\Cache\CacheItemPoolInterface::class],
        'config' => [\Illuminate\Config\Repository::class, \Illuminate\Contracts\Config\Repository::class],
        'cookie' => [\Illuminate\Cookie\CookieJar::class, \Illuminate\Contracts\Cookie\Factory::class, \Illuminate\Contracts\Cookie\QueueingFactory::class],
        'db' => [\Illuminate\Database\DatabaseManager::class, \Illuminate\Database\ConnectionResolverInterface::class],
        'db.connection' => [\Illuminate\Database\Connection::class, \Illuminate\Database\ConnectionInterface::class],
        'db.schema' => [\Illuminate\Database\Schema\Builder::class],
        'encrypter' => [\Illuminate\Encryption\Encrypter::class, \Illuminate\Contracts\Encryption\Encrypter::class, \Illuminate\Contracts\Encryption\StringEncrypter::class],
        'events' => [\Illuminate\Events\Dispatcher::class, \Illuminate\Contracts\Events\Dispatcher::class],
        'files' => [\Illuminate\Filesystem\Filesystem::class],
        'filesystem' => [\Illuminate\Filesystem\FilesystemManager::class, \Illuminate\Contracts\Filesystem\Factory::class],
        'filesystem.disk' => [\Illuminate\Contracts\Filesystem\Filesystem::class],
        'filesystem.cloud' => [\Illuminate\Contracts\Filesystem\Cloud::class],
        'hash' => [\Illuminate\Hashing\HashManager::class],
        'hash.driver' => [\Illuminate\Contracts\Hashing\Hasher::class],
        'translator' => [\Illuminate\Translation\Translator::class, \Illuminate\Contracts\Translation\Translator::class],
        'log' => [\Illuminate\Log\LogManager::class, \Psr\Log\LoggerInterface::class],
        'mail.manager' => [\Illuminate\Mail\MailManager::class, \Illuminate\Contracts\Mail\Factory::class],
        'mailer' => [\Illuminate\Mail\Mailer::class, \Illuminate\Contracts\Mail\Mailer::class, \Illuminate\Contracts\Mail\MailQueue::class],
        'auth.password' => [\Illuminate\Auth\Passwords\PasswordBrokerManager::class, \Illuminate\Contracts\Auth\PasswordBrokerFactory::class],
        'auth.password.broker' => [\Illuminate\Auth\Passwords\PasswordBroker::class, \Illuminate\Contracts\Auth\PasswordBroker::class],
        'queue' => [\Illuminate\Queue\QueueManager::class, \Illuminate\Contracts\Queue\Factory::class, \Illuminate\Contracts\Queue\Monitor::class],
        'queue.connection' => [\Illuminate\Contracts\Queue\Queue::class],
        'queue.failer' => [\Illuminate\Queue\Failed\FailedJobProviderInterface::class],
        'redirect' => [\Illuminate\Routing\Redirector::class],
        'redis' => [\Illuminate\Redis\RedisManager::class, \Illuminate\Contracts\Redis\Factory::class],
        'redis.connection' => [\Illuminate\Redis\Connections\Connection::class, \Illuminate\Contracts\Redis\Connection::class],
        'request' => [\Illuminate\Http\Request::class, \Symfony\Component\HttpFoundation\Request::class],
        'router' => [\Illuminate\Routing\Router::class, \Illuminate\Contracts\Routing\Registrar::class, \Illuminate\Contracts\Routing\BindingRegistrar::class],
        'session' => [\Illuminate\Session\SessionManager::class],
        'session.store' => [\Illuminate\Session\Store::class, \Illuminate\Contracts\Session\Session::class],
        'url' => [\Illuminate\Routing\UrlGenerator::class, \Illuminate\Contracts\Routing\UrlGenerator::class],
        'validator' => [\Illuminate\Validation\Factory::class, \Illuminate\Contracts\Validation\Factory::class],
        'view' => [\Illuminate\View\Factory::class, \Illuminate\Contracts\View\Factory::class],
        //</editor-fold>
    ];

    /**
     * Create a new DependencyRegistry instance.
     *
     * @param \PHPStan\PhpDoc\TypeStringResolver $typeStringResolver
     * @param array<string, string> $customBindings
     * @return void
     */
    public function __construct(
        private TypeStringResolver $typeStringResolver,
        private array $customBindings,
    ) {
        //
    }

    /**
     * Get type of dependency.
     *
     * @param string $dependency
     * @return \PHPStan\Type\Type|null
     */
    public function get(string $dependency): ?Type
    {
        if (isset($this->customBindings[$dependency])) {
            return $this->typeStringResolver->resolve(
                $this->customBindings[$dependency],
            );
        }

        if (!isset(self::CORE_DEPENDENCIES[$dependency])) {
            return null;
        }

        $core = self::CORE_DEPENDENCIES[$dependency];

        $resolved = array_map(fn (string $class) => $this->typeStringResolver->resolve($class), $core);

        return TypeCombinator::union(...$resolved);
    }
}
