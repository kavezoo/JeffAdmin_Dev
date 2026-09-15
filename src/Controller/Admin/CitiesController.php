<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\Admin\AppController;

/**
 * Cities Controller
 *
 * @property \App\Model\Table\CitiesTable $Cities
 */
class CitiesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Cities->find();

        // Header kereső (?search=) — sessionből a JeffAdmin AppController állítja vissza.
        $search = trim((string)$this->request->getQuery('search', ''));
        if ($search !== '') {
            $parts = preg_split('/\s+/u', $search, -1, PREG_SPLIT_NO_EMPTY) ?: [];
            $like = '%' . implode('%', $parts) . '%';

            $query
                ->where([
                    'OR' => [
                        'Cities.shortname LIKE' => $like,
                        'Cities.name LIKE' => $like,
                        'Cities.zip LIKE' => $like,
                        'Cities.lat LIKE' => $like,
                        'Cities.lng LIKE' => $like,
                    ],
                ])
                ->distinct(['Cities.id']);
        }

        $cities = $this->paginate($query);

        $this->set(compact('cities'));
    }

    /**
     * View method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->rememberLastRecord($id);

        $city = $this->Cities->get($id, contain: ['Customers']);
        //dd($id);
        //dd($city->toArray());
        $this->set(compact('city'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $city = $this->Cities->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            //dd($data);
            $city = $this->Cities->patchEntity($city, $data);
            //dd($city->toArray());
            //dd($city->getErrors());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));
                $this->rememberLastRecord($city->id);

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $this->set(compact('city'));
    }

    /**
     * Edit method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->rememberLastRecord($id);

        $city = $this->Cities->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            //dd($data);
            $city = $this->Cities->patchEntity($city, $data);
            //dd($city->toArray());
            //dd($city->getErrors());
            if ($this->Cities->save($city)) {
                $this->Flash->success(__('The city has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The city could not be saved. Please, try again.'));
        }
        $this->set(compact('city'));
    }

    /**
     * Delete method
     *
     * @param string|null $id City id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $city = $this->Cities->get($id);
        if ($this->Cities->delete($city)) {
            $this->Flash->success(__('The city has been deleted.'));
        } else {
            $this->Flash->error(__('The city could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
