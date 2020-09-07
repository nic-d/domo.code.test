<?php

namespace App\Domain\Infrastructure\Support\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;

/**
 * This class is designed to take the hassle out of loading gates for each of our Domain contexts.
 * In the AuthServiceProvider.php of each Domain you just use registerGateClasses() method within the register() method.
 *
 * Q: My Gate classes don't load?!?!
 * A: Ensure you're naming your gate classes: <name>Gates.php
 *    example: If you have a Gate named "Team", then the gate class will be named: TeamGates.
 */
class GateClassLoader
{
    /**
     * Call this method from within your AuthServiceProvider classes within each Domain.
     *
     * @param string $domain
     * @return void
     */
    public static function registerGateClasses(string $domain) : void
    {
        self::collectGateClasses($domain)
            ->unique()
            ->flatMap(function ($item, $key) {
                return $item::rules();
            })
            ->each(function ($callback, $key) {
                Gate::define($key, $callback);
            })
        ;
    }

    /**
     * Returns a collection of gate classes matching the Domain context.
     * If we pass in "Team", we will load all gate classes from Team/Support/Gates/*Gates.php
     *
     * @param string $domain
     * @return Collection
     */
    protected static function collectGateClasses(string $domain) : Collection
    {
        // First let's convert the given $domain string to a namespace path within Domain directory
        $normalisedDomainPath = app_path(sprintf(
            'Domain/%s/Support/Gates',
            Str::studly($domain),
        ));

        // A simple glob to get all the files
        $gateClasses = glob(sprintf(
            '%s/*Gates.php',
            $normalisedDomainPath
        ));

        // Before we return the classes we've found, let's convert the path to a namespace
        return collect($gateClasses)->map(function ($item, $key) {
            return (string)Str::of($item)
                ->after('app')
                ->replaceFirst('/', 'App\\')
                ->start('\\')
                ->replace('/', '\\')
                ->replace('.php', '')
            ;
        });
    }
}
