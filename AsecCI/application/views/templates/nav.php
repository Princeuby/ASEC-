<!-- Header -->
<div id="header">

	<div class="top">
		<!-- Logo -->
		<div id="logo">
			<span class="image avatar48"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt="" /></span>
			<h1 id="title"><?php echo $name;?></h1>
			<p><?php echo $rank;?></p>
		</div>

		<!-- Nav -->
		<nav id="nav">
			<ul>
				<?php foreach ($functions as $function): 
				$active = '';
				if ($page === ucwords($function))
					$active = 'active';
				?>
				<li><a href="<?php echo "officer/" . url_title($function, 'underscore', TRUE);?>" id="" class="skel-layers-ignoreHref <?php echo $active;?>"><span class="icon fa-home"><?php echo ucwords($function);?></span></a></li>
				<?php endforeach ?>
			</ul>
		</nav>
	</div>
	
	<div class="bottom center">
			<ul class="icons">
				<li><a href="logout" class="icon">Logout</a></li>
			</ul>
	</div>
</div>