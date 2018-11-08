<?php

namespace ReservasBundle\Controller;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\FOSRestController as Controller;
use ReservasBundle\Entity\Reservas;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ReservasController
 * @package ReservasBundle\Controller
 *
 * @Route("/reservas")
 */
class ReservasController extends Controller
{
    protected $numHabitaciones = 10;

    /**
     * @Route("/", name="")
     */
    public function indexAction()
    {
        return $this->render('ReservasBundle:Reservas:index.html.twig');
    }


    /**
     * @Route("/disponibilidad")
     *
     * @param Request $request
     * @return Response
     */
    public function postFindDisponibilidadAction(Request $request)
    {
        try {
            $data       = $request->get('datos');
            $llegada    = (isset($data['llegada']))?$data['llegada']:null;
            $salida     = (isset($data['salida']))?$data['salida']:null;

            if (is_null($llegada) || is_null($salida)) {
                throw new \Exception('Los datos no son correctos para la búsqueda');
            }

            $em         = $this->getDoctrine()->getManager();

            $disponibilidad = $em->getRepository('ReservasBundle:Reservas')->findDisponibilidad($llegada, $salida);

            if (($disponibilidad && count($disponibilidad) < $this->numHabitaciones) || !$disponibilidad) {
                $result   = array(
                    'error' => false,
                    'datos' => $disponibilidad
                );
            } else {
                throw new \Exception('No existe disponibilidad para las fechas señaladas');
            }


        } catch (\Exception $e) {
            $result = array(
                    'error'     => true,
                    'message'   => $e->getMessage(),
                    'code'      => $e->getCode()
            );
        }

        return new Response(json_encode($result));
    }

    /**
     * @Route("/precios")
     *
     * @return mixed
     */
    public function getPreciosTiposHabitacionAction(){
        $em         = $this->getDoctrine()->getManager();
        $precios    = $em->getRepository('ReservasBundle:PrecioTipoHab')->findPreciosTiposHabitacion();

        return new Response(json_encode($precios));
    }


    /**
     * @Route("/createreserva")
     *
     * @param Request $request
     * @return Response
     */
    public function postCreateReservaAction(Request $request) {
        try {
            $data       = $request->get('datos');

            $llegada    = (isset($data['llegada']))?$data['llegada']:null;
            $salida     = (isset($data['salida']))?$data['salida']:null;
            $tipohab    = (isset($data['tipoHabitacion']))?$data['tipoHabitacion']:null;
            $tipopens   = (isset($data['tipoPension']))?$data['tipoPension']:null;
            $precio     = (isset($data['precio']))?$data['precio']:null;
            $nombre     = (isset($data['nombre']))?$data['nombre']:null;
            $apellidos  = (isset($data['apellidos']))?$data['apellidos']:null;
            $email      = (isset($data['email']))?$data['email']:null;
            $telefono   = (isset($data['telefono']))?$data['telefono']:null;
            $numadultos = (isset($data['numAdultos']))?$data['numAdultos']:null;
            $numninos   = (isset($data['numNinos']))?$data['numNinos']:null;
            $numbebes   = (isset($data['numBebes']))?$data['numBebes']:null;

            $em             = $this->getDoctrine()->getManager();
            $misreservsa    =  $em->getRepository('ReservasBundle:Reservas')->finMisReservas($nombre, $apellidos, $email, $telefono);
            if (count($misreservsa) > 0) {
                $voucher    = $misreservsa[0]['voucher'];
            } else {
                $voucher    =  $em->getRepository('ReservasBundle:Reservas')->crearCodigo();
            }
            $reserva    = new Reservas();
            $newreserva = $em->getRepository('ReservasBundle:Reservas')->createReserva($reserva, $llegada, $salida, $tipohab,
                                                                                                $tipopens, $precio, $nombre, $apellidos,
                                                                                                $email, $telefono, $numadultos, $numninos,
                                                                                                $numbebes, $voucher);
            $em->persist($newreserva);

            if (!$em->flush()) {
                $result = array(
                    'error' => false,
                    'datos' => array(
                        'reserva'       => $newreserva->getId(),
                        'misreservas'   => $misreservsa
                    )
                );
            } else {
                throw new \Exception('Problemas al crear la reserva. ');
            }

        } catch (\Exception $e) {
            $result = array(
                'error'     => true,
                'message'   => $e->getMessage(),
                'code'      => $e->getCode()
            );
        }

        return new Response(json_encode($result));
    }

    /**
     * @Route("/misreservas")
     *
     * @param Request $request
     * @return Response
     */
    public function postFindMisReservasAction(Request $request) {
        $data       = $request->get('datos');
        $idreserva  = (isset($data['idreserva']))?$data['idreserva']:null;
        $voucher    = (isset($data['voucher']))?$data['voucher']:null;
        $apellidos  = (isset($data['apellido']))?$data['apellido']:null;
        $nombre  = (isset($data['nombre']))?$data['nombre']:null;
        $email  = (isset($data['email']))?$data['email']:null;

        $em             = $this->getDoctrine()->getManager();
        $misreservsa    =  $em->getRepository('ReservasBundle:Reservas')->finMisReservas($nombre, $apellidos, $email, null, $voucher , $idreserva);

        return new Response(json_encode($misreservsa));
    }
}
