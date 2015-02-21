<?php
	class DaoEntity{
		private static $initialized = false;
		private static $connection;
				
		private function __construct() {}
		
		private static function initialize()
		{
			if (!self::$initialized)
			{
				self::$connection = new Connection();
				self::$initialized = true;
			}
		}
		
		private static function doSQLQueryWithObject($type,$modelObj,$order=null)
		{
			$modelName = strtolower($modelObj->getModelName());
			$sql = "";
			if($type=="select")
			{
				$sql = "$type * from $modelName";
		
				$attributes = $modelObj->get_class_vars();
				$first = true;
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param) && $param!="" && $param!=null)
					{
						if(!$first)
						{
							$sql .= " and ";
						}
						else {
							$sql .= " where ";
							$first = false;
						}
		
						$sql .= $att ."=:". $att;
					}
				}
		
				$sql .= ($param!=null ? " order by $order" : "");
		
				$query = self::$connection->getConnection()->prepare($sql);
		
				foreach( $attributes as $att )
				{
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param)&&$param!=""&&$param!=null)
						$query->bindValue(":".$att, $param);
				}
		
				ErrorConsole::info("Query: ".$sql);
				
				$query->execute();
				
				$result = null;
				while($row = $query->fetchObject(get_class($modelObj)))
				{
					if($result==null) $result[0] = $row;
					else array_push($result,$row);
				}
		
				return $result;
			}
			else if($type=="insert")
			{
				$sql = "$type into $modelName (";
								
				$attributes = $modelObj->get_class_vars();
				$first = true;
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param) && $param!=null && $param!="")
					{
						if(!$first)
						{
							$sql .= " , ";
						}
						else $first = false;
						
						$sql .= $att ;
					}
				}
			
				$sql .= ") values (";
				
				$attributes = $modelObj->get_class_vars();
				$first = true;
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param) && $param!=null && $param!="")
					{
						if(!$first)
						{
							$sql .= " , ";
						}
						else $first = false;
						
						$sql .= ":" . $att ;
					}
				}
				
				$sql .= ")";
				
				ErrorConsole::info("Query: ".$sql);
				
				$query = self::$connection->getConnection()->prepare($sql);
					
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param) && $param!=null && $param!="")
						$query->bindValue(":".$att, $param);
				}	
				
				$query->execute();
				
				$lastId = self::$connection->getConnection()->lastInsertId();
				ErrorConsole::info("LastInsertId for ".$modelObj->getModelName()." -> ".$lastId);
				
				$newModelName = get_class($modelObj);
				$modelObj = new $newModelName();
				$modelObj->setId($lastId);
								
				return DaoEntity::doSQLQueryWithObject("select",$modelObj)[0];
			}
			else if($type=="delete")
			{
				$modelId = $modelObj->getId();
				if($modelId==""||$modelId==null)
					return 0;
				
				$sql = "delete from $modelName";
				
				$sql .= " where id=:id";
					
				$attributes = $modelObj->get_class_vars();
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param) && $att!="id")
						$sql .= " and ". $att ."=:". $att;
				}
					
				ErrorConsole::info("Query: ".$sql);
				
				$query = self::$connection->getConnection()->prepare($sql);
				
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param))
						$query->bindValue(":".$att, $param);
				}
					
				$query->execute();
					
				$rowCount = $query->rowCount();
			}
			else if($type=="update")
			{
				$modelId = $modelObj->getId();
				if($modelId==""||$modelId==null)
					return 0;
				
				$sql = "update $modelName set ";
				
				
				$attributes = $modelObj->get_class_vars();
				$first = true;
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param))
					{
						if(!$first)
						{
							$sql .= " , ";
						}
						else $first = false;
				
						$sql .= $att . "=:" . $att ;
					}
				}
					
				$sql .= " where id=:id";
				
				ErrorConsole::info("Query: ".$sql);
					
				$query = self::$connection->getConnection()->prepare($sql);
					
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param))
						$query->bindValue(":".$att, $param);
				}
				
				$query->execute();
				
				$newModelName = get_class($modelObj);
				$idModel = $modelObj->getId();
				$modelObj = new $newModelName();
				$modelObj->setId($idModel);
								
				return DaoEntity::doSQLQueryWithObject("select",$modelObj)[0];
			}
			else
				return null;
		}
		
		private static function doSQLQueryWithObjectLike($type,$modelObj,$order=null)
		{
			$modelName = strtolower($modelObj->getModelName());
			$sql = "";
			if($type=="select")
			{
				$sql = "$type * from $modelName";
						
				$attributes = $modelObj->get_class_vars();
				$first = true;
				foreach( $attributes as $att ){
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param) && $param!="" && $param!=null)
					{
						if(!$first)
						{
							$sql .= " and ";
						}
						else {
							$sql .= " where "; 
							$first = false;
						}
						
						$sql .= $att ."like '%:". $att . "%'";
					}
				}
				
				$sql .= ($param!=null ? "order by $order" : "");
				
				ErrorConsole::info("Query: ".$sql);
				
				$query = self::$connection->getConnection()->prepare($sql);
				
				foreach( $attributes as $att )
				{
					$getParam = "get".ucfirst($att);
					$param = $modelObj->$getParam();
					if(isset($param)&&$param!=""&&$param!=null)
						$query->bindValue(":".$att, $param);
				}	
		
				$query->execute();
				
				$result = null;
				while($row = $query->fetchObject(get_class($modelObj)))
				{
					if($result==null) $result[0] = $row;
					else array_push($result,$row);
				}
				
				return $result;
			}
		}
	
		/**
		 * Gets a list of $modelObj Class from the database using select ... model_param like %model_param% or null, if nothing could be retrieven.
		 * Example: DaoEntity::getObjectArrayLike($modelObj,'nome asc');
		 * 
		 * @param Model $modelObj
		 * @param string $order
		 * @return null|Array
		 */
		public static final function getObjectArrayLike($modelObj,$order=null)
		{
			self::initialize();
			return self::doSQLQueryWithObjectLike("select",$modelObj,$order);
		}
		
		/**
		 * Gets a list of $modelObj Class from the database using select ... model_param=%model_param% or null, if nothing could be retrieven.
		 * Example: DaoEntity::getObjectArray($modelObj,'nome asc');
		 *
		 * @param Model $modelObj
		 * @param string $order
		 * @return null|Array
		 */
		public static final function getObjectArray($modelObj,$order=null)
		{
			self::initialize();
			return self::doSQLQueryWithObject("select",$modelObj,$order);
		}
		
		/**
		 * Updates a $modelObj of the database.
		 * Returns the row count of the transaction.
		 *
		 * @param Model $modelObj
		 * @return int
		 */
		public static final function updateObject($modelObj)
		{
			self::initialize();
			return self::doSQLQueryWithObject("update",$modelObj);
		}
		
		/**
		 * Inserts a $modelObj in the database.
		 * Returns the row count of the transaction.
		 *
		 * @param Model $modelObj
		 * @return int
		 */
		public static final function insertObject($modelObj)
		{
			self::initialize();
			return self::doSQLQueryWithObject("insert",$modelObj);
		}
		
		/**
		 * Deletes a $modelObj of the database.
		 * Returns the row count of the transaction.
		 *
		 * @param Model $modelObj
		 * @return int
		 */
		public static final function removeObject($modelObj)
		{
			self::initialize();
			return self::doSQLQueryWithObject("delete",$modelObj);
		}
		
		
		/* ORM Functions */
		private static function doSQLRelationJoin($modelObj,$relatedModel,$order=null)
		{
			if( !is_object($modelObj) || !is_object($relatedModel) )
			{
				ErrorConsole::error("Not a object");
				return null;
			}
		
			$modelName = strtolower($modelObj->getModelName());
			$relModelName = strtolower($relatedModel->getModelName());
			$tableName = (self::$connection->tableExists($modelName."_".$relModelName)?$modelName."_".$relModelName:$relModelName."_".$modelName);
		
			$sql  = "select ".$relModelName.".* from ".$tableName." jn_tb ";
			$sql .= "inner join ".$relModelName." on jn_tb.id_".$relModelName." = ".$relModelName.".id ";
			$sql .= "where jn_tb.id_".$modelName." = :idmodel";

			$attributes = $relatedModel->get_class_vars();
			$first = true;
			foreach( $attributes as $att ){
				$getParam = "get".ucfirst($att);
				$param = $relatedModel->$getParam();
				if(isset($param) && $param!="" && $param!=null)
					$sql .= " and $relModelName.". $att ."=:". $att;
			}
			
			$query = self::$connection->getConnection()->prepare($sql);
			
			foreach( $attributes as $att )
			{
				$getParam = "get".ucfirst($att);
				$param = $relatedModel->$getParam();
				if(isset($param)&&$param!=""&&$param!=null)
					$query->bindValue(":".$att, $param);
			}
			
			$sql .= ($order!=null ? " order by $order" : "");
						
			ErrorConsole::info("Query: ".$sql);			
			
			$idModel = $modelObj->getId();
			$query->bindValue(":idmodel", $idModel);
			
			$query->execute();
			
			$result = null;
			while($row = $query->fetchObject(get_class($relatedModel)))
			{
				if($result==null) $result[0] = $row;
				else array_push($result,$row);
			}
			
			return $result;
		}
		private static function doAssociation($modelObj,$relatedModel)
		{
			if( !is_object($modelObj) || !is_object($relatedModel) ) throw new Exception("Unnable to associate non-objects");
			
			$idModel = $modelObj->getId();
			$idRelModel = $relatedModel->getId();
			
			if($idModel==""||$idModel==null) return 0;
			if($idRelModel==""||$idRelModel==null) return 0;
			
			$modelName = strtolower($modelObj->getModelName());
			$relModelName = strtolower($relatedModel->getModelName());
			$tableName = (self::$connection->tableExists($modelName."_".$relModelName)?$modelName."_".$relModelName:$relModelName."_".$modelName);
			
			$sql = "insert into $tableName (id_".$modelName.",id_".$relModelName.") values (:idModel,:idRel)";
		
			ErrorConsole::info("Query: ".$sql);	
				
			$query = self::$connection->getConnection()->prepare($sql);
			$query->bindValue(":idModel", $idModel);
			$query->bindValue(":idRel", $idRelModel);
				
			$query->execute();
			
			return $query->rowCount();
		}
		private static function doDisassociation($modelObj,$relatedModel)
		{
			if( !is_object($modelObj) || !is_object($relatedModel) ) return 0;
				
			$idModel = $modelObj->getId();
			$idRelModel = $relatedModel->getId();
			
			if($idModel==""||$idModel==null) return 0;
			if($idRelModel==""||$idRelModel==null) return 0;
			
			$modelName = strtolower($modelObj->getModelName());
			$relModelName = strtolower($relatedModel->getModelName());
			$tableName = (self::$connection->tableExists($modelName."_".$relModelName)?$modelName."_".$relModelName:$relModelName."_".$modelName);
				
			$sql = "delete from $tableName where id_".$modelName."=:idModel and id_".$relModelName."=:idRel";
		
			ErrorConsole::info("Query: ".$sql);
			
			$query = self::$connection->getConnection()->prepare($sql);
			$query->bindValue(":idModel", $idModel);
			$query->bindValue(":idRel", $idRelModel);
		
			$query->execute();
				
			return $query->rowCount();
		}
		private static function doDisassociateAll($modelObj,$relatedModel)
		{
			if( !is_object($modelObj) || !is_object($relatedModel) ) return 0;
			
			$idModel = $modelObj->getId();
				
			if($idModel==""||$idModel==null) return 0;
				
			$modelName = strtolower($modelObj->getModelName());
			$relModelName = strtolower($relatedModel->getModelName());
			$tableName = (self::$connection->tableExists($modelName."_".$relModelName)?$modelName."_".$relModelName:$relModelName."_".$modelName);
			
			$sql = "delete from $tableName where id_".$modelName."=:idModel";
				
			ErrorConsole::info("Query: ".$sql);
				
			$query = self::$connection->getConnection()->prepare($sql);
			$query->bindValue(":idModel", $idModel);
			
			$query->execute();
			
			return $query->rowCount();
		}
		
		public static final function getAssociatedObjectArray($modelObj,$relatedModel,$order=null)
		{
			self::initialize();
			return self::doSQLRelationJoin($modelObj,$relatedModel,$order);
		}	
		public static final function associateObjects($modelObj,$relatedModel)
		{
			self::initialize();
			return self::doAssociation($modelObj,$relatedModel);
		}
		public static final function disassociateObjects($modelObj,$relatedModel)
		{
			self::initialize();
			return self::doDisassociation($modelObj,$relatedModel);
		}
		public static final function disassociateAll($modelObj,$relatedModel)
		{
			self::initialize();
			return self::doDisassociateAll($modelObj,$relatedModel);
		}
		
		public static final function doQuery($sql)
		{
			self::initialize();
			$query = self::$connection->getConnection()->prepare($sql);
			$query->execute();
			
			return $query;
		}
	}
?>
