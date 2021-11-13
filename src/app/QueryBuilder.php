<?php 


namespace App;


class QueryBuilder
{
    private $table;
    private $whereStatments    = [];
    private $bindValues        = [];
    private $joinStatments     = [];
    private $selectColumns;
    private $db;

    public function __construct(string $table = '')
    {
        $this->table = $table;
        $this->db = App::db();
    }

    /**
     * Set table
     *
     * @param string $table
     * @return self
     */
    public function table(string $table): self
    {
        $this->table = $table;

        return $this;
    }

    /**
     * set select params
     *
     * @param array $params
     * @return self
     */
    public function select(array $params = ['*']): self
    {
        $this->selectColumns = implode(', ', $params);

        return $this;
    }

    /**
     * set the where statment
     *
     * @param string $column
     * @param string $value
     * @return self
     */
    public function where(string $column, string $value): self
    {
        $this->buildWhereStatment($column, $value);
        
        return $this;
    }

    /**
     * set the OR statment
     *
     * @param string $column
     * @param string $value
     * @return self
     */
    public function orWhere(string $column, string $value): self
    {
        $this->buildWhereStatment($column, $value, ' OR ');

        return $this;
    }

    /**
     * set the where in statment
     *
     * @param string $column
     * @param array $values
     * @return self
     */
    public function whereIn(string $column, array $values): self
    {
        $placeholderValues  = [];

        foreach ($values as $key => $value) {
            $placeholderValues[] = ':v' . $key;
            $this->bindValues[':v' . $key] = $value;
        }

        $placeholders = implode(',', $placeholderValues);

        $stmt = ' WHERE ' . $column . ' IN ' . '( '. $placeholders . ' ) ';

        $this->whereStatments[] = $stmt;
       
        return $this;
    }

    /**
     * set join statment query
     *
     * @param string $tableToJoin
     * @param string $columnToJoin
     * @param string $joiningToColumn
     * @return self
     */
    public function join(string $tableToJoin, string $columnToJoin, string $joiningToColumn): self
    {
        $sql = ' JOIN ' . $tableToJoin . ' ON ' . $columnToJoin . ' = ' . $joiningToColumn;

        // $this->joinStatment = $sql;
        $this->joinStatments[] = $sql;

        return $this;
    }

    /**
     * prepare and execute 
     * seperate this out to prepare insert 
     * @param array $values
     * @return integer
     */
    public function insert(array $values): int
    {
        $columns = implode(', ', array_keys($values));
        
        $bindColumns = array_map(function ($col) {
            return ":$col";
        }, array_keys($values));

        $sql = 'INSERT INTO ' . $this->table .  ' (' . $columns . ')' .
                ' VALUES ' . '( ' . implode(', ', $bindColumns) . ' )';


        $stmt = $this->db->prepare($sql);

        $stmt->execute($values);
        
        // $this->reset();

        return (int) $this->db->lastInsertId();
    }

    public function insertMany(array $values): bool
    {
        echo '<pre>';
            var_dump($values);
            var_dump($values[0]);
        echo '</pre>';
        exit;
        $columns      = implode(', ', array_keys($values[0]));
        $bindColumns  = '';
        $insertValues = [];
        
        foreach ($values as $row) {
            $bindColumns .= '(' . implode(',', array_fill(0, count($row), ' ? ')) . '),';
            array_push($insertValues, ...array_values($row));
        }

        $sql = 'INSERT INTO ' . $this->table . ' (' . $columns . ' ) ' .
                'VALUES ' . rtrim($bindColumns, ',');

        $stmt = $this->db->prepare($sql);

        $result = $stmt->execute($insertValues);
        
        // $this->reset();
        
        return $result;
    }

    public function update(array $values)
    {
        $columns = implode(', ', array_keys($values));
        
        $bindColumns = array_map(function ($col) {
            return ":$col";
        }, array_keys($values));

        $sql = 'UPDATE ' . $this->table .  ' (' . $columns . ')' .
                ' VALUES ' . '( ' . implode(', ', $bindColumns) . ' )';


        $stmt = $this->db->prepare($sql);

        $stmt->execute($values);
        
    }

    /**
     *
     *
     * @return array
     */
    public function get(): array
    {
        $sqlQuery = $this->buildSelectQuery();
        
        $stmt = $this->db->prepare($sqlQuery);
        $stmt->execute($this->bindValues);
        // echo '<pre>';
        //     var_dump($sqlQuery);
        // echo '</pre>';
        $result = $stmt->fetchAll();

        // $this->reset();

        return $result;
    }

    public function raw(string $sqlStatment, array $values)
    {
        
        $stmt = $this->db->prepare($sqlStatment);

        $stmt->execute($values);
        $result = $stmt->fetchAll();

        return $result;
    }

    /**
     * build the sql query for select statments 
     *
     * @return string
     */
    private function buildSelectQuery(): string
    {
        $sql = 'SELECT ' . $this->selectColumns . ' FROM ' . $this->table;

        if (! empty($this->joinStatments)) {
            $sql .= $this->getJoinStatments();
        }
        if (! empty($this->whereStatments)) {
            $sql .= $this->getWhereStatments();
        }

        return $sql;
    }

    /**
     * build where query and set bind values
     * TODO might need to refactor the :idenitifer part
     *      and swith it to ?, dont provide key to
     *      bind values array when assigning value
     *      this allows the keys to be unique
     * @param string $column
     * @param string $value
     * @param string $op
     * @return void
     */
    private function buildWhereStatment(string $column, string $value, string $op = ' WHERE '): void
    {
        $trimmedColumn = str_replace('.', '', $column);

        $stmt = $op . $column . ' = ' . ':' . $trimmedColumn;

        $this->whereStatments[] = $stmt;

        $this->bindValues[':' . $trimmedColumn] = $value;
    }

    /**
     * return all the where statment in one query string
     *
     * @return string
     */
    private function getWhereStatments(): string
    {
        $stmt = implode(' ', $this->whereStatments);

        return $stmt;
    }

    /**
     * return the join statments as string
     *
     * @return string
     */
    private function getJoinStatments(): string 
    {
        $stmt = implode(' ', $this->joinStatments);

        return $stmt;
    }

    /**
     * reset values
     *
     * @return void
     */
    private function reset(): void
    {
        $this->whereStatments    = [];
        $this->bindValues        = [];
        $this->selectColumns     = '';
        $this->joinStatment      = '';
    }

}