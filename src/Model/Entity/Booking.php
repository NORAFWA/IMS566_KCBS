<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $room_id
 * @property \Cake\I18n\Time $start_time
 * @property \Cake\I18n\Time $end_time
 * @property int $subject_id
 * @property int $approval_status
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Room $room
 * @property \App\Model\Entity\Subject $subject
 */
class Booking extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'user_id' => true,
        'room_id' => true,
        'start_time' => true,
        'end_time' => true,
        'subject_id' => true,
        'approval_status' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'room' => true,
        'subject' => true,
    ];
}
