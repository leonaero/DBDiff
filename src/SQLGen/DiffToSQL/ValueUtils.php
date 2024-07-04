<?php

namespace DBDiff\SQLGen\DiffToSQL;

class ValueUtils {

    private static $pdo = null;

    public static function initialize(\PDO $pdo) {
        self::$pdo = $pdo;
    }

    public static function toString($value) {
        if ($value === NULL) {
            return 'NULL';
        } elseif (mb_check_encoding($value, 'UTF-8')) {
            if (self::$pdo) {
                return self::$pdo->quote($value);
            }
            return "'" . addslashes($value) . "'";
        } else {
            return "X'" . bin2hex($value) . "'";
        }
    }

}
