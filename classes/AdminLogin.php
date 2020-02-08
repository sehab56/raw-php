<?php   $filepath = realpath(dirname(__FILE__));    ?>

<?php include_once($filepath.'/../lib/Database.php');?>
<?php include_once($filepath.'/../helpers/format.php');?>
<?php 
	include_once($filepath.'/../lib/Session.php');
	Session::checklogin();

?>


<?php
	/**
	* 
	*/
	class AdminLogin{
		public $db;
		public $fm;

		
		function __construct(){
			$this->db = new Database();
			$this->fm = new format();
		}
		public function adminlogin($adminuser,$adminpass){
			$username = mysqli_real_escape_string($this->db->link, $adminuser);
			$password = mysqli_real_escape_string($this->db->link, $adminpass);
				

			$query = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password' ";
			$result =  $this->db->select($query);
			if($result != false){
					//	$value = mysqli_fetch_array($result);
						$value = $result->fetch_assoc();
	
						Session::set("login",true);
						Session::set("username",$value['username']);
						Session::set("UserId",$value['id']);
						Session::set("userRole",$value['role']);
						header("Location:index.php");
			}else{
				$loginmess = "<span style='color:red; font-size:15px;'> Username Or password not match</span>";
				return $loginmess;
			}
		}
	}

?>

