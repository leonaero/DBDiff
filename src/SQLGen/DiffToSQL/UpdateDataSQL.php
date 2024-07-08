<?php namespace DBDiff\SQLGen\DiffToSQL;

use DBDiff\SQLGen\SQLGenInterface;


class UpdateDataSQL implements SQLGenInterface {

    function __construct($obj) {
        $this->obj = $obj;
    }
    
    public function getUp() {
        $table = $this->obj->table;
        
        $values = $this->obj->diff['diff'];
        array_walk($values, function(&$diff, $column) {
            $diff = '`' . $column . "` = " . ValueUtils::toString($diff->getNewValue());
        });
        $values = implode(', ', $values);

        $keys = $this->obj->diff['keys'];
        array_walk($keys, function(&$value, $column) {
            $value = '`'.$column."` = " . ValueUtils::toString($value);
        });
        $condition = implode(' AND ', $keys);
        
        return "UPDATE `$table` SET $values WHERE $condition;";
    }

    public function getDown() {
        $table = $this->obj->table;
        
        $values = $this->obj->diff['diff'];
        array_walk($values, function(&$diff, $column) {
            $diff = '`'.$column."` = " . ValueUtils::toString($diff->getOldValue());
        });
        $values = implode(', ', $values);

        $keys = $this->obj->diff['keys'];
        array_walk($keys, function(&$value, $column) {
            $value = '`'.$column."` = " . ValueUtils::toString($value);
        });
        $condition = implode(' AND ', $keys);
        
        return "UPDATE `$table` SET $values WHERE $condition;";
    }

}
