<?php

namespace Armincms\Location;
 

class Helper 
{
    public static function getCountryStatesByIsoCode(string $iso = null)
    {
        $path = __DIR__."/../resources/{$iso}.json"; 

        if (! \File::exists($path)) {
            throw new \Illuminate\Contracts\Filesystem\FileNotFoundException;
        }

        return collect(json_decode(\File::get($path), true));
    }
}
