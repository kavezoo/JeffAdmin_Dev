<?php
/**
 * Lista — megjelenítési kapcsolók ($show, plugin config + helyi felülírás)
 * rowCheckbox, rowId, name, visible, pos, created, modified, counts,
 * viewButton, editButton, deleteButton, rowDblClick
 *
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\OrdersItem> $ordersItems
 * @var string|null $lastRecordId
 * @var int|null $lastRecordPage
 */

use Cake\Core\Configure;
use Cake\Utility\Inflector;

$show = Configure::read('JeffAdmin');
$showLocal = [];

$showLocal['index'] = [
//    'rowCheckbox'     => false,
//    'rowId'           => false,
//    'name'            => false,
//    'visible'         => false,
//    'pos'             => false,
//    'created'         => false,
//    'modified'        => false,
//    'counts'          => false,
//    'viewButton'      => false,
//    'editButton'      => false,
//    'deleteButton'    => false,
//    'rowDblClick'     => 'view',   // 'edit' | 'view' | 'none'
];

$show = array_merge($show['index'] ?? [], $showLocal['index']);

$rowDblClick = $show['rowDblClick'] ?? 'edit';
if (!in_array($rowDblClick, ['edit', 'view'], true)) {
    $rowDblClick = 'none';
}

$listPage = max(1, (int)$this->request->getQuery('page', 1));

$countColumns = [];
if (!empty($show['counts'])) {
    foreach ($ordersItems as $ordersItem) {
        foreach (array_keys($ordersItem->toArray()) as $field) {
            if (str_ends_with($field, '_count')) {
                $countColumns[$field] = Inflector::humanize(substr($field, 0, -6)) . ' count';
            }
        }
        break;
    }
}

$tableAttrs = '';
if (!empty($show['rowCheckbox'])) {
    $tableAttrs .= ' data-table-select';
}
if ($rowDblClick !== 'none') {
    $tableAttrs .= ' data-row-dblclick="' . h($rowDblClick) . '"';
}
?>
              <div class="row row-tight" style="margin-top: 16px;">
                <div class="col-md-12">
                  <div class="card shadow" aria-labelledby="ordersItems-title">
                    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                      <div>
                        <strong id="ordersItems-title"><?= __('Orders Items') ?></strong>
                        <small class="d-block"><?= __('All orders items') ?></small>
                      </div>
                      <div class="table-data__tool-right">
                        <?= $this->Html->link(
                            $this->Icon->outline('plus') . ' ' . __('Add new orders item'),
                            ['action' => 'add'],
                            ['class' => 'btn btn-success', 'escape' => false]
                        ) ?>
                      </div>
                    </div>

                    <div class="card-body p-0 pt-2">
                      <div class="table-responsive text-nowrap">
                        <table class="table table-data2 table-border table-hover table-striped table-custom-hover mb-0"<?= $tableAttrs ?>>
                          <thead>
                            <tr>
<?php if (!empty($show['rowCheckbox'])) : ?>
                              <th class="select-col">
                                <label class="au-checkbox">
                                  <input type="checkbox" data-select-all aria-label="<?= h(__('Select all')) ?>">
                                  <span class="au-checkmark"></span>
                                </label>
                              </th>
<?php endif; ?>
<?php if (!empty($show['rowId'])) : ?>
                              <th class="integer id-col"><?= $this->Paginator->sort('id') ?></th>
<?php endif; ?>
<?php /*
*/ ?>
                              <th class="string"><?= $this->Paginator->sort('order_id', __('Order')) ?></th>
<?php /*
*/ ?>
                              <th class="string"><?= $this->Paginator->sort('item_id', __('Item')) ?></th>
<?php /*
*/ ?>
                              <th class="string"><?= $this->Paginator->sort('comment') ?></th>
<?php if (!empty($show['counts'])) : ?>
<?php     foreach ($countColumns as $countKey => $countLabel) : ?>
                              <th class="count"><?= $this->Paginator->sort($countKey, $countLabel) ?></th>
<?php     endforeach; ?>
<?php endif; ?>
<?php if (!empty($show['visible'])) : ?>
                              <th class="boolean"><?= $this->Paginator->sort('visible') ?></th>
<?php endif; ?>
<?php if (!empty($show['pos'])) : ?>
                              <th class="integer pos"><?= $this->Paginator->sort('pos') ?></th>
<?php endif; ?>
<?php if (!empty($show['created']) || !empty($show['modified'])) : ?>
                              <th class="datetime-meta">
<?php     if (!empty($show['created'])) : ?>
                                <?= $this->Paginator->sort('created') ?>
<?php     endif; ?>
<?php     if (!empty($show['created']) && !empty($show['modified'])) : ?>
                                <br>
<?php     endif; ?>
<?php     if (!empty($show['modified'])) : ?>
                                <?= $this->Paginator->sort('modified') ?>
<?php     endif; ?>
                              </th>
<?php endif; ?>
<?php if (!empty($show['viewButton']) || !empty($show['editButton']) || !empty($show['deleteButton'])) : ?>
                              <th class="action"><?= __('Actions') ?></th>
<?php endif; ?>
                            </tr>
                          </thead>
                          <tbody class="table-group-divider">
