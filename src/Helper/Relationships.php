<?php
/**
 * PotatoORM manages the persistence of database CRUD operations.
 *
 * @package Ibonly\PotatoORM\Model
 * @author  Ibraheem ADENIYI <ibonly01@gmail.com>
 * @license MIT <https://opensource.org/licenses/MIT>
 */

namespace Ibonly\PotatoORM;

use Ibonly\PotatoORM\DatabaseQuery;
use Ibonly\PotatoORM\RelationshipsInterface;

class Relationships extends DatabaseQuery implements RelationshipsInterface
{
    public function joinClause($con = null)
    {
        $connection = self::checkConnection($con);

        $data = self::query('SELECT COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE WHERE TABLE_NAME="'.self::getTableName($connection).'"')->all();

        $output = "";
        $i = 0;

        if (! isset($data[0]) || $data[1]->REFERENCED_TABLE_NAME !== null) {
            foreach($data as $key => $value) {
                if ( ! empty($value->REFERENCED_TABLE_NAME)) {
                    $output .= ' JOIN '.$value->REFERENCED_TABLE_NAME;
                }
            }
            foreach($data as $key => $value) {
                $i++;
                $whereAnd = $i > 1 ? 'AND' : 'WHERE';
                if ( empty($value->REFERENCED_TABLE_NAME)) {
                    $value->REFERENCED_TABLE_NAME = self::getTableName($connection);
                    $value->REFERENCED_COLUMN_NAME = $value->COLUMN_NAME;
                }
                $output .= ' '.$whereAnd.' '.self::getTableName($connection).'.'.$value->COLUMN_NAME.'='.$value->REFERENCED_TABLE_NAME.'.'.$value->REFERENCED_COLUMN_NAME.' ';
            }
         } else {
            $output = false;
         }
        return $output;
    }

    public function whereClause($data = null, $condition = null, $con = null)
    {
        $joinClause = self::joinClause();
        $connection = self::checkConnection($con);
        $tableName  = self::getTableName($connection);
        $columnName = self::whereAndClause($tableName, $data, $condition);

        $query = self::selectAllQuery($tableName);

        if ($joinClause == false && $data === null) {
            $query .= $columnName;
        } else if ($joinClause == false && $data !== null) {
            $query .= ' WHERE '.$columnName;
        } else {
            $query .= ($data === null) ? $joinClause : $joinClause .' AND '.$columnName;
        }
        return $query;
    }
}