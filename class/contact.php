<?php

class Contact
{
    /**
     * Обработка формы
     * @return false|string
     */
    public function contactData()
    {
        // Валидация полей
        $name    = isset($_POST['name']) ? $_POST['name'] : null;
        $lastname= isset($_POST['lastname']) ? $_POST['lastname'] : null;
        $email   = isset($_POST['email']) ? $_POST['email'] : null;
        $phone   = isset($_POST['phone']) ? $_POST['phone'] : null;
        $resData = array();

        //результат промежуточных данных об успехе\ошибках
        if (!$this->checkName($name)) {

            $resData['success'] = 0;
            $resData['message'] = 'Имя не должно быть короче 2-х символов!';
        }

        if (!$this->checkName($lastname)) {

            $resData['success'] = 0;
            $resData['message'] = 'Фамилия не должна быть короче 2-х символов!';
        }

        if (!$this->checkEmail($email)) {

            $resData['success'] = 0;
            $resData['message'] = 'Введите корректный email!';
        }
        if (!$this->checkPhone($phone)) {

            $resData['success'] = 0;
            $resData['message'] = 'Введите корректный номер телефона!';
        }
        if (!$resData) {

            $resData['success'] = 1;
            $resData['message'] = $name."<br />".$lastname."<br />".$email."<br />".$phone."<br />";
        } else {
            $resData['success'] = 0;
            $resData['message'] = 'Ошибка Отправки данных!';
        }

        return json_encode($resData, JSON_UNESCAPED_UNICODE);
     }

    /**
     * Фильтрация полей
     * @param $data
     * @return string
     */
    public function clearData($data)
    {
        $data = trim(strip_tags(stripslashes(htmlspecialchars($data))));

        return $data;
    }

    public function checkEmail($email)
    {

        $email = $this->clearData($email);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя\фамилию: не меньше, чем 2 символа
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public  function checkName($name)
    {
        $name = $this->clearData($name);
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    public function checkPhone($phone)
    {
        $phone = $this->clearData($phone);
        if ($phone) {
            return true;
        }
        return false;
    }
}