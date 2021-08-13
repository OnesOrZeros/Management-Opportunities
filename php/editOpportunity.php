<?php
// including the database connection file
include_once("../assets/db/config.php");
session_start();

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}


if(isset($_POST['update']))
{



    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $stage = mysqli_real_escape_string($conn, $_POST['stage']);

		//updating the table
		$result = mysqli_query($conn, "UPDATE opportunities SET Name='$name',Amount='$amount',Stage='$stage' WHERE OpportunityID=$id");

		//redirecting to the opportunities page
		header("Location: opportunities.php");

}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM opportunities WHERE OpportunityID=$id");

while($res = mysqli_fetch_array($result))
{
	$name = $res['Name'];
	$amount = $res['Amount'];
	$stage = $res['Stage'];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<title> OPPORTUNITY MANAGEMENT SYSTEM</title>
<link rel="stylesheet" type="text/css" href="../css/accounts.css">
<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>


<header>
<div class="admin">
<div class="logo">
<img src="https://lh3.googleusercontent.com/fife/ABSRlIoGiXn2r0SBm7bjFHea6iCUOyY0N2SrvhNUT-orJfyGNRSMO2vfqar3R-xs5Z4xbeqYwrEMq2FXKGXm-l_H6QAlwCBk9uceKBfG-FjacfftM0WM_aoUC_oxRSXXYspQE3tCMHGvMBlb2K1NAdU6qWv3VAQAPdCo8VwTgdnyWv08CmeZ8hX_6Ty8FzetXYKnfXb0CTEFQOVF4p3R58LksVUd73FU6564OsrJt918LPEwqIPAPQ4dMgiH73sgLXnDndUDCdLSDHMSirr4uUaqbiWQq-X1SNdkh-3jzjhW4keeNt1TgQHSrzW3maYO3ryueQzYoMEhts8MP8HH5gs2NkCar9cr_guunglU7Zqaede4cLFhsCZWBLVHY4cKHgk8SzfH_0Rn3St2AQen9MaiT38L5QXsaq6zFMuGiT8M2Md50eS0JdRTdlWLJApbgAUqI3zltUXce-MaCrDtp_UiI6x3IR4fEZiCo0XDyoAesFjXZg9cIuSsLTiKkSAGzzledJU3crgSHjAIycQN2PH2_dBIa3ibAJLphqq6zLh0qiQn_dHh83ru2y7MgxRU85ithgjdIk3PgplREbW9_PLv5j9juYc1WXFNW9ML80UlTaC9D2rP3i80zESJJY56faKsA5GVCIFiUtc3EewSM_C0bkJSMiobIWiXFz7pMcadgZlweUdjBcjvaepHBe8wou0ZtDM9TKom0hs_nx_AKy0dnXGNWI1qftTjAg=w1920-h979-ft" alt="">
</div>
</div>
<div>
<?php
    if (isset($_SESSION['loggedin'])) {

        require_once('../assets/header/header3.html');

    }
    else {
      require_once('../assets/header/header4.html');
    }

?>
</div>
<div class="title">


<form action="editOpportunity.php" method="POST">
  <h3>Edit Opportunity</h3><br>

	<input type="text" placeholder="Name" name="name" required value="<?php echo $name;?>">
	<input type="text" placeholder="Amount" name="amount" required value="<?php echo $amount;?>">
	<input type="text" placeholder="Stage" name="stage" required value="<?php echo $stage;?>">
	<input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
	<button class="button button1" name="update" type="submit">Update</button>
</form>
</div>
</header>
</body>
</html>
