<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Booking $booking
 * @var \Cake\Collection\CollectionInterface|string[] $users
 * @var \Cake\Collection\CollectionInterface|string[] $rooms
 * @var \Cake\Collection\CollectionInterface|string[] $subjects
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
            <?= $this->Html->link(__('List Bookings'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($booking) ?>
           <fieldset>
               <div class="row">
                    <div class="col-md-3">
                          <?php echo $this->Form->control('name'); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('user_id', ['options' => [
                        '1' => 'Students',
                        '2' => 'Lecturer',
                        '3' => 'UiTM Staff',
                    ],
                    'option'=>$users,
                    'empty'=>'User Input',
                    'class'=>'form-select',
                    'label'=>'Select User '
                    ]); ?>
                    </div>
                    <div class="col-md-3">
                        <?php echo $this->Form->control('room_id', [
                                'options' => $rooms,
                                'label' => 'Select Room',
                                'class' => 'form-select',
                                'empty' => 'Choose a Room'
                            ]);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php
                       echo $this->Form->control('subject_id', [
                            'options' => $subjects,
                            'label' => 'Select Subject',
                            'class' => 'form-select',
                            'empty' => 'Choose a subject'
                        ]);

                        ?>
                    </div>
                </div>

                    <div class="row">
                        <div class="col-md-3">
                            <?php echo $this->Form->control('start_time'); ?>
                        </div>
                        <div class="col-md-3">
                            <?php echo $this->Form->control('end_time'); ?>
                        </div>
                        <div class="col-md-3">
                        <?= $this->Form->control('approval_status', [
                            'options' => [
                                '1' => 'Pending',
                                '2' => 'Approve',
                                '3' => 'Decline',
                            ],
                            'label' => 'Approval',
                            'class' => 'form-select'
                        ]); ?>
                        </div>
                        <div class="col-md-3">
                        <?= $this->Form->control('status', [
                            'options' => [
                                '1' => 'Active',
                                '2' => 'Inactive',
                            ],
                            'label' => 'Status',
                            'class' => 'form-select'
                        ]); ?>
                        </div>
                    </div>
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
                </div>
        <?= $this->Form->end() ?>
    </div>
</div>