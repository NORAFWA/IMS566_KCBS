<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booking Receipt</title>
    <style>
        @page {
margin: 0px !important;
padding: 0px !important;
    }
                    .top{
                    width: 100%;
                    margin: auto:
                }
                body{
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 13px;
                }
                .one{
                    width:70%;
                    height: 25px;
                    background: #292983;
                    float:left;
                }
                .two{
                    margin-left: 15%;
                    height: 25px;
                    background: #912891;
                }
                .capital{
                    text-transform: uppercase;
                }
                .justify{
                    text-align: justify;
                }
                .content{
                    margin-left: 70px;
                    margin-right: 70px:
                }
                .right{
                    text-align: right;
                    padding-right:50px;
                }
    </style>

</head>



<body>
<section class="top">
    <div class="one"></div>
    <div class="two"></div>
</section>

<div class="text-end my-4 me-3">
    <?php echo $this->Html->image('../img/surat/uitm.png',['width' => '200px', 'fullBase' =>true])?>
</div>

<hr />

<div class="content">
<table width= "320px" align ="right">
    <tr>
        <td width= "70%">Receipt :</td>
        <td>:</td>
        <td>
<?= $this->Number->format($booking->id) ?>
    </td>
    </tr>

    <tr>
        <td>Tarikh :</td>
    <td>:</td>
    <td>
    <?php if ($booking->approval_status == 1) {
    echo '-';
} elseif (!empty($booking->status)) {
    echo date('d F Y', strtotime($booking->status));
} else {
    echo 'Rejected';
}
?>
</td>
    </tr>
</table>
<strong><h2>Booking Receipt</h2></strong>
<br/>

Universiti Teknologi MARA Cawangan Selangor Kampus Puncak Perdana <br/>
No. 1, Jalan Pulau Angsa<br/>
AU 10/A, Section U10<br/>
40150 Shah Alam<br/>
Selangor.<br/>



<br/><br/>

<table>
<tr>
    <td>User ID</td>
    <td>:</td>
    <td><?= $this->Number->format($booking->id) ?></td>
</tr>
<tr>
    <td>NAME</td>
    <td>:</td>
    <td><?= h($booking->name) ?></td>
</tr>
<tr>
    <td>ROLE</td>
    <td>:</td>
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
</table>

<br/>
<div class="justify">
<h2>Booking Information</h2>
<table class="table">
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Item</th>
      <th scope="col">Details</th>
    </tr>
  </thead>
  <tbody class="table-group-divider">
    <tr>
      <th scope="row">1</th>
      <td>Room</td>
      <td>: <?php
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
                        ?>
    </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Subject</td>
      <td>: <?php
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
                        ?>
    </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Booking Date</td>
      <td>: <?= h($booking->created->format('d/m/y')) ?></td>
    </tr>
        <tr>
      <th scope="row">4</th>
      <td>Start Time</td>
      <td>: <?= h($booking->start_time) ?></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td>End Time</td>
      <td>: <?= h($booking->end_time) ?></td>
    </tr>
  </tbody>
</table>
<hr/>
<br/>
<div class="right">
    <?php echo $this->Html->image('../img/surat/uitm_dihatiku.png',['width' => '250px', 'fullBase' =>true])?>
</div>
<br/><br/>
<?php if ($booking->approval_status == 1){
    echo'<strong class ="test-danger">[Under Review]</strong>';
}elseif ($booking->approval_status == 2){
    echo'Jabatan Pengurusan ICT <br/>';
    echo'Universiti Teknologi MARA <br/>';
    echo'<strong>CETAKAN BERKOMPUTER. TIDAK PERLU TANDA TANGAN</strong>';
} else 
echo 'Rejected';
?>
</div>
<div class="right">
Status : <?php if ($booking->approval_status ==1){
							echo '<span class="badge text-bg-secondary">Pending</span>';
						}elseif ($booking-> approval_status == 2){
							echo '<span class="badge text-bg-success">Approve</span>';
						}elseif ($booking-> approval_status == 3){
							echo '<span class="badge text-bg-danger">Decline</span>';
						}else 
						echo'<span class="badge text-bg-dark">Error</span>';
						?>
</div>
</div>
	</div>
		</div>

</body>
</html>