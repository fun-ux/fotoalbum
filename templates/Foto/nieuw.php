
<h1>Nieuwe foto</h1>
<?php
    echo $this->Form->create($foto, [
        'type' => 'file'
    ]);
    // Hard code the user for now.
    echo $this->Form->control('account_id', ['type' => 'hidden', 'value' => $account_id]);
    
    echo $this->Form->control('titel');
?>
    <div class="input text required">
        <label for="categorie-id">Categorie</label>
        <select id="categorie-id" name="categorie_id">
            <?php foreach ($categorie as $categorie_): ?>
                <option value="<?php echo $categorie_->id ?>"><?php echo $categorie_->titel ?></option>
            <?php endforeach; ?>
        </select>
<?php
    
    //echo $this->Form->control('afbeelding');

    echo $this->Form->control('afbeelding', ['type' => 'file']);
    echo $this->Form->control('omschrijving', ['rows' => '3']);
    echo $this->Form->button(__('Bewaar foto'));
    echo $this->Form->end();

    
?>
 