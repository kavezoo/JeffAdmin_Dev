<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrdersItem> $ordersItems
 */
?>
<div class="ordersItems index content">
    <?= $this->Html->link(__('New Orders Item'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Orders Items') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('order_id') ?></th>
                    <th><?= $this->Paginator->sort('item_id') ?></th>
                    <th><?= $this->Paginator->sort('comment') ?></th>
                    <th><?= $this->Paginator->sort('visible') ?></th>
                    <th><?= $this->Paginator->sort('pos') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ordersItems as $ordersItem): ?>
                <tr>
                    <td><?= $this->Number->format($ordersItem->id) ?></td>
                    <td><?= $ordersItem->hasValue('order') ? $this->Html->link($ordersItem->order->id, ['controller' => 'Orders', 'action' => 'view', $ordersItem->order->id]) : '' ?></td>
                    <td><?= $ordersItem->hasValue('item') ? $this->Html->link($ordersItem->item->name, ['controller' => 'Items', 'action' => 'view', $ordersItem->item->id]) : '' ?></td>
                    <td><?= h($ordersItem->comment) ?></td>
                    <td><?= h($ordersItem->visible) ?></td>
                    <td><?= $this->Number->format($ordersItem->pos) ?></td>
                    <td><?= h($ordersItem->created) ?></td>
                    <td><?= h($ordersItem->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $ordersItem->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $ordersItem->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $ordersItem->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $ordersItem->id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>