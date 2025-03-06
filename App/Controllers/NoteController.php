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
        $notes = NoteModel::fetchUserNotesByUserId($_SESSION['user']['id']);
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
        // Check the request method;
        if (! Url::isRequestMethod(Request::METHOD_POST)) {
            Redirect::to('/notes/edit?id=' . $_POST['id']);
        }

        // Validate the request;
        NoteForm::validate($this->fields);

        // If validation fails, then flash the messages to the user;
        if (! $this->isValid) {
            View::render("notes/edit?id={$_POST['id']}", ['heading' => 'Edit Your Note', 'errors' => $this->messageController->getMessages()]);
        }

        // Authorize the user; Check if the user who created this specific note is the person who is currently signed in;
        $note = NoteModel::fetchNoteById($_POST['id']);
        authorize($note->user_id === $_SESSION['user']['id']);

        // If Authorization is passed successfully, then update the specific note in the database;
        NoteModel::updateNoteByIdAndUserId($note->id, $note->user_id, $this->title, $this->body);

        // Redirect the user to the index page of notes;
        Redirect::to('/notes');
    }



    #[NoReturn] public function delete(): void
    {
        if (! Url::isRequestMethod(Request::METHOD_POST)) {
            Redirect::to('/home');
        }

        $currentUser = $_SESSION['user']['id'];

        $note = NoteModel::fetchNoteById($_POST['id']);
        authorize($note->user_id === $currentUser);

        NoteModel::deleteNoteByIdAndUserId($_POST['id'], $currentUser);
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