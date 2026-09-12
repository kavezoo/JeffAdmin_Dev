<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * OrdersItems Model
 *
 * @property \App\Model\Table\OrdersTable&\Cake\ORM\Association\BelongsTo $Orders
 * @property \App\Model\Table\ItemsTable&\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\OrdersItem newEmptyEntity()
 * @method \App\Model\Entity\OrdersItem newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\OrdersItem> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\OrdersItem get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\OrdersItem findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\OrdersItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\OrdersItem> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\OrdersItem|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\OrdersItem saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\OrdersItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrdersItem>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrdersItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrdersItem> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrdersItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrdersItem>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\OrdersItem>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\OrdersItem> deleteManyOrFail(iterable $entities, array $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class OrdersItemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('orders_items');
        $this->setDisplayField('comment');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
        $this->addBehavior('CounterCache', [
            'Orders' => ['item_count'],
            'Items' => ['order_count'],
        ]);

        $this->belongsTo('Orders', [
            'foreignKey' => 'order_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
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
            ->integer('order_id')
            ->notEmptyString('order_id');

        $validator
            ->integer('item_id')
            ->notEmptyString('item_id');

        $validator
            ->scalar('comment')
            ->maxLength('comment', 200)
            ->allowEmptyString('comment');

        $validator
            ->boolean('visible')
            ->notEmptyString('visible');

        $validator
            ->integer('pos')
            ->notEmptyString('pos');

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
        $rules->add($rules->existsIn(['order_id'], 'Orders'), ['errorField' => 'order_id']);
        $rules->add($rules->existsIn(['item_id'], 'Items'), ['errorField' => 'item_id']);

        return $rules;
    }
}
