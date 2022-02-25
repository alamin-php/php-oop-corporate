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

        public function addPage($data){
            $pageTitle      = $this->fm->validation($data["pageTitle"]);
            $pageSlug       = $this->fm->validation(strtolower($data["pageTitle"]));
            $sectionTitle   = $this->fm->validation($data["sectionId"]);

            $pageTitle      = mysqli_real_escape_string($this->db->link, $pageTitle);
            $pageSlug       = mysqli_real_escape_string($this->db->link, $pageSlug);
            $sectionTitle   = mysqli_real_escape_string($this->db->link, $sectionTitle);

            if(empty($pageTitle) || empty($sectionTitle)){
                $msg = "<span class='error'>Field must not be empty !</span>";
                return $msg;
            }else{
                $query = "INSERT INTO tbl_page (pageTitle, pageSlug, sectionId) VALUES ('$pageTitle', '$pageSlug', '$sectionTitle')";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                    $msg = "<span class='success'>Page created succesfully !</span>";
                    return $msg;
                }
            }

        }
        public function addSlider($data, $file){
            $sliderTitle      = $this->fm->validation($data["sliderTitle"]);
            $sliderSubTitle       = $this->fm->validation(strtolower($data["sliderSubTitle"]));
            $btnTitle   = $this->fm->validation($data["btnTitle"]);
            $btnLink   = $this->fm->validation($data["btnLink"]);

            $sliderTitle      = mysqli_real_escape_string($this->db->link, $sliderTitle);
            $sliderSubTitle      = mysqli_real_escape_string($this->db->link, $sliderSubTitle);
            $btnTitle      = mysqli_real_escape_string($this->db->link, $btnTitle);
            $btnLink      = mysqli_real_escape_string($this->db->link, $btnLink);


            $permited = array("jpg", "jpeg", "png");
            $file_name = $file["image"]["name"];
            $file_size = $file["image"]["size"];
            $file_tmp_name = $file["image"]["tmp_name"];

            $divi = explode(".", $file_name);
            $file_extn = strtolower(end($divi));
            $unique_file_name = substr(md5(time()), 0, 10).'.'.$file_extn;
            $uploaded_file = "upload/".$unique_file_name;


            if(empty($sliderTitle) || empty($sliderSubTitle)){
                $msg = "<span class='error'>Field must not be empty !</span>";
                return $msg;
            }elseif($file_size > 1048576){
                $msg = "<span class='error'>Image size must be less then 1 MB !</span>";
                return $msg;
            }elseif(in_array($file_extn, $permited) == false){
                $msg = "<span class='error'>You can upload only:-".implode(", ", $permited)." files !</span>";
                return $msg;
            }else{
                move_uploaded_file($file_tmp_name, $uploaded_file);
                $query = "INSERT INTO tbl_slider (sliderTitle, sliderSubTitle, btnTitle, btnLink, image) VALUES ('$sliderTitle', '$sliderSubTitle', '$btnTitle', '$btnLink', '$uploaded_file')";
                $insert_row = $this->db->insert($query);
                if($insert_row){
                    $msg = "<span class='success'>Slider created succesfully !</span>";
                    return $msg;
                }
            }

        }

        
        public function updatePage($data, $id){
            $pageTitle      = $this->fm->validation($data["pageTitle"]);
            $pageSlug       = $this->fm->validation(strtolower($data["pageTitle"]));
            $sectionTitle   = $this->fm->validation($data["sectionId"]);

            $pageTitle      = mysqli_real_escape_string($this->db->link, $pageTitle);
            $pageSlug       = mysqli_real_escape_string($this->db->link, $pageSlug);
            $sectionTitle   = mysqli_real_escape_string($this->db->link, $sectionTitle);
            $id             = mysqli_real_escape_string($this->db->link, $id);

            if(empty($pageTitle) || empty($sectionTitle)){
                $msg = "<span class='error'>Field must not be empty !</span>";
                return $msg;
            }else{
                $query = "UPDATE tbl_page SET
                         pageTitle='$pageTitle',
                         pageSlug='$pageSlug',
                         sectionId='$sectionTitle' WHERE
                         pageId='$id' ";
                $update_row = $this->db->update($query);
                if($update_row){
                    $msg = "<span class='success'>Page Update succesfully !</span>";
                    return $msg;
                }
            }

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
        public function getSlider(){
            $query = "SELECT * FROM tbl_slider WHERE status = '0' ORDER BY sliderId ASC";
            $result = $this->db->select($query);
            if($result){
                return $result;
            }else{
                return false;
            }
        }

        public function pageById($id){
            $query = "SELECT * FROM tbl_page WHERE pageId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            if($result){
                return $result;
            }else{
                return false;
            }
        }
    }

?>