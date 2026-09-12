<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * City Entity
 *
 * @property int $id
 * @property string $shortname
 * @property string $name
 * @property string|null $zip
 * @property string $lat
 * @property string $lng
 * @property int $club_count
 * @property int|null $user_count
 * @property bool $visible
 * @property int $pos
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Club[] $clubs
 * @property \App\Model\Entity\Competition[] $competitions
 * @property \App\Model\Entity\User[] $users
 */
class City extends Entity
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
        'shortname' => true,
        'name' => true,
        'zip' => true,
        'lat' => true,
        'lng' => true,
        'club_count' => true,
        'user_count' => true,
        'visible' => true,
        'pos' => true,
        'created' => true,
        'modified' => true,
        'clubs' => true,
        'competitions' => true,
        'users' => true,
    ];
}
