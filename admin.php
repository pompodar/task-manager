<?php
   include("config.php");
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select name from auth where name = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
      die();
   }
?>
<html>
   <head>
      <title>Admin Page</title>
       <link rel="stylesheet" href="css/bootstrap.css" />
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
       <link rel="stylesheet" href="css/style.css">    
   </head>
   
   <body>   
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
		 					<button class="buttons" id="login">log out</button>
				   </div>
				<div class="widget-content">	
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Email</th>
								<th>Task</th>
								<th>Done</th>
								<th>Update</th>
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
	         <h4 class="card-title mt-3 text-center">Create Task</h4>
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

     <script src="js/adminScript.js"></script>
   </body>
</html>