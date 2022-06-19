<?php

namespace App\Providers\Data;

    class ResourceFields
    {
        /* Data Resource Fields
        * 1: Wood | 2: Clay | 3: Iron | 4: Crop
        */
        public static function get() : array
        {
            return  [
                // Formation 4 - 4 - 4 - 6
                1 => [
                    1 => 1,
                    2 => 1,
                    3 => 1,
                    4 => 1,
                    5 => 2,
                    6 => 2,
                    7 => 2,
                    8 => 2,
                    9 => 3,
                    10 => 3,
                    11 => 3,
                    12 => 3,
                    13 => 4,
                    14 => 4,
                    15 => 4,
                    16 => 4,
                    17 => 4,
                    18 => 4,
                ],
                // Formation 1 - 1 - 1 - 15
                2 => [
                    1 => 1,
                    2 => 1,
                    3 => 1,
                    4 => 1,
                    5 => 1,
                    6 => 1,
                    7 => 1,
                    8 => 1,
                    9 => 1,
                    10 => 1,
                    11 => 1,
                    12 => 1,
                    13 => 1,
                    14 => 1,
                    15 => 1,
                    16 => 1,
                    17 => 1,
                    18 => 1,
                ],
            ];
        }
    }
