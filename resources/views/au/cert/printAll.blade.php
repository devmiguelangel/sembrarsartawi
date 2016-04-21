@include('partials.tools_modal',array('type'=>$type,'idHeader'=>encode($header->id),'aux'=>$aux))
<div style="width: 100%; height: auto; border: 0px solid #0081C2; padding: 10px;">
    <div style="width: 100%; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; ">
        <div style="width: 100%; border: 0px solid #FFFF00; text-align:center;">
            @include('partials.logos_modal',array('image1'=>$retailer->image,'images'=>$retailerProduct))
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                
                <tr><td colspan="3" style="width:100%;">&nbsp;</td></tr>
                <tr>
                    <td style="width:34%; text-align: left;">
                        SLIP DE COTIZACIÓN<br/>Cotizacion No {{ $header->quote_number }} 
                    </td>
                    <td style="width:32%;"></td>
                    <td style="width:34%; text-align:right;">
                        
                        Cotización válida hasta el: {{ $data['fecha_validacion'] }}
                    </td>
                </tr>
            </table><br/>
        </div><br>
        <div style="width: 100%; border: 0px solid #ffff00; text-align:center;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td colspan="3" style="width:100%; height: 20px; padding-bottom: 5px; text-align: left; font-weight: bold;">
                        Datos del Titular
                    </td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:33%; text-align:center; font-weight:bold;">Apellido Paterno</td>
                    <td style="width:33%; text-align:center; font-weight:bold;">Apellido Materno</td>
                    <td style="width:34%; text-align:center; font-weight:bold;">Nombres</td>
                </tr>
                <tr>
                    <td style="width:33%; text-align:center;">{{ $header->client->last_name }}</td>
                    <td style="width:33%; text-align:center;">{{ $header->client->mother_last_name }}</td>
                    <td style="width:34%; text-align:center;">{{ $header->client->first_name }}</td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:33%; text-align:center; font-weight:bold;">Documento de Identidad</td>
                    <td style="width:33%; text-align:center; font-weight:bold;">Genero</td>
                    <td style="width:34%; text-align:center; font-weight:bold;">Fecha de Nacimiento</td>
                </tr>
                <tr>
                    <td style="width:33%; text-align:center;">{{ $header->client->dni }}</td>
                    <td style="width:33%; text-align:center;">{{ $header->client->gender == 'M'?'Masculino':'Femenino' }}</td>
                    <td style="width:34%; text-align:center;">{{ date('Y-m-d',strtotime($header->client->birthdate)) }}</td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:33%; text-align:center; font-weight:bold;">Telefono Domicilio</td>
                    <td style="width:33%; text-align:center; font-weight:bold;">Telefono Celular</td>
                    <td style="width:34%; text-align:center; font-weight:bold;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:33%; text-align:center;">{{ $header->client->phone_number_office }}</td>
                    <td style="width:33%; text-align:center;">{{ $header->client->phone_number_mobile }}</td>
                    <td style="width:34%; text-align:center;">&nbsp;</td>
                </tr>
            </table>
        </div><br>
        <div style="width: 100%; border: 0px solid #FFFF00; text-align:center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0;
                font-weight: bold; font-size: 80%;">Datos de la solicitud de Crédito</h2>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Compañía de Seguros:</b></td>
                    <td style="width:50%; text-align: left;">{{ $companyProduct->company->name }}</td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right;"><b>Seguro a contratar:</b></td>
                    <td style="width:50%; text-align: left;">{{ $companyProduct->product->name }}</td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Periodo de contratacion:</b></td>
                    <td style="width:50%; text-align: left;">{{ $header->type_term == 'Y'?'Años':'Meses' }} {{ $header->term }}</td>
                </tr>
                @if($header->payment_method == 'AN')
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right;"><b>Prima Anual:</b></td>
                    <td style="width:50%; text-align: left;">{{ $header->total_premium * $header->term }}</td>
                </tr>
                @endif
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Prima total:</b></td>
                    <td style="width:50%; text-align: left;">{{ ($header->total_premium/$header->term)*$header->term }}</td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right;"><b>Inicio de vigencia:</b></td>
                    <td style="width:50%; text-align: left;">{{ date('Y-m-d',strtotime($header->validity_start)) }}</td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Fin de vigencia:</b></td>
                    <td style="width:50%; text-align: left;">{{ date('Y-m-d',strtotime($header->validity_end)) }}</td>
                </tr>
            </table>
        </div><br>
        <div style="width: 100%; border: 0px solid #FFFF00; text-align:center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0;
                font-weight: bold; font-size: 80%;">Datos del Vehículo</h2>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
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
                    @if($header->payment_method == 'AN')
                    <td style="width:10%; text-align:center;"><b>Prima Anual</b></td>
                    @endif
                </tr>
                @foreach($header->details as $detail )
                <tr>
                    <td style="width:10%; text-align:center;">{{ $detail->vehicleType->vehicle }}</td>
                    <td style="width:10%; text-align:center;">{{ $detail->vehicleMake->make }}</td>
                    <td style="width:10%; text-align:center;">{{ $detail->vehicleModel->model }}</td>
                    <td style="width:10%; text-align:center;">{{ $detail->engine }}</td>
                    <td style="width:10%; text-align:center;">{{ $detail->year }}</td>
                    <td style="width:10%; text-align:center;">{{ $detail->license_plate }}</td>
                    <td style="width:10%; text-align:center;">{{ $detail->category->category }}</td>
                    <td style="width:10%; text-align:center;">{{number_format($detail->insured_value,2,".",",")}}</td>
                    <td style="width:10%; text-align:center;">{{ $detail->rate }}</td>
                    @if($header->payment_method == 'AN')
                    <td style="width:10%; text-align:center;">{{ $detail->premium }}</td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div><br>
        <div style="width: 100%; border: 0px solid #ffff00; text-align: center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0;
                font-weight: bold; font-size: 80%;">Forma de Pago</h2>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 90%; height: auto; font-size: 80%; font-family: Arial;" align="center">
                <tr>
                    <td style="width:30%; text-align:center;"><b>Año</b></td>
                    <td style="width:30%; text-align:center;"><b>Fecha de Pago</b></td>
                    <td style="width:30%; text-align:center;"><b>Cuota</b></td>
                </tr>
                @foreach(json_decode($header->share) as $formaPago)
                <tr>
                    <td style="width:30%; text-align:center;">{{ $formaPago->number }}</td>
                    <td style="width:30%; text-align:center;">{{ date('Y-m-d',strtotime($formaPago->date)) }}</td>
                    <td style="width:30%; text-align:center;">{{ $formaPago->share }}</td>
                </tr>
                @endforeach
            </table>
        </div><br>

        <div style="width: 100%; border: 0px solid #FFFF00; text-align:justify; font-size: 80%;">
            <b>MATERIA ASEGURADA</b>
            Vehículos de propiedad de clientes de IDEPRO IFD. y que fueran objeto de garantía a favor del contratante, se deberán asegurar vehículos con una antigüedad máxima de 25 años.
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:80%; border: 0px solid #ffff00;">
                <tr>
                    <td style="width:2%; text-align: left;">A.</td>
                    <td style="width:98%; text-align: left;">
                        Vehículos Livianos: Particulares y Públicos, automóviles, vagonetas, minibuses, motocicleta, cuadratracks, y similares
                    </td>
                </tr>
                <tr>
                    <td style="width:2%; text-align: left;">B.</td>
                    <td style="width:98%; text-align: left;">
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
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:80%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Responsabilidad Civil Hasta $us 10.000.00</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Responsabilidad Consecuencial hasta $us 3.000,00</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Pérdida Total por Accidente al 100%</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Pérdida Total por robo al 100%</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Robo Parcial para vehículos livianos solo para la alternativa A al 80%, se excluye vehiculos pesados (Alternativa B) </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;"> Daños propios, Huelgas, Riesgos Políticos, Conmoción Civil y Daño Malicioso incluyendo terrorismo, con Franquicia $us 50, y para vehículos de la alternativa B $us. 100.-</td>
                </tr>
            </table><br>
            <b>COBERTURA ADICIONAL</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:80%;">
                <tr>
                    <td style="width:100%;">Extraterritorialidad gratuita por toda la vigencia de la póliza, sin comunicación previa a la compañía y aplicable a todas las coberturas,  solamente para vehículos alternativa A</td>
                </tr>
            </table><br>

            <b>TASAS ANUALES</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:80%;">
                <tr>
                    <td style="width:100%; text-align:center;">VEHICULOS LIVIANOS: PARTICULARES Y PUBLICOS</td>
                </tr>
            </table><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td rowspan="2" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; background:#D8D8D8;">
                        VALOR
                    </td>
                    <td colspan="5" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        TASAS
                    </td>
                </tr>
                <tr>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 1
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 2
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 3
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 4
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 5
                    </td>
                </tr>
                <tr>
                    <td style="width:50%; text-align:left; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;">
                        Menor o igual a $us. 100.000,00
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        1.75%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        3.40%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        4.99%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        6.51%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        7.88%
                    </td>
                </tr>
            </table><br><br>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:80%;">
                <tr>
                    <td style="width:100%; text-align:center;">VEHICULOS PESADOS: PARTICULARES Y PUBLICOS</td>
                </tr>
            </table><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td rowspan="2" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; background:#D8D8D8;">
                        VALOR
                    </td>
                    <td colspan="5" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        TASAS
                    </td>
                </tr>
                <tr>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 1
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 2
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 3
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 4
                    </td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        AÑO 5
                    </td>
                </tr>
                <tr>
                    <td style="width:50%; text-align:left; padding:3px; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;">
                        Menor o igual a $us. 100.000,00
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        2.50%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        4.85%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        7.13%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        9.30%
                    </td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        11.25%
                    </td>
                </tr>
            </table><br>

            <b>CLAUSULAS ADICIONALES</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:80%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Adelanto del 50% en Caso de Siniestro </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Ampliación de Aviso de Siniestro hasta 15 días</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Ausencia de Control solo para empresas</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Daños a Causa de Riesgo de la Naturaleza</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Elegibilidad de Talleres de Reparación</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Elegibilidad de Ajustadores</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Rehabilitación Automática de la Suma Asegurada</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Rescisión del Contrato a Prorrata</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Tránsito en Vías no Autorizadas</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Altas y Bajas (Inclusiones y Exclusiones) a prorrata</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Eliminación de la copia legalizada de Tránsito, para siniestros menores a $us 1.000,00.- excepto para casos de Responsabilidad Civil y Pérdida Total.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Flete Aéreo</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Depreciación anual del 10% (En pólizas con vigencia mayor a un año)</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Subrogación, hasta finalizar el crédito</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De Errores y Omisiones (en la descripción de los datos de la materia asegurada y el llenado del formulario)</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De cobertura para eventos cuando el conductor del vehículo asegurado cuente con licencia de conducir, pero al momento de la ocurrencia del evento no la porte (un evento al año).</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De piezas y partes genuinas. Para vehículos importados</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De siniestros a consecuencia de Pérdida Total por accidente y/o robo a vehículos cuya antigüedad no exceda el primer año o los 10.000KM de recorrido, se deberá considerar como valor de indemnización, el valor de compra de un vehículo cero kilómetros, descontando la parte impositiva.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">De ampliación de vigencia a prorrata hasta 90 días sin modificación de términos, condiciones, tasas y primas pactadas en el contrato inicial.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Cobertura para bolsas de aire por daños a consecuencia de accidente de tránsito, robo y/o intento de robo sin ninguna limitación</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Asistencia en audiencias de transito</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Preparación y presentación de memoriales</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Asistencia a audiencias de Conciliación</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Gastos y costas judiciales (por acción civil)</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Presentación de fianzas judiciales (por acción civil)</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Se deja sin efecto la presentación del Test de Alcoholemia para accidentes ocurridos en el área rural o pueblos alejados de las ciudades principales. En su reemplazo la Aseguradora aceptara la presentación del informe de la autoridad competente de la localidad en la que haya ocurrido el siniestro o localidad más cercana.</td>
                </tr>
            </table><br>
            <b>CONDICIONES ESPECIALES</b><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:80%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">El valor asegurado corresponderá al valor comercial.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">
                        Para odo certificado emitido para vehículos cero kilómetros deberá adjuntarse únicamente la nota de entrega o factura de compra de la casa de venta.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">La cobertura de robo total contratada, se extenderá a cubrir los daños y/o perdidas parciales ocurridas como consecuencia del robo total perpetrado, en la eventualidad de haberse logrado el recupero del vehículo dentro de los 45 días. </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">El presente seguro se extiende a cubrir todos los daños y/o pérdidas que sufran los vehículos asegurados como consecuencia de cualquier servicio adicional que preste la compañía de seguros (instalaciones, auxilio mecánico, grúa, rastreo). </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Aceptación del riesgo al que están expuestos los bienes, en función a las actividades que desarrolla el Contratante. </td>
                </tr>
            </table><br>
            <b>NOTAS ESPECIALES</b><br>
            EL ASEGURADO AUTORIZA A LA COMPAÑÍA DE SEGUROS A ENVIAR EL REPORTE A LA CENTRAL DE RIESGOS DEL MERCADO DE SEGUROS ACORDE A LAS NORMATIVAS REGLAMENTARIAS DE LA AUTORIDAD DE FISCALIZACIÓN Y CONTROL DE PENSIONES Y SEGUROS – APS.
            <br><br><br>
        </div>

        <div style="width: 100%; border: 0px solid #FFFF00; text-align:justify; font-size: 80%;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 60%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td style="width:30%;" align="center">{{ $header->client->first_name }} {{ $header->client->mother_last_name }} {{ $header->client->last_name }}</td>
                    <td style="width:30%;" align="center">{{ date('Y-m-d', strtotime($header->created_at)) }}</td>
                </tr>
                <tr>
                    <td style="width:30%;" align="center"><b>Titular 1</b></td>
                    <td style="width:30%;" align="center"><b>Fecha Actual</b></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@foreach($header->details as $detail )
