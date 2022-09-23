<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
    // Check the id is valid or not
    if(!isset($_GET['edit']) OR !is_numeric($_GET['edit'])) {
        header('location: edit-education.php');
        exit;
        }else{
            $statement = $conn->prepare("SELECT * FROM education WHERE education_id=?");
            $statement->execute(array($_GET['edit']));
            $total  = $statement->rowCount();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if( $total == 0 ) {
            header('location: edit-education.php');
            exit;
        }else{
            $a = extract($result,EXTR_PREFIX_ALL, "edit");
        }
    }
?>
<?php 
    if(isset($_POST['submit'])){
		$valid = 1;
		$education_title = clean($_POST['education_title']);
		$education_desc = clean($_POST['education_desc']);
		$education_year = clean($_POST['education_year']);

		if(isset($_POST['education_status'])){
            $education_status = clean($_POST['education_status']);
			if($education_status == 'on'){
				$education_status = 1;
			}else{
				$education_status = 0;
			}
		}else{
			$education_status = 0;
		}
		//check if fields empty - code starts
		if(empty($education_title)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите образование';
		}
		if(empty($education_desc)){
		    $valid    = 0;
		    $errors[] = 'Пожалуйста, введите образование Описание';
		}

        //If everthing is OK - code starts
        if($valid == 1) {
			//insert the data
            $insert = $conn->prepare("UPDATE education SET education_title = ?, education_desc = ?, education_status = ?, education_year = ? WHERE education_id = ?");
			$insert->execute(array($education_title, $education_desc, $education_status, $education_year, $edit_education_id));

			//insert the data - code ends
			$_SESSION['success'] = 'Образование было успешно обновлено!';
            header('location: education.php');
            exit(0);
        }
	}
?>
<main class="content">
	<div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-6">
                <h1 class="h3 mb-3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <i class="fa fa-graduation-cap" aria-hidden="true"></i><strong> Изменение </strong> образование </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="education.php" class="btn btn-secondary float-right"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> вернуться назад </a>
            </div>
        </div>

		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Изменение информация об образовании: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label" for="inputTitle"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменение заголовок образование: </label>
										<input type="text" class="form-control" id="inputTitle" placeholder="Введите заголовок образование ..." name="education_title" value="<?php echo clean($edit_education_title); ?>">
									</div>
									<div class="mb-3">
										<label class="form-label" for="education_desc"><i class="fa fa-id-card-o" aria-hidden="true"></i> Изменение описание образования: </label>
										<input type="text" rows="4" class="form-control" id="education_desc" placeholder="Введите описание образование ..." name="education_desc" value="<?php echo clean($edit_education_desc); ?>">
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputurl"><i class="fa fa-calendar" aria-hidden="true"></i> Изменение год обучения: </label>
										<input type="text" class="form-control" id="inputurl" placeholder="Введите год обучения ..." name="education_year" value="<?php echo clean($edit_education_year); ?>">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус образования: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mt-4">
										<div class="form-check form-switch mt-2">
                                            <label for="flexSwitchCheckChecked">Включить / Выключить</label>
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php if($edit_education_status == 1){echo 'checked=""';} ?> name="education_status">
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
									<button type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Сохранить все изменения  </button>
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