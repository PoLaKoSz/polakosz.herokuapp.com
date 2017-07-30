<?php

class UrlParser {
    protected $maxResultLimit;
    protected $URL;
    public $resultArray;
    protected $orderTypes = [
        'ASC',
        'DESC',
    ];

    public function __construct($GET, $maxResultLimit) {
        $this->maxResultLimit = $maxResultLimit;

        $this->URL = $GET;

        $this->resultArray = $this->setShownColumns($this->URL);

        if ( !empty($this->URL['order']) ) {
            $this->resultArray['order'] = $this->setOrder($this->URL);
        }

        if ( !empty($this->URL['limit']) ) {
            $this->resultArray['limit'] = $this->setLimit($this->URL);
        } else {
            $this->resultArray['limit'] = $this->maxResultLimit;
        }
    }

    public function setShownColumns($url) {
        if ( empty($url['fields']) ) {
            throw new Exception('Critical error. `fields` parameter not exists.');
        }

        $columnNames = explode(',', $url['fields']);

        $flipped = array_flip($columnNames);

        return [
            'fields' => $flipped
        ];
    }

    public function setOrder($url) {
        $section = explode(',', $url['order']);

        $resultArray['order'] = [];

        $tmp = [];

        foreach ($section as $key => $value) {
            $rule = explode(':', $value);

            $orderType = $rule[1];

            $findResult = array_search($orderType, $this->orderTypes);

            if ( $findResult === false ) {
                throw new ExceptioN('Invalid order type: ' . $orderType);
            }

            $tmp = array_merge($tmp, [ $rule[0] => $orderType ]);
        }

        return $tmp;
    }

    public function setLimit($url) {
        $parameter = $url['limit'];
        $commaCount = substr_count($parameter, ',');

        if ( $commaCount > 1) {
            throw new Exception('Invalid parameter at limit=' . $parameter . '. More than one comma.');
        } else if ( $commaCount == 0 ) {
            if ( $parameter > $this->maxResultLimit ) {
                throw new Exception('Invalid parameter at limit=' . $parameter . '. Value can not be greater than ' . $this->maxResultLimit . '.');
            }

            return $parameter;
        } else if ( $commaCount == 1 ) {    
            $numbers = explode(',', $parameter);

            if ($numbers[1] > $this->maxResultLimit) {
                throw new Exception('Invalid parameter at limit=' . $parameter . '. Value count can not be greater than ' . $this->maxResultLimit . '.');
            }

            return $parameter;
        }

        return -1;
    }
}

?>