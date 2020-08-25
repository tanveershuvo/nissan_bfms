
<body class="theme-deep-purple">

	<!-- Top Bar -->
	<nav class="navbar ">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href=""><?php echo $siteName;?> - <?php $cn=$_SESSION['com_name']; if (isset($cn)){echo $cn;} else {echo "";}?></a>
			</div>
			<ul class="nav navbar-nav ">

				<li><a><?php if (isset($_SESSION['sea_name'])){ echo 'Season Name : '; echo $_SESSION['sea_name']; }?></a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a><span class="glyphicon glyphicon-user"></span>  <?=$_SESSION['NAME']?></a></li>
					<li><a style="background-color: #e3f6f5; color: #272643;border-radius: 5px;margin-bottom: 10px;margin-right: 10px;font-weight: bold;" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
				</ul>
			</div>
		</nav>


		<!-- #Top Bar -->
		<section>
			<!-- Left Sidebar -->
			<aside id="leftsidebar" class="sidebar">
				<!-- Menu -->
				<div class="menu">

					<ul class="list">


						<li>
							<a href="company">
								<i class="material-icons">home_work</i>
								<span>Company (<?php echo $siteName;?>)</span>
							</a>
						</li>
						<li>
							<a href="season_details">
								<i class="material-icons">info</i>
								<span>Seasons</span>
							</a>
						</li>
						<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==111)){ echo 'class="header"';}
						if($_SESSION['access']==(1||2)){
							?>>
							<a href="dashboard">
								<i class="material-icons">dashboard</i>
								<span>Dashboard</span>
							</a>
						</li>
					<?php } ?>

					<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==4) || ($_SESSION['nav']==5)|| ($_SESSION['nav']==55)){ echo 'class="active" ';}
					if($_SESSION['access']==(1||2)){?>>
						<a class="menu-toggle">
							<i class="material-icons">supervisor_account</i>
							<span>Employee's</span>
						</a>
						<ul class="ml-menu">
							<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==4)){ echo 'class="header" ';}?>>
								<a href="employee_add">
									<i class="material-icons">person_add_alt_1</i>
									<span>Assign
									</a>
								</li>
								<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==5)){ echo 'class="header" ';}?>>
									<a href="employee_salary">
										<i class="material-icons">monetization_on</i>
										<span>Unpaid Salary</span>
									</a>
								</li>
								<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==55)){ echo 'class="header" ';}?>>
									<a href="employee_paid_salary">
										<i class="material-icons">money_off</i>
										<span>Paid Salary </span>
									</a>
								</li>

							</ul>
						</li>
					<?php } ?>

					<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==1)){ echo 'class="header"';}
					if($_SESSION['access']==(0)){?>>
						<a href="home">
							<i class="material-icons">home</i>
							<span>Home</span>
						</a>
					</li>
				<?php } ?>
				<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==2)){ echo 'class="header" ';}?> >
					<a href="product_availability">
						<i class="material-icons">store</i>
						<span>Products</span>
					</a>
				</li>
				<li  <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==3)){ echo 'class="header" ';}?>>
					<a href="customer_add">
						<i class="material-icons">person</i>
						<span>Customer's</span>
					</a>
				</li>
				<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==8)){ echo 'class="header" ';}?>>
					<a href="sordar_add">
						<i class="material-icons">groups</i>
						<span>Sordar</span>
					</a>
				</li>



				<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==7)){ echo 'class="header" ';}
				if($_SESSION['access']==(0)){?>>
					<a href="mechinaries">
						<i class="material-icons">settings</i>
						<span>Machinary Details</span>
					</a>
				</li>
			<?php }?>
			<li <?php if(isset ($_SESSION['nav'])&& ($_SESSION['nav']==98)){ echo 'class="header" ';}
			if($_SESSION['access']==(0)){?>>
				<a href="donation">
					<i class="material-icons">money</i>
					<span>Donation</span>
				</a>
			</li>
		<?php }?>




	</div>



</aside>
<!-- #END# Left Sidebar -->
</section>
