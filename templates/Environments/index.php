<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Environment[]|\Cake\Collection\CollectionInterface $environments
 */
?>
<div class="environments index content">
    <?= $this->Html->link(__('New Environment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Environments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('school_id') ?></th>
                    <th><?= $this->Paginator->sort('room') ?></th>
                    <th><?= $this->Paginator->sort('period') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($environments as $environment): ?>
                <tr>
                    <td><?= $this->Number->format($environment->id) ?></td>
                    <td><?= $this->Number->format($environment->school_id) ?></td>
                    <td><?= h($environment->room) ?></td>
                    <td><?= h($environment->period) ?></td>
                    <td><?= h($environment->created) ?></td>
                    <td><?= h($environment->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $environment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $environment->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $environment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $environment->id)]) ?>
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
