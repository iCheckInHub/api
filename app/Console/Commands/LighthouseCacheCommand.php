<?php

namespace App\Console\Commands;

use App\Providers\MultiLighthouseServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use Nuwave\Lighthouse\Console\CacheCommand;
use Nuwave\Lighthouse\Schema\AST\ASTBuilder;
use Nuwave\Lighthouse\Schema\AST\ASTCache;
use Nuwave\Lighthouse\Schema\DirectiveLocator;
use Nuwave\Lighthouse\Schema\Source\SchemaSourceProvider;
use Nuwave\Lighthouse\Schema\Source\SchemaStitcher;

class LighthouseCacheCommand extends CacheCommand
{
  /**
   * The name and signature of the console command.
   *
   * @var string
   */
  protected $signature = 'lighthouse:cache';

  public function handle(ASTBuilder $builder, ASTCache $cache): void
  {
    parent::handle($builder, $cache);

    $entries = config('lighthouse.schema.entries');

    $cacheKey = config('lighthouse.cache.key');
    $cachePath = config('lighthouse.cache.path');
    foreach ($entries as $schema => $path) {
      MultiLighthouseServiceProvider::patchCacheConfig($schema);
      $builder = new ASTBuilder(
        app(DirectiveLocator::class),
        $source = new SchemaStitcher($path),
        app(Dispatcher::class),
        $cache = new ASTCache(config())
      );
      // Rebound classes
      app()->singleton(SchemaSourceProvider::class, fn () => $source);
      app()->singleton(ASTBuilder::class, fn () => $builder);
      app()->singleton(ASTCache::class, fn () => $cache);
      parent::handle($builder, $cache);

      // restore config for next loop
      config()->set('lighthouse.cache.key', $cacheKey);
      config()->set('lighthouse.cache.path', $cachePath);
    }
  }
}
