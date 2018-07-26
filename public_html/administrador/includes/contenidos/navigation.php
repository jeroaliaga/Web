<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="inicio.php"><?php echo $panel_name; ?></a>
            </div>
            <!-- /.navbar-header -->
			
            <!-- links arriba derecha -->
			<ul class="nav navbar-top-links navbar-right">			    
			    <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="cambiar_password.php"><i class="fa fa-user fa-fw"></i> Cambiar contraseña</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="index.php?exit=yes"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- fin links arriba derecha -->

            <!-- links izquierda -->
			<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
						<!--
						<li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <form id="search_prop" name="search_prop" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
									<input type="text" class="form-control" style="width:82%;" name="id_transaccion" placeholder="ID Transacción...">
									<span class="input-group-btn">
									<button class="btn btn-default" type="submit">
										<i class="fa fa-search"></i>
									</button>
								</form>
                            </span>
                            </div>
                        </li>
						-->
						
                        <li>
                            <a <?php if($estoy == "inicio"){echo'class="active"';}?> href="inicio.php"><i class="fa fa-laptop fa-fw"></i> Inicio</a>
                        </li>
						<?php foreach($array_secciones as $seccion){?>
                        <li>
                            <a <?php if($id == $seccion['id']){echo'class="active"';}?> href="#"><i class="fa fa-chevron-right" aria-hidden="true"></i> <?php echo $seccion['name']; ?><span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php 
									if($seccion['grupos']){
									foreach($seccion['grupos'] as $grupo){
								?>
								<li>
									<a href="#"><?php echo $grupo['name']; ?> <span class="fa arrow"></span></a>
									<ul class="nav nav-third-level">
										<li>
											<a href="listar_publicaciones.php?id=<?php echo $grupo['id']; ?>"><i class="fa fa-th-list" aria-hidden="true"></i> Listar</a>
										</li>
									</ul>
								</li>
								<?php } } else { ?>
								<li>
                                    <a href="listar_publicaciones.php?id=<?php echo $seccion['id']; ?>"><i class="fa fa-th-list" aria-hidden="true"></i> Listar</a>
                                </li>
								<?php } ?>
                            </ul>
                        </li>
						<?php } ?>
						<li>
                            <a <?php if($estoy == "usuarios"){echo'class="active"';}?> href="usuarios.php"><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- fin links izquierda -->
        </nav>