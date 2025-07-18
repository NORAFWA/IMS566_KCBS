<?php

use Cake\Routing\Router;
//echo $this->Html->css('select2/css/select2.css');
//echo $this->Html->script('select2/js/select2.full.min.js');
echo $this->Html->css('jquery.datetimepicker.min.css');
echo $this->Html->script('jquery.datetimepicker.full.js');
echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
//$c_name = $this->request->getParam('controller');
//echo $this->Html->script('bootstrapModal', ['block' => true]);
echo $this->Html->script('bootstrapModal', ['block' => 'scriptBottom']);
?>
<!--Header-->
<div class="row">
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fa-solid fa-bars text-primary"></i>
			</button>
			<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
				<li><?= $this->Html->link(__('<i class="fa-solid fa-plus"></i> New Contact Ticket'), ['controller' => 'Contacts', 'action' => 'add', 'prefix' => false], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
			</div>
		</div>
	</div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-9">
		<div class="nav-align-top mb-4">
			<ul class="nav nav-tabs nav-fill mb-4" role="tablist">
				<li class="nav-item">
					<button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-list" aria-controls="navs-top-list" aria-selected="true"><i class="fa-solid fa-bars-staggered"></i> List</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-report" aria-controls="navs-top-report" aria-selected="false"><i class="fa-solid fa-chart-line"></i> Report</button>
				</li>
				<li class="nav-item">
					<button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-export" aria-controls="navs-top-export" aria-selected="false"><i class="fa-solid fa-download"></i> Export</button>
				</li>
			</ul>
		</div>



		<!--start-->
		<div class="tab-content">
			<div class="tab-pane fade active show" id="navs-top-list" role="tabpanel">
				<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow px-0">
					<div class="card-body text-body-secondary">
						<div class="table-responsive">
							<table class="table table-sm table-border mb-0 table_transparent table-hover">
								<tr>
									<td>#</td>
									<td><?= $this->Paginator->sort('ticket') ?></td>
									<td><?= $this->Paginator->sort('subject') ?></td>
									<td><?= $this->Paginator->sort('name') ?></td>
									<td class="text-center"><?= $this->Paginator->sort('status') ?></td>
									<td class="text-center"><?= $this->Paginator->sort('is_replied', 'Reply') ?></td>
									<td><?= $this->Paginator->sort('id') ?></td>
									<td><?= $this->Paginator->sort('respond_date_time', 'Responded') ?></td>
									<td><?= $this->Paginator->sort('created') ?></td>
									<td class="text-center"><?= __('Actions') ?></td>
								</tr>
								<?php
								$page = $this->Paginator->counter('{{page}}');
								$limit = 10;
								$counter = ($page * $limit) - $limit + 1;
								?>
								<?php foreach ($contacts as $contact) : ?>
									<tr>
										<td><?= $counter++ ?></td>
										<td><?= h($contact->ticket) ?></td>
										<td><?= h($contact->subject) ?></td>
										<td><?= h($contact->name) ?></td>
										<td style="text-align: center;">
											<?php if ($contact->status == 1) {
												echo '<i class="fas fa-circle text-success"></i>';
											} else
												echo '<i class="fas fa-circle text-danger"></i>';
											?>
										</td>
										<td style="text-align: center;">
											<?php if ($contact->is_replied == true) {
												echo '<i class="fa-solid fa-check text-success"></i>';
											} else
												echo '<i class="fa-solid fa-xmark text-danger"></i>';
											?>
										</td>
										<td><?= $this->Number->format($contact->id) ?></td>
										<td>
											<?php if ($contact->respond_date_time == NULL) {
												echo '-';
											} else
												echo date('d M Y', strtotime($contact->respond_date_time));
											?>
										</td>
										<td><?= date('d M Y', strtotime($contact->created)); ?></td>
										<td class="actions text-center">




											<div class="btn-group shadow" role="group" aria-label="Basic example">
												<?php //echo $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', $user->id], ['class' => 'btn btn-outline-success btn-xs', 'escapeTitle' => false]) 
												?>
												<?php echo $this->Html->link(__('<i class="far fa-folder-open"></i>'), ['action' => 'view', $contact->id], ['class' => 'btn btn-outline-success btn-xs', 'escapeTitle' => false]) ?>
												<?php //echo $this->Form->postLink(__('<i class="fa-regular fa-trash-can"></i>'), ['action' => 'delete', $user->id],['class'=> 'btn btn-outline-danger btn-sm', 'escapeTitle' => false], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) 
												?>
												<?php $this->Form->setTemplates([
													'confirmJs' => 'addToModal("{{formName}}"); return false;'
													//'confirmJs' => 'console.log("{{confirmMessage}} - {{formName}}"); return false;'
												]); ?>

												<?= $this->Form->postLink(
													__('<i class="fa-regular fa-trash-can"></i>'),
													['action' => 'delete', $contact->id],
													[
														'confirm' => __('Are you sure you want to delete contact: "{0}"?', $contact->subject),
														'title' => __('Delete'),
														'class' => 'btn btn-outline-danger btn-xs',
														'escapeTitle' => false,
														'data-bs-toggle' => "modal",
														'data-bs-target' => "#bootstrapModal"
													]
												) ?>
											</div>


										</td>
									</tr>
								<?php endforeach; ?>
							</table>
						</div>

						<div aria-label="Page navigation" class="mt-3 px-2">
							<ul class="pagination justify-content-end">
								<?= $this->Paginator->first('<< ' . __('First')) ?>
								<?= $this->Paginator->prev('< ' . __('Previous')) ?>
								<?= $this->Paginator->numbers(['before' => '', 'after' => '']) ?>
								<?= $this->Paginator->next(__('Next') . ' >') ?>
								<?= $this->Paginator->last(__('Last') . ' >>') ?>
							</ul>
							<div class="text-end"><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} article(s) out of {{count}} total')) ?></div>
						</div>

					</div>


				</div>
				<!--end-->
			</div>


			<div class="tab-pane fade px-4" id="navs-top-report" role="tabpanel">


				<div class="row pb-3">
					<div class="col-md-4">
						<div class="stat_card card-1 bg-body-tertiary">
							<h3><?php echo $total_contacts; ?></h3>
							<p>Total Contacts Ticket</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat_card card-2 bg-body-tertiary">
							<h3><?php echo $total_contacts_pending; ?></h3>
							<p>Total Pending Reply</p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="stat_card card-3 bg-body-tertiary">
							<h3><?php echo $total_contacts_responded; ?></h3>
							<p>Total Responded</p>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="card bg-body-tertiary border-0 shadow mb-4">
							<div class="card-body">
								<div class=" card-title mb-0">Contacts (Monthly)</div>
								<div class="tricolor_line mb-3"></div>
								<div class="chart-container" style="position: relative;">
									<canvas id="monthly_contacts"></canvas>
								</div>
								<script>
									const ctx = document.getElementById('monthly_contacts');
									const monthly_contacts = new Chart(ctx, {
										type: 'bar',
										data: {
											labels: <?php echo json_encode($monthArray); ?>,
											datasets: [{
												label: '# of User(s)',
												data: <?php echo json_encode($countArray); ?>,
												backgroundColor: [
													'rgba(255, 99, 132, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(255, 206, 86, 0.2)',
													'rgba(75, 192, 192, 0.2)',
													'rgba(153, 102, 255, 0.2)',
													'rgba(89, 233, 28, 0.2)',
													'rgba(255, 5, 5, 0.2)',
													'rgba(255, 128, 0, 0.2)',
													'rgba(153, 153, 153, 0.2)',
													'rgba(15, 207, 210, 0.2)',
													'rgba(44, 13, 181, 0.2)',
													'rgba(86, 172, 12, 0.2)'
												],
												borderColor: [
													'rgba(255, 99, 132, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(255, 206, 86, 1)',
													'rgba(75, 192, 192, 1)',
													'rgba(153, 102, 255, 1)',
													'rgba(89, 233, 28, 1)',
													'rgba(255, 5, 5, 1)',
													'rgba(255, 128, 0, 1)',
													'rgba(153, 153, 153, 1)',
													'rgba(15, 207, 210, 1)',
													'rgba(44, 13, 181, 1)',
													'rgba(86, 172, 12, 1)'
												],
												borderWidth: 1
											}]
										},
										options: {
											scales: {
												y: {
													beginAtZero: true
												}
											},
											plugins: {
												title: {
													display: false,
													text: 'Monthly Contacts Post',
													font: {
														size: 15
													}
												},
												subtitle: {
													display: false,
													text: '<?php echo $system_name; ?>'
												},
												legend: {
													display: false,
													labels: {
														color: 'rgb(255, 99, 132)'
													}
												},
											}
										}
									});
								</script>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card bg-body-tertiary border-0 shadow mb-4">
							<div class="card-body">
								<div class=" card-title mb-0">Contacts (Monthly)</div>
								<div class="tricolor_line mb-3"></div>
								<div class="chart-container" style="position: relative;">
									<canvas id="status"></canvas>
								</div>
								<script>
									const ctx_2 = document.getElementById('status');
									const status = new Chart(ctx_2, {
										type: 'bar',
										data: {
											labels: ['Pending', 'Responded', 'Ignore'],
											datasets: [{
												label: '# of Contact(s)',
												data: [<?= json_encode($total_contacts_pending); ?>, <?= json_encode($total_contacts_responded); ?>, <?= json_encode($total_contacts_ignored); ?>],
												backgroundColor: [
													'rgba(255, 99, 132, 0.2)',
													'rgba(54, 162, 235, 0.2)',
													'rgba(255, 206, 86, 0.2)',
												],
												borderColor: [
													'rgba(255, 99, 132, 1)',
													'rgba(54, 162, 235, 1)',
													'rgba(255, 206, 86, 1)',
												],
												borderWidth: 1
											}]
										},
										options: {
											scales: {
												y: {
													beginAtZero: true
												}
											},
											plugins: {
												title: {
													display: false,
													text: 'Contact by Status',
													font: {
														size: 15
													}
												},
												subtitle: {
													display: false,
													text: '<?php echo $system_name; ?>'
												},
												legend: {
													display: false,
													labels: {
														color: 'rgb(255, 99, 132)'
													}
												},
											}
										}
									});
								</script>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="tab-pane fade px-4" id="navs-top-export" role="tabpanel">
				<?php
				$domain = Router::url("/", true);
				$sub = 'admin/contacts';
				$combine = $domain . $sub;
				?>
				<div class="row pb-3">
					<div class="col-md-3 mb-2">
						<a href='<?php echo $combine; ?>/csv' class="kosong">
							<div class="card border-0 shadow bg-body-tertiary">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-file-csv fa-2x text-primary"></i></div>
										<div class="col-7 text-end m-auto">
											<div class="fs-4 fw-bold">CSV</div>
											<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 mb-2">
						<a href='<?php echo $combine; ?>/json' class="kosong" target="_blank">
							<div class="card border-0 shadow bg-body-tertiary">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-solid fa-braille fa-2x text-warning"></i></div>
										<div class="col-7 text-end m-auto">
											<div class="fs-4 fw-bold">JSON</div>
											<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-3 mb-2">
						<a href='<?php echo $combine; ?>/pdfList' class="kosong">
							<div class="card border-0 shadow bg-body-tertiary">
								<div class="card-body">
									<div class="row mx-0">
										<div class="col-5 text-center mt-3 mb-3"><i class="fa-regular fa-file-pdf fa-2x text-danger"></i></div>
										<div class="col-7 text-end m-auto">
											<div class="fs-4 fw-bold">PDF</div>
											<div class="small-text"><i class="fa-solid fa-angles-down fa-flip"></i> Download</div>
										</div>
									</div>
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>


	</div>
	<div class="col-md-3">

		<div class="card bg-body-tertiary border-0 shadow mb-4">
			<div class="card-body">
				<div class="card-title mb-0">Search</div>
				<div class="tricolor_line mb-3"></div>
				<?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'contacts', 'action' => 'index']]); ?>
				<fieldset>
					<div class="mb-1"><?php echo $this->Form->control('ticket', ['required' => false, 'class' => 'form-control border-0']); ?></div>
					<div class="mb-1"><?php echo $this->Form->control('subject', ['required' => false, 'class' => 'form-control border-0']); ?></div>
					<?php //echo $this->Form->control('fullname',['class' => 'form-control form-control-sm','required' => false]); 
					?>
					<?php //echo $this->Form->control('email',['class' => 'form-control form-control-sm','required' => false]); 
					?>

					<div class="mb-1">
						<?php echo $this->Form->label('Status'); ?><br>
						<?php
						$options = [
							'0' => 'Pending',
							'1' => 'Responded',
							'2' => 'Ignored',
						];
						echo $this->Form->select('status', $options, [
							'multiple' => 'checkbox',
							'class' => 'form-check-input'
						]);
						?>
					</div>

					<div class="row">
						<div class="col-6">
							<?php echo $this->Form->control('from', [
								'class' => 'form-control form-control-sm datepicker-here border-0',
								'label' => 'Posted From',
								'id' => 'from',
								'type' => 'Text',
								'data-language' => 'en',
								'data-date-format' => 'Y-m-d',
								'empty' => 'empty',
								'required' => false,
								'autocomplete' => 'off'
							]); ?>
						</div>
						<div class="col-6">
							<?php echo $this->Form->control('to', [
								'class' => 'form-control form-control-sm datepicker-here border-0',
								'label' => 'Posted To',
								'id' => 'to',
								'type' => 'Text',
								'data-language' => 'en',
								'data-date-format' => 'Y-m-d',
								'empty' => 'empty',
								'required' => false,
								'autocomplete' => 'off'
							]); ?>
						</div>
					</div>


				</fieldset>
				<div class="text-end">
					<?php
					if (!empty($_isSearch)) {
						echo ' ';
						echo $this->Html->link(__('Reset'), ['action' => 'index', '?' => array_intersect_key($this->request->getQuery(), array_flip(['sort', 'direction']))], ['class' => 'btn btn-outline-warning btn-sm']);
					}
					echo '&nbsp;&nbsp;';
					echo $this->Form->button(__('Search'), ['class' => 'btn btn-outline-primary btn-sm']);
					?>
					<?= $this->Form->end() ?>
				</div>
			</div>
		</div>



	</div>
</div>



<script type="text/javascript">
	$('#from').datetimepicker({
		lang: 'en',
		timepicker: false,
		format: 'Y-m-d',
		formatDate: 'Y/m/d',
		//minDate:'-1970/01/01', // yesterday is minimum date
		//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
	});

	$('#to').datetimepicker({
		lang: 'en',
		timepicker: false,
		format: 'Y-m-d',
		formatDate: 'Y/m/d',
		//minDate:'-1970/01/01', // yesterday is minimum date
		//maxDate:'+1970/01/02' // and tommorow is maximum date calendar
	});
</script>



<div class="modal" id="bootstrapModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirm</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body text-center">
				<i class="fa-regular fa-circle-xmark fa-6x text-danger mb-3"></i>
				<p id="confirmMessage"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" id="ok">OK</button>
			</div>
		</div>
	</div>
</div>