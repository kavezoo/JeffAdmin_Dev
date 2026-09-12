<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\OrdersItem $ordersItem
 * @var \Cake\Collection\CollectionInterface|string[] $orders
 * @var \Cake\Collection\CollectionInterface|string[] $items
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Orders Items'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="ordersItems form content">
            <?= $this->Form->create($ordersItem) ?>
            <fieldset>
                <legend><?= __('Add Orders Item') ?></legend>
                <?php
                    echo $this->Form->control('order_id', ['options' => $orders]);
                    echo $this->Form->control('item_id', ['options' => $items]);
                    echo $this->Form->control('comment');
                    echo $this->Form->control('visible');
                    echo $this->Form->control('pos');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
