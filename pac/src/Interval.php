<?php

use Cassandra\Date;

class Interval {
    public $date1;
    public $date2;
    public function __construct(Date $date1, Date $date2) {
        $this->date1 = $date1;
        $this->date2 = $date2;
    }

    public function toDays() {
        return abs($this->date1->getxDay() - $this->date2->getDay());
    }

    public function toMonth() {
        return abs($this->date1->getMonth() - $this->date2->getMonth());
    }

    public function toYears() {
        return abs($this->date1->getYear() - $this->date2->getYear());
    }

}