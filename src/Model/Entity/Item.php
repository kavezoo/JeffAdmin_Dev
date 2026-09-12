<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Item Entity
 *
 * @property int $id
 * @property string $name
 * @property string $unit
 * @property int|null $price
 * @property string $vat
 * @property bool $visible
 * @property int $pos
 * @property int|null $order_count
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Order[] $orders
 */
class Item extends Entity
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
        'unit' => true,
        'price' => true,
        'vat' => true,
        'visible' => true,
        'pos' => true,
        'order_count' => true,
        'created' => true,
        'modified' => true,
        'orders' => true,
    ];
}
