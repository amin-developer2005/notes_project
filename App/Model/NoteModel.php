<?php

namespace App\Model;

use Core\Database\DbPDO;
use Core\Database\DatabaseFactory;
use PDO;


class NoteModel
{
    private static DatabaseFactory $db;


    /**
     * @throws \Exception
     */
    public function __construct()
    {
        self::$db = DatabaseFactory::fetchInstance();
    }


    public static function fetchAllNotes()
    {
        return self::$db->query("SELECT * FROM notes")->findAll() ?? null;
    }


    public static function fetchNoteById(int $noteId)
    {
        return self::$db->query("SELECT * FROM notes WHERE id=:id", [
            ':id' => $noteId,
        ])->findOrFail();
    }


    public static function fetchUserNotesByUserId(int $userId)
    {
        $result = self::$db->query("SELECT * FROM notes WHERE user_id=:user_id", [
            ':user_id' => $userId,
        ])->findAll();
        return $result ?? null;
    }


    public static function fetchAllUsersAndNotes()
    {
        return self::$db->query("SELECT * FROM notes LEFT OUTER JOIN users ON notes.user_id=users.id")->findAll() ?? null;
    }

}