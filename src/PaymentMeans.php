<?php

namespace CleverIt\UBL\Invoice;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use DateTime;

class PaymentMeans implements XmlSerializable
{
    private $paymentMeansCode = 1;
    private $paymentDueDate;
    private $payeeFinancialAccount;

    /**
     * @return mixed
     */
    public function getPaymentMeansCode()
    {
        return $this->paymentMeansCode;
    }

    /**
     * @param mixed $paymentMeansCode
     * @return PaymentMeans
     */
    public function setPaymentMeansCode($paymentMeansCode)
    {
        $this->paymentMeansCode = $paymentMeansCode;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getPaymentDueDate()
    {
        return $this->paymentDueDate;
    }

    /**
     * @param \DateTime $paymentDueDate
     * @return PaymentMeans
     */
    public function setPaymentDueDate(\DateTime $paymentDueDate)
    {
        $this->paymentDueDate = $paymentDueDate;
        return $this;
    }

    public function getPayeeFinancialAccount() {
        return $this->payeeFinancialAccount;
    }

    public function setPayeeFinancialAccount($payeeFinancialAccount) {
        $this->payeeFinancialAccount = $payeeFinancialAccount;
        return $this;
    }

    function xmlSerialize(Writer $writer)
    {
        $writer->write([
            'name' => Schema::CBC . 'PaymentMeansCode',
            'value' => $this->paymentMeansCode,
            'attributes' => [
                'listID' => 'UN/ECE 4461'
            ]
        ]);

        if ($this->getPaymentDueDate() !== null) {
            $writer->write([
                Schema::CBC . 'PaymentDueDate' => $this->getPaymentDueDate()->format('Y-m-d')
            ]);
        }

        if($this->payeeFinancialAccount != null){
            $writer->write([Schema::CAC . 'PayeeFinancialAccount' => $this->payeeFinancialAccount]);
        }
    }
}
