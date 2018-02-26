<?php

namespace Ksoft\Klaravel;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class DirectivesProvider extends ServiceProvider
{
    public function boot()
    {
        $this->authDirectives();
        $this->stringDirectives();
        $this->mathsDirectives();
        $this->datesDirectives();
        $this->debugDirectives();
        $this->phpDirectives();
    }

    private function authDirectives()
    {
        /*
         * Usage: @admin @else @endif
         */
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });
    }

    private function stringDirectives()
    {
        /*
         * Usage: @normalizeStr($value)
         */
        Blade::directive('normalizeStr', function ($expression) {
            list($string, $limit) = $this->getArguments($expression);
            $res = '';
            if ($limit>0) {
                $res = str_limit($string, $limit);
            }
            return "<?php echo ucfirst(mb_strtolower($res)); ?>";
        });

    }

    private function mathsDirectives()
    {
        /*
         * Usage: @number($value)
         * Usage: @decimals($value)
         */
        Blade::directive('number', function ($expression) {
            return "<?php echo number_format(floatval($expression), 0); ?>";
        });
        Blade::directive('decimals', function ($expression) {
            return "<?php echo number_format(floatval($expression), 2); ?>";
        });
    }

    private function datesDirectives()
    {
        /*
         * Usage: @datetime(Carbon $date)
         */
        Blade::directive('datetime', function ($expression) {
            return "<?php echo ($expression)->format('m/d/Y H:i'); ?>";
        });
    }

    private function debugDirectives()
    {
        /*
         * Usage: @log($value)
         */
        Blade::directive('log', function ($expression) {
            return "<?php logi(with{$expression}); ?>";
        });
    }

    private function phpDirectives()
    {
        /*
         * @explode($delimiter, $string)
         * @implode($delimiter, $array)
         */
        Blade::directive('explode', function ($expression) {
            list($delimiter, $string) = $this->getArguments($expression);

            return "<?php echo explode({$delimiter}, {$string}); ?>";
        });

        Blade::directive('implode', function ($expression) {
            list($delimiter, $array) = $this->getArguments($expression);

            return "<?php echo implode({$delimiter}, {$array}); ?>";
        });

    }

    /**
     * Parse expression.
     *
     * @param  string $expression
     * @return \Illuminate\Support\Collection
     */
    public static function getArguments($expression)
    {
        return collect(explode(',', $expression))->map(function ($item) {
            return trim($item);
        });
    }
}
