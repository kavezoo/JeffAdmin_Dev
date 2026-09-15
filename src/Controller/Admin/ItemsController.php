<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 */
class ItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Items->find();

        // Header kereső (?search=) — sessionből a JeffAdmin AppController állítja vissza.
        $search = trim((string)$this->request->getQuery('search', ''));
        if ($search !== '') {
            $parts = preg_split('/\s+/u', $search, -1, PREG_SPLIT_NO_EMPTY) ?: [];
            $like = '%' . implode('%', $parts) . '%';

            $query
                ->where([
                    'OR' => [
                        'Items.name LIKE' => $like,
                        'Items.unit LIKE' => $like,
                    ],
                ])
                ->distinct(['Items.id']);
        }

        $items = $this->paginate($query);

        $this->set(compact('items'));
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->rememberLastRecord($id);

        $item = $this->Items->get($id, contain: ['Orders']);
        //dd($id);
        //dd($item->toArray());
        $this->set(compact('item'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $item = $this->Items->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //dd($data);
            $item = $this->Items->patchEntity($item, $data);
            //dd($item->toArray());
            //dd($item->getErrors());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));
                $this->rememberLastRecord($item->id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $orders = $this->Items->Orders->find('list', limit: 200)->all();
        $this->set(compact('item', 'orders'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->rememberLastRecord($id);

        $item = $this->Items->get($id, contain: ['Orders']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //dd($data);
            $item = $this->Items->patchEntity($item, $data);
            //dd($item->toArray());
            //dd($item->getErrors());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
        $orders = $this->Items->Orders->find('list', limit: 200)->all();
        $this->set(compact('item', 'orders'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
