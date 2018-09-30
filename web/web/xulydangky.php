<?php
 // Nếu không phải là sự kiện đăng ký thì không xử lý
    if (isset($_POST['login']))
	{
		if($_POST['ho']== null)
		{
			echo ("* Bạn hãy nhập họ <br />") ;
		}
		else
		{
				$ho  =$_POST['ho'];
		}
			if($_POST['ten']== null)
		{
			echo ("* Bạn hãy nhập tên <br />");
		}
		else
		{
			$ten =$_POST['ten'];

		}
		if($_POST['username']== null)
		{
			echo ("* Bạn hãy nhập tên đăng nhập <br />");
		}
		else if (strlen('username') < 6 || strlen('username') > 24)
		{
			 echo "* Tên đăng nhập phải nằm trong khoảng 6-24 ký tự.";
			
		}
		else if (preg_match('/\W/', 'username'))
		{
			 echo "* Tên đăng nhập không được chứa ký tự đặc biệt và khoảng trắng.";
		}
		else
		{ 
			$username = $_POST['username'];
		}
			if($_POST['email']== null)
		{
			echo ("* Bạn hãy nhập email <br />");
		}
		else
		{
				$email =$_POST['email'];
		}
			if($_POST['pwd1']== null)
		{
			echo ("* Bạn hãy nhập mật khẩu <br />");
		}
		else if($_POST['pwd2']== null)
		{
			echo ("* Bạn hãy nhập lại mật khẩu <br />");
		}
		else if($_POST['pwd1']!=$_POST['pwd2'])
		{
			echo ("* Mật khẩu không trùng khớp. <a href='javascript: history.go(-1)'>Trở lại</a><br /> " );
			exit;
		}
		else
		{
				$pass_signup = sha1(($_POST['pwd1']));
		}

			if($_POST['day'] == "day"||$_POST['month']=="month"||$_POST['year']=="year")
		{
			echo ("* Bạn hãy chọn ngày sinh <br />");
		}
		else
		{
			$day       = $_POST['day'];
			$month     = $_POST['month'];
			$year      = $_POST['year'];
			$birthdate = $day . '-' . $month . '-' . $year;
		}
			if(isset($_POST['sex']) == null)
		{
			echo ("* Bạn hãy chọn giới tính <br />");
		}
		else
		{
				$gender = $_POST['sex'];
		}
		if ($_POST['ho']==null || $_POST['ten']==null || $_POST['username']==null || $_POST['email']==null || $_POST['pwd1']=null || $_POST['pwd2']==null ||$_POST['sex']==null)
		{
			exit;
		}
		if($ho && $ten && $username && $email && $pass_signup && $birthdate && $gender)
		{ 
    //Nhúng file kết nối với database
    $ketnoi['host'] = 'localhost'; //Tên server, nếu dùng hosting free thì cần thay đổi
    $ketnoi['dbname'] = 'thitracnghiem'; //Đây là tên của Database
    $ketnoi['username'] = 'root'; //Tên sử dụng Database
    $ketnoi['password'] = '';//Mật khẩu của tên sử dụng Database
  $connect= mysqli_connect($ketnoi['host'],$ketnoi['username'] ,$ketnoi['password']) or
        die("Không thể kết nối database");
    mysqli_select_db($connect,$ketnoi['dbname'])    or
        die("Không thể chọn database");
	//Khai báo utf-8 để hiển thị được tiếng việt
	mysqli_set_charset($connect, 'UTF8');
	$repass_signup = sha1($_POST['pwd2']);
	$taikhoantontai=mysqli_query($connect,"SELECT user FROM user WHERE user='$username'");
	$emailtontai=mysqli_query($connect,"SELECT email FROM user WHERE email='$email'");		
	//Kiểm tra tên đăng nhập này đã có người dùng chưa
		if (mysqli_num_rows($taikhoantontai) > 0){
			 echo "Tên đăng nhập này đã có người dùng. Vui lòng chọn tên đăng nhập khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}     
		//Kiểm tra email có đúng định dạng hay không
		$regex = "/([a-z0-9_]+|[a-z0-9_]+\.[a-z0-9_]+)@(([a-z0-9]|[a-z0-9]+\.[a-z0-9]+)+\.([a-z]{2,4}))/i"; 
		if (!preg_match($regex, $email))
		{
			 echo "Email này không hợp lệ. Vui long nhập email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
			  
		//Kiểm tra email đã có người dùng chưa
		if (mysqli_num_rows($emailtontai) > 0)
		{
			 echo "Email này đã có người dùng. Vui lòng chọn Email khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		//Lưu thông tin thành viên vào bảng
		$addmember = mysqli_query($connect,"
			INSERT INTO user (
				id,
				ho,
				ten,
				user,
				email,
				password,
				birthdate,
				Gioitinh
			)
			VALUE (
				'',
				'{$ho}',
				'{$ten}',
				'{$username}',
				'{$email}',
				'{$pass_signup}',
				'{$birthdate}',
				'{$gender}'
			)
		");				  
		//Thông báo quá trình lưu
		if ($addmember)
			echo "Quá trình đăng ký thành công. <a href='/'>Về trang chủ</a>";
		else
			echo "Có lỗi xảy ra trong quá trình đăng ký. <a href='dangky.php'>Thử lại</a>";
		}
	}
?>     
