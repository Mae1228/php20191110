<?php
	class SqlHelper{
		/*private $conn;
		private $dbname;
		private $host;
		private $username;
		private $password;
		public function __construct($username,$password,$host,$dbname){
			$this->conn=mysql_connect($host,$username,$password);
			mysql_select_db($dbname);
		}
		public function execute_dql($sql){
			$res=mysql_query($sql,$this->conn);
			$arr=array();
			$i=0;
			while($row=mysql_fetch_assoc($res)){
				$arr[$i++]=$row;
			}
			mysql_free_result($res);
			return $arr;
		}
		public function execute_dml($sql){
			$res=mysql_query($sql,$this->conn);
			if($res){
				return true;
			}
			else{
				return false;
			}
		}
		public function getRow($sql){//验证有无这样一行信息
			$res=mysql_query($sql,$this->conn);
			$arr=array();
			$i=0;
			if($row=mysql_fetch_assoc($res)){
				$arr[$i++]=$row;
			}
			mysql_free_result($res);
			if($arr){
				return $arr;
			}
			else{
				return false;
			}
		}
		public function getOne($sql){
			$res=mysql_query($sql,$this->conn);
			$arr=array();
			
			if($row=mysql_fetch_assoc($res)){
				$arr=$row;
			}
			return $arr;
			mysql_free_result($res);
			
		}
		public function escapeString($oldstring){//防止sql注入，强制转义
			return "'".mysql_real_escape_string($oldstring,$this->conn)."'"
			//php中强制转义函数 addslashes($oldstring);
			//魔术引号，现已不再使用
		}
		public function closeConnect(){
		if(!empty($this->conn)){
				mysql_close($this->conn);
			}
		}*/
		private $pdo;//PHP DATA OBJECT
		public function __construct($username,$password,$host,$dbname){
			$dsn='mysql:host='.$host.';port=3306;dbname='.$dbname;//初始化端口，数据库名，主机
			$driver_option=array(
				PDO::MYSQL_ATTR_INIT_COMMAND    =>'set names utf8'
			);
			$this->pdo=new PDO($dsn,$username,$password,$driver_option);
		}
		public function execute_dql($sql){
			
			$res=$this->pdo->query($sql);//返回的是PDOSTATEMENT对象
			return $res->fetchAll(PDO::FETCH_ASSOC);
		}
		public function execute_dml($sql){
			
			$res=$this->pdo->exec($sql);//表示受影响的行数，如果操作失败，则返回false
			if($res===false){
				return false;
			}
			else{
				return true;
			}
		}
		public function getOne($sql){//获得一行数据
			
			$res=$this->pdo->query($sql);
			$row=array();
			$row=$res->fetch(PDO::FETCH_ASSOC);	
			return $row;
		}
		public function escapeString($old_str){//防止sql注入，强制转义
			return $this->pdo->quote($old_str);	
		}
		public function getPageNum($sql){
			$res=$this->pdo->query($sql);
			return $res->rowCount();
		}
		public function getlastid($sql){
			$res=$this->pdo->exec($sql);//表示受影响的行数，如果操作失败，则返回false
			if($res===false){
				return false;
			}
			else{
				return $this->pdo->lastInsertID();
			}
		}
		
	}
		
	
?>