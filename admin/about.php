<?php $page = "About"; ?>
<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
	$statement = $conn->prepare("SELECT * FROM about");
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	$a = extract($result,EXTR_PREFIX_ALL, "edit");

	if(isset($_POST['submit'])){

		$valid	= 1;
		$about_title = $_POST['about_title'];
		$about_desc = $_POST['about_desc'];
		$about_name = $_POST['about_name'];
		$about_email = $_POST['about_email'];
		$about_age = $_POST['about_age'];
		$about_address = $_POST['about_address'];
		$about_lang = $_POST['about_lang'];
		$about_exp = $_POST['about_exp'];
		$about_free = $_POST['about_free'];
		$about_skill = $_POST['about_skill'];
		$about_exp_yrs = $_POST['about_exp_yrs'];
		$about_happy = $_POST['about_happy'];
		$about_project = $_POST['about_project'];
		$about_awards = $_POST['about_awards'];
		$about_button = $_POST['about_button'];
		$about_hire = $_POST['about_hire'];
		
		if(empty($about_title)){
		    $valid    = 0;
		    $errors[] = 'Пожалуйста, введите ваши данные';
		}

		if($valid == 1) {

			$update = $conn->prepare("UPDATE about SET about_title = ?, about_desc = ?,	about_name = ?, about_email = ?, about_age = ?, about_address = ?, about_lang = ?, about_exp = ?, about_free = ?, about_skill = ?, about_exp_yrs = ?, about_happy = ?, about_project = ?, about_awards = ?, about_button = ?, about_hire = ?   WHERE about_id = ?");

			$update->execute(array($about_title, $about_desc, $about_name, $about_email, $about_age, $about_address, $about_lang, $about_exp, $about_free, $about_skill, $about_exp_yrs, $about_happy, $about_project, $about_awards, $about_button, $about_hire,1));

			$_SESSION['success'] = 'Личная информация успешно обновлена!';
			header('location: about.php');
			exit(0);
		}
	}

	// //Upload Front Image
	if(isset($_POST['photo'])){

		$valid	= 1;
		
		$about_file     = $_FILES['about_file']['name'];
		$about_file_tmp = $_FILES['about_file']['tmp_name'];

	  	if($about_file!='') {
	    	$about_file_ext = pathinfo( $about_file, PATHINFO_EXTENSION );
	    	$file_name = basename( $about_file, '.' . $about_file_ext );
	    	if( $about_file_ext!='jpg' && $about_file_ext!='png' && $about_file_ext!='jpeg' && $about_file_ext!='gif' ) {
	      	$valid = 0;
	      	$errors[]= 'Вы должны загрузить файл jpg, jpeg, gif или png <br>';
		   }
		}

		if($valid == 1) {

			if($about_file!='') {
			    $about_final_file = 'about-file-'.time().'.'.$about_file_ext;
			    move_uploaded_file( $about_file_tmp, '../storage/home/'.$about_final_file );
			    unlink('../storage/home/'.$edit_about_photo);
			}else{
				$about_final_file = $edit_about_photo;
			}

			$update = $conn->prepare("UPDATE about SET about_photo = ? WHERE about_id = ?");

			$update->execute(array($about_final_file,1));

			$_SESSION['success'] = 'Переднее изображение было успешно обновлено!';
			header('location: about.php');
			exit(0);
		}
	}

