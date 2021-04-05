<?php

namespace Armincms\Location;
 

class Helper 
{
    public static function getCountryStatesByIsoCode(string $iso = null)
    { 
        $path = __DIR__."/../resources/".mb_strtolower($iso).".json"; 

        if (! \File::exists($path)) {
            throw new \Illuminate\Contracts\Filesystem\FileNotFoundException;
        }

        return collect(json_decode(\File::get($path), true));
    }
}
