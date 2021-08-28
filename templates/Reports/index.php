<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report[]|\Cake\Collection\CollectionInterface $reports
 */
?>
<div class="reports index content">
    <?= $this->Html->link(__('New Report'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Reports') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('school_id') ?></th>
                    <th><?= $this->Paginator->sort('environment_id') ?></th>
                    <th><?= $this->Paginator->sort('positive_test_date') ?></th>
                    <th><?= $this->Paginator->sort('guid') ?></th>
                    <th><?= $this->Paginator->sort('zipcode') ?></th>
                    <th><?= $this->Paginator->sort('optional_email') ?></th>
                    <th><?= $this->Paginator->sort('optional_phone') ?></th>
                    <th><?= $this->Paginator->sort('ip_address') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report): ?>
                <tr>
                    <td><?= $this->Number->format($report->id) ?></td>
                    <td><?= $report->has('school') ? $this->Html->link($report->school->name, ['controller' => 'Schools', 'action' => 'view', $report->school->id]) : '' ?></td>
                    <td><?= $report->has('environment') ? $this->Html->link($report->environment->id, ['controller' => 'Environments', 'action' => 'view', $report->environment->id]) : '' ?></td>
                    <td><?= h($report->positive_test_date) ?></td>
                    <td><?= h($report->guid) ?></td>
                    <td><?= h($report->zipcode) ?></td>
                    <td><?= h($report->optional_email) ?></td>
                    <td><?= h($report->optional_phone) ?></td>
                    <td><?= h($report->ip_address) ?></td>
                    <td><?= h($report->created) ?></td>
                    <td><?= h($report->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $report->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $report->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id)]) ?>
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
