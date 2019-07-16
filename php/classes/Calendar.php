<?php


class Calendar
{
    private $month;
    private $year;
    private $days;

    public function __construct($m = null, $y = null)
    {
        $this->month=$m;
        $this->year=$y;
    }

    public function displayCalendar(){
        
        echo "ceci est un calendrier du jour";
    }

}