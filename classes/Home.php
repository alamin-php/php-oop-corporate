<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../lib/Database.php");
    include_once ($filepath."/../helpers/Format.php");

    class Home{
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function showPage(){
            $query = "SELECT * FROM tbl_page WHERE status = '0' ORDER BY pageId ASC";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }

?>