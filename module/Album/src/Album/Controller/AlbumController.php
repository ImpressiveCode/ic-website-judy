<?php

namespace Album\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController {

    public function indexAction() {
        $em = $this->getServiceLocator()
                ->get('doctrine.entitymanager.orm_default');
        $data = $em->getRepository('Album\Entity\Album')->findAll();
        return new ViewModel(array(
            'albums' => $data,
        ));
    }

    public function addAction() {
        
    }

    public function editAction() {
        
    }

    public function deleteAction() {
        
    }

}