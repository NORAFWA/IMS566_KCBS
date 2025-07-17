<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 */
?>
<!--Header-->

<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa-solid fa-bars text-primary"></i>
			</button>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
							<li><?= $this->Html->link(__('Edit Booking'), ['action' => 'edit', $booking->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Booking'), ['action' => 'delete', $booking->id], ['confirm' => __('Are you sure you want to delete # {0}?', $booking->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Bookings'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Booking'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
							</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-9">
		<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">
            <h3>View Booking</h3>
    <div class="table-responsive">
        <table class="table">
                 <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($booking->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($booking->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?php
						$userRoles = [
							1 => 'Students',
							2 => 'Lecturer',
							3 => 'UiTM Staff',
						]; ?>
						 <?php
							if ($booking->hasValue('user_id') && isset($userRoles[$booking->user_id])) {
								echo $userRoles[$booking->user_id];
							} else {
								echo 'Unknown';
							}
							?></td>
                </tr>
                <tr>
                    <th><?= __('Room') ?></th>
                    <td><?php
                        $roomNames = [
                            1 => 'Bilik Kuliah 1',
                            2 => 'Bilik Kuliah 2',
                            3 => 'Bilik Kuliah 3',
                            4 => 'Bilik Kuliah 4',
                            5 => 'Bilik Kuliah 5',
                            6 => 'Makmal Komputer 1',
                            7 => 'Makmal Komputer 2',
                            8 => 'Makmal Komputer 3',
                            9 => 'Makmal Komputer 4',
                            10 => 'Makmal Komputer 5',
                            11 => 'Dewan Seminar 1',
                            12 => 'Dewan Seminar 2',
                        ];
                        ?>

                        <?php
                        if ($booking->hasValue('room') && isset($roomNames[$booking->room->room_num])) {
                            echo h($roomNames[$booking->room->room_num]); // hanya paparkan teks
                        } else {
                            echo 'Unknown Room';
                        }
                        ?></td>
                </tr>
                <tr>
                    <th><?= __('Subject') ?></th>
                    <td><?php
						$subjectNames = [
							1 => 'CDIM260',
							2 => 'CDIM262',
							3 => 'CDIM263',
							4 => 'CDIM264',
							5 => 'FF232',
							6 => 'FF233',
							7 => 'FF234',
							8 => 'FF235',
							9 => 'FF236',
							10 => 'FF237',
						]; ?>
						<?php
                        if ($booking->hasValue('subject') && isset($subjectNames[$booking->subject_id])) {
                            echo h($subjectNames[$booking->subject_id]); // hanya teks, tiada link
                        } else {
                            echo 'Unknown Subject';
                        }
                        ?></td>
                </tr>
                <tr>
                    <th><?= __('Start Time') ?></th>
                    <td><?= h($booking->start_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('End Time') ?></th>
                    <td><?= h($booking->end_time) ?></td>
                </tr>
                <tr>
                    <th><?= __('Approval') ?></th>
                    <td>
						<?php if ($booking->approval_status ==1){
							echo '<span class="badge text-bg-secondary">Pending</span>';
						}elseif ($booking-> approval_status == 2){
							echo '<span class="badge text-bg-success">Approve</span>';
						}elseif ($booking-> approval_status == 3){
							echo '<span class="badge text-bg-danger">Decline</span>';
						}else 
						echo'<span class="badge text-bg-dark">Error</span>';
						?>
					</td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($booking->created->format('d/m/y')) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($booking->created->format('d/m/y')) ?></td>
                </tr>
            </table>
            </div>

			</div>
		</div>
		
	</div>
	<div class="col-md-3">
            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body">
                    <div class="card-title mb-0">Search</div>
                    <div class="tricolor_line"></div>
                    <?php echo $this->Form->create(null, ['valueSources' => 'query', 'url' => ['controller' => 'Rooms','action' => 'index']]); ?>
				        <fieldset>
					    <?php echo $this->Form->control('',['required' => false]); ?>
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




