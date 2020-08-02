<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\PaymentCalendar;
use App\Service\CsvWriter;
use App\Manager\FileManager;
use App\Service\WriterContext;

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
     * @param WriterContext $writer
     * @return Response
     */
    public function generateCsvFile(
        PaymentCalendar $paymentCalendar,
        WriterContext $writer

    ) {
        $csvWriter = $writer->getWriter('csv');
        $csvWriter->createFile($paymentCalendar);
        return $this->redirectToRoute('payroll_guard');
    }
}
