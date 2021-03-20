<html>
<head>
<title>Dynamic Dependent Select Box using jQuery and Ajax</title>
</head>
<body>
<div>
<label>Country :</label><select name="country" class="country">
<option value="0">Select Country</option>
<?php
include('db.php');
$sql = mysqli_query($con,"SELECT * FROM country");
while($row=mysqli_fetch_array($sql))
{
echo '<option value="'.$row['country_id'].'">'.$row['country_name'].'</option>';
} ?>
</select><br/><br/>
<label>City :</label><select name="city" class="city">
<option>Select City</option>
</select>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js">
</script>
<script type="text/javascript">
$(document).ready(function()
{
$(".country").change(function()
{
var country_id=$(this).val();
var post_id = 'id='+ country_id;

$.ajax
({
type: "POST",
url: "ajax.php",
data: post_id,
cache: false,
success: function(cities)
{
$(".city").html(cities);
} 
});

});
});
</script>
</body>
</html>