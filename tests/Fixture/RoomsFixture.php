<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RoomsFixture
 */
class RoomsFixture extends TestFixture
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
                'room_num' => 'Lorem ipsum dolor sit amet',
                'capacity' => 1,
                'type' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2025-06-30 17:12:58',
                'modified' => '2025-06-30 17:12:58',
            ],
        ];
        parent::init();
    }
}
