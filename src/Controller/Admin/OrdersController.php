<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Orders Controller
 *
 * @property \App\Model\Table\OrdersTable $Orders
 */
class OrdersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Orders->find()
            ->contain(['Customers']);

        // Header kereső (?search=) — sessionből a JeffAdmin AppController állítja vissza.
        $search = trim((string)$this->request->getQuery('search', ''));
        if ($search !== '') {
            $parts = preg_split('/\s+/u', $search, -1, PREG_SPLIT_NO_EMPTY) ?: [];
            $like = '%' . implode('%', $parts) . '%';

            $query
                ->leftJoinWith(['Customers'])
                ->where([
                    'OR' => [
                        'Customers.name LIKE' => $like,
                    ],
                ])
                ->distinct(['Orders.id']);
        }

        $orders = $this->paginate($query);

        $this->set(compact('orders'));
    }

    /**
     * View method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->rememberLastRecord($id);

        $order = $this->Orders->get($id, contain: ['Customers', 'Items']);
        //dd($id);
        //dd($order->toArray());
        $customers = $this->Orders->Customers->find('list', limit: 200)->all();
        $this->set(compact('order', 'customers'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $order = $this->Orders->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //dd($data);
            $order = $this->Orders->patchEntity($order, $data);
            //dd($order->toArray());
            //dd($order->getErrors());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));
                $this->rememberLastRecord($order->id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customers = $this->Orders->Customers->find('list', limit: 200)->all();
        $items = $this->Orders->Items->find('list', limit: 200)->all();
        $this->set(compact('order', 'customers', 'items'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->rememberLastRecord($id);

        $order = $this->Orders->get($id, contain: ['Items']);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //dd($data);
            $order = $this->Orders->patchEntity($order, $data);
            //dd($order->toArray());
            //dd($order->getErrors());
            if ($this->Orders->save($order)) {
                $this->Flash->success(__('The order has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The order could not be saved. Please, try again.'));
        }
        $customers = $this->Orders->Customers->find('list', limit: 200)->all();
        $items = $this->Orders->Items->find('list', limit: 200)->all();
        $this->set(compact('order', 'customers', 'items'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Order id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $order = $this->Orders->get($id);
        if ($this->Orders->delete($order)) {
            $this->Flash->success(__('The order has been deleted.'));
        } else {
            $this->Flash->error(__('The order could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