<?php foreach ($ordersItems as $ordersItem) :
    $dblClickUrl = $rowDblClick === 'none'
        ? null
        : $this->Url->build([
            'action' => $rowDblClick,
            $ordersItem->id,
            '?' => ['listPage' => $listPage],
        ]);
    $rowClass = (isset($lastRecordId) && (string)$lastRecordId === (string)$ordersItem->id)
        ? ' is-last-touched'
        : '';
    $rowAttrs = ' data-id="' . h((string)$ordersItem->id) . '"'
        . ' id="row-' . h((string)$ordersItem->id) . '"';
    if ($dblClickUrl) {
        $rowAttrs .= ' data-dblclick-url="' . h($dblClickUrl) . '"';
    }
    if ($rowClass !== '') {
        $rowAttrs .= ' class="' . trim($rowClass) . '"';
    }
?>
                            <tr<?= $rowAttrs ?>>
<?php if (!empty($show['rowCheckbox'])) : ?>
                              <td class="select-col">
                                <label class="au-checkbox">
                                  <input type="checkbox" data-select-row value="<?= h((string)$ordersItem->id) ?>" aria-label="<?= h(__('Select row')) ?>">
                                  <span class="au-checkmark"></span>
                                </label>
                              </td>
<?php endif; ?>
<?php if (!empty($show['rowId'])) : ?>
                              <td class="integer id-col"><?= h((string)$ordersItem->id) ?></td>
<?php endif; ?>
<?php /*
*/ ?>
                              <td class="string">
                                <?= $ordersItem->hasValue('order')
                                    ? $this->Html->link(
                                        h((string)$ordersItem->order->id)
                                            . $this->Icon->outline('link-chain', 'record-link__icon'),
                                        ['controller' => 'Orders', 'action' => 'view', $ordersItem->order->id],
                                        [
                                            'class' => 'text-decoration-none text-dark fw-bold record-link',
                                            'escape' => false,
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-title' => __('View {0}: {1}', __('Order'), (string)$ordersItem->order->id),
                                        ]
                                    )
                                    : '' ?>
                              </td>
<?php /*
*/ ?>
                              <td class="string">
                                <?= $ordersItem->hasValue('item')
                                    ? $this->Html->link(
                                        h((string)$ordersItem->item->name)
                                            . $this->Icon->outline('link-chain', 'record-link__icon'),
                                        ['controller' => 'Items', 'action' => 'view', $ordersItem->item->id],
                                        [
                                            'class' => 'text-decoration-none text-dark fw-bold record-link',
                                            'escape' => false,
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-title' => __('View {0}: {1}', __('Item'), (string)$ordersItem->item->name),
                                        ]
                                    )
                                    : '' ?>
                              </td>
<?php /*
*/ ?>
                              <td class="string"><?= h($ordersItem->comment) ?></td>
<?php if (!empty($show['counts'])) : ?>
<?php     foreach ($countColumns as $countKey => $countLabel) :
        $countVal = $ordersItem->get($countKey) ?? 0;
        $countIsZero = ((float)$countVal) == 0.0;
?>
                              <td class="count<?= $countIsZero ? ' count--zero' : '' ?>"><?= h((string)$countVal) ?></td>
<?php     endforeach; ?>
<?php endif; ?>
<?php if (!empty($show['visible'])) : ?>
                              <td class="boolean visible"><?= $this->Icon->boolean($ordersItem->visible) ?></td>
<?php endif; ?>
<?php if (!empty($show['pos'])) : ?>
                              <td class="integer pos"><?= $ordersItem->pos === null ? '' : h((string)$ordersItem->pos) ?></td>
<?php endif; ?>
<?php if (!empty($show['created']) || !empty($show['modified'])) : ?>
                              <td class="datetime created-modified">
<?php     if (!empty($show['created'])) : ?>
                                <span class="created"><?= h($ordersItem->created) ?></span>
<?php     endif; ?>
<?php     if (!empty($show['created']) && !empty($show['modified'])) : ?>
                                <br>
<?php     endif; ?>
<?php     if (!empty($show['modified'])) : ?>
                                <span class="modified"><?= h($ordersItem->modified) ?></span>
<?php     endif; ?>
                              </td>
<?php endif; ?>
<?php if (!empty($show['viewButton']) || !empty($show['editButton']) || !empty($show['deleteButton'])) : ?>
                              <td class="action">
                                <div class="table-data-feature">
<?php     if (!empty($show['viewButton'])) : ?>
                                  <?= $this->Action->view($ordersItem->id) ?>
<?php     endif; ?>
<?php     if (!empty($show['editButton'])) : ?>
                                  <?= $this->Action->edit($ordersItem->id) ?>
<?php     endif; ?>
<?php     if (!empty($show['deleteButton'])) : ?>
                                  <?= $this->Action->delete($ordersItem->id) ?>
<?php     endif; ?>
                                </div>
                              </td>
<?php endif; ?>
                            </tr>
<?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="card-footer border-top d-flex align-items-center justify-content-between">
                      <?= $this->element('JeffAdmin.pagination') ?>
                    </div>
                  </div>
                </div>
              </div>
