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

    function gcd($a, $b) {
        $r = 1;

        if ($a > $b) {
            $x = $a;
            $y = $b;
        } else {
            $x = $b;
            $y = $a;
        }

        while ($r > 0) {
            $r = $x % $y;
            $x = $y;
            $y = $r;
        }

        return $x;
    }


function invesermod($e, $f) { 
    $r0 = $e;
    $u0 = 1;

    $r1 = $f;
    $u1 = 0;

    while ($r1 > 0) { 
        $q = intdiv($r0, $r1);

        $nouveauReste = $r0 - $q * $r1;
        $nouveauU = $u0 - $q * $u1;

        $r0 = $r1;
        $r1 = $nouveauReste;
        
        $u0 = $u1;
        $u1 = $nouveauU;
    }

    if ($r0 !== 1) { 
        echo "Erreur inverse innexistant";
        return -1;
    }

    return (($u0 % $f) + $f) % $f;
}

    echo expmod(2, 30, 9); // 1
