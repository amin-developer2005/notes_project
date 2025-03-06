<?php

namespace App\Models;

use Core\Database\DatabaseFactory;
use PDO;


class NoteModel
{
    private static DatabaseFactory $db;


    /**
     * @throws \Exception
     */
    private static function db(): DatabaseFactory
    {
        return DatabaseFactory::fetchInstance();
    }




    public static function createNewNote(string $title, string $body, int $userId): void
    {
        self::db()->query("INSERT INTO notes (title, body, user_id, created_at) VALUES (:title, :body, :user_id, :created_at)", [
            ':title' => $title,
            ':body' => $body,
            ':user_id' => $userId,
            ':created_at' => date("Y-m-d H:i:s"),
        ]);
    }



    public static function updateNoteByIdAndUserId(int $noteId, int $userId, string $title, string $body)
    {
        return self::db()->query("UPDATE notes SET title=:title, body=:body WHERE id=:id AND user_id=:user_id", [
            ':title' => $title,
            ':body' => $body,
            ':id' => $noteId,
            ':user_id' => $userId,
        ]);
    }



    public static function deleteNoteByIdAndUserId(int $noteId, int $userId)
    {
        return self::db()->query("DELETE FROM notes WHERE id=:id AND user_id=:user_id", [
            ':id' => $noteId,
            ':user_id' => $userId,
        ]);
    }




    public static function fetchAllNotes()
    {
        return self::db()->query("SELECT * FROM notes")->findAll() ?? null;
    }



    public static function fetchNoteById(int $noteId)
    {
        return self::db()->query("SELECT * FROM notes WHERE id=:id", [
            ':id' => $noteId,
        ])->findOrFail();
    }



    public static function fetchUserNotesByUserId(int $userId)
    {
        return self::db()->query("SELECT * FROM notes WHERE user_id=:user_id", [
            ':user_id' => $userId,
        ])->findAll();
    }



    public static function fetchAllUsersAndNotes()
    {
        return self::db()->query("SELECT * FROM notes LEFT OUTER JOIN users ON notes.user_id=users.id")->findAll() ?? null;
    }



}