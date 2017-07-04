@extends('adminamazing::teamplate')

@section('pageTitle', 'Панель управления')
@section('content')
    <div class="row">
        <!-- Column -->
        <div class="col-lg-6">
            <div class="card">
                <div class="card-block">
                    <ul class="list-inline pull-right">
                        <li>
                            <h6 class="text-muted"><i class="fa fa-circle m-r-5 text-success"></i>Регистраций</h6>
                        </li>
                        <li>
                            <h6 class="text-muted"><i class="fa fa-circle m-r-5 text-info"></i>Транзакций</h6>
                        </li>
                    </ul>
                    <h4 class="card-title">Динамика</h4>
                    <div class="clear"></div>
                    <div class="total-revenue" style="height: 240px;"></div>
                </div>
            </div>
        </div>
        <!-- Column -->
        <div class="col-lg-6">
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-sm-6">
                    <div class="card card-block">
                        <!-- Row -->
                        <div class="row p-t-10 p-b-10">
                            <!-- Column -->
                            <div class="col p-r-0">
                                <h1 class="font-light">{{$CountAllUsers}}</h1>
                                <h6 class="text-muted">Новых клиентов</h6></div>
                            <!-- Column -->
                            <div class="col text-right align-self-center">
                                <div data-label="20%" class="css-bar m-b-0 css-bar-primary css-bar-20"><i class="mdi mdi-account-circle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-6">
                    <div class="card card-block">
                        <!-- Row -->
                        <div class="row p-t-10 p-b-10">
                            <!-- Column -->
                            <div class="col p-r-0">
                                <h1 class="font-light">248</h1>
                                <h6 class="text-muted">Подключеных сервисов</h6></div>
                            <!-- Column -->
                            <div class="col text-right align-self-center">
                                <div data-label="30%" class="css-bar m-b-0 css-bar-danger css-bar-20"><i class="mdi mdi-briefcase-check"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-6">
                    <div class="card card-block">
                        <!-- Row -->
                        <div class="row p-t-10 p-b-10">
                            <!-- Column -->
                            <div class="col p-r-0">
                                <h1 class="font-light">352</h1>
                                <h6 class="text-muted">Новых заявок</h6></div>
                            <!-- Column -->
                            <div class="col text-right align-self-center">
                                <div data-label="40%" class="css-bar m-b-0 css-bar-warning css-bar-40"><i class="mdi mdi-star-circle"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <div class="col-sm-6">
                    <div class="card card-block">
                        <!-- Row -->
                        <div class="row p-t-10 p-b-10">
                            <!-- Column -->
                            <div class="col p-r-0">
                                <h1 class="font-light">159</h1>
                                <h6 class="text-muted">Платежей в день</h6></div>
                            <!-- Column -->
                            <div class="col text-right align-self-center">
                                <div data-label="60%" class="css-bar m-b-0 css-bar-info css-bar-60"><i class="mdi mdi-receipt"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection