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
                            {{ $titular->client->place_residence }} {{ $titular->client->birthdate }}
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
                        55,600 Bs.
                    </td>
                    <td style="width: 18%; text-align: left;">Monto Actual Acumulado: </td>
                    <td style="width: 32%; border-bottom: 1px solid #080808; text-align: left;">
                        8,104.95 USD.
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table">
                <tr>
                    <td style="width: 18%; text-align: left;">Plazo del presente crédito: </td>
                    <td style="width: 82%; border-bottom: 1px solid #080808; text-align: left;">
                        4 años
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

                @foreach($question as $key2 => $value)
                    <tr>
                        <td valign="top" style="width: 5%; text-align: center;">{{ $key2 }}. </td>
                        <td style="width: 71%;"></td>
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
                        05 / Agosto / 2015
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
                        35,100.00 Bs.
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
                            Fecha de Nacimiento: {{ $titular->client->birthdate }}
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
                        05
                    </td>
                    <td style="width: 1%;">/</td>
                    <td style="width: 10%; text-align: center;" class="border-bottom">
                        Agosto
                    </td>
                    <td style="width: 1%;">/</td>
                    <td style="width: 8%; text-align: center;" class="border-bottom">
                        2015
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
                {{ date('F d, Y', strtotime($cli->created_at)) }}  y como prestatario de la FUNDACIÓN SARTAWI tiene derecho a
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
                        <span style="font-weight: bold;">Tasa 0.82 %</span> (POR MIL) mensual
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
                        <span style="font-weight: bold;">Tasa 0,82 %</span> (POR MIL) mensual
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
                        <img src="{{ asset('images/firma-1.jpg') }}" height="60">
                    </td>
                    <td style="width: 10%;"></td>
                    <td style="width: 30%;" align="center">
                        <img src="{{ asset('images/firma-2.jpg') }}" height="60">
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
