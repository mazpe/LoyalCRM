<?php

class Utilities {

    public function percent($number)
    {
        return number_format($number * 100,2,'.',',')."%");
    }

}

