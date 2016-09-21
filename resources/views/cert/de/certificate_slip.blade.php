<div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 10px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            @var $fecha_registro = $query_header->created_at
            @foreach($query_parameter as $data_parameter)
                @if($data_parameter->slug=='GE')
                    @var $num_limit = $data_parameter->expiration

                @elseif($data_parameter->slug=='FC')
                    @var $amount_max = $data_parameter->amount_max

                @endif
            @endforeach
            <!--TAMAÑO DE FUENTE-->
            @var $font_size_parent='font-size:70%;'
            @var $font_size_child='font-size:100%;'
            @if($type=='PDF')
                @var $font_size_parent='font-size:60%;'
                @var $font_size_child='font-size:60%;'
                @endif
            <!--REALIZAMOS LA CONVERSION USD A BS-->
            @if($query_header->currency=='USD')
                @var $monto_solicitado = $query_header->amount_requested*$query_exchange->bs_value
            @elseif($query_header->currency=='BS')
                @var $monto_solicitado = $query_header->amount_requested
            @endif

            <!--ESTILO GRILLA-->
            @var $clear = 'clear: both;'
            @var $grid = 'width:770px; border: 0px solid #FFFF00; padding-left:0px;'
            @var $grid_element = 'width: 253px; float: left; border:0px solid #0081C2;'

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="width:34%;" align="left">
                        <img src="{{ asset($query->img_retailer) }}" width="100">
                    </td>
                    <td style="width:32%;"></td>
                    <td style="width:34%;" align="right">
                        <img src="{{ asset($query->img_company) }}" height="60">
                    </td>
                </tr>
                <tr>
                    <td style="width:34%;" align="left">SLIP DE COTIZACIÓN {{$query_header->prefix}}-{{$query_header->quote_number}}</td>
                    <td style="width:32%;"></td>
                    <td style="width:34%;" align="right">Cotización válida hasta el: {{date("d-m-Y", strtotime("$fecha_registro +$num_limit day"))}}</td>
                </tr>
                <tr>
                    <td colspan="3" style="width:100%;" align="center">
                        DECLARACION JURADA DE SALUD<br/>
                        SOLICITUD DE SEGURO DE DESGRAVAMEN HIPOTECARIO
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            @var $parameter_term = config('base.term_types')
            @var $term = $parameter_term[$query_header->type_term]
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td colspan="2" style="width:100%; height: 20px;" align="left">
                        Datos de la solicitud de Crédito
                    </td>
                </tr>
                <tr><td colspan="2" style="width:100%;">&nbsp;</td></tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right; height: 20px;"><b>Tipo Cobertura:&nbsp;</b></td>
                    <td style="width:50%; text-align: left;">{{$query_header->coverage}}</td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right; height: 20px;">
                        <b>Monto Actual Solicitado:&nbsp;</b>
                    </td>
                    <td style="width:50%; text-align: left;">{{ number_format($query_header->amount_requested,2,',','.').' '.$query_header->currency }}</td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right; height: 20px;">
                        <b>Plazo del Presente Crédito:&nbsp;</b>
                    </td>
                    <td style="width:50%; text-align: left;">
                        {{ $query_header->term }} {{$term}}
                    </td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right; height: 20px;"><b>Producto:&nbsp;</b></td>
                    <td style="width:50%; text-align: left;">{{ $query_header->credit_product }}</td>
                </tr>
            </table>
        </div><br>
        @var $i=1
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            @foreach($query_details as $data_detail)
                <div style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0; font-weight: bold; font-size: 70%;">Titular {{$i}}</div>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                    <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                        <td style="width:25%; text-align:center; font-weight:bold;">Apellido Paterno</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Apellido Materno</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Nombres</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Apellido de Casada</td>
                    </tr>
                    <tr>
                        <td style="width:25%; text-align:center;">{{$data_detail->last_name}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->mother_last_name}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->first_name}}</td>
                        <td style="width:25%; text-align:center;">
                            @if($data_detail->civil_status=='C')
                                {{$data_detail->married_name}}
                            @endif
                        </td>
                    </tr>
                    <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                        <td style="width:25%; text-align:center; font-weight:bold;">Lugar de Nacimiento</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Pais</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Fecha de Nacimiento</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Lugar de Residencia</td>
                    </tr>
                    <tr>
                        <td style="width:25%; text-align:center;">{{$data_detail->birth_place}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->country}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->birthdate}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->place_residence}}</td>
                    </tr>
                    <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                        <td style="width:25%; text-align:center; font-weight:bold;">
                            Documento de Identidad o Pasaporte
                        </td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Edad</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Peso (kg)</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Estatura (cm)</td>
                    </tr>
                    <tr>
                        <td style="width:25%; text-align:center;">{{$data_detail->dni}} {{$data_detail->complement}} {{$data_detail->extension}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->age}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->weight}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->height}}</td>
                    </tr>
                    <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                        <td colspan="2" style="width:50%; text-align:center; font-weight:bold;">
                            Dirección del Domicilio
                        </td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Tel. Domicilio</td>
                        <td style="width:25%; text-align:center; font-weight:bold;">Tel. Oficina</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:50%; text-align:center;">{{$data_detail->home_address}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->phone_number_home}}</td>
                        <td style="width:25%; text-align:center;">{{$data_detail->phone_number_office}}</td>
                    </tr>
                    <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                        <td colspan="2" style="width:50%; text-align:center; font-weight:bold;">Ocupación</td>
                        <td colspan="2" style="width:50%; text-align:center; font-weight:bold;">Descripción</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="width:50%; text-align:center;">{{$data_detail->occupation}}</td>
                        <td colspan="2" style="width:50%; text-align:center;">{{$data_detail->occupation_description}}</td>
                    </tr>
                </table>
                <div style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                        font-weight: bold; {{$font_size_parent}}">Cuestionario</div>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                    @foreach(json_decode($data_detail->response) as $key => $value)
                        @if($monto_solicitado<=$amount_max)
                            <tr>
                                <td style="width: 2%; text-align: left;">{{$key}}</td>
                                <td style="width: 95%; text-align: left;">
                                    {{$value->question}}
                                </td>
                                <td style="width: 3%; text-align: right;">
                                    {{$value->response==1?'SI':'NO'}}
                                </td>
                            </tr>
                        @else
                            @if($key<=5)
                                <tr>
                                    <td style="width: 2%; text-align: left;">{{$key}}</td>
                                    <td style="width: 95%; text-align: left;">
                                        {{$value->question}}
                                    </td>
                                    <td style="width: 3%; text-align: right;">
                                        {{$value->response==1?'SI':'NO'}}
                                    </td>
                                </tr>
                            @endif
                        @endif

                    @endforeach
                </table><br>
                @if($monto_solicitado<=$amount_max)
                    <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; {{$font_size_parent}} border:1px solid #000000; height: auto; font-family: Arial; margin-bottom: 8px;">
                        <tr style="background:#D3DCE3;">
                            <td style="padding:0 5px; width:5%;">Pregunta</td>
                            <td style="text-align:center; width:34%">Enfermedad Parecida o tratamiento recomendado</td>
                            <td style="text-align:center; width:6%;">Fecha</td>
                            <td style="text-align:center; width:6%;">Duraci&oacute;n</td>
                            <td style="text-align:center; width:34%;">Nombre de la clinica o del m&eacute;dico tratante</td>
                            <td style="text-align:center; width:12%;">Estado actual</td>
                        </tr>';
                        @for($y=1;$y<=2;$y++)
                            <tr style="background:#E5E5E5;">
                                <td style="padding:0 5px; width:3%;">ff</td>
                                <td style="text-align:center; width:35%">ff</td>
                                <td style="text-align:center; width:6%;">
                                    ff
                                </td>
                                <td style="text-align:center; width:6%;">ff</td>
                                <td style="text-align:center; width:35%;">ff</td>
                                <td style="text-align:center; width:12%;">ff</td>
                            </tr>
                        @endfor
                    </table>
                @endif
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_parent}} font-family: Arial;">
                <tr>
                    <td style="width: 100%;">
                        @if($facul_q['fac'][$i] == true)
                            <div style="text-align:justify; border:1px solid #3B6E22; background:#6AA74F; padding:8px; color:#ffffff;">
                                Cumple con las preguntas del cuestionario
                            </div>
                        @else
                            <div style="text-align:justify; border:1px solid #C68A8A; background:#FFEBEA; padding:8px;">
                                <b>Nota:</b>&nbsp;Al no cumplir con una o mas preguntas del cuestionario del presente slip,
                                la compa&ntilde;&iacute;a de seguros solicitar&aacute; ex&aacute;menes m&eacute;dicos para la autorizaci&oacute;n
                                de aprobaci&oacute;n del seguro o en su defecto podr&aacute; declinar la misma.
                            </div>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%;">
                        <div style="width: auto; height: auto; text-align: left; margin: 7px 0; padding: 0; font-weight: bold;">
                            Indice de Masa Corporal
                        </div>

                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                            <tr>
                                <td style="width: 30%;">
                                    {{$imc_arr['status'][$i]}}
                                </td>
                                <td style="width: 30%;">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; {{$font_size_child}}">
                                        <tr>
                                            <td style="width: 100%; color:#ffffff; background:#0075AA; height: 20px;" colspan="2">
                                                Datos
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 70%; height: 20px;">
                                                Estatura
                                            </td>
                                            <td style="width: 30%;">
                                                {{$data_detail->height}} cm
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 70%; height: 20px;">
                                                Peso
                                            </td>
                                            <td style="width: 30%;">
                                                {{$data_detail->weight}} kg
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="width: 40%;"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%;">
                        @if($imc_arr['imc'][$i] == true)
                            <div style="text-align:justify; border:1px solid #C68A8A; background:#FFEBEA; padding:8px;">
                                <strong>Nota: </strong> Al no cumplir con el peso y la estatura adecuados, la compañ&iacute;a de seguros solicitar&aacute;
                                ex&aacute;menes m&eacute;dicos para la autorizaci&oacute;n de aprobaci&oacute;n del seguro o en su defecto podra declinar la misma.
                            </div>
                        @else
                            <div style="text-align:justify; border:1px solid #3B6E22; background:#6AA74F; padding:8px; color:#ffffff;">
                                Cumple con la estatura y peso adecuado.
                            </div>
                        @endif
                    </td>
                </tr>
            </table>
                @var $i=$i+1;
            @endforeach
        </div><br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; {{$font_size_parent}}">
            @if($monto_solicitado>$amount_max)
                Declaro haber contestado con total veracidad, m&aacute;xima buena fe a todas las preguntas
                del presente cuestionario y no haber omitido u ocultado hechos y/o circunstancias que hubieran
                podido influir en la celebracion del Contrato de Seguro. Relevo expresamente del secreto
                profesional y legal, a cualquier m&eacute;dico que me hubiese asistido y/o tratado de
                dolencias y le autorizo a revelar a <?=$regi1['nombre'];?> Todos los datos y antecedentes
                patol&oacute;gicos que pudiera tener o de los que hubiera adquirido conocimiento al prestarme
                servicios. Entiendo que de presentarse alguna eventualidad contemplada bajo la P&oacute;liza
                de Seguro como conscuencia de alguna enfermedad existente a la fecha de la firma de este
                documento o cuando haya alcanzado la edad l&iacute;mite estipulada en la P&oacute;liza,
                la Compa&ntilde;ia Aseguradora quedara liberada de toda responsabilidad en lo que respecta a
                mi Seguro. Finalmente, declaro conocer en su totalidad lo estipulado en mi P&oacute;liza de
                Seguro.<br/><br/>
            @else
                Declaro haber contestado con total veracidad, m&aacute;xima buena fe a todas las preguntas
                del presente cuestionario y no haber omitido u ocultado hechos y/o circunstancias que hubieran
                podido influir en la celebracion del Contrato de Seguro.<br/><br/>

                La Compa&ntilde;ia no asume responsabilidad alguna que la prima haya sido pagada y el
                Certificado se encuentre emitido y en poder del Asegurado.<br/><br/>
            @endif

            <b>CONTRATANTE: </b>FUNDACION SARTAWI<br/>
            <b>ACTIVIDAD GENERAL: </b>Varias y sin limitaciones<br/><br/>

            <b>RIESGOS CUBIERTOS:</b><br/>
            @if($monto_solicitado > $amount_max)
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li><b>Muerte por cualquier Causa</b>, que no est&eacute; excluida en el Condicionado General de la P&oacute;liza incluido el suicidio despu&eacute;s de 2 a&ntilde;os de vigencia ininterrumpida de la cobertura individual del seguro.</li>

                    <li><b>Pago anticipado del capital asegurado en caso de invalidez total y permanente por accidente o enfermedad</b>, en forma irreversible por lo menos en un 65% seg&uacute;n el manual de normas autorizado por la APS,  en actual vigencia.</li>

                    <li><b>Gastos de Sepelio</b>, son los  gastos que demanden los herederos legales o nominados por el Sepelio de un Asegurado (Titular o Conyugue), como consecuencia del fallecimiento por una enfermedad o un accidente cubierto para el Titular.
                    </li>
                </ol>
            @else
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li><b>Muerte por cualquier causa</b>, que no est&eacute; excluida en el Condicionado General de la P&oacute;liza incluido el suicidio despu&eacute;s de 2 a&ntilde;os de vigencia ininterrumpida de la cobertura individual del seguro.</li>
                    <li><b>Pago anticipado del capital asegurado en caso de invalidez total y permanente por accidente o enfermedad</b>, en forma irreversible por lo menos en un 65% seg&uacute;n el manual de normas autorizado por la APS, en actual vigencia.</li>
                    <li><b>Gastos de Sepelio</b>, son los gastos que demanden los herederos legales o nominados por el Sepelio de un Asegurado (titular o Conyugue), como consecuencia del fallecimiento por una enfermedad o un accidente cubierto para el Titular.</li>
                    <li><b>Doble Indemnizaci&oacute;n por Muerte Accidental Beneficio del 50% adicional de capital a favor del Asegurado</b>: En caso de muerte accidental, la Aseguradora indemnizara el 50% del saldo capital adicional (diferencia entre acreencia a favor del tomador de la P&oacute;liza y el saldo de la operaci&oacute;n crediticia desembolsada) a favor de los Beneficiarios declarados en el respectivo formulario por el Prestatario.</li>
                    <li>Muerte por cualquier causa, Beneficio del 10% adicional del capital a favor del Asegurado en los primeros 90 d&iacute;as: En caso de muerte por cualquier causa hasta los primeros 90 d&iacute;as transcurridos (computable desde la fecha de desembolso al prestatario) la Aseguradora indemnizara el 10% de capital adicional a favor de los Beneficiarios declarados en el respectivo formulario por el Prestatario.</li>
                </ol>
            @endif
            <b>CAPITALES ASEGURADOS:</b><br/>
            @if($monto_solicitado > $amount_max)
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li> Saldo deudor.</li>
                    <li> Saldo deudor.</li>
                    <li> USD 300.00</li>
                </ol>
            @else
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li> Monto desembolsado hasta USD 5,000.00 o Bs. 35,000.00</li>
                    <li> Monto desembolsado hasta USD 5,000.00 o Bs. 35,000.00</li>
                    <li> USD 300.00</li>
                </ol>
            @endif
            <b>RIESGOS EXCLUIDOS:</b> La Compa&ntilde;&iacute;a no cubre y esta eximida de toda responsabilidad en caso de fallecimiento del asegurado en los siguientes casos:<br/>
            @if($monto_solicitado > $amount_max)
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li>	Si el asegurado participa como conductor o acompa&ntilde;ante en competencias de autom&oacute;viles, motocicletas, lanchas de motor o avionetas, practicas de paraca&iacute;das.</li>
                    <li>	Si el asegurado realiza operaciones o viajes submarinos o en transportes a&eacute;reos no autorizados para transporte de pasajeros, vuelos no regulares.</li>
                    <li>	Enfermedades pre-existentes conocidas al inicio del seguro o enfermedad cong&eacute;nita, para cr&eacute;ditos mayores a USD. 5,001.00 o 35,001.00</li>
                    <li>	SIDA/HIV para siniestros a partir de USD. 5,001.00 o Bs. 35,001.00</li>
                    <li>	Guerra, invasi&oacute;n, revoluci&oacute;n, sublevaci&oacute;n, mot&iacute;n o hechos que las leyes clasifiquen como delitos contra la seguridad del Estado, siempre y cuando el asegurado no participe activamente.</li>
                    <li>	Suicidio realizado por el asegurado dentro de 2 a&ntilde;os de vigencia ininterrumpida de su cobertura. En consecuencia este riesgo quedara cubierto a partir del primer d&iacute;a del tercer a&ntilde;o de vigencia para cada operaci&oacute;n asegurada.</li>
                    <li>	Fisi&oacute;n o fusi&oacute;n nuclear</li>
                </ol>
            @else
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li>	Si el asegurado participa como conductor o acompa&ntilde;ante en competencias de autom&oacute;viles, motocicletas, lanchas de motor o avionetas, practicas de paraca&iacute;das.</li>
                    <li>	Si el asegurado realiza operaciones o viajes submarinos o en transportes a&eacute;reos no autorizados para transporte de pasajeros, vuelos no regulares.</li>
                    <li>	Enfermedades pre-existentes conocidas al inicio del seguro o enfermedad cong&eacute;nita, para cr&eacute;ditos mayores a USD. 5,001.00 o Bs. 35,001.00</li>
                    <li>	SIDA/HIV para siniestros a partir de USD. 5,001.00 o Bs. 35,001.00</li>
                    <li>	Guerra, invasi&oacute;n, revoluci&oacute;n, sublevaci&oacute;n, mot&iacute;n o hechos que las leyes clasifiquen como delitos contra la seguridad del Estado, siempre y cuando el asegurado no participe activamente.</li>
                    <li>	Suicidio realizado por el asegurado dentro de 2 a&ntilde;os de vigencia ininterrumpida de su cobertura. En consecuencia este riesgo quedara cubierto a partir del primer d&iacute;a del tercer a&ntilde;o de vigencia para cada operaci&oacute;n asegurada.</li>
                    <li>	Fisi&oacute;n o fusi&oacute;n nuclear, contaminaci&oacute;n radioactiva.</li>
                    <li>Acto delictuoso, cometido en calidad de autor o complice, por un beneficiario o quien pudiere reclamar indeminzaci&oacute;n </li>
                </ol>
            @endif
            <b>EDAD DE ADMISI&Oacute;N Y PERMANENCIA:</b><br/>
            @if($monto_solicitado > $amount_max)
                <b>Para muerte:</b><br/>
                M&iacute;nima 18 a&ntilde;os<br/>
                M&aacute;xima 70 a&ntilde;os (hasta cumplir los 71 a&ntilde;os)<br/>
                <b>Permanencia:</b> 75 a&ntilde;os inclusive hasta cumplir los 76 a&ntilde;os<br/><br/>
            @else
                <b>Para muerte:</b><br/>
                M&iacute;nima 18 a&ntilde;os<br/>
                M&aacute;xima 70 a&ntilde;os (hasta cumplir los 71 a&ntilde;os)<br/>
                <b>Permanencia:</b> 75 a&ntilde;os inclusive hasta cumplir los 76 a&ntilde;os<br/><br/>
            @endif
            <b>Para invalidez:</b><br/>
            Minima 18 a&ntilde;os<br/>
            Maxima 64 a&ntilde;os (hasta cumplir 65 a&ntilde;os)<br/>
            <b>Permanencia:</b> 70 a&ntilde;os inclusive hasta cumplir los 71 a&ntilde;os<br/><br/>

            <div style="width: auto; height: auto; text-align: left; margin: 7px 0; padding: 0; font-weight: bold;">
                Tasa Mensual
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 70%; {{$font_size_child}}" align="center">
                <tr style="font-weight:bold; text-align:center; color:#FFF; background:#0075AA;">
                    <td style="width: 30%; height: 20px;">NOMBRE</td>
                    <td style="width: 30%; height: 20px;">VALOR ASEGURADO</td>
                    <td style="width: 10%; height: 20px;">TASA FINAL</td>
                </tr>
                @foreach($query_details as $data_cl)
                    <tr>
                        <td style="width: 30%; text-align: left;">{{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}</td>
                        <td style="width: 30%;">{{$query_header->amount_requested.' '.$query_header->currency}}</td>
                        <td style="width: 10%;">{{$query_header->total_rate}}%</td>
                    </tr>
                @endforeach
            </table><br>
            <b>PRIMA:</b> De acuerdo a declaraciones mensuales del contratante, por mes vencido<br/>
            <b>FORMA DE PAGO:</b> Contado a trav&eacute;s de FUNDACION SARTAWI<br/>
            @if($monto_solicitado > $amount_max)
                <b>BENEFICIARIO:</b> FUNDACION SARTAWI T&Iacute;TULO ONEROSO y/o El Tomador del seguro<br/><br/>
            @else
                <b>BENEFICIARIO:</b> FUNDACION SARTAWI T&Iacute;TULO ONEROSO y una vez hecha la acreencia en favor de Funcaci&oacute;n Sartawi los designados por el asegurado<br/><br/>
            @endif
            <b>OBSERVACIONES:</b> Las primas del seguro no constituyen hecho generador de tributo seg&uacute;n el Art. No. 54 de la Ley de Seguros 1883 del 25 de Junio de 1998 y a la Resoluci&oacute;n Ministerial Nro. 880 del 28 de Junio de 1999. Autorizo a la compa&ntilde;&iacute;a mi reporte a la Central de Riesgos del Mercado de Seguros, acorde a las normativas reglamentarias de la Autoridad de Fiscalizaci&oacute;n y Control de Pensiones y Seguros.<br/><br/>

            <b>INICIO DE LA COBERTURA:</b> La cobertura de esta P&oacute;liza para cada Asegurado aceptado, comenzar&aacute; a partir del momento del desembolso de su cr&eacute;dito por parte de <b>FUNDACI&Oacute;N SARTAWI</b>, previo cumplimiento de lo establecido en los "Requisitos de Asegurabilidad".<br/><br/>

            <b>AVISO DE SINIESTRO:</b> En caso de fallecimiento o invalidez total y permanente del Asegurado, el tomador, tan pronto y a m&aacute;s tardar dentro de los 90 d&iacute;as calendario siguientes de tener conocimiento del siniestro, debe comunicar el mismo a la Compa&ntilde;&iacute;a, salvo fuerza mayor o impedimento justificado, caso contrario la Compa&ntilde;&iacute;a se libera de cualquier responsabilidad indemnizatoria por extemporaneidad.<br/><br/>

            <b>PLAZO PARA PAGO DE SINIESTRO:</b> El plazo para el pago de siniestros por sepelio ser&aacute; realizado dentro de 2 d&iacute;as h&aacute;biles de recibidos todos los documentos requeridos por la compa&ntilde;&iacute;a.
            para el pago de siniestros por las dem&aacute;s coberturas ser&aacute; dentro de los 10 d&iacute;as de presentados todos los documentos.<br/><br/>
            @if($monto_solicitado > $amount_max)
                <b>PARA SINIESTROS HASTA USD 5.000:</b>
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">

                    <li> Original de la Declaraci&oacute;n Jurada de Salud.</li>
                    <li> Certificado de Defunci&oacute;n, (para el &aacute;rea rural podr&aacute; presentar un certificado de cualquier autoridad local del pueblo o localidad, dandofe del fallecimiento del asegurado y la certificaci&oacute;n del jefe de agencia).</li>
                    <li> Fotocopia de C.I. y/o fotocopia de Certificado de Nacimiento y/o Carnet de Identidad RUN y/o libreta de servicio militar.</li>
                    <li> Estado de cuenta saldo deudor.</li>
                    <li> <b>Para el caso de Invalidez:</b> Certificado INSO (Instituto Nacional de Salud Ocupacional) o en su defecto de otra instituci&oacute;n que est&eacute; debidamente autorizada por la Autoridad Competente, la cual determine el grado de invalidez.</li>

                </ol><br/>

                <b>PARA SINIESTROS DE USD 5.001 EN ADELANTE:</b>
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li>Original de la Declaraci&oacute;n Jurada de Salud</li>
                    <li>Certificado de Defunci&oacute;n, (para el &aacute;rea rural podr&aacute; presentar un certificado de cualquier autoridad local del pueblo o localidad, dando fe del fallecimiento del asegurado y la certificaci&oacute;n del jefe de agencia).</li>
                    <li>Fotocopia de C.I. y/o fotocopia de Certificado de Nacimiento y/o Carnet de Identidad RUN y/o libreta de servicio militar.</li>
                    <li>Estado de cuenta saldo deudor.</li>
                    <li>Historia Clinica si existiera.</li>
                    <li><b>Para el caso de Invalidez:</b> Certificado INSO (Instituto Nacional de Salud Ocupacional) o en su defecto de otra instituci&oacute;n que est&eacute; debidamente autorizada por la Autoridad Competente, la cual determine el grado de invalidez.</li>
                </ol><br/>

                <b>SEPELIO:</b>
                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li>Fotocopia del Carnet de Identidad del Asegurado, y/o Fotocopia de Certificado de nacimiento y/o Carnet de identidad RUN y/o libreta del servicio militar.</li>
                    <li>Fotocopia de carnet de identidad del Beneficiario y/o Fotocopia de Certificado de nacimiento y/o Carnet de identidad RUN y/o libreta de servicio militar.</li>
                    <li>Certificado de Defunci&oacute;n, (para el &aacute;rea rural podr&aacute; presentar un certificado de cualquier autoridad local del pueblo o localidad, dandofe del fallecimiento del asegurado y la certificaci&oacute;n del jefe de agencia).</li>
                    <li>Declaratoria de Beneficiarios o declaratoria de herederos en caso de no existir la nominacion de los mismos.</li>
                    <li>Carta de los beneficiarios solicitando el beneficio.</li>
                </ol><br/>
            @else
                <b>Para siniestros hasta USD 5,000.00  &oacute; Bs. 35,000.00</b>

                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">

                    <li>Certificado de Defunci&oacute;n, (para el &Aacute;rea Rural podr&aacute; presentar un certificado de cualquier autoridad local del pueblo o localidad, dando fe del fallecimiento del asegurado y la certificaci&oacute;n del jefe de agencia).</li>
                    <li>Fotocopia del C.I. y/o Fotocopia de certificado de nacimiento, y/o Carnet de identidad RUN y/o libreta de servicio militar.</li>
                    <li>Estado de cuenta saldo deudor.</li>
                    <li>Declaratoria de Beneficiarios o declaratoria de herederos en caso de no existir la nominaci&oacute;n de los mismos.</li>
                    <li>Fotocopia de la denuncia policial o de otra autoridad competente (en caso de muerte accidental)</li>
                    <li>Fotocopia de C.I. de los beneficiarios nominados.</li>
                    <li><b>Para el caso de Invalidez:</b> Certificado INSO (Instituto Nacional de Salud Ocupacional) o en su defecto de otra instituci&oacute;n que est&eacute; debidamente autorizada por la Autoridad Competente, la cual determine el grado de invalidez.
                    </li>
                </ol><br/>

                <b>Sepelio</b>

                <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha; width: 770px;">
                    <li>Fotocopia del C.I. del asegurado y/o Fotocopia de certificado de nacimiento, y/o Carnet de identidad RUN y/o libreta de servicio militar.</li>
                    <li>Fotocopia del C.I. del Beneficiario y/o Fotocopia de certificado de nacimiento, y/o Carnet de identidad RUN y/o libreta de servicio militar.</li>
                    <li>Certificado de Defunci&oacute;n, (para el &Aacute;rea Rural podr&aacute; presentar un certificado de cualquier autoridad local del pueblo o localidad, dando fe del fallecimiento del asegurado y la certificaci&oacute;n del jefe de agencia).</li>
                    <li>Declaratoria de Beneficiarios o declaratoria de herederos en caso de no existir la nominaci&oacute;n de los mismos.</li>
                    <li>Carta de los Beneficiarios solicitando el beneficio.</li>
                </ol><br/>
            @endif

            Todo lo que no est&eacute; previsto por el Certificado de Cobertura Individual, se
            sujetar&aacute; a lo establecido en las Condiciones Particulares, Condiciones Generales y
            dem&aacute;s documentos Anexos a la presente P&oacute;liza de Seguro de Desgravamen
            Hipotecario en Grupo, el C&oacute;digo de Comercio, la Ley de Seguros y por las disposiciones
            legales vigentes en la materia.
            <br><br><br><br><br><br><br>

            <div style="{{$grid}}">
                @if(count($query_details)==1)
                    <div style="{{$grid_element}}">&nbsp;</div>
                    @foreach($query_details as $data_cl)
                        <div style="{{$grid_element}}">
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}} font-family: Arial;">
                                <tr>
                                    <td style="width: 60%; text-align: center;">{{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}</td>
                                    <td style="width: 40%; text-align: center;">{{ date('d-m-Y', strtotime($query_header->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; text-align: center;">Titular 1</td>
                                    <td style="width: 40%; text-align: center;">Fecha Actual</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                    <div style="{{$grid_element}}">&nbsp;</div>
                @elseif(count($query_details)==2)
                    @var $ct=1
                    @foreach($query_details as $data_cl)
                        <div style="{{$grid_element}}">
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}} font-family: Arial;">
                                <tr>
                                    <td style="width: 60%; text-align: center;">{{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}</td>
                                    <td style="width: 40%; text-align: center;">{{ date('d-m-Y', strtotime($query_header->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; text-align: center;">Titular 1</td>
                                    <td style="width: 40%; text-align: center;">Fecha Actual</td>
                                </tr>
                            </table>
                        </div>
                        @if($ct<count($query_details))
                            <div style="{{$grid_element}}">&nbsp;</div>
                        @endif
                        @var $ct=$ct+1
                    @endforeach
                @else
                    @foreach($query_details as $data_cl)
                        <div style="{{$grid_element}}">
                            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; {{$font_size_child}}} font-family: Arial;">
                                <tr>
                                    <td style="width: 60%; text-align: center;">{{$data_cl->first_name.' '.$data_cl->last_name.' '.$data_cl->mother_last_name}}</td>
                                    <td style="width: 40%; text-align: center;">{{ date('d-m-Y', strtotime($query_header->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 60%; text-align: center;">Titular 1</td>
                                    <td style="width: 40%; text-align: center;">Fecha Actual</td>
                                </tr>
                            </table>
                        </div>
                    @endforeach
                @endif
            </div>
            <div style="{{$clear}}"></div>

            <div style="text-align:justify; border:1px solid #3B6E22; background:#6AA74F; padding:8px; color:#ffffff;">
                Si el cúmulo de créditos que usted tiene actualmente supera el Valor permitido para este producto, la
                aprobación de la presente cotización estará sujeta a revisión de la Compañía de Seguros que seleccione
            </div>

        </div>
    </div>
</div>