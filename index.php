<?php
spl_autoload_register( function($class){

	include $class.".php";

});

include 'Database.php';

	$db=new Database();

	if(isset($_GET['delete'])){
		$id=$_GET['delete'];
		$q="delete from tbl_student where id='$id' ";
		$db->query($q);
	}
	
	
	
?>


<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
		<div class="heading">
			<center><h1>PHP OOP CRUD</h1></center>
			<center><a href="index.php">For Student</a></center>
		</div>
		<div class="main">
			<section class="mainleft">
				<?php

					if(isset($_GET['edit'])){ 
						$id=$_GET['edit'];
						
						$q="select * from tbl_student where id='$id' ";
						$res=$db->select($q)->fetch_assoc();

						
						// while($d=$res->fetch_object()){
						 	$name=$res['name'];
						 	$age=$res['age'];
						 	$dep=$res['dep'];
						 ?>
							
							<form action="" method="post">
								<table>
									<tr>
										<td>Name : </td>
										<td> <input type="text" name="name" value="  <?php echo $name; ?> "  required="1"> </td>
									</tr>
									<tr>
										<td>Department : </td>
										<td> <input type="text" name="dep" value=" <?php echo $dep; ?>  "  required="1"> </td>
									</tr>
									<tr>
										<td>Age : </td>
										<td> <input type="text" name="age" value="  <?php echo $age; ?> "  required="1"> </td>
									</tr>
									<tr>
										<td> </td>
										<td><input type="submit" name="create" value="Submit"></td>
									</tr>
								</table>
							</form>

						<?php	
							if(isset($_POST['create'])){
								$name =  mysqli_real_escape_string($db->link,$_POST['name']);
								$dep  =	 mysqli_real_escape_string($db->link,$_POST['dep']);
								$age  =  mysqli_real_escape_string($db->link,$_POST['age']);
								$id   =  $_GET['edit'];

								$q="update tbl_student set name='$name',dep='$dep' ,age='$age' where id='$id' ";
								$db->query($q);

							 }
						//}
						
					} 
					else{
				?>
				

				<form action="" method="post">
					<table>
						<tr>
							<td>Name : </td>
							<td> <input type="text" name="name" placeholder=" your name ... " required="1"> </td>
						</tr>
						<tr>
							<td>Department : </td>
							<td> <input type="text" name="dep" placeholder=" your department ... " required="1"> </td>
						</tr>
						<tr>
							<td>Age : </td>
							<td> <input type="text" name="age" placeholder=" your age ... " required="1"> </td>
						</tr>
						<tr>
							<td> </td>
							<td><input type="submit" name="create" value="Submit"></td>
						</tr>
					</table>
				</form>
			<?php

					if(isset($_POST['create'])){
						$name =  mysqli_real_escape_string($db->link,$_POST['name']);
						$dep  =	 mysqli_real_escape_string($db->link,$_POST['dep']);
						$age  =  mysqli_real_escape_string($db->link,$_POST['age']);
						$q="insert into tbl_student(name,dep,age) values('$name','$dep','$age')";

						$db->query($q);

					}

			 }?>
			</section>
			<section class="mainright">
				<table class="tbl">
					<tr>
						<th width="10%">Id</th>
						<th width="30%">Name</th>
						<th width="25%">Department</th>
						<th width="10%">Age</th>
						<th width="25%">Actions</th>
					</tr>

					<?php

						$i=0;
						$q="select * from tbl_student";
						$res=$db->select($q) ;
						
						foreach ($res as $value) 
						{ $i++; ?>
							<tr>
								<td><?php echo $i ?></td>
								<td><?php echo $value['name']; ?></td>
								<td><?php echo $value['dep']; ?></td>
								<td><?php echo $value['age']; ?></td>
								<td>
									<a href="index.php?edit= <?php echo urlencode($value['id']); ?> ">Edit</a>   ||
									<a href="index.php?delete= <?php echo urlencode($value['id']); ?>">Delete</a>
								</td>
							</tr>
							
				<?php	}
					?>
					
				</table>
			</section>
		</div>
	</body>
</html>