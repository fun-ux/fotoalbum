

<!-- File: templates/Foto/view.php -->
<?= $this->Html->image('/img/foto/afbeelding/' . $foto->get('path') . '/' . $foto->get('afbeelding'), [
                            "alt" => "...",
                             
])?>

<h3><?= h($foto->titel) ?></h3>
<h5><?= h($foto->omschrijving) ?></h5>

<div class="paginator">
    <ul class="pagination">
         <?= $this->Html->link(
             '< previous',
             '',
             ['class' => 'button', 'id' => 'previous' , 'style' => 'margin:5px;']
         ); ?> 
         <?= $this->Html->link(
             'next >',
             '',
             ['class' => 'button', 'id' => 'next' , 'style' => 'margin:5px;']
         ); ?>
     </ul>
 </div>
 
 <ol id="albumlist" start="0" style="display:none;">
    <?php foreach ($albumLijst as $album_):    ?>
        <?php for ($x = 0; $x <= count($album_->foto) - 1; $x++) 
        {
            if($foto->titel == $album_->foto[$x]->titel)
            {
            ?>   
                <li list-item="<?php echo $x ?>" class="<?php echo $album_->titel ?>" active><?php echo $album_->foto[$x]->titel ?></li>
            <?php 
            }
            else{?>
                <li list-item="<?php echo $x ?>" class="<?php echo $album_->titel ?>"><?php echo $album_->foto[$x]->titel ?></li>
            <?php }  ?>
            
        
            
             
        <?php 
        } 
        ?>
    <?php endforeach; ?>
<ol>


 <?php
        echo "<pre>";
        //print_r($foto);
        echo "</pre>";  
    ?>
<?php
 
       echo "<pre>";
       // print_r($albumLijst);
        echo "</pre>"; 
    ?>


<script>
        
    

    let products = [];
    var current_active;
    var previous;
    var next;

    for (var i = 1; i < $('#albumlist li').length + 1; i++) {
    
        var attr = $( "#albumlist li:nth-child("+ i +")" ).attr("active");
        
        if (typeof attr !== 'undefined' && attr !== false) {
            var item =  {
            "list-item": $( "#albumlist li:nth-child("+ i +")" ).attr('list-item'),
            "titel": $( "#albumlist li:nth-child("+ i +")" ).text(),
            "active": "active"
        };
        current_active = parseInt($( "#albumlist li:nth-child("+ i +")" ).attr('list-item'));
        }
        else{
        var item =  {
            "list-item": $( "#albumlist li:nth-child("+ i +")" ).attr('list-item'),
            "titel": $( "#albumlist li:nth-child("+ i +")" ).text(),
            "active": "no"
        };
        }

        
        
        products.push(item);

    }
    var last_product = products.length - 1;
    var first_product = 0;

    previous_calc = current_active - 1;
    if(previous_calc < 0){
        previous = last_product;
    }
    else{
        previous = previous_calc;
    }

    next_calc = current_active + 1;
    if(next_calc > last_product){
        next = first_product;
    }
    else{
        next = next_calc;
    }



    //console.log(products);

    let productsAll = [{
      "data": products,
      "active": current_active,
      "previous": previous,
      "next": next
    }];

    //console.log(productsAll);

    $("#previous").attr("href", "/fotoalbum/foto/bekijk/"+productsAll[0].data[previous].titel);
    $("#next").attr("href", "/fotoalbum/foto/bekijk/"+productsAll[0].data[next].titel);


//console.log(products);
</script>