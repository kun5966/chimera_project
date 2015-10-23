<html>
<head>
<meta http-equiv="refresh" content="2">
<TITLE>SERIAL COMMUNICATOR</TITLE>
<script type="text/javascript">
function submitw() {
document.form1.message.value = "w";
document.form1.submit();
}

function submitf() {
document.form1.message.value = "f";
document.form1.submit();
}

function submita() {
document.form1.message.value = "a";
document.form1.submit();
}

function submits() {
document.form1.message.value = "s";
document.form1.submit();
}

function submitp() {
document.form1.message.value = "p";
document.form1.submit();
}

</script>
<style type="text/css">
	table:{
		text-align: center;
	}
</style>

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

<table>
<TR>
<TD></TD>
<td><input type="button" name="up" value="w" onclick="javascript:submitw();"/></td>
<td></td>
</TR>

<tr>
<TD><input type="button" name="left" value="a" onclick="javascript:submita();" /></TD>
<td><input type="button" name="pause" value="p" onclick="javascript:submitp();" /></td>
<td><input type="button" name="right" value="s" onclick="javascript:submits();" /></td>
</tr>
<tr>
<TD></TD>
<td><input type="button" name="down" value="f" onclick="javascript:submitf();" /></td>
<td></td>
</tr>


</table>

<table>


  <tr><td><input type="text" name="gps" value="" /></td></tr>
  <tr><td><input type="text" name="direction" value="" /></td></tr>
  <tr><td></td></tr>
  <tr><td></td></tr>
  <tr><td></td></tr>

</table>


<input type="hidden" name="message">
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


$message = $msg.chr(10);
$serial->sendMessage($message);

$serial->closePort();

print "<script>";
print "history.go(-1);";
print "</script>";

}
?>
</body>


</html>