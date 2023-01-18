<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    Builder::macro('wherePlaces', function ($relation, $column, $array) {
      /// @var Builder $this
      return $this->whereHas(
        $relation,
        fn ($q) => $q->whereIn($column, $array)
      );
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    //
  }
}
