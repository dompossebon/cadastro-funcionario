<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testindex()
    {
        $response = $this->get('employee-list');
        $response->assertStatus(200);
        $response->assertViewIs('listAll');
        $response->assertViewHas('employees');
        $this->assertIsNotArray($response);
        $this->assertIsObject($response);
    }

    public function testStore()
    {
        $request = [
            'id' => 1,
            'name' => 'Zeca da Silva',
            'email' => 'zeca@gmail.com',
            'phone' => '48999996666',
        ];
        $user = new User(['name' => 'Possebon']);
        $this->be($user);
        $response = $this->post('admin/employee-new-add', $request);
        $response->assertStatus(302); //redireciona para listAll apos gravar no banco
        $this->assertNotEmpty($response);
        $this->assertIsObject($response);
    }

    public function testFailEmptyStore()
    {
        $request = [];
        $user = new User(['name' => 'Possebon']);
        $this->be($user);
        $response = $this->post('admin/employee-new-add', $request);
        $response->assertStatus(302); //Obtem falha pq envia Dados Vazios e Redireciona
        $this->assertIsObject($response);
    }

    public function testFailStoreNotLogin()
    {
        $request = [];
        $response = $this->post('admin/employee-new-add', $request);
        $response->assertStatus(302); //Obtem falha(Não Logado) e Redireciona
        $this->assertIsObject($response);
    }

    public function testUpdate()
    {
        $request = [
            'id' => 1,
            'name' => 'Zeca da Silva',
            'email' => 'zeca@gmail.com',
            'phone' => '48999996666',
        ];

        $user = new User(['name' => 'Possebon']);
        $this->be($user);
        $response = $this->put('admin/employee/1/', $request);
        $response->assertStatus(302); //atualiza e é redirecionado para listAll
        $this->assertNotEmpty($response);
        $this->assertIsObject($response);
    }

    public function testFailEmptyUpdate()
    {
        $request = [];
        $user = new User(['name' => 'Possebon']);
        $this->be($user);
        $response = $this->put('admin/employee/1/', $request);
        $response->assertStatus(302); //Obtem falha(envia dados vazio) e Redireciona
        $this->assertIsObject($response);
    }

    public function testFailUpdateNotLogin()
    {
        $request = [
            'id' => 1,
            'name' => 'Zeca da Silva',
            'email' => 'zeca@gmail.com',
            'phone' => '48999996666',
        ];

        $response = $this->put('admin/employee/1/', $request);
        $response->assertStatus(302);//Obtem falha(Não Logado) e Redireciona
        $this->assertNotEmpty($response);
        $this->assertIsObject($response);
    }


    public function testDestroy()
    {
        $request = ['id' => 1];
        $user = new User(['name' => 'Possebon']);
        $this->be($user);
        $response = $this->delete('admin/employee-destroy/1', $request);
        $response->assertStatus(302);
    }

    public function testFailDestroy()
    {
        $request = ['id' => '']; //Não Passando ID
        $user = new User(['name' => 'Possebon']);
        $this->be($user);
        $response = $this->delete('admin/employee-destroy/', $request);
        $response->assertStatus(404); //Obtem falha (findOrFail) e Não Realiza o pedido
    }

    public function testFailDestroyNotLogin()
    {
        $request = ['id' => 1];
        $response = $this->delete('admin/employee-destroy/{id}', $request);
        $response->assertStatus(302);
    }

}
