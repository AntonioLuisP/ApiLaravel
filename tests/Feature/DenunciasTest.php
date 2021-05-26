<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Denuncia;

class DenunciasTest extends TestCase
{
    use RefreshDatabase;

    public function testDenunciaStore()
    {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiYXBpX2FnbG9tZXJhY2FvX3Nhb19sdWlzIiwiYXBwX25hbWUiOiJhcHBfYWdsb21lcmFjYW8iLCJzdGF0dXMiOiJhcHBfYWdsb21lcmFjYW9fb24ifQ==.1ovjpEp1H3TnYV8EpcjRwPwn34W9AIBKYJkc3oIHlSk=';
        // $this->withoutExceptionHandling();
        $response = $this->withHeaders([
            'Authorization'=> "Bearer ".$token
        ])->post('/api/denuncias/nova',[
            'den_geoposicao' => 'latitude: 0.0 longitude: 0.0',
            'den_quantidade_pessoas' => '499'
        ]);
        $response->assertStatus(201); 
        $this->assertCount(1, Denuncia::all());
    }

    public function testDenunciaStoreTokenInvalido()
    {
        $this->withoutExceptionHandling();
        $token = 'dadaddaddasds.dadsdadadadadada==.dadsdas=';
        $response = $this->withHeaders([
            'Authorization'=> "Bearer ".$token
        ])->post('/api/denuncias/nova',[
            'den_geoposicao' => 'latitude: 0.0 longitude: 0.0',
            'den_quantidade_pessoas' => '499'
        ]);
        $response->assertStatus(401); 
    }

    public function testDenunciaStoreValidation()
    {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lIjoiYXBpX2FnbG9tZXJhY2FvX3Nhb19sdWlzIiwiYXBwX25hbWUiOiJhcHBfYWdsb21lcmFjYW8iLCJzdGF0dXMiOiJhcHBfYWdsb21lcmFjYW9fb24ifQ==.1ovjpEp1H3TnYV8EpcjRwPwn34W9AIBKYJkc3oIHlSk=';
        // $this->withoutExceptionHandling();
        $response = $this->withHeaders([
            'Authorization'=> "Bearer ".$token
        ])->post('/api/denuncias/nova',[
            'den_observacao' => '1234567890123456789012345678901',
            'den_geoposicao' => 'a',
            'den_quantidade_pessoas' => '4asas'
        ]);              
        $response->assertSessionHasErrors(['den_observacao','den_geoposicao','den_quantidade_pessoas']);
    }

    public function testDenunciaTable()
    {
        Denuncia::create([
            'den_geoposicao' => 'muita gente na rua',
            'den_quantidade_pessoas' => '500',
        ]);
        // $this->withoutExceptionHandling();
        $this->assertDatabaseHas('denuncias', [
            'den_geoposicao' => 'muita gente na rua',
            'den_quantidade_pessoas' => '500',
        ]);
    }

}
