<?php

namespace Bachtiar\Helper\DB\Query\Service;

/**
 * Simple Query Builder
 *
 * :: how to use
 * => QueryBuilderService::select()->from('base_table')->join('relation_table', 'base_table.baseColumnId', '=', 'relationColumnId')->where('base_table.name', '=', 'test')->andWhere('base_table.age', '=', 'age')->orWhere('relation_table.address', 'like', '%ponorogo%')->get();
 *
 * :: select([]) -> optional
 *
 * :: from('base_table') -> ! must be included
 *
 * :: join('relation_table', 'base_table.baseColumnId', '=', 'relationColumnId') -> optional
 *
 * :: where('base_table.name', '=', 'test') -> optional
 *
 * :: andWhere('base_table.age', '=', 'age') -> optional
 *
 * :: orWhere('relation_table.address', 'like', '%ponorogo%') -> optional
 *
 * :: get()
 */
class QueryBuilderService
{
    private static $select = "";
    private static $from = "";
    private static $join = "";
    private static $where = "";
    private static $andOrWhere = "";

    // ? Public Methods
    public static function get()
    {
        return self::buildQueryProcess();
    }

    // ? Private Methods
    private static function buildQueryProcess()
    {
        return (strlen(static::$select) ? static::$select : "SELECT * ")
            . "FROM " . static::$from . " "
            . static::$join
            . static::$where
            . static::$andOrWhere;
    }

    // ? Private Query Resolver
    private static function selectResolver(array $select): string
    {
        $selectResult = "SELECT ";

        if (count($select)) {
            foreach ($select as $key => $q) {
                if ($key == 0) $selectResult .= "$q";
                else $selectResult .= ", $q";
            }
        } else {
            $selectResult .= "*";
        }

        return "$selectResult ";
    }

    private static function innerJoinResolver(string $relationTable, string $baseTableId, string $sign = "=", string $relationTableId): string
    {
        $joinResult = "INNER JOIN $relationTable ON ";

        $joinResult .= "$baseTableId $sign $relationTable.$relationTableId ";

        return $joinResult;
    }

    private static function whereResolver(string $column, string $sign, $value): string
    {
        return "WHERE " . self::whereValueResolver($column, $sign, $value);
    }

    private static function orWhereResolver(string $column, string $sign, $value): string
    {
        return "OR " . self::whereValueResolver($column, $sign, $value);
    }

    private static function andWhereResolver(string $column, string $sign, $value): string
    {
        return "AND " . self::whereValueResolver($column, $sign, $value);
    }

    private static function whereValueResolver(string $column, string $sign, $value): string
    {
        $whereResult = " ";

        if (gettype($value) == "integer") {
            $whereResult = "$column $sign $value ";
        } else {
            $whereResult = "$column $sign '$value' ";
        }

        return $whereResult;
    }

    // ? Setter Module
    /**
     * Set select columns
     *
     * -> set select column,
     * if null, then auto set to all (*)
     *
     * @param array $select
     * @return self
     */
    public static function select(array $select = []): self
    {
        $resolve = self::selectResolver($select);

        self::$select = $resolve;

        return new self;
    }

    /**
     * Set from (base table)
     *
     * -> set base table query, ! must be included
     *
     * @param string $from
     * @return self
     */
    public static function from(string $from): self
    {
        self::$from = $from;

        return new self;
    }

    /**
     * Set join (inner)
     *
     * -> set inner join from query
     *
     * @param string $relationTable
     * @param string $baseId
     * @param string $sign
     * @param string $relationId
     * @return self
     */
    public static function join(string $relationTable, string $baseId, string $sign = "=", string $relationId): self
    {
        $resolve = self::innerJoinResolver($relationTable, $baseId, $sign, $relationId);

        self::$join .= $resolve;

        return new self;
    }

    /**
     * Set where clouse
     *
     * -> set where clause from query
     *
     * @param string $column
     * @param string $sign
     * @param string|integer $value
     * @return self
     */
    public static function where(string $column, string $sign, $value): self
    {
        $resolve = self::whereResolver($column, $sign, $value);

        self::$where = $resolve;

        return new self;
    }

    /**
     * Set OR Where
     *
     * -> set or where clause from query
     *
     * @param string $column
     * @param string $sign
     * @param string|integer $value
     * @return self
     */
    public static function orWhere(string $column, string $sign, $value): self
    {
        $resolve = self::orWhereResolver($column, $sign, $value);

        self::$andOrWhere .= $resolve;

        return new self;
    }

    /**
     * Set AND Where
     *
     * -> set and where clause from query
     *
     * @param string $column
     * @param string $sign
     * @param string|integer $value
     * @return self
     */
    public static function andWhere(string $column, string $sign, $value): self
    {
        $resolve = self::andWhereResolver($column, $sign, $value);

        self::$andOrWhere .= $resolve;

        return new self;
    }
}
