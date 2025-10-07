<?php

namespace Modules\Core\Providers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Models\Admin;
use Modules\Auth\Enums\GuardName;
use Nwidart\Modules\Traits\PathNamespace;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class CoreServiceProvider extends ServiceProvider
{
  use PathNamespace;

  protected string $name = 'Core';

  protected string $nameLower = 'core';

  /**
   * Boot the application events.
   */
  public function boot(): void
  {
    $this->registerCommands();
    $this->registerCommandSchedules();
    $this->registerBladeDirectives();
    $this->registerTranslations();
    $this->registerConfig();
    $this->registerViews();
    $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));
  }

  /**
   * Register the service provider.
   */
  public function register(): void
  {
    $this->app->register(EventServiceProvider::class);
    $this->app->register(RouteServiceProvider::class);
    $this->registerResponseMacros();
    $this->registerRouteGroupMacro();
    $this->registerMigrationMacro();
  }

  protected function registerMigrationMacro(): void
  {
    Blueprint::macro('authors', function () {
      $this->foreignId('creator_id');
      $this->foreignId('updater_id');
    });

    Blueprint::macro('morphAuthors', function () {
      $this->morphs('creatorable');
      $this->morphs('updaterable');
    });
  }

  protected function registerRouteGroupMacro(): void
  {
    Route::macro('superGroup', fn(GuardName $guard, $callback) => Route::group([
      'prefix' => $guard->value,
      'as' => $guard->value . '.',
      'middleware' => ['auth:' . $guard->value],
    ], $callback));

    Route::macro('hasPermission', function ($permission, $guardName = Admin::GUARD_NAME) {
      return Route::middleware('permission:' . $permission . ',' . $guardName);
    });
  }

  protected function registerResponseMacros(): void
  {
    ResponseFactory::macro('success', function ($message, ?array $data = null, $httpCode = 200) {
      return response()->json([
        'success' => true,
        'message' => $message,
        'data' => $data,
      ], $httpCode);
    });

    ResponseFactory::macro('error', function ($message, ?array $data = null, $httpCode = 400) {
      if ($httpCode == 422) {
        return response()->json([
          'success' => false,
          'message' => $message,
          'errors' => $data,
        ], $httpCode);
      }
      return response()->json([
        'success' => false,
        'message' => $message,
        'data' => $data,
      ], $httpCode);
    });
  }

  protected function registerBladeDirectives(): void
  {
    Blade::directive('numberFmt', function (string $expression) {
      return "<?php echo number_format($expression) ?>";
    });
    Blade::directive('jalaliDateTimeFormat', function (string $expression) {
      return "<?php echo verta($expression)->format('Y/m/d H:i') ?>";
    });
    Blade::directive('jalaliDateFormat', function (string $expression) {
      return "<?php echo verta($expression)->format('Y/m/d') ?>";
    });
    Blade::directive('jalaliTimeFormat', function (string $expression) {
      return "<?php echo verta($expression)->format('H:i:s') ?>";
    });
    Blade::directive('jalaliDateForHumans', function (string $expression) {
      return "<?php echo verta(now())->diffDays($expression) > 7 ? verta($expression)->format('Y/m/d H:i') : verta($expression)->formatDifference() ?>";
    });
  }

  /**
   * Register commands in the format of Command::class
   */
  protected function registerCommands(): void
  {
    // $this->commands([]);
  }

  /**
   * Register command Schedules.
   */
  protected function registerCommandSchedules(): void
  {
    // $this->app->booted(function () {
    //     $schedule = $this->app->make(Schedule::class);
    //     $schedule->command('inspire')->hourly();
    // });
  }

  /**
   * Register translations.
   */
  public function registerTranslations(): void
  {
    $langPath = resource_path('lang/modules/' . $this->nameLower);

    if (is_dir($langPath)) {
      $this->loadTranslationsFrom($langPath, $this->nameLower);
      $this->loadJsonTranslationsFrom($langPath);
    } else {
      $this->loadTranslationsFrom(module_path($this->name, 'lang'), $this->nameLower);
      $this->loadJsonTranslationsFrom(module_path($this->name, 'lang'));
    }
  }

  /**
   * Register config.
   */
  protected function registerConfig(): void
  {
    $configPath = module_path($this->name, config('modules.paths.generator.config.path'));

    if (is_dir($configPath)) {
      $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($configPath));

      foreach ($iterator as $file) {
        if ($file->isFile() && $file->getExtension() === 'php') {
          $config = str_replace($configPath . DIRECTORY_SEPARATOR, '', $file->getPathname());
          $config_key = str_replace([DIRECTORY_SEPARATOR, '.php'], ['.', ''], $config);
          $segments = explode('.', $this->nameLower . '.' . $config_key);

          // Remove duplicated adjacent segments
          $normalized = [];
          foreach ($segments as $segment) {
            if (end($normalized) !== $segment) {
              $normalized[] = $segment;
            }
          }

          $key = ($config === 'config.php') ? $this->nameLower : implode('.', $normalized);

          $this->publishes([$file->getPathname() => config_path($config)], 'config');
          $this->merge_config_from($file->getPathname(), $key);
        }
      }
    }
  }

  /**
   * Merge config from the given path recursively.
   */
  protected function merge_config_from(string $path, string $key): void
  {
    $existing = config($key, []);
    $module_config = require $path;

    config([$key => array_replace_recursive($existing, $module_config)]);
  }

  /**
   * Register views.
   */
  public function registerViews(): void
  {
    $viewPath = resource_path('views/modules/' . $this->nameLower);
    $sourcePath = module_path($this->name, 'resources/views');

    $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower . '-module-views']);

    $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->nameLower);

    Blade::componentNamespace(config('modules.namespace') . '\\' . $this->name . '\\View\\Components', $this->nameLower);
  }

  /**
   * Get the services provided by the provider.
   */
  public function provides(): array
  {
    return [];
  }

  private function getPublishableViewPaths(): array
  {
    $paths = [];
    foreach (config('view.paths') as $path) {
      if (is_dir($path . '/modules/' . $this->nameLower)) {
        $paths[] = $path . '/modules/' . $this->nameLower;
      }
    }

    return $paths;
  }
}
