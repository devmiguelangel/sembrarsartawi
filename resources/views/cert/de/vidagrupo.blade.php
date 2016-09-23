<div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 5px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">
        @var $font_parent = 'font-size:67%;'
        @var $font_child = 'font-size:100%;'
        @var $font_size_parent = 'font-size:60%;'
        @var $font_size_child = 'font-size:100%;'
        @var $font_size_content_parent = 'font-size:57%;'
        @var $font_size_content_child = 'font-size:100%;'
        @if($type=='PDF')
            @var $font_parent = 'font-size:60%;'
            @var $font_child = 'font-size:60%;'
            @var $font_size_parent = 'font-size:47%;'
            @var $font_size_child = 'font-size:47%;'
            @var $font_size_content_parent = 'font-size:43%;'
            @var $font_size_content_child = 'font-size:43%;'
        @endif
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 2px; margin-top: 15px; {{$font_size_parent}}">
            <tr>
                <td style="width:100%; text-align:center; text-align: right;">
                    <div style="font-weight:bold;">
                    DECLARACIÓN JURADA DE SALUD<br />
                    SOLICITUD DE SEGURO DE VIDA EN GRUPO PARA OPERACIONES CREDITICIAS
                    </div>
                    No de Certificado: {{'V-'.$query_header->issue_number}}

                </td>
            </tr>
        </table>
        <!--DATOS DEL TITULAR 1-->
        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px; height: auto; border: 1px solid #424242; padding: 1px 10px; text-align: left;">
            INFORMACION DEL(LOS) ASEGURADOS(S) PROPUESTO(S)
        </div>
        @var $i=1;
        @foreach($query_details as $data_cl)
            <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px;">
                TITULAR {{$i}}.
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                <tr>
                    <td style="width: 6%;">Nombres: </td>

                    <td style="width: 44%; border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->first_name}}
                    </td>
                    <td style="width: 6%; text-align: right;">Apellidos: </td>

                    <td style="width: 44%; border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->last_name.' '.$data_cl->mother_last_name}}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                @var $parameter_gender = config('base.client_genders')
                @var $fecha = date('d/m/Y', strtotime($data_cl->birthdate));
                @var $array = explode('/',$fecha);
                @var $day = $array[0];
                @var $month = $array[1];
                @var $year = $array[2];
                <tr>
                    <td style="width: 3%;">Sexo:</td>
                    <td style="width: 19%; border-bottom: 1px solid #080808;">
                        {{$parameter_gender[$data_cl->gender]}}
                    </td>
                    <td style="width: 12%;">Fecha de Nacimiento:</td>
                    <td style="width: 16%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}">
                            <tr>
                                <td style="width: 30%; text-align: center; border-bottom: 1px solid #080808;">
                                    {{$day}}
                                </td>
                                <td style="width: 1%; border-bottom: 1px solid #080808;">/</td>
                                <td style="width: 30%; text-align: center; border-bottom: 1px solid #080808;">
                                    {{$month}}
                                </td>
                                <td style="width: 1%; border-bottom: 1px solid #080808;">/</td>
                                <td style="width: 31%; text-align: center; border-bottom: 1px solid #080808;">
                                    {{$year}}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 3%;">Edad:</td>
                    <td style="width: 13%; border-bottom: 1px solid #080808;">
                        {{$data_cl->age}}
                    </td>
                    <td style="width: 11%;">Lugar de Nacimiento:</td>
                    <td style="width: 23%; border-bottom: 1px solid #080808;">
                        {{$data_cl->birth_place}}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                <tr>
                    <td style="width: 11%;">Dirección de domicilio: </td>
                    <td style="width: 30%; border-bottom: 1px solid #080808;">
                        {{$data_cl->home_address}}
                    </td>
                    <td style="width: 9%;">Teléfono Domicilio: </td>
                    <td style="width: 15%; border-bottom: 1px solid #080808;">
                        {{$data_cl->phone_number_home}}
                    </td>
                    <td style="width: 6%;">Ocupación: </td>
                    <td style="width: 29%; border-bottom: 1px solid #080808;">
                        {{$data_cl->occupation}}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                <tr>
                    <td style="width: 4%;">Ciudad:</td>
                    <td style="width: 24%; border-bottom: 1px solid #080808;">
                        {{$data_cl->city}}
                    </td>
                    <td style="width: 3%;">Pais:</td>
                    <td style="width: 19%; border-bottom: 1px solid #080808;">
                        {{$data_cl->country}}
                    </td>
                    <td style="width: 3%;">Peso:</td>
                    <td style="width: 24%; border-bottom: 1px solid #080808;">
                        {{$data_cl->weight}}
                    </td>
                    <td style="width: 5%;">Estatura:</td>
                    <td style="width: 18%; border-bottom: 1px solid #080808;">
                        {{$data_cl->height}}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 4px;">
                @var $parameter_civil_status = config('base.client_civil_status')
                <tr>
                    <td style="width: 17%;">Carnet de Identidad o Pasaporte: </td>
                    <td style="width: 33%; border-bottom: 1px solid #080808;">
                        {{$data_cl->dni.''.$data_cl->complement.''.$data_cl->extension}}
                    </td>
                    <td style="width: 7%;">Estado Civil: </td>
                    <td style="width: 43%; border-bottom: 1px solid #080808;">
                        {{$parameter_civil_status[$data_cl->civil_status]}}
                    </td>
                </tr>
            </table>
            @var $i=$i+1
        @endforeach

        <!--DATOS DEL TITULAR 2-->
        @if(count($query_details)<2)
            <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px;">
                TITULAR 2.
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                <tr>
                    <td style="width: 6%;">Nombres: </td>

                    <td style="width: 44%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 6%; text-align: right;">Apellidos: </td>

                    <td style="width: 44%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                <tr>
                    <td style="width: 3%;">Sexo:</td>
                    <td style="width: 19%; border-bottom: 1px solid #080808;">

                    </td>
                    <td style="width: 12%;">Fecha de Nacimiento:</td>
                    <td style="width: 16%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}">
                            <tr>
                                <td style="width: 30%; text-align: center; border-bottom: 1px solid #080808;"> </td>
                                <td style="width: 1%; border-bottom: 1px solid #080808;">/</td>
                                <td style="width: 30%; text-align: center; border-bottom: 1px solid #080808;"> </td>
                                <td style="width: 1%; border-bottom: 1px solid #080808;">/</td>
                                <td style="width: 31%; text-align: center; border-bottom: 1px solid #080808;"> </td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 3%;">Edad:</td>
                    <td style="width: 13%; border-bottom: 1px solid #080808;">
                    </td>
                    <td style="width: 11%;">Lugar de Nacimiento:</td>
                    <td style="width: 23%; border-bottom: 1px solid #080808;">

                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                <tr>
                    <td style="width: 11%;">Dirección de domicilio: </td>
                    <td style="width: 30%; border-bottom: 1px solid #080808;">

                    </td>
                    <td style="width: 9%;">Teléfono Domicilio: </td>
                    <td style="width: 15%; border-bottom: 1px solid #080808;">

                    </td>
                    <td style="width: 6%;">Ocupación: </td>
                    <td style="width: 29%; border-bottom: 1px solid #080808;">

                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 2px;">
                <tr>
                    <td style="width: 4%;">Ciudad:</td>
                    <td style="width: 24%; border-bottom: 1px solid #080808;">

                    </td>
                    <td style="width: 3%;">Pais:</td>
                    <td style="width: 19%; border-bottom: 1px solid #080808;">

                    </td>
                    <td style="width: 3%;">Peso:</td>
                    <td style="width: 24%; border-bottom: 1px solid #080808;">

                    </td>
                    <td style="width: 5%;">Estatura:</td>
                    <td style="width: 18%; border-bottom: 1px solid #080808;">

                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td style="width: 17%;">Carnet de Identidad o Pasaporte: </td>
                    <td style="width: 33%; border-bottom: 1px solid #080808;">

                    </td>
                    <td style="width: 7%;">Estado Civil: </td>
                    <td style="width: 43%; border-bottom: 1px solid #080808;">

                    </td>
                </tr>
            </table>
        @endif
        <!--CREDITO-->
        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px; height: auto; border: 1px solid #424242; padding: 1px 10px; text-align: left;">
            DEL CRÉDITO SOLICITADO
        </div>
        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px;">
            Usted(es) solicita(n) el Seguro de tipo:
        </div>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px;">
            <tr>
                <td style="width: 20%;">Individual </td>
                <td style="width: 10%;" align="center">
                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                        @if($query_header->slug_coverage=='IC')
                            x
                        @endif
                    </div>
                </td>
                <td style="width: 70%;" align="left">si marca esta opción, sólo debe completar la información requerida por el Titular 1</td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px;">
            <tr>
                <td style="width: 20%;">Mancomunada </td>
                <td style="width: 10%;" align="center">
                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                        @if($query_header->slug_coverage=='MC')
                            x
                        @endif
                    </div>
                </td>
                <td style="width: 70%;" align="left">si marca esta opción, debe completar la información requerida al Titular 1 y el Titular 2</td>
            </tr>
        </table>
        @foreach($query_details as $data_cl)
            @if($data_cl->headline=='D')
                @var $monto_actual_acumulado = $data_cl->cumulus/$query_exchange->bs_value
            @endif
        @endforeach
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px;">
            <tr>
                <td style="width: 13%;">Monto Actual Solicitado: </td>
                <td style="width: 37%; border-bottom: 1px solid #080808;">
                    {{number_format($query_header->amount_requested,2,'.',',').' '.$query_header->currency}}
                </td>
                <td style="width: 14%;">Monto Actual Acumulado: </td>
                <td style="width: 36%; border-bottom: 1px solid #080808;">
                    {{number_format($monto_actual_acumulado,2,',','.').' USD'}}
                </td>
            </tr>
        </table>
        @var $parameter_term = config('base.term_types')
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 4px;">
            <tr>
                <td style="width: 14%;">Plazo del presente crédito:</td>
                <td style="width: 86%; border-bottom: 1px solid #080808;">
                    {{$query_header->term.' '.$parameter_term[$query_header->type_term]}}
                </td>
            </tr>
        </table>

        <!--BENEFICIARIOS-->
        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px; height: auto; border: 1px solid #424242; padding: 1px 10px; text-align: left;">
            BENEFICIARIOS SEGURO DE VIDA <span style="display: inline-block; margin: 0 0 0 100px;">(Citar nombres completos)</span>
        </div>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 4px;">
            @var $ti=1
            @foreach($query_details as $data_cl)
                @var $border_bottom = ''
                @if($ti==2)
                    @var $border_bottom = 'border-bottom:1px solid #333;'
                @endif
                <tr>
                    <td style="width: 15%; border-top:1px solid #333; border-left:1px solid #333;"><b>TITULAR {{$ti}}.</b></td>
                    <td style="width: 18%; border-top:1px solid #333; border-left:1px solid #333;"></td>
                    <td style="width: 18%; border-top:1px solid #333; border-left:1px solid #333;"></td>
                    <td style="width: 16%; border-top:1px solid #333; border-left:1px solid #333;"></td>
                    <td style="width: 18%; border-top:1px solid #333; border-left:1px solid #333;"></td>
                    <td style="width: 10%; border-top:1px solid #333; border-left:1px solid #333;"></td>
                    <td style="width: 5%; border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;"></td>
                </tr>
                <tr>
                    <td style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">Apellido Paterno</td>
                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">Apellido Materno</td>
                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">Nombres</td>
                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">Parentesco</td>
                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">Edad</td>
                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;">%</td>
                </tr>
                @foreach(json_decode($beneficiary) as $key=>$values)
                    @if($key==$data_cl->id_details)
                        @foreach($values as $index=>$items)
                            @if($index == 'VI')
                                <tr>
                                    <td style="border-top:1px solid #333; border-left:1px solid #333;">Primario</td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">
                                        {{$items->last_name}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">
                                        {{$items->mother_last_name}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">
                                        {{$items->first_name}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">
                                        {{$items->relationship}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;">
                                        {{$items->age}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;">
                                        100
                                    </td>
                                </tr>
                            @elseif($index == 'CO')
                                <tr>
                                    <td style="border-top:1px solid #333; border-left:1px solid #333;">Contigente</td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                        {{$items->last_name}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                        {{$items->mother_last_name}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                        {{$items->first_name}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                        {{$items->relationship}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                        {{$items->age}}
                                    </td>
                                    <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333; {{$border_bottom}}">
                                        100
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if(count($query_details)<2)
                    <tr>
                        <td style="border-top:1px solid #333; border-left:1px solid #333;"><b>TITULAR 2.</b></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;"></td>
                    </tr>
                    <tr>
                        <td style="border-top:1px solid #333; border-left:1px solid #333;">Primario</td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;"></td>
                    </tr>
                    <tr>
                        <td style="border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333;">Contigente</td>
                        <td align="center" style="border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333;"></td>
                        <td align="center" style="border-top:1px solid #333; border-bottom:1px solid #333; border-left:1px solid #333;
                            border-right:1px solid #333;"></td>
                    </tr>
                @endif
                @var $ti=$ti+1
            @endforeach
        </table>
        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px; height: auto; border: 1px solid #424242; padding: 1px 10px; text-align: left;">
            DECLARACIÓN PERSONAL DE SALUD DEL CANDIDATO
        </div>
        <!--CUESTIONARIO-->
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
            <tr>
                <td colspan="2" style="text-align: left;">
                    <label style="font-weight: bold;">CUESTIONARIO</label>
                </td>
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
                            <td style="width: 22%; padding-left: 3px;">
                                SI
                            </td>
                            <td style="width: 56%;">

                            </td>
                            <td style="width: 22%; padding-left: 3px;">
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
                                        (
                                            {{$response == true ? 'x':'&nbsp;'}}
                                        )
                                    </td>
                                    <td style="width: 60%;">

                                    </td>
                                    <td style="width: 20%; padding-left: 3px;">
                                        (
                                            {{$response == false ? 'x':'&nbsp;'}}
                                        )
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
                                        (
                                            &nbsp;
                                        )
                                    </td>
                                    <td style="width: 60%;">

                                    </td>
                                    <td style="width: 20%; padding-left: 3px;">
                                        (
                                            &nbsp;
                                        )
                                    </td>
                                </tr>
                            </table>
                        </td>
                    @endif
                </tr>
                @var $j=$j+1
            @endforeach
        </table>
        <!--RESPUESTA CUESTIONARIO MEDICO-->
        @var $rs = 1
        @foreach($query_details as $data_cl)
            <div style="{{$font_size_parent}} font-family: Arial; line-height: 1em; text-align: justify; font-weight: bold; margin-bottom: 2px;">
                TITULAR {{$rs}}.
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td align="center" valign="middle" style="width: 8%;
                    border-top:1px solid #333; border-left:1px solid #333;">Pregunta<br />Número</td>
                    <td align="center" valign="middle" style="width: 25%;
                    border-top:1px solid #333; border-left:1px solid #333;">Enfermedad padecida o<br />tratamiento recomendado</td>
                    <td align="center" valign="middle" style="width: 10%;
                    border-top:1px solid #333; border-left:1px solid #333;">Fecha</td>
                    <td align="center" valign="middle" style="width: 10%;
                    border-top:1px solid #333; border-left:1px solid #333;">Duración</td>
                    <td align="center" valign="middle" style="width: 37%;
                    border-top:1px solid #333; border-left:1px solid #333;">Nombre de la clínica o del médico<br />tratante</td>
                    <td align="center" valign="middle" style="width: 10%;
                    border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;">Estado actual</td>
                </tr>
                @foreach(json_decode($data_cl->response) as $my_data)
                    @var $border_bottom = ''
                    @if($my_data->id==6)
                        @var $border_bottom = 'border-bottom:1px solid #333;'
                    @endif
                    @if($my_data->observations->treatment!='')
                        <tr>
                            <td align="center" valign="middle" style="width: 8%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                {{$my_data->id}}
                            </td>
                            <td align="center" valign="middle" style="width: 25%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                {{$my_data->observations->treatment}}
                            </td>
                            <td align="center" valign="middle" style="width: 10%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                {{$my_data->observations->date}}
                            </td>
                            <td align="center" valign="middle" style="width: 10%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                {{$my_data->observations->duration}}
                            </td>
                            <td align="center" valign="middle" style="width: 37%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">
                                {{$my_data->observations->clinic}}
                            </td>
                            <td align="center" valign="middle" style="width: 10%;
                            border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333; {{$border_bottom}}">
                                {{$my_data->observations->state}}
                            </td>
                        </tr>
                    @else
                        <tr>
                            <td align="center" valign="middle" style="width: 8%; {{$border_bottom}}
                            border-top:1px solid #333; border-left:1px solid #333;">{{$my_data->id}}</td>
                            <td align="center" valign="middle" style="width: 25%; {{$border_bottom}}
                            border-top:1px solid #333; border-left:1px solid #333;">&nbsp;</td>
                            <td align="center" valign="middle" style="width: 10%; {{$border_bottom}}
                            border-top:1px solid #333; border-left:1px solid #333;">&nbsp;</td>
                            <td align="center" valign="middle" style="width: 10%; {{$border_bottom}}
                            border-top:1px solid #333; border-left:1px solid #333;">&nbsp;</td>
                            <td align="center" valign="middle" style="width: 37%; {{$border_bottom}}
                            border-top:1px solid #333; border-left:1px solid #333;">&nbsp;</td>
                            <td align="center" valign="middle" style="width: 10%; {{$border_bottom}}
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}
                            border-right:1px solid #333;">&nbsp;</td>
                        </tr>
                    @endif
                @endforeach
            </table>
            @var $rs = $rs + 1
        @endforeach
        @if(count($query_details)<2)
            <div style="{{$font_size_parent}} font-family: Arial; line-height: 1em; text-align: justify; font-weight: bold; margin-bottom: 2px;">
                TITULAR 2.
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 4px;">

                <tr>
                    <td align="center" valign="middle" style="width: 8%;
                        border-top:1px solid #333; border-left:1px solid #333;">Pregunta<br />Número</td>
                    <td align="center" valign="middle" style="width: 25%;
                        border-top:1px solid #333; border-left:1px solid #333;">Enfermedad padecida o<br />tratamiento recomendado</td>
                    <td align="center" valign="middle" style="width: 10%;
                        border-top:1px solid #333; border-left:1px solid #333;">Fecha</td>
                    <td align="center" valign="middle" style="width: 10%;
                        border-top:1px solid #333; border-left:1px solid #333;">Duración</td>
                    <td align="center" valign="middle" style="width: 37%;
                        border-top:1px solid #333; border-left:1px solid #333;">Nombre de la clínica o del médico<br />tratante</td>
                    <td align="center" valign="middle" style="width: 10%;
                        border-top:1px solid #333; border-left:1px solid #333; border-right:1px solid #333;">Estado actual</td>
                </tr>
                @for($i=1;$i<=6;$i++)
                    @var $border_bottom = ''
                    @if($i==6)
                        @var $border_bottom = 'border-bottom:1px solid #333;'
                    @endif
                    <tr>
                        <td align="center" valign="middle" style="width: 8%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">&nbsp;</td>
                        <td align="center" valign="middle" style="width: 25%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">&nbsp;</td>
                        <td align="center" valign="middle" style="width: 10%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">&nbsp;</td>
                        <td align="center" valign="middle" style="width: 10%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">&nbsp;</td>
                        <td align="center" valign="middle" style="width: 37%;
                            border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}">&nbsp;</td>
                        <td align="center" valign="middle" style="width: 10%;
                                border-top:1px solid #333; border-left:1px solid #333; {{$border_bottom}}
                                border-right:1px solid #333;">&nbsp;</td>
                    </tr>
                @endfor
            </table>
        @endif
        <div style="font-weight:bold; {{$font_size_parent}} font-family: Arial; margin-bottom: 2px; height: auto; border: 1px solid #424242; padding: 1px 10px; text-align: left;">
            BENEFICIARIO PARA GASTOS DE SEPELIO: (Cobertura Complementaria a la Póliza de Vida en Grupo Anual Renovable)
        </div>
        <div style="{{$font_size_parent}} font-family: Arial; line-height: 1em; text-align: justify; font-weight: bold; margin-bottom: 2px;">
            El asegurado debe asignar como beneficiario para la cobertura adicional de sepelio a la persona que a su fallecimiento recibirá el Capital que la Compañía otorga en esta cobertura.
        </div>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 3px;">
            @var $be=1
            @foreach($query_details as $data_cl)
                @var $border_bottom = ''
                @if($be==2)
                    @var $border_bottom = 'border-bottom:1px solid #333;'
                @endif
                @foreach(json_decode($beneficiary) as $key=>$values)
                    @if($key==$data_cl->id_details)
                        @foreach($values as $index=>$items)
                            @if($index=='SP')
                                <tr>
                                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;">TITULAR {{$be}}.</td>
                                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;"></td>
                                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;"></td>
                                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;"></td>
                                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-right: 1px solid #080808;"></td>
                                </tr>
                                <tr>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;">Apellido Paterno</td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;">Apellido Materno</td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;">Nombres</td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;">Parentesco</td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-right: 1px solid #080808;">CI</td>
                                </tr>
                                <tr>
                                    <td align="center" height="30" style="width: 20%; border-top: 1px solid #080808;
                                    border-left: 1px solid #080808; {{$border_bottom}}">
                                        {{$items->last_name}}
                                    </td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808;
                                    border-left: 1px solid #080808; {{$border_bottom}}">
                                        {{$items->mother_last_name}}
                                    </td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808;
                                    border-left: 1px solid #080808; {{$border_bottom}}">
                                        {{$items->first_name}}
                                    </td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808;
                                    border-left: 1px solid #080808; {{$border_bottom}}">
                                        {{$items->relationship}}
                                    </td>
                                    <td align="center" style="width: 20%; border-top: 1px solid #080808;
                                    border-left: 1px solid #080808; border-right: 1px solid #080808; {{$border_bottom}}">
                                        {{$items->dni.' '.$items->extension}}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            @var $be = $be + 1
            @endforeach
            @if(count($query_details)<2)
                <tr>
                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;">TITULAR 2.</td>
                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;"></td>
                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;"></td>
                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;"></td>
                    <td style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-right: 1px solid #080808;"></td>
                </tr>
                <tr>
                    <td align="center" style="width: 20%;  border-top: 1px solid #080808; border-left: 1px solid #080808;">Apellido Paterno</td>
                    <td align="center" style="width: 20%;  border-top: 1px solid #080808; border-left: 1px solid #080808;">Apellido Materno</td>
                    <td align="center" style="width: 20%;  border-top: 1px solid #080808; border-left: 1px solid #080808;">Nombres</td>
                    <td align="center" style="width: 20%;  border-top: 1px solid #080808; border-left: 1px solid #080808;">Parentesco</td>
                    <td align="center" style="width: 20%;  border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-right: 1px solid #080808;">CI</td>
                </tr>
                <tr>
                    <td align="center" height="30" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-bottom: 1px solid #080808;"></td>
                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-bottom: 1px solid #080808;"></td>
                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-bottom: 1px solid #080808;"></td>
                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-bottom: 1px solid #080808;"></td>
                    <td align="center" style="width: 20%; border-top: 1px solid #080808; border-left: 1px solid #080808;
                                    border-bottom: 1px solid #080808; border-right: 1px solid #080808;"></td>
                </tr>
            @endif
        </table>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; {{$font_size_parent}}} margin-bottom: 3px;">
            Declaro haber contestado con total veracidad, máxima buena fe a todas las preguntas del presente cuestionario y no haber omitido u ocultado hechos y/o circunstancias que hubieran podido influir en la celebración del Contrato de Seguro.<br />
            La Compañía no asume responsabilidad alguna que la prima haya sido pagada y el Certificado se encuentre emitido y en poder del Asegurado.
        </div>
        @var $fecha = date('d/m/Y', strtotime($query_header->date_issue));
        @var $array = explode('/',$fecha);
        @var $day = $array[0];
        @var $month = $array[1];
        @var $year = $array[2];
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; margin-bottom: 25px;">
            <tr>
                <td style="width: 20%; border-bottom: 1px solid #080808; text-align: center;">
                    {{$day}}
                </td>
                <td style="width: 2%;">de</td>
                <td style="width: 13%; border-bottom: 1px solid #080808; text-align: center;">
                    {{$month}}
                </td>
                <td style="width: 4%;">de </td>
                <td style="width: 8%; border-bottom: 1px solid #080808; text-align: center;">
                    {{$year}}
                </td>
                <td style="width: 53%;"></td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; padding-bottom: 10px;">
            <tr>
                <td style="width: 4%;"></td>
                <td style="width: 30%; border-bottom: 1px solid #080808;">

                </td>
                <td style="width: 32%;"></td>
                <td style="width: 30%; border-bottom: 1px solid #080808;">

                </td>
                <td style="width: 4%;"></td>
            </tr>
            <tr>
                <td style="width: 4%;"></td>
                <td style="width: 30%;" align="center">Firma del Titular 1</td>
                <td style="width: 32%; border-bottom: 1px solid #080808;">

                </td>
                <td style="width: 30%;" align="center">Firma del Titular 2</td>
                <td style="width: 4%;"></td>
            </tr>
            <tr>
                <td style="width: 4%;"></td>
                <td style="width: 30%;"></td>
                <td style="width: 32%;" align="center">Oficial de Crédito<br />Firma y Sello</td>
                <td style="width: 30%;"></td>
                <td style="width: 4%;"></td>
            </tr>
        </table>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:left; {{$font_size_parent}} margin-bottom: 20px; font-weight: bold;">
            Emision de certificado de acuerdo a slip de cotización No. {{$query_header->quote_number}}
        </div>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial; line-height: 0.9em;">
            <tr>
                <td style="width: 100%; text-align: center;">
                    LA PAZ: calle Juana Parada Nª 683 Esq. Calle 6 (Zona Achumani) - Telf: (591 - 2)2793232, Fax: (591 - 2)2799191 <br />
                    SANTA CRUZ: Av. Viedma N°19 Esq. Melchor Pinto - Telf: (591 - 3)3375656, Fax: (591 - 3)3375666
                </td>
            </tr>
        </table>

        <page><div style="page-break-before: always;">&nbsp;</div></page>

                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 20px; margin-top: 150px; {{$font_parent}}">
                    <tr>
                        <td style="width:100%;  text-align:center;">
                            <div style="font-weight:bold;">
                                CERTIFICADO DE COBERTURA AL CONTRATO DE SEGURO<br>
                                DE DESGRAVAMEN HIPOTECARIO ANUAL RENOVABLE II
                            </div>
                            <div>
                                Aprobada por R.A.- ASFI No. 424 del 28 de Mayo de 2010
                                COD. 207 - 934901 - 1999 11 003 - 4001
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: right;">
                            Nº-{{$query_header->issue_number}}
                        </td>
                    </tr>
                </table>

                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_parent}} font-family: Arial;">
                    <tr>
                        <td style="width: 100%;">
                            <p>Se deja expresa constancia mediante el presente certificado, que: </p>
                            <p style="text-align: center; font-weight: bold;">
                                @var $dc=1
                                @foreach($query_details as $data_certificate)
                                    @if($dc<2)
                                        {{$data_certificate->first_name.' '.$data_certificate->last_name.' '.$data_certificate->mother_last_name}}
                                    @else
                                        {{'ó '.$data_certificate->first_name.' '.$data_certificate->last_name.' '.$data_certificate->mother_last_name}}
                                    @endif
                                    @var $dc=$dc+1
                                @endforeach
                            </p>
                            <p>
                                Ha sido admitido como integrante a la póliza Nº {{$query_header->policy_number}}   con efecto desde,  01 de Octubre de 2012 y como prestatario
                                de la {{$query->company}} tiene derecho a las prestaciones del Contrato según sus reglas y condiciones.
                            </p><br/>
                            <p style="font-weight: bold;">COBERTURAS</p>
                            <ul style="list-style: disc; margin: 10px 0 10px 30px; width: 700px;">
                                <li>Muerte Natural o Accidental (excepto las expresamente  excluidas en la REGLA VII RESTRICCIONES Y EXCLUSIONES)
                                </li>
                                <li>Invalidez Total y Permanente por Accidente  y/o  Enfermedad</li>
                                <li>Gastos de Sepelio (Titular o Cónyuge)</li>
                            </ul>
                            <br />
                            <p style="font-weight: bold;">TASA TOTAL MENSUAL</p>
                            <p>
                                Las primas serán canceladas por el “Tomador cada mes vencido y a su vez el “Tomador cargará el costo de este seguro por adelantado en las cuotas de
                                amortización de cada prestatario acorde con su cronograma de pago.
                            </p>
                            <table style="width: 100%; {{$font_child}}" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="width: 25%;">Tasa para el titular del crédito:</td>
                                    <td style="width: 25%;"><span style="font-weight: bold;">Tasa 0.82 %</span> (POR MIL) mensual</td>
                                    <td style="width: 50%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Tasa  mancomunada del crédito:</td>
                                    <td style="width: 25%;"><span style="font-weight: bold;">Tasa 1,25 %</span> (POR MIL) mensual</td>
                                    <td style="width: 50%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 25%;">Tasa  codeudor del crédito:</td>
                                    <td style="width: 25%;"><span style="font-weight: bold;">Tasa 0,82 %</span> (POR MIL) mensual</td>
                                    <td style="width: 50%;"></td>
                                </tr>
                            </table><br />
                            <p style="font-weight: bold;">CAPITAL ASEGURADO </p>
                            <ul style="list-style: disc; margin: 10px 0 10px 30px; width: 700px;">
                                <li>Muerte Natural o Accidental
                                    <br />Capital declarado según planillas mensuales presentadas por el Contratante
                                </li>
                                <li>Invalidez Total y Permanente por Accidentes y/o Enfermedad
                                    <br />Capital declarado según planillas mensuales presentadas por el Contratante
                                </li>
                            </ul>

                            <br /><br />
                            <p style="text-align: center;">ALIANZA VIDA  SEGUROS Y REASEGUROS S.A.</p>
                            <br />
                            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; {{$font_child}}">
                                <tr>
                                    <td style="width: 15%;"></td>
                                    <td style="width: 30%;" align="center">
                                        <img src="{{asset('images/firma-1.jpg')}}" width="118">
                                    </td>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 30%;" align="center">
                                        <img src="{{asset('images/firma-2.jpg')}}" width="118">
                                    </td>
                                    <td style="width: 15%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 15%;"></td>
                                    <td align="center" style="width: 30%;">FIRMAS AUTORIZADAS</td>
                                    <td style="width: 10%;"></td>
                                    <td align="center" style="width: 30%;">FIRMAS AUTORIZADAS</td>
                                    <td style="width: 15%;"></td>
                                </tr>
                            </table><br />
                            <p style="text-align: center;">
                                EN CASO DE SINIESTRO SIRVASE CONTACTARSE CON SU OFICIAL DE CREDITO U OFICINA MAS CERCANA DE FUNDACIÓN SARTAWI O LA
                                COMPAÑA
                            </p>
                            <p style="text-align: center;">
                                La adhesión a la presente póliza es de carácter voluntario y puede ser reemplazada por otra de similares características
                            </p>
                            <p style="text-align: center; font-size: 10px;">
                                LA PAZ: calle Juana Parada Nª 683 Esq. Calle 6 (Zona Achumani) - Telf: (591 - 2)2793232, Fax: (591 - 2)2799191 <br />
                                SANTA CRUZ: Av. Viedma N°19 Esq. Melchor Pinto - Telf: (591 - 3)3375656, Fax: (591 - 3)3375666
                            </p>
                        </td>
                    </tr>
                </table>

        <page><div style="page-break-before: always;">&nbsp;</div></page>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 20px; margin-top: 25px; {{$font_parent}}">
            <tr>
                <td style="width:100%; text-align:center; font-weight:bold;">
                    REGLAS DEL CONTRATO DEL SEGURO DE DESGRAVAMEN HIPOTECARIO ANUAL RENOVABLE
                </td>
            </tr>
        </table>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 20px; margin-top: 10px; {{$font_parent}}">
            <tr>
                <td style="width: 50%; padding: 5px;" valign="top">
                    <span class="font-bold">Regla I.</span>
                    <span class="title-regla">DEFINICIONES</span><br />
                    <span style="text-decoration: underline;">EL ASEGURADOR:</span> Alianza Vida, Seguros y Reaseguros S.A.<br />
                    <span style="text-decoration: underline;">TOMADOR DEL SEGURO:</span> Fundación Sartawi<br />
                    <span style="text-decoration: underline;">ASEGURADOS:</span> Prestatarios del “Tomador“, incluyendo a los cónyuges y codeudores, mediante
                    el pago de prima, que figuren en los contratos de crédito y hayan sido aceptados por la
                    Compañía previa declaración jurada de salud.<br/>
                    <span style="text-decoration: underline;">BENEFICIARIO:</span> Fundación Sartawi a título oneroso y/o el “Tomador“ del seguro.<br />
                    <span style="text-decoration: underline;">COBERTURA DE MUERTE NATURAL O ACCIDENTAL:</span> Este seguro cubre el saldo insoluto de la  deuda contraída por el Asegurado con el “Tomador“ mas intereses corrientes e interés punitorios a la muerte del asegurado, siempre que la causa no haya sido excluida en el presente Contrato y el Condicionado General.
                    <br />
                    <span style="text-decoration: underline;">COBERTURA COMPLEMENTARIA</span>    Cubre el saldo insoluto de la deuda contraída por el Asegurado mas intereses corrientes e intereses punitorios, si por accidente o enfermedad quedase en forma total y permanente incapacitado para ejecutar cualquier trabajo lucrativo o para dedicarse a cualquier actividad de la que pueda derivar alguna utilidad y siempre que el carácter de la invalidez sea reconocido según el Manual de Evaluación y Calificación del Grado de Invalidez establecido en los arts. 24 y 62 del  D.S. 24469 de fecha 17/01/1997.
                    <br />
                    <span style="text-decoration: underline;">COBERTURA COMPLEMENTARIA</span> Cubre Gastos de Sepelio, son gastos que demanden los herederos legales o nominados por el Sepelio de un asegurado (titular o conyugue), como consecuencia del fallecimiento por una enfermedad o un accidente cubierto para el Titular. Se otorgará un beneficio de $us. 200.- ante el fallecimiento del Asegurado y/o conyugue (Así no se encuentre asegurada, “Protección Familiar“). En el caso de mancomunos, se otorgará el beneficio a la primera muerte, sea del titular o del conyugue.
                    <br />

                    <span class="font-bold">Regla II.</span>
                    <span class="title-regla">LIMITES DE EDAD:</span><br />
                    <span class="font-bold">2.01</span>  Para Muerte: Edad de Ingreso de 18 años (mínimo) y 70 años (máximo). Renovación garantizada en función de la duración del crédito hasta antes de cumplir los 71 años de edad, permanece hasta los 75 años (hasta antes de cumplir los 76 años).
                    <br />
                    <span class="font-bold">2.02</span>  Para Invalidez: Edad de Ingreso de 18 años (mínimo) y 64 años (máximo) “hasta antes de cumplir los 65 años al momento de inicio de la Cobertura, permanencia hasta 70 años (hasta antes de cumplir los 71 años).
                    <br />

                    <span class="font-bold">Regla III.</span>
                    <span class="title-regla">CONDICIONES DE ADHESIÓN DE LOS ASEGURADOS</span><br />
                    <span class="font-bold">3.01</span>   Podrán pertenecer al colectivo asegurado todos los prestatarios que reúnan los requisitos o condiciones de adhesión en la fecha de efecto o con posterioridad y figuren en la última planilla de declaración de asegurados elaborada para tal efecto por el “Tomador“ y que forma parte de la póliza.
                    <br />
                    <span class="font-bold">3.02</span>  Toda persona seleccionada para formar parte del colectivo, a partir de la fecha de inicio de vigencia, debe rellenar un formulario de declaración jurada de salud y la nominación de beneficiarios para la cobertura de Sepelio.
                    <br />

                    <span class="font-bold">Regla IV.</span>
                    <span class="title-regla">INICIO DE VIGENCIA DE LA COBERTURA PARA CADA ASEGURADO</span><br />
                    <span class="font-bold">4.01</span>  Operaciones de Crédito por Préstamos de dinero: desde la fecha de desembolso por parte del “Tomador“, previo cumplimiento de los requisitos de asegurabilidad.
                    <br />

                    <span class="font-bold">Regla V.</span>
                    <span class="title-regla">PÉRDIDA DE LA CONDICIÓN DE PERTENENCIA AL GRUPO</span><br />
                    <span class="font-bold">5.01</span>   La condición de miembro del colectivo terminará en la fecha que finalice la obligación contraída por el prestatario con el “Tomador“ del presente seguro.
                    <br />
                    <span class="font-bold">5.02</span>  Si un miembro sobrepasa la edad límite de permanencia estipulada en 71 años (para muerte) y en 66 años (para invalidez) dejará de pertenecer al seguro colectivo.
                    <br />
                    <span class="font-bold">5.03</span>  La cobertura por el presente seguro finalizará en la fecha en que el asegurado deje de pagar la prima correspondiente al asegurado individual.
                    <br />

                    <span class="font-bold">Regla VI.</span>
                    <span class="title-regla">LA PÓLIZA</span><br />
                    <span class="font-bold">6.01</span>   No se pagará ninguna indemnización conforme a estas reglas si la suma asegurada correspondiente no resultara pagadera con arreglo a las condiciones de la Póliza.   Cualquier miembro puede examinar la póliza si lo cree oportuno, previa coordinación con el “Tomador“.
                    <br />

                    <span class="font-bold">Regla VII.</span>
                    <span class="title-regla">MODIFICACIÓN O TERMINACIÓN</span><br />
                    <span class="font-bold">7.01</span>   El “Tomador“ se reserva el derecho de modificar estas reglas y los términos de la póliza al vencimiento de cada anualidad de acuerdo al resultado arrojado por la póliza al vencimiento de 	cada periodo.
                    <br />
                    <span class="font-bold">7.02</span>  El “Tomador“ y el “Asegurador“ se reservan el derecho de finalizar el Contrato.
                    <br />

                    <span class="font-bold">Regla VIII.</span>
                    <span class="title-regla">RESTRICCIONES Y EXCLUSIONES</span><br />
                    Este Seguro no será aplicable en ninguna de las siguientes circunstancias:
                </td>
                <td style="width: 50%; padding: 5px;" valign="top">
                    <span class="font-bold">8.01</span>   Si  el  Asegurado  participa  como  conductor  o  acompañante  en  competencias  de automóviles, motocicletas, lanchas a motor, aviones, avionetas, prácticas  de paracaidismo, aladeltismo, cacería de cualquier tipo u otra actividad que represente alto riesgo.
                    <br />
                    <span class="font-bold">8.02</span>  Si el Asegurado realiza operaciones o viajes submarinos o en transportes aéreos no autorizados para el transporte de pasajeros, vuelos no regulares.
                    <br />
                    <span class="font-bold">8.03</span>  Enfermedades preexistentes conocida al inicio del seguro o enfermedad congénita, para créditos mayores a $us. 5.001,00.-
                    <br />
                    <span class="font-bold">8.04</span>  Sida / HIV para siniestros a partir de $us. 5.001,00.-<br />
                    <span class="font-bold">8.05</span>  Si el Asegurado participa como elemento activo en guerra internacional o civil, rebelión, sublevación, guerrilla, huelgas, invasión, revolución, motín o hechos que las leyes califiquen como delitos contra la seguridad del Estado.
                    <br />
                    <span class="font-bold">8.06</span>  Suicidio realizado por el Asegurado dentro del sexto mes de vigencia de su cobertura. En consecuencia este riesgo quedará cubierto a partir del primer día del séptimo mes de vigencia para cada Asegurado.
                    <br />
                    <span class="font-bold">8.07</span>  Guerra, invasión, actos de enemigos extranjeros, hostilidades u operaciones bélicas, sea que haya habido declaración de guerra, guerra civil, insurrección, sublevación, rebelión, sedición, motín o conmoción contra orden público, dentro o fuera del país, así como cuando el asegurado participe activamente en actos subversivos, terroristas o delincuenciales.
                    <br />
                    <span class="font-bold">8.08</span>  Fisión o fusión nuclear, contaminación radioactiva.<br />
                    <span class="font-bold">8.09</span>  Acto delictuoso cometido en calidad de autor o cómplice, por un beneficiario o quien pudiere reclamar la indemnización.
                    <br />

                    <span class="font-bold">Regla IX.</span>
                    <span class="title-regla">PROCEDIMIENTO EN CASO DE SINIESTROS</span><br />
                    En caso de siniestros contemplados bajo el presente contrato, el asegurado debe presentar:<br />
                    <span class="font-bold">Para siniestros hasta $us. 5.000,00.-</span>
                    <br />
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; {{$font_child}}">
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(a)</td>
                            <td style="width: 85%">
                                Certificado de Defunción (para el Área Rural certificado de cualquier autoridad local
                                con la certificación del Jefe de agencia)
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(b)</td>
                            <td style="width: 85%">
                                Fotocopia del Certificado de nacimiento y/o fotocopia de la cédula de identidad
                                y/o carnet de identidad RUN y/o libreta de servicio militar.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(c)</td>
                            <td style="width: 85%">
                                Estado de cuenta saldo deudor.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(d)</td>
                            <td style="width: 85%">
                                Para  el  caso  de  Invalidez:  Certificado  INSO (Instituto  Nacional  de  Salud Ocupacional) o en su defecto de otra institución que esté debidamente autorizada por la Autoridad Competente, la cual determine el grado de invalidez.
                            </td>
                        </tr>
                    </table>
                    <span class="font-bold">Para siniestros de $us. 5.001,00.- en adelante:</span><br />
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; {{$font_child}}">
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(a)</td>
                            <td style="width: 85%">
                                Certificado de Defunción (para el Área Rural certificado de cualquier autoridad local con la certificación del Jefe de agencia)
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(b)</td>
                            <td style="width: 85%">
                                Fotocopia del Certificado de nacimiento y/o fotocopia de la cédula de identidad y/o carnet de identidad RUN y/o libreta de servicio militar.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(c)</td>
                            <td style="width: 85%">Estado de cuenta saldo deudor.</td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(d)</td>
                            <td style="width: 85%">Historia Clínica si existiera.</td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center">(e)</td>
                            <td style="width: 85%">Para  el  caso  de  Invalidez:  Certificado  INSO (Instituto  Nacional  de  Salud Ocupacional) o en su defecto de otra institución que esté debidamente autorizada por la Autoridad Competente, la cual determine el grado de invalidez.
                            </td>
                        </tr>
                    </table>
                    <span class="font-bold">Para sepelio:</span>
                    <br />
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; {{$font_child}}">
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(a)</td>
                            <td style="width: 85%">
                                Fotocopia del Certificado de nacimiento y/o fotocopia de la cédula de identidad del Asegurado y/o carnet de identidad RUN y/o libreta de servicio militar.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(b)</td>
                            <td style="width: 85%">
                                Fotocopia de cédula de identidad del Beneficiario y/o Fotocopia del certificado de nacimiento y/o carnet de identidad RUN y/o libreta de servicio militar.
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(c)</td>
                            <td style="width: 85%">
                                Certificado de Defunción (para el Área Rural certificado de cualquier autoridad local con la certificación del Jefe de agencia)
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(d)</td>
                            <td style="width: 85%">
                                Declaratoria de Beneficiarios o declaratoria de herederos (en caso de no existir la nominación de los mismos)
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 15%" align="center" valign="top">(e)</td>
                            <td style="width: 85%">Carta de los beneficiarios solicitando el beneficio. </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
</div>