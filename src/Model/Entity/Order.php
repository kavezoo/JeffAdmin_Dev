<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Order Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property \Cake\I18n\DateTime $datetime
 * @property \Cake\I18n\Date $date
 * @property \Cake\I18n\Time $time
 * @property bool $visible
 * @property int $pos
 * @property int|null $item_count
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Customer $customer
 * @property \App\Model\Entity\Item[] $items
 */
class Order extends Entity
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
        'customer_id' => true,
        'datetime' => true,
        'date' => true,
        'time' => true,
        'visible' => true,
        'pos' => true,
        'item_count' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'items' => true,
    ];
}
