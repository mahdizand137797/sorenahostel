<?php
//اضافه کردن فایل کانفیک به این صفحه
//این فایل شامل اطلاعات لازم برای اتصال به پایگاه داده است
require_once('config.php');

//تنظیم اکشن 
$action = (isset($_POST['action'])) ? $_POST['action'] : '';

//بر اساس اکشن تنظیم شده، تابع مربوطه فراخوانی می شود
switch ($action) {
	case "reserve":
		insert_reserve();
		break;
	default:
		display_form_reserve('', '', '', '', '', '', '', '', '', '', '');
		break;
}

//وظیفه این تابع، نمایش فرم رزرو است 	
function display_form_reserve($r_code_meli, $r_name, $r_fname, $r_tel, $r_code_posti, $r_date_vorod, $r_date_khoroj, $r_meghdar_eghamat, $r_tedad_otagh, $r_tedad_kodak, $r_adres)
{
?>
	<!DOCTYPE html>
	<html lang="fa" dir="rtl">

	<head>
		<title>سایت مدیریت مهمان پذیر</title>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
		<link href="css/bootstrap.rtl.min.css" rel="stylesheet">
		<script src="js/jquery-3.6.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="container mt-2 mx-auto">
			<div class="row">
			<div class="card">
				<div class="form-group">
						<h2>درخواست رزرو مهمان پذیر</h2>
						<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
							<input type="hidden" name="action" value="reserve" />
							<div class="form-group">
								<dl>
									<dd>
										<label>کد ملی :</label>
										<input type="text" class="form-control" name="r_code_meli" size="25" maxlength="10" required pattern="\d{10}" title="فقط شامل 10 عدد" autofocus value="<?php echo $r_code_meli ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_code_meli_err'])) echo $GLOBALS['r_code_meli_err']; ?></span>
									</dd>
									<dd>
										<label>نام :</label>
										<input type="text" class="form-control" name="r_name" size="25" maxlength="25" required pattern="\D{1,25}" title="فقط کاراکترهای غیرعددی" value="<?php echo $r_name ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_name_err'])) echo $GLOBALS['r_name_err']; ?></span>
									</dd>
									<dd>
										<label>نام خانوادگی :</label>
										<input type="text" class="form-control" name="r_fname" size="25" maxlength="25" required pattern="\D{1,25}" title="فقط کاراکترهای غیرعددی" value="<?php echo $r_fname ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_fname_err'])) echo $GLOBALS['r_fname_err']; ?></span>
									</dd>
									<dd>
										<label>تلفن :</label>
										<input type="text" class="form-control" name="r_tel" size="25" maxlength="25" required pattern="([0-9]{3,4}-)?([0-9]{7,11})?" title="فقط شامل کاراکترهای عددی و خط تیره" value="<?php echo $r_tel ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_tel_err'])) echo $GLOBALS['r_tel_err']; ?></span>
									</dd>
									<dd>
										<label>کدپستی :</label>
										<input type="text" class="form-control" name="r_code_posti" size="25" maxlength="10" required pattern="\d{10}" title="فقط شامل 10 عدد" value="<?php echo $r_code_posti ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_code_posti_err'])) echo $GLOBALS['r_code_posti_err']; ?></span>
									</dd>
									<dd>
										<label>تاریخ ورود :</label>
										<input type="text" class="form-control" name="r_date_vorod" size="25" maxlength="25" required pattern="([0-9]{2,4}[/])([0-9]{2}[/])([0-9]{2})" title="فرمت تاریخ صحیح نیست - 93/05/09" value="<?php echo $r_date_vorod ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_date_vorod_err'])) echo $GLOBALS['r_date_vorod_err']; ?></span>
									</dd>
									<dd>
										<label>تاریخ خروج :</label>
										<input type="text" class="form-control" name="r_date_khoroj" size="25" maxlength="25" required pattern="([0-9]{2,4}[/])([0-9]{2}[/])([0-9]{2})" title="فرمت تاریخ صحیح نیست - 93/05/09" value="<?php echo $r_date_khoroj ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_date_khoroj_err'])) echo $GLOBALS['r_date_khoroj_err']; ?></span>
									</dd>
									<dd>
										<label>مدت اقامت :</label>
										<input type="text" class="form-control" name="r_meghdar_eghamat" size="25" maxlength="25" required value="<?php echo $r_meghdar_eghamat ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_meghdar_eghamat_err'])) echo $GLOBALS['r_meghdar_eghamat_err']; ?></span>
									</dd>
									<dd>
										<label>تعداد اتاق :</label>
										<input type="text" class="form-control" name="r_tedad_otagh" size="25" maxlength="25" required value="<?php echo $r_tedad_otagh ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_tedad_otagh_err'])) echo $GLOBALS['r_tedad_otagh_err']; ?></span>
									</dd>
									<dd>
										<label>تعداد کودکان :</label>
										<input type="text" class="form-control" name="r_tedad_kodak" size="25" maxlength="25" required value="<?php echo $r_tedad_kodak ?>" />
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_tedad_kodak_err'])) echo $GLOBALS['r_tedad_kodak_err']; ?></span>
									</dd>
									<dd>
										<label>آدرس :</label>
										<textarea type="text" class="form-control" name="r_adres" rows="2" cols="35" maxlength="100" required><?php echo $r_adres ?></textarea>
										<span class="star">*</span>
										<span class="error"><?php if (isset($GLOBALS['r_adres_err'])) echo $GLOBALS['r_adres_err']; ?></span>
									</dd>
									<dd class="button">
										<input type="submit" class="btn btn-primary" value="ثبت اطلاعات" />
										<input type="reset" class="btn btn-secondary" value="تصحيح" />
									</dd>
								</dl>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	<?php
}

