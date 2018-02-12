<?php


namespace Application;
use Zend\Mail\Message;
use Zend\Mail\Storage\Pop3;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use PHPUnit\Framework\Assert;


/*
 * Класс для описания почтового ящика
 */
class Email
{

    const PROTLOCOL_NAME_TLS = "tls";
    const PROTLOCOL_NAME_SSL = "ssl";
    const SERVER_PREFIX_SMTP = "smtp";
    const SERVER_PREFIX_POP3 = "pop";

    private $login;
    private $password;
    private $host;
    private $port;

    /**
     * Email constructor.
     * @param $login
     * @param $host
     * @param $password
     * @param $port
     */
    public function __construct($login, $host, $password, $port = NULL)
    {
        $this->login = $login;
        $this->host = $host;
        $this->password = $password;
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /*
     * Метод получения сооединения с сервером для обработки сообщений
     * @return $mail
     */
    public function getConnectionForFetching()
    {
        return $mail = new Pop3([
            'host' => $this->host,
            'user' => $this->login,
            'password' => $this->password,
            'ssl' => self::PROTLOCOL_NAME_SSL,
        ]);
    }

    /*
     * Метод удаления сообщения по номеру
     * @param $mail          Pop3   соединение с сервером
     * @param $messageNum    int    номер сообщения
     */
    public function removeMessage($mail, $messageNum)
    {
        $mail->removeMessage($messageNum);
    }

    /*
     * Метод отправки сообщения
     * @param $receiverEmail    Email     объект почтового ящика
     * @param $subject          string    тема сообщения
     * @param $body             string    тело сообщения
     */
    public function sendMessage($receiverEmail, $subject, $body)
    {

        $host = str_replace(self::SERVER_PREFIX_POP3, self::SERVER_PREFIX_SMTP, $this->host);
        $template = new Message();
        $template->addFrom($this->login);
        $template->addTo($receiverEmail->getLogin());
        $template->setSubject($subject);
        $template->setBody($body);
        $transport = new Smtp();
        $options = new SmtpOptions(array(
            'name' => $this->host,
            'host' => $host,
            'port' => $this->port,
            'connection_class' => 'login',
            'connection_config' => array(
                'username' => $this->login,
                'password' => $this->password,
                'ssl' => self::PROTLOCOL_NAME_TLS
            )
        ));
        $transport->setOptions($options);
        $transport->send($template);
    }


    /*
     * Метод ожидания сообщения с темой
     * @param $subject    string    тема сообщения
     * @param $sendTime   int       время отправки сообщения
     * $maxWaitTime       int       максимальное время ожидания письма
     */
    public function waitForMessageWithSubject($subject, $sendTime, $maxWaitTime)
    {
        $timeEnd = date($sendTime + $maxWaitTime);
        $isMessagePresent = FALSE;
        $lastMessageSubject = "";
        while (time() <= $timeEnd) {
            $mail = $this->getConnectionForFetching();
            $lastMessageIndex = count($mail);
            try {
                if (isset($mail->getMessage($lastMessageIndex)->subject)) {
                    $lastMessageSubject = $mail->getMessage($lastMessageIndex)->subject;
                    if (strstr($lastMessageSubject, $subject)) {
                        $isMessagePresent = TRUE;
                        break;
                    }
                }
            } catch (\Zend\Mail\Protocol\Exception\ExceptionInterface $e) {
                echo $e->getMessage();
            }
        }
        Assert::assertTrue($isMessagePresent, "Expected message did not appear. Expected subject:" . $subject . ", but actual:" . $lastMessageSubject);
    }


    public function isMessagePresent($mail, $messageNum, $template, $key)
    {
        $message = $mail->getMessage($messageNum);
        $content = utf8_decode(base64_decode($message->getContent()));
        preg_match_all($template, $content, $result);
        foreach($result as $lines){
        foreach($lines as $line) {
            if (strstr($line, $key)) {
                return TRUE;
            }
        }
        }
        return FALSE;
        }
}
