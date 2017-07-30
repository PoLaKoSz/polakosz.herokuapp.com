<?php

    require_once 'PdoDB.php';

    class Select extends PdoDB {
        public function __construct($connectionDetails, $details, $isStoreColumnNameFromDB = true) {
            parent::__construct($connectionDetails, $details, $isStoreColumnNameFromDB = true);
        }

        public function queryBuilder($details) {
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

            // Not working yet
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
    }
?>