<?php
/**
 * Lista — megjelenítési kapcsolók
 * $showRowCheckbox: true = kijelölő oszlop (első cella)
 * $showRowId: true = ID oszlop; false = rejtve (data-id a soron marad)
 * $showVisible: true = Látható (szem) oszlop
 * $showCreated: true = Létrehozva külön oszlop
 * $showModified: true = Módosítva külön oszlop
 * $showCreatedModified: true = Létrehozva + Módosítva egy oszlopban (két sor)
 * $showCounts: true = gyerekrekord-szám oszlopok (*_count mezők, a Látható előtt)
 * $countLabels: opcionális feliratok a *_count mezőkhöz (kulcs = mezőnév)
 * $priceCurrency: pénznem az ár oszlopban (pl. Ft); üres = nincs jelzés
 */
$showRowCheckbox = true;
$showRowId = true;
$showVisible = true;
$showCreated = false;
$showModified = false;
$showCreatedModified = true;
$showCounts = true;

$show = [
	'checkbox' => false,
	'id' => false,
	'visible' => false,
	'pos' =>false,
	'created' =>false,
	'modified' =>false,
	'counts' =>false,
];

$countColumns = [];
if ($showCounts) {
	foreach ($customers as $customer) {
		$countColumns = array_values(array_filter(
			array_keys($customer->toArray()),
			fn($field) => str_ends_with($field, '_count')
		));
		break;
	}
}
?>
						  <div class="row row-tight" style="margin-top: 16px;">
                            <div class="col-md-12">
                                <div class="card shadow" aria-labelledby="orders-title">
                                    <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                                        <div>
                                            <strong id="orders-title">Orders</strong>
                                            <small class="d-block">All orders, with inline actions.</small>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <button type="button" class="btn btn-success">
                                            <i class="fa-solid fa-plus" aria-hidden="true"></i> Add item
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body p-0 pt-2">
                                    <div class="table-responsive text-nowrap">
                                        <table class="table table-data2 table-border table-hover table-striped table-custom-hover mb-0"<?= $showRowCheckbox ? ' data-table-select' : '' ?>>
                                            <thead>
                                                <tr>
<?php if ($showRowCheckbox) : ?>
                                                    <th class="select-col"><label class="au-checkbox"><input type="checkbox" data-select-all aria-label="Összes kijelölése"><span class="au-checkmark"></span></label></th>
<?php endif; ?>
<?php if ($showRowId) : ?>
                                                    <th class="integer id-col"><a href="#">ID</a></th>
<?php endif; ?>
                                                    <th class="string"><a href="#">Category</a></th>
                                                    <th class="string"><a href="#" class="asc">Name</a></th>
                                                    <th class="email"><a href="#">Email</a></th>
                                                    <th class="string"><a href="#">Description</a></th>
                                                    <th class="datetime"><a href="#">DateTime</a></th>
                                                    <th class="date"><a href="#">Date</a></th>
                                                    <th class="time"><a href="#">Time</a></th>
                                                    <th class="integer"><a href="#">Integer</a></th>
                                                    <th class="string"><a href="#">Status</a></th>
                                                    <th class="number"><a href="#">Price</a></th>
<?php foreach ($countColumns as $countKey => $countLabel) : ?>
                                                    <th class="count"><a href="#"><?= htmlspecialchars($countLabel, ENT_QUOTES, 'UTF-8') ?></a></th>
<?php endforeach; ?>
<?php if ($showVisible) : ?>
                                                    <th class="boolean"><a href="#">Látható</a></th>
<?php endif; ?>
<?php if ($showCreated) : ?>
                                                    <th class="datetime"><a href="#">Létrehozva</a></th>
<?php endif; ?>
<?php if ($showModified) : ?>
                                                    <th class="datetime"><a href="#">Módosítva</a></th>
<?php endif; ?>
<?php if ($showCreatedModified) : ?>
                                                    <th class="datetime-meta"><a href="#">Létrehozva</a><br><a href="#" class="asc">Módosítva</a></th>
<?php endif; ?>
                                                    <th class="action text-center pe-3" style="width: 1px;">Action</th>
                                                </tr>
                                            </thead>
											<tbody class="table-group-divider">
                                                <?php foreach ($customers as $customer): dd($customer); ?>
                                                <tr data-id="<?= $rid ?>" id="row-<?= $rid ?>">
<?php if ($showRowCheckbox) : ?>
                                                    <td class="select-col"><label class="au-checkbox"><input type="checkbox" data-select-row value="<?= $rid ?>" aria-label="Sor kijelölése"><span class="au-checkmark"></span></label></td>
<?php endif; ?>
<?php if ($showRowId) : ?>
                                                    <td class="integer id-col"><?= $rid ?></td>
