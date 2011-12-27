<?php //-->
/*
 * This file is part of the Eden package.
 * (c) 2009-2011 Christian Blanquera <cblanquera@gmail.com>
 *
 * Copyright and license information can be found at LICENSE.txt
 * distributed with this package.
 */

/**
 * Generates update query string syntax
 *
 * @package    Eden
 * @category   sql
 * @author     Christian Blanquera <cblanquera@gmail.com>
 * @version    $Id: update.php 1 2010-01-02 23:06:36Z blanquera $
 */
class Eden_Sql_Update extends Eden_Sql_Delete {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_set = array();
	
	/* Private Properties
	-------------------------------*/
	/* Get
	-------------------------------*/
	public static function get($table = NULL) {
		return self::_getMultiple(__CLASS__, $table);
	}
	
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	/**
	 * Set clause that assigns a given field name to a given value.
	 *
	 * @param string
	 * @param string
	 * @return this
	 * @notes loads a set into registry
	 */
	public function set($key, $value) {
		//argument test
		Eden_Sql_Error::get()
			->argument(1, 'string')				//Argument 1 must be a string
			->argument(2, 'string', 'numeric');	//Argument 2 must be a string or number
		
		$this->_set[$key] = $value;
		
		return $this;
	}
	
	/**
	 * Returns the string version of the query 
	 *
	 * @param  bool
	 * @return string
	 * @notes returns the query based on the registry
	 */
	public function getQuery() {
		
		$set = array();
		foreach($this->_set as $key => $value) {
			$set[] = "{$key} = {$value}";
		}
		
		return 'UPDATE '. $this->_table . ' SET ' . implode(', ', $set) . ' WHERE '. implode(' AND ', $this->_where).';';
	}
	
	/* Protected Methods
	-------------------------------*/
	/* Private Methods
	-------------------------------*/
}