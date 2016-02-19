@include('partials.tools_modal',array('type'=>$type,'idHeader'=>encode($idHeader)))
<div class="container" style="width: 770px;">
    <div class="main">

        <div class="header">
            <div style="font-size: 90%; width: auto; height: auto; font-weight: bold;">
                DECLARACIÓN JURADA DE SALUD<br />
                SOLICITUD DE SEGURO DE DESGRAVAMEN HIPOTECARIO
            </div>
            <div style="font-size: 75%; width: auto; height: auto; font-weight: bold; margin-top: 3px;">
                Aprobada por R. A.- Nº 438 del 26 de Noviembre de 2009<br />
                COD. 207-934901-1999 11 003-3013<br />
                No de Certificado:{{ $cli->policy_number }}
            </div>
        </div>
        @var $i=1
        @foreach($cli->details as $titular)
            <div class="wrap">
                <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                    font-weight: bold; font-size: 75%;">DATOS PERSONALES: (TITULAR {{ $i }})</h2>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 13%; text-align: left;">Nombre Completo: </td>
                        <td style="width: 87%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->full_name }}
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 20%; text-align: left;">Lugar y fecha de Nacimiento: </td>
                        <td style="width: 80%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->place_residence }} {{ date('d-m-Y', strtotime($titular->client->birthdate)) }}
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 14%; text-align: left;">Carnet de Identidad:</td>
                        <td style="width: 25%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->dni }}
                        </td>
                        <td style="width: 5%; text-align: left;">Edad:</td>
                        <td style="width: 14%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->age }}
                        </td>
                        <td style="width: 5%; text-align: left">Peso:</td>
                        <td style="width: 14%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->weight }}
                        </td>
                        <td style="width: 5%; text-align: left;">Talla:</td>
                        <td style="width: 18%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->height }}
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 8%; text-align: left;">Dirección:</td>
                        <td style="width: 40%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->home_address }}
                        </td>
                        <td style="width: 8%; text-align: left">Tel. Dom.:</td>
                        <td style="width: 17%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->phone_number_home }}
                        </td>
                        <td style="width: 9%; text-align: left;">Tel. Oficina:</td>
                        <td style="width: 18%; border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->phone_number_office }}
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 8%; text-align: left;">Ocupación: </td>
                        <td style="width: 92%;  border-bottom: 1px solid #080808; text-align: left;">
                            {{ $titular->client->occupation_description }}
                        </td>
                    </tr>
                </table>
            </div>
            @var $i++
        @endforeach
        @if($i == 1)
            <div class="wrap">
                <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                    font-weight: bold; font-size: 75%;">DATOS PERSONALES: (TITULAR 2)</h2>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 14%; text-align: left;">Nombre Completo: </td>
                        <td style="width: 86%; border-bottom: 1px solid #080808; text-align: left;"></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 20%; text-align: left;">Lugar y fecha de Nacimiento: </td>
                        <td style="width: 80%; border-bottom: 1px solid #080808; text-align: left;"></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 15%; text-align: left;">Carnet de Identidad:</td>
                        <td style="width: 24%; border-bottom: 1px solid #080808; text-align: left;"></td>
                        <td style="width: 5%; text-align: left;">Edad:</td>
                        <td style="width: 14%; border-bottom: 1px solid #080808; text-align: left;"></td>
                        <td style="width: 5%; text-align: left">Peso:</td>
                        <td style="width: 14%; border-bottom: 1px solid #080808; text-align: left;"></td>
                        <td style="width: 5%; text-align: left;">Talla:</td>
                        <td style="width: 18%; border-bottom: 1px solid #080808; text-align: left;"></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 8%; text-align: left;">Dirección:</td>
                        <td style="width: 40%; border-bottom: 1px solid #080808; text-align: left;"></td>
                        <td style="width: 8%; text-align: left">Tel. Dom.:</td>
                        <td style="width: 17%; border-bottom: 1px solid #080808; text-align: left;"></td>
                        <td style="width: 9%; text-align: left;">Tel. Oficina:</td>
                        <td style="width: 18%; border-bottom: 1px solid #080808; text-align: left;"></td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 8%; text-align: left;">Ocupación: </td>
                        <td style="width: 92%;  border-bottom: 1px solid #080808; text-align: left;"></td>
                    </tr>
                </table>
            </div>
        @endif

        <div class="wrap">
            <h2 style="width: auto;	height: auto; text-align: left; padding: 0;
                font-weight: bold; font-size: 75%;">DEL CRÉDITO SOLICITADO:</h2>
            <h1 style="font-size: 80%; text-align: left;">Usted(es) solicita(n) el Seguro de tipo:</h1>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 20%; text-align: left;">Individual </td>
                    <td style="width: 10%;"><div class="input-check">&nbsp;</div></td>
                    <td style="width: 70%; text-align: left;">
                        si marca esta opción, sólo debe completar la información requerida
                        por el Titular 1
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: left;">Mancomunada </td>
                    <td style="width: 10%;"><div class="input-check">&nbsp;</div></td>
                    <td style="width: 70%; text-align: left;">
                        si marca esta opción, debe completar la información requerida
                        al Titular 1 y el Titular 2
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 17%; text-align: left;">Monto Actual Solicitado: </td>
                    <td style="width: 33%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $cli->amount_requested }} {{ $cli->currency }}.
                    </td>
                    <td style="width: 18%; text-align: left;">Monto Actual Acumulado: </td>
                    <td style="width: 32%; border-bottom: 1px solid #080808; text-align: left;">
                        @var $totalCumulus = 0
                        @foreach($cli->details as $detail )
                            @var $totalCumulus = $totalCumulus + $detail->cumulus
                        @endforeach
                        {{ $totalCumulus }} USD.
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 18%; text-align: left;">Plazo del presente crédito: </td>
                    <td style="width: 82%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $cli->term }} {{ $cli->type_term == 'D'? 'Días':$cli->type_term == 'M'? 'Meses':$cli->type_term == 'Y'? 'Años':'' }}
                    </td>
                </tr>
            </table>
        </div>

        <div class="wrap">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                font-weight: bold; font-size: 80%;">Cuestionario</h2>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 5%;"></td>
                    <td style="width: 71%;"></td>
                    @var $sum=1
                    @foreach($cli->details as $titular)
                        <td style="width: 12%;" align="right">Titular {{ $sum }}</td>
                        @var $sum++
                    @endforeach
                </tr>
                @var $sum=1
                @foreach($question as $key2 => $value)
                    <tr>
                        <td valign="top" style="width: 5%; text-align: center;">{{ $sum }}. </td>
                        <td style="width: 71%;">{{ $key2 }}</td>
                        @foreach($value as $result)
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                                    <tr>
                                        <td style="width: 80%;" align="right">
                                            {{ $result == 1 ? 'SI':'NO'}}
                                        </td>
                                        <td style="width: 20%; padding-left: 3px;">
                                            <div class="input-question"></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        @endforeach
                    </tr>
                    @var $sum++
                @endforeach
            </table>
            <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                font-weight: bold; font-size: 75%;">
                SI ALGUNA DE SUS RESPUESTAS ES AFIRMATIVA, SÍRVASE BRINDAR DETALLES:
            </h2>
            @var $sum=1
            @foreach($cli->details as $titular)
                <td style="width: 12%;" align="right">Titular </td>
                <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                    <tr>
                        <td style="width: 10%;">TITULAR {{ $sum }}: </td>
                        <td style="width: 90%;" class="border-bottom">
                            {{ $titular->response->observation }}
                        </td>
                    </tr>
                </table>
                @var $sum++
            @endforeach
        </div>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; font-size: 80%; margin-top: 4px;">
            Declaro haber contestado con total veracidad, máxima buena fe a todas las preguntas del
            presente cuestionario y no haber omitido u ocultado hechos y/o circunstancias que hubieran
            podido influir en la celebración del Contrato de Seguro. Relevo expresamente del secreto
            profesional y legal, a cualquier médico que me hubiese asistido y/o tratado de dolencias y
            le autorizo a revelar a Alianza Vida, Seguros y Reaseguros S.A. Todos los datos y antecedentes
            patológicos que pudiera tener o de los que hubiera adquirido conocimiento al prestarme sus
            servicios. Entiendo que de presentarse alguna eventualidad contemplada bajo la Póliza de
            Seguro como consecuencia de alguna enfermedad existente a la fecha de la firma de este documento
            o cuando haya alcanzado la edad límite estipulada en la Póliza, la Compañía Aseguradora quedará
            liberada de toda responsabilidad en lo que respecta a mí Seguro. Finalmente, declaro conocer en
            su totalidad lo estipulado en mi Póliza de Seguro.<br /><br />
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                <tr>
                    <td style="width: 5%;">Fecha:</td>
                    <td style="width: 29%;" class="border-bottom">
                        {{ date('d',strtotime($cli->date_issue))}} / {{ date('M',strtotime($cli->date_issue))}} / {{ date('Y',strtotime($cli->date_issue))}}
                    </td>
                    @foreach($cli->details as $titular)
                        <td style="width: 5%;">Firma:</td>
                        <td style="width: 28%;" class="border-bottom"></td>
                    @endforeach
                </tr>
                <tr>
                    <td colspan="2" style="width: 34%;"></td>
                    @var $sum=1
                    @foreach($cli->details as $titular)
                        <td style="width: 5%;"></td>
                        <td style="width: 28%; text-align: center;">TITULAR {{ $sum }}</td>
                        @var $sum++
                    @endforeach
                </tr>
            </table>
            <br />

            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                <tr>
                    <td style="width: 20%; text-align: left;">Monto aprobado por el banco</td>
                    <td style="width: 25%;" class="border-bottom">
                        {{ $cli->amount_requested }} {{ $cli->currency }}.
                    </td>
                    <td style="width: 20%;"></td>
                    <td style="width: 35%;" class="border-bottom">

                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="width: 45%;"></td>
                    <td style="width: 20%;"></td>
                    <td align="center" style="width: 35%;">Oficial de Crédito<br />Firma y Sello</td>
                </tr>
            </table>
        </div>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center; font-size: 80%;">
            ALIANZA VIDA, SEGUROS Y REASEGUROS S.A., LA PAZ: calle Juana Parada Nª 683 Esq. Calle 6
            (Zona Achumani) - Telf: (591 - 2)2793232, Fax: (591 - 2)2799191 <br />
            SANTA CRUZ: Av. Viedma N°19 Esq. Melchor Pinto - Telf: (591 - 3)3375656, Fax: (591 - 3)3375666
        </div>

        <page><div style="page-break-before: always;">&nbsp;</div></page>

        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <h1 style="width: auto;	text-align: center; font-weight: bold; font-size: 90%; margin: 0px;">
                NOMINACIÓN DE BENEFICIARIOS PARA GASTOS DE SEPELIO<br />
                COBERTURA COMPLEMENTARIA A LA PÓLIZA DE<br />
                SEGURO DE DESGRAVAMEN HIPOTECARIO ANUAL RENOVABLE
            </h1>
            <h4 style="width: auto;	text-align: center; font-weight: bold; font-size: 80%; margin: 0;">
                Aprobada por R. A.- Nº 106 Del 10 de Febrero de 2011<br />
                COD. 207-934901-1999 11 003-3002
            </h4>
            <br><br><br>
            @var $sum=1
            @foreach($cli->details as $titular)
                <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                    font-weight: bold; font-size: 80%;">DATOS PERSONALES:</h2>
                <h4 style="width: auto;	text-align: left; font-weight: bold; font-size: 80%; margin: 0;">
                    TITULAR {{ $sum }}
                </h4>
                <table cellpadding="0" cellspacing="0" border="0" class="table-borde12"
                       style="width: 100%; height: auto; font-size: 90%; font-family: Arial;">
                    <tr>
                        <td colspan="2" style="width: 100%; text-align: left;">
                            Nombres y Apellidos: {{ $titular->client->full_name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; text-align: left;">
                            CI: {{ $titular->client->dni }} {{ $titular->client->extension }}
                        </td>
                        <td style="width: 50%; text-align: left;">
                            Fecha de Nacimiento: {{ date('d-m-Y', strtotime($titular->client->birthdate)) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width: 100%; text-align: left;">
                            Domicilio: {{ $titular->client->home_address }}
                        </td>
                    </tr>
                </table><br><br>
                @var $sum++
            @endforeach

            <h1 style="width: auto;	text-align: center; font-weight: bold; font-size: 80%; margin: 0;">
                BENEFICIARIOS PARA GASTOS DE SEPELIO COBERTURA COMPLEMENTARIA A LA<br />
                PÓLIZA DE SEGURO DE DESGRAVAMEN HIPOTECARIO ANUAL RENOVABLE :
            </h1>
            <p style="text-align: center; font-size: 90%; font-weight: normal;">
                El asegurado de asignar como beneficiario para la cobertura adicional de sepelio a la persona<br />
                que a su fallecimiento recibirá el Capital que la Compañia otorga en esta cobertura.
            </p>



            <table cellpadding="0" cellspacing="0" border="0" class="table-borde12"
                   style="width: 100%; height: auto; font-size: 90%; font-family: Arial;">
                @var $sum=1
                @foreach($cli->details as $titular)
                    <tr>
                        <td style="width: 20%;">
                            <h3 style="width: auto; height: auto; font-weight: bold; font-size: 80%; margin: 0;">
                                TITULAR {{ $sum }}.
                            </h3>
                        </td>
                        <td style="width: 20%;"></td>
                        <td style="width: 20%;"></td>
                        <td style="width: 20%;"></td>
                        <td style="width: 20%;"></td>
                    </tr>
                    <tr>
                        <td align="center" style="width: 20%;">Apellido Paterno</td>
                        <td align="center" style="width: 20%;">Apellido Materno</td>
                        <td align="center" style="width: 20%;">Nombres</td>
                        <td align="center" style="width: 20%;">Parentesco</td>
                        <td align="center" style="width: 20%;">CI</td>
                    </tr>
                    <tr>
                        <td align="center" height="30" style="width: 20%;">{{ $titular->beneficiary->last_name }}</td>
                        <td align="center" style="width: 20%;">{{ $titular->beneficiary->mother_last_name }}</td>
                        <td align="center" style="width: 20%;">{{ $titular->beneficiary->first_name }}</td>
                        <td align="center" style="width: 20%;">{{ $titular->beneficiary->relationship }}</td>
                        <td align="center" style="width: 20%;">{{ $titular->beneficiary->full_dni }} </td>
                    </tr>
                    @var $sum++
                @endforeach
            </table><br><br>
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td style="width: 8%;"></td>
                    <td align="left" style="width: 7%;">
                        <h3 style="width: auto; height: auto; font-weight: bold; font-size: 80%; margin: 0;">
                            FECHA:
                        </h3>
                    </td>
                    <td style="width: 8%; text-align: center;" class="border-bottom">
                        {{ date('d',strtotime($cli->date_issue))}}
                    </td>
                    <td style="width: 1%;">/</td>
                    <td style="width: 10%; text-align: center;" class="border-bottom">
                        {{ date('M',strtotime($cli->date_issue))}}
                    </td>
                    <td style="width: 1%;">/</td>
                    <td style="width: 8%; text-align: center;" class="border-bottom">
                        {{ date('Y',strtotime($cli->date_issue))}}
                    </td>
                    <td style="width: 44%;"></td>
                </tr>
            </table><br><br><br><br>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 30%;" class="border-bottom">

                    </td>
                    <td style="width: 32%;"></td>
                    <td style="width: 30%;" class="border-bottom">

                    </td>
                    <td style="width: 4%;"></td>
                </tr>
                <tr>
                    @var $sum=1
                    @foreach($cli->details as $titular)
                        <td style="width: 4%;"></td>
                        <td align="center" style="width: 30%;">FIRMA TITULAR {{ $sum }}</td>
                        @var $sum++
                    @endforeach
                </tr>
                <tr>
                    <td style="width: 4%;">&nbsp;</td>
                    <td style="width: 30%;"></td>
                    <td style="width: 32%;"></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 4%;"></td>
                </tr>
                <tr>
                    <td style="width: 4%;">&nbsp;</td>
                    <td style="width: 30%;"></td>
                    <td style="width: 32%;"></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 4%;"></td>
                </tr>
                <tr>
                    <td style="width: 4%;">&nbsp;</td>
                    <td style="width: 30%;"></td>
                    <td style="width: 32%;" class="border-bottom">

                    </td>
                    <td style="width: 30%;"></td>
                    <td style="width: 4%;"></td>
                </tr>
                <tr>
                    <td style="width: 4%;"></td>
                    <td style="width: 30%;"></td>
                    <td style="width: 32%;" align="center">
                        Oficial de Crédito<br />Firma y Sello
                    </td>
                    <td style="width: 30%;"></td>
                    <td style="width: 4%;"></td>
                </tr>
            </table>
        </div>

        <page><div style="page-break-before: always;">&nbsp;</div></page>

        <h1 style="width: auto;	text-align: center; font-weight: bold; font-size: 100%; margin: 0;">
            CERTIFICADO DE COBERTURA AL CONTRATO DE SEGURO<br> DE DESGRAVAMEN
            HIPOTECARIO ANUAL RENOVABLE II
        </h1>
        <h4 style="width: auto;	text-align: center; font-weight: bold; font-size: 80%; margin: 0;">
            Aprobada por R.A.- ASFI No. 424 del 28 de Mayo de 2010 <br>
            COD. 207 - 934901 - 1999 11 003 - 4001
        </h4>
        <div align="right" style="padding-right: 50px; text-align: right; font-size: 80%;">DE-8850</div>
        <div class="wrap">
            <br>
            <p style="text-align: left;">
                Se deja expresa constancia mediante el presente certificado, que:
            </p>
            <p style="text-align: center; font-weight: bold;">
                POLICARPIO ARANDA AGUILAR ó PATRICIA SANDRA MAMANI MUÑOZ
            </p>
            <p style="text-align: left;">
                Ha sido admitido como integrante a la póliza Nº {{ $cli->policy_number }}  con efecto desde,
                {{ date('d-m-Y', strtotime($cli->created_at)) }}  y como prestatario de la FUNDACIÓN SARTAWI tiene derecho a
                las prestaciones del Contrato según sus reglas y condiciones.
            </p><br>
            <p style="font-weight: bold;">COBERTURAS</p>
            <ul style="list-style: disc; margin: 10px 0 10px 9px; width: 700px; text-align: left;">
                <li>
                    Muerte Natural o Accidental (excepto las expresamente  excluidas en
                    la REGLA VII RESTRICCIONES Y EXCLUSIONES)
                </li>
                <li>
                    Invalidez Total y Permanente por Accidente  y/o  Enfermedad
                </li>
                <li>
                    Gastos de Sepelio (Titular o Cónyuge)
                </li>
            </ul>
            <br>
            <p style="font-weight: bold; text-align: left;">TASA TOTAL MENSUAL</p>
            <p style="text-align: left;">
                Las primas serán canceladas por el “Tomador” cada mes vencido y a su vez el
                “Tomador” cargará el costo de este seguro por adelantado en las cuotas de
                amortización de cada prestatario acorde con su cronograma de pago.
            </p>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 25%; text-align: left;">
                        Tasa para el titular del crédito:
                    </td>
                    <td style="width: 25%; text-align: left;">
                        <span style="font-weight: bold;">Tasa {{ $adRates->rate_final }} %</span> (POR MIL) mensual
                    </td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left">
                        Tasa  mancomunada del crédito:
                    </td>
                    <td style="width: 25%; text-align: left;">
                        <span style="font-weight: bold;">Tasa 1,25 %</span> (POR MIL) mensual
                    </td>
                    <td style="width: 50%;"></td>
                </tr>
                <tr>
                    <td style="width: 25%; text-align: left;">
                        Tasa  codeudor del crédito:
                    </td>
                    <td style="width: 25%; text-align: left;">
                        <span style="font-weight: bold;">Tasa {{ $adRates->rate_final }} %</span> (POR MIL) mensual
                    </td>
                    <td style="width: 50%;"></td>
                </tr>
            </table><br>
            <p style="font-weight: bold; text-align: left;">CAPITAL ASEGURADO </p>
            <ul style="list-style: disc; text-align: left; margin: 10px 0 10px 10px; width: 700px;">
                <li>
                    Muerte Natural o Accidental
                    <br>Capital declarado según planillas mensuales presentadas por el Contratante
                </li>
                <li>
                    Invalidez Total y Permanente por Accidentes y/o Enfermedad
                    <br>Capital declarado según planillas mensuales presentadas por el Contratante
                </li>
            </ul>
            <br><br><br>
            <p style="text-align: center;">ALIANZA VIDA  SEGUROS Y REASEGUROS S.A.</p>
            <br>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 15%;"></td>
                    <td style="width: 30%;" align="center">
                        {{-- <img src="{{ asset('images/firma-1.jpg') }}" height="60"> --}}
                    </td>
                    <td style="width: 10%;"></td>
                    <td style="width: 30%;" align="center">
                        {{-- <img src="{{ asset('images/firma-2.jpg') }}" height="60"> --}}
                    </td>
                    <td style="width: 15%;"></td>
                </tr>
                <tr>
                    <td style="width: 15%;"></td>
                    <td style="width: 30%;" align="center">FIRMAS AUTORIZADAS</td>
                    <td style="width: 10%;"></td>
                    <td style="width: 30%;" align="center">FIRMAS AUTORIZADAS</td>
                    <td style="width: 15%;"></td>
                </tr>
            </table><br>
            <p style="text-align: center;">
                EN CASO DE SINIESTRO SÍRVASE CONTACTARSE CON  SU OFICIAL DE CREDITO U OFICINA MAS CERCANA
                DE FUNDACION SARTAWI  O LA COMPAÑÍA
            </p>
            <p style="text-align: center;">
                La adhesión a la presente póliza es de carácter voluntario y puede ser reemplazada por
                otra de similares características
            </p>
            <p style="text-align: center;">
                LA PAZ: calle Juana Parada Nª 683 Esq. Calle 6 (Zona Achumani) - Telf: (591 - 2)2793232,
                Fax: (591 - 2)2799191 <br />
                SANTA CRUZ: Av. Viedma N°19 Esq. Melchor Pinto - Telf: (591 - 3)3375656, Fax: (591 - 3)3375666
            </p>
        </div>

        <page><div style="page-break-before: always;">&nbsp;</div></page>

        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <h1 style="width: auto;	text-align: center; font-weight: bold; font-size: 90%; margin: 0;">
                REGLAS DEL CONTRATO DEL SEGURO DE DESGRAVAMEN HIPOTECARIO ANUAL RENOVABLE
            </h1>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;"
                        valign="top">

                        <span class="font-bold">Regla I.</span>
                        <span class="title-regla">DEFINICIONES</span><br />
                        <span style="text-decoration: underline;">EL ASEGURADOR:</span> Alianza Vida, Seguros
                        y Reaseguros S.A.<br>
                        <span style="text-decoration: underline;">TOMADOR DEL SEGURO:</span>
                        Fundación Sartawi<br>
                        <span style="text-decoration: underline;">ASEGURADOS:</span>
                        Prestatarios del “Tomador”, incluyendo a los cónyuges y codeudores, mediante el pago
                        de prima, que  figuren en los contratos de crédito y hayan sido aceptados por la
                        Compañía previa declaración jurada de salud.
                        <br>
                        <span style="text-decoration: underline;">BENEFICIARIO:</span>
                        Fundación Sartawi a título oneroso y/o el “Tomador” del seguro.<br />
                        <span style="text-decoration: underline;">COBERTURA DE MUERTE NATURAL O ACCIDENTAL:
                        </span> Este seguro cubre el saldo insoluto de la  deuda contraída por el Asegurado
                        con el “Tomador” mas intereses corrientes e interés punitorios a la muerte del
                        asegurado, siempre que la causa no haya sido excluida en el presente Contrato y el
                        Condicionado General.
                        <br>
                        <span style="text-decoration: underline;">COBERTURA COMPLEMENTARIA</span>
                        Cubre el saldo insoluto de la deuda contraída por el Asegurado mas intereses corrientes
                        e intereses punitorios, si por accidente o enfermedad quedase en forma total y
                        permanente incapacitado para ejecutar cualquier trabajo lucrativo o para dedicarse a
                        cualquier actividad de la que pueda derivar alguna utilidad y siempre que el carácter
                        de la invalidez sea reconocido según el Manual de Evaluación y Calificación del Grado
                        de Invalidez establecido en los arts. 24 y 62 del  D.S. 24469 de fecha 17/01/1997.
                        <br>
                        <span style="text-decoration: underline;">COBERTURA COMPLEMENTARIA</span> Cubre Gastos
                        de Sepelio, son gastos que demanden los herederos legales o nominados por el Sepelio
                        de un asegurado (titular o conyugue), como consecuencia del fallecimiento por una
                        enfermedad o un accidente cubierto para el Titular. Se otorgará un beneficio de
                        $us. 300.- ante el fallecimiento del Asegurado y/o conyugue (Así no se encuentre
                        asegurada, “Protección Familiar”). En el caso de mancomunos, se otorgará el beneficio
                        a la primera muerte, sea del titular o del conyugue.
                        <br>
                        <span class="font-bold">Regla II.</span>
                        <span class="title-regla">LIMITES DE EDAD:</span><br />
                        <span class="font-bold">2.01</span>  Para Muerte: Edad de Ingreso de 18 años (mínimo)
                        y 70 años (máximo) “hasta antes de cumplir los 71 años” al momento de inicio de la
                        Cobertura, permanencia hasta 75 años (hasta antes de cumplir los 76 años).
                        <br>
                        <span class="font-bold">2.02</span>  Para Invalidez: Edad de Ingreso de 18 años
                        (mínimo) y 64 años (máximo) “hasta antes de cumplir los 65 años” al momento de inicio
                        de la Cobertura, permanencia hasta 70 años (hasta antes de cumplir los 71 años).
                        <br>

                        <span class="font-bold">Regla III.</span>
                        <span class="title-regla">CONDICIONES DE ADHESIÓN DE LOS ASEGURADOS</span><br />
                        <span class="font-bold">3.01</span>   Podrán pertenecer al colectivo asegurado todos
                        los prestatarios que reúnan los requisitos o condiciones de adhesión en la fecha de
                        efecto o con posterioridad y figuren en la última planilla de declaración de asegurados
                        elaborada para tal efecto por el “Tomador” y que forma parte de la póliza.
                        <br>
                        <span class="font-bold">3.02</span>  Toda persona seleccionada para formar parte del
                        colectivo, a partir de la fecha de inicio de vigencia, debe rellenar un formulario de
                        declaración jurada de salud y la nominación de beneficiarios para la cobertura de
                        Sepelio.
                        <br>

                        <span class="font-bold">Regla IV.</span>
                        <span class="title-regla">INICIO DE VIGENCIA DE LA COBERTURA PARA CADA ASEGURADO</span>
                        <br>
                        <span class="font-bold">4.01</span>  Operaciones de Crédito por Préstamos de dinero:
                        desde la fecha de desembolso por parte del “Tomador”, previo cumplimiento de los
                        requisitos de asegurabilidad.
                        <br>

                        <span class="font-bold">Regla V.</span>
                        <span class="title-regla">PÉRDIDA DE LA CONDICIÓN DE PERTENENCIA AL GRUPO</span><br />
                        <span class="font-bold">5.01</span>   La condición de miembro del colectivo terminará
                        en la fecha que finalice la obligación contraída por el prestatario con el “Tomador”
                        del presente seguro.
                        <br>
                        <span class="font-bold">5.02</span>  Si un miembro sobrepasa la edad límite de
                        permanencia estipulada en 71 años (para muerte) y en 66 años (para invalidez) dejará
                        de pertenecer al seguro colectivo.
                        <br>
                        <span class="font-bold">5.03</span>  La cobertura por el presente seguro finalizará
                        en la fecha en que el asegurado deje de pagar la prima correspondiente al asegurado
                        individual.
                        <br>
                        <span class="font-bold">Regla VI.</span>
                        <span class="title-regla">LA PÓLIZA</span><br />
                        <span class="font-bold">6.01</span>   No se pagará ninguna indemnización conforme a
                        estas reglas si la suma asegurada correspondiente no resultara pagadera con arreglo a
                        las condiciones de la Póliza.   Cualquier miembro puede examinar la póliza si lo cree
                        oportuno, previa coordinación con el “Tomador”.
                        <br>
                        <span class="font-bold">Regla VII.</span>
                        <span class="title-regla">MODIFICACIÓN O TERMINACIÓN</span><br />
                        <span class="font-bold">7.01</span>   El “Tomador” se reserva el derecho de modificar
                        estas reglas y los términos de la póliza al vencimiento de cada anualidad de acuerdo
                        al resultado arrojado por la póliza al vencimiento de 	cada periodo.
                        <br>
                        <span class="font-bold">7.02</span>  El “Tomador” y el “Asegurador” se reservan el
                        derecho de finalizar el Contrato.
                        <br>
                        <span class="font-bold">Regla VIII.</span>
                        <span class="title-regla">RESTRICCIONES Y EXCLUSIONES</span><br>
                        Este Seguro no será aplicable en ninguna de las siguientes circunstancias:
                        <!---->
                    </td>
                    <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;"
                        valign="top">

                        <span class="font-bold">8.01</span>   Si  el  Asegurado  participa  como  conductor
                        o  acompañante  en  competencias  de automóviles, motocicletas, lanchas a motor,
                        aviones, avionetas, prácticas  de paracaidismo, aladeltismo, cacería de cualquier
                        tipo u otra actividad que represente alto riesgo.
                        <br>
                        <span class="font-bold">8.02</span>  Si el Asegurado realiza operaciones o viajes
                        submarinos o en transportes aéreos no autorizados para el transporte de pasajeros,
                        vuelos no regulares.
                        <br>
                        <span class="font-bold">8.03</span>  Enfermedades preexistentes conocida al inicio
                        del seguro o enfermedad congénita, para créditos mayores a $us. 5.001,00.-
                        <br>
                        <span class="font-bold">8.04</span>  Sida / HIV para siniestros a partir de $us.
                        5.001,00.-<br>
                        <span class="font-bold">8.05</span>  Si el Asegurado participa como elemento activo
                        en guerra internacional o civil, rebelión, sublevación, guerrilla, huelgas, invasión,
                        revolución, motín o hechos que las leyes califiquen como delitos contra la seguridad
                        del Estado.
                        <br>
                        <span class="font-bold">8.06</span>  Suicidio realizado por el Asegurado dentro del
                        segundo a&ntilde;o de vigencia de su cobertura. En consecuencia este riesgo quedará
                        cubierto a partir del primer día del tercer a&ntilde;o de vigencia para cada Asegurado.
                        <br>
                        <span class="font-bold">8.07</span>  Guerra, invasión, actos de enemigos extranjeros,
                        hostilidades u operaciones bélicas, sea que haya habido declaración de guerra, guerra
                        civil, insurrección, sublevación, rebelión, sedición, motín o conmoción contra orden
                        público, dentro o fuera del país, así como cuando el asegurado participe activamente
                        en actos subversivos, terroristas o delincuenciales.
                        <br>
                        <span class="font-bold">8.08</span>  Fisión o fusión nuclear, contaminación
                        radioactiva.<br>
                        <span class="font-bold">8.09</span>  Acto delictuoso cometido en calidad de autor o
                        cómplice, por un beneficiario o quien pudiere reclamar la indemnización.
                        <br>
                        <span class="font-bold">Regla IX.</span>
                        <span class="title-regla">PROCEDIMIENTO EN CASO DE SINIESTROS</span><br />
                        En caso de siniestros contemplados bajo el presente contrato, el asegurado debe
                        presentar:<br>
                        <span class="font-bold">Para siniestros hasta $us. 5.000,00.-</span>
                        <br>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(a)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Certificado de Defunción (para el Área Rural certificado de cualquier
                                    autoridad local con la certificación del Jefe de agencia)
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(b)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Fotocopia del Certificado de nacimiento y/o fotocopia de la cédula
                                    de identidad y/o carnet de identidad RUN y/o libreta de servicio militar.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(c)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Estado de cuenta saldo deudor.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(d)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Para  el  caso  de  Invalidez:  Certificado  INSO (Instituto  Nacional
                                    de  Salud Ocupacional) o en su defecto de otra institución que esté
                                    debidamente autorizada por la Autoridad Competente, la cual determine
                                    el grado de invalidez.
                                </td>
                            </tr>
                        </table>
                        <span class="font-bold">Para siniestros de $us. 5.001,00.- en adelante:</span><br>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(a)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Certificado de Defunción (para el Área Rural certificado de cualquier
                                    autoridad local con la certificación del Jefe de agencia)
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(b)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Fotocopia del Certificado de nacimiento y/o fotocopia de la cédula de
                                    identidad y/o carnet de identidad RUN y/o libreta de servicio militar.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(c)</td>
                                <td style="width: 90%; text-align: justify;">Estado de cuenta saldo deudor.</td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(d)</td>
                                <td style="width: 90%; text-align: justify;">Historia Clínica si existiera.</td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(e)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Para  el  caso  de  Invalidez:  Certificado  INSO
                                    (Instituto  Nacional  de  Salud Ocupacional) o en su defecto de otra
                                    institución que esté debidamente autorizada por la Autoridad Competente,
                                    la cual determine el grado de invalidez.
                                </td>
                            </tr>
                        </table>
                        <span class="font-bold">Para sepelio:</span>
                        <br>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(a)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Fotocopia del Certificado de nacimiento y/o fotocopia de la cédula de
                                    identidad del Asegurado y/o carnet de identidad RUN y/o libreta de
                                    servicio militar.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(b)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Fotocopia de cédula de identidad del Beneficiario y/o Fotocopia del
                                    certificado de nacimiento y/o carnet de identidad RUN y/o libreta de
                                    servicio militar.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(c)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Certificado de Defunción (para el Área Rural certificado de cualquier
                                    autoridad local con la certificación del Jefe de agencia)
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(d)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Declaratoria de Beneficiarios o declaratoria de herederos (en caso de no
                                    existir la nominación de los mismos)
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 10%; text-align: center;" valign="top">(e)</td>
                                <td style="width: 90%; text-align: justify;">
                                    Carta de los beneficiarios solicitando el beneficio.
                                </td>
                            </tr>
                        </table>
                        <!---->
                    </td>
                </tr>
            </table>
            <br />
            <p style="text-align: center; font-size: 80%;">
                LA PAZ: calle Juana Parada Nª 683 Esq. Calle 6 (Zona Achumani) - Telf: (591 - 2)2793232,
                Fax: (591 - 2)2799191 <br>
                SANTA CRUZ: Av. Viedma N°19 Esq. Melchor Pinto - Telf: (591 - 3)3375656, Fax: (591 - 3)3375666
            </p>
        </div>

    </div>
</div>
@if($flag > 0 && ! is_null($viDetail))
<hr />
<div class="container" style="width: 770px;">
    <div class="main">
        <div class="header">
            <div style="font-size: 80%; width: auto; height: auto; font-weight: bold; text-align: center;">
                DECLARACIÓN JURADA DE SALUD <br>
                SOLICITUD DE SEGURO MASIVO VIDA INDIVIDUAL DE CORTO PLAZO
            </div>
            <div style="font-size: 70%; width: auto; height: auto; margin-top: 3px; text-align: center;">
                Formato aprobado por la Autoridad de Fiscalización y Control de Pensiones y
                Seguros – APS  mediante Resolución Administrativa APS/DS/No.687-2013 <br>
                Código 206-934215-2013 07 035 3001
            </div>
            <div style="font-size: 70%; width: auto; height: auto; font-weight: bold; margin-top: 3px;
                 text-align: center;">
                El interesado solicita  a Nacional Vida Seguros de Personas S.A, un seguro
                de vida, basado en las declaraciones que siguen a continuación, las mismas
                que formaran parte integrante e indivisible de la póliza:
            </div>
        </div>
        <div class="wrap">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: 70%;">I.	DATOS PERSONALES DEL SOLICITANTE:</div>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 14%; text-align: left;">Nombre del Tomador: </td>
                    <td style="width: 86%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->taker_name }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 15%; text-align: left;">Nombre del Asegurado: </td>
                    <td style="width: 85%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->full_name }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 14%; text-align: left;">Lugar de Nacimiento:</td>
                    <td style="width: 32%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->place_residence }}
                    </td>
                    <td style="width: 14%; text-align: left;">Fecha de Nacimiento:</td>
                    <td style="width: 37%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ date('d-m-Y', strtotime($viDetail->client->birthdate)) }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 18%; text-align: left;">No Documento de Identidad:</td>
                    <td style="width: 13%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->dni }}
                    </td>
                    <td style="width: 8%; text-align: left;">Expedido en:</td>
                    <td style="width: 19%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->extension }}
                    </td>
                    <td style="width: 4%; text-align: left;">Edad:</td>
                    <td style="width: 9%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->age }}
                    </td>
                    <td style="width: 4%; text-align: left;">Peso:</td>
                    <td style="width: 9%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 7%; text-align: left;">Estatura:</td>
                    <td style="width: 9%; border-bottom: 1px solid #080808;">
                        {{ $viDetail->client->height }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 12%; text-align: left;">Dirección Domicilio:</td>
                    <td style="width: 38%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->home_address }}
                    </td>
                    <td style="width: 12%; text-align: left;">Correo Electronico</td>
                    <td style="width: 38%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->email }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 12%; text-align: left;">Teléfono Domicilio:</td>
                    <td style="width: 28%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->phone_number_home }}
                    </td>
                    <td style="width: 11%; text-align: left;">Teléfono Oficina:</td>
                    <td style="width: 19%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->phone_number_office }}
                    </td>
                    <td style="width: 11%; text-align: left;">Teléfono Celular:</td>
                    <td style="width: 19%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->phone_number_mobile }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 12%; text-align: left;">Actividad Laboral</td>
                    <td style="width: 88%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->occupation_description }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 12%; text-align: left;">Lugar de Trabajo</td>
                    <td style="width: 88%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->business_address }}
                    </td>
                </tr>
            </table>
        </div>
        <div class="wrap">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: 70%;">II. ELECCION DEL PLAN</div>
            <div style="font-size: 75%; text-align: left; margin: 2px 0;">1. Planes del Seguro</div>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 75%; background: #000; color: #fff; text-align: center;
                        height: 15px; border: 1px solid #000;" colspan="2">
                        Expresado en Bolivianos
                    </td>
                    <td style="width: 15%;"></td>
                </tr>
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 55%; background: #353535; color: #fff; height: 15px;
                        border: 1px solid #000; text-align: left;">
                        Coberturas
                    </td>
                    <td style="width: 20%; background: #353535; color: #fff;
                        border: 1px solid #000; text-align: left;">
                        Rangos de Capitales
                    </td>
                    <td style="width: 15%;"></td>
                </tr>
                @foreach(json_decode($viHeader->plan->plan) as $plan)
                    <tr>
                        <td style="width: 10%;"></td>
                        <td style="width: 55%; background: #000; color: #fff; border: 1px solid #080808;
                            text-align: left;">
                            {{ $plan->cov }}
                        </td>
                        <td style="width: 20%; border: 1px solid #080808;">
                            Hasta Bs. {{number_format( $plan->rank , 0, '.', ',')}}&nbsp;
                        </td>
                        <td style="width: 15%;"></td>
                    </tr>
                @endforeach

            </table>
        </div>
        <div class="wrap">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: 70%;">III. BENEFICIARIO</div>
            <div style="font-size: 75%; text-align: left; margin: 2px 0;">Beneficiarios:</div>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">

                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%; background: #000; color: #fff; text-align: center;
                        height: 10px; padding-top: 5px;" >

                    </td>
                    <td style="width: 35%; background: #000; color: #fff; text-align: center;
                        padding-top: 5px; border: 1px solid #000;" >
                        Nombre Completo
                    </td>
                    <td style="width: 10%; background: #000; color: #fff; text-align: center;
                        padding-top: 5px; border: 1px solid #000;" >
                        Parentesco
                    </td>
                    <td style="width: 15%; background: #000; color: #fff; text-align: center;
                        padding-top: 5px; border: 1px solid #000;" >
                        Carnet de Identidad
                    </td>
                    <td style="width: 10%; background: #000; color: #fff; text-align: center;
                        padding-top: 5px; border: 1px solid #000;" >
                        Proporcion (%)
                    </td>
                    <td style="width: 10%;"></td>
                </tr>
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%; background: #000; color: #fff; text-align: center;
                        height: 10px; padding-top: 2px; border: 1px solid #000;" >

                    </td>
                    <td style="width: 35%; border: 1px solid #000; text-align: center;
                        padding-top: 2px;" >

                    </td>
                    <td style="width: 10%; border: 1px solid #000; text-align: center;
                        padding-top: 2px;" >

                    </td>
                    <td style="width: 15%; border: 1px solid #000; text-align: center;
                        padding-top: 2px;" >

                    </td>
                    <td style="width: 10%; border: 1px solid #000; text-align: center;
                        padding-top: 2px;" >

                    </td>
                    <td style="width: 10%;"></td>
                </tr>

            </table>
        </div>
        <div class="wrap">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: 70%;">IV. CUESTIONARIO DE SALUD: (Marque con una X si corresponde)
            </div>
            <div style="font-size: 70%; text-align: left; margin: 2px 0;">
                1. ¿Usted padece de alguna de las siguientes enfermedades?
            </div>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 10%; "></td>
                    <td style="width: 20%; height: 5px; padding: 5px; text-align: left;">
                        Cáncer
                    </td>
                    <td style="width: 5%; padding: 2px 0; " >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 15%;"></td>
                    <td style="width: 25%; padding: 5px; text-align: left;">
                        Sida
                    </td>
                    <td style="width: 5%; padding: 2px 0;" >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 20%; "></td>
                </tr>
                <tr>
                    <td style="width: 10%; "></td>
                    <td style="width: 20%; height: 5px; padding: 5px; text-align: left;">
                        Diabetes
                    </td>
                    <td style="width: 5%; padding: 2px 0; " >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 15%;"></td>
                    <td style="width: 25%; padding: 5px; text-align: left;">
                        Enfermedades del Corazón
                    </td>
                    <td style="width: 5%; padding: 2px 0; " >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 20%; "></td>
                </tr>
                <tr>
                    <td style="width: 10%; "></td>
                    <td style="width: 20%; height: 5px; padding: 5px; text-align: left;">
                        Insuficiencia Renal
                    </td>
                    <td style="width: 5%; padding: 2px 0; " >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 15%;"></td>
                    <td style="width: 25%; padding: 5px; text-align: left;">
                        Enfermedades Cerebro Vasculares
                    </td>
                    <td style="width: 5%; padding: 2px 0; " >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 20%; "></td>
                </tr>
            </table>
        </div>
        <div class="wrap">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: 70%;">V. FORMA DE PAGO </div>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 10%; "></td>
                    <td style="width: 20%; height: 5px; padding: 5px; text-align: left;">
                        {{ $viHeader->payment_method = 'DA'?'Debito Automatico':'Pago al Contado'}}
                    </td>
                    <td style="width: 5%; padding: 2px 0; " >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 20%; "></td>
                </tr>
            </table>
        </div>
        <div class="wrap">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: 70%;">VI. PERIODICIDAD</div>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 10%; "></td>
                    <td style="width: 20%; height: 5px; padding: 5px; text-align: left;">
                        {{ $viHeader->period = 'Y'?'Pago Anual':'Pago Mensual'}}
                    </td>
                    <td style="width: 5%; padding: 2px 0; " >
                        <div class="input-check">&nbsp;</div>
                    </td>
                    <td style="width: 20%; "></td>
                </tr>
            </table>
        </div>
        <div class="wrap">
            <div style="font-size: 75%; text-align: left; margin: 2px 0;">
                Debito en Cuenta de la Entidad Financiera
            </div>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 20%; background: #000; color: #fff;
                        height: 10px; padding-top: 5px;" >
                        Número de Cuenta 1
                    </td>
                    <td style="width: 40%; padding-top: 5px; padding-left: 5px;
                        border-bottom: 1px solid #000;" >
                        1071022974
                    </td>
                    <td style="width: 30%; border-left: 1px solid #000;"></td>
                </tr>
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 20%; background: #000; color: #fff;
                        height: 10px; padding-top: 5px;" >
                        Número de Cuenta 2
                    </td>
                    <td style="width: 40%; padding-top: 5px; padding-left: 5px;
                        border-bottom: 1px solid #000;" >

                    </td>
                    <td style="width: 30%; border-left: 1px solid #000;"></td>
                </tr>
                <tr>
                    <td style="width: 10%;"></td>
                    <td style="width: 20%; background: #000; color: #fff;
                        height: 10px; padding-top: 5px;" >
                        Tarjeta de Crédito
                    </td>
                    <td style="width: 40%; padding-top: 5px; padding-left: 5px;
                        border-bottom: 1px solid #000;" >

                    </td>
                    <td style="width: 30%; border-left: 1px solid #000;"></td>
                </tr>
            </table>
        </div>
        <div class="text_contenido">
            Declaro haber contestado con total veracidad y máxima buena fe a todas las preguntas del presente
            cuestionario y no haber omitido u ocultado hechos y/o circunstancias que hubieran podido influir en la
            celebración del contrato de seguro, las mismas que son completas y verídicas.
            <br>
            Las declaraciones de salud que hacen anulable el Contrato de Seguros y por las que el asegurado pierde
            su derecho a indemnización, se enmarcan en los artículos 992: OBLIGACION DE DECLARAR; 993: RETICENCIA
            O INEXACTTUD; 994: AUSENCIA DE DOLO; 999: DOLO O MALA FE; 1038: PERDIDA AL DERECHO DE LA INDEMNIZACION;
            1138: IMPUGNACION DEL CONTRATO; 1140: ERROR EN LA EDAD DEL ASEGURADO, del Código de Comercio.
            <br>
            Por la presente acepto que esta solicitud no es un contrato de seguro y que este solo existirá si se
            emite y entrega el Certificado de Cobertura de acuerdo con esta solicitud y los reglamentos de Seguros
            Masivos autorizados por la APS.
            <br>
            Autorizo a Médicos, Clínicas e Institutos de Salud para suministrar a Nacional Vida Seguro de Personas
            S.A., todos los datos que requiera sobre mi estado de salud antes o después de mi fallecimiento.
        </div>
        <br><br>
        <div class="wrap">
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 5%; ">
                        Fecha:
                    </td>
                    <td style="width: 35%; height: 5px; border-bottom: 1px solid #080808;" >&nbsp;
                       {{ date('d-m-Y', strtotime($viHeader->date_issue)) }}
                    </td>
                    <td style="width: 5%;" >
                        Firma:
                    </td>
                    <td style="width: 35%; border-bottom: 1px solid #080808;">&nbsp;

                    </td>
                    <td style="width: 20%;">
                    </td>
                </tr>
                <tr>
                    <td style="width: 5%;">
                    </td>
                    <td style="width: 35%; height: 5px;" >
                    </td>
                    <td style="width: 5%;">
                    </td>
                    <td style="width: 35%; text-align: center;">
                        SOLICITANTE
                    </td>
                    <td style="width: 20%;">
                    </td>
                </tr>
            </table>
            <br><br>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 5%; ">
                    </td>
                    <td style="width: 35%; height: 5px; " >
                    </td>
                    <td style="width: 5%;" >
                        Firma:
                    </td>
                    <td style="width: 35%; border-bottom: 1px solid #080808;">&nbsp;

                    </td>
                    <td style="width: 20%; " >
                    </td>
                </tr>
                <tr>
                    <td style="width: 5%; ">
                    </td>
                    <td style="width: 35%; height: 5px;" >
                    </td>
                    <td style="width: 5%;" >
                    </td>
                    <td style="width: 35%; text-align: center;">
                        BANCO
                    </td>
                    <td style="width: 20%; " >
                    </td>
                </tr>
            </table>
        </div>

        <page><div style="page-break-before: always;">&nbsp;</div></page>

        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">
                        <div style="width: auto; height: auto; font-weight: bold; text-align: center;">
                            DECLARACIÓN JURADA DE SALUD <br>
                            SOLICITUD DE SEGURO MASIVO VIDA INDIVIDUAL DE CORTO PLAZO
                        </div>
                        <div style="width: auto; height: auto; margin-top: 3px; text-align: center;">
                            Formato aprobado por la Autoridad de Fiscalización y Control de
                            Pensiones y Seguros APS  mediante Resolución Administrativa
                            <br>
                            APS/DSNo.687-2013 Código 206-934215-2013 07  035 400
                            <br>
                            POLIZA DE  SEGURO MASIVO VIDA DE CORTO PLAZO N° 123456
                        </div>
                        <p style="text-align: justify;">
                            NACIONAL VIDA Seguros de Personas S.A., (denominada en adelante "LA COMPAÑÍA "),
                            por el presente CERTIFICADO INDIVIDUAL DE SEGURO hace constar que la persona
                            nominada en la declaración jurada de salud / formulario de seguro, (denominado
                            en adelante "EL ASEGURADO"), está protegido por la Póliza de Seguro de Vida
                            Masiva arriba mencionada, de acuerdo a las  siguientes Condiciones Particulares:
                        </p>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            1. DATOS DEL ASEGURADO ASEGURADO
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 27%; text-align: left;">
                                    Nombre Completo:
                                </td>
                                <td style="width: 73%; border-bottom: 1px solid #080808; text-align: left;">
                                    {{ $viDetail->client->full_name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 22%; text-align: left;">
                                    Cedula de Identidad:
                                </td>
                                <td style="width: 73%; border-bottom: 1px solid #080808; text-align: left;">
                                    {{ $viDetail->client->dni }} {{ $viDetail->client->extension }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 22%; text-align: left;">
                                    Dirección Domicilio:
                                </td>
                                <td style="width: 73%; border-bottom: 1px solid #080808; text-align: left;">
                                    {{ $viDetail->client->home_address }}
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 22%; text-align: left;">
                                    Fecha de Nacimiento:
                                </td>
                                <td style="width: 73%; border-bottom: 1px solid #080808; text-align: left;">
                                    {{ date('d-m-Y', strtotime($viDetail->client->birthdate)) }}
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            2. COBERTURAS Y CAPITALES ASEGURADOS:
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 5%;">
                                    a.
                                </td>
                                <td style="width: 95%; text-align: justify;">
                                    <label class="emphasis">Muerte por cualquier causa:</label> La compañía asume
                                    la muerte por cualquier causa de EL ASEGURADO, siempre y cuando la causa
                                    no se encuentre excluida en el punto  4 del presente certificado.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%;">
                                    b.
                                </td>
                                <td style="width: 95%; text-align: justify;">
                                    <label class="emphasis">Pago anticipado del Capital Asegurado en caso de
                                        Invalidez Total y Permanente:</label>
                                    Cobertura aplicable cuando se presenta la Incapacidad Total y Permanente en
                                    forma irreversible y por lo menos en un 60% de incapacidad, por Accidente o
                                    por Enfermedad
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%;">
                                    c.
                                </td>
                                <td style="width: 95%; text-align: justify;">
                                    <label class="emphasis">Sepelio:</label> El beneficio de sepelio no considera
                                    exclusiones para EL ASEGURADO y se paga al ocurrir la muerte por cualquier
                                    causa.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%;" valign="top">
                                    d.
                                </td>
                                <td style="width: 95%; text-align: justify;">
                                    <label class="emphasis">Capitales Asegurados:</label>
                                    <br><br>
                                    <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                                        <tr>
                                            <td style="width: 100%; background: #000; color: #fff;
                                                text-align: center; border: 1px solid #000;" colspan="2">
                                                Expresado en Bolivianos
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 70%; background: #353535; color: #fff;
                                                border: 1px solid #000;">
                                                Coberturas
                                            </td>
                                            <td style="width: 30%; background: #353535; color: #fff;
                                                border: 1px solid #000;">
                                                Rango de Capitales
                                            </td>
                                        </tr>
                                        @foreach(json_decode($viHeader->plan->plan) as $plan)
                                            <tr>
                                                <td style="width: 70%; border: 1px solid #000;
                                                    background: #000; color: #fff;">
                                                    {{ $plan->cov }}
                                                </td>
                                                <td style="width: 30%; padding-left: 5px; border: 1px solid #000;">
                                                    Hasta Bs. {{number_format($plan->rank, 0, '.', ',')}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <br>
                                    <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                                        <tr>
                                            <td style="width: 20%;">
                                                Límites de edad:
                                            </td>
                                            <td style="width: 20%;">
                                                De Ingreso:
                                            </td>
                                            <td style="width: 60%; text-align: justify;">
                                                De Ingreso:	Mayores de 14 años y  hasta los 70 años por
                                                muerte por cualquier causa. Mayores de 14 años y hasta
                                                los 64 años para Pago anticipado del Capital Asegurado
                                                en caso de Invalidez Total y Permanente
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 20%;">

                                            </td>
                                            <td style="width: 20%;">
                                                De permanencia:
                                            </td>
                                            <td style="width: 60%; text-align: justify;">
                                                De permanencia: Hasta los 75 años en caso de muerte por
                                                cualquier causa Hasta los 65 años de Pago anticipado del
                                                Capital Asegurado en caso de Invalidez Total y Permanente.
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            3. PUNTO DE VENTA:
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 35%; text-align: left;">
                                    Nombre de la Razón Social:
                                </td>
                                <td style="width: 65%; text-align: left">
                                    Banco Económico S.A.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 35%; text-align: left;">
                                    Dirección:
                                </td>
                                <td style="width: 65%; text-align: left;">
                                    Santa Cruz, SANTA CRUZ
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            4. EXCLUSIONES:
                            <span style="font-weight: normal;">
                                Este seguro de  vida no será aplicable en ninguna de
                                las siguientes circunstancias:
                            </span><br>
                            Para Cobertura de Muerte por Cualquier Causa:
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    Participación de EL ASEGURADO en actos de guerra, declarada o no, sedición,
                                    rebelión, asonada, conspiración, motín, tumulto, o cualquier acto que tenga
                                    relación con ellos, salvo comprobación de que EL ASEGURADO no haya participado,
                                    o formado parte activa de dichos actos de manera directa.
                                </td>
                            </tr>

                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    Participación de EL ASEGURADO como conductor o acompañante en competencias de
                                    velocidad o resistencia, de automóviles motocicletas, lanchas o en cualquier
                                    clase de vehículos a motor.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    Suicidio durante el primer año de haber estado asegurado ininterrumpidamente.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    Fisión o Fusión nuclear o contaminación radioactiva.
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">La Cobertura de Sepelio no tiene exclusiones.</td>
                            </tr>
                            <tr>
                                <td colspan="2">Para la cobertura Pago anticipado del Capital Asegurado
                                    en caso de Invalidez Total y Permanente:</td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    La utilización por EL ASEGURADO de medios de transporte aéreo no comercial,
                                    salvo en calidad de pasajero de líneas aéreas debidamente autorizadas para
                                    el transporte público.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    Que EL ASEGURADO se encuentre en estado de ebriedad o bajo los efectos de
                                    Alcohol, drogas o alucinógenos.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    Falsas declaraciones, omisión o reticencia del Asegurado que puedan influir
                                    en la comprobación de su estado de invalidez.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; text-align: center; font-weight: normal;" valign="top">*</td>
                                <td style="width: 95%;">
                                    Intento de suicidio cualquiera sea la época en que ocurra o por medidas o
                                    lesiones inferidas AL ASEGURADO por sí mismo o por terceros con su
                                    consentimiento.
                                </td>
                            </tr>
                        </table>
                    <td>
                    <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            5. COSTO DE LA COBERTURA:
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 27%; background: #000; color: #FFF; padding: 3px;
                                    border: 1px solid #000;">
                                    Prima Neta
                                </td>
                                <td style="width: 28%; border: 1px solid #000; padding: 2px;">
                                    {{ $viHeader->plan->annual_premium }}
                                </td>
                                <td style="width: 45%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 27%; background: #000; color: #FFF; padding: 2px;
                                    border: 1px solid #000;">
                                    Impuestos
                                </td>
                                <td style="width: 28%; border: 1px solid #000; padding: 2px;">
                                    2.7
                                </td>
                                <td style="width: 45%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 27%; background: #000; color: #FFF; padding: 2px;
                                    border: 1px solid #000;">
                                    Comision Corretaje
                                </td>
                                <td style="width: 28%; border: 1px solid #000; padding: 2px;">
                                    12.15
                                </td>
                                <td style="width: 45%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 27%; background: #000; color: #FFF; padding: 2px;
                                    border: 1px solid #000;">
                                    Prima Comercial
                                </td>
                                <td style="width: 28%; border: 1px solid #000; padding: 2px;">
                                    252.00
                                </td>
                                <td style="width: 45%;"></td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            6. BENEFICIARIOS:
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 15%; text-align: center; background: #000;
                                    color: #FFF; height: 10px;">
                                </td>
                                <td style="width: 35%; background: #000; color: #FFF;
                                    height: 10px; text-align: center; border: 1px solid #000;">
                                    Nombre Completo
                                </td>
                                <td style="width: 15%; background: #000; color: #FFF;
                                    text-align: center; border: 1px solid #000;">
                                    Parentesco
                                </td>
                                <td style="width: 20%; background: #000; color: #FFF;
                                    text-align: center; border: 1px solid #000;">
                                    C.I.
                                </td>
                                <td style="width: 15%; background: #000; color: #FFF;
                                    text-align: center; border: 1px solid #000;">
                                    Proporción
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%; text-align: center; background: #000;
                                    color: #FFF; border: 1px solid #000; height: 10px;">

                                </td>
                                <td style="width: 35%; text-align: center; border: 1px solid #000;">

                                </td>
                                <td style="width: 15%; text-align: center; border: 1px solid #000;">

                                </td>
                                <td style="width: 20%; text-align: center; border: 1px solid #000;">

                                </td>
                                <td style="width: 15%; text-align: center; border: 1px solid #000;">

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 15%; text-align: center; background: #000;
                                    color: #FFF; border: 1px solid #000; height: 10px;">
                                    Beneficiario 2
                                </td>
                                <td style="width: 35%; text-align: center; border: 1px solid #000;">

                                </td>
                                <td style="width: 15%; text-align: center; border: 1px solid #000;">

                                </td>
                                <td style="width: 20%; text-align: center; border: 1px solid #000;">

                                </td>
                                <td style="width: 15%; text-align: center; border: 1px solid #000;">

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 85%; background: #000; color: #FFF;" colspan="4"></td>
                                <td style="width: 15%; background: #000; color: #FFF;
                                    text-align: center; border: 1px solid #000;">100%
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            7. PROCEDIMIENTO A SEGUIR EN CASO DE SINIESTRO:
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 100%;" colspan="2">
                                    El Asegurado o Beneficiario, tan pronto y a más tardar dentro de los 30 días
                                    de tener conocimiento del siniestro, debe comunicar tal hecho a la aseguradora,
                                    salvo fuerza mayor o impedimiento jurídico.
                                    <br>
                                    Para reclamar el pago de cualquier indemnización con cargo
                                    a esta póliza, EL ASEGURADO O BENEFICIARIO deberá remitir a
                                    LA COMPAÑÍA su solicitud junto con los documentos a presentar
                                    en caso de fallecimiento o invalidez. LA COMPAÑÍA podrá, a sus
                                    expensas, recabar informes o pruebas complementarias.
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            DOCUMENTOS  A PRESENTAR  EN CASO DE  MUERTE POR CUALQUIER CAUSA:
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Certificado Médico de defunción.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Certificado de la Autoridad competente (si corresponde).
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Documento de identidad (carnet de identidad o certificado
                                    de nacimiento) del asegurado.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Documento de identidad (Carnet de identidad o Certificado
                                    de nacimiento) del beneficiario.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Declaratoria de Herederos si no existieran Beneficiarios
                                    nominados en la Póliza.
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            DOCUMENTOS  A PRESENTAR  EN CASO DE  INVALIDEZ TOTAL PERMANENTE
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%; text-align: justify;">
                                    Declaración médica de invalidez, emitida por un médico autorizado por la APS.
                                </td>
                            </tr>
                        </table>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            DOCUMENTOS  A PRESENTAR  EN CASO DE  SEPELIO
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Certificado de defunción.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Documento de identidad (carnet de identidad o certificado
                                    de nacimiento) del asegurado.

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Documento de identidad (Carnet de identidad o Certificado de
                                    nacimiento) del beneficiario.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 5%; font-weight: bold; text-align: center;">*</td>
                                <td style="width: 95%;">
                                    Declaratoria de Herederos si no existieran Beneficiarios
                                    nominados en la Póliza.
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            8. COMPAÑÍA ASEGURADORA
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 100%;">
                                    <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                                        <tr>
                                            <td style="width: 14%; text-align: left;">
                                                Razón Social:
                                            </td>
                                            <td style="width: 86%; border-bottom: 1px solid #000; text-align: left;"
                                                colspan="5">
                                                Nacional Vida Seguros de Personas S.A.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:14%; text-align: left;">Dirección:</td>
                                            <td style="width:36%; border-bottom: 1px solid #000;">
                                                Av. Monseñor Rivero  N 223
                                            </td>
                                            <td style="width:7%;">Teléfono:</td>
                                            <td style="width:18%; border-bottom: 1px solid #000;">
                                                3716262
                                            </td>
                                            <td style="width:7%;">Fax:</td>
                                            <td style="width:18%; border-bottom: 1px solid #000;">
                                                3337969
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <br>
                        <div style="text-align: left; margin: 2px 0; font-weight: bold;">
                            9. CORREDOR DE SEGUROS
                        </div>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 100%;">
                                    <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                                        <tr>
                                            <td style="width: 14%; text-align: left;">
                                                Razón Social:
                                            </td>
                                            <td style="width: 86%; border-bottom: 1px solid #000; text-align: left;"
                                                colspan="5">
                                                Sudamericana S.R.L.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:14%;">Dirección:</td>
                                            <td style="width:36%; border-bottom: 1px solid #000;">
                                                Equipetrol Calle Nº 8 Este Nº 25
                                            </td>
                                            <td style="width:7%;">Teléfono:</td>
                                            <td style="width:18%; border-bottom: 1px solid #000;">
                                                3416055
                                            </td>
                                            <td style="width:7%;">Fax:</td>
                                            <td style="width:18%; border-bottom: 1px solid #000;">
                                                3416056
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <br><br>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 13%;"></td>
                                <td style="width: 20%; border-bottom: 1px solid #000;
                                    text-align: center;">
                                    Santa Cruz
                                </td>
                                <td style="width: 4%; text-align: center;"> , </td>
                                <td style="width: 10%; border-bottom: 1px solid #000;
                                    text-align: center;">
                                    30
                                </td>
                                <td style="width: 5%; text-align: center;"> de </td>
                                <td style="width: 20%; border-bottom: 1px solid #000;
                                    text-align: center;">
                                    Noviembre
                                </td>
                                <td style="width: 5%; text-align: center;"> de </td>
                                <td style="width: 10%; border-bottom: 1px solid #000;
                                    text-align: center;">
                                    2015
                                </td>
                                <td style="width: 13%;"></td>
                            </tr>
                        </table>
                        <br>
                        <table cellpadding="0" cellspacing="0" border="0" class="wrap_table_child">
                            <tr>
                                <td style="width: 5%;"></td>
                                <td style="width: 90%; text-align: center; padding-bottom: 20px;"
                                    colspan="3">
                                    NACIONAL VIDA SEGURO DE  PERSONAS S.A.
                                    <br>
                                    FIRMAS AUTORIZADAS
                                </td>
                                <td style="width: 5%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 5%;"></td>
                                <td style="width: 35%; border-bottom: 1px solid #000; text-align: center;">

                                </td>
                                <td style="width: 10%;"></td>
                                <td style="width: 45%; border-bottom: 1px solid #000; text-align: center;">

                                </td>
                                <td style="width: 5%;"></td>
                            </tr>
                            <tr>
                                <td style="width: 5%;"></td>
                                <td style="width: 35%; text-align: center;">
                                    Joaquín Montaño Salas <br>
                                    Gerente Regional
                                </td>
                                <td style="width: 10%;"></td>
                                <td style="width: 45%; text-align: center;">
                                    Mario Aguirre <br>
                                    Gerente Nacional de Seguros Masivos
                                </td>
                                <td style="width: 5%;"></td>
                            </tr>
                        </table>
                    </td>
                <tr>
            </table>
        </div>

        <page><div style="page-break-before: always;">&nbsp;</div></page>

        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; font-size: 75%; margin-top: 4px;">
            <p>
                <b>Discrepancias en la Póliza (Art. 1013) </b>"Si el Tomador o ASEGURADO
                encuentran que la póliza no concuerda con lo convenido o con lo propuesto,
                pueden pedir rectificación correspondiente por escrito, dentro de los quince
                días siguientes a la recepción de la Póliza. Se consideran aceptadas las
                estipulaciones de esta si durante dicho plazo no se solicita la mencionada
                rectificación. Si dentro de los quince días siguientes al de la reclamación
                LA COMPAÑÍA no da curso a la rectificación solicitada o mantiene silencio,
                se entiende aceptada en los términos de la modificación".
                <br>
                <b>Omisión de Aviso (Art. 1030) </b>"LA COMPAÑIA puede liberarse de sus
                obligaciones cuando EL ASEGURADO o beneficiario, según el caso, omitan dar el
                aviso dentro del plazo del articulo 1028  con el fin de impedir la comprobación
                oportuna de las circunstancias del siniestro o el de la magnitud de los daños.
                (Art.1035 Código de Comercio)".
                <br>
                <b>Iniciación y Duración del Contrato. </b>"El presente seguro tendrá una duración
                de un año a contar de la fecha de inicio de la cobertura, salvo que en las
                Condiciones Particulares, Certificado de Cobertura  se estipule una duración
                diferente, el cual se entenderá prorrogado en forma tácita, sucesiva y automática
                por nuevos e iguales períodos en cada ocasión".
                <br>
                <b>Periodo de Gracia. </b>LA COMPAÑÍA concederá al ASEGURADO un periodo de gracia para
                efectuar el pago de la prima correspondiente sin intereses de treinta (30) días calendario,
                contados desde el vencimiento de la fecha establecida en el convenio de pago para el
                pago de la misma.  Si el fallecimiento ocurriese dentro del periodo de gracia, la prima
                adeudada para completar la anualidad por EL TOMADOR/ ASEGURADO será deducida del
                beneficio correspondiente.
                <br>
                <b>Efecto del no pago de Prima: Terminación del Contrato. </b>Si habiendo vencido el
                período de gracia fijado por el artículo precedente, la Prima se encontrare impaga,
                el Contrato de Seguro caducara en forma inmediata, sin necesidad de aviso, notificación
                o requerimiento alguno, liberándose LA COMPAÑÍA  de toda obligación y responsabilidad
                derivada de la Póliza.
                <br>
                <b>Plazo para Pronunciarse (Art. 1033). </b>LA COMPAÑÍA se pronunciará
                sobre el derecho de EL ASEGURADO o beneficiario dentro de los treinta
                (30) días de recibidas la información y evidencias citadas en  el
                Art.1031 del Código de Comercio.  Se dejará constancia escrita de la
                fecha de recepción de la información y evidencias a efecto del cómputo
                del plazo. En plazo de treinta (30) días, fenece con la aceptación o
                rechazo del siniestro o con la solicitud del asegurador al asegurado
                que se complementen los requerimientos contemplados en el Art. 1031
                del Código de Comercio y no vuelve a correr hasta que el asegurado haya
                cumplido con tales requerimientos.
                <br>
                La solicitud de complementos establecidos en el Art. 1031 del Código
                de Comercio, por parte del Asegurador no podrá extenderse por mas de
                dos veces a partir de la primera solicitud de informes y evidencias,
                debiendo pronunciarse dentro del plazo establecido y de manera definitiva
                sobre el derecho del asegurado, después de la entrega por parte del
                asegurado del último requerimiento de información.
                <br>
                El silencio del asegurador, vencido el término  para pronunciarse o
                vencidas las solicitudes de complementación, importa la aceptación del
                reclamo.
            </p>

            <p>
                <b>Termino para el pago de Siniestro (Art. 1034).</b> En los seguros de
                vida, el pago se hará dentro de los quince días posteriores al aviso del
                siniestro o tan pronto sean llenados los requerimientos señalados en el
                artículo 1031".
            </p>
        </div>

    </div>
</div>

@endif
