<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Room $room
 */
?>
<!--Header-->
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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $room->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $room->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
            ) ?>
            <?= $this->Html->link(__('List Rooms'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($room) ?>
            <fieldset>
                <legend><?= __('Edit Room') ?></legend>

            <div class="row">
                <div class="col-md-6">
                <?php echo $this->Form->control('room_num', ['options' => [
                        '1' => 'Bilik Kuliah 1',
                        '2' => 'Bilik Kuliah 2',
                        '3' => 'Bilik Kuliah 3',
                        '4' => 'Bilik Kuliah 4',
                        '5' => 'Bilik Kuliah 5',
                        '6' => 'Makmal Komputer 1',
                        '7' => 'Makmal Komputer 2',
                        '8' => 'Makmal Komputer 3',
                        '9' => 'Makmal Komputer 4',
                        '10' => 'Makmal Komputer 5',
                        '11' => 'Dewan Seminar 1',
                        '12' => 'Dewan Seminar 2',
                    ],
                    'empty'=>'Select Room',
                    'class'=>'form-select',
                    'label'=>'Select Room'
                    ]); ?>
                </div>
                <div class="col-md-6">
                    <?php echo $this->Form->control('type', ['options' => [
                        '1' => 'Bilik Kuliah',
                        '2' => 'Makmal Komputer',
                        '3' => 'Dewan Seminar',
                    ],
                    'empty'=>'Type of Room',
                    'class'=>'form-select',
                    'label'=>'Select type '
                    ]); ?>
                </div>
           </div>
                    <div class="row">
                <div class="col-md-6">
                    <?php echo $this->Form->control('capacity', [
                        'type' => 'number',
                        'min' => 1,
                        'max' => 500,
                        'label' => 'Capacity (1-500)',
                        'required' => true
                    ]);
                    ?>
                </div>   
                <div class="col-md-6">
                    <?php echo $this->Form->control('status', ['options' => [
                        '1' => 'Active',
                        '2' => 'Pending',
                        '3' => 'Deactive',
                    ],
                    'empty'=>'Status',
                    'class'=>'form-select',
                    'label'=>'Select Status'
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