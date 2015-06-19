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
				<?php foreach ($functions as $function): ?> 
				<li><a href="<?php echo "officer/$function";?>" id="" class="skel-layers-ignoreHref"><span class="icon fa-home"><?php echo ucfirst($function);?></span></a></li>
				<?php endforeach ?>
			</ul>
		</nav>
	</div>
</div>