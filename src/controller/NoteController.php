<?php
declare(strict_types=1);

namespace App\Controller;

class NoteController extends AbstractController
{
    private const PAGE_SIZE = 10;
    public function createAction(): void {
        if($this->request->hasPost()) {
            $this->noteModel->create([
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
            $this->redirect('/',['msg'=>'created']);
        }
        $this->view->render('create');
    }

    public function showAction(): void {
        $this->view->render('show', ['note' => $this->getNote()]);
    }

    public function listAction(): void {
        $pageSize = (int) $this->request->getParam('pagesize',self::PAGE_SIZE);
        $pageNumber = (int) $this->request->getParam('pagenumber',1);
        $sortBy = $this->request->getParam('sortby','title');
        $sortOrder = $this->request->getParam('sortorder','asc');
        $phrase = $this->request->getParam('phrase');

        if(!in_array($pageSize,[10,15,20,25])) {
            $pageSize = self::PAGE_SIZE;
        }

        if($pageNumber < 1) {
            $pageNumber = 1;
        }

        if($phrase) {
            $notes = $this->noteModel->search($phrase,$pageNumber, $pageSize, $sortBy, $sortOrder);
            $notesCount = $this->noteModel->searchCount($phrase);
        }
        else {
            $notes = $this->noteModel->list($pageNumber, $pageSize, $sortBy, $sortOrder);
            $notesCount = $this->noteModel->count();
        }



        $this->view->render('list',
            [
                'page' => ['number'=>$pageNumber, 'size'=>$pageSize, 'pages'=> (int) ceil($notesCount /  $pageSize)],
                'sort' => ['by'=>$sortBy, 'order'=>$sortOrder],
                'phrase' => $phrase,
                'msg' => $this->request->getParam('msg'),
                'error' => $this->request->getParam('error'),
                'notes' => $notes
            ]
        );
    }

    public function editAction(): void {

        if($this->request->isPost()) {
            $noteId = (int)$this->request->postParam('id');
            $this->noteModel->edit($noteId,[
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
            $this->redirect('/',['msg' => 'edited']);
        }
        $this->view->render('edit',['note' => $this->getNote()]);
    }

    public function deleteAction(): void {

        if($this->request->isPost()) {
            $noteId = (int) $this->request->postParam('id');
            $this->noteModel->delete($noteId);
            $this->redirect('/',['msg'=>'deleted']);
        }

        $this->view->render('delete',['note' => $this->getNote()]);
    }

    private function getNote(): array {
        $noteId = (int)$this->request->getParam('id');
        if(!$noteId) {
            $this->redirect('/',['error'=>'missingNoteId']);
        }
        return $this->noteModel->get($noteId);
    }

}