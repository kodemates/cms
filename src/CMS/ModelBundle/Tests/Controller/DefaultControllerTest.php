<?php

namespace CMS\ModelBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{

    public function testUpdateData()
    {
        $client = static::createClient();
        $container = $client->getContainer();

        $received_data['@subject'] = '<CMS\FrontendBundle\Entity\Content|id=1>';
        $received_data['@type'] = "<http://localhost:8000/contents>";
        $received_data['<http://localhost:8000/featured>'] = "1";
        $received_data['<http://localhost:8000/title>'] = "Lorem Ipsum";
        $received_data['<http://localhost:8000/author>'] = "Admin";
        $received_data['<http://localhost:8000/body>'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor.";

        $id = null;

        $content = $container->get('content_handler')->update($received_data);

        $this->assertInstanceOf('CMS\FrontendBundle\Entity\Content',$content);


    }
}
