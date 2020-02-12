@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header"><h1>Formulario de Edição de Funcionário</h1></div>
                <div class="card-body">
                    <div class="form-ṕadrao">
                        @isset($employee->employeephoto[0]['photo'])
                            <img
                                src="{{ asset('storage/'.Str::after($employee->employeephoto[0]['photo'], 'public/')) }}"
                                alt="" width="300">
                        @else
                            Não Possui Foto
                        @endisset
                        {!! Form::open(['method' => 'put', 'files' => true, 'route' => ['employeeEditNow', $employee->id], 'class' => 'form-padrao']) !!}

                        @include('templates.form.inputText', ['value' => $employee->name, 'label' => 'Nome Completo', 'input' => 'name',
'attributes' => ['placeholder' => 'Nome Completo']])

                        @include('templates.form.inputEMail', ['value' => $employee->email, 'label' => 'E-mail', 'input' => 'email',
'attributes' => ['placeholder' => 'E-mail']])

                        @include('templates.form.inputText', ['value' => $phone, 'label' => 'Telefone', 'input' => 'phone',
'attributes' => ['pattern' => '[0-9]+$', 'maxlength' => '11', 'placeholder' => 'Apenas 11 números']])

                        @include('templates.form.inputFile', ['label' => 'Trocar Arquivo de Foto', 'input' => 'photo'])
                        @include('templates.form.submit', ['input' => 'Alterar'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
