<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\PaymentCalendar;
use App\Service\CsvWriter;
use App\Service\XlsxWriter;
use App\Service\WriterContext;

class PayrollGuardController extends AbstractController
{
    private $paymentCalendar;
    private $csvWrite;
    private $xlsxWriter;
    private $writerContex;

    public function __construct(
        PaymentCalendar $paymentCalendar,
        CsvWriter $csvWrite,
        XlsxWriter $xlsxWriter,
        WriterContext $writerContex
    ) {
        $this->paymentCalendar = $paymentCalendar;
        $this->csvWrite = $csvWrite;
        $this->xlsxWriter = $xlsxWriter;
        $this->writerContex = $writerContex;
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
        $this->writerContex->setWriter($this->csvWrite);
        $csv = $this->writerContex->getWriter();
        $csv->createFile($this->paymentCalendar);

        return $this->redirectToRoute('payroll_guard');
    }

    /**
     * @Route("/payroll/guard/xlsx", name="generate_xlsx")
     */
    public function generateXlsxFile()
    {
        $this->writerContex->setWriter($this->xlsxWriter);
        $xlsx = $this->writerContex->getWriter();
        $xlsx->createFile($this->paymentCalendar);

        return $this->redirectToRoute('payroll_guard');
    }
}
