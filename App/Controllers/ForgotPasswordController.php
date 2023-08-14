<?php

namespace Controller;

use Model\ForgotPasswordModel;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class ForgotPasswordController extends Controller
{

    protected $model;

    public function __construct()
    {
       return $this->model = new ForgotPasswordModel;
    }

    public function index(){
        $this->handleToken();
        $this->getViewForgotPassword();
    }

    public function getViewForgotPassword(){
        $pathForgotPasswordTreated = PATH_BASE_VIEW . "ForgotPasswordView.php";
        echo $this->getView(
            $pathForgotPasswordTreated ,
            [
                'nameComplet' =>  'Mário do Vale',
            ] 
        );
    }

    public function createHash($email){
        $passwordUser = $this->model->getRecoverPassword($email)['password'];
        $passwordHash = !empty($passwordUser) ? password_hash($passwordUser, PASSWORD_DEFAULT) : "" ;
        return $passwordHash;
    }



    public function handleToken(){
        $emailRecoverPassword = !empty($_POST['emailRecover']) ? $_POST['emailRecover'] : NULL ;
        if(isset($emailRecoverPassword)){
            $createHash = $this->createHash($emailRecoverPassword);
            $insertToken = $this->model->insertTokenRecoverPassword($createHash, $emailRecoverPassword);
            $this->email();
        }
    }

    public function email(){
        $mail = new PHPMailer(true);
        $emailRecoverPassword = !empty($_POST['emailRecover']) ? $_POST['emailRecover'] : NULL ;
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
            $mail->addAddress("$emailRecoverPassword", 'Destinatário');
            $mail->isHTML(true); // Define o formato do e-mail como HTML
            $mail->Subject = 'Assunto';
            $mail->Body = 'Este é o corpo da mensagem <b>Olá em negrito!</b>';
            $mail->AltBody = 'Este é o corpo da mensagem para clientes de e-mail que não reconhecem HTML';
        
            // Envia o e-mail
            $mail->send();
            echo 'A mensagem foi enviada!';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}