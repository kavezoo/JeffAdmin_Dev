<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;
use Cake\ORM\Query\SelectQuery;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 */
class CustomersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Customers->find()
            ->contain(['Cities']);

        /*
         * Szöveges keresés / szűrés (header ?search=).
         * Szóközök → % : "szöveg valami mégvalami" => %szöveg%valami%mégvalami%
         * Saját szöveges mezők + szülő Cities szöveges mezői.
         *
         * Bekapcsoláshoz vedd ki a kommentet.
         *
        $search = trim((string)$this->request->getQuery('search', ''));
        if ($search !== '') {
            $parts = preg_split('/\s+/u', $search, -1, PREG_SPLIT_NO_EMPTY) ?: [];
            $like = '%' . implode('%', $parts) . '%';

            $query
                ->leftJoinWith('Cities')
                ->where([
                    'OR' => [
                        'Customers.name LIKE' => $like,
                        'Customers.address LIKE' => $like,
                        'Customers.phone LIKE' => $like,
                        'Cities.name LIKE' => $like,
                        'Cities.shortname LIKE' => $like,
                        'Cities.zip LIKE' => $like,
                    ],
                ])
                ->distinct(['Customers.id']);
        }
        */

        $customers = $this->paginate($query);

        $this->set(compact('customers'));
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->rememberLastRecord($id);

        $customer = $this->Customers->get($id, contain: [
            'Cities',
            'Orders' => function (SelectQuery $q) {
                return $q->orderBy(['Orders.datetime' => 'DESC']);
            },
        ]);
        $cities = $this->Customers->Cities->find('list', limit: 200)->all();
        $this->set(compact('customer', 'cities'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $customer = $this->Customers->newEmptyEntity();
        if ($this->request->is('post')) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));
                $this->rememberLastRecord($customer->id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $cities = $this->Customers->Cities->find('list', limit: 200)->all();
        $this->set(compact('customer', 'cities'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->rememberLastRecord($id);

        $customer = $this->Customers->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $cities = $this->Customers->Cities->find('list', limit: 200)->all();
        $this->set(compact('customer', 'cities'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
