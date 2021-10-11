
<h1>Bewerk Foto</h1>
<?php
    echo $this->Form->create($foto, [
        'type' => 'file'
    ]);
    echo $this->Form->control('account_id', ['type' => 'hidden', 'value' => $account_id]);
    echo $this->Form->control('categorie_id', ['type' => 'hidden']);

    echo $this->Form->control('titel');
?>
    <div class="input text required">
        <label for="categorie-id_list">Categorie</label>
        <select id="categorie-id_list" name="categorie_id">
            <?php foreach ($categorie as $categorie_): ?>
                <option value="<?php echo $categorie_->id ?>"><?php echo $categorie_->titel ?></option>
            <?php endforeach; ?>
        </select>
<?php
    echo $this->Form->control('afbeelding', ['type' => 'file']);
    echo $this->Html->image('/img/foto/afbeelding/' . $foto->get('path') . '/square_' . $foto->get('afbeelding'), [
        "alt" => "...",
         
     ]); 

    echo $this->Form->control('omschrijving', ['rows' => '3']);
    echo $this->Form->button(__('Bewerk foto'));
    echo $this->Form->end();

     
?>

<script>
    $("#categorie-id_list").val($("#categorie-id").val());
</script>

