<html>
<head>
<title>SERIAL COMMUNICATIONS</title>


</head>
<body>
<?php
//var $testing = true;
require_once "portDriver.php";


if ($_SERVER['REQUEST_METHOD'] != 'POST'){
$me = $_SERVER['PHP_SELF'];
?>
<form name="form1" method="post"
action="<?php echo $me; ?>" >
<table border="0" cellspacing="0" cellpadding="2">
<tr>
<td>Message:</td>
<td><input type="text" name="message"></td>
</tr>
<tr>
<td>Output:</td>
<td><input type="text" name="output"></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="Submit"
value="Send"></td>
</tr>
</table>
</form>
<?php
} else {
error_reporting(0);

// Create the device;
$serial = new serialPort();

// Open the device.
$serial->openPort("/dev/ttyS0");
$serial->sendInit();


$msg=stripslashes($_POST['message']);
//$out=stripslashes($_POST['output']);

$message = $msg.chr(10);
$serial->sendMessage($message);

$serial->closePort();

}
?>
</body>
</html>
