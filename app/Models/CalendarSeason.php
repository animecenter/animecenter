<?php

namespace AC\Models;

class CalendarSeason
{
    private static $calendarSeasons = ['Spring', 'Summer', 'Fall', 'Winter'];

    public static function all()
    {
        return self::$calendarSeasons;
    }
}
