<?php
declare(strict_types=1);

namespace App\Controller;

use App\Exception\NotFoundException;

class NoteController extends AbstractController
{
    public function createAction(): void {
        if($this->request->hasPost()) {
            $this->db->createNote([
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

        $sortBy = $this->request->getParam('sortby','title');
        $sortOrder = $this->request->getParam('sortorder','asc');

        $this->view->render('list',
            [
                'sort' => ['by'=>$sortBy, 'order'=>$sortOrder],
                'msg' => $this->request->getParam('msg'),
                'error' => $this->request->getParam('error'),
                'notes' => $this->db->getNotes($sortBy, $sortOrder)
            ]
        );
    }

    public function editAction(): void {

        if($this->request->isPost()) {
            $noteId = (int)$this->request->postParam('id');
            $this->db->editNote($noteId,[
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
            $this->db->deleteNote($noteId);
            $this->redirect('/',['msg'=>'deleted']);
        }

        $this->view->render('delete',['note' => $this->getNote()]);
    }

    private function getNote(): array {
        $noteId = (int)$this->request->getParam('id');
        if(!$noteId) {
            $this->redirect('/',['error'=>'missingNoteId']);
        }

        try {
            $note = $this->db->getNote($noteId);
        }
        catch (NotFoundException $e) {
            $this->redirect('/',['error'=>'noteNotFound']);
        }
        return $note;
    }

}