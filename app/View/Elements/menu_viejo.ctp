<div class = "menu">
<ul>
	
	<?php 
	if (!empty($user_id)){?>
	<!-- <li class = "option <?php //if($this->params['controller'] == 'users' && $this->params['action'] == 'index') echo 'active'; ?>">
		<?php //echo $this->Html->link('Perfil',array('controller' => 'users','action'=>'index')); ?>
	</li> -->
	<?php 
	if ($admin_usuario){ ?>
	<li class = "option <?php if(($this->params['controller'] == 'users' && $this->params['action'] == 'admin_index') ||
									($this->params['controller'] == 'users' && $this->params['action'] == 'admin_editar')
								)
							echo 'active'; ?>">
		Usuarios
		<ul>
			<li class = "children">
				<?php echo $this->Html->link('Usuario',array('controller' => 'users', 'action' => 'admin_index')); ?>
			</li>
			
		</ul>
	</li>
	<li class = "option <?php if(($this->params['controller'] == 'clientes') ||
								($this->params['controller'] == 'pedidos' && $this->params['action'] == 'admin_pedidos') ||
								($this->params['controller'] == 'cuentas' && $this->params['action'] == 'admin_index') ||
								($this->params['controller'] == 'almacenclientes' && $this->params['action'] == 'admin_listar_clientes'))
		echo 'active'; ?>">
		
		Clientes
		<ul>
			<li class = "children <?php if($this->params['controller'] == 'clientes' && $this->params['action'] == 'admin_index') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Cliente',array('controller' => 'clientes', 'action' => 'admin_index')); ?>
			</li>
			<li class = "children <?php if($this->params['controller'] == 'pedidos' && $this->params['action'] == 'admin_pedidos') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Pedidos',array('controller' => 'pedidos', 'action' => 'admin_pedidos')); ?>
			</li>
			<li class = "children <?php if($this->params['controller'] == 'cuentas' && $this->params['action'] == 'admin_index') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Cuentas',array('controller' => 'cuentas', 'action' => 'admin_index')); ?>
			</li>
			<li class = "children <?php if($this->params['controller'] == 'almacenclientes' && $this->params['action'] == 'admin_listar_clientes') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Almacén',array('controller' => 'almacenclientes', 'action' => 'admin_listar_clientes')); ?>
			</li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option <?php if(($this->params['controller'] == 'categorias' && $this->params['action'] == 'admin_index') || 
								 ($this->params['controller'] == 'subcategorias' && $this->params['action'] == 'admin_index') || 
								 ($this->params['controller'] == 'acabados' && $this->params['action'] == 'admin_index') ||
								 ($this->params['controller'] == 'categorias' && $this->params['action'] == 'admin_editar') ||
								 ($this->params['controller'] == 'subcategorias' && $this->params['action'] == 'admin_editar') ||
								 ($this->params['controller'] == 'acabados' && $this->params['action'] == 'admin_editar')
		) echo 'active'; ?> ">
		Tablas
		<ul>
			<li class = "children <?php if(($this->params['controller'] == 'categorias' && $this->params['action'] == 'admin_index') ||
											($this->params['controller'] == 'categorias' && $this->params['action'] == 'admin_editar'))
			echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Linea',array('controller' => 'categorias', 'action' => 'admin_index')); ?>
			</li>
			<li class = "children <?php if(($this->params['controller'] == 'subcategorias' && $this->params['action'] == 'admin_index') ||
											($this->params['controller'] == 'subcategorias' && $this->params['action'] == 'admin_editar'))
			echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Categorias',array('controller' => 'subcategorias', 'action' => 'admin_index')); ?>
			</li>
			<li class = "children <?php if(($this->params['controller'] == 'acabados' && $this->params['action'] == 'admin_index') ||
											($this->params['controller'] == 'acabados' && $this->params['action'] == 'admin_editar'))
			echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Acabados',array('controller' => 'acabados', 'action' => 'admin_index')); ?>
			</li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option <?php if(($this->params['controller'] == 'articulos' && $this->params['action'] == 'subcategoria_articulo') || 
								 ($this->params['controller'] == 'precios' && $this->params['action'] == 'admin_index') ||
								 ($this->params['controller'] == 'precios' && $this->params['action'] == 'admin_listar_subcategorias') ||
								 ($this->params['controller'] == 'precios' && $this->params['action'] == 'admin_ver') ||
								 ($this->params['controller'] == 'articulos' && $this->params['action'] == 'admin_index') ||
								 ($this->params['controller'] == 'articulos' && $this->params['action'] == 'admin_editar') ||
								 ($this->params['controller'] == 'precios' && $this->params['action'] == 'admin_editar') ||
								 ($this->params['controller'] == 'articulos' && $this->params['action'] == 'admin_ver') 	
		) echo 'active'; ?> " >
	
	Artículos
		<ul>
			<li class = "children <?php if(($this->params['controller'] == 'articulos' && $this->params['action'] == 'admin_index') ||
										($this->params['controller'] == 'articulos' && $this->params['action'] == 'admin_editar'))
			echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Articulos',array('controller' => 'articulos', 'action' => 'subcategoria_articulo')); ?>
			</li>
			<li class = "children <?php if(($this->params['controller'] == 'precios' && $this->params['action'] == 'admin_index') || 
										($this->params['controller'] == 'precios' && $this->params['action'] == 'admin_editar'))
			echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Lista de precios',array('controller' => 'precios', 'action' => 'admin_index')); ?>
			</li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_catalogo){ ?>
	<li class = "option <?php if(($this->params['controller'] == 'materiasprimas' && $this->params['action'] == 'admin_index') || 
								 ($this->params['controller'] == 'inventariomaterials' && $this->params['action'] == 'admin_index') || 
								 ($this->params['controller'] == 'inventariomaterials' && $this->params['action'] == 'admin_movimientos') ||
								 ($this->params['controller'] == 'articulos' && $this->params['action'] == 'admin_forecast') ||
								 ($this->params['controller'] == 'materiasprimas' && $this->params['action'] == 'admin_editar') ||
								 ($this->params['controller'] == 'articulos' && $this->params['action'] == 'subcategoria_forecast') ||
								 ($this->params['controller'] == 'inventariomaterials' && $this->params['action'] == 'admin_editar')
		) echo 'active'; ?>">
	
	Materias prima
		<ul>
			<li class = "children <?php if($this->params['controller'] == 'materiasprimas' && $this->params['action'] == 'admin_index') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Materia prima',array('controller' => 'materiasprimas', 'action' => 'admin_index')); ?>
			</li>
			<li class = "children <?php if(($this->params['controller'] == 'inventariomaterials' && $this->params['action'] == 'admin_index') ||
										   ($this->params['controller'] == 'inventariomaterials' && $this->params['action'] == 'admin_editar'))
				echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Inventario',array('controller' => 'inventariomaterials', 'action' => 'admin_index')); ?>
			</li>
			<li class = "children <?php if($this->params['controller'] == 'inventariomaterials' && $this->params['action'] == 'admin_movimientos') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Movimientos',array('controller' => 'inventariomaterials', 'action' => 'admin_movimientos')); ?>
			</li>
			<li class = "children <?php if($this->params['controller'] == 'articulos' && $this->params['action'] == 'admin_forecast') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Forecast',array('controller' => 'articulos', 'action' => 'subcategoria_forecast')); ?>
			</li>
		</ul>
	</li>
	<?php } ?>
	<?php if ($admin_almacen){ ?>
	<li class = "option <?php if(($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_agregar') || 
								 ($this->params['controller'] == 'pedidos' && $this->params['action'] == 'admin_index') || 
								 ($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_listar_subcategorias/admin_inventario') ||
								 ($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_listar_subcategorias/admin_movimientos') ||
								 ($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_articulos') ||
								 ($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_listar_subcategorias') ||
								 ($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_inventario') ||
								 ($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_movimientos')
		) echo 'active'; ?>">
	Almacén
		<ul>
			<li class = "children <?php if($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_articulos') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Ingreso',array('controller' => 'inventarioalmacens', 'action' => 'admin_agregar')); ?>
			</li>
			<li class = "children <?php if($this->params['controller'] == 'pedidos' && $this->params['action'] == 'admin_index') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Egresos',array('controller' => 'pedidos', 'action' => 'admin_index')); ?>
			</li>
			<li class = "children <?php if(($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_listar_subcategorias/admin_inventario')||
										$this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 'admin_inventario')
			echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Inventario',array('controller' => 'inventarioalmacens', 'action' => 'admin_listar_subcategorias/admin_inventario'));?>
			</li>
			<li class = "children <?php if(($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 									'admin_listar_subcategorias/admin_movimientos') ||
											($this->params['controller'] == 'inventarioalmacens' && $this->params['action'] == 									'admin_movimientos'))

			echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Movimientos',array('controller' => 'inventarioalmacens', 'action' => 'admin_listar_subcategorias/admin_movimientos'));?>
			</li>
		</ul>
	</li>
	<?php } ?>
	<?php
	}
	if ($admin_reportes){ ?>
	<li class = "option <?php if(($this->params['controller'] == 'index' && $this->params['action'] == 'admin_cuentas_mensual') ||
								($this->params['controller'] == 'index' && $this->params['action'] == 'admin_facturacion_mensual') ||
								($this->params['controller'] == 'index' && $this->params['action'] == 'admin_cobranza_mensual') || 
								($this->params['controller'] == 'index' && $this->params['action'] == 'admin_reportes_semanales') ||
								($this->params['controller'] == 'index' && $this->params['action'] == 'admin_reportes_mensuales'))
								echo 'active'; ?> " >
	
	CIO
		<ul>
			<li class = "children <?php if($this->params['controller'] == 'index' && $this->params['action'] == 'admin_reportes_semanales') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Estadísticas semanales',array('controller' => 'index', 'action' => 'admin_reportes_semanales')); ?>
			</li>
			<li class = "children <?php if($this->params['controller'] == 'index' && $this->params['action'] == 'admin_reportes_mensuales') echo 'active'; else echo 'inactive'; ?>">
				<?php echo $this->Html->link('Estadísticas mensuales',array('controller' => 'index', 'action' => 'admin_reportes_mensuales')); ?>
			</li>
		</ul>
	</li>
	<?php } ?>
	<?php if (false){// if ($admin_despachos){ ?>
	<li class = "option <?php if(($this->params['controller'] == 'pedidos' && $this->params['action'] == 'admin_pedidos')) echo 'active'; ?> ">
		<?php echo $this->Html->link('Pedidos',array('controller' => 'pedidos', 'action' => 'admin_pedidos')); ?>
	</li>
	<?php } 
	if (false){ //($admin_cuentas) { ?>
		<li class = "option <?php if(($this->params['controller'] == 'cuentas' && $this->params['action'] == 'admin_index')) echo 'active'; ?>">
			<?php echo $this->Html->link('Cuentas',array('controller' => 'cuentas', 'action' => 'admin_index')); ?>
		</li>
	<?php
		}
	if ($rol == 'cliente') { ?>
		<?php if ($cliente_catalogo) { ?>
			<li class = "option"><?php echo $this->Html->link('Catálogo',array('controller' => 'articulos', 'action' => 'subcategoria_catalogo')); ?></li>
		<?php }?>
		<li class = "option"><?php echo $this->Html->link('Cuentas',array('controller' => 'cuentas', 'action' => 'index')); ?>
		</li>
		<?php if ($cliente_almacen) { ?>
		<li class = "option"><?php echo $this->Html->link('Almacén',array('controller' => 'almacenclientes', 'action' => 'listar_subcategorias','index')); ?>
		</li>
		<?php }?>
		<li class = "option <?php if($this->params['controller'] == 'users' && $this->params['action'] == 'pedidos' || 
									$this->params['controller'] == 'users' && $this->params['action'] == 'despachos'
		) echo 'active'; ?>">
		Mis Pedidos
			<ul>
				<li class = "children <?php if($this->params['controller'] == 'users' && $this->params['action'] == 'pedidos') echo 'active'; else echo 'inactive'; ?>">
					<?php echo $this->Html->link('Pedidos',array('controller' => 'users', 'action' => 'pedidos')); ?>
				</li>
				<li class = "children <?php if($this->params['controller'] == 'users' && $this->params['action'] == 'despachos') echo 'active'; else echo 'inactive'; ?>">
					<?php echo $this->Html->link('Despachos',array('controller' => 'users', 'action' => 'despachos')); ?>
				</li>				
			</ul>
		</li>
	<?php
	}
	if ($admin_web) { ?>
		<li class = "option <?php if($this->params['controller'] == 'contenidos') echo 'active'; ?>">
			Web
			<ul>
				<li class = "children <?php if($this->params['controller'] == 'contenidos' && ($this->params['action'] == 'admin_home' || $this->params['action'] == 'admin_agregar_imagen')) echo 'active'; else echo 'inactive'; ?>">
					<?php echo $this->Html->link('Home',array('controller' => 'contenidos', 'action' => 'admin_home')); ?>
				</li>
				<li class = "children <?php if($this->params['controller'] == 'contenidos' && ($this->params['action'] == 'admin_index' || $this->params['action'] == 'admin_editar')) echo 'active'; else echo 'inactive'; ?>">
					<?php echo $this->Html->link('Header',array('controller' => 'contenidos', 'action' => 'admin_index')); ?>
				</li>
				<li class = "children <?php if($this->params['controller'] == 'contenidos' && ($this->params['action'] == 'admin_footer' || $this->params['action'] == 'admin_editar_footer')) echo 'active'; else echo 'inactive'; ?>">
					<?php echo $this->Html->link('Footer',array('controller' => 'contenidos', 'action' => 'admin_footer')); ?>
				</li>
			</ul>
		</li>
	<?php
	}
	// debug($this->params['controller']);
	?>
	
</ul>
</div>
<script>
	
	$('.option').click(function() {
		$(this).siblings().removeClass('selected');
		$(this).addClass('selected');
		console.debug($(this).siblings().children());
		$(this).siblings().children().find('li').hide();
		$(this).find('ul').fadeIn();
		$(this).find('li').fadeIn();
    });
	// $('.active').removeClass();
	$('.active a').css("color", '#d7e4e8');
	$('.inactive a').css("color", '#FFF');
	$('.inactive a').hover(
	  function () {
		$(this).css("color", '#d7e4e8');
	  },
	  function () {
		$(this).css("color", '#FFF');
	  }
	);
	$('.active').children().show();
		
</script>