<?php
use Illuminate\Support\Facades\Cache; 
use Illuminate\Support\Facades\DB; // Import the DB facade

if(!function_exists('getSiteSettings')){
    function getSiteSettings(){
        return Cache::remember('site_settings', 60*60, function(){
            return DB::table('settings')->first();
        });
    }
}