

<!-- File: templates/Foto/view.php -->
<?= $this->Html->image('/img/foto/afbeelding/' . $foto->get('path') . '/' . $foto->get('afbeelding'), [
                            "alt" => "...",
                             
])?>

<h3><?= h($foto->titel) ?></h3>
<h5><?= h($foto->omschrijving) ?></h5>

<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->first('<< ' . __('first')) ?>
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
        <?= $this->Paginator->last(__('last') . ' >>') ?>
    </ul>
 </div>
 