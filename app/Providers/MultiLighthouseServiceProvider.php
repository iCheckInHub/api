<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Nuwave\Lighthouse\Schema\AST\ASTCache;
use Nuwave\Lighthouse\Schema\Source\SchemaSourceProvider;

class MultiLighthouseServiceProvider extends ServiceProvider
{
  protected $schemaResolved = false;
  protected $cacheResolved = false;

  public function register()
  {
    $this->app->beforeResolving(SchemaSourceProvider::class, function () {
      if ($this->schemaResolved) return;
      [$schema, $path] = $this->locateEntry();
      if (!$schema) {
        return; // no entry defined
      }
      config()->set('lighthouse.schema.register', $path);
      $this->schemaResolved = true;
    });
    $this->app->beforeResolving(ASTCache::class, function () {
      if ($this->cacheResolved) return;
      [$schema] = $this->locateEntry();
      if (!$schema) {
        return;
      }
      static::patchCacheConfig($schema);
      $this->cacheResolved = true;
    });
  }

  protected function locateEntry(): array
  {
    /** @var Request $request */
    $request = $this->app->make('request');
    $schema = $request->query->get('schema');
    $entries = config('lighthouse.schema.entries', []);
    if (!key_exists($schema, $entries)) {
      return [null, null];
    }
    return [$schema, $entries[$schema]];
  }

  public static function patchCacheConfig($schema)
  {
    $cacheKey = config('lighthouse.cache.key');
    $cachePath = config('lighthouse.cache.path');
    config()->set('lighthouse.cache.key', "$cacheKey-$schema");

    // the final filename won't look good but its cache file anyway ¯\_(ツ)_/¯
    config()->set('lighthouse.cache.path', "$cachePath-$schema.php");
  }
}
