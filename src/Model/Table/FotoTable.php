<?php
// src/Model/Table/ArticlesTable.php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class FotoTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');
        $this->addBehavior('Proffer.Proffer', [
            'afbeelding' => [	// The name of your upload field
                'root' => WWW_ROOT . 'img', // Customise the root upload folder here, or omit to use the default
                'dir' => 'path',	// The name of the field to store the folder
                'thumbnailSizes' => [ // Declare your thumbnails
                    'square' => [	// Define the prefix of your thumbnail
                        'w' => 200,	// Width
                        'h' => 200,	// Height
                        'jpeg_quality'	=> 100
                    ],
                    'portrait' => [		// Define a second thumbnail
                        'w' => 100,
                        'h' => 300
                    ],
                ],
                'thumbnailMethod' => 'gd'	// Options are Imagick or Gd
            ]
        ]);

        $this->belongsTo('Account');
        $this->belongsTo('Categorie')
            ->setJoinType('LEFT');
    }
    
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->notEmptyString('titel')
            ->minLength('titel', 5)
            ->maxLength('titel', 255)

            ->notEmptyString('omschrijving')
            ->minLength('omschrijving', 5);

        return $validator;
    }
}