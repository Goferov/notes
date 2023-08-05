<?php
declare(strict_types=1);

namespace App\Controller;

use App\Exception\NotFoundException;

class NoteController extends AbstractController
{
    public function createAction() {
        if($this->request->hasPost()) {
            $this->db->createNote([
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
            $this->redirect('/',['msg'=>'created']);
        }
        $this->view->render('create');
    }

    public function showAction() {
        $noteId = (int) $this->request->getParam('id');
        if(!$noteId) {
            $this->redirect('/',['error'=>'missingNoteId']);
        }

        try {
            $note = $this->db->getNote($noteId);
        }
        catch (NotFoundException $e) {
            $this->redirect('/',['error'=>'noteNotFound']);
        }

        $this->view->render('show', ['note' => $note,]);
    }

    public function listAction() {
        $this->view->render('list', ['msg' => $this->request->getParam('msg'), 'error' => $this->request->getParam('error'), 'notes' => $this->db->getNotes()]);
    }

    public function editAction() {

        if($this->request->isPost()) {
            $noteId = (int)$this->request->postParam('id');
            $this->db->editNote($noteId,[
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
            $this->redirect('/',['msg' => 'edited']);
        }

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

        $this->view->render('edit',['note' => $note,]);
    }


}