<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Environment $environment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Environment'), ['action' => 'edit', $environment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Environment'), ['action' => 'delete', $environment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $environment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Environments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Environment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="environments view content">
            <h3><?= h($environment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Room') ?></th>
                    <td><?= h($environment->room) ?></td>
                </tr>
                <tr>
                    <th><?= __('Period') ?></th>
                    <td><?= h($environment->period) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($environment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('School Id') ?></th>
                    <td><?= $this->Number->format($environment->school_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($environment->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($environment->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Schools') ?></h4>
                <?php if (!empty($environment->schools)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($environment->schools as $schools) : ?>
                        <tr>
                            <td><?= h($schools->id) ?></td>
                            <td><?= h($schools->name) ?></td>
                            <td><?= h($schools->phone) ?></td>
                            <td><?= h($schools->address) ?></td>
                            <td><?= h($schools->created) ?></td>
                            <td><?= h($schools->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Schools', 'action' => 'view', $schools->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Schools', 'action' => 'edit', $schools->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Schools', 'action' => 'delete', $schools->id], ['confirm' => __('Are you sure you want to delete # {0}?', $schools->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Reports') ?></h4>
                <?php if (!empty($environment->reports)) : ?>
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
                        <?php foreach ($environment->reports as $reports) : ?>
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
