<div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 5px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-family: Arial; font-size: 58%;">
            <tr>
                <td align="left" valign="top" colspan="3">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td style="width:25%; border: 0px solid #FFFF00;" align="left" valign="top">
                    <img src="{{ asset($query->img_company) }}" height="60">
                </td>
                <td style="width:50%; font-weight:bold; text-align:center;">
                    Oficina Principal Calacoto Calle Julio Patiño No. 550 esq. Calle 12<br>
                    Central Piloto (2)2775550 Fax (591-02)2203917<br>
                    e-mail: credinform@credinformsa.com<br><br>
                    CERTIFICADO DE COBERTURA - POLIZA DE SEGUROS COLECTIVO MULTIRIESGO <br/>
                    Registro No. 102-9103186-2013 08 183-4001<br/>
                    BIENES EN GARANTIA HIPOTECARIA<br/>
                </td>
                <td style="width:25%;" align="right" valign="top">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                        <tr>
                            <td style="width:20%; text-align:right;">PÓLIZA No.</td>
                            <td style="width:20%;">
                                <div style="border: 1px solid #999; width:125px;">
                                    {{$query_header->policy_number}}
                                </div>
                            </td>
                            <td style="width:20%;">&nbsp;</td>
                            <td style="width:14%; text-align:right;">CERTIFICADO No.</td>
                            <td style="width:26%;">
                                <div style="border: 1px solid #999; width:125px;">
                                    {{$query_header->issue_number}}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>

        <span style="font-weight:bold; font-size:65%; font-family: Arial;">1. Datos del Titular:</span><br>
        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; padding-bottom: 5px;">
            <tr>
                <td style="width:14%;">Nombres:</td>
                <td style="width:21%; text-align:center;">{{$query_client->last_name}}</td>
                <td style="width:22%; text-align:center;">{{$query_client->mother_last_name}}</td>
                <td style="width:22%; text-align:center;">{{$query_client->first_name}}</td>
                <td style="width:21%; text-align:center;">
                    @if($query_client->civil_status=='C')
                        {{$query_client->married_name}}
                    @endif
                </td>
            </tr>
            <tr>
                <td style="width:14%;"></td>
                <td style="width:21%; border-top:1px solid #999; text-align:center;">Apellido Paterno</td>
                <td style="width:22%; border-top:1px solid #999; text-align:center;">Apellido Materno</td>
                <td style="width:22%; border-top:1px solid #999; text-align:center;">Nombres</td>
                <td style="width:21%; border-top:1px solid #999; text-align:center;">Apellido de Casada</td>
            </tr>
        </table>
        @var $parameter_avst = config('base.avenue_street')
        @var $avenue_street = $parameter_avst[$query_client->avenue_street]
        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; padding-bottom: 5px;">
            <tr>
                <td style="width:14%;">Dirección Legal:</td>
                <td style="width:30%; text-align:center;">{{$avenue_street}}</td>
                <td style="width:12%; text-align:center;">{{$query_client->home_number}}</td>
                <td style="width:24%; text-align:center;">{{$query_client->locality}}</td>
                <td style="width:20%;">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:14%;">&nbsp;</td>
                <td style="width:30%; border-top:1px solid #999; text-align:center;">Av. o Calle</td>
                <td style="width:12%; border-top:1px solid #999; text-align:center;">N&uacute;mero</td>
                <td style="width:24%; border-top:1px solid #999; text-align:center;">Ciudad o Localidad</td>
                <td style="width:20%;">&nbsp;</td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; padding-bottom: 5px;">
            <tr>
                <td style="width:10%;">Tel&eacute;fono:</td>
                <td style="width:20%; text-align:center;">{{$query_client->phone_number_home}}</td>
                <td style="width:20%; text-align:center;">{{$query_client->phone_number_office}}</td>
                <td style="width:20%; text-align:center;">{{$query_client->phone_number_mobile}}</td>
                <td style="width:30%; text-align:center;"></td>
            </tr>
            <tr>
                <td style="width:10%;"></td>
                <td style="width:20%; border-top:1px solid #999; text-align:center;">Domicilio</td>
                <td style="width:20%; border-top:1px solid #999; text-align:center;">Oficina</td>
                <td style="width:20%; border-top:1px solid #999; text-align:center;">Celular</td>
                <td style="width:30%; text-align:center;"></td>
            </tr>
        </table>

        <span style="font-weight:bold; font-size:65%; font-family: Arial;">2. Inter&eacute;s Asegurado:</span>
        <div style="font-size:60%; font-family: Arial;">
            <b>INMUEBLES:</b> PROPIEDADES SIN PROHIBICIÓN NI EXCLUSIÓN NI RESTRICCIÓN DE GIRO DE NEGOCIO Y/O
            ACTIVIDADES Y/O TIPO DE RIESGO EN LOS QUE SE DESARROLLEN LAS ACTIVIDADES DE LOS CLIENTES, EXCEPTO
            LAS EXCLUIDAS EXPRESAMENTE EN ÉSTA PÓLIZA.<br>
            EN CASO DE BIENES INMUEBLES:
        </div>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 60%; font-family: Arial;">
            <tr>
                <td style="width:2%;" valign="top">&bull;</td>
                <td style="width:98%;">
                    INCLUYENDO EN TODOS LOS CASOS, OBRAS CIVILES Y SUS INSTALACIONES, INCLUYENDO LUMINARIAS, ALFOMBRADO
                    (SIEMPRE Y CUANDO ESTÉN INCLUIDAS EN EL AVALÚO TÉCNICO), REVESTIMIENTOS; VIDRIOS, ACCESORIOS
                    SANITARIOS, MUROS PERIMETRALES, TANQUES; ESTACIONAMIENTOS, ÁREAS DE DEPÓSITO Y LA PARTE PROPORCIONAL
                    DE ÁREAS COMUNES, CUANDO CORRESPONDA.
                </td>
            </tr>
            <tr>
                <td style="width:2%;" valign="top">&bull;</td>
                <td style="width:98%;">
                    INCLUYENDO INMUEBLES DOMICILIARIOS, COMERCIALES, O INMUEBLES INDUSTRIALES (ESTOS ÚLTIMOS PREVIA
                    AUTORIZACIÓN
                    DE LA COMPAÑÍA). SE ACLARA QUE EL VALOR ASEGURADO MÁXIMO PARA RIESGOS INDUSTRIALES ES DE HASTA USD
                    200.000 POR
                    BIEN DECLARADO.
                </td>
            </tr>
        </table>

        <div style="font-size:60%; text-align:justify; font-family: Arial;">
            <b>MAQUINARIA Y EQUIPO PESADO MOVIL:</b> (GRÚAS, PALAS MECÁNICAS, EXCAVADORAS, CAMIONES CONCRETEROS,
            MOTONIVELADORAS,
            TRACTORES, Y OTROS SIMILARES), INCLUYENDO SUS EQUIPOS AUXILIARES QUE SE ENCUENTREN DECLARADOS DENTRO DE LA
            MATERIA ASEGURADA, YA SEA QUE ESTÉN CONECTADOS O NO AL EQUIPO O MAQUINARIA OBJETO DEL SEGURO O QUE SE
            ENCUENTREN OPERANDO O DURANTE SU TRAYECTO POR SUS PROPIOS MEDIOS O NO DENTRO O FUERA DE LOS PREDIOS.
        </div>
        @var $vec=array()
        @var $i=1
        @var $vat = 0
        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px; margin-bottom: 5px;">
            <tr>
                <td style="width:15%; text-align:left;">Materia Asegurada:</td>
                <td style="width:80%; text-align:justify; border-bottom: 1px solid #000; padding: 5px 3px;">
                    @foreach($query_riesgo as $data_riesgo)
                        @var $parameter_pro = config('base.property_types')
                        @var $matter_insured = $parameter_pro[$data_riesgo->matter_insured]
                        @var $parameter_use = config('base.property_uses')
                        <b>{{$matter_insured}}:</b> {{$data_riesgo->matter_description}},
                        <b>Nro:</b> {{$data_riesgo->number}},
                        @if($data_riesgo->matter_insured=='PR')
                            <b>Uso:</b> {{$parameter_use[$data_riesgo->use]}} terminado Valorado
                            en: {{$data_riesgo->insured_value}}<br>
                        @else
                            Valorado en: {{$data_riesgo->insured_value}}
                        @endif
                        @var $vec[1][$i] = $data_riesgo->city
                        @var $vec[2][$i] = $data_riesgo->locality
                        @var $vec[3][$i] = $data_riesgo->zone
                        @var $vat = $vat + $data_riesgo->insured_value
                        @var $i=$i+1
                    @endforeach
                </td>
                <td style="width:5%; text-align:left;"></td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 5px;">
            <tr>
                <td style="font-weight:bold; text-align:left;" colspan="2">
                    Datos del Intermediario:
                </td>
            </tr>
            <tr>
                <td style="width:15%; text-align:left;">Razón Social:</td>
                <td style="width:85%; text-align:left;">Sudamericana SRL</td>
            </tr>
            <tr>
                <td style="width:15%; text-align:left;">Dirección:</td>
                <td style="width:85%; text-align:left;">Prolongación Cordero N&deg; 163 - San Jorge</td>
            </tr>
            <tr>
                <td style="width:15%; text-align:left;">Teléfono:</td>
                <td style="width:85%; text-align:left;">(591)-2-2433500&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax:
                    (591)-2-2128329
                </td>
            </tr>
        </table>

        <span style="font-weight:bold; font-size:65%;">3. Ubicación del Riesgo:</span><br>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px;">
            <tr>
                <td style="width:10%;">Departamento:</td>
                <td style="width:25%; border-bottom:1px solid #999;">{{$vec[1][1]}}</td>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:13%;">Ciudad o localidad:</td>
                <td style="width:35%; border-bottom:1px solid #999;">{{$vec[2][1]}}</td>
                <td style="width:7%;">&nbsp;</td>
            </tr>
            <tr>
                <td style="padding-top:5px;" colspan="6">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                        <tr>
                            <td style="width:5%;">Zona:</td>
                            <td style="width:88%; border-bottom:1px solid #999;">{{$vec[3][1]}}</td>
                            <td style="width:7%;">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:17%; font-weight:bold;">4. Valor Total Asegurado:</td>
                <td style="width:23%; border-bottom:1px solid #999; text-align:center;">
                    {{$vat}}
                </td>
                <td style="width:20%; text-align:left; font-weight:bold;">({{$query_header->currency}})</td>
                <td style="width:40%;">&nbsp;</td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">
                    <b>PARA BIENES INMUEBLES:</b><br>
                    Valor de reposición a nuevo del inmueble (Valor de la construcción), según el avalúo técnico (en
                    poder del contratante / beneficiario)
                    (no se considerará el valor del terreno)<br>
                    <b>PARA BIENES MUEBLES:</b><br>
                    Valor de reposición a nuevo de acuerdo a factura comercial y/o avalúo y/o documento equivalente.<br>
                    <b>PARA EQUIPOS ELECTRÓNICOS:</b><br>
                    Valor de reposición a nuevo (incluyendo todo el costo hasta su puesta en marcha), de acuerdo a
                    factura
                    comercial y/o avalúo y/o documento equivalente.
                </td>
                <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">
                    <b>PARA ROTURA DE MAQUINARIA Y EQUIPO MÓVIL:</b><br>
                    Valor de reposición a nuevo, (incluyendo todo el costo hasta su puesta en marcha), de acuerdo a
                    factura
                    comercial y/o avalúo y/o documento equivalente.<br>
                    <b>PARA BIENES CON ANTIGÜEDAD DE MÁS DE 5 AÑOS O BIENES REACONDICIONADOS:</b><br>
                    El valor de reposición a nuevo o su valor de adquisición, siempre y cuando este valor de adquisición
                    sea por
                    lo menos equivalente a un 80% del valor de reposición a nuevo.
                </td>
            </tr>
        </table>
        @var $fecha = date('d/m/Y', strtotime($query_header->validity_start));
        @var $array = explode('/',$fecha);
        @var $day = $array[0];
        @var $month = $array[1];
        @var $year = $array[2];
        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:20%; font-weight:bold;">5. Fecha inicio de vigencia:</td>
                <td style="width:25%;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto;">
                        <tr>
                            <td style="width:32%; border-bottom:1px solid #999; text-align:center;">{{$day}}</td>
                            <td style="width:2%;">/</td>
                            <td style="width:32%; border-bottom:1px solid #999; text-align:center;">{{$month}}</td>
                            <td style="width:2%;">/</td>
                            <td style="width:32%; border-bottom:1px solid #999; text-align:center;">{{$year}}</td>
                        </tr>
                    </table>
                </td>
                <td style="width:55%;">&nbsp;</td>
            </tr>
        </table>
        @var $parameter_term = config('base.term_types')
        @var $type_term = $parameter_term[$query_header->type_term]
        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px;">
            <tr>
                <td style="width:25%; font-weight:bold;">6. Plazo del contrato de seguros:</td>
                <td style="width:20%; border-bottom:1px solid #999; text-align:center;">
                    {{$query_header->term}} {{$type_term}}
                </td>
                <td style="width:55%; text-align:left;">El plazo de la póliza debe ser igual al plazo del crédito del
                    asegurado
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px;">
            <tr>
                <td style="width:15%; font-weight:bold;">7. Tasa Anual:</td>
                <td style="width:5%;">
                    0.80
                </td>
                <td style="width:80%; text-align:left;">%o (por mil)</td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0"
               style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px;">
            <tr>
                <td style="width:15%; font-weight:bold;">8. Forma de Pago:</td>
                <td style="width:20%; border-bottom:1px solid #999; text-align:center;">
                    Credito
                </td>
                <td style="width:65%; text-align:left;">
                    Pago de la prima de acuerdo a la periodicidad de pago del crédito
                </td>
            </tr>
        </table>

        <!--renglon 1-->
        @if((boolean)$query_header->facultative === true)
            @if((boolean)$query_header->approved === true)
                    <!--renglon 2-->
            <div style="font-size:6pt; text-align:center; margin-top:5px; margin-bottom:0px; border:1px solid #C68A8A; background:#FFEBEA; padding:8px; width:98%;"
                 align="left">
                APROBADO POR LA COMPAÑÍA ASEGURADORA DE ACUERDO A LAS SIGUIENTES CONDICIONES, MISMAS QUE PREVALECERÁN SOBRE
                LAS ANTERIORES
            </div>
            <table border="0" cellpadding="1" cellspacing="0"
                   style="width: 100%; font-size: 8px; font-weight: normal; font-family: Arial; margin: 2px 0 0 0; padding: 5px 0 0 0; border-collapse: collapse; vertical-align: bottom;">
                <tr>
                    <td colspan="7" style="text-align: center; font-weight: bold; background: #e57474; color: #FFFFFF;">
                        Caso Facultativo
                    </td>
                </tr>
                <tr>
                    <td style="width:10%; text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                        Riesgo
                    </td>
                    <td style="width:5%; text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                        Aprobado
                    </td>
                    <td style="width:5%; text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                        Tasa de Recargo
                    </td>
                    <td style="width:7%; text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                        Porcentaje de Recargo
                    </td>
                    <td style="width:7%; text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                        Tasa Actual
                    </td>
                    <td style="width:7%; text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                        Tasa Final
                    </td>
                    <td style="width:59%; text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                        Respuesta de la Compañía
                    </td>
                </tr>
                @var $parameter_prouse = config('base.property_uses')
                @foreach($query_riesgo as $data_fac)
                    @var $use = $parameter_prouse[$data_fac->use]
                    <tr>
                        <td style="width:10%; text-align: center; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                            {{$use}}
                        </td>
                        <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                            {{$data_fac->approved=1?'SI':'NO'}}
                        </td>
                        <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                            {{$data_fac->surcharge=1?'SI':'NO'}}
                        </td>
                        <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                            {{$data_fac->percentage}}
                        </td>
                        <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                            {{$data_fac->current_rate}} %
                        </td>
                        <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                            {{$data_fac->final_rate}} %
                        </td>
                        <td style="width:59%; text-align: justify; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                            <span style="color:#000000;">Respuesta de la Compañía:</span> {{$data_fac->observation}}<br/>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="7" style="text-align: left; background: #e57474; color: #FFFFFF;">
                        <span style="color:#000000">Observaciones:</span> {{$query_header->facultative_observation}}
                    </td>
                </tr>
            </table>

            @else

                <table border="0" cellpadding="1" cellspacing="0"
                       style="width: 100%; font-size: 8px; border-collapse: collapse; font-weight: normal; font-family: Arial; margin: 2px 0 0 0; padding: 0; border-collapse: collapse; vertical-align: bottom;">
                    <tr>
                        <td style="text-align: center; font-weight: bold; background: #e57474; color: #FFFFFF;">
                            Caso Facultativo
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center; font-weight: bold; border: 1px solid #dedede; background: #e57474;">
                            Observaciones
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: justify; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;">
                           {{$query_header->facultative_observation}}
                        </td>
                    </tr>
                </table>

            @endif
        @endif

        @if($query_header->issued == 1 && $query_header->canceled == 0)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%;">
                <tr>
                    <td style="width:25%;"></td>
                    <td style="width:35%;"></td>
                    <td style="width:40%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto;">
                            <tr>
                                <td valign="top" align="center" style="width:50%;">
                                    <img src="{{ asset('images/firma1.jpg') }}" width="110" height="50"/><br>
                                    MIGUEL ANGEL BARRAGAN
                                </td>
                                <td valign="top" align="center" style="width:50%;">
                                    <img src="{{ asset('images/firma2.jpg') }}" width="94" height="50"/><br>
                                    MARIANA JAUREGUI Q
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width:25%; border-top:1px solid #999; text-align:center;">Firma del Titular Solicitante
                    </td>
                    <td style="width:35%;">&nbsp;</td>
                    <td style="width:40%; border-top:1px solid #999; text-align:center;">Firmas Autorizadas de la
                        Compañia
                    </td>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td style="width:5%; text-align:left;">C.I.</td>
                    <td style="width:15%; border-bottom:1px solid #999; text-align:center;">
                        {{$query_client->dni}} {{$query_client->complement}}
                    </td>
                    <td style="width:2%;">&nbsp;</td>
                    <td style="width:12%; text-align:right;">Expedido en:</td>
                    <td style="width:12%; border-bottom:1px solid #333; text-align:center;">
                        {{$query_client->extension}}
                    </td>
                    <td style="width:54%;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:46%; padding-top:5px;" colspan="5">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:20%; text-align:left;">Lugar y fecha:</td>
                                <td style="width:50%; border-bottom:1px solid #999; text-align:center;">
                                    {{$query_header->place}} {{date('d/m/Y', strtotime($query_header->date_issue))}}
                                </td>
                                <td style="width:30%;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:54%;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size:6pt;" align="right">
                        “Impreso el <?=date("d/m/Y")?>. El presente certificado reemplaza cualquier otro certificado
                        impreso en fechas anteriores a la indicada.”
                    </td>
                </tr>
            </table>
        @endif

        <page>
            <div style="page-break-before: always;">&nbsp;</div>
        </page>
        <!--renglon 3-->
        @if($query_header->issued == 1 && $query_header->canceled == 0)
            <div style="width: 775px; border: 0px solid #FFFF00;">
                <table cellpadding="0" cellspacing="0" border="0"
                       style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                    <tr>
                        <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">

                            <span style="font-weight: bold;">CONDICION DE ADHESION AL SEGURO:</span><br>
                            El Asegurado se adhiere voluntariamente a los términos establecidos en la presente Póliza de
                            Seguro Colectivo
                            Multiriesgo y declara conocer y estar de acuerdo con las condiciones del contrato de
                            seguro. Asimismo, acepta la obligación de pago de prima para mantener vigente la cobertura
                            de la póliza.
                            La falta de pago de primas dará lugar a la suspensión inmediata de la cobertura.<br>
                            <span style="font-weight: bold;">COBERTURAS:</span><br>
                            <span style="font-weight: bold;">SECCION I: TODO RIESGO DE DAÑOS A LA PROPIEDAD</span><br/>
                            Todo riesgo de daños a la propiedad, incluyendo terremoto, erupción volcanica, temblor y/o
                            movimientos
                            sísmicos al igual que el incendio resultante de estos, deslizamientos, asentamientos no
                            graduales,
                            hundimiento siempre y cuando no sea gradual,
                            corrimientos de tierra, caída de rocas y otros riesgos de la naturaleza cualquiera sea su
                            causa;
                            terrorismo y riesgos políticos y sociales incluyendo huelgas, motines, conmoción civil, daño
                            malicioso,
                            vandalismo, sabotaje, asonada, disturbios de acuerdo texto de cláusula.<br>

                            <span style="font-weight: bold;">SECCIÓN II: TODO RIESGO DE EQUIPO ELECTRONICO</span><br>
                            Todo riesgo de equipo electrónico, incluyendo componentes electromecánicos; equipos móviles
                            y/o
                            portátiles, sus accesorios e instalaciones, equipos periféricos, incluyendo:
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Robo con violencia, atraco</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Daños emergentes a la energía eléctrica incluyendo cortes de
                                        electricidad.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Incendio, rayo, explosión de cualquier tipo, incluyendo los
                                        daños causados
                                        por extinción de incendio y operaciones de salvamento.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Quemaduras superficiales y carbonización, humo, hollín</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Daños de la naturaleza como tempestad, inundación, granizo,
                                        cubiertos por la
                                        sección I del presente seguro.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Daños por agua, grifería y tanques cubierta por la sección I
                                        del presente
                                        seguro. Excluye humedad y corrosión por tratarse de daños graduales.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Equipos móviles y/o portátiles, hasta $us. 10.000.</td>
                                </tr>
                            </table>
                            <span style="font-weight: bold;">SECCIÓN  III: TODO RIESGO Y/O DAÑO FISICO POR ROTURA DE MAQUINARIA</span><br>
                            Todo riesgo y/o daño físico por rotura de maquinaria, daños emergentes a la energía
                            eléctrica, daños
                            físicos a la maquinaria, sus instalaciones y equipos auxiliares de protección, control y
                            suministro de
                            servicios (aire, agua, vapor, energía eléctrica, gas natural), incluyendo:
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Robo con violencia</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Mal manejo, negligencia, impericia, ignorancia, actos mal
                                        intencionados, por
                                        parte de los empleados y/o de terceros
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Errores, defectos y desperfectos de construcción y de uso de
                                        materiales
                                        defectuosos
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Defectos y desperfectos y/o errores en diseño, calculo y
                                        montaje y/o mano de
                                        obra defectuosa
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Rotura por fuerzas centrifugas</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Falta de agua en calderos o recipientes bajo presión
                                        (calentamiento excesivo)
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Incidentes durante el trabajo, como malos ajustes,
                                        aflojamiento de partes y
                                        piezas
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Fallas y/o desperfectos en medidas de prevención y seguridad
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Inducción, cualquiera sea su origen</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Cuerpos extraños que se introduzcan en los bienes asegurados
                                        o los golpeen
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Daños por la acción directa o indirecta de la energía
                                        eléctrica u atmosférica
                                        y caída directa de rayo.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Incendio interno e implosión, incluye explosión química
                                        interna.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Explosión en motores de combustión interna.</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Cláusula de riadas, lodos y/o anegación</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Bombas sumergidas y bombas para pozos profundos.</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">El seguro se extiende a cubrir los componentes electrónicos
                                        que formen parte
                                        de la maquinaria.
                                    </td>
                                </tr>
                            </table>
                            <span style="font-weight: bold;">SECCIÓN IV:TODO RIESGO DE EQUIPO MOVIL</span><br>
                            Todo riesgo de equipo móvil incluyendo componentes electrónicos, rayo y explosión,
                            terrorismo, huelgas,
                            motines, conmoción civil, daño malicioso, vandalismo, sabotaje, saqueo y/o tumultos
                            populares, y:
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Accidentes que surjan durante el montaje y/o desmontaje a
                                        consecuencia de su mantenimiento para fines de limpieza y reacondicionamiento y
                                        traslados dentro de los predios del asegurado y/o mientras viajen por sus
                                        propios medios o sean transportados de un sitio de operación a otro, incluyendo
                                        daños por vuelcos, choque, embarrancamiento y/o incendio del medio transportador
                                        L.A.P.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Colisión con objetos en movimiento o estacionarios</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Robo con violencia y/o asalto, así como también los daños
                                        causados por dicho
                                        delito o su intento (excluye hurto y/o ratería)
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Riesgos políticos y sociales</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Rotura de vidrios.</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Gastos extraordinarios hasta el 20% de la suma asegurada.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Colisión con objetos en movimiento o estacionarios,
                                        volcamientos, hundimiento
                                        de terreno, deslizamiento de tierra, descarrilamiento.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Accidentes que ocurran pese a un manejo correcto, así como
                                        los que
                                        sobrevengan por descuido, impericia o negligencia del conductor (salvo actos
                                        intencionales o
                                        negligencia manifiesta del asegurado o sus representantes).
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Pérdidas o daños causados por inundación, ciclón, huracán
                                        tempestad, vientos,
                                        terremoto, temblor, erupción volcánica
                                    </td>
                                </tr>
                            </table>

                        </td>

                        <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">

                            <span style="font-weight: bold;">DEDUCIBLE POR TODO Y CADA EVENTO</span><br>
                            <span style="font-weight: bold;">SECCIÓN I:</span> Por evento y/o reclamo<br>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Riesgos políticos y terrorismo: 1% del valor asegurado por
                                        ubicación, con un
                                        mínimo de USD. 100.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Terremoto, temblor y movimientos sísmicos: 1% del valor
                                        asegurado por
                                        ubicación, con un mínimo de USD. 100.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Para robo con violencia al contenido: USD 100.- (aplicable
                                        únicamente a
                                        riesgos domiciliarios); para otros riesgos: USD 250 por toda y cada pérdida
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Para las demás coberturas USD. 50.-</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Para las coberturas de asentamiento, hundimiento,
                                        deslizamiento, corrimiento de tierras, 5% del valor del reclamo con un mínimo de
                                        USD. 500.- por toda y cada pérdida
                                    </td>
                                </tr>
                            </table>
                            <span style="font-weight: bold;">SECCIONES II Y III:</span>Por evento y/o reclamo<br>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Equipo médico: de acuerdo a la siguiente tabla de valores:
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">&bull;</td>
                                    <td style="width:98%;">Para equipos con un valor asegurado mayor a USD. 50.000.- 2%
                                        del valor del
                                        siniestro.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">&bull;</td>
                                    <td style="width:98%;">Demás equipos 2% del valor del siniestro mínimo USD. 250.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Equipo de telecomunicaciones: 2% del valor del siniestro
                                        mínimo USD. 250.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Equipos móviles y/o portátiles: 2% del valor del reclamo con
                                        un mínimo de
                                        USD. 250 por evento y/o reclamo.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Demás amparados: 1% del valor del reclamo con un mínimo de
                                        USD. 200.- por
                                        evento y/o reclamo
                                    </td>
                                </tr>
                            </table>
                            <span style="font-weight: bold;">SECCIÓN IV:</span>Por evento y/o reclamo<br>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Para la cobertura de vidrios USD. 20.- por evento y/o reclamo
                                        demás
                                        coberturas:
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Para equipos con valores asegurados hasta USD. 50.000, 2% del
                                        valor del
                                        siniestro.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Para equipos con valores asegurados hasta USD. 250.000, 1.5%
                                        del valor del
                                        siniestro.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Para equipos con valores asegurados mayores a USD. 250.000,
                                        1% del valor del
                                        siniestro
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <span style="font-weight: bold;">EXCLUSIONES:</span><br>
                            De acuerdo a lo estipulado en el condicionado general y demás secciones de la póliza<br>
                            <span style="font-weight: bold;">SECCION I:</span>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Dinero, joyas y/o valores</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Bienes inmuebles que estén ubicados en el lecho o cercanía de
                                        rios
                                    </td>
                                </tr>
                            </table>
                            <span style="font-weight: bold;">SECCIÓN II:</span>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Satélites espaciales</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Software y licencias</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Daños por virus</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Daños mecánicos y eléctricos internos</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Demás exclusiones de acuerdo al condicionado general de la
                                        póliza.
                                    </td>
                                </tr>
                            </table>
                            <span style="font-weight: bold;">SECCIÓN III:</span>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">De acuerdo al condicionado general de la póliza.</td>
                                </tr>
                            </table>
                            <span style="font-weight: bold;">SECCIÓN IV:</span>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Equipos que operen bajo tierra</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Equipos que tengan placas de circulación</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Riesgos de perforación; riesgos petroleros y riesgos de gas
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Demás exclusiones de acuerdo al condicionado general de la
                                        póliza.
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <span style="font-weight: bold;">CLÁUSULAS ADICIONALES:</span>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Anexo para cubrir colapso de techos y/o paredes</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Valor de Reemplazo</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Elegibilidad de Ajustadores</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Rehabilitación Automática de la Suma Asegurada
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Flete Aéreo hasta el 5% del valor del reclamo
                                        máximo $us. 5.000.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Rescisión del Contrato a Prorrata sujeto a no
                                        siniestralidad durante la vigencia
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Daños por Incendio y/o Rayo directo o indirecto Aparatos
                                        Eléctricos
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Terremoto, temblor y erupciones volcánicas</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Riesgos Políticos y Terrorismo</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Robo con violencia a primer riesgo</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula para cubrir pérdidas y/o daños directos ocasionados
                                        por derrube, deslizamiento, asentamiento y/o corrimiento de tierras
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Hundimiento</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Gastos de Investigación y Salvamento hasta el 5%
                                        del valor del reclamo con una máximo a $us. 10.000.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Definición de Evento</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Errores y Omisiones</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de honorarios de Arquitectos, Ingenieros y
                                        Topografos.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de remoción de escombros</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Cláusula de Subrogación</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Anexo de Renovación Automática, hasta finalizar el crédito
                                    </td>
                                </tr>

                            </table>

                        </td>
                    </tr>
                </table>
            </div>

            <page>
                <div style="page-break-before: always;">&nbsp;</div>
            </page>

            <div style="width: 775px; border: 0px solid #FFFF00;">
                <table cellpadding="0" cellspacing="0" border="0"
                       style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                    <tr>
                        <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">De gastos extraordinarios, hasta el 20% del valor del
                                        reclamo, máximo $us 100.000.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Daños ocasionados por salvamento y la extinción de incendios,
                                        hasta el 5% del valor del reclamo, máximo $us. 10.000.-
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">De ampliación de aviso de siniestro hasta 15 días a partir de
                                        que el contratante tiene conocimiento del evento. queda establecido que
                                        cualquier reparación, arreglo o adquisición que el asegurado deba realizar para
                                        la reposición o reparación del bien dañado, debe contar con la autorización
                                        expresa de la compañía.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">De adelanto del 50% en caso de siniestro una vez declarado
                                        procedente el reclamo y habiéndose establecido el monto aproximado de la
                                        pérdida.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">De inclusiones y exclusiones.</td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">De traslado temporal, incluyendo uso, mantenimiento,
                                        reparación y daños durante su transporte (bajo cláusula L.A.P.)
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                    <td style="width:98%;">Ampliación de vigencia a prorrata, bajo los mismos términos y
                                        condiciones incluyendo tasas pactadas, hasta 90 días.
                                    </td>
                                </tr>
                                <!--<tr>
                                  <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                  <td style="width:98%;">Cláusula de hundimiento, siempre y cuando no sea gradual</td>
                                </tr>-->
                            </table>
                            <br>
                            <span style="font-weight: bold;">APLICABLES A LA SECCIÓN IV (EQUIPO MÓVIL)</span>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">Cobertura para el tránsito por sus propios medios, siempre y
                                        cuando el
                                        equipo móvil se traslade de un proyecto a otro, o a su garaje.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">-</td>
                                    <td style="width:98%;">De rehabilitación automática de la suma asegurada.</td>
                                </tr>
                            </table>
                            <br>
                            <span style="font-weight: bold;">CONDICIONES GENERALES Y EXCLUSIONES:</span>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">&bull;</td>
                                    <td style="width:98%;">De acuerdo al Condicionado General de Seguros y Reaseguros
                                        Credinform
                                        International S.A., para Póliza de Seguro Multiriesgo con Registro No.
                                        102-910951-2007 10 100
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <span style="font-weight: bold;">PROCEDIMIENTO EN CASO DE SINIESTRO:</span><br>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:100%;" valign="top">
                                        Al ocurrir un siniestro que pueda dar lugar a indemnización conforme a esta
                                        Póliza, el
                                        Asegurado deberá: a) Notificar el siniestro por escrito a la Compañía, via
                                        e-mail o fax, indicando la naturaleza y extensión de los daños, a más tardar
                                        dentro de los tres días de tener conocimiento del mismo, salvo fuerza mayor o
                                        impedimento justificado; b) Tomar todas las acciones dentro de sus medios para
                                        minimizar la pérdida o daño; c) Preparar una declaración firmada acerca del
                                        siniestro que contenga un detalle, dentro de lo razonablemente posible, acerca
                                        de sus causas, los ítems o partes afectadas y su valorización; d) El Asegurado
                                        no está facultado para abandonar ningún bien siniestrado a la Compañía, sea que
                                        este haya tomado posesión de él o no.
                                        <br>La Compañía debe pronunciarse sobre el derecho del asegurado dentro de los
                                        treinta días de recibidas la información y evidencia. Se dejará constancia
                                        escrita de la fecha de recepción de la información y evidencias a afecto del
                                        cómputo del plazo.<br/>

                                    </td>
                                </tr>
                            </table>
                        </td>

                        <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">

                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:100%;" valign="top">
                                        En caso de demora u omisión del asegurado en proporcionar la información y
                                        evidencias sobre el siniestro, el término señalado no corre hasta el
                                        cumplimiento de estas obligaciones.<br>
                                        Establecido el derecho del asegurado y el monto de la indemnización, la Compañía
                                        debe pagar su obligación según el contrato, dentro de los sesenta días
                                        siguientes.<br>
                                        Las partes intervinientes, acuerdan que toda discrepancia, cuestión o
                                        reclamación resultante de la ejecución o interpretación de la Póliza o
                                        relacionado con ella, directa o indirectamente, se resolverá definitivamente
                                        mediante Conciliación o Arbitraje en el marco del Centro de Conciliación y
                                        Arbitraje de la Cámara Nacional de Comercio y de acuerdo por la ley No. 1770 de
                                        fecha 10 de Marzo de 1997.
                                    </td>
                                </tr>
                            </table>
                            <br>
                            <span style="font-weight: bold;">IMPORTANTE:</span><br>
                            La responsabilidad indemnizatoria de la Compañía está limitada como máximo al Valor Total
                            Asegurado o
                            declarado, el cual no puede ser superior a USD. 4.000.000,00 ó sus equivalentes en Moneda
                            Nacional
                            (Bolivianos)<br><br>

                            <span style="font-weight: bold;">REQUISITOS:</span><br>
                            Avalúo técnico firmado por el perito designado por Banco PYME Ecofuturo o documento
                            equivalente, donde se
                            especifique la materia del seguro.<br><br>

                            <span style="font-weight: bold;">NOTAS ESPECIALES:</span><br>
                            El asegurado autoriza a la compañía de seguros a enviar el reporte a la central de riesgos
                            del mercado
                            de seguros acorde a las normativas reglamentarias de la autoridad de fiscalización y control
                            de
                            pensiones y seguros – APS.<br><br>

                            <span style="font-weight: bold;">ACEPTACIONES ESPECIALES:</span><br>

                            Los siguientes riesgos, deben ser consultados a la Compañía previo a la emisión de la
                            Póliza:
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width:2%;" valign="top">1.</td>
                                    <td style="width:98%;">Bienes inmuebles que estén ubicados en el lecho o cercanía de
                                        ríos
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">2.</td>
                                    <td style="width:98%;">Riesgos textiles incluyendo riesgos azucareros y
                                        algodoneros
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">3.</td>
                                    <td style="width:98%;">Riesgos mineros</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">4.</td>
                                    <td style="width:98%;">Fábricas de plástico, plastoformo, polietileno, papel,
                                        cartón, algodón
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">5.</td>
                                    <td style="width:98%;">Discotecas, Pubs y Karaokes</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">6.</td>
                                    <td style="width:98%;">Ferias, exposición y eventos</td>
                                </tr>
                                <tr>
                                    <td style="width:2%;" valign="top">7.</td>
                                    <td style="width:98%;">Industrias químicas y/o todas aquellas donde los insumos sean
                                        sustancias
                                        inflamables y/o pinturas
                                    </td>
                                </tr>
                            </table>
                            Nota: Estos riesgos deben ser previamente aprobados por la compañía, en caso de no ser así
                            el
                            certificado de cobertura entregado al cliente no tendrá cobertura.

                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto;">
                                <tr>
                                    <td style="width:25%;"></td>
                                    <td style="width:35%;"></td>
                                    <td style="width:40%;">
                                        <table cellpadding="0" cellspacing="0" border="0"
                                               style="width: 100%; height: auto; font-family: Arial;">
                                            <tr>
                                                <td valign="top" align="center" style="width:50%;">
                                                    <img src="{{ asset('images/firma1.jpg') }}" width="110"
                                                         height="50"/><br>
                                                    MIGUEL ANGEL BARRAGAN
                                                </td>
                                                <td valign="top" align="center" style="width:50%;">
                                                    <img src="{{ asset('images/firma2.jpg') }}" width="94" height="50"/><br>
                                                    MARIANA JAUREGUI Q
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:25%; border-top:1px solid #999; text-align:center;">Firma del
                                        Titular Solicitante
                                    </td>
                                    <td style="width:35%;">&nbsp;</td>
                                    <td style="width:40%; border-top:1px solid #999; text-align:center;">Firmas
                                        Autorizadas de la Compañia
                                    </td>
                                </tr>
                            </table>

                            <table cellpadding="0" cellspacing="0" border="0"
                                   style="width: 100%; height: auto; margin-top:4px;">
                                <tr>
                                    <td style="width:5%; text-align:left;">C.I.</td>
                                    <td style="width:15%; border-bottom:1px solid #999; text-align:center;">
                                        {{$query_client->dni}} {{$query_client->complement}}
                                    </td>
                                    <td style="width:2%;">&nbsp;</td>
                                    <td style="width:12%; text-align:right;">Expedido en:</td>
                                    <td style="width:12%; border-bottom:1px solid #333; text-align:center;">
                                        {{$query_client->extension}}
                                    </td>
                                    <td style="width:54%;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="width:46%; padding-top:5px;" colspan="5">
                                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                            <tr>
                                                <td style="width:20%; text-align:left;">Lugar y fecha:</td>
                                                <td style="width:50%; border-bottom:1px solid #999; text-align:center;">
                                                    {{$query_header->place}} {{date('d/m/Y', strtotime($query_header->date_issue))}}
                                                </td>
                                                <td style="width:30%;">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width:54%;" align="right" style="font-size:6pt;">&nbsp;“Impreso
                                        el {{date("d/m/Y")}}. El presente certificado reemplaza cualquier otro
                                        certificado impreso en fechas anteriores a la indicada.”
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        @endif

    </div>
</div>

