<?php

namespace Mailing;

class Module {

    // 018002880030

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'invokables' => array(
                'mailer_service' => 'Mailing\Service\MailerService',
                'mailer_sender_service' => 'Mailing\Service\MailerSenderService'
            ),
            'factories' => array(
                'mailer_module_options' => function ($sm) {
                    $config = $sm->get('Config');
                    return isset($config['mail_options'])?
                        $config['mail_options']:array();
                },
            )
        );
    }

}
