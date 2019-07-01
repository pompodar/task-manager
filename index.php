<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM auth WHERE name = '$myusername' and password = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      		
      if($count == 1) {
		 $_SESSION['myusername']="myusername";
         $_SESSION['login_user'] = $myusername;
         
         header("location: admin.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   <head>
      <title>Login Page</title>
      <link rel="stylesheet" href="css/bootstrap.css" />
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
      <link rel="stylesheet" href="css/style.css">
   </head>
   
   <body>
   	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="https://cdn.freebiesupply.com/logos/large/2x/pinterest-circle-logo-png-transparent.png" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form method="post">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user" value="" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" value="" placeholder="password">
						</div>
							<button type="submit" name="submit" class="btn login_btn">Submit</button>
					</form>
				</div>
			</div>
		</div>
	</div>
   
    <div align = "center"> 
	   <div class="span7">   
            <div class="widget stacked widget-table action-table">
    			<div class="widget-header">
					<i class="icon-th-list"></i>
					<div class="sort">	 
		                <button class="buttons" id="sortName">by name</button>
                        <button class="buttons" id="sortEmail">by email</button>   
		                <button class="buttons" id="sortCompleted">by completed</button>			 
		            </div>	 
		            <h3 id="tableHead">Tasks</h3>
		 			<button class="buttons" id="login">admin</button>
				</div>	
				<div class="widget-content">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Task</th>
								<th class="td-actions">Done</th>
							</tr>
						</thead>
						<tbody id="taskTable">
						</tbody>
						</table>
				</div>
			</div>
        </div> 
		 
        <a id="btn_prev">Prev</a>
        <a id="btn_next">Next</a>
        page: <span id="page"></span>     	
    </div>

    <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
	        <h4 class="card-title mt-3 text-center">Create Task</>
            <form id="myForm" action="sendAdmin.php" method="post">
	            <div class="form-group input-group">
		            <div class="input-group-prepend">
		            </div>
                    <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                </div>
                <div class="form-group input-group">
    	            <div class="input-group-prepend">
		            </div>
                    <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                </div>
                <div class="form-group input-group">
    	            <div class="input-group-prepend">
		            </div>
                    <textarea class="form-control" id="task" name="task" placeholder="Task" type="text" required></textarea>
                </div>                                   
                <div class="form-group">
                    <button id="submit" type="submit" class="btn btn-block"> Submit  </button>
                </div>     
            </form>
        </article>
    </div>

    <script src="js/script.js"></script>

   </body>
</html>