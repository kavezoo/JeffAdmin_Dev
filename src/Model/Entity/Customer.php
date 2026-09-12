<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Customer Entity
 *
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property string $address
 * @property string|null $phone
 * @property bool|null $visible
 * @property int|null $pos
 * @property int|null $order_count
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\City $city
 * @property \App\Model\Entity\Order[] $orders
 */
class Customer extends Entity
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
        'city_id' => true,
        'name' => true,
        'address' => true,
        'phone' => true,
        'visible' => true,
        'pos' => true,
        'order_count' => true,
        'created' => true,
        'modified' => true,
        'city' => true,
        'orders' => true,
    ];
}
