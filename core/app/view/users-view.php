
<?php

if(!isset($_SESSION['user_id'])) Core::redir("./");



if(isset($_GET["opt"]) && $_GET["opt"] == "all"){
	$listaUsuarios = UserData::getUsersbyKind();

	
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
	<div class="d-flex justify-content-between align-items-center">
		<div class="d-flex flex-column">
			<h3>Usuarios</h3>
		</div>
		
	</div>

	<div class="row">
		<div class="col-md-12">
			<a class="btn btn-primary pull-right" href="./?view=users&opt=add"><i class="bi-persons"> </i>
			 Nuevo</a>

		</div>
		<?php
			if(count($listaUsuarios)>0){
		?>
			<div class="bd-example table-responsive">
		        <table class="table table-striped">
		            <thead>
		            <tr>
		                <th scope="col">#</th>
		                <th scope="col">Nombre</th>
		                <th scope="col">Username</th>
		                <th scope="col">Email</th>
		            </tr>
		            </thead>
		            <tbody>
		            <?php
		            	foreach ($listaUsuarios as $key => $row) {
		            ?>
		            		<tr>
		            			<td><?php echo $row->id; ?></td>
		            			<td><?php echo $row->nombre; ?></td>
		            			<td><?php echo $row->username; ?></td>
		            			<td><?php echo $row->email; ?></td>
		            		</tr>

		            <?php
		            	}

		            ?>	
		            
		            </tbody>
		        </table>
		    </div>
    
			<?php

		}else{
			?>
				<div class="alert alert-warning d-flex align-items-center" role="alert">
		            <svg class="bi flex-shrink-0 me-2" width="24" height="24">
		                <use xlink:href="#exclamation-triangle-fill" />
		            </svg>
		            <div>
		                Sin registros !!
		            </div>
		        </div>
			<?php

		}
		?>



	</div>


</div>

<?php

}elseif(isset($_GET["opt"]) && $_GET["opt"] == "add"){
?>
<div class="content-inner container-fluid pb-0" id="page_layout">
<div class="col-xl-12 col-lg-12">
   <div class="card">
      <div class="card-header d-flex justify-content-between">
         <div class="header-title">
            <h4 class="card-title">Nuevo usuario </h4>
         </div>
      </div>
      <div class="card-body">
         <div class="new-user-info">
            <form method="post" action="./?action=users&opt=add">
               <div class="row">
                  <div class="form-group col-md-6">
                     <label class="form-label" for="fname">Nombre:</label>
                     <input type="text" class="form-control" name="nombre" id="fname" placeholder="Nombre">
                  </div>
                  <div class="form-group col-md-6">
                     <label class="form-label" for="lname">Last Name:</label>
                     <input type="text" class="form-control" id="lname"  name="apellido" placeholder="Last Name">
                  </div>
                  
                  <div class="form-group col-md-12">
                     <label class="form-label" for="email">Email:</label>
                     <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                  </div>
                  
               </div>
               <hr>
               <h5 class="mb-3">Security</h5>
               <div class="row">
                  <div class="form-group col-md-12">
                     <label class="form-label" for="uname">User Name:</label>
                     <input type="text" class="form-control" id="uname" name="username" placeholder="User Name">
                  </div>
                  <div class="form-group col-md-6">
                     <label class="form-label" for="pass">Password:</label>
                     <input type="password" class="form-control" id="pass" name="password" placeholder="Password">
                  </div>
                  <div class="form-group col-md-6">
                     <label class="form-label" for="rpass">Repeat Password:</label>
                     <input type="password" class="form-control" id="rpass" placeholder="Repeat Password ">
                  </div>
               </div>
               
               <button type="submit" class="btn btn-primary">Agregar usuario</button>
            </form>
         </div>
      </div>
   </div>
</div>
</div>

<?php

}

?>