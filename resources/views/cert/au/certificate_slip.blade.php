<div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 10px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            @var $fecha_registro = $query_header->created_at
            @var $num_limit = $query_parameter->expiration
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 70%; font-family: Arial;">
                <tr>
                    <td style="width:34%; text-align: left;">
                        <img src="{{ asset($query->img_retailer) }}" width="100">
                    </td>
                    <td style="width:32%;"></td>
                    <td style="width:34%; text-align:right;">
                        <img src="{{ asset($query->img_company) }}" height="60">
                    </td>
                </tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr>
                    <td style="width:34%; text-align: left;">
                        SLIP DE COTIZACIÓN<br/>Cotizacion No {{$query_header->quote_number}}
                    </td>
                    <td style="width:32%;"></td>
                    <td style="width:34%; text-align:right;">
                        Cotización válida hasta el: {{date("d-m-Y", strtotime("$fecha_registro +$num_limit day"))}}
                    </td>
                </tr>
            </table><br/>
        </div><br>
        <div style="width: 770px; border: 0px solid #ffff00; text-align:center;">
            @var $parameter = config('base.client_genders')
            @var $gender = $parameter[$query_client->gender]
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 70%; font-family: Arial;">
                <tr>
                    <td colspan="3" style="height: 20px; padding-bottom: 5px; text-align: left; font-weight: bold;">
                        Datos del Titular
                    </td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:33%; text-align:center; font-weight:bold;">Apellido Paterno</td>
                    <td style="width:33%; text-align:center; font-weight:bold;">Apellido Materno</td>
                    <td style="width:34%; text-align:center; font-weight:bold;">Nombres</td>
                </tr>
                <tr>
                    <td style="width:33%; text-align:center;"> </td>
                    <td style="width:33%; text-align:center;">{{$query_client->mother_last_name}}</td>
                    <td style="width:34%; text-align:center;">{{$query_client->first_name}}</td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:33%; text-align:center; font-weight:bold;">Documento de Identidad</td>
                    <td style="width:33%; text-align:center; font-weight:bold;">Genero</td>
                    <td style="width:34%; text-align:center; font-weight:bold;">Fecha de Nacimiento</td>
                </tr>
                <tr>
                    <td style="width:33%; text-align:center;">{{$query_client->dni}}</td>
                    <td style="width:33%; text-align:center;">{{$gender}}</td>
                    <td style="width:34%; text-align:center;">{{$query_client->birth_place}}</td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:33%; text-align:center; font-weight:bold;">Telefono Domicilio</td>
                    <td style="width:33%; text-align:center; font-weight:bold;">Telefono Celular</td>
                    <td style="width:34%; text-align:center; font-weight:bold;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:33%; text-align:center;">{{$query_client->phone_number_home}}</td>
                    <td style="width:33%; text-align:center;">{{$query_client->phone_number_mobile}}</td>
                    <td style="width:34%; text-align:center;">&nbsp;</td>
                </tr>
            </table>
        </div><br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0; font-weight: bold; font-size: 70%;">
                Datos de la solicitud de Crédito
            </h2>
            @var $parameter_term = config('base.term_types')
            @var $term = $parameter_term[$query_header->type_term]
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 70%; font-family: Arial;">
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Compañía de Seguros:</b></td>
                    <td style="width:50%; text-align: left;">{{$query->company}}</td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right;"><b>Seguro a contratar:</b></td>
                    <td style="width:50%; text-align: left;">Automotores</td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Periodo de contratacion:</b></td>
                    <td style="width:50%; text-align: left;">
                        {{$query_header->term}} {{$term}}
                    </td>
                </tr>
                @if($query_header->payment_method=='AN')
                    <tr style="background:#D5D5D5;">
                        <td style="width:50%; text-align:right;"><b>Prima Anual:</b></td>
                        <td style="width:50%; text-align: left;">
                            {{$query_header->total_premium/$year}}
                        </td>
                    </tr>
                @endif
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Prima total:</b></td>
                    <td style="width:50%; text-align: left;">
                        {{$query_header->total_premium}}
                    </td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right;"><b>Inicio de vigencia:</b></td>
                    <td style="width:50%; text-align: left;">
                        {{date('d-m-Y',strtotime($query_header->validity_start))}}
                    </td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Fin de vigencia:</b></td>
                    <td style="width:50%; text-align: left;">
                        {{date('d-m-Y',strtotime($query_header->validity_end))}}
                    </td>
                </tr>
            </table>
        </div><br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0; font-weight: bold; font-size: 70%;">
                Datos del Vehículo
            </h2>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 70%; font-family: Arial;">
                <tr>
                    <td style="width:10%; text-align:center;"><b>Tipo de vehiculo</b></td>
                    <td style="width:10%; text-align:center;"><b>Marca</b></td>
                    <td style="width:10%; text-align:center;"><b>Modelo</b></td>
                    <td style="width:10%; text-align:center;"><b>Cero km.</b></td>
                    <td style="width:10%; text-align:center;"><b>Año</b></td>
                    <td style="width:10%; text-align:center;"><b>Placa</b></td>
                    <td style="width:10%; text-align:center;"><b>Categoria</b></td>
                    <td style="width:10%; text-align:center;"><b>Valor Asegurado</b></td>
                    <td style="width:10%; text-align:center;"><b>Tasa Total</b></td>
                    @if($query_header->payment_method=='AN')
                        <td style="width:10%; text-align:center;"><b>Prima Anual</b></td>
                    @endif
                </tr>
                @foreach($query_car as $data_vehicle)
                    <tr>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->vehicle}}</td>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->make}}</td>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->model}}</td>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->mileage==1?'SI':'NO'}}</td>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->year}}</td>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->license_plate}}</td>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->category}}</td>
                        <td style="width:10%; text-align:center;">{{number_format($data_vehicle->insured_value,2,".",",")}}</td>
                        <td style="width:10%; text-align:center;">{{$data_vehicle->rate}}</td>
                        @if($query_header->payment_method=='AN')
                            <td style="width:10%; text-align:center;">{{$data_vehicle->premium/$year}}</td>
                        @endif
                    </tr>
                @endforeach
            </table>
        </div><br>
        <div style="width: 770px; border: 0px solid #ffff00; text-align: center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0; font-weight: bold; font-size: 70%;">
                Forma de Pago
            </h2>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 90%; height: auto; font-size: 70%; font-family: Arial;" align="center">
                <tr>
                    <td style="width:30%; text-align:center;"><b>Año</b></td>
                    <td style="width:30%; text-align:center;"><b>Fecha de Pago</b></td>
                    <td style="width:30%; text-align:center;"><b>Cuota</b></td>
                </tr>
                @foreach(json_decode($query_header->share) as $formaPago)
                    <tr>
                        <td style="width:30%; text-align:center;">{{ $formaPago->number }}</td>
                        <td style="width:30%; text-align:center;">{{ date('Y-m-d',strtotime($formaPago->date)) }}</td>
                        <td style="width:30%; text-align:center;">{{ $formaPago->share }}</td>
                    </tr>
                @endforeach
            </table>
        </div><br>

        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; font-size: 70%;">
            <b>MATERIA ASEGURADA</b>
            Vehículos de propiedad de clientes de {{$query->retailer}}. y que fueran objeto de garantía a favor del contratante, se deberán asegurar vehículos con una antigüedad máxima de 25 años.
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;  border: 0px solid #ffff00;">
                <tr>
                    <td style="width:2%; text-align: left; font-size: 70%;">A.</td>
                    <td style="width:98%; text-align: left; font-size: 70%;">
                        Vehículos Livianos: Particulares y Públicos, automóviles, vagonetas, minibuses, motocicleta, cuadratracks, y similares
                    </td>
                </tr>
                <tr>
                    <td style="width:2%; text-align: left; font-size: 70%;">B.</td>
                    <td style="width:98%; text-align: left; font-size: 70%;">
                        Vehículos Pesados y Semi Pesados: Particulares y Públicos, Microbuses, Flotas y Buses, Camiones, Tractocamiones, Volquetas, Chatas, vehículos de carga y/o Acoplados, y/o similares, que realizan viajes interdepartamentales e interprovinciales o de circulación en radio Urbano.
                    </td>
                </tr>
            </table>
            Accesorios hasta $us. 500,00 solamente para la categoría A, para vehículos particulares
            <br><br>
            <b>VALOR ASEGURADO:</b><br>
            Valor comercial según avalúo del vehículo y/o precio de mercado.<br>
            Para vehículos 0 kilómetros la factura de compra, proforma, o documento equivalente.<br><br>

            <b>COBERTURAS</b>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Responsabilidad Civil Hasta $us 10.000.00</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Responsabilidad Consecuencial hasta $us 3.000,00</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Pérdida Total por Accidente al 100%</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Pérdida Total por robo al 100%</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Robo Parcial para vehículos livianos solo para la alternativa A al 80%, se excluye vehiculos pesados (Alternativa B) </td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;"> Daños propios, Huelgas, Riesgos Políticos, Conmoción Civil y Daño Malicioso incluyendo terrorismo, con Franquicia $us 50, y para vehículos de la alternativa B $us. 100.-</td>
                </tr>
            </table><br>
            <b>COBERTURA ADICIONAL</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td style="width:100%; font-size: 70%;">Extraterritorialidad gratuita por toda la vigencia de la póliza, sin comunicación previa a la compañía y aplicable a todas las coberturas,  solamente para vehículos alternativa A</td>
                </tr>
            </table><br>

            <b>TASAS ANUALES</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td style="width:100%; text-align:center; font-size: 70%;">VEHICULOS LIVIANOS: PARTICULARES Y PUBLICOS</td>
                </tr>
            </table><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto;  font-family: Arial;">
                <tr>
                    <td rowspan="2" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        VALOR
                    </td>
                    <td colspan="5" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        TASAS
                    </td>
                </tr>
                <tr>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 1
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 2
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 3
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 4
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 5
                    </td>
                </tr>
                <tr>
                    <td style="width:50%; text-align:left; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; font-size: 70%;">
                        Menor o igual a $us. 100.000,00
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        1.75%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        3.40%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        4.99%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        6.51%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        7.88%
                    </td>
                </tr>
            </table><br><br>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td style="width:100%; text-align:center; font-size: 70%;">VEHICULOS PESADOS: PARTICULARES Y PUBLICOS</td>
                </tr>
            </table><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto;  font-family: Arial;">
                <tr>
                    <td rowspan="2" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        VALOR
                    </td>
                    <td colspan="5" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        TASAS
                    </td>
                </tr>
                <tr>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 1
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 2
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 3
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 4
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8; font-size: 70%;">
                        AÑO 5
                    </td>
                </tr>
                <tr>
                    <td style="width:50%; text-align:left; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; font-size: 70%;">
                        Menor o igual a $us. 100.000,00
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        2.50%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        4.85%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        7.13%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        9.30%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000; font-size: 70%;">
                        11.25%
                    </td>
                </tr>
            </table><br>

            <b>CLAUSULAS ADICIONALES</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Adelanto del 50% en Caso de Siniestro </td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Ampliación de Aviso de Siniestro hasta 15 días</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Ausencia de Control solo para empresas</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Daños a Causa de Riesgo de la Naturaleza</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Elegibilidad de Talleres de Reparación</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Elegibilidad de Ajustadores</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Rehabilitación Automática de la Suma Asegurada</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Rescisión del Contrato a Prorrata</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Tránsito en Vías no Autorizadas</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Altas y Bajas (Inclusiones y Exclusiones) a prorrata</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Eliminación de la copia legalizada de Tránsito, para siniestros menores a $us 1.000,00.- excepto para casos de Responsabilidad Civil y Pérdida Total.</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Flete Aéreo</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Depreciación anual del 10% (En pólizas con vigencia mayor a un año)</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Subrogación, hasta finalizar el crédito</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De Errores y Omisiones (en la descripción de los datos de la materia asegurada y el llenado del formulario)</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De cobertura para eventos cuando el conductor del vehículo asegurado cuente con licencia de conducir, pero al momento de la ocurrencia del evento no la porte (un evento al año).</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De piezas y partes genuinas. Para vehículos importados</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De siniestros a consecuencia de Pérdida Total por accidente y/o robo a vehículos cuya antigüedad no exceda el primer año o los 10.000KM de recorrido, se deberá considerar como valor de indemnización, el valor de compra de un vehículo cero kilómetros, descontando la parte impositiva.</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">De ampliación de vigencia a prorrata hasta 90 días sin modificación de términos, condiciones, tasas y primas pactadas en el contrato inicial.</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Cobertura para bolsas de aire por daños a consecuencia de accidente de tránsito, robo y/o intento de robo sin ninguna limitación</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Asistencia en audiencias de transito</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Preparación y presentación de memoriales</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Asistencia a audiencias de Conciliación</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Gastos y costas judiciales (por acción civil)</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Presentación de fianzas judiciales (por acción civil)</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size: 70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size: 70%;">Se deja sin efecto la presentación del Test de Alcoholemia para accidentes ocurridos en el área rural o pueblos alejados de las ciudades principales. En su reemplazo la Aseguradora aceptara la presentación del informe de la autoridad competente de la localidad en la que haya ocurrido el siniestro o localidad más cercana.</td>
                </tr>
            </table><br>
            <b>CONDICIONES ESPECIALES</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td style="width:2%; font-size:70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size:70%;">El valor asegurado corresponderá al valor comercial.</td>
                </tr>
                <tr>
                    <td style="width:2%; font-size:70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size:70%;">
                        Para odo certificado emitido para vehículos cero kilómetros deberá adjuntarse únicamente la nota de entrega o factura de compra de la casa de venta.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%; font-size:70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size:70%;">La cobertura de robo total contratada, se extenderá a cubrir los daños y/o perdidas parciales ocurridas como consecuencia del robo total perpetrado, en la eventualidad de haberse logrado el recupero del vehículo dentro de los 45 días. </td>
                </tr>
                <tr>
                    <td style="width:2%; font-size:70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size:70%;">El presente seguro se extiende a cubrir todos los daños y/o pérdidas que sufran los vehículos asegurados como consecuencia de cualquier servicio adicional que preste la compañía de seguros (instalaciones, auxilio mecánico, grúa, rastreo). </td>
                </tr>
                <tr>
                    <td style="width:2%; font-size:70%;" valign="top">&bull;</td>
                    <td style="width:98%; font-size:70%;">Aceptación del riesgo al que están expuestos los bienes, en función a las actividades que desarrolla el Contratante. </td>
                </tr>
            </table><br>
            <div style="font-size: 70%;">
            <b>NOTAS ESPECIALES</b><br>
            EL ASEGURADO AUTORIZA A LA COMPAÑÍA DE SEGUROS A ENVIAR EL REPORTE A LA CENTRAL DE RIESGOS DEL MERCADO DE SEGUROS ACORDE A LAS NORMATIVAS REGLAMENTARIAS DE LA AUTORIDAD DE FISCALIZACIÓN Y CONTROL DE PENSIONES Y SEGUROS – APS.
            </div>
            <br><br><br>
        </div>

        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 60%; height: auto; font-size: 70%; font-family: Arial;">
                <tr>
                    <td style="width:30%;" align="center">{{$query_client->first_name}} {{$query_client->mother_last_name}} {{$query_client->last_name}}</td>
                    <td style="width:30%;" align="center">15-10-1970</td>
                </tr>
                <tr>
                    <td style="width:30%;" align="center"><b>Titular 1</b></td>
                    <td style="width:30%;" align="center"><b>Fecha Actual</b></td>
                </tr>
            </table>
        </div>
    </div>
</div>



