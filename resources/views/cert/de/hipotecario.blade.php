@var $cop = 1;
@foreach($arr_copy as $key=>$data)

    @var $i=1;
    @foreach($query_details as $data_cl)
        <div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 5px;">
            <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">
                @var $font_parent = 'font-size:70%;'
                @var $font_child = 'font-size:100%;'
                @if($type=='PDF')
                    @var $font_parent = 'font-size:57%;'
                    @var $font_child = 'font-size:57%;'
                @endif
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 20px; margin-top: 15px; {{$font_parent}}">
                    <tr>
                        <td style="width:100%; font-weight:bold; text-align:center; line-height: 0.9em;">
                            DECLARACION JURADA DE SALUD PARA SEGURO DE DESGRAVAMEN HIPOTECARIO
                        </td>
                    </tr>
                    <tr>
                        <td style="width:100%; text-align: right;">
                            <strong>
                                @if($data!=0 && $type!='PDF' && $text!='slip' && $query_header->issued == 1)
                                    {{'copia '.$data}}
                                @elseif($type!='PDF' && $text!='slip' && $query_header->issued == 1)
                                    Original
                                @endif
                            </strong>
                        </td>
                    </tr>
                </table>

                <div style="{{$font_parent}} font-family: Arial; line-height: 1em; margin-bottom: 10px;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_child}}">
                        <tr>
                            <td style="width: 19%;">
                                Nombre Completo
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 20%;">
                                @if($data_cl->civil_status!='C')
                                    {{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}
                                @else
                                    {{$data_cl->first_name.' '.$data_cl->last_name.' de '.$data_cl->married_name}}
                                @endif
                            </td>
                            <td style="width: 10%;"></td>
                            <td style="width: 11%;">
                               Fecha de Nacimiento
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 38%;">
                                @var $fecha = date('d/m/Y', strtotime($data_cl->birthdate));
                                @var $array = explode('/',$fecha);
                                @var $day = $array[0];
                                @var $month = $array[1];
                                @var $year = $array[2];
                                Dia:&nbsp; {{$day}}&nbsp; Mes:&nbsp; {{$month}}&nbsp; Año:&nbsp; {{$year}}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19%;">
                                Carnet de Identidad
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 20%;">
                                {{$data_cl->dni.''.$data_cl->complement.''.$data_cl->extension}}
                            </td>
                            <td style="width: 10%;"></td>
                            <td style="width: 11%;">
                                Ocupacion Principal
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 38%;">
                                {{$data_cl->occupation}}
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19%;">
                                Entidad de Intermediación Financiera
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 20%;">
                                {{$query->retailer}}
                            </td>
                            <td style="width: 10%;"></td>
                            <td style="width: 11%;">
                                Estatura
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 38%;">
                                {{$data_cl->height}} (cm)
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 19%;">
                                Monto del Préstamo (Bs/US$)
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 20%;">
                                {{number_format($query_header->amount_requested,2,'.',',').' '.$query_header->currency}}
                            </td>
                            <td style="width: 10%;"></td>
                            <td style="width: 11%;">
                                Peso
                            </td>
                            <td style="width: 1%;">
                                :
                            </td>
                            <td style="width: 38%;">
                                {{$data_cl->weight}} (kg)
                            </td>
                        </tr>
                    </table>
                </div>

                <div style="{{$font_parent}} font-family: Arial; margin-bottom: 5px; padding-left: 185px;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_child}}">
                        @foreach(json_decode($data_cl->response) as $key => $value)
                            <tr>
                                <td>
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_child}} margin-bottom: 5px;">
                                        <tr>
                                            <td style="width: 2%;">{{$key}})</td>
                                            <td style="width: 98%;">{{$value->question}}</td>
                                        </tr>
                                    </table>

                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_child}} margin-bottom: 5px;">
                                        <tr>
                                            <td style="width: 5%;"></td>
                                            <td style="width: 5%;">SI&nbsp;&nbsp;</td>
                                            <td style="width: 28%;">
                                                <div style="width:55px; height:15px; border:1px solid #333; text-align:center; vertical-align: middle;">
                                                    {{$value->response == true ? 'x':''}}
                                                </div>
                                            </td>
                                            <td style="width: 2%;"></td>
                                            <td style="width: 5%;">NO&nbsp;&nbsp;</td>
                                            <td style="width: 28%;">
                                                <div style="width:55px; height:15px; border:1px solid #333; text-align:center; vertical-align: middle;">
                                                    {{$value->response == false ? 'x':''}}
                                                </div>
                                            </td>
                                            <td style="width: 33%;"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="padding-bottom: 10px;">
                                                En caso que la respuesta sea afirmativa, favor especificar:
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" style="border-bottom: 1px solid #000000;">
                                                @if(array_key_exists('response_specification', $value))
                                                    {{$value->response_specification}}
                                                @endif
                                            </td>
                                            <td style="width: 27%;"></td>
                                        </tr>
                                    </table>

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; {{$font_parent}} margin-bottom: 18px; font-family: Arial;">
                    Declaro que las respuestas que he consignado en este Formulario de solicitud de
                    Seguro de Desgravamen Hipotecario y Declaración de salud son verdaderas y
                    completas.<br>
                    Autorizo, a los médicos, clínicas, hospitales y otros centros de salud que me hayan
                    atendido para que proporcionen a la Entidad Aseguradora, todos los resultados de
                    los informes referentes a mi salud, en caso de enfermedad o accidentes, para lo cual
                    libero a dichos médicos y centros médicos, en relación con su secreto profesional, de
                    toda responsabilidad en que pudiera incurrir al proporcionar tales informes.
                </div>
                <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; {{$font_parent}} margin-bottom: 5px; font-family: Arial;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_child}} margin-bottom: 35px;">
                        <tr>
                            <td style="width: 19%;">
                            </td>
                            <td style="width: 8%;">Solicitante:</td>
                            <td style="width: 23%; border-bottom: 1px solid #000000;">
                                @if($data_cl->civil_status!='C')
                                    {{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}
                                @else
                                    {{$data_cl->first_name.' '.$data_cl->last_name.' de '.$data_cl->married_name}}
                                @endif
                            </td>
                            <td style="width: 8%; text-align:right;">Firma:</td>
                            <td style="width: 23%; border-bottom: 1px solid #000000;"></td>
                            <td style="width: 19%;">
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_child}} margin-bottom: 15px;">
                        <tr>
                            <td style="width: 37.5%;">

                            </td>
                            <td style="width: 25%; border-bottom: 1px solid #000000;">

                            </td>
                            <td style="width: 37.5%;">

                            </td>
                        </tr>
                        <tr>
                            <td style="width: 37.5%;">

                            </td>
                            <td style="width: 25%; text-align: center;">
                                Oficial de Crédito<br>
                                (Firma y sello)
                            </td>
                            <td style="width: 37.5%;">

                            </td>
                        </tr>
                    </table>
                </div>
                <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; {{$font_parent}} margin-bottom: 15px;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 10px; {{$font_child}}">
                        <tr>
                            <td style="width:100%; font-weight:bold; text-align:center; padding-bottom: 10px;">
                                DECLARACION JURADA DE SALUD PARA SEGURO DE DESGRAVAMEN HIPOTECARIO
                            </td>
                        </tr>
                        @var $parameter_term = config('base.term_types')
                        @var $type_term = $parameter_term[$query_header->type_term]
                        @if($query_header->type_term=='Y')
                            @var $term = round($query_header->term * 12, 0, PHP_ROUND_HALF_UP);
                        @else
                            @var $term = $query_header->term
                        @endif
                        <tr>
                            <td style="width: 100%; text-align: justify;">
                                Mediante el presente Formulario, en conformidad con la Declaración de Salud
                                que precede, solicito a {{$query->company}}, como Entidad Asegurada, se
                                me otorgue el seguro de Desgravamen Hipotecario, con referencia al préstamo
                                que al presente gestiono ante {{$query->retailer}} (Entidad de Intermediación
                                Financiera) de la ciudad de {{$query_header->city}} por el plazo de {{$term}} Meses, con
                                destino a {{$query_header->credit_product}}
                                <br>
                                Para los efectos que correponda declaro y dor mi absoluta conformidad
                                a todas y cada una de las condiciones y estipulaciones establecidas por la
                                entidad Aseguradora, sobre concesión, vigencia y caducidad del citado
                                seguro, según el Reglamento Aprobado, obligándome a pagar las primas
                                mensuales del seguro solicitado.
                            </td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 6px; {{$font_child}}">
                        <tr>
                            <td style="width: 3%; text-align: left;">Yo</td>
                            <td style="width: 20%; border-bottom: 1px solid #000000;">
                                @if($data_cl->civil_status!='C')
                                    {{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}
                                @else
                                    {{$data_cl->first_name.' '.$data_cl->last_name.' de '.$data_cl->married_name}}
                                @endif
                            </td>
                            <td style="width: 77%;"></td>
                        </tr>
                    </table>
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; {{$font_child}}">
                        <tr>
                            <td style="width: 8%; text-align: left;">Lugar y Fecha</td>
                            <td style="width: 20%; border-bottom: 1px solid #000000;">
                                {{$query_header->city.' - '.$query_header->date_issue}}
                            </td>
                            <td style="width: 72%;"></td>
                        </tr>
                    </table>
                </div>

                @if((boolean)$query_header->facultative === true)
                    @if((boolean)$query_header->approved === true)
                        @if(!is_null($data_cl->percentage))
                            <table border="0" cellpadding="1" cellspacing="0" style="width: 100%; font-size: 8px; font-weight: normal; font-family: Arial; margin: 5px 0 0 0; padding: 0; border-collapse: collapse; vertical-align: bottom;">
                                <tr>
                                    <td colspan="7" style="width:100%; text-align: center; font-weight: bold; background: #e57474; color: #FFFFFF;">
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
                                    <td style="width:34.5%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                                    background: #e57474;">Respuestas en el Cetificado de Desgravamen</td>
                                    <td style="width:34.5%; text-align: center; font-weight: bold; border: 1px solid #dedede;
                                    background: #e57474;">Observaciones</td>
                                </tr>
                                <tr>
                                    <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF;
                                             border: 1px solid #dedede;">{{$data_cl->approved==1?'SI':'NO'}}</td>
                                    <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF;
                                             border: 1px solid #dedede;">{{$data_cl->surcharge==1?'SI':'NO'}}</td>
                                    <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                                             border: 1px solid #dedede;">{{$data_cl->percentage}}</td>
                                    <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                                             border: 1px solid #dedede;">{{$data_cl->current_rate}} %</td>
                                    <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                                             border: 1px solid #dedede;">{{$data_cl->final_rate}} %</td>
                                    <td style="width:34.5%; text-align: justify; background: #e78484; color: #FFFFFF;
                                                     border: 1px solid #dedede;">
                                        <span style="color:#ffffff;">{{$data_cl->observation}}</span>
                                    </td>
                                    <td style="width:34.5%; text-align: justify; background: #e78484; color: #FFFFFF;
                                                     border: 1px solid #dedede;">
                                        <span style="color:#ffffff;">{{$query_header->facultative_observation}}</span>
                                    </td>
                                </tr>
                            </table>
                        @endif
                    @else
                        <table border="0" cellpadding="1" cellspacing="0" style="width: 100%; font-size: 9px; border-collapse: collapse; font-weight: normal; font-family: Arial; margin: 2px 0 0 0; padding: 0; border-collapse: collapse; vertical-align: bottom;">
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


                <page><div style="page-break-before: always;">&nbsp;</div></page>

                @if($query_header->issued == 1 && $query_header->canceled == 0)
                    @var $font_size_parent = 'font-size:53%;'
                    @var $font_size_child = 'font-size:100%;'
                    @if($type=='PDF')
                        @var $font_size_parent = 'font-size:47%;'
                        @var $font_size_child = 'font-size:47%;'
                    @endif
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 2px;">
                        <tr>
                            <td style="width:100%; font-weight:bold; text-align:center; ">
                                <div style="font-size: 56%;">
                                    CERTIFICADO DE COBERTURA INDIVIDUAL<br>
                                    SEGURO DE DESGRAVAMEN HIPOTECARIO
                                </div>
                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%; font-size: 56%;">
                                    <tr>
                                        <td style="width: 39%;"></td>
                                        <td style="width: 17%;">Resolución Administrativa Nº</td>
                                        <td style="width: 12%; border-bottom: 1px solid;">
                                        </td>
                                        <td style="width: 32%;"></td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%; font-size: 56%;">
                                    <tr>
                                        <td style="width: 38%;"></td>
                                        <td style="width: 12%;">Código de Registro Nº</td>
                                        <td style="width: 16%; border-bottom: 1px solid;">
                                        </td>
                                        <td style="width: 34%;"></td>
                                    </tr>
                                </table>
                                <div style="font-size: 56%; font-weight: bold">
                                    POLIZA Nº {{$query_header->policy_number}}
                                </div>
                                <div style="font-size: 56%; font-weight: bold">
                                    CERTIFICADO Nº {{$query_header->issue_number}}
                                </div>
                            </td>
                        </tr>
                    </table>

                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 2px; {{$font_size_parent}}">
                        <tr>
                            <td style="width: 100%;">
                                <table border="0" cellpadding="0" cellspacing="0" style="width:100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 100%;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; {{$font_size_child}}">
                                                <tr>
                                                    <td style="width: 16%; font-weight: bold; text-align: left;">
                                                        TOMADOR
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 23%; text-align: left;">
                                                        {{$query->retailer}}
                                                    </td>
                                                    <td style="width: 14%;"></td>
                                                    <td style="text-align: left; width: 45%;">INFORMACION DE LA ENTIDAD ASEGURADORA :</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; {{$font_size_child}}">
                                                <tr>
                                                    <td style="width: 16%; font-weight: bold; text-align: left;">
                                                        ASEGURADO
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 25%; text-align: left;">
                                                        @if($data_cl->civil_status!='C')
                                                            {{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}
                                                        @else
                                                            {{$data_cl->first_name.' '.$data_cl->last_name.' de '.$data_cl->married_name}}
                                                        @endif
                                                    </td>
                                                    <td style="width: 12%;"></td>
                                                    <td style="width: 8%; font-weight: bold; text-align: left;">
                                                        RAZON SOCIAL
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 35%; text-align: left;">
                                                        {{$query->company}}
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; {{$font_size_child}}">
                                                <tr>
                                                    <td style="width: 16%; font-weight: bold; text-align: left;">
                                                        BENEFICIARIO
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 25%; text-align: left;">
                                                        {{$query->retailer}}
                                                    </td>
                                                    <td style="width: 12%;"></td>
                                                    <td style="width: 8%; font-weight: bold; text-align: left;">
                                                        DIRECCIÓN
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 35%; text-align: left;">
                                                        CALLE 6 ACHUMANI ESQ. JUANA PARADA NRO. 683
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; {{$font_size_child}}">
                                                <tr>
                                                    <td style="width: 16%; font-weight: bold; text-align: left;">
                                                        BENEFICIARIOS DE COBERTURAS ADICIONALES
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 25%; text-align: left;">
                                                    @foreach(json_decode($beneficiary) as $key=>$values)
                                                        @if($key==$data_cl->id_details)
                                                            @foreach($values as $index=>$items)
                                                                @if($index == 'SP')
                                                                    {{$items->last_name}}
                                                                    {{$items->mother_last_name}}
                                                                    {{$items->first_name}}
                                                                    {{$items->relationship}}
                                                                    {{$items->dni.' '.$items->extension}}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                    <td style="width: 12%;"></td>
                                                    <td style="width: 8%; font-weight: bold; text-align: left;">
                                                        TELEFONO
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 35%; text-align: left;">
                                                        2793232
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%;">


                                            @var $fecha_ini = new DateTime($query_header->date_issue)
                                            @var $fecha_fin = new DateTime($query_header->date_issue)
                                            @if($query_header->type_term=='Y')
                                                @var $fecha_fin->add(new DateInterval('P'.$query_header->term.'Y'))
                                            @elseif($query_header->type_term=='M')
                                                @var $fecha_fin->add(new DateInterval('P'.$query_header->term.'M'))
                                            @endif
                                            @var $fecha_ini = $fecha_ini->format('d-m-Y')
                                            @var $fecha_fin = $fecha_fin->format('d-m-Y')

                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; {{$font_size_child}}">
                                                <tr>
                                                    <td style="width: 16%; font-weight: bold; text-align: left;">
                                                        VIGENCIA DE LA COBERTURA
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 25%; text-align: left;">
                                                        Desde las 00:01 de {{$fecha_ini}} hasta las 24:00 de {{$fecha_fin}}
                                                    </td>
                                                    <td style="width: 12%;"></td>
                                                    <td style="width: 8%; font-weight: bold; text-align: left;">
                                                        FAX
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 35%; text-align: left;">
                                                        2799991
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 100%;">
                                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; {{$font_size_child}}">
                                                <tr>
                                                    <td style="width: 16%; font-weight: bold; text-align: left;">
                                                        CIUDAD
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 25%; text-align: left;">
                                                        {{$query_header->city}}
                                                    </td>
                                                    <td style="width: 12%;"></td>
                                                    <td style="width: 8%; font-weight: bold; text-align: left;">
                                                        EMAIL
                                                    </td>
                                                    <td style="width: 2%;">:</td>
                                                    <td style="width: 35%; text-align: left;">
                                                        http://www1.alianza.com.bo/
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>

                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}}} font-family: Arial;">
                        <tr>
                            <td style="width: 49%;" valign="top">
                                <div style="text-align: justify;">
                                    El presente certificado de cobertura individual tiene validez legal para toda entidad aseguradora que opera en
                                    la modalidad de seguros de personas y que otorga el seguro de desgravamen hipotecario, para lo cual el
                                    asegurado expresa de manera voluntaria su adhesión al presente seguro.
                                    <b>TOMADOR:</b><br>
                                    <b>VIGENCIA DE LA COBERTURA INDIVIDUAL DEL ASEGURADO:</b> La vigencia individual de la cobertura
                                    para cada asegurado será mensual renovable automáticamente, iniciándose en el momento del desembolso
                                    del préstamo por parte de la Entidad de intermediación financiera a favor del asegurado (Prestatario) y
                                    finalizando en el momento de la extinción de la operación de préstamo. Esta vigencia se interrumpirá en caso
                                    de incumplimiento de pago de la prima correspondiente, treinta dias después de la fecha de vencimiento de
                                    pago.<br>
                                    Los reemplazos de la entidad aseguradora que se dieran durante el periodo de vigencia del préstamo, no
                                    interrumpirán la vigencia de la cobertura individual.<br>
                                    <b>CAPITAL ASEGURADO:</b> El capital asegurado durante la vigencia de la póliza corresponderá, para la
                                    cobertura de fallecimiento o invalidez total y permanente de la póliza de seguro de desgravamen hipotecario,
                                    al valor del saldo insoluto de la deuda; y para las coberturas adicionales corresponderá al valor establecido
                                    en el presente Certificado.<br>
                                    PRIMA: El monto de la prima de tarifa del seguro Desgravamen Hipotecario se determinara aplicando la tasa
                                    neta al capital asegurado.<br>
                                    <b>COBERTURAS:</b><br>
                                </div>

                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width:50%;" align="left" valign="top"><b>COBERTURAS BASICAS</b> (considerando las exclusiones de la póliza)</td>
                                        <td style="width:50%;">
                                            &nbsp;&nbsp;&nbsp;&bull;Fallecimiento por cualquier causa.<br>
                                            &nbsp;&nbsp;&nbsp;&bull;Invalidez total y permanente.<br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;" align="left" valign="top"><b>COBERTURAS ADICIONALES</b></td>
                                        <td style="width:50%;">
                                            &nbsp;&nbsp;&nbsp;&bull;Gastos de sepelio.<br>
                                            &nbsp;&nbsp;&nbsp;&bull;Capital adicional indemnizatorio.<br>
                                        </td>
                                    </tr>
                                </table>

                                <b>COBERTURAS:</b><br>
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width: 50%; text-align: center;">
                                            <b>Fallecimiento</b><br>
                                            Hasta cumplir los 75 años y 365 dias.
                                        </td>
                                        <td style="width: 50%; text-align: center;">
                                            <b>Invalidez total y permanente</b><br>
                                            Hasta cumplir los 70 años y 364 dias.
                                        </td>
                                    </tr>
                                </table>

                                <div style="text-align: justify;">
                                    <b>CONDICIONES DE LA POLIZA DE SEGURO DE DESGRAVAMEN HIPOTECARIO</b><br>
                                    <b>COBERTURA DEL SEGURO:</b> El capital asegurado será pagado por la entidad aseguradora, cuando ocurra
                                    uno de los siguientes eventos:<br>
                                    Fallecimiento: La muerte por cualquier causa del asegurado, si esta ocurriera durante la vigencia de la
                                    póliza y la causa no se encuentre expresamente excluida.<br>
                                    Invalidez total y permanente: Cuando la situación fisica del asegurado como consecuencia de una
                                    enfermedad o accidente presenta una pérdida o disminución de su capacidad fisica y/o intelectual, igual o
                                    superior al 60% de su capacidad de trabajo, siempre que el grado de tal incapacidad sea reconocido y
                                    formalizado por el instituto nacional de salud ocupacional (INSO) o la entidad encargada de calificar (EEC) o
                                    por un médico calificado debidamente registrado en la APS.<br>
                                    De Permanencia: Máxima: 76 años (Hasta cumplir 77 años)
                                    <b>EXCLUSIONES DE COBERTURA:</b> La entidad Aseguradora no cubrirá y estará eximida de toda
                                    responsabilidad, en caso que el Fallecimiento o invalidez Total y Permanente del Asegurado sobrevenga,
                                    directa o indirectamente, como consecuencia de:
                                </div>

                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">a.</td>
                                        <td style="width:98%;">Enfermedad preexistente que no fue comunicada por el Asegurado a través del Formulario de Solicitud de
                                            Seguro y Declaración de Salud.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">b.</td>
                                        <td style="width:98%;">Intervención directa o indirecta del Asegurado en actos criminales, que le ocasionen el Fallecimiento o
                                            invalidez Total y Permanente.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">c.</td>
                                        <td style="width:98%;">Guerra internacional o civil (declarada o no), revolución, invasión, actos de sublevación, rebelión, sedición,
                                            motin o hechos que las leyes califican como delitos contra la seguridad del Estado.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">d.</td>
                                        <td style="width:98%;">Fisión, fusión nuclear o contaminación radioactiva.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">e.</td>
                                        <td style="width:98%;">Realización o participación en una actividad o deporte riesgoso no declarada por el Asegurado a través del
                                            Formulario de Solicitud de Seguro y Declaración de Salud, considerándose como tales aquellos que
                                            objetivamente constituyan una agravación del riesgo o se requiera de medidas de protección o seguridad
                                            para realizarlos.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">f.</td>
                                        <td style="width:98%;">Suicidio causado dentro de los dos primeros años a partir del desembolso del préstamo.
                                        </td>
                                    </tr>
                                </table>

                                <div style="text-align: justify;">
                                    <b>OBLIGACIÓN DE DECLARAR DEL ASEGURADO:</b> El Asegurado está obligado a declarar objetiva y
                                    verazmente las afectaciones de salud que tiene y todo hecho y circunstancias que tengan importancia para la
                                    determinación del estado de riesgo, tal como lo conozca; a través del Formulario de Declaración de Salud
                                    proporcionado por la Entidad Aseguradora.<br>
                                    Si se extendió la póliza de Seguro de Desgravamen Hipotecario sin exigir al Asegurado las declaraciones
                                    escritas, se presume que la Entidad Aseguradora conocia el estado de riesgo, salvo que ésta pruebe dolo o
                                    mala fe del Asegurado.<br>
                                    <b>RETICENCIA O INEXACTITUD:</b> La reticencia o inexactitud en las declaraciones del asegurado en el
                                    Formulario de Declaración de Salud hacen anulable el Certificado de Cobertura, siempre y cuando dicha
                                    reticencia o inexactitud suponga ocultación de antecedentes, de tal importancia que, de ser conocidos por la
                                    Entidad Aseguradora, ésta no habrá otorgado la o las coberturas del contrato o de hacerlo, lo hubiera hecho
                                    en condiciones distintas. La Entidad Aseguradora deberá demostrar este aspecto al momento de alegar
                                    reticencia o inexactitud.<br>
                                    Las declaraciones falsas o reticentes hechas con dolo o mala fe por parte del Asegurado hacen nula la
                                    Cobertura Individual, en tal caso del Asegurado no tendrá derecho a la devolución de primas pagadas.
                                    Se presume la buena fe del Asegurado, correspondiendo probar lo contrario a la Entidad Aseguradora.
                                    La Entidad Aseguradora no puede alegar reticencia o inexactitud, en los siguientes casos:
                                </div>

                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">a.</td>
                                        <td style="width:98%;">Si la reticencia o inexactitud no implica un mayor riesgo, tal que conocidos por la Entidad Aseguradora los
                                            hechos o estados de situación verdaderos, la misma admitiría el riesgo sin recargo alguno.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">b.</td>
                                        <td style="width:98%;">Si la Entidad Aseguradora otorga cobertura al Asegurado con el Certificado de Cobertura Individual sin
                                            exigir la Declaración de Salud.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">c.</td>
                                        <td style="width:98%;">Si el Asegurado al momento de su Declaración de Salud no conocia el estado del riesgo.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">d.</td>
                                        <td style="width:98%;">Si la Entidad Aseguradora no pidió antes de la emisión del Certificado de Cobertura Individual, las
                                            aclaraciones en puntos manifiestamente vagos y/o imprecisos de las declaraciones.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">e.</td>
                                        <td style="width:98%;">Si la Entidad Aseguradora por otros medios de manera previa a la aceptación del estado de riesgo tuvo
                                            conocimiento del verdadero estado del riesgo.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" align="left" valign="top">f.</td>
                                        <td style="width:98%;">Si la reticencia o inexactitud no tiene relación con la producción del siniestro o sus efectos.
                                        </td>
                                    </tr>
                                </table>

                                <div style="text-align: justify;">
                                    <b>INDISPUTABILIDAD:</b> La validez de esta Póliza y su Cobertura no será discutida después de transcurridos
                                    los dos años desde el momento de la fecha de desembolso del préstamo y de la aceptación expresa o táctica
                                    de la Entidad Aseguradora.<br>
                                </div>

                            </td>
                            <td style="width: 2%;"></td>
                            <td style="width: 49%;" valign="top">

                                <div style="text-align: justify">
                                    Si dentro de los dos años desde la fecha de desembolso del préstamo, la Entidad Aseguradora no ha
                                    pretendido impugnar o anular dicha cobertura por reticencia o inexactitud en las Declaraciones de Salud del
                                    Asegurado. La Entidad Aseguradora pasado dicho plazo, está impedida de pretender la impugnación o
                                    anulación.<br>
                                    Para efectos de cómputo del plazo mencionado precedentemente, se considerará la permanencia continua e
                                    ininterrumpida de la Cobertura individual, no obstante la misma hubiera sido otorgada por más de una
                                    Entidad Aseguradora.<br>
                                    La falta de pago de primas por parte del Asegurado libera a la Entidad Aseguradora a Indemnizar en caso de
                                    producido evento.<br>
                                    <b>SUICIDIO:</b> La Entidad Aseguradora no se libera de pagar el siniestro correspondiente, en
                                    caso de producirse el suicidio del Asegurado, después de dos años desde el desembolso del préstamo.<br>
                                    <b>PRIMA Y REHABILITACION:</b> La Prima de Tarifa a ser pagada por el Asegurado, resultará del producto de
                                    una tasa neta mensual aplicable al Capital Asegurado.<br>
                                    La prima es debida desde el momento de la celebración del contrato, pero no es exigible sino con la emisión
                                    del presente Certificado de Cobertura Individual.<br>
                                    El pago de la prima deberá ser efectuado mensualmente por el Asegurado a la Entidad Aseguradora, a
                                    través de la Entidad de Intermediación Financiera, designada por la Entidad Aseguradora, en las mismas
                                    fechas del cronograma de amortización del préstamo, salvo que en el Condicionado Particular de la Póliza se
                                    establezca una modalidad diferente. No incurre en mora el Asegurado, si el lugar indicado en la Póliza ha
                                    sido cambiado sin su conocimiento.<br>
                                    El incumplimiento de pago de la prima (30) dias después de la fecha en que debió efectuarse, interrumpirá la
                                    vigencia de la Cobertura Individual del Asegurado.<br>
                                    El Asegurado o el Tomador del seguro puede, en cualquier momento, rehabilitar la Cobertura, con el pago de
                                    la(s) prima(s) atrasada(s) y los intereses devengados sin la necesidad de examen médico.<br>
                                    El abono de las primas de la Entidad de Intermediación Financiera a la Entidad Aseguradora, en forma
                                    posterior a la fecha en que el Asegurado pagó la prima, no significará mora o incumplimiento atribuible al
                                    Asegurado, y cualquier contingencia o perjuicio que causen dichas situaciones al Asegurado, serán de
                                    responsabilidad plena de la Entidad de Intermediación Financiera.<br>
                                    <b>PROCEDIMIENTO EN CASO DE SINIESTRO:</b> El Asegurado o Beneficiario, en un plazo máximo de quince
                                    (15) dias calendario de tener conocimiento del siniestro, deberá comunicar tal hecho a la Entidad
                                    Aseguradora, salvo fuerza mayor o impedimento justificado.<br>
                                    La Entidad Aseguradora debe pronunciarse sobre el derecho del Asegurado o Beneficiario dentro de los (3)
                                    dias de recibida la información y evidencias del Siniestro. Se dejará constancia escrita de la fecha de
                                    recepción de la información y evidencias a afecto del cómputo de plazos.<br>
                                    El plazo de (30) dias mencionado, fenece con la aceptación o rechazo del Siniestro o con la solicitud de la
                                    Entidad Aseguradora al Asegurado para que se complemente la información, y este plazo no vuelve a correr
                                    hasta que el Asegurado haya cumplido con tales requerimientos.<br>
                                    La solicitud de complementación por parte de la Entidad Aseguradora no podrá extenderse por más de dos
                                    veces a partir de la primera solicitud de informes y evidencias, debiendo pronunciarse dentro del plazo
                                    establecido y de manera definitiva sobre el derecho del Asegurado y/o Beneficiario, después de la entrega
                                    por parte del Asegurado y/o Beneficiario del último requerimiento de información.<br>
                                    El silencio de la Entidad Aseguradora, vencido el término para pronunciarse o vencida(s) la(s) solicitud(es) de
                                    complementación, importa la aceptación del reclamo.
                                </div>
                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="text-align:left; font-weight: bold;" colspan="2">
                                            a) Documentación para el pago de indemnización en caso de Fallecimiento del Asegurado.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Certificado de Defunción extendido por el Oficial de Registro Civil. Si el asegurado hubiera fallecido fuera
                                            del pais, el indicado Certificado deberá llevar las legalizaciones correspondientes del consulado boliviano del
                                            pais donde hubiera ocurrido el hecho o el consulado boliviano más accesible, y el de la Autoridad
                                            Competente en territorio del Estado Plurinacional de Bolivia.<br>
                                            En caso de que la obtención del Certificado de Defunción fuera dificultosa por ausencia de Oficinas de
                                            Registro Civil en la jurisdicción municipal del domicilio del Asegurado siniestrado o en la jurisdicción
                                            municipal colindante del municipio donde vive el Asegurado siniestrado, podrá ser aceptada una certificación
                                            extendida por la autoridad comunitaria competente del lugar de ocurrencia del siniestro, con la participación
                                            de dos personas en calidad de testigos.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Documento de identificación del Asegurado.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Formulario de declaración de siniestro o nota de denuncia del siniestro.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Documento de Pre-liquidación del préstamo emitido por el Tomador.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="text-align:left; font-weight: bold;" colspan="2">
                                            b) Documentación para el Pago de la indemnización en caso de Invalidez Total y Permanente.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Declaración Médica de Invalidez, emitida por el instituto Nacional de Salud Ocupacional (INSO) o por la
                                            Entidad Encargada de Calificación (EEC) o por el médico calificador registrado en la APS.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Documento de identificación del Asegurado.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Formulario de declaración de siniestro o nota de denuncia del siniestro.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left" style="width:5%; padding-left: 6px;" valign="top">-</td>
                                        <td style="width:94%; text-align: justify;">
                                            Documento de Pre-liquidación del préstamo emitido por el Tomador.
                                        </td>
                                    </tr>
                                </table>
                                <b>PERDIDA DEL DERECHO A LA INDEMINIZACIÓN:</b> El Asegurado o el Beneficiario pierde el derecho a la
                                indemnización o pago de prestaciones convencidas, cuando:

                                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                    <tr>
                                        <td style="width:2%;" valign="top">a</td>
                                        <td style="width:98%;">Provoque dolosamente el siniestro. </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" valign="top">b</td>
                                        <td style="width:98%;">
                                            Oculte o altere, maliciosamente en la verificación del siniestro, los hechos y circunstancias relacionados al
                                            aviso del siniestro y la documentación requerida por la Entidad Aseguradora.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:2%;" valign="top">c</td>
                                        <td style="width:98%;">Recurra a pruebas falsas con el ánimo de obtener un beneficio ilicito.
                                        </td>
                                    </tr>
                                </table>
                                <div style="text-align: justify;">
                                    <b>CONTROVERSIAS:</b> Las controversias de hecho sobre las caracteristicas técnicas del seguro, serán
                                    resueltas a través del peritaje, de acuerdo a lo establecido en la Póliza de Seguro y el presente Certificado.
                                    Si por esta via no se llegara a un acuerdo sobre dichas controversias, éstas deberán definirse por la via del
                                    arbitraje.<br>
                                    Las partes, de común acuerdo, podrán nombrar un perito único; si no hubiera acuerdo cada parte nombrará
                                    el suyo y un tercero dirimidor. Este último será designado por el Juez, si las partes no acuerdan su
                                    nombramiento.<br>
                                    Las controversias de derecho suscitadas entre las partes sobre la naturaleza y alcance del contrato de
                                    seguro, serán resueltas únicamente por la via del arbitraje de acuerdo a lo previsto en la Ley Nº 708 de 25 de
                                    junio de 2015.<br>
                                    La Autoridad de Fiscalización y Control de Pensiones y Seguros podrá fungir como instancia de conciliación,
                                    para todo siniestro cuya cuantia no supere el monto de UFV100.000, 00.- (Cien Mil 00/100 Unidades de
                                    Fomento a la Vivienda). Si por esta via y considerando dicha cuantia, no existiera un acuerdo, la Autoridad de
                                    Fiscalización y Control de Pensiones y Seguros podrá conocer y resolver la controversia por Resolución
                                    Administrativa debidamente motivada.
                                </div>

                            </td>
                        </tr>
                    </table>

                    <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; font-size: 57%;">
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
                @endif

            </div>
        </div>
        @if(count($query_details)>1)
            <page><div style="page-break-before: always;">&nbsp;</div></page>
        @endif
    @endforeach

@if($cop < 3 && $type!='PDF')
    <page><div style="page-break-before: always;">&nbsp;</div></page>
@endif
@var $cop = $cop + 1
@endforeach