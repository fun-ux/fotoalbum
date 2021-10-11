<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Account Controller
 *
 * @property \App\Model\Table\AccountTable $Account
 * @method \App\Model\Entity\Account[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AccountController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

  
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
      
        
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /foto after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Foto',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid username or password'));
        }
    }

    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Account', 'action' => 'login']);
        }
    }

    public function index()
    {
        $account = $this->paginate($this->Account);

        $this->set(compact('account')); 
    }

    /**
     * View method
     *
     * @param string|null $id Account id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $account = $this->Account->get($id, [
            'contain' => ['Foto'],
        ]);

        

        $this->set(compact('account'));
    }
   

}
