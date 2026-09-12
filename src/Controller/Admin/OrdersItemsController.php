<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * OrdersItems Controller
 *
 * @property \App\Model\Table\OrdersItemsTable $OrdersItems
 */
class OrdersItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->OrdersItems->find()
            ->contain(['Orders', 'Items']);
        $ordersItems = $this->paginate($query);

        $this->set(compact('ordersItems'));
    }

    /**
     * View method
     *
     * @param string|null $id Orders Item id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ordersItem = $this->OrdersItems->get($id, contain: ['Orders', 'Items']);
        $this->set(compact('ordersItem'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ordersItem = $this->OrdersItems->newEmptyEntity();
        if ($this->request->is('post')) {
            $ordersItem = $this->OrdersItems->patchEntity($ordersItem, $this->request->getData());
            if ($this->OrdersItems->save($ordersItem)) {
                $this->Flash->success(__('The orders item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The orders item could not be saved. Please, try again.'));
        }
        $orders = $this->OrdersItems->Orders->find('list', limit: 200)->all();
        $items = $this->OrdersItems->Items->find('list', limit: 200)->all();
        $this->set(compact('ordersItem', 'orders', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Orders Item id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ordersItem = $this->OrdersItems->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ordersItem = $this->OrdersItems->patchEntity($ordersItem, $this->request->getData());
            if ($this->OrdersItems->save($ordersItem)) {
                $this->Flash->success(__('The orders item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The orders item could not be saved. Please, try again.'));
        }
        $orders = $this->OrdersItems->Orders->find('list', limit: 200)->all();
        $items = $this->OrdersItems->Items->find('list', limit: 200)->all();
        $this->set(compact('ordersItem', 'orders', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Orders Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ordersItem = $this->OrdersItems->get($id);
        if ($this->OrdersItems->delete($ordersItem)) {
            $this->Flash->success(__('The orders item has been deleted.'));
        } else {
            $this->Flash->error(__('The orders item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
