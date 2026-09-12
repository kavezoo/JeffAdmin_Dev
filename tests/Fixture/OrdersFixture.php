<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OrdersFixture
 */
class OrdersFixture extends TestFixture
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
                'customer_id' => 1,
                'datetime' => '2026-09-12 05:41:15',
                'date' => '2026-09-12',
                'time' => '05:41:15',
                'visible' => 1,
                'pos' => 1,
                'item_count' => 1,
                'created' => '2026-09-12 05:41:15',
                'modified' => '2026-09-12 05:41:15',
            ],
        ];
        parent::init();
    }
}
