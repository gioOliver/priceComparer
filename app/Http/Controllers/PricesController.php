<?php

namespace App\Http\Controllers;

use App\Models\Suplier;
use Illuminate\Http\Request;

class PricesController extends Controller
{

    public function comparePrices( Request $request ): string
    {

        if(!$request->get('dentalFloss') && !$request->get('ibuprofen'))
            return 'You must sent at least one item';

        $suplier_a = new Suplier('A');
        $suplier_b = new Suplier('B');

        if ($request->get('dentalFloss'))
        {
            $suplier_a->setDentalFlossSubTotal($this->getSubTotals($suplier_a,'dentalFloss',$request->dentalFloss));
            $suplier_b->setDentalFlossSubTotal($this->getSubTotals($suplier_b,'dentalFloss',$request->dentalFloss));
        }

        if ($request->get('ibuprofen'))
        {
            $suplier_a->setIbuprofenSubTotal($this->getSubTotals($suplier_a,'ibuprofen',$request->ibuprofen));
            $suplier_b->setIbuprofenSubTotal($this->getSubTotals($suplier_b,'ibuprofen',$request->ibuprofen));
        }

        $diff = $suplier_a->getTotal() - $suplier_b->getTotal();

        if( $diff < 0 )
            $cheapier_suplier = $suplier_a;
        elseif( $diff > 0)
            $cheapier_suplier = $suplier_b;
        else
            return 'Both supliers got the same price: '.$suplier_a->getTotal();

        return "Suplier {$cheapier_suplier->getSuplier()} is cheapier: {$cheapier_suplier->getTotal()} EUR";
    }

    private function getSubTotals( Suplier $suplier, $item, $quantity ): float
    {
        $prices     = $suplier->getPrices();
        $sub_total  = 0;

        //pass throug suplier's prices and add them to subtotal when the quantity fits on quantity send by customer
        foreach ($prices[$item] as $price_item)
        {
            while($price_item['quantity'] <= $quantity)
            {
                $sub_total += $price_item['price'];
                $quantity -= $price_item['quantity'];
            }
        }

        return $sub_total;
    }
}
