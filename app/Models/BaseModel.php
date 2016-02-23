<?php

namespace Models;

use Nette\Utils\Strings;

/**
 * Base class of all models
 *
 * @property-read primaryKey
 */
abstract class BaseModel extends \Nette\Object
{
	/** @var string Primary key name */
	protected $primaryKey = NULL;
	/** @var string Table name */
	protected $table = NULL;
	/** @var \DibiConnection Database connection resource */
	protected $db;


	/**
	 * Sets table and primary key names
	 * Convention: table name lowercase ending with 's', primary key lowerces without 's' appended with '_id'
	 */
	protected function setup()
	{
		$currentClass = get_called_class();
		$className = Strings::match($currentClass, '^Models\\\(.*)Model^');

		if ($className === NULL)
		{
			throw new \Nette\UnexpectedValueException('Unrecognized model class name: ' . $currentClass);
		}

		$className = $className[1];

		if ($className{strlen($className) - 1} != 's')
		{
			throw new \Nette\UnexpectedValueException("Table name '$className' not matching convention! Reimplement setup method in descendant.");
		}

		$this->table = strtolower($className);
		$this->primaryKey = strtolower(substr($className, 0, strlen($className) - 1)) . '_id';
	}

	/**
	 * Creates model
	 * @param \DibiConnection $db database connection
	 */
	public function __construct(\DibiConnection $db)
	{
		$this->db = $db;

		$this->setup();

		if ($this->primaryKey === NULL || $this->table === NULL)
		{
			throw new \Nette\InvalidArgumentException('Table or primary key has not been specified in setup method!');
		}
	}

	/**
	 * Returns primary key identifier
	 * @return string
	 */
	public function getPrimaryKeyName()
	{
		return $this->primaryKey;
	}

	/**
	 * Deletes record from table
	 * @param int $id primary key
	 */
	public function delete($id)
	{
		$this->db->delete($this->table)->where('%n = %i', $this->primaryKey, $id)->execute();
	}

	/**
	 * Deletes array of records from table
	 * @param array $id array of primary keys
	 */
	public function deleteByIds($ids)
	{
		$this->db->delete($this->table)->where('%n IN %in', $this->primaryKey, $ids)->execute();
	}

	/**
	 * Inserts new record into table
	 * @param array $values values to insert
	 * @param boolean return generated id?
	 * @return int inserted row ID
	 */
	public function insert($values, $returnId = TRUE)
	{
		$this->db->insert($this->table, $values)->execute();

		if ($returnId)
		{
			return $this->db->insertId();
		}
	}

	/**
	 * Updates existing record
	 * @param int $id primary key of updated record
	 * @param array $values array of updated values
	 */
	public function update($id, $values)
	{
		$this->db->update($this->table, $values)->where('%n = %i', $this->primaryKey, $id)->execute();
	}

	/**
	 * Finds one record by primary key
	 * @param int $id primary key
	 * @param boolean|string optional column name to search by
	 * @return \DibiRow|NULL
	 */
	public function find($id, $column = FALSE)
	{
		$column = $column === FALSE ? $this->primaryKey : $column;

		return $this->findOneBy([$column => $id]);
	}

	/**
	 * @param array $criteria array ($columnName => $value, ...)
	 * @param array $orderBy array ($columnName => $direction, ...)
	 * @return \DibiRow|NULL
	 */
	public function findOneBy(array $criteria = [], array $orderBy = [])
	{
		$result = $this->findBy($criteria, $orderBy)->fetch();

		return $result ? $result : NULL;
	}

	/**
	 * @param array $criteria array ($columnName => $value, ...)
	 * @param array $orderBy array ($columnName => $direction, ...)
	 * @return \DibiFluent
	 */
	public function findBy(array $criteria = [], array $orderBy = [])
	{
		$query = $this->db->select('%n.*', $this->table)
			->from('%n', $this->table);

		foreach ($criteria as $key => $value)
		{
			if (is_bool($value))
			{
				$query->where('%n.%n = %b', $this->table, $key, $value);
			}
			else if (is_int($value))
			{
				$query->where('%n.%n = %i', $this->table, $key, $value);
			}
			else if (is_float($value))
			{
				$query->where('%n.%n = %f', $this->table, $key, $value);
			}
			else if (is_array($value))
			{
				$query->where('%n.%n IN (%in)', $this->table, $key, $value);
			}
			else if ($value instanceof \DateTime)
			{
				$query->where('%n.%n = %d', $this->table, $key, $value->getTimestamp());
			}
			else
			{
				$query->where('%n.%n = %s', $this->table, $key, (string) $value);
			}
		}

		if (!empty($orderBy))
		{
			$query->orderBy('%by', $orderBy);
		}

		return $query;
	}

	/**
	 * Returns DibiFluent resource to full table
	 * @return \DibiFluent
	 */
	public function findAll()
	{
		return $this->findBy();
	}
}
