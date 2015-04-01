<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mailing\Service;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\ServiceManager\ServiceManager;
use ZfcBase\EventManager\EventProvider;
use Zend\Mime\Message as MimeMessage;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Part as MimePart;
use Zend\Mail\Message;

class MailerService extends EventProvider implements ServiceManagerAwareInterface {

    /**
     *
     * @var string
     */
    protected $body;

    /**
     *
     * @var string
     */
    protected $from;

    /**
     *
     * @var string
     */
    protected $subject;

    /**
     *
     * @var string
     */
    protected $to;

    /**
     *
     * @var SmtpTransport
     */
    protected $transport;

    /**
     *
     * @var array
     */
    protected $optins;

    /**
     * @var ServiceManager
     */
    protected $serviceManager;

    /**
     * Set the service manager
     * 
     * @param \Zend\ServiceManager\ServiceManager $serviceManager
     * @return \Uploader\Service\ProcessFile
     */
    public function setServiceManager(ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    public function getServiceManager() {
        return $this->serviceManager;
    }

    public function send($from = null, $to = null, $subject = null, $body = null) {
        try {
            $this->setBody($body)->setFrom($from)->setSubject($subject)->setTo($to);
            $message = $this->getMessage();
            $transport = $this->getTransport();
            $transport->setOptions($this->getOptions());
            $transport->send($message);
            return true;
        } catch (\Zend\Mail\Protocol\Exception\RuntimeException $e) {
            return false;
        }
    }

    public function getMessage() {
        $message = new Message();
        $message->addTo($this->getTo())
                ->addFrom('noreply@petro-7.com.mx')
                ->setSubject($this->getSubject());
        // make a header as html  
        $html = new MimePart($this->getBody());
        $html->type = "text/html";
        $body = new MimeMessage();
        $body->setParts(array($html,));
        $message->setBody($body);
        return $message;
    }

    private function initTransport() {
        if (null === $this->transport) {
            $this->transport = new SmtpTransport();
        }
    }

    public function getOptions() {
        if (null === $this->optins) {
            $config = array(
                'host' => 'smtp.mandrillapp.com',
                'port' => 465, // Notice port change for TLS is 587
                'connection_class' => 'login',
                'connection_config' => array(
                    'username' => 'liderproyectos2@logoline.com.mx',
                    'password' => '63d81da3-ad93-431d-b3e6-105ecb766ad4',
                    'ssl' => 'ssl',
                ),
            );
            $this->optins = new SmtpOptions($config);
        }
        return $this->optins;
    }

    public function getBody() {
        return $this->body;
    }

    public function getFrom() {
        return $this->from;
    }

    public function getSubject() {
        return $this->subject;
    }

    public function getTo() {
        return $this->to;
    }

    public function setBody($body) {
        if (null !== $body) {
            $this->body = $body;
        }
        return $this;
    }

    public function setFrom($from) {
        if (null !== $from) {
            $this->from = $from;
        }
        return $this;
    }

    public function setSubject($subject) {
        if (null !== $subject) {
            $this->subject = $subject;
        }
        return $this;
    }

    public function setTo($to) {
        if (null !== $to) {
            $this->to = $to;
        }
        return $this;
    }

    public function getTransport() {
        if (null === $this->transport) {
            $this->initTransport();
        }
        return $this->transport;
    }

    public function setTransport($transport) {
        $this->transport = $transport;
        return $this;
    }

}
