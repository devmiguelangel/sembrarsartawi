@extends('slip_cotiza')
@section('iconos')
    @if($type=='SLIP')
        <a href="javascript:void(0)" class="link-cert" rel="print" id="send-print" title="Imprimir">
            <img src="{{asset('images/icon-print-01.png')}}">
        </a>
        <a href="{{ route('slip_cotiza', ['type'=>'PDF']) }}" class="link-cert" target="_blank" title="Generar pdf">
            <img src="{{asset('images/icon-pdf-01.png')}}">
        </a>
        <a href="#" target="_blank" title="Enviar por Correo Electronico" id="send-mail" class="link-cert">
            <img src="{{asset('images/icon-mail-01.png')}}">
        </a>
        <hr/>
    @endif
@endsection
@section('content')
    <div style="width: 775px; height: auto; border: 1px solid #0081C2; padding: 10px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif;
                color: #000000; border: 1px solid #FFFF00;">
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td style="width:34%;" align="left">
                        <img src="{{ asset('images/logosartawi.jpg') }}" width="100">
                    </td>
                    <td style="width:32%;"></td>
                    <td style="width:34%;" align="right">
                        <img src="{{ asset('images/alianza.jpg') }}" height="60">
                    </td>
                </tr>
                <tr>
                    <td style="width:34%;" align="left">SLIP DE COTIZACIÓN<br/>DE-12</td>
                    <td style="width:32%;"></td>
                    <td style="width:34%;" align="right">Cotización válida hasta el: 31-11-2015</td>
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
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td colspan="2" style="width:100%; height: 20px;" align="left">
                        Datos de la solicitud de Crédito
                    </td>
                </tr>
                <tr><td colspan="2" style="width:100%;">&nbsp;</td></tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right; height: 20px;"><b>Tipo Cobertura:</b></td>
                    <td style="width:50%; text-align: left;">{{ $data['tipo_cobertura'] }}</td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right; height: 20px;">
                        <b>Monto Actual Solicitado:</b>
                    </td>
                    <td style="width:50%; text-align: left;">{{ $data['monto_solicitado'] }}</td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right; height: 20px;">
                        <b>Plazo del Presente Crédito:</b>
                    </td>
                    <td style="width:50%; text-align: left;">
                        {{ $data['plazo_credito'] }}
                    </td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right; height: 20px;"><b>Producto:</b></td>
                    <td style="width:50%; text-align: left;">{{ $data['producto'] }}</td>
                </tr>
            </table>
        </div><br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                    font-weight: bold; font-size: 80%;">Titular 1</h2>
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:25%; text-align:center; font-weight:bold;">Apellido Paterno</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Apellido Materno</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Nombres</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Apellido de Casada</td>
                </tr>
                <tr>
                    <td style="width:25%; text-align:center;">FLORES</td>
                    <td style="width:25%; text-align:center;">ROJAS</td>
                    <td style="width:25%; text-align:center;">RAUL</td>
                    <td style="width:25%; text-align:center;"></td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:25%; text-align:center; font-weight:bold;">Lugar de Nacimiento</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Pais</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Fecha de Nacimiento</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Lugar de Residencia</td>
                </tr>
                <tr>
                    <td style="width:25%; text-align:center;">LA PAZ</td>
                    <td style="width:25%; text-align:center;">BOLIVIA</td>
                    <td style="width:25%; text-align:center;">1979-10-20</td>
                    <td style="width:25%; text-align:center;"></td>
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
                    <td style="width:25%; text-align:center;">3690508</td>
                    <td style="width:25%; text-align:center;">36</td>
                    <td style="width:25%; text-align:center;">78</td>
                    <td style="width:25%; text-align:center;">168></td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td colspan="2" style="width:50%; text-align:center; font-weight:bold;">
                        Dirección del Domicilio
                    </td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Tel. Domicilio</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Tel. Oficina</td>
                </tr>
                <tr>
                    <td colspan="2" style="width:50%; text-align:center;">COMUNIDAD LIPARI</td>
                    <td style="width:25%; text-align:center;">2636054</td>
                    <td style="width:25%; text-align:center;"></td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td colspan="2" style="width:50%; text-align:center; font-weight:bold;">Ocupación</td>
                    <td colspan="2" style="width:50%; text-align:center; font-weight:bold;">Descripción</td>
                </tr>
                <tr>
                    <td colspan="2" style="width:50%; text-align:center;">Cultivo de plantas de coca</td>
                    <td colspan="2" style="width:50%; text-align:center;">CULTIVO Y PRODUCCION DE COCA</td>
                </tr>
            </table>
            <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                    font-weight: bold; font-size: 80%;">Cuestionario</h2>
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td style="width: 5%; text-align: left;">1.</td>
                    <td style="width: 90%; text-align: left;">
                        ¿Ha recibido tratamiento médico, o le han recomendado exámenes para diagnóstico,
                        o tomó medicinas recetadas o recomendadas por un médico como consecuencia de la
                        presencia o sospecha de alguna enfermedad grave?
                    </td>
                    <td style="width: 5%; text-align: right;">NO</td>
                </tr>
                <tr>
                    <td style="width: 5%; text-align: left;">2.</td>
                    <td style="width: 90%; text-align: left;">
                        ¿Tiene o ha tenido algún tipo de cáncer o problemas o enfermedades cardiacas?
                    </td>
                    <td style="width: 5%; text-align: right;">NO</td>
                </tr>
                <tr>
                    <td style="width: 5%; text-align: left;">3.</td>
                    <td style="width: 90%; text-align: left;">¿Tiene SIDA o es portador del VIH?</td>
                    <td style="width: 5%; text-align: right;">NO</td>
                </tr>
                <tr>
                    <td style="width: 5%; text-align: left;">4.</td>
                    <td style="width: 90%; text-align: left;">
                        ¿Durante los últimos cinco (5) años, ha estado en el hospital o cualquier otro
                        establecimiento médico o ha estado incapacitado para asistir al trabajo o realizar
                        las actividades normales de la vida diaria?
                    </td>
                    <td style="width: 5%; text-align: right;">NO</td>
                </tr>
                <tr>
                    <td style="width: 5%; text-align: left;">5.</td>
                    <td style="width: 90%; text-align: left;">
                        ¿Se encuentra usted actualmente en buen estado de salud?
                    </td>
                    <td style="width: 5%; text-align: right;">SI</td>
                </tr>
                <tr>
                    <td style="width: 5%; text-align: left;">6.</td>
                    <td style="width: 90%; text-align: left;">
                        ¿Sufre usted de alguna invalidez significativa?
                    </td>
                    <td style="width: 5%; text-align: right;">NO</td>
                </tr>
            </table><br>
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td style="width: 100%; border: 1px solid #3B6E22; background: #6AA74F; color:#ffffff;
                                height: 20px;">
                        Cumple con las preguntas del cuestionario
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%;">
                        <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                                font-weight: bold; font-size: 100%;">Indice de Masa Corporal</h2>
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 100%;">
                            <tr>
                                <td style="width: 30%;">
                                    Saludable
                                </td>
                                <td style="width: 30%;">
                                    <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;
                                                font-size: 100%;">
                                        <tr>
                                            <td style="width: 100%; color:#ffffff; background:#0075AA;
                                                        height: 20px;" colspan="2">
                                                Datos
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 70%; height: 20px;">
                                                Estatura
                                            </td>
                                            <td style="width: 30%;">
                                                160 cm
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 70%; height: 20px;">
                                                Peso
                                            </td>
                                            <td style="width: 30%;">
                                                70 kg
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
                    <td style="width: 100%; border: 1px solid #3B6E22; background: #6AA74F; color:#ffffff;
                                height: 20px;">
                        Cumple con la estatura y peso adecuado.
                    </td>
                </tr>
            </table>
        </div><br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; font-size: 80%;">
            Declaro haber contestado con total veracidad, m&aacute;xima buena fe a todas las preguntas del
            presente cuestionario y no haber omitido u ocultado hechos y/o circunstancias que hubieran
            podido influir en la celebracion del Contrato de Seguro. Relevo expresamente del
            secreto profesional y legal, a cualquier m&eacute;dico que me hubiese asistido y/o tratado de
            dolencias y le autorizo a revelar a RAUL FLORES ROJAS Todos los datos y antecedentes
            patol&oacute;gicos que pudiera tener o de los que hubiera adquirido conocimiento al prestarme
            sus servicios. Entiendo que de presentarse alguna eventualidad contemplada bajo la P&oacute;liza
            de Seguro como conscuencia de alguna enfermedad existente a la fecha de la firma de este
            documento o cuando haya alcanzado la edad l&iacute;mite estipulada en la P&oacute;liza,
            la Compa&ntilde;ia Aseguradora quedara liberada de toda responsabilidad en lo que respecta a mi
            Seguro. Finalmente, declaro conocer en su totalidad lo estipulado en mi P&oacute;liza de Seguro.
            <br/><br/>
            <b>CONTRATANTE: </b>FUNDACION SARTAWI<br/>
            <b>ACTIVIDAD GENERAL: </b>Varias y sin limitaciones<br/><br/>
            <b>RIESGOS CUBIERTOS:</b><br/>
            <ol style="margin: 0 0 0 20px; padding: 0; list-style-type: lower-alpha;">
                <li>
                    <b>Muerte por cualquier Causa</b>, que no est&eacute; excluida en el Condicionado
                    General de la P&oacute;liza incluido el suicidio despu&eacute;s de 2 a&ntilde;os de
                    vigencia ininterrumpida de la cobertura individual del seguro.
                </li>
                <li>
                    <b>Pago anticipado del capital asegurado en caso de invalidez total y permanente por
                        accidente o enfermedad</b>, en forma irreversible por lo menos en un 65% seg&uacute;n
                    el manual de normas autorizado por la APS,  en actual vigencia.
                </li>
                <li>
                    <b>Gastos de Sepelio</b>, son los  gastos que demanden los herederos legales o nominados
                    por el Sepelio de un Asegurado (Titular o Conyugue), como consecuencia del fallecimiento
                    por una enfermedad o un accidente cubierto para el Titular.
                </li>
            </ol><br/>
            <b>CAPITALES ASEGURADOS:</b><br/>
            <ol style="margin: 0 0 0 20px; padding: 0; list-style-type:lower-alpha;">
                <li> Saldo deudor.</li>
                <li> Saldo deudor.</li>
                <li> USD 300.00</li>
            </ol><br/>
            <b>RIESGOS EXCLUIDOS:</b> La Compa&ntilde;&iacute;a no cubre y esta eximida de toda responsabilidad
            en caso de fallecimiento del asegurado en los siguientes casos:<br/>
            <ol style="margin: 0 0 0 20px; padding: 0; list-style-type:lower-alpha;">
                <li>
                    Si el asegurado participa como conductor o acompa&ntilde;ante en competencias de
                    autom&oacute;viles, motocicletas, lanchas de motor o avionetas, practicas de
                    paraca&iacute;das.
                </li>
                <li>
                    Si el asegurado realiza operaciones o viajes submarinos o en transportes a&eacute;reos
                    no autorizados para transporte de pasajeros, vuelos no regulares.
                </li>
                <li>
                    Enfermedades pre-existentes conocidas al inicio del seguro o enfermedad cong&eacute;nita,
                    para cr&eacute;ditos mayores a USD. 5,001.00 o 35,001.00
                </li>
                <li>
                    SIDA/HIV para siniestros a partir de USD. 5,001.00 o Bs. 35,001.00
                </li>
                <li>
                    Guerra, invasi&oacute;n, revoluci&oacute;n, sublevaci&oacute;n, mot&iacute;n o hechos
                    que las leyes clasifiquen como delitos contra la seguridad del Estado, siempre y cuando
                    el asegurado no participe activamente.
                </li>
                <li>
                    Suicidio realizado por el asegurado dentro de 2 a&ntilde;os de vigencia ininterrumpida
                    de su cobertura. En consecuencia este riesgo quedara cubierto a partir del primer
                    d&iacute;a del tercer a&ntilde;o de vigencia para cada operaci&oacute;n asegurada.
                </li>
                <li>
                    Fisi&oacute;n o fusi&oacute;n nuclear
                </li>
            </ol><br/>
            <b>EDAD DE ADMISI&Oacute;N Y PERMANENCIA:</b><br/>
            <b>Para muerte:</b><br/>
            M&iacute;nima 18 a&ntilde;os<br/>
            M&aacute;xima 70 a&ntilde;os (hasta cumplir los 71 a&ntilde;os)<br/>
            <b>Permanencia:</b> 75 a&ntilde;os inclusive hasta cumplir los 76 a&ntilde;os<br/><br/>
            <b>Para invalidez:</b><br/>
            Minima 18 a&ntilde;os<br/>
            Maxima 64 a&ntilde;os (hasta cumplir 65 a&ntilde;os)<br/>
            <b>Permanencia:</b> 70 a&ntilde;os inclusive hasta cumplir los 71 a&ntilde;os<br/><br/>
            <h2 style="width: auto;	height: auto; text-align: left; margin: 7px 0; padding: 0;
                    font-weight: bold; font-size: 100%;">Tasa Mensual</h2>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 70%; font-size: 100%;"
                   align="center">
                <tr style="font-weight:bold; text-align:center; color:#FFF; background:#0075AA;">
                    <td style="width: 30%; height: 20px;">NOMBRE</td>
                    <td style="width: 30%; height: 20px;">VALOR ASEGURADO</td>
                    <td style="width: 10%; height: 20px;">TASA FINAL</td>
                </tr>
                <tr>
                    <td style="width: 30%;">RAUL FLORES ROJAS</td>
                    <td style="width: 30%;">8000 Bs.</td>
                    <td style="width: 10%;">1.5%</td>
                </tr>
            </table><br>
            <b>PRIMA:</b> De acuerdo a declaraciones mensuales del contratante, por mes vencido<br/>
            <b>FORMA DE PAGO:</b> Contado a trav&eacute;s de FUNDACION SARTAWI<br/>
            <b>BENEFICIARIO:</b> FUNDACION SARTAWI T&Iacute;TULO ONEROSO y/o El Tomador del seguro<br/><br/>
            <b>OBSERVACIONES:</b> Las primas del seguro no constituyen hecho generador de tributo seg&uacute;n
            el Art. No. 54 de la Ley de Seguros 1883 del 25 de Junio de 1998 y a la Resoluci&oacute;n
            Ministerial Nro. 880 del 28 de Junio de 1999. Autorizo a la compa&ntilde;&iacute;a mi reporte a la
            Central de Riesgos del Mercado de Seguros, acorde a las normativas reglamentarias de la Autoridad
            de Fiscalizaci&oacute;n y Control de Pensiones y Seguros.<br/><br/>
            <b>INICIO DE LA COBERTURA:</b> La cobertura de esta P&oacute;liza para cada Asegurado aceptado,
            comenzar&aacute; a partir del momento del desembolso de su cr&eacute;dito por parte de
            <b>FUNDACI&Oacute;N SARTAWI</b>, previo cumplimiento de lo establecido en los "Requisitos de
            Asegurabilidad".<br/><br/>
            <b>AVISO DE SINIESTRO:</b> En caso de fallecimiento o invalidez total y permanente del Asegurado,
            el tomador, tan pronto y a m&aacute;s tardar dentro de los 90 d&iacute;as calendario siguientes
            de tener conocimiento del siniestro, debe comunicar el mismo a la Compa&ntilde;&iacute;a,
            salvo fuerza mayor o impedimento justificado, caso contrario la Compa&ntilde;&iacute;a se libera
            de cualquier responsabilidad indemnizatoria por extemporaneidad.<br/><br/>
            <b>PLAZO PARA PAGO DE SINIESTRO:</b> El plazo para el pago de siniestros por sepelio ser&aacute;
            realizado dentro de 2 d&iacute;as h&aacute;biles de recibidos todos los documentos requeridos por
            la compa&ntilde;&iacute;a.
            para el pago de siniestros por las dem&aacute;s coberturas ser&aacute; dentro de los 10
            d&iacute;as de presentados todos los documentos.<br/><br/>
            <b>PARA SINIESTROS HASTA USD 5.000:</b>
            <ol style="margin: 0 0 0 20px; padding: 0; list-style-type:lower-alpha;
                        list-style-type:lower-alpha;">
                <li> Original de la Declaraci&oacute;n Jurada de Salud.</li>
                <li>
                    Certificado de Defunci&oacute;n, (para el &aacute;rea rural podr&aacute; presentar un
                    certificado de cualquier autoridad local del pueblo o localidad, dandofe del fallecimiento
                    del asegurado y la certificaci&oacute;n del jefe de agencia).
                </li>
                <li>
                    Fotocopia de C.I. y/o fotocopia de Certificado de Nacimiento y/o Carnet de Identidad
                    RUN y/o libreta de servicio militar.
                </li>
                <li>
                    Estado de cuenta saldo deudor.
                </li>
                <li>
                    <b>Para el caso de Invalidez:</b> Certificado INSO (Instituto Nacional de Salud Ocupacional)
                    o en su defecto de otra instituci&oacute;n que est&eacute; debidamente autorizada por la
                    Autoridad Competente, la cual determine el grado de invalidez.
                </li>
            </ol><br/>
            <b>PARA SINIESTROS DE USD 5.001 EN ADELANTE:</b>
            <ol style="margin: 0 0 0 20px; padding: 0; list-style-type:lower-alpha;">
                <li>Original de la Declaraci&oacute;n Jurada de Salud</li>
                <li>
                    Certificado de Defunci&oacute;n, (para el &aacute;rea rural podr&aacute; presentar
                    un certificado de cualquier autoridad local del pueblo o localidad, dando fe del
                    fallecimiento del asegurado y la certificaci&oacute;n del jefe de agencia).
                </li>
                <li>
                    Fotocopia de C.I. y/o fotocopia de Certificado de Nacimiento y/o Carnet de Identidad
                    RUN y/o libreta de servicio militar.
                </li>
                <li>Estado de cuenta saldo deudor.</li>
                <li>Historia Clinica si existiera.</li>
                <li>
                    <b>Para el caso de Invalidez:</b> Certificado INSO (Instituto Nacional de
                    Salud Ocupacional) o en su defecto de otra instituci&oacute;n que est&eacute;
                    debidamente autorizada por la Autoridad Competente, la cual determine el
                    grado de invalidez.
                </li>
            </ol><br/>
            <b>SEPELIO:</b>
            <ol style="margin: 0 0 0 20px; padding: 0; list-style-type:lower-alpha;">
                <li>
                    Fotocopia del Carnet de Identidad del Asegurado, y/o Fotocopia de Certificado
                    de nacimiento y/o Carnet de identidad RUN y/o libreta del servicio militar.
                </li>
                <li>
                    Fotocopia de carnet de identidad del Beneficiario y/o Fotocopia de Certificado
                    de nacimiento y/o Carnet de identidad RUN y/o libreta de servicio militar.
                </li>
                <li>
                    Certificado de Defunci&oacute;n, (para el &aacute;rea rural podr&aacute; presentar
                    un certificado de cualquier autoridad local del pueblo o localidad, dandofe del
                    fallecimiento del asegurado y la certificaci&oacute;n del jefe de agencia).
                </li>
                <li>
                    Declaratoria de Beneficiarios o declaratoria de herederos en caso de no existir
                    la nominacion de los mismos.
                </li>
                <li>Carta de los beneficiarios solicitando el beneficio.</li>
            </ol><br/>
            Todo lo que no est&eacute; previsto por el Certificado de Cobertura Individual, se sujetar&aacute;
            a lo establecido en las Condiciones Particulares, Condiciones Generales y dem&aacute;s documentos
            Anexos a la presente P&oacute;liza de Seguro de Desgravamen Hipotecario en Grupo, el C&oacute;digo
            de Comercio, la Ley de Seguros y por las disposiciones legales vigentes en la materia.<br/><br><br>
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 60%; height: auto; font-size: 80%; font-family: Arial;">
                <tr>
                    <td style="width:30%;" align="center">RAUL FLORES ROJAS</td>
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
@endsection