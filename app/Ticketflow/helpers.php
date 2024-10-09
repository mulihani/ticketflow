<?php

//namespace App\Ticketflow;

use App\Models\Setting;
use App\Models\Ticket;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Site opening and closing features
|--------------------------------------------------------------------------
| These functions control site opening and closing features. First, they
| check if the site is active (status On) and then if it closed today or 
| it runs according to a specific hour (site_activation_hours On/Off).
|
*/

// Check the site status (status On/Off)
if (! function_exists('siteStatus')) {
    function siteStatus()
    {
        if ( siteIsActive() ) {

            // Check if site closed today
            if (isSiteClosedToday()) {
                return false;
            }

            // Check site activation hours feature
            if ( siteActivationHours() ) {
                return true;
            } else {
                return false;
            }

        } else {
            return false;
        }
    }
}

// Check if the site is active (status On)
if (! function_exists('siteIsActive')) {
    function siteIsActive()
    {
        return Setting::getSetting('site_status');
    }
}

// Check if this day of the week is selected to close the site (closed today).
if (! function_exists('isSiteClosedToday')) {
    function isSiteClosedToday()
    {
        // Get current day in full textual representation
        $today = Carbon::now()->format('l'); 

        if (in_array($today, Setting::getSetting('closed_days'))){
            return true;
        }

        return false;
    }
}

// Check if the site operates according to a specific hour (site_activation_hours On/Off)
if (! function_exists('siteActivationHours')) {
    function siteActivationHours()
    {
        $start = getActivationStartTime('carbon'); // initial the start time
        $end   = getActivationEndTime('carbon') ;  // initial the end time

        // Check if the site activation hours feature is Off
        if (! Setting::getSetting('site_activation_hours') ) {
            return true;
        } else {

            // Check whether the site's running time is from evening to morning (20:00 PM to 8:00 AM).
            if ( getActivationStartTime() > getActivationEndTime() ) {

                if ( Carbon::now()->gte($start) ) {
                    $end->addDay();
                } elseif (Carbon::now()->lte($start)) {
                    $start->subDay();
                }
            }

            return Carbon::now()->between($start, $end);
        }

    }
}

/*
* Get the site startup hour. The value stored in the database is in hour format (e.g., 07:00).
* To convert it to full carbon format (), enter any value for the variable $carbon.
* e.g., getActivationStartTime('carbon') -> for carbon format 
* e.g., getActivationStartTime() -> for database value format (e.g., 07:00)
*/
if (! function_exists('getActivationStartTime')) {
    function getActivationStartTime( $carbon = '' )
    {
        if (isset($carbon) && !empty($carbon)){
            return Carbon::createFromTimeString( Setting::getSetting('site_activation_starts_at') );
        } else {
            return  Setting::getSetting('site_activation_starts_at');
        }
    }
}

/*
* Get the site close hour. The value stored in the database is in hour format (e.g., 07:00).
* To convert it to full carbon format (), enter any value for the variable $carbon.
* e.g., getActivationEndTime('carbon') -> for carbon format 
* e.g., getActivationEndTime() -> for database value format (e.g., 07:00)
*/
if (! function_exists('getActivationEndTime')) {
    function getActivationEndTime( $carbon = '' )
    {
        if (isset($carbon) && !empty($carbon)){
            return Carbon::createFromTimeString( Setting::getSetting('site_activation_ends_at') );
        } else {
            return  Setting::getSetting('site_activation_ends_at');
        }
    }
}

/*
|--------------------------------------------------------------------------
| DateTimeZone
|--------------------------------------------------------------------------
| These functions define all time zones. First, create a time zone list. 
| Then, add the zones to an array to use as a drop-down list ('value' => 'text').
|
*/

// Get all time zones with offset
if (! function_exists('timezoneList')) {
    function timezoneList() {

        $zones_array = array();
        $timestamp = time();

        foreach (timezone_identifiers_list() as $key => $zone) {
            date_default_timezone_set($zone);
            $zones_array[$key]['zone']  = $zone;
            $zones_array[$key]['text']  = '(GMT'.date('P', $timestamp).') '.$zones_array[$key]['zone'];
            $zones_array[$key]['order'] = str_replace('-', '1', str_replace('+', '2', date('P', $timestamp))).$zone;
        }

        // Sort by offset
        usort($zones_array,
            function ($a, $b) {
                return strcmp($a['order'], $b['order']);
            }
        );

        return $zones_array;
    }
}

// To provide zones as an array, use a timezone for options in the view.
if (! function_exists('getTimezoneSelectOptions')) {
    function getTimezoneSelectOptions()
    {
        $options = [];

        foreach (timezoneList() as $timezone) {
            // 'value' => $timezone['zone'], 'text' => $timezone['text']
            $row = [$timezone['zone'] => $timezone['text']];
            $options = array_merge($options,$row);
        }

        return $options;
    }
}

/*
|--------------------------------------------------------------------------
| Tickets
|--------------------------------------------------------------------------
| These functions control tickets.
|
*/

// Return tickets count
if (! function_exists('userTicketCount')) {
    function userTicketCount( $status = '', $field = 'user_id', $id = '' )
    {
        if ($id != '') {
            $userId = $id;
        } else {
            $userId = auth()->id();
        }

        if ($status) {
            return Ticket::where($field, $userId)->where('status', $status)->count(); // count by status (open, processing, closed)
        } else {
            return Ticket::where($field, $userId)->count();
        }
    }
}