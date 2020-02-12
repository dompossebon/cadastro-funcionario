@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h1>Formulario de Cadastro de Funcionário</h1></div>
                <div class="card-body">
                    <div class="form-ṕadrao">
                        {!! Form::open(['method' => 'post', 'route' => 'employeeNewAdd', 'files' => true, 'class' => 'form-padrao']) !!}
                        @include('templates.form.inputText', ['label' => 'Nome Completo', 'input' => 'name',
'attributes' => ['placeholder' => 'Nome Completo']])

                        @include('templates.form.inputEMail', ['label' => 'E-mail', 'input' => 'email',
'attributes' => ['placeholder' => 'E-mail']])

                        @include('templates.form.inputText', ['label' => 'Telefone', 'input' => 'phone',
'attributes' => ['pattern' => '[0-9]+$', 'maxlength' => '11', 'placeholder' => 'Apenas 11 números']])

                        @include('templates.form.inputFile', ['label' => 'Arquivo de Foto', 'input' => 'photo'])

                        @include('templates.form.submit', ['input' => 'Cadastrar'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
