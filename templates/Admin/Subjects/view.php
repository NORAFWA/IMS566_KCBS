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
							<li><?= $this->Html->link(__('Edit Subject'), ['action' => 'edit', $subject->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Subject'), ['action' => 'delete', $subject->id], ['confirm' => __('Are you sure you want to delete # {0}?', $subject->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Subjects'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Subject'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
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
            <h3>Subject Details</h3>
    <div class="table-responsive">
        <table class="table">
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($subject->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Course Code') ?></th>
                    <?php
						$courseCode = [
							'1' => 'CDIM260 - Information in Library Science',
                            '2' => 'CDIM262 - Information in Record Management',
                            '3' => 'CDIM263 - Introduction in Information System',
                            '4' => 'CDIM264 - Introduction in Content Management',
                            '5' => 'FF232 - Bachelor of Writing (Hons.) Screenwriting',
                            '6' => 'FF233 - Bachelor of Writing (Hons.) Creative Writing',
                            '7' => 'FF234 - Bachelor of Theatre (Hons.) Theatre Production',
                            '8' => 'FF235 - Bachelor of Theatre (Hons.) Scenography',
                            '9' => 'FF236 - Bachelor of Creative Industry Management (Hons.) Arts Management',
                            '10' => 'FF237 - Bachelor of Creative Industry Management (Hons.) Film Production',
						];
					?>
                   <td><?= isset($courseCode[$subject->course_code]) ? h($courseCode[$subject->course_code]) : '' ?></td>
                </tr>

                <tr>
                    <th><?= __('Faculties') ?></th>
                    <?php
						$fType = [
							1 => 'Information Management',
                            2 => 'Film, Theatre & Animation',
						];
					?>
                    <td><?= isset($fType[$subject->faculties]) ? h($fType[$subject->faculties]) : '' ?></td>
                </tr>
              
                <tr>
                    <th><?= __('Status') ?></th>
                    <td>
						<?php if ($subject->status ==1){
							echo '<span class="badge text-bg-success">Active</span>';
						}elseif ($subject-> status == 2){
							echo '<span class="badge text-bg-secondary">Inactive</span>';
						}elseif ($subject-> status == 3){
							echo '<span class="badge text-bg-danger">Inactive</span>';
						}else 
						echo'<span class="badge text-bg-dark">Error</span>';
						?>
					</td>
                </tr>

                <tr>
                    <th><?= __('Created') ?></th>
                   <td><?= h($subject->created->format('d/m/y')) ?></td>
                </tr>
            </table>
            </div>

			</div>
		</div>
		

            
            

            <div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
            <div class="card-body text-body-secondary">
                <h4><?= __('Related Bookings') ?></h4>
                <?php if (!empty($subject->bookings)) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Room Id') ?></th>
                            <th><?= __('Start Time') ?></th>
                            <th><?= __('End Time') ?></th>
                            <th><?= __('Subject Id') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($subject->bookings as $bookings) : ?>
                        <tr>
                            <td><?= h($bookings->id) ?></td>
                            <td><?= h($bookings->name) ?></td>
                            <td><?= h($bookings->user_id) ?></td>
                            <td><?= h($bookings->room_id) ?></td>
                            <td><?= h($bookings->start_time) ?></td>
                            <td><?= h($bookings->end_time) ?></td>
                            <td><?= h($bookings->subject_id) ?></td>
                            <td><?= h($bookings->status) ?></td>
                            <td><?= h($bookings->created) ?></td>
                            <td><?= h($bookings->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Bookings', 'action' => 'view', $bookings->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Bookings', 'action' => 'edit', $bookings->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Bookings', 'action' => 'delete', $bookings->id], ['confirm' => __('Are you sure you want to delete # {0}?', $bookings->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
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




