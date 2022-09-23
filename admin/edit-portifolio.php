<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php 
    // Check the id is valid or not
    if(!isset($_GET['edit']) OR !is_numeric($_GET['edit'])) {
        header('location: edit-portifolio.php');
        exit;
        }else{
        $statement = $conn->prepare("SELECT * FROM portifolio WHERE portifolio_id=?");
        $statement->execute(array($_GET['edit']));
        $total  = $statement->rowCount();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if( $total == 0 ) {
            header('location: edit-portifolio.php');
            exit;
        }else{
            $a = extract($result,EXTR_PREFIX_ALL, "edit");
        }
    }
?>
<?php 
	if(isset($_POST['submit'])){
		$valid = 1;
		$portifolio_title = clean($_POST['portifolio_title']);
		$portifolio_desc = clean($_POST['portifolio_desc']);
		$portifolio_url = clean($_POST['portifolio_url']);
		if(isset($_POST['portifolio_status'])){
			$portifolio_status = clean($_POST['portifolio_status']);
		if($portifolio_status == 'on'){
			$portifolio_status = 1;
		}else{
            $portifolio_status = 0;}
        }else{
			$portifolio_status = 0;
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
		//check if fields empty - code ends

		//check User Photo - code starts
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
    //check User Photo - code ends
    //If everthing is OK - code starts
	if($valid == 1) {
        //Upload user Photo if available
			if($portifolio_photo!='') {
		    $portifolio_photo_file = '../portifolio-photo-'.time().'.'.$portifolio_photo_ext;
		    move_uploaded_file( $portifolio_photo_tmp, '../storage/portifolio/'.$portifolio_photo_file );
			}else{
				$portifolio_photo_file = $edit_portifolio_photo;
			}

			//insert the data
			$insert = $conn->prepare("UPDATE portifolio SET portifolio_title = ?, portifolio_desc = ?, portifolio_url = ?, portifolio_photo = ?, portifolio_status = ?, p_updated = ? WHERE portifolio_id = ?");
			$insert->execute(array($portifolio_title, $portifolio_desc, $portifolio_url, $portifolio_photo_file, $portifolio_status, $p_updated, $edit_portifolio_id));

			//insert the data - code ends
			$_SESSION['success'] = 'Портфолио успешно обновлено!';
		    header('location: portifolio.php');
		    exit(0);
        }
    }
?>
<main class="content">
	<div class="container-fluid p-0">

        <div class="row">
            <div class="col-md-6">
                <h1 class="h3 mb-3"><strong><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <i class="fa fa-suitcase" aria-hidden="true"></i> Редактировать </strong> портфолио </h1>
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
										<input type="text" class="form-control" id="inputTitle" placeholder="Введите название портфолио ..." name="portifolio_title" value="<?php echo clean($edit_portifolio_title); ?>">
									</div>
									<div class="mb-3">
                                    <label class="form-label" for="portifolio_desc"><i class="fa fa-id-card-o" aria-hidden="true"></i> Информации об портфолио: </label>
                                        <input type="text" rows="4" class="form-control" id="portifolio_desc" placeholder="Введите информации портфолио ..." name="portifolio_desc" value="<?php echo clean($edit_portifolio_desc); ?>">

									</div>
									<div class="mb-3">
                                    <label class="form-label" for="inputurl"><i class="fa fa-link" aria-hidden="true"></i> Ссылка URL на портфолио: </label>
										<input type="text" class="form-control" id="inputurl" placeholder="Введите Ссылка URL на портфолио ..." name="portifolio_url" value="<?php echo clean($edit_portifolio_url); ?>">
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
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" <?php if($edit_portifolio_status == 1){echo 'checked=""';} ?> name="portifolio_status">
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
							<h5 class="card-title mb-0"><i class="fa fa-picture-o" aria-hidden="true"></i> Изменить скриншот портфолио: </h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col-md-12">
									<div class="text-center">
										<img alt="Portifolio Image" src="../storage/portifolio/<?php echo clean($edit_portifolio_photo); ?>" class="rounded mx-auto d-block" width="100" height="100" id="portifolioImg">
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