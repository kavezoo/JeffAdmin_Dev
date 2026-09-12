<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit City'), ['action' => 'edit', $city->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete City'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New City'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="cities view content">
            <h3><?= h($city->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Shortname') ?></th>
                    <td><?= h($city->shortname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($city->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip') ?></th>
                    <td><?= h($city->zip) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lat') ?></th>
                    <td><?= h($city->lat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lng') ?></th>
                    <td><?= h($city->lng) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($city->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Club Count') ?></th>
                    <td><?= $this->Number->format($city->club_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Count') ?></th>
                    <td><?= $city->user_count === null ? '' : $this->Number->format($city->user_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($city->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($city->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($city->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $city->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Customers') ?></h4>
                <?php if (!empty($city->customers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Order Count') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($city->customers as $customer) : ?>
                        <tr>
                            <td><?= h($customer->id) ?></td>
                            <td><?= h($customer->name) ?></td>
                            <td><?= h($customer->address) ?></td>
                            <td><?= h($customer->phone) ?></td>
                            <td><?= h($customer->visible) ?></td>
                            <td><?= h($customer->pos) ?></td>
                            <td><?= h($customer->order_count) ?></td>
                            <td><?= h($customer->created) ?></td>
                            <td><?= h($customer->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Customers', 'action' => 'view', $customer->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Customers', 'action' => 'edit', $customer->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Customers', 'action' => 'delete', $customer->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $customer->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>