
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
		<div class="card">
        <div class="card-body">
		<?php
			if(count($listaUsuarios)>0){
		?>
		
			<div class="bd-example table-responsive">
		        <table class="table table-striped table-hover ">
		            <thead>
		            <tr>
		                <th scope="col">#</th>
		                <th scope="col">Nombre</th>
		                <th scope="col">Username</th>
		                <th scope="col">Email</th>
		                <th></th>
		            </tr>
		            </thead>
		            <tbody>
		            <?php
		            	foreach ($listaUsuarios as $key => $row) {
		            ?>
		            		<tr>
		            			<td><?php echo $row->id; ?></td>
		            			<td><?php echo $row->nombre.' '.$row->apellido; ?></td>
		            			<td><?php echo $row->username; ?></td>
		            			<td><?php echo $row->email; ?></td>
		            			<td><a href="./?view=users&opt=edit&id=<?php echo $row->id;?>" class="btn btn-warning"><i class="fa fa-pencil"></i> Editar </a> </td>

		            			<td>
		            				<button 
		            					data-id="<?php echo $row->id;?>" 
		            					data-name="<?php echo $row->nombre;?>"  
		            					class="deleteRow btn btn-danger"><i class="fa fa-pencil"></i> Elimiar </button> 
		            			</td>
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

	</div>


</div>

<script type="text/javascript">
	$(document).ready(function(){
		$(".deleteRow").click(function(){

			var id = $(this).attr('data-id');
			var name = $(this).attr('data-name');

			r = confirm("¿Seguro que deseas eliminar el registro "+name+"? ");

			if(r==true){
				window.location= "./?action=users&opt=delete&id="+id;	
			}

		});


	});

</script>

<?php

}else if(isset($_GET["opt"]) && $_GET["opt"] == "add"){
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

}else if(isset($_GET["opt"]) && $_GET["opt"] == "edit"){
		//Todas las validaciones
		if(!isset($_GET["id"]) or $_GET["id"] == "")
		{
			Core::addToastr('info',"Ups un error");			
			Core::redir("./?view=users&opt=all");

		}


			//validar si es numero
			$user = UserData::getByID($_GET['id']);
			$found = false;
			if($user!=null){
					$found=true;
			}

		
if($found){
?>


<div class="content-inner container-fluid pb-0" id="page_layout">
	<div class="col-xl-12 col-lg-12">
	   <div class="card">
	      <div class="card-header d-flex justify-content-between">
	         <div class="header-title">
	            <h4 class="card-title">Editar usuario, <b><?php echo $user->nombre;?></b> </h4>
	         </div>
	      </div>
	      <div class="card-body">
	         <div class="new-user-info">
	            <form method="post" action="./?action=users&opt=update">
	            	<input type="hidden" name="user_id" value="<?php echo $user->id;?>">
	               <div class="row">
	                  <div class="form-group col-md-6">
	                     <label class="form-label" for="fname">Nombre:</label>
	                     <input type="text" class="form-control" value="<?php echo $user->nombre; ?>" name="nombre" id="fname" placeholder="Nombre">
	                  </div>
	                  <div class="form-group col-md-6">
	                     <label class="form-label" for="lname">Last Name:</label>
	                     <input type="text" class="form-control" id="lname" value="<?php echo $user->apellido; ?>"  name="apellido" placeholder="Last Name">
	                  </div>
	                  
	                  <div class="form-group col-md-12">
	                     <label class="form-label" for="email">Email:</label>
	                     <input  type="email" value="<?php echo $user->email; ?>" class="form-control" name="email" id="email" placeholder="Email">
	                  </div>
	                  
	               </div>
	               <hr>
	               <h5 class="mb-3">Security</h5>
	               <div class="row">
	                  <div class="form-group col-md-12">
	                     <label class="form-label" for="uname">User Name:</label>
	                     <input type="text" value="<?php echo $user->username; ?>" class="form-control" id="uname" name="username" placeholder="User Name">
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
	               
	               <button type="submit" class="btn btn-success">Actualizar usuario</button>
	            </form>
	         </div>
	      </div>
	   </div>
	</div>
</div>
<?php
} // end if found


}
?>