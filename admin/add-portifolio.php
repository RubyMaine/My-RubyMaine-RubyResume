<?php $page = "Add Portifolio"; ?>
<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
    if(isset($_POST['submit'])){
		$valid = 1;
		$portifolio_title = clean($_POST['portifolio_title']);
		$portifolio_desc = clean($_POST['portifolio_desc']);
		$portifolio_url = clean($_POST['portifolio_url']);

		$p_created = date('Y-m-d H:i:s');
		if(isset($_POST['portifolio_status'])){
			$portifolio_status = clean($_POST['portifolio_status']);

			if($portifolio_status == 'on'){
				$portifolio_status = 1;
			}else{
				$portifolio_status = 0;
			}
		}else{
			$portifolio_status = 0;
		}

		$statement = $conn->prepare('SELECT  * FROM portifolio WHERE portifolio_title = ?');
	  	$statement->execute(array($portifolio_title));
	  	$total = $statement->rowCount();
	  	if( $total > 0 ) {
	    	$valid = 0;
	    	$errors[] = 'Это портфолио уже зарегистрировано!';
	  	}
		//check if fields empty - code starts
		if(empty($portifolio_title)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите название портфолио';
		}
		if(empty($portifolio_desc)){
		    $valid = 0;
		    $errors[] = 'Пожалуйста, введите описание портфолио';
		}
		//check Service Image - code starts
	  	$portifolio_photo = $_FILES['portifolio_image']['name'];
	  	$portifolio_photo_tmp = $_FILES['portifolio_image']['tmp_name'];

	  	if($portifolio_photo!='') {
	    	$portifolio_photo_ext = pathinfo( $portifolio_photo, PATHINFO_EXTENSION );
	    	$file_name = basename( $portifolio_photo, '.' . $portifolio_photo_ext );
	    	if( $portifolio_photo_ext!='jpg' && $portifolio_photo_ext!='png' && $portifolio_photo_ext!='jpeg' && $portifolio_photo_ext!='gif' ) {
	      	$valid = 0;
	      	$errors[]= 'Вы должны загрузить файл jpg, jpeg, gif или png <br>';
	    }
	}
    //check Service Image - code ends

    //If everthing is OK - code starts
    if($valid == 1) {
        //Upload Service Image if available
    	if($portifolio_photo!='') {
		    $portifolio_photo_file = 'portifolio-photo-'.time().'.'.$portifolio_photo_ext;
		    move_uploaded_file( $portifolio_photo_tmp, '../storage/portifolio/'.$portifolio_photo_file );
		}else{
			$portifolio_photo_file = "default.png";
		}
		//insert the data
		$insert = $conn->prepare("INSERT INTO portifolio (portifolio_title, portifolio_url, portifolio_desc, portifolio_photo, portifolio_status, p_created ) VALUES(?,?,?,?,?,?)");
		$insert->execute(array($portifolio_title, $portifolio_url, $portifolio_desc, $portifolio_photo_file, $portifolio_status, $p_created));
		//insert the data - code ends
		$_SESSION['success'] = 'Портфолио успешно добавлено!';
	    header('location: portifolio.php');
	    exit(0);
        }
    }
 ?>
<main class="content">
	<div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-6">
                <h1 class="h3 mb-3"><strong><i class="fa fa-plus-square" aria-hidden="true"></i> <i class="fa fa-suitcase" aria-hidden="true"></i> Добавить </strong> новое портфолио </h1>
            </div>
            <div class="col-md-6 text-md-end">
                <a href="portifolio.php" class="btn btn-secondary float-right"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> вернуться назад </a>
            </div>
        </div>

		<form action="" method="POST" enctype="multipart/form-data">
			<div class="row">
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0"><i class="fa fa-info-circle" aria-hidden="true"></i> Информация об портфолио: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">

									<div class="mb-3">
										<label class="form-label" for="inputTitle"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Название портфолио: </label>
										<input type="text" class="form-control" id="inputTitle" placeholder="Введите название портфолио ..." name="portifolio_title">
									</div>
									<div class="mb-3">
										<label class="form-label" for="portifolio_desc"><i class="fa fa-id-card-o" aria-hidden="true"></i> Информации об портфолио: </label>
										<textarea type="text" rows="4" class="form-control" id="portifolio_desc" placeholder="Введите информации портфолио ..."	name="portifolio_desc"></textarea>
									</div>
									<div class="mb-3">
										<label class="form-label" for="inputurl"><i class="fa fa-link" aria-hidden="true"></i> Ссылка URL на портфолио: </label>
										<input type="text" class="form-control" id="inputurl" placeholder="Введите Ссылка URL на портфолио ..." name="portifolio_url">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4 d-flex">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0"><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус портфолио: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="mt-4">

										<div class="form-check form-switch mt-2">
                                            <label for="flexSwitchCheckChecked"> Включить / Выключить </label>
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="" name="portifolio_status">
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
							<h5 class="card-title mb-0"><i class="fa fa-picture-o" aria-hidden="true"></i> Скриншот портфолио: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<img alt="portifolio Image" src="../storage/portifolio/default.png" class="rounded mx-auto d-block" width="100" height="100" id="portifolioImg">
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