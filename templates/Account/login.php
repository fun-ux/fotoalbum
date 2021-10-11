<div class="account form">
    <?= $this->Flash->render() ?>
    <h3>Login</h3>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('username', ['required' => true, 'type' => 'text']) ?>
        <?= $this->Form->control('password', ['required' => true, 'type' => 'password']) ?>
    </fieldset>
    <?= $this->Form->submit(__('Login')); ?>
    <?= $this->Form->end() ?>

</div>