<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class PricesControllerTest extends TestCase
{

    public function test_example_1()
    {
        $request = [
            'dentalFloss' => 5,
            'ibuprofen' => 12
        ];
        $response = $this->post('/compare',$request );
        Log::info(json_encode($response));

        $response->assertStatus(200);
        $response->assertSee('Suplier B is cheapier: 102 EUR');
    }

    public function test_example_2()
    {
        $request = [
            'ibuprofen' => 105
        ];
        $response = $this->post('/compare',$request );
        Log::info(json_encode($response));
        $response->assertStatus(200);
        $response->assertSee('Suplier B is cheapier: 435 EUR');
    }

    public function test_suplier_a_cheapier()
    {
        $request = [
            'ibuprofen' => 3
        ];
        $response = $this->post('/compare',$request );
        Log::info(json_encode($response));
        $response->assertStatus(200);
        $response->assertSee('Suplier A is cheapier: 15 EUR');
    }

    public function test_same_values()
    {
        $request = [
            'ibuprofen' => 5
        ];
        $response = $this->post('/compare',$request );
        Log::info(json_encode($response));
        $response->assertStatus(200);
        $response->assertSee('Both supliers got the same price: 25');
    }
}
