<?php

class Category {

    private $_db,
            $_category;

    public function __construct() {
        $this->_db = DB::getInstance();
        $this->_category = $this->_db->action("SELECT *", "ss_category", array('1', '=', '1'));
    }

    public function exist() {
        return (!empty($this->_category)) ? true : false;
    }

    public function get() {
        return $this->_category;
    }

    public function rows() {
        return $this->_category->count();
    }

    public function subCategory($parentId) {
        return $this->_db->action("SELECT *", "ss_sub_category", array('category_id', '=', $parentId));
    }
}