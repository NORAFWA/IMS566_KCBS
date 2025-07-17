<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BookingsFixture
 */
class BookingsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'name' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
                'room_id' => 1,
                'start_time' => '17:45:29',
                'end_time' => '17:45:29',
                'subject_id' => 1,
                'approval_status' => 1,
                'status' => 1,
                'created' => '2025-06-30 17:45:29',
                'modified' => '2025-06-30 17:45:29',
            ],
        ];
        parent::init();
    }
}
