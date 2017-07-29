<?php

    error_reporting(0);

class PdoDB {
    protected $details;
    private $ableName;
    private $isHaveSafetyNet;
    private $pdo;
    private $dbInfo;

    public function __construct($connectionDetails, $details, $isStoreColumnNameFromDB) {
            try {
                $this->connect($connectionDetails);

                $this->pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

                //when class is called upon, it stores column names and column types from the table of you choice in $this->dbInfo;
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

        private function connect($connectionDetails) {
                $this->pdo = new PDO('mysql:host=' . $connectionDetails['host'].
                                    ';dbname=' . $connectionDetails['db_name'] .
                                    ';charset=' . $connectionDetails['charset'],
                                    $connectionDetails['username'],
                                    $connectionDetails['password']);
        }

        private function setSafetyNet() {
            $stmt = "SELECT distinct column_name,column_type FROM information_schema.columns WHERE table_name = 'movies';";
            $stmt = $this->pdo->prepare($stmt); //not really necessary since this stmt doesn't contain any dynamic values;
            $stmt->execute();
            $this->dbInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getResults() {
            $queryString = $this->queryBuilder($this->details);

            $queryString = $this->pdo->prepare($queryString);
            
            //obviously now i have to bindValue()
            foreach($this->details['query'] as $columnName => $value){
                $queryString->bindValue(':' . $columnName . '_val', '%' . $value . '%');
                //setting PDO::PARAM... type based on column_type from $this->dbInfo
            }

            $queryString->execute();
            return $queryString->fetchAll(PDO::FETCH_ASSOC);
        }

        private function queryBuilder($details) {
            if ( empty($details['fields']) ) {
                return $this->missingParameter('fields');
            }        

            if ($this->isHaveSafetyNet && 
                !$this->checkInvalidColumns('fields') ||
                !$this->checkInvalidColumns('query') ||
                !$this->checkInvalidColumns('order')) {
                    return;
            }

            $query = 'SELECT ';
            foreach($details['fields'] as $columnName => $v){
                $query .= $columnName.',';
            }

            $query = substr($query, 0, -1);

            $query .= ' FROM ' . $this->tableName;

            if ( !empty($details['query']) ) {
                $query .= ' WHERE ';
                foreach($details['query'] as $columnName => $v){
                    $query .= $columnName.' LIKE CONCAT(:' . $columnName . '_val, "%") AND ';
                }
                
                $query = substr($query, 0, -5);
            }

            if ( !empty($details['order']) ) {
                $query .= ' ORDER BY ';
                foreach($details['order'] as $columnName => $orderType){
                    $query .= $columnName.' ' . $orderType . ', ';
                }
                
                $query = substr($query, 0, -2);
            }

            if ( !empty($details['limit']) ) {
                $query .= ' LIMIT ' . $details['limit'];
            }

            return $query;
        }

        private function checkInvalidColumns($arrayName) {
            foreach($this->details[$arrayName] as $column_name => $value){
                if(!$this->columnIsAllowed($column_name)){
                    $this->missingColumn($arrayName, $column_name);
                    return false;
                }
            }

            return true;
        }

        private function missingColumn($parameterName, $columnName) {
            echo json_encode($error =  [
                    'response' => [
                        'message' => 'URL ' . $parameterName . '=' . $columnName . ' is invalid. `' . $columnName . '` column not exists in the `' . $this->tableName . '` table. Fix it!',
                        'status' => 'error',
                    ]
                ]);
        }

        private function missingParameter($parameterName) {
            return json_encode($error =  [
                    'response' => [
                        'message' => 'Missing `' . $parameterName . '` parameter. Nothing to respond.',
                        'status' => 'error',
                    ]
                ]);
        }

        public function columnIsAllowed($columnName){
            $colIsAllowed = false;

            foreach($this->dbInfo as $k => $arr){
                if($arr['column_name'] === $columnName){
                    $colIsAllowed = true;
                    break;
                }
            }

            return $colIsAllowed;
        }

        public function pdo_param($col){
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