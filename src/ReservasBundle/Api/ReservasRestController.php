<?php

namespace ReservasBundle\Api;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController as Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservasRestController extends Controller
{
    /**
     *
     * @param Request $request
     */
    public function postFindDisponibilidadAction(Request $request)
    {
        $datos  = $request->get('datos');

//        $em     = $this->getDoctrine()->getManager();
        var_dump($datos);

//        $disponibilidad = $em->getRepository('ReservasBundle:Reservas')->findDisponibilidad();
        $disponibilidad = $this->container->get('reservas.reservas')->findDisponibilidad();

    }
}
