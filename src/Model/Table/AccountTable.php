<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Account Model
 *
 * @property \App\Model\Table\FotoTable&\Cake\ORM\Association\HasMany $Foto
 *
 * @method \App\Model\Entity\Account newEmptyEntity()
 * @method \App\Model\Entity\Account newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Account[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Account get($primaryKey, $options = [])
 * @method \App\Model\Entity\Account findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Account patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Account[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Account|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Account saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class AccountTable extends Table
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

        $this->setTable('account');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('Foto', [
            'foreignKey' => 'account_id',
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
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('gebruikersnaam')
            ->maxLength('gebruikersnaam', 255)
            ->requirePresence('gebruikersnaam', 'create')
            ->notEmptyString('gebruikersnaam')
            ->add('gebruikersnaam', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('wachtwoord')
            ->maxLength('wachtwoord', 255)
            ->requirePresence('wachtwoord', 'create')
            ->notEmptyString('wachtwoord');

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
        $rules->add($rules->isUnique(['gebruikersnaam']), ['errorField' => 'gebruikersnaam']);

        return $rules;
    }
}
