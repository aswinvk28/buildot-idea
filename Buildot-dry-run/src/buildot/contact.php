<?php
//include("db.php");
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$name=mysql_real_escape_string($_POST['name']);
$email=mysql_real_escape_string($_POST['email']);
$message=mysql_real_escape_string($_POST['message']);
if(strlen($name)>0 && strlen($email)>0 && strlen($message)>0)
{
$time=time();
mysql_query("INSERT INTO contact (name,email,message,created_date) VALUES('$name','$email','$message','$time')");
echo "<h2>Thank You !</h2>";
}
}

//$sql ="SELECT * from contact";
//$contacts = $db->select($sql);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/
ajax/libs/jquery/1.5/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>
<script type="text/javascript">
$('document').ready(function()
{
$('#form').ajaxForm( {
target: '#preview',
success: function() {
$('#formbox').slideUp('fast');
}
});
});
</script>
<div id="preview"><?php foreach($contacts as $contact) { ?>
<?php echo $contact['message']; ?><br /> 
 <?php }?> </div>
<div id="formbox">
<form id="form" action="" method="post">
Name
<input type="text" name="name" /><br />
Email
<input type="text" name="email" /><br />
Message
<textarea name="message"></textarea><br />
<input type="submit" value="Submit">
</form>
</div>