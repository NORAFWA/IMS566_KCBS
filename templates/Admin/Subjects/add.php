<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Subject $subject
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
            <?= $this->Html->link(__('List Subjects'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($subject) ?>
            <fieldset>
                <legend><?= __('Add Subject') ?></legend>
                
                    <?php echo $this->Form->control('course_code', ['options' => 
					[
                            '1' => 'CDIM260-Information in Library Science',
                            '2' => 'CDIM262-Information in Record Management',
                            '3' => 'CDIM263-Introduction in Information System',
                            '4' => 'CDIM264-Introduction in Content Management',
                            '5' => 'FF232-Bachelor of Writing (Hons.) Screenwriting',
                            '6' => 'FF233-Bachelor of Writing (Hons.) Creative Writing',
                            '7' => 'FF234-Bachelor of Theatre (Hons.) Theatre Production',
                            '8' => 'FF235-Bachelor of Theatre (Hons.) Scenography',
                            '9' => 'FF236-Bachelor of Creative Industry Management (Hons.) Arts Management',
                            '10' => 'FF237-Bachelor of Creative Industry Management (Hons.) Film Production',
                    ],
                    'empty'=>'Type of course code',
                    'class'=>'form-select',
                    'label'=>'Select code '
                    ]); ?>
                    <?php echo $this->Form->control('faculties', ['options' => 
					[
                        '1' => 'Information Management',
                        '2' => 'Film, Theatre & Animation',
                    ],
                    'empty'=>'Type of Faculties',
                    'class'=>'form-select',
                    'label'=>'Select Faculty  '
                    ]); ?>
                    <?php echo $this->Form->control('status', ['options' => [
                        '1' => 'Active',
                        '2' => 'Pending',
                        '3' => 'Deactive',
                    ],
                    'empty'=>'Status',
                    'class'=>'form-select',
                    'label'=>'Select Status'
                    ]); ?>
               
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
                </div>
        <?= $this->Form->end() ?>
    </div>
</div>