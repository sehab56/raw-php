<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php
    /**
    * 
    */
    class Customer{
        public $db;
        public $fm;

        
        function __construct(){
            $this->db = new Database();
            $this->fm = new format();
        } 


        public function insertCustomer($data){
            $name       = mysqli_real_escape_string($this->db->link,    $data['name']);
            $address    = mysqli_real_escape_string($this->db->link,    $data['address']);
            $city       = mysqli_real_escape_string($this->db->link,    $data['city']);
            $country    = mysqli_real_escape_string($this->db->link,    $data['country']);
            $zip        = mysqli_real_escape_string($this->db->link,    $data['zip']);
            $phone      = mysqli_real_escape_string($this->db->link,    $data['phone']);
            $email      = mysqli_real_escape_string($this->db->link,    $data['email']);
            $pass       = mysqli_real_escape_string($this->db->link,    md5($data['pass']));

            $mafddsf = "SELECT * FROM tbl_customer WHERE email = '$email' LIMIT 1";
            $matchquery = $this->db->select($mafddsf);

            if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || 
            $phone == "" || $email == "" || $pass == "") {
                $productmss =  "<span style='color:red'>filed must not be empty .</span>";
                echo $productmss;
            }elseif($matchquery != false){
                 $productmss =  "<span style='color:red'>This Email Is already Add .</span>";
                echo $productmss;
            }else{   
                $query = "INSERT INTO tbl_customer(name, address , city, country , zip ,phone ,email,pass ) 
                VALUES 
                ('$name','$address','$city', '$country','$zip','$phone','$email','$pass') ";
                $addpost = $this->db->insert($query);
                if($addpost){
                    $productmss = "<span style='color:green'>Apner Data INSERT Successfully</span>";
                    return $productmss;
                }else{
                    $productmss = "<span style='color:red'>Apner Data Data NOt Insert Successfully</span>";
                    return $productmss;
                }
            }
        }
        public function checkLogin($data){
            $loginemail = mysqli_real_escape_string($this->db->link,    $data['loginemail']);
            $password   = mysqli_real_escape_string($this->db->link,    md5($data['password']));

            if ($loginemail == "" || $password == "") {
                $productmss = "<span style='color:red'>Field Must Be FieldUp</span>";
                        return $productmss;
            }elseif (!filter_var($loginemail,FILTER_VALIDATE_EMAIL)) {
               $productmss = "<span style='color:red'>Please Enter Valid Email Address</span>";
                        return $productmss;
            }else{
                    $query = "SELECT * FROM tbl_customer WHERE  email = '$loginemail' AND pass = '$password'";
                    $showquerry = $this->db->select($query);
                    if ($showquerry != false) {
                        $match = $showquerry->fetch_assoc();
                        $productmss = "<span style='color:green'>Login Successfully</span>";
                            Session::set("customerLOgin", true);
                            Session::set("customerId",$match['id']);
                            Session::set("customerName",$match['name']);
                            header("Location:profile.php");
                    }else{
                        $productmss = "<span style='color:red'>UserName or password NOt Match</span>";
                            return $productmss;
                     }
             }
        }


        public function customerProfileShow($cusId){
            $query = "SELECT * FROM tbl_customer WHERE id = '$cusId' ";
            $selquery = $this->db->select($query);
            return $selquery;
        }



        public function editCustomerDetails($data, $cusId){
            $name       = mysqli_real_escape_string($this->db->link, $data['name']);
            $address    = mysqli_real_escape_string($this->db->link, $data['address']);
            $city       = mysqli_real_escape_string($this->db->link, $data['city']);
            $cityjen    = mysqli_real_escape_string($this->db->link, $data['country']);
            $zip        = mysqli_real_escape_string($this->db->link, $data['zip']);
            $phone      = mysqli_real_escape_string($this->db->link, $data['phone']);
            $email      = mysqli_real_escape_string($this->db->link, $data['email']);
           
            $cusId = $cusId;

            
            if ($name == "" || $address == "" || $city == "" || $cityjen == "" || $zip == "" || 
                $phone == "" || $email == "") {
               $rrr = "<span style='color:green'>filded Must NOt be empty</span>";
               return $rrr;
            }else{
                $updatequery = " UPDATE tbl_customer SET name = '$name', address = '$address',
         city = '$city', country = '$cityjen', zip = '$zip' ,email = '$email',
                phone = '$phone'  WHERE id = '$cusId'";
                $updateq = $this->db->update($updatequery);

                if ($updateq) {
                   $rrr = "<span style='color:green'>Your User Profile Update is successfully</span>";
                   return $rrr;
                }else {
                    $rrr =  "<span style='color:red;'> Your User Profile NOt Updated</span>";
                    return $rrr;
                }
            }
        }

        public function editCustomerpass($data,$cusId){
            $pass       = mysqli_real_escape_string($this->db->link, md5($data['pass']));
            $new    = mysqli_real_escape_string($this->db->link, $data['new']);
            $old    = mysqli_real_escape_string($this->db->link, $data['old']);

            $query = "SELECT * FROM tbl_customer WHERE id = '$cusId' ";
            $selquery = $this->db->select($query);
            $result = $selquery->fetch_assoc();

            if ($pass != $result['pass'] ) {
                $rss = "Your Password Is not Match";
                return $rss;
            }elseif ($new != $old) {
                $rss = "Confirm Password Is not Match";
                return $rss;
            }else{
                $password = md5($new);
                $query = "UPDATE tbl_customer SET pass = '$password'";
                $updateQuery = $this->db->update($query);
                $rss = "Password Update Successfully";
                return $rss;

            }
        }


        public function AdmingetCustomer($customerID){
            $query = "SELECT * FROM tbl_customer WHERE id = '$customerID' ";
            $selquery = $this->db->select($query);
            return $selquery;
        }





    }




?>