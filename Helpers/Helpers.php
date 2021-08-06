<?php


class Helpers
{
    public function isValidDate($date, $format = 'Y-m-d')
    {
        return DateTime::createFromFormat($format, $date);
    }
}
