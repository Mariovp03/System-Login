<?php

namespace Controller;

use Model\ForgotPasswordModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ForgotPasswordController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new ForgotPasswordModel;
    }

    public function index()
    {
        $this->model->cleanToken();
        $this->handleToken();
        $this->handlePasswordUpdate();
        $this->displayForgotPasswordView();
    }

    public function displayForgotPasswordView()
    {
        $tokenRecover = !empty($_GET['recoverPassword']) ? $_GET['recoverPassword'] : false;
        $selectByToken = $this->model->selectByToken($tokenRecover);
        $validateToken = !empty($selectByToken);

        $pathForgotPasswordTreated = $validateToken ? PATH_BASE_VIEW . "UpdatePasswordView.php" : PATH_BASE_VIEW . "ForgotPasswordView.php";

        echo $this->getView(
            $pathForgotPasswordTreated,
            [
                'nameComplet' => 'Mário do Vale',
            ]
        );
    }

    public function handleToken()
    {
        $emailRecoverPassword = $_POST['emailRecover'] ?? null;

        if ($emailRecoverPassword) {
            $createHash = $this->createHash($emailRecoverPassword);
            $this->model->insertTokenRecoverPassword($createHash, $emailRecoverPassword);
            $this->sendEmail($emailRecoverPassword);
        }
    }

    public function createHash($email)
    {
        $passwordUser = $this->model->getRecoverPasswordByEmail($email)['password'];
        return !empty($passwordUser) ? password_hash($passwordUser, PASSWORD_DEFAULT) : '';
    }

    public function sendEmail($emailRecoverPassword)
    {
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Username = 'enviodeemail37@gmail.com';
            $mail->Password = 'itndblvvyizjxbso';
            $mail->SMTPSecure = 'tls';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;

            // Configurações do e-mail
            $mail->setFrom('enviodeemail37@gmail.com', 'Nome do Remetente');
            $mail->addAddress($emailRecoverPassword, 'Destinatário');
            $mail->isHTML(true); // Define o formato do e-mail como HTML
            $mail->Subject = 'Troca de senha no sistema';
            $mail->Body = '<b>Troca de senha no sistema! Link: http://localhost/Estudando/System-Login/forgot-password?recoverPassword=' . $this->recoverPassword($emailRecoverPassword) . '</b>';
            $mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';

            // Envia o e-mail
            $mail->send();
            echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function recoverPassword($emailRecoverPassword)
    {
        $tokenRecover = $this->model->getRecoverPasswordByEmail($emailRecoverPassword)['recoverPassword'];
        return $tokenRecover;
    }

    public function handlePasswordUpdate()
    {
        $newPassword = $_POST['newPassword'] ?? null;
        $tokenRecover = $_GET['recoverPassword'] ?? false;

        if ($newPassword && $tokenRecover) {
            $insertNewPassword = $this->model->insertNewPasswordByToken($tokenRecover, $newPassword);
            return $insertNewPassword;
        }
        return false;
    }
}