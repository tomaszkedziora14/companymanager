<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\PaymentCalendar;
use App\Manager\PayrollManager;

class PayrollGuardController extends AbstractController
{
    /**
     * @Route("/payroll/guard", name="payroll_guard")
     * @param PaymentCalendar $paymentCalendar
     * @return Response
     */
    public function index(PaymentCalendar $paymentCalendar)
    {
        $paymentDays = $paymentCalendar->getAllPaymentDays();
        return $this->render('payroll_guard/index.html.twig', [
            'paymentDays' => $paymentDays
        ]);
    }

    /**
     * @Route("/csv", name="generate_csc")
     * @param PaymentCalendar $paymentCalendar
     * @return Response
     */
    public function generateCsvFile(PaymentCalendar $paymentCalendar)
    {
        $fp = fopen("../public/paymentdays.csv", 'w');
        $paymentDays = $paymentCalendar->getAllPaymentDays();
        foreach($paymentDays as $paymentDay){
            $list = [$paymentDay['month'],$paymentDay['nameDay'],$paymentDay['numDay']];
            fputcsv($fp,$list);
        }

        fclose($fp);
        $response = new Response();
        $response->headers->set('Content-Type', 'text/csv');
        if($response){
            return $this->redirectToRoute('payroll_guard');
        }
    }
}
