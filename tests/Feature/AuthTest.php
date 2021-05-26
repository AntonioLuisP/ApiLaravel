<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Denuncia;
use App\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;//autenticação da view para caso user entre direto pela url
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;//criptografia

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    public function testDenunciaToken()
    {
        $this->withoutExceptionHandling();
        User::create([
            'cpf' => 'dadasdas',
            'name' => 'ANTPaciente',
            'email' => 'antonio@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
        $login = $this->withHeaders([
        ])->json('POST', route('login'),[
            'email' => 'antonio@gmail.com',
            'password' => '123456789'
        ]);
        $token = $login['access_token'];
        $response = $this->withHeaders([
            'Authorization' => "Bearer ".$token
        ])->json('GET', 'http://127.0.0.1:8080/api/denuncias');

        $response->assertStatus(200);
    }

    public function testDenunciaTokenInvalido()
    {
        $this->withoutExceptionHandling();

        $token = 'sahdiahdlkahdlasdç';
        $response = $this->withHeaders([
            'Authorization' => "Bearer ".$token
        ])->json('GET', 'http://127.0.0.1:8080/api/denuncias');

        $response->assertStatus(401);
    }
}
