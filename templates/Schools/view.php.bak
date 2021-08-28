<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\School $school
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit School'), ['action' => 'edit', $school->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete School'), ['action' => 'delete', $school->id], ['confirm' => __('Are you sure you want to delete # {0}?', $school->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Schools'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New School'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="schools view content">
            <h3><?= h($school->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($school->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($school->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address') ?></th>
                    <td><?= h($school->address) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($school->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($school->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($school->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Environments') ?></h4>
                <?php if (!empty($school->environments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('School Id') ?></th>
                            <th><?= __('Room') ?></th>
                            <th><?= __('Period') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($school->environments as $environments) : ?>
                        <tr>
                            <td><?= h($environments->id) ?></td>
                            <td><?= h($environments->school_id) ?></td>
                            <td><?= h($environments->room) ?></td>
                            <td><?= h($environments->period) ?></td>
                            <td><?= h($environments->created) ?></td>
                            <td><?= h($environments->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Environments', 'action' => 'view', $environments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Environments', 'action' => 'edit', $environments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Environments', 'action' => 'delete', $environments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $environments->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Reports') ?></h4>
                <?php if (!empty($school->reports)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('School Id') ?></th>
                            <th><?= __('Environment Id') ?></th>
                            <th><?= __('Positive Test Date') ?></th>
                            <th><?= __('Guid') ?></th>
                            <th><?= __('Zipcode') ?></th>
                            <th><?= __('Optional Email') ?></th>
                            <th><?= __('Optional Phone') ?></th>
                            <th><?= __('Ip Address') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($school->reports as $reports) : ?>
                        <tr>
                            <td><?= h($reports->id) ?></td>
                            <td><?= h($reports->school_id) ?></td>
                            <td><?= h($reports->environment_id) ?></td>
                            <td><?= h($reports->positive_test_date) ?></td>
                            <td><?= h($reports->guid) ?></td>
                            <td><?= h($reports->zipcode) ?></td>
                            <td><?= h($reports->optional_email) ?></td>
                            <td><?= h($reports->optional_phone) ?></td>
                            <td><?= h($reports->ip_address) ?></td>
                            <td><?= h($reports->created) ?></td>
                            <td><?= h($reports->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Reports', 'action' => 'view', $reports->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Reports', 'action' => 'edit', $reports->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Reports', 'action' => 'delete', $reports->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reports->id)]) ?>
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
