<?php

/*
 * Traits divers
 */

trait frenchDates
{
    /* formatte une date MySql au format FR */
    function frenchDate(string $date)
    {
        // partie date
        $fr_date = substr($date, 0, 10);
        $fr_date = explode('-', $fr_date);
        $fr_date = $fr_date[2] . '/' . $fr_date[1] . '/' . $fr_date[0];
        // partie heure
        $fr_time = substr($date, 11, 8);
        $fr_time = explode(':', $fr_time);
        $fr_time = $fr_time[0] . 'h ' . $fr_time[1] . 'm ' . $fr_time[2].'s';
        return $fr_date. ' à '.$fr_time;
    }
}
