<?php

    /**
     * x est la base donc notre nombre à chiffrer, e est l'exposant et n est le modulo
     */
    function expmod($x, $e, $n) : int {
        $result = 1;
        $x = $x % $n;
        while ($e > 0) {
            // vérifier si l'exposant est impair
            if ($e % 2 == 1) {
                $result = ($result * $x) % $n;
            }
            $e = floor($e / 2);
            $x = ($x * $x) % $n;
        }
        return $result;
    }


    echo expmod(2, 30, 9); // 1
