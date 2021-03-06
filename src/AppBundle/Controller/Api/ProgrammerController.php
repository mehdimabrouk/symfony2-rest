<?php

namespace AppBundle\Controller\Api;

use AppBundle\Controller\BaseController;
use AppBundle\Entity\Programmer;
use AppBundle\Form\ProgrammerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Mehdi Mabrouk <m.mabrouk@esystema.fr>
 */


class ProgrammerController extends BaseController
{

    /**
     * @Route("/api/programmers")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $body = $request->getContent();

        $data = json_decode($body,true);

        $programmer = new Programmer();

        $form = $this->createForm(new ProgrammerType(),$programmer);

        $form->submit($data);
        $programmer->setUser($this->findUserByUsername('weaverryan'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($programmer);
        $em->flush();

        $response =  new Response('it work , api,201',201);
        $programmerUrl = $this->generateUrl('api_programmers_show',['nickname'=>$programmer->getNickname()]);
        $response->headers->set('Location',$programmerUrl);
        $response->headers->set('Content-type','application/json');

        return $response;
    }

    /**
     * @Route("/api/programmers/{nickname}",name="api_programmers_show")
     * @Method("GET")
     */
    public function showAction($nickname)
    {
        $programmer = $this->getDoctrine()->getRepository('AppBundle:Programmer')->findOneByNickname($nickname);
        if(!$programmer){
            throw $this->createNotFoundException(sprintf('no programmer with nickname %s',$nickname));
        }

        $data = [
            'nickname' => $programmer->getNickname(),
            'avantarNumber' => $programmer->getAvatarNumber(),
            'poswerLever' => $programmer->getPowerLevel(),
            'tagLine' => $programmer->getTagLine()
        ];

        $response =  new Response(json_encode($data),200);
        $response->headers->set('content-type','application/json');

        return $response;

    }

}