<?php

namespace CMS\FrontendBundle\Controller;

use CMS\FrontendBundle\Entity\Content;
use Midgard\CreatePHP\RestService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(){
        $contents = $this->getDoctrine()->getRepository('CMSFrontendBundle:Content')
        ->findAll();

        return $this->render('CMSFrontendBundle:Default:index.html.twig', array('contents' => $contents));
    }

    public function putAction($id){
        $content = $this->getDoctrine()->getRepository('CMSFrontendBundle:Content')
            ->find($id);

        $config = $this->getConfig();

        $received_data = json_decode(file_get_contents("php://input"), true);
        $loader = new \Midgard\CreatePHP\ArrayLoader($config);
        $doctrineRegistry = $this->get('doctrine');
        $mapper = new \Midgard\CreatePHP\Mapper\DoctrineOrmMapper($typeMap=array(
            'http://localhost:8000/contents' => 'CMS\\FrontendBundle\\Entity\\Content'
        ), $doctrineRegistry, $name=null);
        $manager = $loader->getManager($mapper);
        $type = $manager->getType('CMS\\FrontendBundle\\Entity\\Content');
        $service = $manager->getRestHandler($received_data);
        $result = $service->run($received_data, $type, 15, RestService::HTTP_POST);
    }

    public function showAction($id){
        $content = $this->getDoctrine()->getRepository('CMSFrontendBundle:Content')
            ->find($id);

        $config = $this->getConfig();

        $doctrineRegistry = $this->get('doctrine');
        $mapper = new \Midgard\CreatePHP\Mapper\DoctrineOrmMapper($typeMap=array(), $doctrineRegistry, $name=null);
        $loader = new \Midgard\CreatePHP\ArrayLoader($config);
        $manager = $loader->getManager($mapper);
        $entity = $manager->getEntity($content);
///        var_dump($entity->__toString()); die;

        return $this->render('CMSFrontendBundle:Default:show.html.twig', array('content' => $content, 'entity' => $entity));
    }


    function getConfig(){
        //https://github.com/flack/createphp/blob/master/documentation/tutorial.md
        return array
        (
            'workflows' => array(
            ),
            'types' => array(
                'CMS\\FrontendBundle\\Entity\\Content' => array(
                    'config' => array(
                        'storage' => 'CMS\\FrontendBundle\\Entity\\Content',
                    ),
                    'typeof' => 'content:contents', // Vocabulary:
                    'vocabularies' => array(
                        'content' => 'http://localhost:8000/'
                    ),
                    'children' => array(
                        'title' => array(
                            'property' => 'content:title'
                        ),
                        'body' => array(
                            'property' => 'content:body'
                        ),

                        'author' => array(
                            'property' => 'content:author'
                        ),

                        'featured' => array(
                            'property' => 'content:featured'
                        ),
                    ),
                ),
            )
        );
    }
}
