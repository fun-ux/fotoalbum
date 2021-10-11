<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    <style>
        .head_fotoalbum{
            font-weight: 400;
        }
    </style>
</head>
<body>
    
    
    <main class="main">
        <div class="container">
        <header>
            <div class="container text-center">
                
                <h1 class="head_fotoalbum">
                    FOTOALBUM - HEADER
                </h1>
            </div>
        </header>
     

                <div class="row">
                        <?php foreach ($albumLijst as $categorie_): ?>
                            <div class="col-md-3" style="height: 75px; background-color:gray;border:1px solid;text-align:center"><h3> <?= $this->Html->link($categorie_->titel, ['action' => '', $categorie_->titel]) ?></h3></div>
                        <?php endforeach; ?>
                </div>

                <!-- Here is where we iterate through our $foto query object, printing out article info -->
                <div class="row">
                    <?php foreach ($foto as $foto_): ?>

                        
                            <div class="col-md-3 <?= $foto_->categorie->titel ?>">
                                <div class="card "style="height: 225px; width: 100%; display: block;margin-bottom:20px">
                                     <?php echo $this->Html->image('/img/foto/afbeelding/' . $foto_->get('path') . '/' . $foto_->get('afbeelding'), [
                                            "alt" => "...", 
                                        ]); 
                                    ?>
                                </div>
                            </div> 
                        
                    <?php endforeach; ?>
                </div>
         </div>
    </main>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php foreach ($albumLijst as $album_): ?>

    <?= $this->Html->link($album_->titel, ['action' => '', $album_->titel]) ?>

<?php endforeach; ?>


<?php
        /*echo "<pre>";
        print_r($albumLijst);
        echo "</pre>";*/
    ?>