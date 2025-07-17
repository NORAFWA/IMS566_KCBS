<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * SubjectsFixture
 */
class SubjectsFixture extends TestFixture
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
                'course_code' => 'Lorem ipsum dolor sit amet',
                'faculties' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2025-06-30 17:13:38',
                'modified' => '2025-06-30 17:13:38',
            ],
        ];
        parent::init();
    }
}
