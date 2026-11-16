<?php
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

function RSAencrypt($x, $e, $n) {
    return expmod($x, $e, $n);
}

function RSADecrypt($y, $e, $p, $q) {
    $phi = ($p - 1) * ($q - 1);

    if (gcd($e, $phi) == 1) {
        $d = inversermod($e, $phi);
        if ($d != -1) {
            return expmod($y, $d, $p * $q);
        }
    }
    return -1;
}

echo RSAencrypt(3, 5, 85);    
echo "\n";
echo RSADecrypt(2, 5, 5, 17); 