<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CitiesFixture
 */
class CitiesFixture extends TestFixture
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
                'shortname' => 'Lorem ip',
                'name' => 'Lorem ipsum dolor sit amet',
                'zip' => 'Lorem ip',
                'lat' => 'Lorem ipsum dolor ',
                'lng' => 'Lorem ipsum dolor ',
                'club_count' => 1,
                'user_count' => 1,
                'visible' => 1,
                'pos' => 1,
                'created' => '2026-09-12 05:41:14',
                'modified' => '2026-09-12 05:41:14',
            ],
        ];
        parent::init();
    }
}
