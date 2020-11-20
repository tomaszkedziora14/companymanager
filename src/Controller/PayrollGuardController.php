<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Service\PaymentCalendar;
use App\Service\CsvWriter;
use App\Service\XlsxWriter;
use App\Manager\FileManager;
use App\Service\WriterContext;

class PayrollGuardController extends AbstractController
{
    /**
     * @Route("/payroll/guard", name="payroll_guard")
     * @param PaymentCalendar $paymentCalendar
     */
    public function index(PaymentCalendar $paymentCalendar)
    {
        $paymentDays = $paymentCalendar->getAllPaymentDays();
        return $this->render('payroll_guard/index.html.twig', [
            'paymentDays' => $paymentDays
        ]);
    }

    /**
     * @Route("/payroll/guard/csv", name="generate_csc")
     *
     * @param PaymentCalendar $paymentCalendar
     * @param WriterContext $writer
     */
    public function generateCsvFile(
        PaymentCalendar $paymentCalendar,
        CsvWriter $csvWriter,
        WriterContext $writer
    ) {
        $writer->setWriter($csvWriter);
        $csv = $writer->getWriter();
        $csv->createFile($paymentCalendar);
        return $this->redirectToRoute('payroll_guard');
    }

    /**
     * @Route("/payroll/guard/xlsx", name="generate_xlsx")
     *
     * @param PaymentCalendar $paymentCalendar
     * @param WriterContext $writer
     */
    public function generateXlsxFile(
        PaymentCalendar $paymentCalendar,
        xlsxWriter $xlsxWriter,
        WriterContext $writer
    ) {
        $writer->setWriter($xlsxWriter);
        $xlsx = $writer->getWriter();
        $xlsx->createFile($paymentCalendar);
        return $this->redirectToRoute('payroll_guard');
    }
}
