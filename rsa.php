<?php

/**
 * x est la base donc notre nombre à chiffrer, e est l'exposant et n est le modulo
 */
function expmod($x, $e, $n): int
{
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

/**
 * Question 1.2
 * @param mixed $a
 * @param mixed $b
 */
function gcd($a, $b): int
{
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


function inversemod($e, $f)
{
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


/**
 * Question 1.4
 * 
 * @param mixed $x
 * @param mixed $e
 * @param mixed $n
 * @return int
 */
function RSAencrypt($x, $e, $n): int
{
    return expmod($x, $e, $n);
}

function RSADecrypt($y, $e, $p, $q): int
{
    $phi = ($p - 1) * ($q - 1);

        if (gcd($e, $phi) == 1) {
            $d = inversemod($e, $phi);
            return expmod($y, $d, $p * $q);
        }
        return -1;
    }

function nombreTemoinsFermat($n): int
{
    $compteur = 0;

    for ($a = 1; $a < $n; $a++) {
        if (gcd($a, $n) == 1) {
            if (expmod($a, $n - 1, $n) != 1) {
                $compteur++;
            }
        }
    }
    return $compteur;
}

function estTemoin($a, $d, $s, $n): bool
{
    $x = expmod($a, $d, $n);
    if ($x == 1 || $x == $n - 1) {
        return false;
    }

    for ($r = 1; $r < $s; $r++) {
        $x = ($x * $x) % $n;

        if ($x == $n - 1) {
            return false;
        }
    }
    return true;
}

function millerRabin($n, $k): bool
{
    if ($n < 2) {
        return false;
    }

    if ($n == 2 || $n == 3) {
        return true;
    }

    if ($n % 2 == 0) {
        return false;
    }

    $d = $n - 1;
    $s = 0;

    while ($d % 2 == 0) {
        $d = intdiv($d, 2);
        $s++;
    }

    for ($i = 0; $i < $k; $i++) {
        $a = random_int(2, $n - 2);

        if (estTemoin($a, $d, $s, $n)) {
            return false;
        }
    }
    return true;
}

function premierAleatoire($min, $max): int { 
    if ($min > $max || $max < 3) { 
        throw new InvalidArgumentException("Intervalle invalide");
    }

    $minImpair  = max(3, $min);
    if ($minImpair % 2 == 0) { 
        $minImpair++;
    }

    $maxImpair = $max;
    if ($max % 2 == 0) { 
        $maxImpair = $max -1;
    }

    if ($minImpair > $maxImpair) { 
        throw new InvalidArgumentException("Aucun entier impair dans l'intervalle");
    }

    do { 
        $p = random_int(0, intdiv($maxImpair - $minImpair, 2)) * 2 + $minImpair;
    } while (!millerRabin($p, 20));

    return $p;
}




echo expmod(2, 30, 9); // 1
echo "\n";
echo RSAencrypt(3, 5, 85);
echo "\n";
echo RSADecrypt(2, 5, 5, 17);
