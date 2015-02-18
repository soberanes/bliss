<?php

namespace Mailing\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        $notDao = $this->getServiceLocator()->get('mailer_sender_service');
        $notDao->sendPending();
        $viewModel = new ViewModel();
        $viewModel->setVariables(array('key' => 'value'))
                ->setTerminal(true);
        return $viewModel;
    }

}