<?php endif; ?>
                                                    <td class="string"><a href="#" class="text-decoration-none text-dark fw-bold record-link" data-bs-toggle="tooltip" title="<?= $cat ?> rekord megtekintése"><?= $cat ?> <?= $this->Icon->outline('link-chain', 'record-link__icon') ?></a></td>
                                                    <td class="string"><?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td class="email"><a href="mailto:<?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?>" class="text-decoration-none text-dark fw-bold record-link"><?= htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') ?> <?= $this->Icon->outline('mail', 'record-link__icon') ?></a></td>
                                                    <td class="string"><?= htmlspecialchars($row['description'], ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td class="datetime"><?= htmlspecialchars($row['datetime'], ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td class="date"><?= htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td class="time"><?= htmlspecialchars($row['time'], ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td class="integer"><?= htmlspecialchars($row['integer'], ENT_QUOTES, 'UTF-8') ?></td>
                                                    <td class="string"><span class="<?= $statusClass ?>"><?= htmlspecialchars($row['status_label'], ENT_QUOTES, 'UTF-8') ?></span></td>
                                                    <td class="number"><?= htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8') ?><?php if ($priceCurrency !== '') : ?> <span class="currency"><?= htmlspecialchars($priceCurrency, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?></td>
<?php foreach ($countColumns as $countKey => $countLabel) :
                                                        $countVal = $row[$countKey] ?? 0;
                                                        $countIsZero = ((float) str_replace([' ', ','], ['', '.'], (string) $countVal)) == 0.0;
?>
                                                    <td class="count<?= $countIsZero ? ' count--zero' : '' ?>"><?= htmlspecialchars((string) $countVal, ENT_QUOTES, 'UTF-8') ?></td>
<?php endforeach; ?>
<?php if ($showVisible) : ?>
                                                    <td class="boolean"><?php if ($row['visible']) : ?><i class="fa-regular fa-eye boolean-icon boolean-icon--yes" title="Látható" aria-label="Látható"></i><?php else : ?><i class="fa-regular fa-eye-slash boolean-icon boolean-icon--no" title="Nem látható" aria-label="Nem látható"></i><?php endif; ?></td>
<?php endif; ?>
<?php if ($showCreated) : ?>
                                                    <td class="datetime"><?= htmlspecialchars($row['created'], ENT_QUOTES, 'UTF-8') ?></td>
<?php endif; ?>
<?php if ($showModified) : ?>
                                                    <td class="datetime"><?= htmlspecialchars($row['modified'], ENT_QUOTES, 'UTF-8') ?></td>
<?php endif; ?>
<?php if ($showCreatedModified) : ?>
                                                    <td class="datetime-meta"><?= htmlspecialchars($row['created'], ENT_QUOTES, 'UTF-8') ?><br><?= htmlspecialchars($row['modified'], ENT_QUOTES, 'UTF-8') ?></td>
<?php endif; ?>
                                                    <td class="action text-center pe-3">
                                                        <div class="table-data-feature">
                                                            <button class="item" type="button" data-bs-toggle="tooltip" title="View"><i class="fa-regular fa-eye"></i></button>
                                                            <button class="item" type="button" data-bs-toggle="tooltip" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                                                            <button class="item delete" type="button" data-bs-toggle="tooltip" title="Delete"><i class="fa-regular fa-trash-can text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>

                                    <div class="card-footer border-top d-flex align-items-center justify-content-between">
										<?= $this->element("JeffAdmin-paginator") ?>
                                    </div>
                                </div>
                            </div>
                        </div>




















<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Customer> $customers
 */
 /*
?>
<div class="customers index content">
    <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Customers') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('city_id') ?></th>
                    <th><?= $this->Paginator->sort('name') ?></th>
                    <th><?= $this->Paginator->sort('address') ?></th>
                    <th><?= $this->Paginator->sort('phone') ?></th>
                    <th><?= $this->Paginator->sort('visible') ?></th>
                    <th><?= $this->Paginator->sort('pos') ?></th>
                    <th><?= $this->Paginator->sort('order_count') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $this->Number->format($customer->id) ?></td>
                    <td><?= $customer->hasValue('city') ? $this->Html->link($customer->city->name, ['controller' => 'Cities', 'action' => 'view', $customer->city->id]) : '' ?></td>
                    <td><?= h($customer->name) ?></td>
                    <td><?= h($customer->address) ?></td>
                    <td><?= h($customer->phone) ?></td>
                    <td><?= h($customer->visible) ?></td>
                    <td><?= $customer->pos === null ? '' : $this->Number->format($customer->pos) ?></td>
                    <td><?= $customer->order_count === null ? '' : $this->Number->format($customer->order_count) ?></td>
                    <td><?= h($customer->created) ?></td>
                    <td><?= h($customer->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $customer->id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $customer->id),
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
*/
