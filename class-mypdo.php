<?
if ( defined ( '_CLASS_MYPDO_PHP' ) ) return;
define ( '_CLASS_MYPDO_PHP', 0x0204 );
define ( '_CLASS_MYPDO_REL', 0x0001 );

class MyPDO extends PDO {
	var	$connect_charset = false;

	function	__construct ( $url, $param = false ) {
		if ( $p = parse_url ( $url ) ) {
			$db_name = trim ( isset ( $p [ 'path' ] ) ? $p [ 'path' ] : '', '/' );

			if ( is_array ( $param ) && isset ( $param [ 'charset' ] ) ) $this -> connect_charset = $param [ 'charset' ];

			parent::__construct ( $this -> connect_url = sprintf ( '%s:host=%s;port=%d%s', $p [ 'scheme' ], $p [ 'host' ], isset ( $p [ 'port' ] ) ? $p [ 'port' ] : 3306, $db_name ? sprintf ( ';dbname=%s', $db_name ): ''  ), @$p [ 'user' ], @$p [ 'pass' ] );

			if ( $this -> connect_charset ) {
				$this -> query ( sprintf ( "SET CHARACTER SET %s", addslashes ( 'utf8' ) ) );
				$this -> query ( sprintf ( "SET NAMES %s", addslashes ( 'utf8' ) ) );
			}
		}
	}

	function	query ( $q ) {
		if ( !( $r = parent::query ( $q ) ) ) {
			printf ( "SQL error in QUERY: %s\n\n", $q );

			print_r ( $this -> errorInfo ( ) );
			exit ( );
		}

		return $r;
	}

	function	begin ( ) {
		$this -> beginTransaction ( );
	}

	function	escape ( $q ) {
		return $this -> quote ( $q );
	}

	function	queryGet ( $q, $cache = false ) {
		$key = 'MYSQL_GET_' . md5 ( $q );

		if ( ( $cache !== false ) && ( $result = MC::get ( $key ) ) ) return $result;

		$result = $this -> query ( $q ) -> fetch ( PDO::FETCH_ASSOC );

		if ( $result !== NULL && $result !== false ) MC::set ( $key, $result, $cache );

		return $result;
	}

	function	queryColumn ( $q, $cache = false ) {
		$key = 'MYSQL_COLUMN_' . md5 ( $q );

		if ( ( $cache !== false ) && ( $result = MC::get ( $key ) ) ) return $result;

		$result = $this -> query ( $q ) -> fetchColumn ( );

		if ( $result !== NULL && $result !== false ) MC::set ( $key, $result, $cache );

		return $result;
	}

	function	queryList ( $q ) {
		return $this -> query ( $q ) -> fetchAll ( PDO::FETCH_ASSOC );
	}

	function	queryNamedList ( $q, $item = false, $cache = false ) {
		$key = 'MYSQL_NAMED_LIST_' . md5 ( $q );

		if ( ( $cache !== false ) && ( $result = MC::get ( $key ) ) ) return $result;

		$result = NULL;

		if ( $result_pre = $this -> query ( $q ) -> fetchAll ( PDO::FETCH_ASSOC ) ) {
			if ( $item === false ) $item = array_keys ( $result_pre [ 0 ] ) [ 0 ];

			foreach ( $result_pre as &$i ) {
				$result [ $i [ $item ] ] = $i;
			}
		} else $result = is_array ( $result_pre ) ? array ( ) : false;

		if ( $result !== NULL && $result !== false ) MC::set ( $key, $result, $cache );

		return $result;
	}

	function	queryListItem ( $q, $cache = false ) {
		$key = 'MYSQL_LIST_ITEM_' . md5 ( $q );

		if ( ( $cache !== false ) && ( $result = MC::get ( $key ) ) ) return $result;

		$result = $this -> query ( $q ) -> fetchAll ( PDO::FETCH_COLUMN );

		if ( $result !== NULL && $result !== false ) MC::set ( $key, $result, $cache );

		return $result;
	}

	function	queryPairs ( $q, $cache = false ) {
		$key = 'MYSQL_PAIRS_' . md5 ( $q );

		if ( ( $cache !== false ) && ( $result = MC::get ( $key ) ) ) return $result;

		$result = $this -> query ( $q ) -> fetchAll ( PDO::FETCH_KEY_PAIR );

		if ( $result !== NULL && $result !== false ) MC::set ( $key, $result, $cache );

		return $result;
	}

	function	queryInsert ( $q ) {
		if ( $this -> query ( $q ) ) {
			return $this -> lastInsertId ( ) ? $this -> lastInsertId ( ) : true;
		}

		return false;
	}

	function	queryInsertA ( $table, $data, $replace = false, $return_sql = false ) {
		$k_names = $k_values = array ( );
	
		for ( reset ( $data ); list ( $k, $v ) = each ( $data ); ) {
			$k_names [ ] = addslashes ( $k );

			if ( is_string ( $v ) ) {
				$k_values [ ] = $this -> escape ( $v );
			} else {
				if ( is_null ( $v ) ) {
					$k_values [ ] = 'NULL';
				} else if ( is_bool ( $v ) ) {
					$k_values [ ] = $v ? 'true' : 'false';
				} else {
					$k_values [ ] = $v;
				}
			}
		}

		$sql = sprintf ( '%s INTO %s ( %s ) VALUES ( %s )', $replace ? 'REPLACE' : 'INSERT', addslashes ( $table ), implode ( $k_names, ', ' ), implode ( $k_values, ', ' ) );

		if ( $return_sql ) return $sql;

		return $this -> queryInsert ( $sql );
	}

	function	queryUpdateA ( $table, $data, $where, $ignore = false, $return_sql = false ) {
		$keys = array ( );
	
		for ( reset ( $data ); list ( $k, $v ) = each ( $data ); ) {
			if ( is_array ( $ignore ) && in_array ( $k, $ignore ) ) continue;

			$k_n = addslashes ( $k );

			if ( is_string ( $v ) ) {
				$k_v = $this -> escape ( $v );
			} else {
				if ( is_null ( $v ) ) {
					$k_v = 'NULL';
				} else if ( is_bool ( $v ) ) {
					$k_v = $v ? 'true' : 'false';
				} else {
					$k_v = $v;
				}
			}

			$keys [ ] = "$k_n = $k_v";
		}

		if ( count ( $keys ) ) {
			$sql = sprintf ( "UPDATE %s SET %s WHERE %s", addslashes ( $table ), implode ( $keys, ', ' ), $where );
		} else {
			$sql = "SELECT NOW()";
		}

		if ( $return_sql ) return $sql;

		return $this -> query ( $sql );
	}

	function	hello ( ) {
		return sprintf ( 'Hello from %s: %s' . "\n", get_class ( $this ), $this -> queryColumn ( 'SELECT NOW()' ) );
	}
}

?>
