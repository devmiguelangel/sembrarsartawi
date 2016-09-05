<div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 5px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">
        @var $font_size_parent = 'font-size:57%;'
        @var $font_size_child = 'font-size:100%;'
        @var $font_size_content_parent = 'font-size:48%;'
        @var $font_size_content_child = 'font-size:100%;'
        @if($type=='PDF')
            @var $font_size_parent = 'font-size:48%;'
            @var $font_size_child = 'font-size:48%;'
            @var $font_size_content_parent = 'font-size:40%;'
            @var $font_size_content_child = 'font-size:40%;'
        @endif
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 2px;">
            <tr>
                <td style="width:20%; border: 0px solid #FFFF00; vertical-align: middle;" align="left" valign="top">

                </td>
                <td style="width:60%; font-weight:bold; text-align:center; line-height: 0.9em;">
                    <div style="{{$font_size_parent}}">
                        SEGURO DE DESGRAVAMEN HIPOTECARIO/ SOLICITUD DE SEGURO, DECLARACI&Oacute;N DE SALUD Y BENEFICIARIOS
                    </div>
                    <div style="{{$font_size_parent}}">
                        Aprobada por R.A.- APS/DS/N&deg; 306 del 17 de Abril de 2014<br/>
                        COD. 207 &#45; 934901 &#45; 1999 11 003 3024
                    </div>
                </td>
                <td style="width:20%; vertical-align: middle;" align="right" valign="top">

                </td>
            </tr>
        </table>

        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; line-height: 1em; margin-bottom: 2px;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}">
                <tr>
                    <td style="width: 30%;">
                        No de Certificado DE-{{$query_header->issue_number}}
                    </td>
                    <td style="width: 40%;"></td>
                    <td style="width: 30%;" align="right">
                        <strong>copia</strong>
                    </td>
                </tr>
            </table>
        </div>
        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; line-height: 1em; margin-bottom: 5px;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}">
                <tr>
                    <td style="width: 100%;">Ud(s). Solicita(n) el seguro (alcance de cobertura) de tipo:</td>
                </tr>
                <tr>
                    <td style="width: 100%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}">
                            <tr>
                                <td style="width: 4.5%;">Individual&nbsp;&nbsp;</td>
                                <td style="width: 2%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                                        @if($query_header->slug_coverage=='IC')
                                            x
                                        @endif
                                    </div>
                                </td>
                                <td style="width: 43.5%;">Si marca esta opci&oacute;n, solo debe completar la informaci&oacute;n requerida al TITULAR 1</td>
                                <td style="width: 6.5%;">Mancomunada&nbsp;&nbsp;</td>
                                <td style="width: 2%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                                        @if($query_header->slug_coverage=='MC')
                                            x
                                        @endif
                                    </div>
                                </td>
                                <td style="width: 41.5%;" valign="bottom">Si marca esta opci&oacute;n, debe completar la informaci&oacute;n requerida al TITULAR 1 y al TITULAR 2</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%;">
                        Si hubiesen m&aacute;s solicitantes (codeudores), &eacute;stos deben completar declaraciones de salud adicionales
                    </td>
                </tr>
            </table>
        </div>

        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; line-height: 1em; margin-bottom: 5px;">
            DATOS PERSONALES
        </div>
        @var $i=1;
        @foreach($query_details as $data_cl)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="padding: 2px 0; border: 1px solid #000000;" colspan="4">INFORMACION SOBRE EL TITULAR {{$i}}</td>
                </tr>
                <tr>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        1.- Apellido Paterno
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">{{$data_cl->last_name}}</p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        2.- Apellido Materno
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">{{$data_cl->mother_last_name}}</p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        3.- Apellido de Casada
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">
                            @if($data_cl->civil_status=='C')
                                {{$data_cl->married_name}}
                            @endif
                        </p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        4.- Nombres Completos
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">{{$data_cl->first_name}}</p>
                    </td>
                </tr>
            </table>
            @var $fecha = date('d/m/Y', strtotime($data_cl->birthdate));
            @var $array = explode('/',$fecha);
            @var $day = $array[0];
            @var $month = $array[1];
            @var $year = $array[2];
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="width: 20%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        5.- Sexo
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">Masculino(&nbsp;{{$data_cl->gender=='M'?'x':''}}&nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Femenino(&nbsp;{{$data_cl->gender=='F'?'x':''}}&nbsp;)</p>
                    </td>
                    <td style="width: 18%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        6.- Fecha de Nacimiento
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;"> Dia:&nbsp; {{$day}}&nbsp; Mes:&nbsp; {{$month}}&nbsp; Año:&nbsp; {{$year}}</p>
                    </td>
                    <td style="width: 5%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        7.- Edad
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">{{$data_cl->age}}</p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        8.- Ciudad y Pais de Nacimiento
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">{{$data_cl->city}}&nbsp;{{$data_cl->country}}</p>
                    </td>
                    <td style="width: 32%; border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        9.- Tipo y N&uacute;mero de Carnet de Identidad
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">{{$data_cl->document_type}}&nbsp;{{$data_cl->dni.''.$data_cl->complement.''.$data_cl->extension}}</p>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="width: 7%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        10.- Peso (Kg)
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$data_cl->weight}}</p>
                    </td>
                    <td style="width: 8%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        11.- Estatura (cm)
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$data_cl->height}}</p>
                    </td>
                    <td style="width: 34%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        12.- Direcci&oacute;n y n&uacute;mero de Domicilio
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$data_cl->home_address}}&nbsp;{{$data_cl->home_number}}</p>
                    </td>
                    <td style="width: 14%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        13.- Tel&eacute;fonos
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$data_cl->phone_number_home.' '.$data_cl->phone_number_mobile.' '.$data_cl->phone_number_office}}</p>
                    </td>
                    <td style="width: 26%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        14.- Ocupaci&oacute;n
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$data_cl->occupation}}</p>
                    </td>
                    <td style="width: 11%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        15.- Porcentaje Cr&eacute;dito
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$data_cl->percentage_credit}}</p>
                    </td>
                </tr>
            </table>
            @var $parameter_term = config('base.client_hands')
            @if(!is_null($data_cl->hand))
                @var $type_hand = $parameter_term[$data_cl->hand]
            @else
                @var $type_hand = ''
            @endif
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 5px;">
                <tr>
                    <td style="width: 60%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        16.- &iquest;C&uacute;al es su actividad cotidiana ligada al cr&eacute;dito que usted solicita?
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$data_cl->occupation_description}}</p>
                    </td>
                    <td style="width: 40%; border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        17.- Para escribir y/o firmar &iquest;qu&eacute; mano utiliza?
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px;">{{$type_hand}}</p>
                    </td>
                </tr>
            </table>
            @var $i=$i+1
        @endforeach
        @if(count($query_details)<2)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="padding: 2px 0; border: 1px solid #000000;" colspan="4">INFORMACION SOBRE EL TITULAR 2</td>
                </tr>
                <tr>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        1.- Apellido Paterno
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        2.- Apellido Materno
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        3.- Apellido de Casada
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        4.- Nombres Completos
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="width: 20%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        5.- Sexo
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">Masculino(&nbsp;  &nbsp;)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Femenino(&nbsp; &nbsp;)</p>
                    </td>
                    <td style="width: 18%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        6.- Fecha de Nacimiento
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 5%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        7.- Edad
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 25%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        8.- Ciudad y Pais de Nacimiento
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 32%; border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        9.- Tipo y N&uacute;mero de Carnet de Identidad
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="width: 7%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        10.- Peso (Kg)
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 7%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        11.- Estatura
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 34%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        12.- Direcci&oacute;n y n&uacute;mero de Domicilio
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 14%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        13.- Tel&eacute;fonos
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 26%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        14.- Ocupaci&oacute;n
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 12%;  border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        15.- Porcentaje Cr&eacute;dito
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="width: 60%; border-left: 1px solid #000000; border-bottom: 1px solid #000000;">
                        16.- &iquest;C&uacute;al es su actividad cotidiana ligada al cr&eacute;dito que usted solicita?
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                    <td style="width: 40%; border-left: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;">
                        17.- Para escribir y/o firmar &iquest;qu&eacute; mano utiliza?
                        <p style="display:block; margin: 0; padding: 1px 0 1px 5px; height: 10px;">&nbsp;</p>
                    </td>
                </tr>
            </table>
        @endif
                    <!--CUESTIONARIO-->
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 5px; margin-top: 5px;">
            <tr>
                <td colspan="2" style="text-align: left;"><label style="font-weight: bold;">CUESTIONARIO</label></td>
                <td style="width: 12%;" align="center">TITULAR 1</td>
                <td style="width: 8%;"></td>
                <td style="width: 12%;" align="center">TITULAR 2</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left;"></td>
                <td style="width: 12%;" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px; {{$font_size_child}}">
                        <tr>
                            <td style="width: 20%; padding-left: 3px;">
                                SI
                            </td>
                            <td style="width: 60%;">

                            </td>
                            <td style="width: 20%; padding-left: 3px;">
                                NO
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 8%;"></td>
                <td style="width: 12%;" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px; {{$font_size_child}}">
                        <tr>
                            <td style="width: 20%; padding-left: 3px;">
                                SI
                            </td>
                            <td style="width: 60%;">

                            </td>
                            <td style="width: 20%; padding-left: 3px;">
                                NO
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            @var $j = 1
            @foreach($question as $key => $data_quest)
                <tr>
                    <td valign="top" style="width: 3%; text-align: center;">{{ $j }}. </td>
                    <td style="width: 65%;">{{$key}}</td>
                    @var $nq = 1;
                    @foreach($data_quest as $response)
                        <td style="width: 12%;">
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px; {{$font_size_child}}">
                                <tr>
                                    <td style="width: 20%; padding-left: 3px;">
                                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                                            {{$response == true ? 'x':''}}
                                        </div>
                                    </td>
                                    <td style="width: 60%;">

                                    </td>
                                    <td style="width: 20%; padding-left: 3px;">
                                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                                            {{$response == false ? 'x':''}}
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        @if($nq < count($query_details))
                            <td style="width: 8%;"></td>
                        @endif
                        @var $nq = $nq + 1;
                    @endforeach
                    @if(count($query_details)<2)
                        <td style="width: 8%;"></td>
                        <td style="width: 12%;">
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px; {{$font_size_child}}">
                                <tr>
                                    <td style="width: 20%; padding-left: 3px;">
                                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">

                                        </div>
                                    </td>
                                    <td style="width: 60%;">

                                    </td>
                                    <td style="width: 20%; padding-left: 3px;">
                                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">

                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    @endif
                </tr>
                @var $j = $j+1
            @endforeach
        </table>
        <div style="{{$font_size_parent}} font-family: Arial; line-height: 1em; margin-bottom: 5px; text-align: justify;">
            Si ha contestado afirmativamente alguno de los puntos del 2 al 8, detallar los mismos señalando además cúando ocurrió,
            duración, tratamiento, fecha de curación, secuelas y observaciones u otros
        </div>
        @var $ti = 1;
        @foreach($query_details as $data_cl)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 10%;">TITULAR {{$ti}}: </td>
                    <td style="width: 90%;" class="border-bottom">
                        @if($facul_q['fac'][$ti]==false)
                            {{$data_cl->observation}}
                        @endif
                    </td>
                </tr>
            </table>
            @var $ti = $ti + 1
        @endforeach
        @if(count($query_details)<2)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 10%;">TITULAR 2: </td>
                    <td style="width: 90%;" class="border-bottom">

                    </td>
                </tr>
            </table>
        @endif
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; {{$font_size_parent}} margin-bottom: 5px;">
            Declaro(amos) que las respuestas que he(mos) consignado en esta solicitud son verdaderas y completas y que es de mi
            (nuestro) conocimiento que cualquier declaraci&oacute;n reticente o inexacta, omisi&oacute;n u ocultaci&oacute;n
            dar&aacute; lugar a la impugnaci&oacute;n del contrato y por lo tanto har&aacute; perder todos los beneficios dentro
            de los dos primeros a&ntilde;os de vigencia del contrato de seguro, de acuerdo con lo establecido en el art&iacute;culo
            1138 del C&oacute;digo de Comercio.<br />
            Declaro(amos) beneficiario a titulo oneroso de &eacute;sta p&oacute;liza a BANCO PYME ECOFUTURO S.A. para el pago del
            saldo deudor existente, en caso de sinistro cubierto de acuerdo a los t&eacute;rminos y condiciones del Seguro.<br />
            Asimismo autorizo(amos) a los m&eacute;dicos, cl&iacute;nicas hospitales y otros centros de salud que me (nos) hayan
            atendido o que me (nos) atiendan en el futuro, para que proporcionen a Alianza Vida todos los resultados de los informes
            referentes a mi (nuestra) salud, en caso de enfermedad o accidente, para lo cual releva a dichos m&eacute;dicos y centros
            m&eacute;dicos en relaci&oacute;n con su secreto profesional de toda responsabilidad en que pudiera incurrir al
            proporcionar tales informes. Asimismo, autorizo(amos) a Alianza Vida a proporcionar resultados a BANCO PYME ECOFUTURO S.A.
            Asimismo me (nos) comprometo(emos) a hacer conocer a los beneficiarios la existencia de este Seguro y sus terminos y condiciones. <br /><br />
        </div>
        <div style="{{$font_size_parent}} font-family: Arial; line-height: 1em; margin-bottom: 5px;">
            BENEFICIARIO PARA SEPELIO: El Asegurado debe designar como beneficiario para la cobertura adicional de sepelio a la persona
            que a su fallecimiento recibirá el Capital que la Compañía otorga en esta cobertura.
        </div>
        <!--BENEFICIARIES-->
        @var $db = 1
        @foreach($beneficiary as $data_benef)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td colspan="5" style="font-weight: bold; text-align: left;">
                        TITULAR {{$db}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: center;">{{$data_benef['last_name']}}</td>
                    <td style="width: 20%; text-align: center;">{{$data_benef['mother_last_name']}}</td>
                    <td style="width: 20%; text-align: center;">{{$data_benef['first_name']}}</td>
                    <td style="width: 20%; text-align: center;">{{$data_benef['relationship']}}</td>
                    <td style="width: 20%; text-align: center;">{{$data_benef['dni'].' '.$data_benef['extension']}}</td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Apellido Paterno</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Apellido Materno</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Nombres</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Parentesco</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">C.I./RUN</td>
                </tr>
            </table>
            @var $db = $db + 1
        @endforeach
        @if(count($beneficiary)<2)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td colspan="5" style="font-weight: bold; text-align: left;">
                        TITULAR 2
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: center;"></td>
                    <td style="width: 20%; text-align: center;"></td>
                    <td style="width: 20%; text-align: center;"></td>
                    <td style="width: 20%; text-align: center;"></td>
                    <td style="width: 20%; text-align: center;"></td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Apellido Paterno</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Apellido Materno</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Nombres</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Parentesco</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">C.I./RUN</td>
                </tr>
            </table>
        @endif
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 5px;">
            <tr>
                <td style="width: 9%; text-align: left;">Lugar y fecha:</td>
                <td style="width: 20%; border-bottom: 1px solid #080808;">{{$query_header->city.' - '.$query_header->date_issue}}</td>
                <td style="width: 71%;"></td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding: 20px 0 5px 0;">
            <tr>
                <td style="width: 10%;"></td>
                <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">FIRMA DEL SOLICITANTE (TITULAR 1)</td>
                <td style="width: 10%;"></td>
                <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">FIRMA DEL SOLICITANTE (TITULAR 2)</td>
                <td style="width: 10%;"></td>
            </tr>
        </table>


        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 5px;">
            <tr>
                <td style="width: 100%; text-align: left; padding-top: 4px;">
                    <b>NOTA:</b> La Compa&ntilde;ia se reserva el derecho de solicitar examen(es) m&eacute;dico(s) o informaci&oacute;n adicional.<br>
                    <b>DEL CR&Eacute;DITO SOLICITADO (A ser completado por la Entidad Financiera)</b>
                </td>
            </tr>
            <tr>
                <td style="width: 100%;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                        <tr>
                            <td style="width: 40%;">TIPO DE OPERACI&Oacute;N / MOVIMIENTO: </td>
                            <td style="width: 12%;"></td>
                            <td style="width: 12%;"></td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}} margin-bottom: 4px;">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Primera/&Uacute;nica &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->movement_type == 'FS' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Adicional &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->movement_type == 'AD' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">L&iacute;nea de Cr&eacute;dito &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->movement_type == 'LC' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">TIPO DE CR&Eacute;DITO: </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Hipotecario &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->slug_credit_product == 'PMO' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Comercial &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->slug_credit_product == 'PCM' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Consumo &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->slug_credit_product == 'PCS' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Tarjetas &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->slug_credit_product == 'PCA' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Otros &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->slug_credit_product == 'POT' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">MONEDA: </td>
                            <td style="width: 12%;"></td>
                            <td style="width: 12%;"></td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}} margin-top: 4px;">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">D&oacute;lares &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->currency == 'USD' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}} margin-top: 4px;">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">Bolivianos &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                                {{$query_header->currency == 'BS' ? 'x':''}}
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 12%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 85%; text-align: right;">UFV &nbsp;</td>
                                        <td style="width: 10%;">
                                            <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">

                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    @foreach($query_details as $data_cl)
                        @if($data_cl->headline=='D')
                            @var $saldo_deudor_actual = $data_cl->balance
                            @var $monto_actual_acumulado = $data_cl->cumulus
                        @endif
                    @endforeach
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                        <tr>
                            <td style="width: 22%;">SALDO DEUDOR ACTUAL DEL ASEGURADO: </td>
                            <td style="width: 18%;">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%; border-bottom: 1px solid #000000;">
                                            {{number_format($saldo_deudor_actual,2,'.',',')}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 6%">SUCURSAL: </td>
                            <td style="width: 12.5%">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%; border-bottom: 1px solid #000000;">
                                            {{$query_header->city}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 6%">TEL&Eacute;FONO: </td>
                            <td style="width: 12.5%">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%; border-bottom: 1px solid #000000;">&nbsp;</td></tr>
                                </table>
                            </td>
                            <td style="width: 23%"></td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                        <tr>
                            <td style="width: 17%">MONTO ACTUAL SOLICITADO: </td>
                            <td style="width: 26%">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%; border-bottom: 1px solid #000000;">
                                            {{number_format($query_header->amount_requested,2,'.',',')}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 57%"></td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                        <tr>
                            <td style="width: 17%">MONTO ACTUAL ACUMULADO: </td>
                            <td style="width: 26%">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%; border-bottom: 1px solid #000000;">
                                            {{number_format($monto_actual_acumulado,2,'.',',')}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 7%">FUNCIONARIO: </td>
                            <td style="width: 20%">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%; border-bottom: 1px solid #000000;">
                                            {{$query_header->full_name}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 30%"></td>
                        </tr>
                    </table>
                    @var $parameter_term = config('base.term_types')
                    @var $type_term = $parameter_term[$query_header->type_term]
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                        <tr>
                            <td style="width: 20%">PLAZO DEL PRESENTE CR&Eacute;DITO: </td>
                            <td style="width: 35%">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%; border-bottom: 1px solid #000000;">
                                            {{$query_header->term.' '.$type_term}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td style="width: 13%">NOMBRE, SELLO Y  FIRMA: </td>
                            <td style="width: 32%">
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr><td style="width: 100%; border-bottom: 1px solid #000000;">&nbsp;</td></tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 100%;">
                    Emisi&oacute;n de certificado de acuerdo a Slip de Cotizaci&oacute;n No.<br>
                    “Impreso el {{date("d/m/Y")}}. El presente certificado reemplaza cualquier otro certificado impreso en fechas anteriores a la indicada.”
                </td>
            </tr>
        </table>

            <!--renglon 1-->
            @if((boolean)$query_header->facultative === true)
                @if((boolean)$query_header->approved === true)
                    <!--renglon 2-->
                    <table border="0" cellpadding="1" cellspacing="0" style="width: 100%; font-size: 8px; font-weight: normal; font-family: Arial; margin: 5px 0 0 0; padding: 0; border-collapse: collapse; vertical-align: bottom;">
                        <tr>
                            <td colspan="6" style="width:100%; text-align: center; font-weight: bold; background: #e57474; color: #FFFFFF;">
                                Caso Facultativo
                            </td>
                        </tr>
                        <tr>
                            <td style="width:5%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                         background: #e57474;">Aprobado</td>
                            <td style="width:5%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                         background: #e57474;">Tasa de Recargo</td>
                            <td style="width:7%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                         background: #e57474;">Porcentaje de Recargo</td>
                            <td style="width:7%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                         background: #e57474;">Tasa Actual</td>
                            <td style="width:7%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                         background: #e57474;">Tasa Final</td>
                            <td style="width:69%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                             background: #e57474;">Respuesta de la Compañía</td>
                        </tr>
                        @foreach($query_details as $data_fac)
                            @if(!is_null($data_fac->percentage))
                                <tr>
                                    <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF;
                                         border: 1px solid #dedede;">{{$data_fac->approved==1?'SI':'NO'}}</td>
                                    <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF;
                                         border: 1px solid #dedede;">{{$data_fac->surcharge==1?'SI':'NO'}}</td>
                                    <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                                         border: 1px solid #dedede;">{{$data_fac->percentage}}</td>
                                    <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                                         border: 1px solid #dedede;">{{$data_fac->current_rate}} %</td>
                                    <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                                         border: 1px solid #dedede;">{{$data_fac->final_rate}} %</td>
                                    <td style="width:69%; text-align: justify; background: #e78484; color: #FFFFFF;
                                             border: 1px solid #dedede;">
                                        <span style="color:#ffffff;">{{$data_fac->observation}}</span>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        <tr>
                            <td style="text-align: justify; background: #e78484; color: #FFFFFF; border: 1px solid #dedede;" colspan="6">
                                <span style="color:#000000;">Observaciones:</span> {{$query_header->facultative_observation}}
                            </td>
                        </tr>
                    </table>

                @else

                    <table border="0" cellpadding="1" cellspacing="0" style="width: 80%; font-size: 9px; border-collapse: collapse; font-weight: normal; font-family: Arial; margin: 2px 0 0 0; padding: 0; border-collapse: collapse; vertical-align: bottom;">
                        <tr>
                            <td  style="text-align: center; font-weight: bold; background: #e57474; color: #FFFFFF;">
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
                            <!--
            <div style="width: 770px; border-top: 1px solid #000000; text-align:center; font-size: 56%; line-height: 0.9em; margin-top: 10px;">
                Centro de llamadas 800-10-2727<br>
                www.lbc.bo
            </div>
            -->

                    <page><div style="page-break-before: always;">&nbsp;</div></page>

                    @if($query_header->issued == 1 && $query_header->canceled == 0)
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 2px;">
                            <tr>
                                <td style="width:100%; font-weight:bold; text-align:center; line-height: 0.9em;">
                                    <div style="{{$font_size_content_parent}}">
                                        SEGURO DE DESGRAVAMEN HIPOTECARIO CERTIFICADO DE COBERTURA INDIVIDUAL
                                        <br />
                                        Aprobada por R.A.- APS/DS/N&deg; 306 del 17 de Abril del 2014
                                        <br/>
                                        COD. 207 - 934901 - 1999 11 003 4003
                                    </div>
                                    <div style="{{$font_size_content_parent}}">
                                        Código Asignado S.P.V.S.: 204-934904-2007 07 049-4004
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_content_parent}} font-family: Arial;">
                            <tr>
                                <td style="width: 50%;">
                                    <div style="text-align: justify;">
                                        El presente Certificado de Cobertura Individual, tan solo representa un documento referencial. En caso que el Asegurado desee conocer inextenso las normas, t&eacute;rminos y condiciones del seguro, &eacute;ste deber&aacute;; referirse &uacute;nicamente a la P&oacute;liza original, la misma que se encuentra en posesi&oacute;n del Tomador.
                                        <br />
                                        <b>TOMADOR:</b> BANCO PYME ECOFUTURO S.A.<br/>
                                        <b>ASEGURADO:</b> Datos que figuran en Titular 1 y/o Titular 2 en la declaraci&oacute;n de salud (reverso) y/o Cotitulares adicionales
                                        <br/>
                                        <b>GRUPO ASEGURADO:</b> Clientes de Cartera del Tomador<br/>
                                        <b>ACTIVIDAD GENERAL:</b> Varias y sin limitaciones<br />

                                        <b>COBERTURAS:</b><br/>
                                        <b>PRINCIPAL:</b><br/>
                                        <b>A)</b> Muerte por cualquier Causa, que no est&eacute; excluida en el Condicionado General de la P&oacute;liza incluido el suicidio despu&eacute;s de dos a&ntilde;os de vigencia ininterrumpida de la cobertura individual del seguro.
                                        <br />

                                        <b>ADICIONALES:</b><br/>
                                        <b >B)</b> Pago anticipado del capital asegurado en caso de invalidez total y permanente por accidente o enfermedad, en forma irreversible por lo menos en un 60% seg&uacute;n el manual de normas autorizado por la AUTORIDAD DE FISCALIZACION Y CONTROL SOCIAL DE PENSIONES, en actual vigencia.
                                        <br/>
                                        <b >C)</b> Gastos de Sepelio, son los gastos que demanden los herederos legales o nominados por el Sepelio de un Asegurado (titular o c&oacute;nyuge), como consecuencia del fallecimiento por una enfermedad o un accidente cubierto, por un monto de $us 200.- por asegurado, establecido para esta cobertura, para el titular o c&oacute;nyuge.
                                        <br />
                                        <b>CAPITALES ASEGURADOS:<br/>COBERTURA PRINCIPAL:</b><br/>

                                        <b >A)</b> Saldo Deudor.<br />
                                        <b>COBERTURAS ADICIONALES:</b><br/>
                                        <b >B)</b> Saldo deudor<br/>
                                        <b >C)</b> $us 200.-<br/>

                                        <b>EXCLUSIONES:</b> La Compa&ntilde;&iacute;a no cubre y esta eximida de toda responsabilidad en caso de fallecimiento del asegurado en los siguientes casos:
                                        <br />
                                    </div>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}} text-align: justify;">
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">a.</td>
                                            <td style="width:98%;">Si el asegurado participa como conductor o acompa&ntilde;ante en competencias de autom&oacute;viles,  motocicletas, lanchas de motor o avionetas, practicas de paracaidismo, aledeltismo, cacer&iacute;a de cualquier tipo, u otra actividad que represente alto riesgo;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">b.</td>
                                            <td style="width:98%;">Si el asegurado realiza operaciones o viajes submarinos o en transportes a&eacute;reos no autorizados para transporte de pasajeros;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">c.</td>
                                            <td style="width:98%;">Si el Asegurado participa como elemento activo en guerra internacional o civil, rebeli&oacute;n,  sublevaci&oacute;n guerrilla, mot&iacute;n, huelgas, revoluci&oacute;n y todo emergencia como consecuencia de alteraci&oacute;n del orden p&uacute;blico, a no ser que se pruebe que la muerte ocurri&oacute; independientemente de la existencia de tales condiciones anormales
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">d.</td>
                                            <td style="width:98%;">Enfermedades pre-existentes conocidas al inicio del seguro o enfermedades cong&eacute;nitas, para cr&eacute;ditos mayores a $us. 5.000.- &oacute; Bs. 35.000.- dentro de los plazos establecidos en el art&iacute;culo 1138 del C&oacute;digo de Comercio.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">e.</td>
                                            <td style="width:98%;">SIDA/HIV para siniestros a partir de $us. 5.000.- &oacute; Bs. 35.000.-
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">f.</td>
                                            <td style="width:98%;">Suicidio practicado por el asegurado dentro de los dos primeros a&ntilde;os de vigencia ininterrumpida.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">g.</td>
                                            <td style="width:98%;">Guerra, invasi&oacute;n, actos de enemigos extranjeros, hostilidades u operaciones b&eacute;licas, sea que haya habido declaraci&oacute;n de guerra, guerra civil, insurrecci&oacute;n, sublevaci&oacute;n, rebeli&oacute;n, sedici&oacute;n, mot&iacute;n o conmoci&oacute;n contra el orden p&uacute;blico, dentro o fuera del pa&iacute;s, as&iacute; como cuando  el  asegurado  participe  activamente  en  actos  subversivos,  terroristas o delincuenciales.</td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">h.</td>
                                            <td style="width:98%;">Fisi&oacute;n o fusi&oacute;n nuclear, contaminaci&oacute;n radioactiva.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">i.</td>
                                            <td style="width:98%;">Actos delictuoso cometido en calidad de autor o c&oacute;mplice, por un beneficiario o quien pudiere reclamar la indemnizaci&oacute;n.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:2%;" align="left" valign="top">j.</td>
                                            <td style="width:98%;">Esta p&oacute;liza tampoco cubre a personas mayores de los l&iacute;mites de edad estipulados.
                                            </td>
                                        </tr>
                                    </table>
                                    <div style="text-align: left;">
                                        <b>PERIODO DE CARENCIA PARA SINIESTROS CON DESEMBOLSO MAYOR A $us. 5.000.- &oacute; Bs. 35.000.-:</b>
                                        <br/>
                                        Se establece un periodo de carencia de 90 d&iacute;as para fallecimiento por enfermedad, computables a partir de la fecha de desembolso del cr&eacute;dito.
                                        <br />

                                        <b>PERIODO DE CARENCIA PARA SINIESTROS CON DESEMBOLSO MENOR A $us. 5.000.- &oacute; Bs. 35.000.-:</b>
                                        <br/>
                                        Se establece un periodo de carencia de 90 d&iacute;as para fallecimiento por enfermedad, computables a partir de la fecha de desembolso del cr&eacute;dito.
                                        <br />

                                        <b>EDAD DE ADMISI&Oacute;N Y PERMANENCIA:</b><br/>

                                        <strong>A) Muerte por cualquier causa y C) Sepelio</strong><br/>
                                        De admisi&oacute;n: M&iacute;nima: 18 a&ntilde;os <span style="margin-left: 30px; display: inline-block;">M&aacute;xima: 70 a&ntilde;os (Hasta cumplir 71 a&ntilde;os)</span><br/>
                                        De Permanencia: <span style="margin-left: 30px; display: inline-block;">M&aacute;xima: 76 a&ntilde;os (Hasta cumplir 77 a&ntilde;os)</span><br />

                                        <b style="margin-top: 3px;">B) <b>Invalidez Total y Permanente</b>:</b><br/>
                                        De admisi&oacute;n: M&iacute;nima: 18 a&ntilde;os <span style="margin-left: 30px; display: inline-block;">M&aacute;xima: 64 a&ntilde;os (Hasta cumplir 65 a&ntilde;os)</span><br/>
                                        De Permanencia: <span style="margin-left: 30px; display: inline-block;">M&aacute;xima: 70 a&ntilde;os (Hasta cumplir 71 a&ntilde;os)</span>
                                        <br />
                                        <b style="margin-top: 3px;">TASA MENSUAL TOTAL:</b>
                                        <span style="margin-left: 30px; display: inline-block;">{{$query_header->total_rate}}% o por mil mensual</span><br/>
                                        <b>PRIMA:</b> De acuerdo a declaraciones mensuales del contratante
                                        <br/>
                                        <b>FORMA DE PAGO:</b> Contado a trav&eacute;s de BANCO PYME ECOFUTURO S.A.
                                        <br/>
                                        <b style="margin-top: 3px;">BENEFICIARIO:</b> BANCO PYME ECOFUTURO S.A. A T&Iacute;TULO ONEROSO
                                        <br />
                                        <b style="margin-top: 3px;">OBSERVACIONES: </b>
                                        Las primas de este seguro no constituyen hecho generador de tributo seg&uacute;n el Art. No. 54 de la Ley de Seguros 1883 del 25 de Junio de 1998 y a la Resoluci&oacute;n Ministerial Nro. 880 del 28 de Junio de 1999. Autorizo a la compa&ntilde;&iacute;a mi reporte a la Central de Riesgos del Mercado de Seguros, acorde a las normativas reglamentarias de la Autoridad de Fiscalizaci&oacute;n y Control de Pensiones y Seguros.
                                        <br/>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}}">
                                        <tr>
                                            <td style="width:20%;" align="left">
                                                <b>INTERMEDIARIO:<br/>
                                                    DIRECCION:<br/>TELEFONO</b>
                                            </td>
                                            <td style="width:80%;" align="left">
                                                SUDAMERICANA SRL<br/>
                                                Prolongaci&oacute;n Cordero N&deg; 163, San Jorge, La Paz
                                                <br/>2433500&nbsp;&nbsp;&nbsp;
                                                <b>FAX:</b> 2128329
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 50%;" valign="top">
                                    <div style="text-align: justify;">
                                        <b style="margin-top: 3px;">ADHESI&Oacute;N VOLUNTARIA AL SEGURO:</b>
                                        <br/>
                                        Se deja expresamente establecido que el Asegurado que figura en el presente Nota de Cobertura Individual, ha aceptado y consentido voluntariamente su inclusi&oacute;n en la P&oacute;liza, cuyo n&uacute;mero figura en el t&iacute;tulo del Certificado.

                                        <br/>
                                        <b style="margin-top: 3px;">AVISO DE SINIESTRO: </b>
                                        En caso de fallecimiento o invalidez total y permanente del Asegurado, el tomador, tan pronto y a m&aacute;s tardar dentro de los 90 d&iacute;as calendario siguientes de tener conocimiento del siniestro, debe comunicar el mismo a la Compa&ntilde;&iacute;a, salvo fuerza mayor o impedimento justificado, caso contrario la Compa&ntilde;&iacute;a se libera de cualquier responsabilidad indemnizatoria por extemporaneidad.

                                        <br/>
                                        <b style="margin-top: 3px;">PAGO DE SINIESTRO: </b>
                                        En caso de muerte o Invalidez Total y Permanente del asegurado, la indemnizaci&oacute;n del capital asegurado ser&aacute; pagada a BANCO PYME ECOFUTURO S.A., en su calidad de beneficiario a t&iacute;tulo oneroso, como m&aacute;ximo a los 15 d&iacute;as a partir de la presentaci&oacute;n de documentos, de acuerdo al siguiente detalle:

                                        <br/>
                                        <b style="margin-top: 3px;">Para siniestros hasta $us. 5.000.- &oacute; Bs. 35.000.-</b>
                                    </div>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}} text-align: justify;">
                                        <tr>
                                            <td align="left" style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Original o fotocopia de declaraci&oacute;n jurada de salud.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="left" style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Certificado de Defunci&oacute;n o excepcionalmente Certificado de la persona de jerarqu&iacute;a en la comunidad del asegurado.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" align="left" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Fotocopia de C.I. y/o Fotocopia de certificado de nacimiento y/o Fotocopia del Carnet de identidad RUN y/o Fotocopia de la libreta del servicio militar del asegurado debidamente visado por el Jefe de Agencia.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" align="left" valign="top">&bull;</td>
                                            <td style="width:97%;">Liquidaci&oacute;n de cartera con el monto indemnizable. </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" align="left" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Para el caso de Invalidez: Dictamen de calificaci&oacute;n emitido por el m&eacute;dico autorizado por la APS (Autoridad de Fiscalizaci&oacute;n y Control de Pensiones y Seguros) en el que se indique el porcentaje de invalidez, la calificaci&oacute;n deber&aacute; realizarse con la utilizaci&oacute;n del MANECGI (Manual de Normas de Evaluaci&oacute;n y Calificaci&oacute;n del Grado de Invalidez) </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" align="left" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Para Gastos de Sepelio, Formulario de Declaraci&oacute;n de Beneficiarios o en ausencia de &eacute;ste la Declaratoria de Herederos.
                                            </td>
                                        </tr>
                                    </table>

                                    <b style="margin-top: 3px;">Para siniestros con desembolso mayor a $us. 5.000.- &oacute; Bs. 35.000.-</b>

                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}} text-align: justify;">
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">Original o Fotocopia de la Declaraci&oacute;n Jurada de Salud </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Original de Certificado de Defunci&oacute;n o excepcionalmente Certificado de la persona de jerarqu&iacute;a en la comunidad del asegurado.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">Fotocopia del Certificado Forense o Informe de la Autoridad Competente, si el fallecimiento ocurriese de manera violenta, accidental o en ejecuci&oacute;n de un hecho delictivo.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">Certificado M&eacute;dico &Uacute;nico de Defunci&oacute;n Certificado m&eacute;dico indicando la causa primaria, secundaria y agravante de fallecimiento. </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Fotocopia de C. I. y/o Fotocopia de certificado de nacimiento y/o Fotocopia del Carnet de identidad RUN y/o Fotocopia de la libreta del servicio militar del asegurado debidamente visado por el Jefe de Agencia.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Liquidaci&oacute;n de cartera con el monto indemnizable.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Para gastos de Sepelio, Formulario de Declaraci&oacute;n de Beneficiarios o en ausencia de &eacute;ste la Declaratoria de Herederos.
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width:3%;" valign="top">&bull;</td>
                                            <td style="width:97%;">
                                                Para el caso de Invalidez: Dictamen de Calificaci&oacute;n emitido por el m&eacute;dico autorizado por la APS (Autoridad de Fiscalizaci&oacute;n y Control de Pensiones y Seguros) en el que se indique el porcentaje de invalidez, la calificaci&oacute;n deber&aacute; realizarse con la utilizaci&oacute;n del MANECGI (Manual de Normas de Evaluaci&oacute;n y Calificaci&oacute;n de Grado de Invalidez).
                                            </td>
                                        </tr>
                                    </table>
                                    <div style="text-align: justify;">
                                        <b style="margin-top: 3px;">NOTA:</b>&nbsp;
                                        En caso de que la Compa&ntilde;&iacute;a  requiera cualquier informaci&oacute;n adicional,  esta deber&aacute; ser presentada por el asegurado, ya que en muchos casos dicha informaci&oacute;n es indispensable para el an&aacute;lisis del siniestro
                                        <br/>
                                        <b style="margin-top: 3px;">NOTA:</b>&nbsp;
                                        La p&oacute;liza establece que el beneficio de sepelio ser&aacute; pagado por la Compa&ntilde;&iacute;a directamente a BANCO PYME ECOFUTURO S.A. quien ser&aacute; responsable del pago ante el beneficiario del asegurado fallecido.
                                        <br />
                                        <b style="margin-top: 3px;">PLAZO PARA PRONUNCIARSE Y TERMINO PARA EL PAGO DEL SINIESTRO </b><br/>
                                        Articulo 1033. (Plazo para pronunciarse). El asegurador debe pronunciarse sobre el derecho del asegurado o beneficiario dentro de los treinta (30) d&iacute;as de recibida la informaci&oacute;n y evidencia citadas en el art&iacute;culo 1031. Se dejara constancia escrita de la fecha de recepci&oacute;n de la informaci&oacute;n y evidencias a efecto del c&oacute;mputo del plazo.<br/>
                                        El plazo de treinta (30) d&iacute;as mencionado, fenece con la aceptaci&oacute;n o rechazo del siniestro o con la solicitud del asegurador al asegurado que se complementan los requerimientos contemplados en el Art&iacute;culo 1031 y no vuelve a correr hasta que el asegurado haya cumplido con tales requerimientos.<br/>
                                        La solicitud de complementos establecidos en el Art&iacute;culo 1031, por parte del asegurador no podr&aacute; extenderse por m&aacute;s de dos veces a partir de la primera solicitud de informes y evidencias, debiendo pronunciarse dentro el plazo establecido y de manera definitiva sobre el derecho del asegurado, despu&eacute;s de la entrega por parte del asegurado del &uacute;ltimo requerimiento de informaci&oacute;n.<br/>
                                        El silencio del asegurador, vencido el termino para pronunciarse o vencidas las solicitudes de complementaci&oacute;n, importa la aceptaci&oacute;n del reclamo.

                                        <br />
                                        <b style="margin-top: 3px;">ARBITRAJE</b><br/>
                                        Conforme al Art&iacute;culo 39 de la Ley de Seguros N&deg; 1883, la Autoridad De Fiscalizaci&oacute;n y Control de Pensiones y Seguros podr&aacute; fungir como instancia de conciliaci&oacute;n, para todo siniestro cuya cuant&iacute;a no supere el monto de UFV 100.000,00- (Cien Mil 00/100 Unidades de Fomento de Vivienda). Si por esta v&iacute;a no existiera un acuerdo, la Autoridad de Fiscalizaci&oacute;n y Control de Pensiones y Seguros, podr&aacute; conocer y resolver la controversia por resoluci&oacute;n administrativa debidamente motivada.<br/><br/>

                                        Todo lo que no est&eacute; previsto por el presente Certificado de Cobertura Individual, se sujetar&aacute; a lo establecido en las Condiciones Particulares, Condiciones Generales y dem&aacute;s documentos Anexos a la presente P&oacute;liza de Seguro de Desgravamen Hipotecario en Grupo, el C&oacute;digo de Comercio, la Ley de Seguros y por las disposiciones legales
                                    </div>
                                </td>
                            </tr>
                        </table>

                        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; {{$font_size_content_parent}}">
                            <div style="text-align: center; margin-bottom: 2px;">
                                CL&Aacute;USULA DE DESEMPLEO PARA LA P&Oacute;LIZA DE SEGURO DE<br />
                                DESGRAVAMEN HIPOTECARIO <br />
                                COD. 207-934901-1999 11 003-2085<br/>
                                Aprobada por R.A. de la S.P.V.S. N. 144 Del 18 de Febrero de 2008<br>
                            </div>
                            <div style="text-align: left;">
                                Alianza Vida Seguros y Reaseguros S.A., emite la presente Cl&aacute;usula de Desempleo de acuerdo a solicitud del Asegurado y previo pago de la prima correspondiente, sujeta a las estipulaciones mencionadas a continuaci&oacute;n, las cuales fijan y limitan el riesgo.<br/>
                                <b>ASEGURADOS</b><br/>
                                Son aquellos deudores principales de la Entidad Financiera Contratante que mantengan un Contrato de Trabajo a t&eacute;rmino indefinido con alguna Empresa Privada y que deben enmarcarse en los siguientes l&iacute;mites de edad:<br/>
                            </div>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}}">
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Edad m&iacute;nima de ingreso 18 a&ntilde;os
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Edad m&aacute;xima de ingreso 65 a&ntilde;os
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Edad m&aacute;xima de permanencia 70 a&ntilde;os
                                    </td>
                                </tr>
                            </table>
                            <b>COBERTURA</b><br/>
                            Se cubre el riesgo de desempleo, cuando &eacute;ste se presente o se origine por un despido sin causa justificada, por cierre de la empresa o por despidos masivos y que el Asegurado se encuentre con no menos de 12 meses continuos en el mismo empleo al momento del despido.<br/>

                            <b>SUMA ASEGURADA </b><br/>
                            El 100% de la cuota mensual de la obligaci&oacute;n crediticia contra&iacute;da con la Entidad Financiera Contratante del Seguro seg&uacute;n plan de pagos original, por un per&iacute;odo m&aacute;ximo establecido en las Condiciones Particulares de la P&oacute;liza. El pago mensual del beneficio producto de esta cobertura se realizar&aacute; a la Entidad Financiera Contratante del Seguro.<br/>

                            <b>PERIODO DE ESPERA</b><br/>
                            La compa&ntilde;&iacute;a no ser&aacute; responsable del pago de las cuotas mensuales correspondientes durante el tiempo especificado en las Condiciones Particulares de la P&oacute;liza como Per&iacute;odo de Espera.<br/>

                            <b>PERIODO DE INDEMNIZACI&Oacute;N</b><br/>
                            Los meses que se indican en las Condiciones Particulares de la P&oacute;liza, sin embargo los pagos mensuales a la Entidad Financiera Contratante cesar&aacute;n si:<br/>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}}">
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Se termin&oacute; la Vigencia de la P&oacute;liza y esta no fuera renovada.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;El Asegurado comience a realizar alguna actividad remunerada, durante el periodo de Indemnizaci&oacute;n.

                                    </td>
                                </tr>
                            </table>

                            <b>EXCLUSIONES</b><br/>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}}">
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Cuando el Asegurado se encuentre prestando servicio militar, naval, a&eacute;reo o de polic&iacute;a.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Dolo o culpa grave del Asegurado.

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Cuando el Asegurado no se haya desempe&ntilde;ado durante por lo menos un a&ntilde;o continuo en el mismo empleo al momento del despido.

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Cuando el empleador de por terminado el Contrato de Trabajo alegando causa justa.

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Cuando el Asegurado incurra en conflicto de intereses, violaciones a reglas establecidas 	por el empleador, omisi&oacute;n intencional de llevar a cabo instrucciones orales o escritas 	importantes y legales para la actividad normal de la empresa e incumplimiento en la 	realizaci&oacute;n de las labores de su cargo.

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Programas de despido masivo para reducir personal anunciados por el empleador, anteriores  a  la  fecha  de toma o de inicio del certificado  individual  de  seguro  del 	Asegurado.


                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Cuando el Asegurado goce de pensi&oacute;n de Jubilaci&oacute;n u otras.

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Cuando el Asegurado principal es un funcionario de libre nombramiento o remoci&oacute;n o se autoemplea.

                                    </td>
                                </tr>
                            </table>
                            <b>REQUISITOS EN CASO DE DESEMPLEO </b><br/>
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_content_child}}">
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Carta o Memorando de despido.
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:3%;" valign="top" align="right">&bull;</td>
                                    <td style="width:97%;">
                                        &nbsp;Finiquito de Liquidaci&oacute;n visado por el Ministerio de Trabajo
                                    </td>
                                </tr>
                            </table><br/>
                            Todos los dem&aacute;s t&eacute;rminos y Condiciones de la P&oacute;liza de la que &eacute;sta Cl&aacute;usula forma parte, con excepci&oacute;n de lo expresamente variado por &eacute;sta quedan en pleno vigor
                        </div>
                        <div style="text-align:center; font-size:7px; margin-top: 13px;"><b>ALIANZA VIDA  SEGUROS Y REASEGUROS S.A.</b><br>SEGUROS ALIANZA VIDA S.A.<br>
                            FIRMAS AUTORIZADAS </div>
                        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify;">
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                                <tr>
                                    <td style="width: 33%; text-align: center;">
                                        <img src="{{asset('images/firma-1.jpg')}}" width="118">
                                    </td>
                                    <td style="width: 34%; text-align: center;">

                                    </td>
                                    <td style="width: 33%; text-align: center;">
                                        <img src="{{asset('images/firma-2.jpg')}}" width="118">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!---->
                    @endif

    </div>
</div>