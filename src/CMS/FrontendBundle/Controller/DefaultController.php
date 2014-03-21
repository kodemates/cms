<?php

namespace CMS\FrontendBundle\Controller;

use CMS\FrontendBundle\Entity\Content;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(){
        $contents = $this->getDoctrine()->getRepository('CMSFrontendBundle:Content')
        ->findAll();

        return $this->render('CMSFrontendBundle:Default:index.html.twig', array('contents' => $contents));
    }

    public function showAction($id){
        $content = $this->getDoctrine()->getRepository('CMSFrontendBundle:Content')
            ->find($id);

$config = array
(
    'workflows' => array(
        //'delete' => 'my_delete_workflow_class'
    ),
    'types' => array(
	'CMS\\FrontendBundle\\Entity\\Content' => array(
	    'vocabularies' => array(
               'dcterms' => 'http://purl.org/dc/terms/',
               'sioc' => 'http://rdfs.org/sioc/ns#'
            ),
            'children' => array(
                'title' => array(
                    'property' => 'dcterms:title'
                ),
                'body' => array(
                    'property' => 'sioc:content'
                ),
            ),
	),
        'My\\Blog\\Model\\Article' => array(
            'config' => array(
                'storage' => 'some_db_table',
            ),
            'typeof' => 'sioc:Blog',
            'vocabularies' => array(
               'dcterms' => 'http://purl.org/dc/terms/',
               'sioc' => 'http://rdfs.org/sioc/ns#'
            ),
            'children' => array(
                'title' => array(
                    'property' => 'dcterms:title'
                ),
                'content' => array(
                    'property' => 'sioc:content'
                ),
            ),
        ),
    )
);

$object = $content;
$doctrineRegistry = $this->get('doctrine');
$mapper = new \Midgard\CreatePHP\Mapper\DoctrineOrmMapper($typeMap=array(), $doctrineRegistry, $name=null);
$loader = new \Midgard\CreatePHP\ArrayLoader($config);
$manager = $loader->getManager($mapper);
$entity = $manager->getEntity($object);

        return $this->render('CMSFrontendBundle:Default:show.html.twig', array('content' => $content, 'entity' => $entity));
    }
}
