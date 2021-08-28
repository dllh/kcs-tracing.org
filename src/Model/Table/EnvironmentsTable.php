<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Environments Model
 *
 * @property \App\Model\Table\SchoolsTable&\Cake\ORM\Association\BelongsTo $Schools
 * @property \App\Model\Table\ReportsTable&\Cake\ORM\Association\HasMany $Reports
 * @property \App\Model\Table\SchoolsTable&\Cake\ORM\Association\BelongsToMany $Schools
 *
 * @method \App\Model\Entity\Environment newEmptyEntity()
 * @method \App\Model\Entity\Environment newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Environment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Environment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Environment findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Environment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Environment[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Environment|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Environment saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Environment[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Environment[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Environment[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Environment[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EnvironmentsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('environments');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER',
        ]);
        $this->hasMany('Reports', [
            'foreignKey' => 'environment_id',
        ]);
        $this->belongsToMany('Schools', [
            'foreignKey' => 'environment_id',
            'targetForeignKey' => 'school_id',
            'joinTable' => 'schools_environments',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->nonNegativeInteger('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('room')
            ->maxLength('room', 100)
            ->requirePresence('room', 'create')
            ->notEmptyString('room');

        $validator
            ->scalar('period')
            ->maxLength('period', 10)
            ->allowEmptyString('period');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['school_id'], 'Schools'), ['errorField' => 'school_id']);

        return $rules;
    }
}
