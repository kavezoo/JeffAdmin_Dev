<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OrdersItem Entity
 *
 * @property int $id
 * @property int $order_id
 * @property int $item_id
 * @property string|null $comment
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Order $order
 * @property \App\Model\Entity\Item $item
 */
class OrdersItem extends Entity
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
        'order_id' => true,
        'item_id' => true,
        'comment' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'order' => true,
        'item' => true,
    ];
}
