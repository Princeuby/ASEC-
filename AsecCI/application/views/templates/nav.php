<!-- Header -->
<div id="header">

	<div class="top">
		<!-- Logo -->
		<div id="logo">
			<img id="logo2" class="center" src="<?php echo base_url('assets/images/logo.png'); ?>" alt="">
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
				<li><a href="<?php echo base_url(strtolower($title) . '/' . url_title($function, 'underscore', TRUE));?>" id="" class="skel-layers-ignoreHref <?php echo $active;?>"><span class="icon fa-home"><?php echo ucwords($function);?></span></a></li>
				<?php endforeach ?>
			</ul>
		</nav>
	</div>	
</div>

<!-- Main -->
<div id="main">

	<!-- Intro -->
	<section id="top" class="one dark">
		<div class="container">
			<button id="logout" type='button' onclick="location.href='<?php echo base_url('login/logout'); ?>'">
							Logout</button>
			