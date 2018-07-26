	<div class="container">
        <div class="row">
            <div class="col-md-12 img_login_cont">
				<!--logo imagen panel-->
				<img class="logo_login" src="<?php echo $ruta_raiz; ?>static/img/sistema/<?php echo $img_logo[0]; ?>" alt="<?php echo $img_logo[1]; ?>" height="<?php echo $img_logo[2]; ?>" width="<?php echo $img_logo[3]; ?>"> 
			</div>
			
			<div class="col-md-4 col-md-offset-4">
                
				<div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Por favor ingrese su email de registro</h3>
                    </div>
                    <div class="panel-body">
                        <?php if($error_login){?>
						<div class="alert alert-danger alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<?php echo $error_login; ?>
						</div>
						<?php } ?>
						<form role="form" id="login" name="login" method="post" action="<?php $_SERVER['PHP_SELF']; ?>" onsubmit="showDiv();">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
								<input name="submit" class="btn btn-lg btn-success btn-block" type="submit" value="Recuperar">
                            </fieldset>
                        </form>
						<br/>
						<a href="index.php"><i class="fa fa-unlock fa-fw"></i> Ingreso al sistema</a>
                    </div>
                </div>
            </div>
        </div>
    </div>