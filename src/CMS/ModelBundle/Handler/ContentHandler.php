<?php
/**
 * Created by JetBrains PhpStorm.
 * User: root
 * Date: 4/24/14
 * Time: 10:03 PM
 * To change this template use File | Settings | File Templates.
 */

namespace CMS\ModelBundle\Handler;



use Midgard\CreatePHP\RestService;

class ContentHandler {

    public $manager;
    public $type;
    public $entity_manager;
    public $mapper;

    public function __construct($entity_manager)
    {

        $this->entity_manager = $entity_manager;

        $config = $this->getConfig();

        $loader = new \Midgard\CreatePHP\ArrayLoader($config);
        $this->mapper = new \Midgard\CreatePHP\Mapper\DoctrineOrmMapper($typeMap=array(
            'http://localhost:8000/contents' => 'CMS\\FrontendBundle\\Entity\\Content'
        ), $this->entity_manager, $name=null);
        $this->manager = $loader->getManager($this->mapper);
        $this->type = $this->manager->getType('CMS\\FrontendBundle\\Entity\\Content');
    }

    public function update($received_data)
    {
        $service = $this->manager->getRestHandler($received_data);
        $service->run($received_data, $this->type, null, RestService::HTTP_PUT);
        return $this->mapper->getBySubject(substr($received_data['@subject'],1,-1));
    }

    public function getContentById($id)
    {
        return $this->entity_manager->getRepository('CMSFrontendBundle:Content')
            ->find($id);
    }

    public function getManager()
    {
        return $this->manager;
    }

    function getConfig(){
        //https://github.com/flack/createphp/blob/master/documentation/tutorial.md
        return array
        (
            'workflows' => array(
                // 'delete' => 'stdClass', @todo delete workflow
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