<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrdersItem $ordersItem
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Orders Item'), ['action' => 'edit', $ordersItem->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Orders Item'), ['action' => 'delete', $ordersItem->id], ['confirm' => __('Are you sure you want to delete # {0}?', $ordersItem->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Orders Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Orders Item'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="ordersItems view content">
            <h3><?= h($ordersItem->comment) ?></h3>
            <table>
                <tr>
                    <th><?= __('Order') ?></th>
                    <td><?= $ordersItem->hasValue('order') ? $this->Html->link($ordersItem->order->id, ['controller' => 'Orders', 'action' => 'view', $ordersItem->order->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Item') ?></th>
                    <td><?= $ordersItem->hasValue('item') ? $this->Html->link($ordersItem->item->name, ['controller' => 'Items', 'action' => 'view', $ordersItem->item->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Comment') ?></th>
                    <td><?= h($ordersItem->comment) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($ordersItem->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($ordersItem->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($ordersItem->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($ordersItem->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $ordersItem->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>