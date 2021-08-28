<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reports Model
 *
 * @property \App\Model\Table\SchoolsTable&\Cake\ORM\Association\BelongsTo $Schools
 * @property \App\Model\Table\EnvironmentsTable&\Cake\ORM\Association\BelongsTo $Environments
 *
 * @method \App\Model\Entity\Report newEmptyEntity()
 * @method \App\Model\Entity\Report newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Report[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Report get($primaryKey, $options = [])
 * @method \App\Model\Entity\Report findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Report patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Report[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Report|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Report saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Report[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReportsTable extends Table
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

        $this->setTable('reports');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Schools', [
            'foreignKey' => 'school_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Environments', [
            'foreignKey' => 'environment_id',
            'joinType' => 'INNER',
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
            ->dateTime('positive_test_date')
            ->requirePresence('positive_test_date', 'create')
            ->notEmptyDateTime('positive_test_date');

        $validator
            ->scalar('guid')
            ->maxLength('guid', 100)
            ->allowEmptyString('guid');

        $validator
            ->scalar('zipcode')
            ->maxLength('zipcode', 10)
            ->allowEmptyString('zipcode');

        $validator
            ->scalar('optional_email')
            ->maxLength('optional_email', 255)
            ->allowEmptyString('optional_email');

        $validator
            ->scalar('optional_phone')
            ->maxLength('optional_phone', 15)
            ->allowEmptyString('optional_phone');

        $validator
            ->scalar('ip_address')
            ->maxLength('ip_address', 50)
            ->allowEmptyString('ip_address');

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
        $rules->add($rules->existsIn(['environment_id'], 'Environments'), ['errorField' => 'environment_id']);

        return $rules;
    }
}
