<?php
declare(strict_types=1);

namespace App;

use App\Exception\NotFoundException;


require_once "src/AbstractController.php";

class NoteController extends AbstractController
{
    public function createAction() {
        if($this->request->hasPost()) {
            $this->db->createNote([
                'title' => $this->request->postParam('title'),
                'description' => $this->request->postParam('description'),
            ]);
            header('Location: /?msg=created');
            exit();
        }
        $this->view->render('create');
    }

    public function showAction() {
        $noteId = (int) $this->request->getParam('id');
        if(!$noteId) {
            header('Location: /?error=missingNoteId');
            exit();
        }

        try {
            $note = $this->db->getNote($noteId);
        }
        catch (NotFoundException $e) {
            header('Location: /?error=noteNotFound');
            exit();
        }

        $this->view->render('show', ['note' => $note,]);
    }

    public function listAction() {
        $this->view->render('list', ['msg' => $this->request->getParam('msg'), 'error' => $this->request->getParam('error'), 'notes' => $this->db->getNotes()]);
    }

}