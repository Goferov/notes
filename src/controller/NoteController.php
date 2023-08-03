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
        $noteId = (int)$this->request->getParam('id');
        if(!$noteId) {
            $this->redirect('/',['error'=>'missingNoteId']);
        }

        $this->view->render('edit');
    }

    private function redirect(string $to, array $params):void {

        $location = $to;

        if($params) {
            $queryParams = [];
            foreach ($params as $key=>$param) {
                $queryParams[] = urlencode($key) . '=' . urlencode($param);
            }
            $queryParams = implode('&',$queryParams);
            $location .= '?' . $queryParams;
        }
        header('Location: '.$location);
        exit();
    }
}