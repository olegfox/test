<?php

namespace App;

/**
 * Class Client
 */
class Client
{
    const TABLENAME = 'client';

    /**
     * @var
     */
    protected $id;

    /**
     * @var
     */
    protected $firstname;

    /**
     * @var
     */
    protected $lastname;

    /**
     * @var
     */
    protected $phone;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Создание клиента
     * @return mixed
     * @throws \Exception
     */
    public function create()
    {
        try {
            $stmt = Db::getInstance()->prepare("
                INSERT INTO `" . self::TABLENAME . "` (`firstname`, `lastname`, `phone`) VALUE
                (:firstname, :lastname, :phone)
            ");
            $stmt->bindParam("firstname", $this->firstname);
            $stmt->bindParam("lastname", $this->lastname);
            $stmt->bindParam("phone", $this->phone);
            $stmt->execute();
            $this->id = Db::getInstance()->lastInsertId();
            return $this->id;
        } catch (\PDOException $e) {
            throw new \Exception("PDO Ошибка добавления клиента в базу данных. Текст ошибки: " . $e->getmessage());
        } catch (\Exception $e) {
            throw new \Exception("PHP Ошибка добавления клиента в базу данных. Текст ошибки: " . $e->getmessage());
        }
    }

    /**
     * Обновление клиента
     * @throws \Exception
     */
    public function update()
    {
        try {
            $stmt = Db::getInstance()->prepare("
                UPDATE `" . self::TABLENAME . "` SET `firstname` = :firstname, `lastname` = :lastname, `phone` = :phone
                WHERE `id` = :id
            ");
            $stmt->bindParam("id", $this->id);
            $stmt->bindParam("firstname", $this->firstname);
            $stmt->bindParam("lastname", $this->lastname);
            $stmt->bindParam("phone", $this->phone);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \Exception("PDO Ошибка обновления клиента в базе данных. Текст ошибки: " . $e->getmessage());
        } catch (\Exception $e) {
            throw new \Exception("PHP Ошибка обновления клиента в базе данных. Текст ошибки: " . $e->getmessage());
        }
    }

    /**
     * Удаление клиента
     * @throws \Exception
     */
    public function delete()
    {
        try {
            $stmt = Db::getInstance()->prepare("
                DELETE FROM `" . self::TABLENAME . "`
                WHERE `id` = :id
            ");
            $stmt->bindParam("id", $this->id);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \Exception("PDO Ошибка удаления клиента из базы данных. Текст ошибки: " . $e->getmessage());
        } catch (\Exception $e) {
            throw new \Exception("PHP Ошибка удаления клиента из базы данных. Текст ошибки: " . $e->getmessage());
        }
    }

    /**
     * Получение клиента по id
     * @param null $id
     * @return mixed
     * @throws \Exception
     */
    public static function findById($id = null)
    {
        try {
            $stmt = Db::getInstance()->prepare("
                SELECT * FROM `" . self::TABLENAME . "`
                WHERE `id` = :id
            ");
            $stmt->bindParam("id", $id);
            $stmt->execute();
            return $stmt->fetchObject();
        } catch (\PDOException $e) {
            throw new \Exception("PDO Ошибка получения клиента из базы данных. Текст ошибки: " . $e->getmessage());
        } catch (\Exception $e) {
            throw new \Exception("PHP Ошибка получения клиента из базы данных. Текст ошибки: " . $e->getmessage());
        }
    }

    /**
     * Получение всех клиентов
     * @return mixed
     * @throws \Exception
     */
    public static function findAll()
    {
        try {
            $stmt = Db::getInstance()->prepare("
                SELECT * FROM `" . self::TABLENAME . "`
            ");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            throw new \Exception("PDO Ошибка получения клиентов из базы данных. Текст ошибки: " . $e->getmessage());
        } catch (\Exception $e) {
            throw new \Exception("PHP Ошибка получения клиентов из базы данных. Текст ошибки: " . $e->getmessage());
        }
    }
}