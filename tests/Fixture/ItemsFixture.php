<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ItemsFixture
 */
class ItemsFixture extends TestFixture
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
                'unit' => 'Lorem ip',
                'price' => 1,
                'vat' => 1.5,
                'visible' => 1,
                'pos' => 1,
                'order_count' => 1,
                'created' => '2026-09-15 12:50:16',
                'modified' => '2026-09-15 12:50:16',
            ],
        ];
        parent::init();
    }
}
