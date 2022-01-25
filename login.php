<?php

//اضافه کردن فایل کانفیک به این صفحه این فایل شامل اطلاعات لازم برای اتصال به پایگاه داده است
require_once('config.php');

//تنظیم اکشن 
$action = (isset($_POST['action'])) ? $_POST['action'] : '';

//بر اساس اکشن تنظیم شده، تابع مربوطه فراخوانی می شود
switch ($action) {
	case "login":
		login();
		break;
	case "exit_user":
		exit_user();
		break;
	default:
		display_form_login();
		break;
}

//وظیفه این تابع، نمایش فرم لاگین است
function display_form_login()
{
	//اگر کاربر، قبلاً لاگین کرده باشد بنابراین سشن زیر تنظیم شده است و نباید فرم لاگین نمایش داده شود
	if (isset($_SESSION['u_username'])) {
		show_welcome_message($_SESSION['u_username']);
		return;
	}
?>
	<!DOCTYPE html>
	<html lang="fa" dir="rtl">

	<head>
		<title>سایت مدیریت مهمان پذیر</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.rtl.min.css" >
        <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		

	</head>

	<body>
		<div class="container py-5 text-dark">
			<div class="row d-flex justify-content-center align-items-center">
				<div class="col-12 col-md-8 col-lg-6">
                    <div class="card">
                        <h2 class="text-center pt-3">ورود</h2>
                        <div class="card-body" >
                            <form class="needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <input type="hidden" name="action" value="login" />
                                <div class="form-group">
                                    <div>
                                        <div>
                                            <label>نام کاربری</label>
                                            <input class="form-control" placeholder="نام کاربری را وارد کنید" type="text" name="u_username" size="18" maxlength="25" required />
                                        </div>
                                        <div class="form-group">
                                            <dd>
                                                <label class="text-black">رمز عبور</label>
                                                <input class="form-control" placeholder="رمز عبور خود را وارد کنید." type="password" name="u_password" size="18" maxlength="25" required />
                                            </dd>
                                            <br>
                                            <div>
                                                <button type="submit" name="login" class="btn btn-outline-primary btn-block">ورود</button>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="form-group">
                                            <a href="register.php" class="btn btn-primary">ایجاد حساب کاربری</a>

                                        </div>
                                    </div>
                                    <div class="error"><?php if (isset($GLOBALS['error'])) echo $GLOBALS['error']; ?></div>
                            </form>
                        </div>
                    </div>
                </div>
			</div>

<?php
}

//وظیفه این تابع، این است که براساس نام کاربری و کلمه عبور دریافت شده، اجازه ورود به کاربر بدهد
function login()
{
	global $conn;
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//متغییری برای ذخیره پیغام های خطا
		global $error;
		$error = '';

		//تنظیم مقادیر ارسال شده از سمت کاربر
		$u_username = $_POST['u_username'];
		$u_password = $_POST['u_password'];

		//مقادیر ارسال شده از سمت کاربر، نباید خالی باشد
		if (empty($u_username) || empty($u_password)) {
			$error = "لطفاً همه فیلدها را پر کنید.";
			display_form_login();
			return;
		}


		$conn->set_charset('utf8');

		//تنظیم کوئری و اطمینان از صحت کار
		if ($stmt = $conn->prepare("SELECT u_id FROM users WHERE u_username=? and u_password=?")) {
			//بایند کردن پارامترها
			$stmt->bind_param("ss", $u_username, $u_password);
			//اجرای کوئری
			$stmt->execute();

			//ذخیره کردن نتیجه
			$stmt->store_result();
			//اگر تعداد رکوردها بزرگتر از صفر باشد، کاربر بدرستی اطلاعات را وارد کرده است
			if ($stmt->num_rows > 0) {
				$_SESSION['u_username'] = $u_username;
				show_welcome_message($u_username);
				header('location:rezerve.php');
			} else {
				$error = "نام کاربری یا کلمه عبور اعتبار ندارد";
				display_form_login();
				return;
			}
		} else {
			$error = "عدم اجرای دستور Prepare <br /> شماره خطا = $conn->errno <br /> متن خطا = $conn->error";
			display_form_login();
			return;
		}
		//بستن ارتباط با پایگاه داده
		$stmt->close();
		$conn->close();
	}
}

//وظیفه این تابع، نمایش پیغام خوش آمد گویی است البته بهمراه نمایش دکمه خروج
function show_welcome_message($u_username)
{
?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<input type="hidden" name="action" value="exit_user" />
		<div class="form" id="login">
			<h2>ورود کاربران</h2>
			<div>سلام، <?php echo $u_username; ?> عزیز</div>
			<div class="button"><input type="submit" value="خروج" /></div>
		</div>
	</form>

<?php
}
//وظیفه این تابع خروج و پاک کردن سشن هاست
function exit_user()
{
	unset($_SESSION['u_username']);
	display_form_login();
}
?>
            <script src="js/jquery-3.6.0.min.js"></script>
            <script src="js/bootstrap.min.js"></script>
</body>
</html>