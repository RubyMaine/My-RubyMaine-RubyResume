<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
    // Check the id is valid or not
    if(!isset($_GET['edit']) OR !is_numeric($_GET['edit'])) {
        header('location: logout.php');
        exit;
        }else{
        $statement = $conn->prepare("SELECT * FROM users WHERE user_id=?");
        $statement->execute(array($_GET['edit']));
        $total  = $statement->rowCount();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if( $total == 0 ) {
            header('location: logout.php');
            exit;
        }else{
          $a = extract($result,EXTR_PREFIX_ALL, "edit");
        }
    }
?>

<?php 
	if(isset($_POST['submit'])){
		$valid = 1;
		$user_full_name = clean($_POST['user_full_name']);
		$username = clean($_POST['username']);
		$email = clean($_POST['email']);
		$password = clean($_POST['password']);
		$verify_password = clean($_POST['verify_password']);
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		$date_updated = date('Y-m-d H:i:s');
		
		if(isset($_POST['status'])){
			$status = clean($_POST['status']);
			if($status == 'on'){
				$status = 1;
			}else{
				$status = 0;}
		    }else{
			$status = 0;
		}

		$statement = $conn->prepare('SELECT  * FROM users WHERE user_id != ? AND (user_name = ? OR email = ?)');
	    $statement->execute(array($edit_user_id, $username, $email));
	    $total = $statement->rowCount();
	    if( $total > 0 ) {
	        $valid = 0;
	        $errors[] = 'Этот пользователь уже зарегистрирован.';
	    }
		//check if fields empty - code starts
		if(empty($user_full_name)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите полное имя пользователя';
		}
		if(empty($username)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите имя пользователя';
		}
		if(empty($email)){
	      	$valid = 0;
	      	$errors[] = 'Пожалуйста, введите адрес электронной почты';
		}
		if(!empty($password)){

        if(strlen($password) < 4){
            $valid = 0;
            $errors[] = "Пароль должен быть не менее 4 символов";
        }
	    	if($password != $verify_password){
	            $valid = 0;
	            $errors[] = 'Пароль и подтверждение пароля не совпадают';}
		    }else{
			$password_hash = $edit_user_password;
		}
		//check if fields empty - code ends

		//check User Photo - code starts
  	    $user_photo = $_FILES['profile_image']['name'];
  	    $user_photo_tmp = $_FILES['profile_image']['tmp_name'];

  	    if($user_photo!='') {
    	    $user_photo_ext = pathinfo( $user_photo, PATHINFO_EXTENSION );
    	    $file_name = basename( $user_photo, '.' . $user_photo_ext );
	    	    if( $user_photo_ext!='jpg' && $user_photo_ext!='png' && $user_photo_ext!='jpeg' && $user_photo_ext!='gif' ) {
	      	    $valid = 0;
	      	    $errors[]= 'Вы должны загрузить файл jpg, jpeg, gif или png <br>';
	        }
	    }
	    //check User Photo - code ends

	    //If everthing is OK - code starts

        if($valid == 1) {
	  	//Upload user Photo if available
			if($user_photo!='') {
		        $user_photo_file = 'admin-photo-'.time().'.'.$user_photo_ext;
		        move_uploaded_file( $user_photo_tmp, '../storage/profile/'.$user_photo_file );
			}else{
				$user_photo_file = $edit_user_photo;
			}

			//insert the data
			$insert = $conn->prepare("UPDATE users SET user_full_name = ?, email = ?, user_name =
				?, user_password = ?, user_photo = ?, user_status = ?, user_date_updated = ? WHERE user_id = ?");

			$insert->execute(array($user_full_name, $email, $username, $password_hash, $user_photo_file, $status, $date_updated, $edit_user_id));
			//insert the data - code ends

			$_SESSION['success'] = 'Пользователь успешно обновлен!';
		    header('location: users.php');
		    exit(0);
	    }
	}
?>
<main class="content">
	<div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-6">
                <h1 class="h3 mb-3"><strong><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <i class="fa fa-users" aria-hidden="true"></i> Изменить </strong> пользователя </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="users.php" class="btn btn-secondary float-right"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> вернуться назад </a>
            </div>
        </div>

		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0"><i class="fa fa-list-alt" aria-hidden="true"></i> Общедоступная информация: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label" for="inputUsername"><i class="fa fa-id-card-o" aria-hidden="true"></i> Полное имя пользователя </label>
										<input type="text" class="form-control" id="inputUsername" placeholder="Введите полное имя пользователя ..." name="user_full_name" value="<?php echo clean($edit_user_full_name); ?>">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputUsername"><i class="fa fa-id-badge" aria-hidden="true"></i> Имя пользователя </label>
										<input type="text" class="form-control" id="inputUsername" placeholder="Введите имя пользователя ..."  name="username" value="<?php echo clean($edit_user_name); ?>">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputEmail"><i class="fa fa-envelope" aria-hidden="true"></i> E-Mail </label>
										<input type="email" class="form-control" id="inputEmail" placeholder="Введите адрес электронной почты ..."  name="email" value="<?php echo clean($edit_email); ?>">
									</div>
								</div>		
 						    </div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0"><i class="fa fa-check-square-o" aria-hidden="true"></i> <i class="fa fa-lock" aria-hidden="true"></i> Пароль & Статус: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label" for="inputPasswordNew"><i class="fa fa-lock" aria-hidden="true"></i> Пароль: </label>
										<input type="password" class="form-control" id="inputPasswordNew" placeholder="Введите пароль ..."  name="password">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputPasswordNew2"><i class="fa fa-lock" aria-hidden="true"></i> <i class="fa fa-key" aria-hidden="true"></i> Подтвердите пароль: </label>
										<input type="password" class="form-control" id="inputPasswordNew2" placeholder="Введите Подтвердить пароль ..."  name="verify_password">
									</div>
									<div class="mt-4">
										<div class="form-check form-switch mt-2">
                                            <label for="flexSwitchCheckChecked"> Включить / Выключить </label>
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php if($edit_user_status == 1){echo 'checked=""';} ?> name="status">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0"><i class="fa fa-picture-o" aria-hidden="true"></i> Изображение профиля: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Profile Image" src="../storage/profile/<?php echo clean($edit_user_photo); ?>" class="rounded-circle img-responsive mt-2" width="100" height="100" id="profileImg">
										<div class="mt-2">
                                            <button type="button" class="btn btn-primary"><i class="fa fa-hand-o-right" aria-hidden="true"></i> Выберите изображение: <i class="fa fa-picture-o" aria-hidden="true"></i> JPG <i class="fa fa-file-image-o" aria-hidden="true"></i> PNG <input type="file" class="file-upload" value="Upload" name="portifolio_image" onchange="previewFile(this);" accept="image/*"> </button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
                                    <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения </button>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</form>
	</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>