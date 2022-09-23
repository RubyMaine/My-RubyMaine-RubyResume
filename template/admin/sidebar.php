<nav id="sidebar" class="sidebar js-sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand" href="dashboard.php">
			<i class="fa fa-diamond" style="color: red;" aria-hidden="true"></i>
			<span class="align-middle"><?php echo clean($site_name); ?></span>
		</a>
		<?php $page = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); ?>
		<ul class="sidebar-nav">
			<li class="sidebar-header">
				
			</li>
			<li class="sidebar-item <?php if($page=="dashboard.php"){echo "active";} ?>">
				<a class="sidebar-link" href="dashboard.php">
					<i class="align-middle" data-feather="sliders" style="color: red;"></i> <span class="align-middle"> Панель управление </span>
				</a>
			</li>
			<!-- Custom Menu -->
			<li class="sidebar-item <?php if($page=="aboutme.php"){echo "active";} ?>">
				<a class="sidebar-link" href="about.php">
					<i class="align-middle" data-feather="user" style="color: red;"></i> <span class="align-middle"> Об мне </span>
				</a>
			</li>

			<li class="sidebar-item <?php if($page=="education.php"){echo "active";} ?>">
				<a class="sidebar-link" href="education.php">
					<i class="align-middle" data-feather="book" style="color: red;"></i> <span class="align-middle"> Образование </span>
				</a>
			</li>

			<li class="sidebar-item <?php if($page=="portifolio.php"){echo "active";} ?>">
				<a class="sidebar-link" href="portifolio.php">
					<i class="align-middle" data-feather="briefcase" style="color: red;"></i> <span class="align-middle"> Портфолио </span>
				</a>
			</li>


			<li class="sidebar-item <?php if($page=="contact.php"){echo "active";} ?>">
				<a class="sidebar-link" href="contact.php">
					<i class="align-middle" data-feather="message-square" style="color: red;"></i> <span class="align-middle"> Контакт </span>
				</a>
			</li>
		
			<!-- End Custom Menu -->
			<li class="sidebar-item <?php if($page=="users.php"){echo "active";} ?>">
				<a class="sidebar-link" href="users.php">
					<i class="align-middle" data-feather="users" style="color: red;"></i> <span class="align-middle"> Пользователи </span>
				</a>
			</li>
			
			<li class="sidebar-item <?php if($page=="settings.php"){echo "active";} ?>">
				<a class="sidebar-link" href="settings.php">
					<i class="align-middle" data-feather="settings" style="color: red;"></i> <span class="align-middle"> Настройки </span>
				</a>
			</li>
		</ul>
	</div>
</nav>