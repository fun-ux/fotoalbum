<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Account $account
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
         </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="account view content">
            <h3><?= h($account->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Gebruikersnaam') ?></th>
                    <td><?= h($account->gebruikersnaam) ?></td>
                </tr>
                <tr>
                    <th><?= __('Wachtwoord') ?></th>
                    <td><?= h($account->wachtwoord) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($account->id) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Foto') ?></h4>
                <?php if (!empty($account->foto)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Account Id') ?></th>
                            <th><?= __('Categorie Id') ?></th>
                            <th><?= __('Titel') ?></th>
                            <th><?= __('Afbeelding') ?></th>
                            <th><?= __('Omschrijving') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($account->foto as $foto) : ?>
                        <tr>
                            <td><?= h($foto->id) ?></td>
                            <td><?= h($foto->account_id) ?></td>
                            <td><?= h($foto->categorie_id) ?></td>
                            <td><?= h($foto->titel) ?></td>
                            <td><?= h($foto->afbeelding) ?></td>
                            <td><?= h($foto->omschrijving) ?></td>
                            <td><?= h($foto->created) ?></td>
                            <td><?= h($foto->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Foto', 'action' => 'view', $foto->titel]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Foto', 'action' => 'bewerk', $foto->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Foto', 'action' => 'verwijder', $foto->id], ['confirm' => __('Are you sure you want to delete # {0}?', $foto->id)]) ?>
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
