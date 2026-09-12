<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\City> $cities
 */
?>
<div class="cities index content">
    <?= $this->Html->link(__('New City'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Cities') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('shortname') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('zip') ?></th>
                    <th><?= $this->Paginator->sort('lat') ?></th>
                    <th><?= $this->Paginator->sort('lng') ?></th>
                    <th><?= $this->Paginator->sort('club_count') ?></th>
                    <th><?= $this->Paginator->sort('user_count') ?></th>
                    <th><?= $this->Paginator->sort('visible') ?></th>
                    <th><?= $this->Paginator->sort('pos') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cities as $city): ?>
                <tr>
                    <td><?= $this->Number->format($city->id) ?></td>
                    <td><?= h($city->shortname) ?></td>
                    <td><?= h($city->name) ?></td>
                    <td><?= h($city->zip) ?></td>
                    <td><?= h($city->lat) ?></td>
                    <td><?= h($city->lng) ?></td>
                    <td><?= $this->Number->format($city->club_count) ?></td>
                    <td><?= $city->user_count === null ? '' : $this->Number->format($city->user_count) ?></td>
                    <td><?= h($city->visible) ?></td>
                    <td><?= $this->Number->format($city->pos) ?></td>
                    <td><?= h($city->created) ?></td>
                    <td><?= h($city->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $city->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $city->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $city->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $city->id),
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