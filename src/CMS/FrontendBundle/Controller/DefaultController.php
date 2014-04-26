<?php

namespace CMS\FrontendBundle\Controller;

use Midgard\CreatePHP\RestService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(){
        $contents = $this->getDoctrine()->getRepository('CMSFrontendBundle:Content')
        ->findAll();

        return $this->render('CMSFrontendBundle:Default:index.html.twig', array('contents' => $contents));
    }

    public function putAction($id){
        $received_data = json_decode(file_get_contents("php://input"), true);
        $content = $this->get('content_handler')->update($received_data);
        return new Response();
    }

    public function showAction($id){
        $content = $this->getDoctrine()->getRepository('CMSFrontendBundle:Content')
            ->find($id);

        $entity = $this->get('content_handler')->getManager()->getEntity($content);

        return $this->render('CMSFrontendBundle:Default:show.html.twig', array('content' => $content, 'entity' => $entity));
    }

}
