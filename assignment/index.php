<!DOCTYPE html>
<html>
<head>
	<title>
		Income Tax Calculator
	</title>
	<style type="text/css">
		.pageBody{
			background-color: grey;
			width: 30%;
			margin-left: auto;
			margin-right: auto;
			margin-top: 200px;
			padding: 50px;
			text-align: center;
		}

		form{
			display: flex;
			align-items: center;
  			justify-content: center;
			flex-direction:column;
		}
		input{
			margin:5px;
		}
	</style>
</head>
<body>
	<div class="pageBody">
		<h1>Income Tax Calculator</h1>
		<form action="index.php" method="GET">
			<input type="number" name="gAmount" placeholder="Enter Gross Income">
			<input type="submit" value="Calculate" name="submit">
		</form>
		<h4>
		<?php
			if(isset($_GET["submit"]))
			{
				spl_autoload_register(function ($class_name) {
				   include $class_name . '.php';
				});
				$gAmount = $_GET["gAmount"];
				$obj = new ITCalculator();

				echo "Income Tax is : ".($obj->calculateITAmount($gAmount));
			}
		?>
		</h4>
	</div>
</body>
</html>