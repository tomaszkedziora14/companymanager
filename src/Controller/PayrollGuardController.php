<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PaymentCalendar;
use App\Service\CsvWriter;
use App\Service\XlsxWriter;
use App\Strategy\WriterContext;

class PayrollGuardController extends AbstractController
{
    private $paymentCalendar;
    private $csvWriter;
    private $xlsxWriter;
    private $writerContext;

    public function __construct(
        PaymentCalendar $paymentCalendar,
        CsvWriter $csvWriter,
        XlsxWriter $xlsxWriter,
        WriterContext $writerContext
    ) {
        $this->paymentCalendar = $paymentCalendar;
        $this->csvWriter = $csvWriter;
        $this->xlsxWriter = $xlsxWriter;
        $this->writerContext = $writerContext;
    }

    /**
     * @Route("/payroll/guard", name="payroll_guard")
     */
    public function index()
    {
        $paymentDays = $this->paymentCalendar->getAllPaymentDays();
        return $this->render('payroll_guard/index.html.twig', [
            'paymentDays' => $paymentDays
        ]);
    }

    /**
     * @Route("/payroll/guard/csv", name="generate_csc")
     */
    public function generateCsvFile()
    {
        $this->writerContext->setWriter($this->csvWriter);
        $csv = $this->writerContext->getWriter();
        $csv->createFile($this->paymentCalendar);

        return $this->redirectToRoute('payroll_guard');
    }

    /**
     * @Route("/payroll/guard/xlsx", name="generate_xlsx")
     */
    public function generateXlsxFile()
    {
        $this->writerContext->setWriter($this->xlsxWriter);
        $xlsx = $this->writerContext->getWriter();
        $xlsx->createFile($this->paymentCalendar);

        return $this->redirectToRoute('payroll_guard');
    }
}
