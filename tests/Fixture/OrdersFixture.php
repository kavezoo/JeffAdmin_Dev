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
                'datetime' => '2026-09-15 12:50:16',
                'date' => '2026-09-15',
                'time' => '12:50:16',
                'visible' => 1,
                'pos' => 1,
                'item_count' => 1,
                'created' => '2026-09-15 12:50:16',
                'modified' => '2026-09-15 12:50:16',
            ],
        ];
        parent::init();
    }
}
