<?php

namespace Smart\Database;

use PDO;

class Database extends PDO
{

	function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
	{
		parent::__construct(($DB_TYPE .':host='. $DB_HOST .';dbname='. $DB_NAME), $DB_USER, $DB_PASS);
		parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	/*
	 * select
     * @param type string $sql       A SQL string
     * @param type string $data      Parameters to bind
     * @param constant    $fetchMode PDO fetch modes
     * @return mixed
	 */
	public function select($sql, $data = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$statment = $this->prepare($sql);
		foreach ($data as $key => $value) {
			$statment->bindValue(":$key", $value);
		}
		$statment->execute();

		return $statment->fetchAll($fetchMode);
	}

	/*
	 * insert
         * @param type string $table A name of table to insert into
         * @param type array  $data  An associative array
	 */
	public function insert($table, $data)
	{
            // Sort by key
            ksort($data);

            $fieldNames  = implode(",", array_keys($data));
            $fieldValues = (":" . implode(",:", array_keys($data)));
            $statment    = $this->prepare(
                "INSERT INTO $table($fieldNames) VALUES($fieldValues)"
            );

            foreach ($data as $key => $value) {
                $statment->bindValue(":$key", $value);
            }

            return $statment->execute();
	}

	/*
	 * update
     * @param type string $table A name of table to insert into
     * @param type array  $data  An associative array
     * @param type string $where The where query part
	 */
	public function update($table, $data, $where)
	{
            // Sort by key
            ksort($data);

            $fieldDetails = null;
            foreach ($data['columns'] as $key => $value) {
                $fieldDetails .= "$key=:$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');
            $statment = $this->prepare(
                "UPDATE $table SET $fieldDetails WHERE $where"
            );

            foreach ($data['columns'] as $key => $value) {
                $statment->bindValue(":$key", $value);
            }
            foreach ($data['where'] as $key => $value) {
                $statment->bindValue(":$key", $value);
            }
            $statment->execute();
	}

	/*
	 * delete
     * @param type string  $table A name of table to insert into
     * @param type array   $data  An associative array
     * @param type string  $where The where query part
     * @param type integer $limit The maximun records to delete
     * @return integer            Afected rows
	 */
	public function delete($table, $data, $where, $limit = 1)
	{
		/*
		 * PostgreSQL has the clause limit only in select queries.
		 * The following line is commented because of this
		 *
		 * $statment = $this->prepare("DELETE FROM $table WHERE $where LIMIT $limit");
		 *
		 * If the database change, it's recomended to use the commented line to prevent
		 * issues
		 *
		 */
		$statment = $this->prepare("DELETE FROM $table WHERE $where");
		foreach ($data as $key => $value) {
			$statment->bindValue(":$key", $value);
		}
		
		return $statment->execute();
	}

	/*
	 * lastInsertId
     * @return integer Last inserted ID
	 */
	public function lastId()
	{
		return $this->lastInsertId();
	}
}