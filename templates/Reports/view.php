<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Report $report
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Report'), ['action' => 'edit', $report->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Report'), ['action' => 'delete', $report->id], ['confirm' => __('Are you sure you want to delete # {0}?', $report->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Reports'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Report'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="reports view content">
            <h3><?= h($report->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('School') ?></th>
                    <td><?= $report->has('school') ? $this->Html->link($report->school->name, ['controller' => 'Schools', 'action' => 'view', $report->school->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Environment') ?></th>
                    <td><?= $report->has('environment') ? $this->Html->link($report->environment->id, ['controller' => 'Environments', 'action' => 'view', $report->environment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Guid') ?></th>
                    <td><?= h($report->guid) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zipcode') ?></th>
                    <td><?= h($report->zipcode) ?></td>
                </tr>
                <tr>
                    <th><?= __('Optional Email') ?></th>
                    <td><?= h($report->optional_email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Optional Phone') ?></th>
                    <td><?= h($report->optional_phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Ip Address') ?></th>
                    <td><?= h($report->ip_address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($report->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Positive Test Date') ?></th>
                    <td><?= h($report->positive_test_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($report->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($report->modified) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
