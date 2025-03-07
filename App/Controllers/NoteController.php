<?php

namespace App\Controllers;

use App\Models\NoteModel;
use Core\Redirect;
use Core\Session;
use Core\Url;
use Core\ValidationException;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use App\View\View;
use Core\Response;
use App\System\Traits\Validator;
use App\Forms\NoteForm;




class NoteController
{
    use Validator;


    private array $fields = [];



    public function __construct()
    {
        foreach ($_POST as $field => $value) {
            $this->fields[$field] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
    }



    public function index(): void
    {
        $notes = NoteModel::fetchUserNotesByUserId(Session::fetch('user')['id']);
        View::render("notes/index", ["notes" => $notes, 'heading' => 'Notes']);
    }




    public function show(): void
    {
        $noteId = Url::fetchQuery('id');
        $note = NoteModel::fetchNoteById($noteId);
        View::render("notes/show", ['heading' => 'Your note' , "note" => $note]);
    }





    public function create(): void
    {
        View::render('notes/create', ['heading' => 'Create New Note', 'errors' => Session::fetchFlash('errors')]);
    }



    /**
     * @throws ValidationException
     */
    #[NoReturn] public function store(): void
    {
        NoteForm::validate($this->fields);

        NoteModel::createNewNote($this->title, $this->body, Session::fetch('user')['id']);
        Redirect::to('/notes');
    }




    public function edit(): void
    {
        $noteId = Url::fetchQuery('id');
        $note = NoteModel::fetchNoteById($noteId);
        View::render("notes/edit", ['heading' => 'Edit Your Note', 'note' => $note]);
    }



    /**
     * @throws ValidationException
     */
    #[NoReturn] public function update(): void
    {
        NoteForm::validate($this->fields);

        $note = NoteModel::fetchNoteById(Url::fetchPost('id'));
        authorize($note->user_id === Session::fetch('user')['id']);

        NoteModel::updateNoteByIdAndUserId($note->id, $note->user_id, $this->title, $this->body);

        Redirect::to('/notes');
    }



    #[NoReturn] public function delete(): void
    {
        $note = NoteModel::fetchNoteById(Url::fetchPost('id'));
        authorize($note->user_id === Session::fetch('user')['id']);

        NoteModel::deleteNoteByIdAndUserId(Url::fetchPost('id'), $note->user_id);
        Redirect::to('/notes');
    }






    public function __set(string $name, $value): void
    {
        // TODO: Implement __set() method.
        $this->fields[$name] = $value;
    }


    public function __get(string $name)
    {
        // TODO: Implement __get() method.
        return $this->fields[$name] ?? null;
    }

}