?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><i class="fa fa-address-card" aria-hidden="true"></i><strong> Об меня </strong> информации </h1>
		<div class="row">
			<div class="col-md-3 col-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Информации: </h5>
					</div>
					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#aboutinfo" role="tab" aria-selected="false"><i class="fa fa-id-badge" aria-hidden="true"></i> Личная информация:. </a>
						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#photo" role="tab" aria-selected="false"><i class="fa fa-picture-o" aria-hidden="true"></i> Переднее изображение:. </a>
					</div>
				</div>
			</div>
			<div class="col-md-9 col-xl-9">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="aboutinfo" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0"><i class="fa fa-id-badge" aria-hidden="true"></i> Личная информация: </h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="inputabouttitle"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Название заголовок: </label>
												<input type="text" class="form-control" id="inputabouttitle" placeholder="Введите название заголовок" value="<?php echo clean($edit_about_title); ?>" name="about_title">
                                            </div>
											<div class="mb-3">
												<label class="form-label" for="inputdescription"><i class="fa fa-pencil-square" aria-hidden="true"></i> Ваш описание: </label>
												<input type="text" class="form-control" id="inputdescription" placeholder="Введите ваше описание" value="<?php echo clean($edit_about_desc); ?>" name="about_desc">
											</div>
										</div>
										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="inputaboutname"><i class="fa fa-id-card-o" aria-hidden="true"></i> Ваш имя: </label>
												<input type="text" class="form-control" id="inputaboutname" placeholder="Введите ваше имя" value="<?php echo clean($edit_about_name); ?>" name="about_name">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputaddress"><i class="fa fa-map-marker" aria-hidden="true"></i> Ваш адрес: </label>
												<input type="text" class="form-control" id="inputaddress" placeholder="Введите ваше адрес" value="<?php echo clean($edit_about_address); ?>" name="about_address">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputage"><i class="fa fa-google-wallet" aria-hidden="true"></i> Ваш возраст: </label>
												<input type="text" class="form-control" id="inputage" placeholder="Введите ваше возраст" value="<?php echo clean($edit_about_age); ?>" name="about_age">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputexp"><i class="fa fa-empire" aria-hidden="true"></i> Ваш опыт: </label>
												<input type="text" class="form-control" id="inputexp" placeholder="Введите свой опыт" value="<?php echo clean($edit_about_exp); ?>" name="about_exp">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputaboutexp"><i class="fa fa-line-chart" aria-hidden="true"></i> Годы опыта: </label>
												<input type="text" class="form-control" id="inputaboutexp" placeholder="Введите количество лет опыта" value="<?php echo clean($edit_about_exp_yrs); ?>" name="about_exp_yrs">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputproject"><i class="fa fa-suitcase" aria-hidden="true"></i> Завершенный проекты: </label>
												<input type="text" class="form-control" id="inputproject" placeholder="Введите завершенный проекты" value="<?php echo clean($edit_about_project); ?>" name="about_project">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputcv"><i class="fa fa-link" aria-hidden="true"></i> URL-адрес cсылка на резюме (CV): </label>
												<input type="text" class="form-control" id="inputcv" placeholder="Введите URL-адрес резюме" value="<?php echo clean($edit_about_button); ?>" name="about_button">
											</div>
										</div>
										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="inputemail"><i class="fa fa-envelope" aria-hidden="true"></i> Ваша электронная почта: </label>
												<input type="email" class="form-control" id="inputemail" placeholder="Введите ваше адрес электронной почты" value="<?php echo clean($edit_about_email); ?>" name="about_email">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputskill"><i class="fa fa-code" aria-hidden="true"></i> Разработка в: </label>
												<input type="text" class="form-control" id="inputskill" placeholder="Введите на каком разработка" value="<?php echo clean($edit_about_skill); ?>" name="about_skill">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputfree"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус фрилансера: </label>
												<input type="text" class="form-control" id="inputfree" placeholder="Введите статус фрилансера" value="<?php echo clean($edit_about_free); ?>" name="about_free">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputlang"><i class="fa fa-language" aria-hidden="true"></i> Знание языков: </label>
												<input type="text" class="form-control" id="inputlang" placeholder="Введите знание языков" value="<?php echo clean($edit_about_lang); ?>" name="about_lang">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputabouhappy"><i class="fa fa-users" aria-hidden="true"></i> Счастливые клиенты: </label>
												<input type="text" class="form-control" id="inputabouthappy" placeholder="Введите счастливые клиенты" value="<?php echo clean($edit_about_happy); ?>" name="about_happy">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputawards"><i class="fa fa-gift" aria-hidden="true"></i> Награды Об Завершённые Проекты: </label>
												<input type="text" class="form-control" id="inputawards" placeholder="Введите награды об завершённые проекты:" value="<?php echo clean($edit_about_awards); ?>" name="about_awards">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputhire"><i class="fa fa-phone-square" aria-hidden="true"></i> Мобильный номер [Контакты]: </label>
												<input type="text" class="form-control" id="inputhire" placeholder="Введите ваше мобильный номер" value="<?php echo clean($edit_about_hire); ?>" name="about_hire">
											</div>
										</div>
									</div>
									<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="photo" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0"><i class="fa fa-picture-o" aria-hidden="true"></i> Переднее изображение: </h5>
							</div>
							<div class="card-body">
								<h5 class="card-title"><i class="fa fa-file-image-o" aria-hidden="true"></i> Изображение [Картинки]: </h5>
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Front Image" src="../storage/home/<?php echo clean($edit_about_photo); ?>" class="rounded mx-auto d-block" width="200" height="200" id="aboutImg">
										<form action="" method="POST" enctype="multipart/form-data">
											<div class="mt-2">
												<button type="button" class="btn btn-primary"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Выберите изображение: <i class="fa fa-picture-o" aria-hidden="true"></i> JPG <i class="fa fa-file-image-o" aria-hidden="true"></i> PNG <input type="file" class="file-upload" value="Upload" name="about_file" onchange="previewFile(this);" accept="image/*"> </button>
												<br><br>

                                                <button type="submit" name="photo" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>


											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>