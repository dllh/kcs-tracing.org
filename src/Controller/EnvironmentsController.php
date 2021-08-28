<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Environments Controller
 *
 * @property \App\Model\Table\EnvironmentsTable $Environments
 * @method \App\Model\Entity\Environment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EnvironmentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $environments = $this->paginate($this->Environments, [ 'contain' => [ 'Schools' ] ] );
        $this->set(compact('environments'));
    }

    /**
     * View method
     *
     * @param string|null $id Environment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $environment = $this->Environments->get($id, [
            'contain' => ['Schools', 'Reports'],
        ]);

        $this->set(compact('environment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $environment = $this->Environments->newEmptyEntity();
        if ($this->request->is('post')) {
            $environment = $this->Environments->patchEntity($environment, $this->request->getData());
            if ($this->Environments->save($environment)) {
                $this->Flash->success(__('The environment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The environment could not be saved. Please, try again.'));
        }
        $schools = $this->Environments->Schools->find('list', ['limit' => 200]);
        $this->set(compact('environment', 'schools'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Environment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $environment = $this->Environments->get($id, [
            'contain' => ['Schools'],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $environment = $this->Environments->patchEntity($environment, $this->request->getData());
            if ($this->Environments->save($environment)) {
                $this->Flash->success(__('The environment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The environment could not be saved. Please, try again.'));
        }
        $schools = $this->Environments->Schools->find('list', ['limit' => 200]);
        $this->set(compact('environment', 'schools'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Environment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $environment = $this->Environments->get($id);
        if ($this->Environments->delete($environment)) {
            $this->Flash->success(__('The environment has been deleted.'));
        } else {
            $this->Flash->error(__('The environment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
