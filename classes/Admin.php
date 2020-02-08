<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>


<?php
	/**
	* 
	*/
	class Admin{
		public $db;
		public $fm;

		
		function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}

		public function AddAdminUser($value){
			$username   = $this->fm->validation($value['username']);
		    $password   = $this->fm->validation(md5($value['password']));
		    $email      = $this->fm->validation($value['email']);
		    $role       = $this->fm->validation($value['role']);

		    $username = mysqli_real_escape_string($this->db->link, $username);
		    $password = mysqli_real_escape_string($this->db->link, $password);
		    $role = mysqli_real_escape_string($this->db->link, $role);

			if(empty($username) || empty($password) || empty($role) || empty($email) ){
		        echo "<span class='error'>Field Must not be empty !</span>";
		    }elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		        echo "<span style:'color:red'>this email is not valid: </span>".$email; 
		    }else{
		        $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' limit 1 ";
		        $mailcheck = $this->db->select($mailquery);
		        if ($mailcheck) {
		            echo "this Email Alrethisy Exits";
		        }else{
		                $query = "INSERT INTO tbl_user (username, password, role, email) VALUES ('$username'
		                ,'$password','$role','$email')";
		                $thisduser = $this->db->insert($query);
		            
		                if ($thisduser){
		                   echo "<span style='color:green'>User thisd successfully.</span>";
		                }else{
		                    echo "<span style='color:red'>User not thisd</span>";
		                }
		            }
		    }
		}
		

		public function userprofilUpdate($data,$userid){
			$name 		= mysqli_real_escape_string($this->db->link, $data['name']);
	        $username 	= mysqli_real_escape_string($this->db->link, $data['username']);
	        $email 		= mysqli_real_escape_string($this->db->link, $data['email']);
	        $details 	= mysqli_real_escape_string($this->db->link, $data['details']);

	        $name 		= $this->fm->validation($name);
	        $username 	= $this->fm->validation($username);
	        $email 		= $this->fm->validation($email);
	        $details 	= $this->fm->validation($details );

	        if ($name == "" || $username == "" || $email == "" || $details = "") {
	           $rrr = "<span style='color:green'>filded Must NOt be empty</span>";
	           return $rrr;
	        }else{
	            $updatequery = " UPDATE tbl_user SET name = '$name', username = '$username', email = '$email', details = '$details'  WHERE id = '$userid' ";
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


		public function changeuserPassword($data,$userid){
			$old        = mysqli_real_escape_string($this->db->link, md5($data['old']));
	        $new        = mysqli_real_escape_string($this->db->link, md5($data['new']));
	        $confirm    = mysqli_real_escape_string($this->db->link, md5($data['confirm']));
			
			$old        = $this->fm->validation($old);
	        $new        = $this->fm->validation($new);
	        $confirm    = $this->fm->validation($confirm);


	        $selquery = "SELECT password FROM tbl_user WHERE id = '$userid' ";
	        $selectquery = $this->db->select($selquery)->fetch_assoc();
	        if ($selectquery) {
	           $pass = $selectquery['password'];
	        }



	        if ($old == "" || $new == "" || $confirm == "") {
	            echo "<span style='color:red'>Your Must not be field Not be Empty</span>";
	        }elseif($pass != $old){
	            echo "<span style='color:red'>Your Password Not Match </span>";
	        }elseif($new != $confirm) {
	            echo "<span style='color:red'>New Password and Confirm Password Not Match</span>";
	        }else{
	            $password = $new;
	            $query = "UPDATE tbl_user SET password = '$password' WHERE id = '$userid' ";
	            $upquery = $this->db->update($query);
	            if ($upquery) {
	                echo "<span style='color:green'>Password Updated Succesfully</span>";
	            }else{
	                echo "<span style='color:red'>Password NOt Update Succefully</span>";
	            }
	        }
		}









	}
?>