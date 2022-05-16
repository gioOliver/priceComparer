<?php

namespace App\Models;

Class Suplier
{
    protected $suplier;
    protected $item;
    protected $dentalFlossSubTotal = 0;
    protected $ibuprofenSubTotal = 0;
    protected $prices = [];

    public function __construct( $suplier )
    {
        $this->suplier = $suplier;
        $this->setPricesBySuplier();
    }

    public function getSuplier()
    {
        return $this->suplier;
    }

    public function setSuplier( $val )
    {
        $this->suplier = strtoupper($val);
    }

    /**
     * Set prices to supliers based on their names
     *
     * @return void
     */
    public function setPricesBySuplier():void
    {
        switch ($this->suplier)
        {
            case 'A':
                $this->prices = [
                    'dentalFloss'=>[
                        [
                            'quantity'  => 20,
                            'price'     => 160
                        ],
                        [
                            'quantity'  => 1,
                            'price'     => 9
                        ],
                    ],
                    'ibuprofen' => [
                        [
                            'quantity'  => 10,
                            'price'     => 48
                        ],
                        [
                            'quantity'  => 1,
                            'price'     => 5
                        ]
                    ]
                ];
                break;

            case 'B':
                $this->prices = [
                    'dentalFloss' => [
                        [
                            'quantity'  => 10,
                            'price'     => 71
                        ],
                        [
                            'quantity'  => 1,
                            'price'     => 8
                        ],
                    ],
                    'ibuprofen'=>[
                        [
                            'quantity'  => 100,
                            'price'     => 410
                        ],
                        [
                            'quantity'  => 5,
                            'price'     => 25
                        ],
                        [
                            'quantity'  => 1,
                            'price'     => 6
                        ]
                    ]
                ];
                break;

            default:
                $this->prices = [];
                break;
        }
    }

    public function setIbuprofenSubTotal( $ibuprofenSubTotal ): void
    {
        $this->ibuprofenSubTotal = $ibuprofenSubTotal;
    }

    public function setDentalFlossSubTotal( $dentalFlossSubTotal ): void
    {
        $this->dentalFlossSubTotal = $dentalFlossSubTotal;
    }

    public function getPrices(): array
    {
        return $this->prices;
    }

    /**
     * Return the sum of subtotals
     *
     * @return float
     */
    public function getTotal(): float
    {
        return $this->ibuprofenSubTotal + $this->dentalFlossSubTotal;
    }

}
