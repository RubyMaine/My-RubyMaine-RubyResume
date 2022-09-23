<?php $page = "Contact"; ?>
<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
    $statement = $conn->prepare("SELECT * FROM contact");
	$statement->execute();
	$result = $statement->fetch(PDO::FETCH_ASSOC);
	$a = extract($result,EXTR_PREFIX_ALL, "edit");

	if(isset($_POST['submit'])){
		$valid	= 1;
		$contact_info = $_POST['contact_info'];
		$contact_address = $_POST['contact_address'];
		
		if(empty($contact_info)){
		    $valid    = 0;
		    $errors[] = 'Please Enter Your Info';
		}

		if($valid == 1) {

			$update = $conn->prepare("UPDATE contact SET contact_info = ?, contact_address = ?  WHERE contact_id = ?");
			$update->execute(array($contact_info, $contact_address,1));
			$_SESSION['success'] = 'Контактная информация успешно обновлена!';
			header('location: contact.php');
			exit(0);
		}
	}

	if(isset($_POST['email'])){

		$valid = 1;
		$contact_email = $_POST['contact_email'];
		$contact_phone = $_POST['contact_phone'];
		
		if(empty($contact_email)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите адрес электронной почты от';
		}
		if(empty($contact_phone)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите номер телефона';
		}

		if($valid == 1) {

			$update = $conn->prepare("UPDATE contact SET contact_email = ?, contact_phone = ?  WHERE contact_id = ?");
			$update->execute(array($contact_email, $contact_phone,1));
			$_SESSION['success'] = 'Настройки электронной почты и телефона успешно обновлены!';
			header('location: contact.php');
			exit(0);
		}
	}

	if(isset($_POST['social'])){

		$valid = 1;
		$contact_fb = $_POST['contact_fb'];
		$contact_tw = $_POST['contact_tw'];
		$contact_insta = $_POST['contact_insta'];
	    $contact_wts = $_POST['contact_wts'];
		
		if($valid == 1){

			$update = $conn->prepare("UPDATE contact SET contact_fb = ?, contact_tw = ?, contact_insta = ?, contact_wts = ? WHERE contact_id = ?");
			$update->execute(array($contact_fb, $contact_tw, $contact_insta, $contact_wts,1));
			$_SESSION['success'] = 'Социальные ссылки успешно обновлены!';
			header('location: contact.php');
			exit(0);
		}
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong><i class="fa fa-id-card-o" aria-hidden="true"></i> Контактная </strong> информация </h1>
		<div class="row">
			<div class="col-md-3 col-xl-3">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title mb-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Контакт: </h5>
					</div>
					<div class="list-group list-group-flush" role="tablist">
						<a class="list-group-item list-group-item-action active" data-bs-toggle="list" href="#contactinfo" role="tab" aria-selected="false"><i class="fa fa-address-book-o" aria-hidden="true"></i> Информация об контакта: </a>

						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#email" role="tab" aria-selected="false"><i class="fa fa-fax" aria-hidden="true"></i> Электронная почта и телефон номер: </a>

						<a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#social" role="tab" aria-selected="false"><i class="fa fa-link" aria-hidden="true"></i> Социальные ссылки: </a>

					</div>
				</div>
			</div>
			<div class="col-md-9 col-xl-9">
				<div class="tab-content">
					<div class="tab-pane fade active show" id="contactinfo" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0"><i class="fa fa-address-book-o" aria-hidden="true"></i> Информация об контакта: </h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="inputcontactinfo"><i class="fa fa-info-circle" aria-hidden="true"></i> <i class="fa fa-suitcase" aria-hidden="true"></i> Информации об проекты: </label>
												<input type="text" class="form-control" id="inputcontactinfo" placeholder="Введите контактную информацию ..." value="<?php echo clean($edit_contact_info); ?>" name="contact_info">
											</div>
											<div class="mb-3">
												<label class="form-label" for="inputaddress"><i class="fa fa-id-card-o" aria-hidden="true"></i> Адрес: </label>
												<input type="text" class="form-control" id="inputcontactaddress" placeholder="Введите свой адрес ..." value="<?php echo clean($edit_contact_address); ?>" name="contact_address">
											</div>
										</div>
									</div>
									<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="email" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0"><i class="fa fa-fax" aria-hidden="true"></i> Электронная почта и телефон номер: </h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-md-12">
											<div class="mb-3">
												<label class="form-label" for="contact_email"><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail: </label>
												<input type="email" class="form-control" id="contact_email"	placeholder="Введите адрес электронной почты ..." value="<?php echo clean($edit_contact_email); ?>" name="contact_email">
											</div>
											<div class="mb-3">
												<label class="form-label" for="contact_phone"><i class="fa fa-phone-square" aria-hidden="true"></i> Номер телефона: </label>
												<input type="text" class="form-control" id="contact_phone" placeholder="Введите свой номер телефона ..." value="<?php echo clean($edit_contact_phone); ?>"
													name="contact_phone">
											</div>
										</div>
									</div>
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>
								</form>
							</div>
						</div>
					</div>

					<div class="tab-pane fade" id="social" role="tabpanel">
						<div class="card">
							<div class="card-header">
								<h5 class="card-title mb-0"><i class="fa fa-link" aria-hidden="true"></i> Социальные ссылки: </h5>
							</div>
							<div class="card-body">
								<form action="" method="POST">
									<div class="row">
										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="contact_fb"><i class="fa fa-globe" aria-hidden="true"></i> Веб-сайта: — [WebSite]  </label>
												<input type="text" class="form-control" id="contact_fb" placeholder="Введите свой веб-сайт: [Пример: https://website.com/]" value="<?php echo clean($edit_contact_fb); ?>" name="contact_fb">
											</div>
                                            <div class="mb-3">
                                                <label class="form-label" for="contact_wts"><i class="fa fa-github" aria-hidden="true"></i> GitHub: — [Репозиторий] </label>
                                                <input type="text" class="form-control" id="contact_wts" placeholder="Введите свой GitHub [Пример: https://github.com/username]" value="<?php echo clean($edit_contact_wts); ?>" name="contact_wts">
                                            </div>

										</div>

										<div class="col-6">
											<div class="mb-3">
												<label class="form-label" for="contact_insta"><i class="fa fa-telegram" aria-hidden="true"></i> Telegram: — [Профиль] </label>
												<input type="text" class="form-control" id="contact_insta" placeholder="Введите свой Телеграм профиль [Пример: https://t.me/username]" value="<?php echo clean($edit_contact_insta); ?>" name="contact_insta">
											</div>
                                            <div class="mb-3">
                                                <label class="form-label" for="contact_insta"><i class="fa fa-telegram" aria-hidden="true"></i> Telegram: — [Канал] </label>
												<input type="text" class="form-control" id="contact_tw" placeholder="Введите свой Телеграм профиль [Пример: https://t.me/channel]" value="<?php echo clean($edit_contact_tw); ?>" name="contact_tw">
											</div>
										</div>
									</div>
									<button type="submit" name="social" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>