<?php
// initialize variables
$pswd = "";
$code = "";
$error = "";
$valid = true;
$color = "#FF0000";

// if form was submit
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
	// declare encrypt and decrypt funtions
	require_once('vigenere.php');
	
	// set the variables
	$pswd = $_POST['pswd'];
	$code = $_POST['code'];
	
	// check if password is provided
	if (empty($_POST['pswd']))
	{
		$error = "Yêu cầu nhập khóa!";
		$valid = false;
	}
	
	// check if text is provided
	else if (empty($_POST['code']))
	{
		$error = "Nhập văn bản hoặc mã để mã hóa hoặc giải mã!";
		$valid = false;
	}
	
	// check if password is alphanumeric
	else if (isset($_POST['pswd']))
	{
		if (!ctype_alpha($_POST['pswd']))
		{
			$error = "Khóa chỉ được chứa các ký tự chữ cái!";
			$valid = false;
		}
	}
	
	// inputs valid
	if ($valid)
	{
		// if encrypt button was clicked
		if (isset($_POST['encrypt']))
		{
			$code = encrypt($pswd, $code);
			$error = "Văn bản được mã hóa thành công!";
			$color = "#2d5703";
		}
			
		// if decrypt button was clicked
		if (isset($_POST['decrypt']))
		{
			$code = decrypt($pswd, $code);
			$error = "Mã được giải mã thành công!";
			$color = "#2d5703";
		}
	}
}
?>
<html>
	<head>
		<title>Mật mã Vigenère</title>
		<style>
textarea {
	width: 500;
	height: 200;
	background-color: E0E0E0;
	color: #0000FF;
}
input {
	font-family: Courier New;
}
.button {
	width: 500;
	height: 40;
}
b {
	font-size: 20px;
	color: #303030;
}
body {
	background-color: #808080;
	font-family: Courier New;
}
table {
	border-color: #A0A0A0;
	background-color: #C0C0C0;
}	</style>
	</head>
	<body>
		<br><br>
		<form action="index.php" method="post">
			<table cellpadding="10" align="center" cellpadding="2" border="7">
				<caption><hr><b><h2>Vigenère cipher PHP with Khánh,Hoàng</h2></b><hr></caption>
				<tr>
					<td align="center"><span style="font-size:28px">Khóa:</span> <input type="text" style="font-size:28px" name="pswd" id="pass" value="<?php echo htmlspecialchars($pswd); ?>" /></td>
				</tr>
				<tr>
					<td align="center"><textarea style="font-size:28px" id="box" name="code"><?php echo htmlspecialchars($code); ?></textarea></td>
				</tr>
				<tr>
					<td><input type="submit" style="font-size:28px" name="encrypt" class="button" value="Mã hóa" onclick="validate(1)" /></td>
				</tr>
				<tr>
					<td><input type="submit" style="font-size:28px" name="decrypt" class="button" value="Giải mã" onclick="validate(2)" /></td>
				</tr>
				<tr>
					<td align="center">Thực hiện bởi : Đỗ Quốc Khánh | Chu Văn Hoàng| <span style="cursor:pointer;color:#0000FF" onclick="help()">Nhóm 7</span></td>
				</tr>
				<tr>
					<td><center><div style="color: <?php echo htmlspecialchars($color) ?>"><?php echo htmlspecialchars($error) ?></div></center></td>
				</tr>
			</table>
		</form>
	</body>
</html>