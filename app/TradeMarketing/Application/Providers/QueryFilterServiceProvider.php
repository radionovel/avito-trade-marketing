<?php
declare(strict_types=1);


namespace App\TradeMarketing\Application\Providers;

use Ambengers\QueryFilter\AbstractQueryFilter;
use Ambengers\QueryFilter\AbstractQueryLoader;
use Ambengers\QueryFilter\RequestQueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class QueryFilterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->bootEloquentFilterMacro();
    }

    /**
     * @return void
     */
    protected function bootEloquentFilterMacro(): void
    {
        $method = config('query_filter.method', 'filter');
        Builder::macro($method, function (RequestQueryBuilder $filters) {
            if (!$this instanceof Builder) {
                throw new InvalidArgumentException('Invalid argument type for macros filter.');
            }

            if ($filters instanceof AbstractQueryLoader) {
                return $filters->getFilteredModel($this);
            }

            if ($filters instanceof AbstractQueryFilter) {
                return $filters->getPaginated($this);
            }

            throw new InvalidArgumentException('Invalid argument type for filters.');
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../../../../config/query_filter.php',
            'query-filter-config'
        );
    }
}
