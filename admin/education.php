<?php $page = "Education"; ?>
<?php include_once('../template/admin/header.php'); ?>
<?php include_once('../template/admin/sidebar.php'); ?>
<?php include_once('../template/admin/navbar.php'); ?>
<?php
	if(isset($_GET['delete']) AND is_numeric($_GET['delete'])) {
	// Check the Services id is valid or not
	  $statement = $conn->prepare("SELECT * FROM education WHERE education_id=?");
	  $statement->execute(array($_GET['delete']));
	  $total = $statement->rowCount();
	  if( $total == 0  OR $_GET['delete'] == 1) {
	    header('location: education.php');
	    exit;
	  }
      else{

	  	$result = $statement->fetch(PDO::FETCH_ASSOC);
	  	if($result['education_photo'] != '' AND $result['education_photo'] != 'default.png') {
	      unlink('storage/portifolio/'.$result['education_photo']); 
	    }	
	    // Delete from Services Table
	    $statement = $conn->prepare("DELETE FROM education WHERE education_id=?");
	    $statement->execute(array($_GET['delete']));
	    $_SESSION['success'] = 'Образование было удалено';
	    header('location: education.php');
	    exit(0);
	  }
	}
?>
<main class="content">
	<div class="container-fluid p-0">
		<div class="row">
			<div class="col-md-6">
				<h1 class="h3 mb-3"><i class="fa fa-graduation-cap" aria-hidden="true"></i><strong> Все </strong> образования </h1>
			</div>
			<div class="col-md-6 text-md-end">
				<a href="add-education.php" class="btn btn-success float-right"><i class="fa fa-plus-square" aria-hidden="true"></i> Добавить образование </a>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<table class="table dataTable table-striped table-hover">
					<thead>
						<tr>
							<th><i class="fa fa-calendar" aria-hidden="true"></i> Год образования </th>
							<th><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Название образования</th>
							<th><i class="fa fa-id-card-o" aria-hidden="true"></i> Описание образования</th>
							<th><i class="fa fa-check-square-o" aria-hidden="true"></i> Статус активности </th>
							<th><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Действия </th>
						</tr>
					</thead>
					<tbody>
						<?php
			                $i=1;
			                $statement = $conn->prepare('SELECT * FROM education ORDER BY education_id DESC');
			                $statement->execute();
			                $education = $statement->fetchAll(PDO::FETCH_ASSOC);
			                $sNo  = 1;
			                foreach ($education as $education) {
			                ?>
						<tr>
							<td><?php echo clean($education['education_year']); ?></td>
							<td><?php echo clean($education['education_title']); ?></td>
							<td class="col-2 text-truncate" style="max-width: 150px;">
								<?php echo clean($education['education_desc']); ?></td>


							<td><?php echo ($education['education_status'] == 1) ? "<span class='badge bg-success me-1 my-1'> Активный </span>" : "<span class='badge bg-danger me-1 my-1'> Не Активный <span>"; ?>
							</td>
							<td>
								<a class="btn btn-primary" href="edit-education.php?edit=<?php echo clean($education['education_id']); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Редактировать </a> <?php if($education['education_id'] != 1){ ?>
								<a class="btn btn-danger" href="#" data-href="education.php?delete=<?php echo clean($education['education_id']); ?>" data-bs-toggle="modal" data-bs-target="#confirm-delete"><i class="fa fa-trash" aria-hidden="true"></i> Удалить </a>
								<?php } ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
			<!-- BEGIN primary modal -->
			<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title"><i class="fa fa-trash" aria-hidden="true"></i> Удалить образование? </h5>
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						<div class="modal-body m-3">
							<p class="mb-0" style="text-align: center;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Вы уверены, что хотите удалить это образование? </p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Закрывать </button>
							<a class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Удалить образование </a>
						</div>
					</div>
				</div>
			</div>
			<!-- END primary modal -->
		</div>
</main>
<?php include_once('../template/admin/footer.php'); ?>