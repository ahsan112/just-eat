<?php 


namespace App\Models;

use App\QueryBuilder;

abstract class Model 
{
    protected static $table = '';

    public static function all(): array
    {
        $result = (new QueryBuilder(static::$table))->select()->get();

        return $result;
    }

    public static function where(string $column, string $value): array
    {
        $result = (new QueryBuilder(static::$table))
                    ->select()
                    ->where($column, $value)
                    ->get();

        return $result;
    }

    public static function whereIn(string $column, array $values): array
    {
        $result = (new QueryBuilder(static::$table))
                    ->select()
                    ->whereIn($column, $values)
                    ->get();

        return $result;
    }

    public static function find(string $column, string $value): array
    {
        $result = self::where($column, $value)[0] ?? [];

        return $result;
    }

    public static function firstOrCreate(string $findColumn, string $findValue , array $params): array
    {
        $result = self::find($findColumn, $findValue);

        if (empty($result)) {
            $id = self::create($params);
            $result = self::find('id', $id);
        }

        return $result;
    }

    public static function create(array $params): int
    {
        $result = (new QueryBuilder(static::$table))->insert($params);

        return $result;
    }

    public static function createMany(array $params): bool
    {
        $result = (new QueryBuilder(static::$table))->insertMany($params);

        return $result;
    }

    public static function eagerLoad(string $tableToLoad, string $foreignKey = 'id')
    {
        $mainTableData = self::all();

        $eagerLoadTableData = (new QueryBuilder($tableToLoad))
                            ->select()
                            ->get();
  
        return self::groupEagerLoadData($mainTableData, $eagerLoadTableData, $foreignKey, $tableToLoad);

    }

    public static function nestedEagerLoad(array $select, string $tableToLoad, string $foreignKey = 'id', string $nestedTable, string $joinFromColumn, string $joinToColumn): array
    {
        $mainTableData = self::all();

        $eagerLoadTableData = (new QueryBuilder($tableToLoad))
                            ->select($select)
                            ->join($nestedTable, $joinFromColumn, $joinToColumn)
                            ->get();
            
        return self::groupEagerLoadData($mainTableData, $eagerLoadTableData, $foreignKey, $tableToLoad);
    }

    private static function groupEagerLoadData(array $mainTableData, array $eagerLoadTableData, string $foreignKey, string $groupName): array
    {
        $groupedEagerLoadData = [];
        foreach ($eagerLoadTableData as $data) {
            $groupedEagerLoadData[$data[$foreignKey]][] = $data;
        }

        $dataToReturn = [];

        foreach ($mainTableData as $data) {
            $data[$groupName] = $groupedEagerLoadData[$data['id']]; 
            $dataToReturn[] = $data;
        }

        return $dataToReturn;
    }

    public static function update(string $id, array $data)
    {
        (new QueryBuilder(static::$table))->update($data);
    }

    public static function raw(string $sql, array $bindValues = [])
    {
        (new QueryBuilder(static::$table))->raw($sql, $bindValues);
    }

    public static function whereInWith(string $column, array $values, string $tableToJoin, string $colToJoinFrom, string $colToJoinTo)
    {
        $result = (new QueryBuilder(static::$table))
                ->select()
                ->join($tableToJoin, $colToJoinFrom, $colToJoinTo)
                ->whereIn($column, $values)
                ->get();

        return $result;
    }
}