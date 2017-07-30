<?php

    error_reporting(0);

    abstract class PdoDB {
        protected $details;
        protected $tableName;
        protected $isHaveSafetyNet;
        protected $pdo;
        protected $dbInfo;

        public function __construct($connectionDetails, $details, $isStoreColumnNameFromDB = true) {
            try {
                $this->connect($connectionDetails);

                $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                // stores column names and column types from the table of you choice in $this->dbInfo;
                if ($isStoreColumnNameFromDB) {
                    $this->setSafetyNet();
                }

                $this->isHaveSafetyNet = $isStoreColumnNameFromDB;

                $this->details = $details;

                $this->tableName = $connectionDetails['tableName'];
            }
            catch(PDOException $e) {
                $this->pdo = null;
                exit($e->getMessage());
            }
        }

        protected function connect($connectionDetails) {
                $this->pdo = new PDO('mysql:host=' . $connectionDetails['host'].
                                    ';dbname=' . $connectionDetails['db_name'] .
                                    ';charset=' . $connectionDetails['charset'],
                                    $connectionDetails['username'],
                                    $connectionDetails['password']);
        }

        protected function setSafetyNet() {
            $stmt = "SELECT distinct column_name,column_type FROM information_schema.columns WHERE table_name = 'movies';";
            $stmt = $this->pdo->prepare($stmt); //not really necessary since this stmt doesn't contain any dynamic values;
            $stmt->execute();
            $this->dbInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        protected function getResults() { }

        protected function queryBuilder($details) { }

        protected function checkInvalidColumns($arrayName) {
            foreach($this->details[$arrayName] as $column_name => $value){
                if(!$this->columnIsAllowed($column_name)){
                    $this->missingColumn($arrayName, $column_name);
                    return false;
                }
            }

            return true;
        }

        protected function missingColumn($parameterName, $columnName) {
            throw new Exception('URL ' . $parameterName . '=' . $columnName . ' is invalid. `' . $columnName . '` column not exists in the `' . $this->tableName . '` table.');
        }

        protected function columnIsAllowed($columnName){
            $colIsAllowed = false;

            foreach($this->dbInfo as $k => $arr){
                if($arr['column_name'] === $columnName){
                    $colIsAllowed = true;
                    break;
                }
            }

            return $colIsAllowed;
        }

        protected function pdo_param($col){
            $param_type = PDO::PARAM_STR;

            foreach($this->dbInfo as $k => $arr){
                if($arr['column_name'] == $col){
                    if(strstr($arr['column_type'],'int')){
                        $param_type = PDO::PARAM_INT;
                        break;
                    }
                }
            }//for testing purposes i only used INT and VARCHAR column types. Adjust to your needs...
            return $param_type;
        }
    }
?>