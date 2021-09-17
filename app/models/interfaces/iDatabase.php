<?php
namespace App\Models\Interfaces;

interface iDatabase
{
    /**
	 * Query to DB.
	 * @param string query
     * @param array values for placeholders
	 * @return \PDOStatement
	 */

    public function dbQuery(string $queryString, array $prepareData = NULL);
}