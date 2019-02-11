<?php
/**
 * Created by PhpStorm.
 * User: Галина
 * Date: 17.10.2018
 * Time: 16:51
 */

namespace Src\Database;


class MySQL
{
    const DATABASE = "EnglishTest";
    /**
     * Ссылка на подключение к БД
     * @var null
     */
    private $db = null;

    private $query;

    private $leftJoin;
    private $where;
    private $sort;
    private $limit;
    /**
     * MySQL constructor.
     */
    public function __construct($db = null, $host = "localhost", $user = "root", $pass = "")
    {
        if (!$db) {
            $db = self::DATABASE;
        }
        $this->db = new \mysqli($host, $user, $pass, $db);
        if ($this->db->connect_errno) {
            exit("Ошибка !!! " . $this->db->connect_error);
        }
        $this->db->set_charset("utf8");
    }

    public function setSelect($table, $fields = "*")
    {
        $this->clear();

        $this->query = "";

        if(is_array($fields))
        {
            $list = "";
            foreach($fields as $key => $value)
            {
                $list .= "`{$value}`, ";
            }
            $fields = substr($list, 0, -2);
        }

        $this->query .= "SELECT {$fields} FROM `{$table}` ";

        return $this;
    }

    public function setLeftJoin($newTable, $oldTable, $new = false)
    {
        if($new === true)
        {
            $this->leftJoin = "";
        }

        $this->leftJoin .= "LEFT JOIN `{$newTable}` ON {$oldTable}.{$newTable}_id = {$newTable}.id ";

        return $this;
    }

    public function setWhere($where)
    {
        $this->where = "";

        $this->where .= "WHERE {$where} ";

        return $this;
    }

    public function setSort($column, $sort)
    {
        $this->sort = "";

        $this->sort .= "ORDER BY {$column} {$sort} ";

        return $this;
    }

    public function setLimit($limit)
    {
        $this->limit = "";

        $this->limit .= "LIMIT {$limit} ";

        return $this;
    }

    public function setUpdate($table, $fields)
    {
        $this->clear();
        $this->query = "";

        if(is_array($fields))
        {
            $list = "";

            foreach($fields as $key => $value)
            {
                $list .= "{$key} = '{$value}', ";
            }
            $fields = substr($list, 0, -2);
        }

        $this->query .= "UPDATE {$table} SET {$fields} ";

        return $this;
    }

    public function setDelete($table)
    {
        $this->clear();
        $this->query = "";

        $this->query = "DELETE FROM `{$table}`";

        return $this;
    }

    public function clear()
    {
        $this->limit = "";
        $this->sort = "";
        $this->leftJoin = "";
        $this->where = "";
    }

    public function setInsert($table, $column = [], $values = [])
    {
        $this->clear();
        $this->query = "";

        $list = "";
        foreach($column as $key => $value)
        {
            $list .= "`{$value}`, ";
        }
        $column = substr($list, 0, -2);

        if(is_array($values))
        {
            $list = "";
            foreach($values as $key => $value)
            {
                $list .= "(";
                foreach ($value as $key2 => $value2)
                {
                    if(is_null($value2))
                    {
                        $list .= "NULL, ";
                    }
                    else
                    {
                        $list .= "'{$value2}', ";
                    }
                }
                $list = substr($list, 0, -2);
                $list .= "), ";
            }
            $values = substr($list, 0, -2);
        }

        $this->query = "INSERT INTO `{$table}` ({$column}) VALUES {$values}";

        return $this;
    }

    public function setTruncate($table)
    {
        $this->clear();
        $this->query = "";

        $this->query .= "TRUNCATE TABLE `{$table}`";

        return $this;
    }
    
    public function getQuery()
    {
        return $this->query.
            $this->leftJoin.
            $this->where.
            $this->sort.
            $this->limit;
    }

    public function setQuery()
    {
        return $this->query($this->getQuery());
    }

    /**
     * Делает запрос к БД
     * @param string    $query  Запрос SQL
     * @return array|bool
     */
    private function query($query)
    {
        $res = $this->db->query($query);
        if ($res === false) {
            return false;
        } elseif ($res === true) {
            return true;
        } else {
            $result = array();
            while ($row = $res->fetch_assoc()) {
                $result[] = $row;
            }
            return $result;
        }
    }
}