//وظیفه این تابع، درج اطلاعات ارسال شده از فرم در پایگاه داده است
function insert_reserve()
{
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//متغییرهایی برای ذخیره پیغام های خطا
		global $conn;
		global $r_code_meli_err;
		global $r_name_err;
		global $r_fname_err;
		global $r_tel_err;
		global $r_code_posti_err;
		global $r_date_vorod_err;
		global $r_date_khoroj_err;
		global $r_meghdar_eghamat_err;
		global $r_tedad_otagh_err;
		global $r_tedad_kodak_err;
		global $r_adres_err;
		$r_code_meli_err = $r_name_err = $r_fname_err = $r_tel_err = $r_code_posti_err = $r_date_vorod_err = $r_date_khoroj_err = $r_meghdar_eghamat_err = $r_tedad_otagh_err = $r_tedad_kodak_err = $r_adres_err = '';

		//تنظیم مقادیر ارسال شده از سمت کاربر
		$r_code_meli = test_input($_POST['r_code_meli']);
		$r_name = test_input($_POST['r_name']);
		$r_fname = test_input($_POST['r_fname']);
		$r_tel = test_input($_POST['r_tel']);
		$r_code_posti = test_input($_POST['r_code_posti']);
		$r_date_vorod = test_input($_POST['r_date_vorod']);
		$r_date_khoroj = test_input($_POST['r_date_khoroj']);
		$r_meghdar_eghamat = test_input($_POST['r_meghdar_eghamat']);
		$r_tedad_otagh = test_input($_POST['r_tedad_otagh']);
		$r_tedad_kodak = test_input($_POST['r_tedad_kodak']);
		$r_adres = test_input($_POST['r_adres']);

		//اعتبار سنجی اطلاعات ارسال شده
		if (empty($r_code_meli)) {
			$r_code_meli_err = "الزامی است";
		} else if (!preg_match("/^\d{10}$/", $r_code_meli)) {
			$r_code_meli_err = "فقط شامل 10 کاراکتر عددی";
		}
		//---------
		if (empty($r_name)) {
			$r_name_err = "الزامی است";
		} else if (!preg_match("/^\D{1,25}$/", $r_name)) {
			$r_name_err = "فقط شامل کاراکترهای غیر عددی";
		}
		//---------
		if (empty($r_fname)) {
			$r_fname_err = "الزامی است";
		} else if (!preg_match("/^\D{1,25}$/", $r_fname)) {
			$r_fname_err = "فقط شامل کاراکترهای غیر عددی";
		}
		//---------
		if (empty($r_tel)) {
			$r_tel_err = "الزامی است";
		} else if (!preg_match("/^([0-9]{3,4}-)?([0-9]{7,11})?$/", $r_tel)) {
			$r_tel_err = "فقط شامل کاراکترهای عددی و خط تیره";
		}
		//---------
		if (empty($r_code_posti)) {
			$r_code_posti_err = "الزامی است";
		} else if (!preg_match("/^\d{10}$/", $r_code_posti)) {
			$r_code_posti_err = "فقط شامل 10 کاراکتر عددی";
		}
		//---------
		if (empty($r_date_vorod)) {
			$r_date_vorod_err = "الزامی است";
		} else if (!preg_match("/^([0-9]{2,4}\/)([0-9]{2}\/)([0-9]{2})?$/", $r_date_vorod)) {
			$r_date_vorod_err = "فرمت تاریخ صحیح نیست - 93/05/09";
		}
		//---------
		if (empty($r_date_khoroj)) {
			$r_date_khoroj_err = "الزامی است";
		} else if (!preg_match("/^([0-9]{2,4}\/)([0-9]{2}\/)([0-9]{2})?$/", $r_date_khoroj)) {
			$r_date_khoroj_err = "فرمت تاریخ صحیح نیست - 93/05/09";
		}
		//---------
		if (empty($r_meghdar_eghamat)) {
			$r_meghdar_eghamat_err = "الزامی است";
		}
		//---------
		if (empty($r_tedad_otagh)) {
			$r_tedad_otagh_err = "الزامی است";
		}
		//---------
		if (empty($r_tedad_kodak)) {
			$r_tedad_kodak_err = "الزامی است";
		}
		//---------
		if (empty($r_adres)) {
			$r_adres_err = "الزامی است";
		}

		//اگر هر کدام از متغیرهای خطا مقداردهی شده باشد، فرم رزرو با پیغام های مناسب نمایش داده می شود و اجرای تابع متوقف می شود 
		if ($r_code_meli_err != '' || $r_name_err != '' || $r_fname_err != '' || $r_tel_err != '' ||  $r_code_posti_err != '' ||  $r_date_vorod_err != '' || $r_date_khoroj_err != '' || $r_meghdar_eghamat_err != '' || $r_tedad_otagh_err != '' || $r_tedad_kodak_err != '' || $r_adres_err != '') {
			display_form_reserve($r_code_meli, $r_name, $r_fname, $r_tel, $r_code_posti, $r_date_vorod, $r_date_khoroj, $r_meghdar_eghamat, $r_tedad_otagh, $r_tedad_kodak, $r_adres);
			return;
		}



		//مقادیر ارسال شده از سمت کاربر، نباید خالی باشد
		if (empty($r_code_meli) || empty($r_name) || empty($r_fname) || empty($r_tel) || empty($r_code_posti) || empty($r_date_vorod) || empty($r_date_khoroj) || empty($r_meghdar_eghamat) || empty($r_tedad_otagh) || empty($r_tedad_kodak) || empty($r_adres)) {
			$error = "لطفاً همه فیلدها را پر کنید.";
			display_form_reserve(
				$r_code_meli,
				$r_name,
				$r_fname,
				$r_tel,
				$r_code_posti,
				$r_date_vorod,
				$r_date_khoroj,
				$r_meghdar_eghamat,
				$r_tedad_otagh,
				$r_tedad_kodak,
				$r_adres
			);
			return;
		}

		$conn->set_charset('utf8');
		$u_username = (isset($_SESSION['u_username'])) ? $_SESSION['u_username'] : NULL;

		//تنظیم کوئری و اطمینان از صحت کار
		if ($stmt = $conn->prepare("INSERT INTO reserve (
										r_uid,
										r_code_meli,
										r_name,
										r_fname,
										r_tel,
										r_code_posti,
										r_date_vorod,
										r_date_khoroj,
										r_meghdar_eghamat,
										r_tedad_otagh,
										r_tedad_kodak,
										r_adres)  
										VALUES((select u_id from users where u_username=?),?,?,?,?,?,?,?,?,?,?,?)")) {
			$stmt->bind_param(
				"ssssssssssss",
				$u_username,
				$r_code_meli,
				$r_name,
				$r_fname,
				$r_tel,
				$r_code_posti,
				$r_date_vorod,
				$r_date_khoroj,
				$r_meghdar_eghamat,
				$r_tedad_otagh,
				$r_tedad_kodak,
				$r_adres
			);
			$stmt->execute();
			echo "<div class='card'> <div style='border: 2px solid green; text-align:center;'>عملیات رزرو با موفقیت انجام شد.</div></div>";
		} else {
			$error = "عدم اجرای دستور Prepare <br /> شماره خطا = $conn->errno <br /> متن خطا = $conn->error";
			display_form_reserve($r_code_meli, $r_name, $r_fname, $r_tel, $r_code_posti, $r_date_vorod, $r_date_khoroj, $r_meghdar_eghamat, $r_tedad_otagh, $r_tedad_kodak, $r_adres);
			return;
		}

		//بستن ارتباط با پایگاه داده
		$stmt->close();
		$conn->close();
	}
}
//وظیفه این تابع استاندارد کردن مقدار فیلدهای ارسالی است
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
	?>