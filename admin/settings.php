<?php $page = "Settings"; ?>
<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
    $statement = $conn->prepare("SELECT * FROM site_settings");
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	$a = extract($result,EXTR_PREFIX_ALL, "edit");

	if(isset($_POST['submit'])){
		$valid = 1;
		$site_name = $_POST['site_name'];
		$site_desc = $_POST['site_description'];
		
		if(empty($site_name)){
		    $valid = 0;
		    $errors[] = 'Please Enter Site Name';
		}

		if($valid == 1) {
			$update = $conn->prepare("UPDATE site_settings SET site_name = ?, site_description = ?  WHERE settings_id = ?");
			$update->execute(array($site_name, $site_desc,1));
			$_SESSION['success'] = 'Настройки сайта успешно обновлены!';
			header('location: settings.php');
			exit(0);
		}
	}

	//Upload logo
	if(isset($_POST['logo'])){
		$valid = 1;
		$logo_file = $_FILES['logo_file']['name'];
        $logo_file_tmp = $_FILES['logo_file']['tmp_name'];

	  	if($logo_file!='') {
	    	$logo_file_ext = pathinfo( $logo_file, PATHINFO_EXTENSION );
	    	$file_name = basename( $logo_file, '.' . $logo_file_ext );
	    	if( $logo_file_ext!='jpg' && $logo_file_ext!='png' && $logo_file_ext!='jpeg' && $logo_file_ext!='gif' ) {
	      	$valid = 0;
	      	$errors[]= 'Вы должны загрузить файл jpg, jpeg, gif или png <br>';}
		}

		if($valid == 1) {
			if($logo_file!='') {
			    $logo_final_file = 'logo-file-'.time().'.'.$logo_file_ext;
			    move_uploaded_file( $logo_file_tmp, '../storage/logo/'.$logo_final_file );
			    unlink('../storage/logo/'.$edit_site_logo);
			}else{
				$logo_final_file = $edit_site_logo;
			}
			$update = $conn->prepare("UPDATE site_settings SET site_logo = ? WHERE settings_id = ?");
			$update->execute(array($logo_final_file,1));
			$_SESSION['success'] = 'Логотип сайта успешно обновлен!';
			header('location: settings.php');
			exit(0);
		}
	}

	if(isset($_POST['email'])){
		$valid = 1;
		$email_from = $_POST['email_from'];
		$email_from_title = $_POST['email_from_title'];
		if(empty($email_from)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите адрес электронной почты от';
		}
		if(empty($email_from_title)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите адрес электронной почты из заголовка';
		}

		if($valid == 1) {
			$update = $conn->prepare("UPDATE site_settings SET email_from = ?, email_from_title = ?  WHERE settings_id = ?");
			$update->execute(array($email_from, $email_from_title,1));
			$_SESSION['success'] = 'Настройки электронной почты успешно обновлены!';
			header('location: settings.php');
			exit(0);
		}
	}

	if(isset($_POST['seo'])){
		$valid = 1;
		$seo_meta_title = $_POST['seo_meta_title'];
		$seo_meta_tags = $_POST['seo_meta_tags'];
		$seo_meta_description = $_POST['seo_meta_description'];
		
		if(empty($seo_meta_title)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите мета-заголовок SEO';
		}
		if(empty($seo_meta_tags)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите SEO-метатеги';
		}
		if(empty($seo_meta_description)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите мета-описания SEO';
		}

		if($valid == 1) {
			$update = $conn->prepare("UPDATE site_settings SET seo_meta_title = ?, seo_meta_tags = ?, seo_meta_description = ?  WHERE settings_id = ?");
			$update->execute(array($seo_meta_title, $seo_meta_tags, $seo_meta_description,1));
			$_SESSION['success'] = 'Настройки SEO успешно обновлены!';
			header('location: settings.php');
			exit(0);
		}
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong><i class="fa fa-cog" aria-hidden="true"></i> Настройки </strong> сайта </h1>
		<div class="row">
			<div class="col-md-3 col-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"><i class="fa fa-cogs" aria-hidden="true"></i> Общие настройки сайта: </h5>
					</div>
					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#site" role="tab" aria-selected="false"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Название (Веб-сайта): </a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#logo" role="tab"	aria-selected="false"><i class="fa fa-file-image-o" aria-hidden="true"></i> Логотип (Logotype): </a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#seo" role="tab" aria-selected="false"><i class="fa fa-rss" aria-hidden="true"></i> Сайт SEO-оптимизация: </a>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-xl-9">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="site" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Название (Веб-сайта): </h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="inputSitename"><i class="fa fa-pencil-square" aria-hidden="true"></i> Имя сайта: </label>
												<input type="text" class="form-control" id="inputSitename" placeholder="Введите имя сайта ..." value="<?php echo clean($edit_site_name); ?>" name="site_name">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputSiteDesc"><i class="fa fa-list-alt" aria-hidden="true"></i> Описание об сайта: </label>
												<textarea name="site_description" rows="2" class="form-control" id="inputSiteDesc" placeholder="Напишите что-нибудь про сайта ..."><?php echo clean($edit_site_description); ?></textarea>
											</div>
										</div>
									</div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>
								</form>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="logo" role="tabpanel">
						<div class="card">
							<div class="card-body">
								<h5 class="card-title"><i class="fa fa-file-image-o" aria-hidden="true"></i> Логотип (Logotype): </h5>
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Profile Image" src="../storage/logo/<?php echo clean($edit_site_logo); ?>" class="rounded-circle img-responsive mt-2" width="128" height="128" id="profileImg">
										<form action="" method="POST" enctype="multipart/form-data">
											<div class="mt-2">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Выберите изображение: <i class="fa fa-picture-o" aria-hidden="true"></i> JPG <i class="fa fa-file-image-o" aria-hidden="true"></i> PNG <input type="file" class="file-upload" value="Upload" name="portifolio_image" onchange="previewFile(this);" accept="image/*"> </button>
												<br><br>
                                                <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane fade" id="seo" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0"><i class="fa fa-rss" aria-hidden="true"></i> Сайт SEO-оптимизация: </h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="seo_meta_title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Заголовок SEO-Meta: </label>
												<input type="text" class="form-control" id="seo_meta_title" placeholder="Введите заголовок SEO-Meta ..." value="<?php echo clean($edit_seo_meta_title); ?>" name="seo_meta_title">
											</div>
											<div class="mb-3">
												<label class="form-label" for="seo_meta_tags"> SEO-Meta теги: </label>
												<input type="text" class="form-control" id="seo_meta_tags" placeholder="Введите SEO-Meta теги ..." value="<?php echo clean($edit_seo_meta_tags); ?>" name="seo_meta_tags">
											</div>
											<div class="mb-3">
												<label class="form-label" for="seo_meta_description"> Описание SEO-Meta: </label>
												<textarea type="text" rows="4" class="form-control" id="seo_meta_description" placeholder="Введите Описание SEO-Meta ..." name="seo_meta_description"><?php echo clean($edit_seo_meta_description); ?></textarea>
											</div>
										</div>
									</div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>