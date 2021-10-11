<?php
// src/Controller/FotosController.php

namespace App\Controller;

class FotoController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Paginator');
        $this->loadComponent('Flash'); // Include the FlashComponent
    }

    public function index()
    {
        $this->loadComponent('Paginator');
        //$foto = $this->Paginator->paginate($this->Foto->find());
        $query = $this->Foto->find('all')->contain(['Categorie'])->all();
 
        $this->set(compact('query'));


    }
    public function bekijk($titel = null)
    {
        $this->loadComponent('Paginator');
        $paginator = $this->paginate($this->Foto);
        $foto = $this->Foto->findByTitel($titel)->firstOrFail();
        $this->set(compact('foto'));
        $this->set(compact('paginator'));

    }
    public function nieuw()
    {
        $this->loadModel('Categorie');
        $categorie = $this->Paginator->paginate($this->Categorie->find());
        $this->set('categorie', $categorie);

        $foto = $this->Foto->newEmptyEntity();

        $account_id = $this->request
            ->getAttribute('identity')
            ->getIdentifier();
        $this->set(compact('account_id'));
        
        

        if ($this->request->is('post')) {
            $foto = $this->Foto->patchEntity($foto, $this->request->getData());
          
            // Hardcoding the user_id is temporary, and will be removed later
            // when we build authentication out.
            //$foto->account_id = 1;
            
            if ($this->Foto->save($foto)) {
                $this->Flash->success(__('Your foto has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to add your foto.'));
        }
        $this->set('foto', $foto);
    }
    public function bewerk($id)
    {
        $foto = $this->Foto
            ->findById($id)
            ->firstOrFail();

        $this->loadModel('Categorie');

        $account_id = $this->request
            ->getAttribute('identity')
            ->getIdentifier();
        $this->set(compact('account_id'));

        $categorie = $this->Paginator->paginate($this->Categorie->find());
        $this->set('categorie', $categorie);

        if ($this->request->is(['post', 'put'])) {
            $this->Foto->patchEntity($foto, $this->request->getData());
            if ($this->Foto->save($foto)) {
                $this->Flash->success(__('Your foto has been updated.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Unable to update your foto.'));
        }

        $this->set('foto', $foto);
    }
    public function verwijder($id)
    {
        $this->request->allowMethod(['post', 'delete']);

        $foto = $this->Foto->findById($id)->firstOrFail();
        if ($this->Foto->delete($foto)) {
            $this->Flash->success(__('The {0} foto has been deleted.', $foto->title));
            return $this->redirect(['action' => 'index']);
        }
    }
}