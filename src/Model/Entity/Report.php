<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Report Entity
 *
 * @property int $id
 * @property int $school_id
 * @property int $environment_id
 * @property \Cake\I18n\FrozenTime $positive_test_date
 * @property string|null $guid
 * @property string|null $zipcode
 * @property string|null $optional_email
 * @property string|null $optional_phone
 * @property string|null $ip_address
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\School $school
 * @property \App\Model\Entity\Environment $environment
 */
class Report extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'school_id' => true,
        'environment_id' => true,
        'positive_test_date' => true,
        'guid' => true,
        'zipcode' => true,
        'optional_email' => true,
        'optional_phone' => true,
        'ip_address' => true,
        'created' => true,
        'modified' => true,
        'school' => true,
        'environment' => true,
    ];
}