<div style="width: 100%; height: auto; border: 0px solid #0081C2; padding: 5px;">
    <div style="width: 100%; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial;">
            <tr>
                <td style="width:100%;" align="left" valign="top" colspan="3">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td style="width:26%;" align="left" valign="top">
                    &nbsp;
                </td>
                <td style="width:48%; font-weight:bold; text-align:center; font-size: 60%;">

                    Oficina Principal Calacoto Calle Julio Patiño No. 550 esq. Calle 12<br>
                    Central Piloto (2)2775550 Fax (591-02)2203917<br>
                    e-mail: credinform@credinformsa.com<br><br>
                    CERTIFICADO DE COBERTURA INDIVIDUAL<br>
                    PÓLIZA COLECTIVA DE SEGURO DE AUTOMOTORES

                </td>
                <td style="width:26%;" align="right" valign="top">
                    &nbsp;
                </td>
            </tr>
            <tr>
                <td colspan="3" style="width:100%;">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 60%;">
                        <tr>
                            <td style="width:20%; font-weight:bold; text-align:right;">PÓLIZA No.</td>
                            <td style="width:20%;">
                                <div style="border: 1px solid #999; width:125px;">
                                    {{ $header->policy_number }}
                                </div>
                            </td>
                            <td style="width:20%;">&nbsp;</td>
                            <td style="width:14%; font-weight:bold; text-align:right;">CERTIFICADO No.</td>
                            <td style="width:26%;">
                                <div style="border: 1px solid #999; width:125px;">
                                    {{ $header->quote_number }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:10%;">Nombres: </td>
                <td style="width:25%; text-align:center;">{{ $header->client->last_name }}</td>
                <td style="width:22%; text-align:center;">{{ $header->client->mother_last_name }}</td>
                <td style="width:22%; text-align:center;">{{ $header->client->first_name }}</td>
                <td style="width:21%; text-align:center;">{{ $header->client->married_name }}</td>
            </tr>
            <tr>
                <td style="width:10%;"></td>
                <td style="width:25%; border-top:1px solid #999; text-align:center;">Apellido Paterno</td>
                <td style="width:22%; border-top:1px solid #999; text-align:center;">Apellido Materno</td>
                <td style="width:22%; border-top:1px solid #999; text-align:center;">Nombres</td>
                <td style="width:21%; border-top:1px solid #999; text-align:center;">Apellido de Casada</td>
            </tr>
        </table>
        <br>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:10%;">Dirección Legal: </td>
                <td style="width:35%; text-align:center;">{{ $header->client->home_address }}</td>
                <td style="width:12%; text-align:center;">{{ $header->client->home_number }}</td>
                <td style="width:24%; text-align:center;">{{ $header->client->locality }}</td>
                <td style="width:19%;">&nbsp;</td>
            </tr>
            <tr>
                <td style="width:10%;">&nbsp;</td>
                <td style="width:32%; border-top:1px solid #999; text-align:center;">Av. o Calle</td>
                <td style="width:12%; border-top:1px solid #999; text-align:center;">N&uacute;mero</td>
                <td style="width:24%; border-top:1px solid #999; text-align:center;">Ciudad o Localidad</td>
                <td style="width:22%;">&nbsp;</td>
            </tr>
        </table>
        <br>

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:10%;">Tel&eacute;fono: </td>
                <td style="width:20%; text-align:center;">{{ $header->client->phone_number_home }}</td>
                <td style="width:20%; text-align:center;">{{ $header->client->phone_number_office }}</td>
                <td style="width:20%; text-align:center;">{{ $header->client->phone_number_mobile }}</td>
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
        <br>

        <label style="font-weight:bold; font-size:65%; font-family: Arial;">1. Datos del Vehículo:</label><br>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:2%;"></td>
                <td style="width:15%; text-align:left;">Tipo del vehículo:</td>
                <td style="width:83%;">
                    <table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
                        <tbody>
                            @foreach($groupVehicle as $grup)
                                <tr>
                                    @foreach($grup as $vehicle)
                                        <td style="width:20%; text-align:left;">
                                            <table cellspacing="0" cellpadding="0" border="0" style="width:100%; margin-bottom:5px;">
                                                <tbody>
                                                    <tr>
                                                        <td style="width:70%;">{{ $vehicle['name_vehicle'] }}</td>
                                                        <td style="width:30%;">
                                                            <div style="width:15px; height:15px; border:1px solid #333; text-align:center;">
                                                                @if($detail->ad_vehicle_type_id == $vehicle['id_vehicle'])
                                                                    X
                                                                @else
                                                                    &nbsp;
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        <br>    
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:2%;"></td>
                <td style="width:6%; text-align:left;">Marca:</td>
                <td style="width:20%; text-align:left; border-bottom:1px solid #999;">
                    {{ $detail->vehicleMake->make }}
                </td>
                <td style="width:5%;"></td>
                <td style="width:6%; text-align:left;">Modelo:</td>
                <td style="width:20%; text-align:left;border-bottom:1px solid #999;">
                    {{ $detail->vehicleModel->model }}
                </td>
                <td style="width:5%;"></td>
                <td style="width:4%; text-align:left;">Año:</td>
                <td style="width:10%; text-align:left; border-bottom:1px solid #999;">
                    {{ $detail->year }}
                </td>
                <td style="width:5%;"></td>
                <td style="width:5%; text-align:left;">Placa:</td>
                <td style="width:14%; text-align:left; border-bottom:1px solid #999;">
                    {{ $detail->license_plate}}
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px;">
            <tr>
                <td style="width:2%;"></td>
                <td style="width:6%; text-align:left;">Chasis:</td>
                <td style="width:20%; text-align:left; border-bottom:1px solid #999;">
                    {{ $detail->chassis }}
                </td>
                <td style="width:5%;"></td>
                <td style="width:6%; text-align:left;">Motor:</td>
                <td style="width:20%; text-align:left;border-bottom:1px solid #999;">
                    {{ $detail->engine }}
                </td>
                <td style="width:5%;"></td>
                <td style="width:4%; text-align:left;">Color:</td>
                <td style="width:14%; text-align:left; border-bottom:1px solid #999;">
                    {{ $detail->color }}
                </td>
                <td style="width:5%;"></td>
                <td style="width:5%;"></td>
                <td style="width:10%;"></td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px; border:0px solid #999;">
            <tr>
                <td style="width:2%;"></td>
                <td style="width:15%; text-align:left;">Uso del vehículo</td>
                <td style="width:15%; text-align:left;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px;">
                        <tr>
                            <td style="width:45%;">Público</td>
                            <td style="width:55%;">
                                <div style="width:15px; height:15px; border:1px solid #333; text-align:center;">
                                    {{ $detail->use=='PU'?'X':'' }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:15%; text-align:left;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px;">
                        <tr>
                            <td style="width:45%;">Privado</td>
                            <td style="width:55%;">
                                <div style="width:15px; height:15px; border:1px solid #333; text-align:center;">
                                    {{ $detail->use=='PR'?'X':'' }}
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width:8%; text-align:left;">&nbsp;</td>
                <td style="width:10%; text-align:left;">

                </td>
                <td style="width:10%; text-align:left;">

                </td>
                <td style="width:20%; text-align:left;">

                </td>
                <td style="width:5%;"></td>
            </tr>
            <tr><td colspan="9" style="width:100%; text-align:left;"><b>Nota importante:</b> El cambio de uso del vehiculo no afecta la cobertura del riesgo</td></tr>
        </table>
        <br>
        <span style="font-weight:bold; font-size:65%; font-family: Arial;">2. Valor Asegurado:</span>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px; margin-bottom: 5px;">
            <tr>
                <td style="width:2%;"></td>
                <td style="width:40%;">Valor Comercial según avalúo del vehículo y/o precio de mercado</td>
                <td style="width:5%;"></td>
                <td style="width:5%;">USD. </td>
                <td style="width:15%; border-bottom:1px solid #999;">{{number_format($detail->insured_value, 2, '.', ',')}}</td>
                <td style="width:33%;">&nbsp;</td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 5px;">
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
                <td style="width:85%; text-align:left;">(591)-2-2433500&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax: (591)-2-2128329</td>
            </tr>
        </table>
        
        <span style="font-weight:bold; font-size:65%; font-family: Arial;">3. Categoría de vehículos: {{ $detail->category->category }}</span>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-top:4px; font-size:65%; margin-bottom: 5px;">
            <tr>
                <td style="width:50%; padding:4px; text-align:center; background:#CCCCCC; font-weight:bold; border-right:1px solid #000; border-bottom:1px solid #000; border-top:1px solid #000; border-left:1px solid #000;">
                    CATEGORIA A
                </td>
                <td style="width:50%; padding:4px; text-align:center; background:#CCCCCC; font-weight:bold; border-bottom:1px solid #000; border-top:1px solid #000; border-right:1px solid #000;">
                    CATEGORIA B
                </td>
            </tr>
            <tr>
                <td style="width:50%; padding:4px; text-align:center; border-right:1px solid #000; border-bottom:1px solid #000; border-left:1px solid #000;">
                    Vehículos Livianos Particulares y Públicos (automóviles, vagonetas, jeep, camionetas, motocicletas y
                    similares)
                </td>
                <td style="width:50%; padding:4px; text-align:center; border-bottom:1px solid #000; border-right:1px solid #000;">
                    Minibuses, furgonetas, Microbuses, Flotas y Buses, camiones, tractocamiones, volquetas, chatas, acoples
                    y/o similares.
                </td>
            </tr>
        </table>
        <span style="font-weight:bold; font-size:65%; font-family: Arial;">4. Coberturas:</span>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-top:4px; margin-bottom: 5px;">
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Responsabilidad Civil Extracontractual hasta $us 10.000.00
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Pérdida Total por Robo al 100%
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Pérdida Total por Accidente al 100%
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Daños Propios, huelgas, riesgos políticos, conmoción civil y daño malicioso incluyendo terrorismo, con franquicia de $us. 50.- y para vehículos pesados (Categoria B) $us. 100.-
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                <td style="width:98%;">
                    Huelgas, Conmoción Civil, Daño Malicioso; Vandalismo y Terrorismo; Sabotaje para vehículos
                    livianos con franquicia de $us. 50.- (Vehículos Categoría A) y para vehículos pesados con franquicia de
                    $us. 100.- (Vehículos Categoría B). Se extiende a cubrir bajo esta cobertura, los daños al vehículo por
                    intento de robo.
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Robo Parcial al 80%, Solo aplica a Vehículos Livianos
                    (Categoría A), se excluye Vehiculos Pesados (Categoría B)
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Responsabilidad Civil Consecuencial Hasta $us. 3.000.-
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Accesorios hasta USD. 500 solo para vehículos particulares livianos (Categoria A)
                </td>
            </tr>
            <tr>
                <td style="width:2%; font-size:100%; font-weight:bold;">&bull;</td>
                <td style="width:98%;">
                    Extraterritorialidad anual gratuita,  por toda la vigencia de la póliza, sin comunicación previa a la
                    compañía  y aplicable a todas las coberturas, solo para vehiculos livianos (Categoria A)
                </td>
            </tr>
        </table>
        <page><div style="page-break-before: always;">&nbsp;</div></page>
        <span style="font-weight:bold; font-size:65%; font-family: Arial;">5. COBERTURAS ADICIONALES:</span>
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
            <tr>
                <td style="width:50%; text-align: justify; border:0px solid #333;" valign="top">
                    <b>Asistencia Jurídica</b> incluyendo<br>
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">Asistencia de audiencias de Tránsito</td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">Preparación y presentación de memoriales</td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">Asistencia a audiencias de Conciliación</td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">Gastos y costas judiciales (por acción civil)</td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">Presentación de fianzas judiciales (por acción civil)</td>
                        </tr>
                    </table>
                    <b>Beneficio de Auxilio Mecánico</b><br/>
                    LAS 24 HORAS Y DURANTE TODA LA VIGENCIA DENTRO DE TODO EL TERRITORIO BOLIVIANO EXCEPTO PANDO y vehículos
                    de , Se aclara que (para vehículos pesados o de Categoría B, el servicio de auxilio mecánico y/o de
                    remolque por falla mecánica, se encuentra sujeto a reembolso y hasta un máximo de US$ 250 por evento y en
                    el agregado)
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">Remolque o transporte del vehículo en caso de accidente hasta el 5% del
                                valor del asegurado</td>
                        </tr>
                    </table>
                </td>
                <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">
                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">
                                Desplazamiento por la inmovilización y/o robo del vehículo en caso que los beneficiarios e
                                encuentren a más de 25 km. de su domicilio
                            </td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">
                                Depósito y custodia del vehículo en caso de accidente, avería mecánica o robo hasta un límite de
                                $us. 20.-
                            </td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">
                                Servicio de conductor profesional en caso de accidente o fallecimiento del asegurado en caso de
                                imposibilidad de conducir.
                            </td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">
                                Para avería mecánica, Localización y envío de piezas de recambio necesarias para la reparación
                                cuando no fuera posible su obtención.
                            </td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">
                                Transmisión de mensajes urgente.
                            </td>
                        </tr>
                        <tr>
                            <td style="width:2%;" valign="top">-</td>
                            <td style="width:98%;">
                                Línea de emergencia gratuita 24 hrs. /365 días
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        @if($header->facultative === true)
            @if($header->approved === true)
               <table border="0" cellpadding="1" cellspacing="0" style="width: 100%; font-size: 8px; font-weight: normal; font-family: Arial; margin: 2px 0 0 0; padding: 0; border-collapse: collapse; vertical-align: bottom;">
                    <tr>
                        <td colspan="7" style="width:100%; text-align: center; font-weight: bold; background: #e57474;
                            color: #FFFFFF;">
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
                            background: #e57474;">Observaciones</td>
                    </tr>
                    <tr>
                        <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF;
                            border: 1px solid #dedede;">{{ $detail->facultative->approved }}</td>
                        <td style="width:5%; text-align: center; background: #e78484; color: #FFFFFF;
                            border: 1px solid #dedede;">{{ $detail->facultative->surcharge }}</td>
                        <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                            border: 1px solid #dedede;">{{ $detail->facultative->porcentage }} %</td>
                        <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                            border: 1px solid #dedede;">{{ $detail->facultative->current_rate }} %</td>
                        <td style="width:7%; text-align: center; background: #e78484; color: #FFFFFF;
                            border: 1px solid #dedede;">{{ $detail->facultative->final_rate }} %</td>
                        <td style="width:69%; text-align: justify; background: #e78484; color: #FFFFFF;
                            border: 1px solid #dedede;">{{ $header->facultative_observation }}</td>
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
                            {{ $header->facultative_observation }}
                        </td>
                    </tr>
                </table>

            @endif
        @endif
        
        @if($header->issued == true && $header->canceled == false)

            <span style="font-weight: bold; font-size:65%; font-family: Arial;">6. CLÁUSULAS ADICIONALES:</span>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td style="width:50%; text-align: justify; border:0px solid #333;" valign="top">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Anexo aclaratorio a la clausula de remisión de documentos </td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de exclusión de llaves y placas</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Manual de procedimientos para la atención de siniestros</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de anticipo del 50% del siniestro</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de ampliación de aviso de siniestro</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Anexo de ausencia de control (Empresarial)</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula para cubrir daños a causa de la naturaleza</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de libre elegibilidad de talleres de elegibilidad de ajustadores</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de rehabilitación automática de la suma asegurada.</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de rescisión de contrato a prorrata</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de inclusiones y exclusiones</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de eliminación de copia legalizada</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:50%; text-align: justify; padding:5px; border:0px solid #333;" valign="top">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula para flete aéreo</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Anexo de subrogación de derechos -B</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de errores u omisiones</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de extensión de coberturas en caso de no portar licencia de conducir</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de respuestos y partes originales</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de ampliación de vigencia a prorrata bajo los mismos términos y condiciones</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de cobertura de daño de bolsas de aires (AIRBAGS)</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Asistencia Jurídica</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de tránsito en vías no autorizadas</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:100%; font-weight:bold;" valign="top">&bull;</td>
                                <td style="width:98%;">Cláusula de no presentación de la prueba de dosaje etílico en áreas rurales</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <span style="font-weight: bold; font-size:65%; font-family: Arial;">7. Cuadro de Tasas Totales con Vigencia Anual:</span><br>
            <span style="font-size:65%; font-family: Arial;"><b>CATEGORIA A:</b> Vehículos Livianos Particulares y Públicos (automóviles,
                vagonetas, jeep, camionetas, motocicletas, furgonetas, y similares)</span>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
                <tr>
                    <td rowspan="2" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; background:#D8D8D8;">
                        VALOR
                    </td>
                    <td colspan="5" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">
                        TASAS
                    </td>
                </tr>
                <tr>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 1</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 2</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 3</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 4</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 5</td>
                </tr>
                <tr>
                    <td style="width:50%; text-align:left; padding:3px; border-right: 1px solid #000; border-bottom: 1px
                        solid #000; border-left: 1px solid #000;">Menor o igual a US$. 100.000,00</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        1.75%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        3.40%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        4.99%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        6.51%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        7.88%</td>
                </tr>
            </table>
            <span style="font-size:65%; font-family: Arial;"><b>CATEGORIA B:</b> Minibuses, Microbuses, Flotas y
                Buses, camiones, tractocamiones, volquetas, chatas, acoples  y/o similares</span>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td rowspan="2" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid
                        #000; border-right: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000;
                        background:#D8D8D8;">VALOR</td>
                    <td colspan="5" style="width:50%; font-weight:bold; text-align:center; padding:3px; border-top: 1px solid
                        #000; border-right: 1px solid #000; border-bottom: 1px solid #000; background:#D8D8D8;">TASAS</td>
                </tr>
                <tr>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 1</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 2</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 3</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 4</td>
                    <td style="width:10%; font-weight:bold; text-align:center; padding:3px; border-right: 1px solid #000;
                        border-bottom: 1px solid #000; background:#D8D8D8;">AÑO 5</td>
                </tr>
                <tr>
                    <td style="width:50%; text-align:left; padding:3px; border-right: 1px solid #000; border-bottom: 1px
                        solid #000; border-left: 1px solid #000;">Menor o igual a US$. 100.000,00</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        2.50%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        4.85%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        7.13%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        9.30%</td>
                    <td style="width:10%; text-align:center; border-right: 1px solid #000; border-bottom: 1px solid #000;">
                        11.25%</td>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td style="width:20%; font-weight:bold;">5. Fecha inicio de vigencia:</td>
                    <td style="width:25%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial;">
                            <tr>
                                <td style="width:32%; border-bottom:1px solid #999; text-align:center;">{{ date('d',strtotime($header->validity_start)) }}</td>
                                <td style="width:2%;">/</td>
                                <td style="width:32%; border-bottom:1px solid #999; text-align:center;">{{ date('m',strtotime($header->validity_start)) }}</td>
                                <td style="width:2%;">/</td>
                                <td style="width:32%; border-bottom:1px solid #999; text-align:center;">{{ date('Y',strtotime($header->validity_start)) }}</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:55%;">&nbsp;</td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td style="width:25%; font-weight:bold;">6. Plazo del contrato de seguros:</td>
                    <td style="width:20%; border-bottom:1px solid #999; text-align:center;">
                        {{ $header->type_term == 'Y'?'Años':'Meses' }} {{ $header->term }}
                    </td>
                    <td style="width:55%; text-align:left;">El plazo de la póliza debe ser igual al plazo del crédito del
                        asegurado
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
                <tr>
                    <td style="width:15%; font-weight:bold;">8. Forma de Pago:</td>
                    <td style="width:20%; border-bottom:1px solid #999; text-align:center;">
                        @var $parameter = config('base.payment_methods');
                        @var $name = $parameter[$header->payment_method];
                        {{ $name }}
                    </td>
                    <td style="width:65%; text-align:left;">
                        Pago de la prima de acuerdo a la periodicidad de pago del crédito</td>
                </tr>
            </table>

            <br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%;">
                <tr>
                    <td style="width:25%;"></td>
                    <td style="width:35%;"></td>
                    <td style="width:40%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial;">
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
                    <td style="width:25%; border-top:1px solid #999; text-align:center;">Firma del Titular Solicitante</td>
                    <td style="width:35%;">&nbsp;</td>
                    <td style="width:40%; border-top:1px solid #999; text-align:center;">Firmas Autorizadas de la Compañia</td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial; margin-bottom: 4px;">
                <tr>
                    <td style="width:5%; text-align:left;">C.I.</td>
                    <td style="width:15%; border-bottom:1px solid #999; text-align:center;">
                        {{ $header->client->dni }}
                    </td>
                    <td style="width:2%;">&nbsp;</td>
                    <td style="width:12%; text-align:right;">Expedido en:</td>
                    <td style="width:12%; border-bottom:1px solid #333; text-align:center;">
                        {{ $header->client->extension }}
                    </td>
                    <td style="width:54%;">&nbsp;</td>
                </tr>
                <tr>
                    <td style="width:46%; padding-top:5px;" colspan="5">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:20%; text-align:left;">Lugar y fecha:</td>
                                <td style="width:50%; border-bottom:1px solid #999; text-align:center;">
                                    {{ date('Y-m-d', strtotime($header->created_at)) }}
                                </td>
                                <td style="width:30%;">&nbsp;</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:54%;">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6" style="font-size:6pt;" align="right">
                        “Impreso el <?= date("d/m/Y") ?>. El presente certificado reemplaza cualquier otro certificado impreso en fechas anteriores a la indicada.”
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
                <tr>
                    <td style="width:100%;">
                        <b>INFORMACIÓN ADICIONAL PARA EL SEGURO:</b><br>

                        <b>REQUISITOS DE ASEGURABILIDAD:</b>	Antigüedad máxima del vehículo: 25 años<br>

                        <b>CONDICIONES GENERALES Y EXCLUSIONES:</b> De acuerdo al Condicionado General de Seguro de Automotores.
                        con Código de Registro 102-910500-2003 10 085
                        <br><br>
                        <b>NOTAS ESPECIALES:</b><br>
                        El asegurado autoriza a la compañía de seguros a enviar el reporte a la central de riesgos del mercado de
                        seguros acorde a las normativas reglamentarias de la autoridad de fiscalización y control de pensiones y
                        seguros – APS.
                        <br><br>

                        <b>IMPORTANTE:</b><br>
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%;" valign="top">&bull;</td>
                                <td style="width:98%;">
                                    En caso de Pérdida Total por accidente y/o robo y únicamente para vehículos con antig&uuml;edad menor a un año o dentro de los primeros 10.000 KM de recorrido, lo que ocurra primero, se considera el valor de indemnización el valor de compra del vehículo 0Km, descontando el 13% de IVA, no se aplica depreciación en el primer año o 500 KM lo que ocurra primero.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">&bull;</td>
                                <td style="width:98%;">
                                    Para vehículos con antiguedad mayor a 1 año se considera el valor de indemnización el valor comercial actual del mercado
                                </td>
                            </tr>
                        </table>

                    </td>
                </tr>
                <tr>
                    <td style="width:100%; border:1px solid #000; margin-top:4px; text-align:justify; padding:3px;">
                        <b>CONDICION DE ADHESION AL SEGURO:</b><br>
                        El Asegurado se adhiere voluntariamente a los términos establecidos en la presente Póliza Colectiva de Seguro de Automotores y
                        declara conocer y estar de acuerdo con las condiciones del contrato de seguro. Asimismo, acepta la
                        obligación de pago de prima para mantener vigente la cobertura de la póliza.<br>
                        <b>PAGO DE PRIMAS.</b> A El incumplimiento en el pago de la prima más los intereses, dentro de los plazos
                        fijados, suspende la vigencia de la póliza. Si esto sucede, la Compañía tiene derecho con fuerza ejecutiva
                        a la prima correspondiente por el periodo corrido, calculado a prorrata.

                    </td>
                </tr>
                <tr>
                    <td style="width:100%;">
                        <b>PROCEDIMIENTO EN CASO DE SINIESTRO:</b>
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">1</td>
                                <td style="width:98%;">En caso de siniestro denunciar a la Compañía a la brevedad posible a la linea gratuita 800107002</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">2</td>
                                <td style="width:98%;">Si hubieran heridos prestar en la primera instancia la atencion médica de primeros auxilios, o solicitar inmediata ayuda para su traslado al centro médico</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">3</td>
                                <td style="width:98%;">Tomar todas las precauciones que estén a su alcance para proteger el vehículo siniestrado y evitar la agravación y propagación de los daños materiales y/o personales</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">4</td>
                                <td style="width:98%;">Denunciar, en el mismo día, el hecho a la Autoridad Competente, en la jurisdicción donde se produjo el hecho, oficializando todas las circunstancias y detalles del mismo y someterse a la prueba de dosaje etílico, aun cuando dichas autoridades no se lo requieran. Asimismo, recabar el informe Técnico Circunstancial, emitido por Tránsito o la Autoridad Competente</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">5</td>
                                <td style="width:98%;">Esperar la autorización de la Compañía para realizar cualquier reparación de daños al vehículo siniestrado. En caso de existir daños a terceros o a causa de terceros (sean materiales o personales), debe comunicarse de inmediato a la Compañía para realizar cualquier acuerdo judicial o extrajudicial, caso contrario la Aseguradora, no compromete la responsabilidad indemnizatoria</td>
                            </tr>
                        </table>
                        Presentar a la Compañía con la siguiente documentación:
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">1</td>
                                <td style="width:98%;">Formulario de denuncia de la Compañía debidamente llenado y firmado por el Asegurado o Beneficiario</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">2</td>
                                <td style="width:98%;">Copia legalizada de la Denuncia de Tránsito</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">3</td>
                                <td style="width:98%;">Copia de la Licencia de conductor del vehículo</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">4</td>
                                <td style="width:98%;">Proformas o cotizaciones</td>
                            </tr>
                            <tr>
                                <td style="width:2%; font-size:65%; font-weight:bold;" valign="top">5</td>
                                <td style="width:98%;">Informe Técnico Circunstanciado con porcentaje de responsabilidades emitido por las autoridades pertienentes en el caso de Responsabilidad Civil</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <b>Nota:</b> Dependiendo del tipo o magnitud del siniestro, la Compañía podrá solicitar cualquier otro documento o informacíon al Asegurado
                                </td>
                            </tr>
                            <tr>
                                <td style="font-style: italic; font-weight:bold; padding-top:8px; text-align:justify;" colspan="2">
                                    “Se comunica a los clientes que para la emisión de las facturas por los Contratos de Seguros de Garantías (Automotores y Multiriesgo) emitidos por Credinform International S.A., se adopta la modalidad de Facturación Electrónica, de conformidad a la Resolución RND N°. 10-0016-07 del Servicio de Impuestos Nacionales, en virtud de la cual las Notas fiscales serán emitidas a partir de los sistemas informáticos de Idepro, previa interacción con los sistemas informáticos del SIN y de Credinform International S.A., debiendo el cliente proceder al recojo de dichas Notas Fiscales en las oficinas de Idepro. Por tanto es única y total responsabilidad de los clientes recabar sus Notas Fiscales de mencionada instalación”.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table><br>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 65%; font-family: Arial;">
                <tr>
                    <td style="width:100%; text-align:left; font-weight:bold;">

                    </td>
                </tr>
            </table>
        @endif
    </div>
</div>
@endforeach