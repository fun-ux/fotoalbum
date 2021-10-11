
    <main class="main">
        <div class="container">
            <!-- File: templates/Foto/index.php -->

            <h1>Foto's</h1>
            <?= $this->Html->link('Nieuw foto', ['action' => 'nieuw'], ['class' => 'button', 'style' => 'background-color:#2f85ae;border: 0.1rem solid #2f85ae;']) ?>
            <?= $this->Html->link(__('Logout'), ['action' => '../account/logout'], ['class' => 'button float-right']) ?>

            <table>
                <tr>
                    <th>Title</th>
                    <th>Omschrijving</th>
                    <th>categorie</th>
                    <th>Afbeelding</th>
                    <th></th>
                    
                 </tr>

                <!-- Here is where we iterate through our $foto query object, printing out article info -->

                <?php foreach ($query as $foto_): ?>
                <tr>
                    <td>
                        <?= $this->Html->link($foto_->titel, ['action' => 'bekijk', $foto_->titel]) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($foto_->omschrijving, ['action' => '#']) ?>
                    </td>
                    <td>
                        <?= $this->Html->link($foto_->categorie->titel, ['action' => '#']) ?>
                    </td>
                    <td>
                        
                        <?= $this->Html->image('/img/foto/afbeelding/' . $foto_->get('path') . '/portrait_' . $foto_->get('afbeelding'), [
                            "alt" => "...",
                             
                        ])?>
                    </td>
                    <td>
                        <?= $this->Html->link('bewerk', ['action' => 'bewerk', $foto_->id]) ?> |
                        <?= $this->Form->postLink(
                            'verwijder',
                            ['action' => 'verwijder', $foto_->id],
                            ['confirm' => 'Weet je zeker?'])
                        ?>
                    </td>
                    

                     
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </main>
     
    <?php
       /* echo "<pre>";
        print_r($query);
        echo "</pre>";*/
    ?>