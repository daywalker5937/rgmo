<?php

    include_once __DIR__ . '/session.php';

    class Access extends Session {

        public $user_id;
        public $user_role;
        public $name;

        public function __construct() {}

        public function sessionUser() {

            $data = Session::getInstance();
            $this->id = $this->user_id;
            $this->user_name = $this->name;
            $this->role_name = $this->user_role;

        }// session user


    }// class

?>