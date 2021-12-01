<?php


namespace app\core\helpers;


use app\system\libraries\Database;

class FormHelper
{
    public $errors;

    public $message;

    private $formData;

    public function __construct()
    {

    }

    public function validate($data)
    {
        $amount = $data['amount'];
        $buyer = $data['buyer'];
        $receipt_id = $data['receipt_id'];
        $buyer_email = $data['buyer_email'];
        $note = $data['note'];
        $city = $data['city'];
        $phone = $data['phone'];
        $entry_by = $data['entry_by'];
        $items = json_encode($data['items']);

        $errors = [

        ];

        foreach ($data as $key => $value) {
            if (empty($value)) {
                array_push($errors, "$key should not be empty");
            }
        }

        if (!is_numeric($amount)) {

            array_push($errors, "amount should contain only numbers");
        }

        if (!preg_match('[a-z0-9]', $buyer)) {

            array_push($errors, "Buyer should only contain number, character and spaces");
        }

        if (!preg_match("/^[a-zA-Z \s]+$/", $receipt_id)) {

            array_push($errors, "Receipt id should contain only text");
        }

        if (!filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Buyer email is not valid");
        }

        if (strlen($note) > 30) {
            array_push($errors, "Not should not contain more than 30 characters");
        }

        if (!preg_match("/^[a-zA-Z \s]+$/", $city)) {

            array_push($errors, "City should contain only text, spaces");
        }

        if (array_key_exists('insertcookie', $_COOKIE)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'you can not insert data within 24 hours two times'
            ]);
            exit;
        }

        if (count($errors) > 0) {

            $data['buyer_ip'] = $_SERVER['REMOTE_ADDR'];
            $data['hash_key'] = hash("sha512", $receipt_id);
            date_default_timezone_set('Asia/Dhaka');
            $data['entry_at'] = date('Y-m-d');
            $db = Database::getInstance();
            $connection = $db->connection;

            $insertQuery = "INSERT INTO datatable( `amount`, `buyer`, `receipt_id`, `items`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `hash_key`, `entry_at`, `entry_by`) VALUES (:amount,:buyer,:receipt_id,:items,:buyer_email,:buyer_ip,:note,:city,:phone,:hash_key,:entry_at,:entry_by)";
            $statement = $connection->prepare($insertQuery);


            try {
                $status = $statement->execute(array(
                    ':amount' => $data['amount'],
                    ':buyer' => $data['buyer'],
                    ':receipt_id' => $data['receipt_id'],
                    ':items' => $items,
                    ':buyer_email' => $data['buyer_email'],
                    ':buyer_ip' => $data['buyer_ip'],
                    ':note' => $data['note'],
                    ':city' => $data['city'],
                    ':phone' => $data['phone'],
                    ':hash_key' => $data['hash_key'],
                    ':entry_at' => $data['entry_at'],
                    ':entry_by' => $data['entry_by'],
                ));
                if ($status == true) {
                    setcookie("insertcookie", true, time() + 3600); // 1hr = 3600 secs
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'insert successful'
                    ]);
                } else {

                    echo json_encode([
                        'status' => 'error',
                        'message' => 'insert failed'
                    ]);
                }

            } catch (\PDOException $exception) {

                echo json_encode([
                    'status' => 'error',
                    'message' => 'something went wrong'
                ]);
            }

        } else {
            echo json_encode($errors);
        }

    }

}