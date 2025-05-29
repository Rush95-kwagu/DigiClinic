<?php
use Carbon\Carbon;

if (!function_exists('calculerAge')) {
    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    function calculerAge($dateNaissance)
    {
        return Carbon::parse($dateNaissance)->age;
    }
}
