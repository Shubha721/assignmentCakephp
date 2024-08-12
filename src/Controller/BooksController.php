<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Books Controller
 *
 * @property \App\Model\Table\BooksTable $Books
 * @method \App\Model\Entity\Book[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BooksController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Authors'],
            'limit' => 5,
        ];
        $books = $this->paginate($this->Books);

          // Fetch search query from the request
          $searchTitle = $this->request->getQuery('title');
          $searchAuthor = $this->request->getQuery('author');
  
          // Create a query for books
          $query = $this->Books->find()
              ->contain('Authors');
  
          // Apply filters if search criteria are provided
          if (!empty($searchTitle)) {
              $query->where(['Books.title LIKE' => '%' . $searchTitle . '%']);
          }
          if (!empty($searchAuthor)) {
              $query->matching('Authors', function ($q) use ($searchAuthor) {
                  return $q->where(['Authors.author_name LIKE' => '%' . $searchAuthor . '%']);
              });
          }

          $books = $this->paginate($query);

        $this->set(compact('books', 'searchTitle', 'searchAuthor'));

        //echo json_encode($books);

        //exit();
    }

    /**
     * View method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => ['Authors'],
        ]);

        $this->set(compact('book'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add1()
    {
        $book = $this->Books->newEmptyEntity();
        if ($this->request->is('post')) {
            $book = $this->Books->patchEntity($book, $this->request->getData());

            

            $image = $this->request->getData('cover_image');

            $name = $image->getClientFilename();
            $uploadPath = WWW_ROOT . 'img' . DS . 'uploads' . DS;

            if($name)
            
            $image->moveTo($uploadPath);

            $book->image = $name;
            


            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $authors = $this->Books->Authors->find('list', ['limit' => 200])->all();
        $this->set(compact('book', 'authors'));
    }

    public function add()
{
    $book = $this->Books->newEmptyEntity();
    if ($this->request->is('post')) {
        // Get data from the request
        $data = $this->request->getData();
        
        // Handle file upload
        $file = $this->request->getData('cover_image');

        // Check if a file was uploaded and there were no errors
        if ($file && $file->getError() === UPLOAD_ERR_OK) {
            $uploadPath = WWW_ROOT . 'img' . DS . 'uploads' . DS;
            $fileName = time() . '_' . $file->getClientFilename();
            
            try {
                // Move the file to the upload directory
                $file->moveTo($uploadPath . $fileName);
                // Set the file path in the book entity
                $data['cover_image'] = 'uploads' . DS . $fileName;
            } catch (\Exception $e) {
                // Handle file upload error
                $this->Flash->error(__('File could not be uploaded. Please, try again.'));
                return $this->redirect($this->referer());
            }
        } elseif ($file && $file->getError() !== UPLOAD_ERR_OK) {
            // Handle file upload error
            $this->Flash->error(__('File upload error: ' . $file->getError()));
            return $this->redirect($this->referer());
        }

        // Patch the book entity with data and save it
        $book = $this->Books->patchEntity($book, $data);
        if ($this->Books->save($book)) {
            $this->Flash->success(__('The book has been saved.'));
            return $this->redirect(['action' => 'index']);
        }
        $this->Flash->error(__('The book could not be saved. Please, try again.'));
    }

    $authors = $this->Books->Authors->find('list', ['limit' => 200])->all();
    $authors = $this->Books->Authors->find('list', [
        'keyField' => 'author_id',
        'valueField' => 'author_name',
        'limit' => 200
    ])->toArray();
    $this->set(compact('book', 'authors'));
}


   


   

    /**
     * Edit method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit_ori($id = null)
    {
        $book = $this->Books->get($id, [
            'contain' => [],
        ]);

        
        if ($this->request->is(['patch', 'post', 'put'])) {
            $book = $this->Books->patchEntity($book, $this->request->getData());
            if ($this->Books->save($book)) {
                $this->Flash->success(__('The book has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The book could not be saved. Please, try again.'));
        }
        $authors = $this->Books->Authors->find('list', ['limit' => 200])->all();
        $authors = $this->Books->Authors->find('list', [
            'keyField' => 'author_id',
            'valueField' => 'author_name',
            'limit' => 200
        ])->toArray();
        $this->set(compact('book', 'authors'));
    }

  
    public function edit($id = null)
{
    $book = $this->Books->get($id, [
        'contain' => [],
    ]);

    if ($this->request->is(['patch', 'post', 'put'])) {
        // Get the request data
        $data = $this->request->getData();
        
        // Handle file upload
        $file = $this->request->getData('cover_image');
        
        // if ($file instanceof \Laminas\Diactoros\UploadedFile && $file->getError() === UPLOAD_ERR_OK) 
        // {
            $uploadPath = WWW_ROOT . 'img' . DS . 'uploads' . DS;
            $fileName = time() . '_' . $file->getClientFilename();
            
            try {
                // Move the file to the upload directory
                $file->moveTo($uploadPath . $fileName);
                // Update the file path in the data array
                $data['cover_image'] = 'uploads' . DS . $fileName;
            } catch (\Exception $e) {
                // Handle file upload error
                $this->Flash->error(__('File could not be uploaded. Please, try again.'));
                // Ensure no additional output
                return $this->redirect($this->referer());
            }
        // } else {
        //     // Preserve the existing cover image if no new file is uploaded
        //     if (!isset($data['cover_image']) || is_string($data['cover_image'])) {
        //         $data['cover_image'] = $book->cover_image;
        //     }
        // }

        // Patch the entity with data
        $book = $this->Books->patchEntity($book, $data);

        if ($this->Books->save($book)) {
            $this->Flash->success(__('The book has been saved.'));
            // Redirect after successful save
            return $this->redirect(['action' => 'index']);
        }
        
        // Error handling
        $this->Flash->error(__('The book could not be saved. Please, try again.'));
    }

    // Fetch authors for the form
    $authors = $this->Books->Authors->find('list', [
        'keyField' => 'author_id',
        'valueField' => 'author_name',
        'limit' => 200
    ])->toArray();

    // Set variables for the view
    $this->set(compact('book', 'authors'));
}



    /**
     * Delete method
     *
     * @param string|null $id Book id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $book = $this->Books->get($id);
        if ($this->Books->delete($book)) {
            $this->Flash->success(__('The book has been deleted.'));
        } else {
            $this->Flash->error(__('The book could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
