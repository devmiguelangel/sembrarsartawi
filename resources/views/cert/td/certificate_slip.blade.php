<div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 5px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            @var $fecha_registro = $query_header->created_at
            @var $num_limit = $query_parameter->expiration
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 70%; font-family: Arial;">
                <tr style="padding-bottom: 5px;">
                    <td style="width:34%; text-align: left;">
                        <img src="{{ asset($query->img_retailer) }}" width="100">
                    </td>
                    <td style="width:32%;"></td>
                    <td style="width:34%; text-align:right;">
                        <img src="{{ asset($query->img_company) }}" height="60">
                    </td>
                </tr>
                <tr>
                    <td style="width:34%; text-align: left;">
                        SLIP DE COTIZACIÓN<br/>Cotizacion No {{$query_header->quote_number}}
                    </td>
                    <td style="width:32%;"></td>
                    <td style="width:34%; text-align:right;">
                        Cotización válida hasta el: {{date("d-m-Y", strtotime("$fecha_registro +$num_limit day"))}}
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 770px; border: 0px solid #ffff00; text-align:center;">
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 70%; font-family: Arial;">
                <tr>
                    <td colspan="3"
                        style="width:100%; height: 20px; padding-bottom: 5px; text-align: left; font-weight: bold;">
                        Datos del Titular
                    </td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:25%; text-align:center; font-weight:bold;">Apellido Paterno</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Apellido Materno</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Nombres</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Apellido de Casada</td>
                </tr>
                <tr>
                    <td style="width:25%; text-align:center;">{{$query_client->last_name}}</td>
                    <td style="width:25%; text-align:center;">{{$query_client->mother_last_name}}</td>
                    <td style="width:25%; text-align:center;">{{$query_client->first_name}}</td>
                    <td style="width:25%; text-align:center;">
                        @if($query_client->civil_status=='S')
                            {{$query_client->married_name}}
                        @endif
                    </td>
                </tr>
                @if($query_client->avenue_street!=null)
                    @var $parameter_avst = config('base.avenue_street')
                    @var $avenue_street = $parameter_avst[$query_client->avenue_street]
                @else
                    @var $avenue_street=''
                @endif
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:25%; text-align:center; font-weight:bold;">Calle o Avenida</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Dirección</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Numero</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Ciudad o Localidad</td>
                </tr>
                <tr>
                    <td style="width:25%; text-align:center;">{{$avenue_street}}</td>
                    <td style="width:25%; text-align:center;">{{$query_client->home_address}}</td>
                    <td style="width:25%; text-align:center;">{{$query_client->home_number}}</td>
                    <td style="width:25%; text-align:center;">{{$query_client->locality}}</td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:25%; text-align:center; font-weight:bold;">Telefono Domicilio</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Telefono Oficina</td>
                    <td style="width:50%; text-align:center; font-weight:bold;" colspan="2">Telefono Celular</td>
                </tr>
                <tr>
                    <td style="width:25%; text-align:center;">{{$query_client->phone_number_home}}</td>
                    <td style="width:25%; text-align:center;">{{$query_client->phone_number_office}}</td>
                    <td style="width:50%; text-align:center;" colspan="2">{{$query_client->phone_number_mobile}}</td>
                </tr>
                <tr style="font-weight:bold; background:#0075AA; color:#FFF;">
                    <td style="width:25%; text-align:center; font-weight:bold;">Dirección Laboral</td>
                    <td style="width:25%; text-align:center; font-weight:bold;">Descripcion Ocupación</td>
                    <td style="width:50%; text-align:center; font-weight:bold;" colspan="2">Ocupación</td>
                </tr>
                <tr>
                    <td style="width:25%; text-align:center;">{{$query_client->business_address}}</td>
                    <td style="width:25%; text-align:center;">{{$query_client->occupation_description}}</td>
                    <td style="width:50%; text-align:center;" colspan="2">{{$query_client->occupation}}</td>
                </tr>
            </table>
        </div>
        <br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0; font-weight: bold; font-size: 70%;">
                Interés Asegurado - Ubicación del Riesgo
            </h2>
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 67%; font-family: Arial; padding-bottom: 5px;">
                <tr style="background:#E5E5E5;">
                    <td style="width:35%; text-align: left;"><b>Materia Asegurada</b></td>
                    <td style="width:10%; text-align: left;"><b>Departamento</b></td>
                    <td style="width:16%; text-align: center;"><b>Zona</b></td>
                    <td style="width:15%; text-align: center;"><b>Localidad</b></td>
                    <td style="width:14%; text-align: right;"><b>Valor Asegurado ({{$query_header->currency}})</b></td>
                    <td style="width:10%; text-align: right;"><b>Prima</b></td>
                </tr>
                @var $i=1
                @var $vat=0
                @var $pt=0
                @foreach($query_riesgo as $data_riesgo)
                    <tr>
                        <td style="width:35%; text-align: left;">INMUEBLE {{$i}}
                            : {{$data_riesgo->matter_description}}</td>
                        <td style="width:10%; text-align: left;">{{$data_riesgo->city}}</td>
                        <td style="width:16%; text-align: left;">{{$data_riesgo->zone}}</td>
                        <td style="width:15%; text-align: left;">{{$data_riesgo->locality}}</td>
                        <td style="width:14%; text-align: right;">{{number_format($data_riesgo->insured_value,2,".",",")}}</td>
                        <td style="width:10%; text-align: right;">{{$data_riesgo->premium}}</td>
                    </tr>
                    @var $i=$i+1
                    @var $vat = $vat+$data_riesgo->insured_value
                    @var $pt = $pt+$data_riesgo->premium
                @endforeach
                <tr>
                    <td style="width:35%; text-align:right;"></td>
                    <td style="width:10%; text-align: left;"></td>
                    <td style="width:18%; text-align: left;"></td>
                    <td style="width:15%; text-align: right; background:#E5E5E5; font-weight: bold;">Total</td>
                    <td style="width:14%; text-align: right; background:#E5E5E5;">{{number_format($vat,2,".",",")}}</td>
                    <td style="width:10%; text-align: right; background:#E5E5E5;">{{number_format($pt,2,".",",")}}</td>
                </tr>
            </table>
            <!--CASO FACULTATIVO-->
            @var $j=1
            @foreach($query_riesgo as $data_fac)

                @if($query_header->currency=='USD')
                    @var $insured_value = $data_fac->insured_value
                @elseif($query_header->currency=='BS')
                    @var $insured_value = (int)$data_fac->insured_value/$query_change_rate->bs_value
                @endif

                @if($insured_value > $query_parameter->amount_min && $data_fac->use=='IP')
                    <div style="font-size:70%; text-align:left; margin-top:5px; margin-bottom:0px; border:1px solid #C68A8A; background:#FFEBEA; padding:8px; width: 98%; padding-bottom: 5px;">
                        El valor del inmueble {{$j}} supera el límite permitido, el valor de la prima es referencial,
                        por tanto se requiere la aprobación de la compañía.<br>
                    </div>
                @endif
                @var $j=$j+1
            @endforeach

            @if($query_header->currency=='BS')
                @var $vat = (int)$vat/$query_change_rate->bs_value
            @endif

            @if($vat>$query_parameter->amount_max)
                <div style="font-size:70%; text-align:left; margin-top:5px; margin-bottom:0px; border:1px solid #C68A8A; background:#FFEBEA; padding:8px; width: 98%; padding-bottom: 5px;">
                    La suma total de los valores asegurados supera el límite permitido, por tanto se requiere la
                    aprobación de la compañía.<br>
                </div>
            @endif

        </div>
        <br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:center;">
            <h2 style="width: auto;	height: auto; text-align: left; margin: 5px 0; padding: 0; font-weight: bold; font-size: 70%;">
                Datos de la solicitud
            </h2>
            @var $parameter_term = config('base.term_types')
            @var $type_term = $parameter_term[$query_header->type_term]
            <table cellpadding="0" cellspacing="0" border="0"
                   style="width: 100%; height: auto; font-size: 70%; font-family: Arial;">
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Compañía de Seguros:</b></td>
                    <td style="width:50%; text-align: left;">{{$query->company}}</td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right;"><b>Seguro a contratar:</b></td>
                    <td style="width:50%; text-align: left;">{{$query->name_product}}</td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Periodo de contratacion:</b></td>
                    <td style="width:50%; text-align: left;">{{$query_header->term}} {{$type_term}}</td>
                </tr>
                <tr style="background:#D5D5D5;">
                    <td style="width:50%; text-align:right;"><b>Inicio de vigencia:</b></td>
                    <td style="width:50%; text-align: left;">{{date('d-m-Y',strtotime($query_header->validity_start))}}</td>
                </tr>
                <tr style="background:#E5E5E5;">
                    <td style="width:50%; text-align:right;"><b>Fin de vigencia:</b></td>
                    <td style="width:50%; text-align: left;">{{date('d-m-Y',strtotime($query_header->validity_end))}}</td>
                </tr>
            </table>
        </div>
        <br>

        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <b>MATERIA DEL SEGURO</b><br>
                        <b>INMUEBLES:</b> PROPIEDADES SIN PROHIBICIÓN NI EXCLUSIÓN NI RESTRICCIÓN DE GIRO DE NEGOCIO Y/O
                        ACTIVIDADES Y/O TIPO DE RIESGO
                        EN LOS QUE SE DESARROLLEN LAS ACTIVIDADES DE LOS CLIENTES, EXCEPTO LAS EXCLUIDAS EXPRESAMENTE EN
                        ÉSTA PÓLIZA.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%; border:0px solid #FFFF00;">EN CASO DE BIENES INMUEBLES:<br>
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%;" valign="top">-</td>
                                <td style="width:98%;">
                                    INCLUYENDO EN TODOS LOS CASOS,OBRAS CIVILES Y SUS INSTALACIONES, INCLUYENDO
                                    LUMINARIAS,
                                    ALFOMBRADO (SIEMPRE Y CUANDO ESTÉN INCLUIDAS EN EL AVALÚO TÉCNICO), REVESTIMIENTOS;
                                    VIDRIOS,
                                    ACCESORIOS SANITARIOS, MUROS PERIMETRALES, TANQUES; ESTACIONAMIENTOS, ÁREAS DE
                                    DEPÓSITO Y LA PARTE
                                    PROPORCIONAL DE ÁREAS COMUNES, CUANDO CORRESPONDA.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">-</td>
                                <td style="width:98%;">
                                    INCLUYENDO INMUEBLES DOMICILIARIOS, COMERCIALES O INMUEBLES INDUSTRIALES. Se aclara
                                    que el valor
                                    asegurado máximo para riesgos industriales es de hasta USD 200.000 por bien
                                    declarado.
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="justify">
                        <b>MAQUINARIA Y MAQUINARIA PESADA MÓVIL:</b> (GRÚAS, PALAS MECÁNICAS, EXCAVADORAS, CAMIONES
                        CONCRETEROS,
                        MOTONIVELADORAS, TRACTORES, Y OTROS SIMILARES), INCLUYENDO SUS EQUIPOS AUXILIARES QUE SE
                        ENCUENTREN DECLARADOS
                        DENTRO DE LA MATERIA ASEGURADA, YA SEA QUE ESTÉN CONECTADOS O NO AL EQUIPO O MAQUINARIA OBJETO
                        DEL SEGURO O QUE
                        SE ENCUENTREN OPERANDO O DURANTE SU TRAYECTO POR SUS PROPIOS MEDIOS O NO DENTRO O FUERA DE LOS
                        PREDIOS.
                    </td>
                </tr>
            </table>
            <br>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td style="width: 100%; text-align: justify;">
                        <b>UBICACION DEL RIESGO:</b> A NIVEL NACIONAL<br><br>
                        <b>COBERTURAS:</b><br><b>SECCION I TODO RIESGO DE DAÑOS A LA PROPIEDAD</b><br>
                        TODO RIESGO DE DAÑOS A LA PROPIEDAD, INCLUYENDO TERREMOTO, TEMBLOR Y/O MOVIMIENTOS SÍSMICOS AL
                        IGUAL QUE EL INCENDIO RESULTANTE DE ESTOS, DESLIZAMIENTOS, ASENTAMIENTOS NO GRADUALES,
                        HUNDIMIENTO, CORRIMIENTOS DE TIERRA, CAÍDA DE ROCAS Y OTROS RIESGOS DE LA NATURALEZA CUALQUIERA
                        SEA SU CAUSA; TERRORISMO Y RIESGOS POLÍTICOS Y SOCIALES INCLUYENDO HUELGAS, MOTINES, CONMOCIÓN
                        CIVIL, DAÑO MALICIOSO, VANDALISMO, SABOTAJE, ASONADA, DISTURBIOS DE ACUERDO TEXTO DE
                        CLÁUSULA.<br><br>
                        <b>SECCIÓN II: TODO RIESGO DE EQUIPO ELECTRONICO</b>
                    </td>
                </tr>
                <tr>
                    <td style="width:100%;" align="left">TODO RIESGO DE EQUIPO ELECTRÓNICO, INCLUYENDO COMPONENTES
                        ELECTROMECÁNICOS; EQUIPOS MÓVILES Y/O PORTÁTILES, SUS ACCESORIOS E INSTALACIONES, EQUIPOS
                        PERIFERICOS, INCLUYENDO:
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%;" valign="top">&raquo;</td>
                                <td style="width:98%;">ROBO CON VIOLENCIA, ATRACO .</td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">&raquo;</td>
                                <td style="width:98%;">DAÑOS EMERGENTES A LA ENERGÍA ELÉCTRICA INCLUYENDO CORTES DE
                                    ELECTRICIDAD.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">&raquo;</td>
                                <td style="width:98%;">INCENDIO, RAYO, EXPLOSIÓN DE CUALQUIER TIPO, INCLUYENDO LOS DAÑOS
                                    CAUSADOS POR EXTINCIÓN DE INCENDIO Y OPERACIONES DE SALVAMENTO.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">&raquo;</td>
                                <td style="width:98%;">QUEMADURAS SUPERFICIALES Y CARBONIZACIÓN, HUMO, HOLLÍN</td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">&raquo;</td>
                                <td style="width:98%;">Daños DE LA NATURALEZA COMO TEMPESTAD, INUNDACIÓN, GRANIZO,
                                    CUBIERTOS POR LA SECCIÓN I DEL PRESENTE SEGURO.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">&raquo;</td>
                                <td style="width:98%;">DAÑOS POR AGUA, GRIFERIA Y TANQUES CUBIERTA POR LA SECCIÓN I DEL
                                    PRESENTE SEGURO. EXCLUYE HUMEDAD Y CORROSIÓN POR TRATARSE DE DAÑOS GRADUALES.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">&raquo;</td>
                                <td style="width:98%;">EQUIPOS MÓVILES Y/O PORTÁTILES, HASTA $US. 10.000.</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td colspan="2" style="text-align: justify;">
                        <b>SECCIÓN III: TODO RIESGO Y/O DAÑO FISICO POR ROTURA DE MAQUINARIA</b><br>
                        TODO RIESGO Y/O DAÑO FÍSICO POR ROTURA DE MAQUINARIA, DAÑOS EMERGENTES A LA ENERGÍA ELÉCTRICA,
                        DAÑOS FÍSICOS A LA MAQUINARIA, SUS INSTALACIONES Y EQUIPOS AUXILIARES DE PROTECCIÓN, CONTROL Y
                        SUMINISTRO
                        DE SERVICIOS (AIRE, AGUA, VAPOR, ENERGÍA ELÉCTRICA, GAS NATURAL), INCLUYENDO:
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ROBO CON VIOLENCIA .</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">MAL MANEJO, NEGLIGENCIA, IMPERICIA, IGNORANCIA, ACTOS MAL INTENCIONADOS, POR
                        PARTE DE LOS EMPLEADOS Y/O DE TERCEROS
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ERRORES, DEFECTOS Y DESPERFECTOS DE CONSTRUCCIÓN Y DE USO DE MATERIALES
                        DEFECTUOSOS
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DEFECTOS Y DESPERFECTOS Y/O ERRORES EN DISEÑO, CALCULO Y MONTAJE Y/O MANO DE
                        OBRA DEFECTUOSA.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ROTURA POR FUERZAS CENTRIFUGAS</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">FALTA DE AGUA EN CALDEROS O RECIPIENTES BAJO PRESIÓN (CALENTAMIENTO
                        EXCESIVO)
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">INCIDENTES DURANTE EL TRABAJO, COMO MALOS AJUSTES, AFLOJAMIENTO DE PARTES Y
                        PIEZAS
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">FALLAS Y/O DESPERFECTOS EN MEDIDAS DE PREVENCIÓN Y SEGURIDAD</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">INDUCCIÓN, CUALQUIERA SEA SU ORIGEN</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CUERPOS EXTRAÑOS QUE SE INTRODUZCAN EN LOS BIENES ASEGURADOS O LOS GOLPEEN
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DAÑOS POR LA ACCIÓN DIRECTA O INDIRECTA DE LA ENERGÍA ELÉCTRICA U ATMOSFÉRICA
                        Y CAÍDA DIRECTA DE RAYO.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">INCENDIO INTERNO E IMPLOSIÓN, INCLUYE EXPLOSIÓN QUÍMICA INTERNA.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">EXPLOSIÓN EN MOTORES DE COMBUSTIÓN INTERNA.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULAS DE RIADAS, LODOS Y/O ANEGACION</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">BOMBAS SUMERGIDAS Y BOMBAS PARA POZOS PROFUNDOS.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">EL SEGURO SE EXTIENDE A CUBRIR LOS COMPONENTES ELECTRÓNICOS QUE FORMEN PARTE
                        DE LA MAQUINARIA.
                    </td>
                </tr>
            </table>
            <br>
            <div style="font-size: 70%;">
                <b>SECCIÓN IV:TODO RIESGO DE EQUIPO MOVIL</b><br>
                TODO RIESGO DE EQUIPO MÓVIL INCLUYENDO COMPONENTES ELECTRÓNICOS, RAYO Y EXPLOSIÓN, TERRORISMO,
                HUELGAS, MOTINES, CONMOCIÓN CIVIL, DAÑO MALICIOSO, VANDALISMO, SABOTAJE, SAQUEO Y/O TUMULTOS POPULARES,
                Y:
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ACCIDENTES QUE SURJAN DURANTE EL MONTAJE Y/O DESMONTAJE A CONSECUENCIA DE SU
                        MANTENIMIENTO PARA FINES DE LIMPIEZA Y REACONDICIONAMIENTO Y TRASLADOS DENTRO DE LOS PREDIOS DEL
                        ASEGURADO Y/O MIENTRAS VIAJEN POR SUS PROPIOS MEDIOS O SEAN TRANSPORTADOS DE UN SITIO DE
                        OPERACIÓN A OTRO, INCLUYENDO DAÑOS POR VUELCOS, CHOQUE, EMBARRANCAMIENTO Y/O INCENDIO DEL MEDIO
                        TRANSPORTADOR L.A.P.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Colisión con objetos en movimiento o estacionarios</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ROBO CON VIOLENCIA Y/O ASALTO, ASÍ COMO TAMBIÉN LOS DAÑOS CAUSADOS POR DICHO
                        DELITO O SU INTENTO (Excluye Hurto y/o ratería)
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">RIESGOS POLÍTICOS Y SOCIALES</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ROTURA DE VIDRIOS.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">GASTOS EXTRAORDINARIOS HASTA EL 20% DE LA SUMA ASEGURADA.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">COLISIÓN CON OBJETOS EN MOVIMIENTO O ESTACIONARIOS, VOLCAMIENTOS, HUNDIMIENTO
                        DE TERRENO, DESLIZAMIENTO DE TIERRA, DESCARRILAMIENTO.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ACCIDENTES QUE OCURRAN PESE A UN MANEJO CORRECTO, ASÍ COMO LOS QUE
                        SOBREVENGAN POR DESCUIDO, IMPERICIA O NEGLIGENCIA DEL CONDUCTOR (SALVO ACTOS INTENCIONALES O
                        NEGLIGENCIA MANIFIESTA DEL ASEGURADO O SUS REPRESENTANTES).
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">PÉRDIDAS O DAÑOS CAUSADOS POR INUNDACIÓN, CICLÓN, HURACÁN TEMPESTAD, VIENTOS,
                        TERREMOTO, TEMBLOR, ERUPCIÓN VOLCÁNICA.
                    </td>
                </tr>
            </table>
            <br>

            <div style="font-size: 70%;">
                <b>VALORES ASEGURADOS:</b><br>
                <b>PARA BIENES INMUEBLES:</b><br>
                VALOR DE REPOSICIÓN A NUEVO DEL INMUEBLE (VALOR DE LA CONSTRUCCIÓN), SEGÚN EL AVALÚO TÉCNICO (EN PODER
                DEL
                CONTRATANTE / BENEFICIARIO) (NO SE CONSIDERARÁ EL VALOR DEL TERRENO)<br><br>

                <b>PARA BIENES MUEBLES:</b><br>
                VALOR DE REPOSICIÓN A NUEVO DE ACUERDO A FACTURA COMERCIAL Y/O AVALÚO Y/O DOCUMENTO EQUIVALENTE.<br><br>

                <b>PARA EQUIPOS ELECTRÓNICOS:</b><br>
                VALOR DE REPOSICIÓN A NUEVO (INCLUYENDO TODO EL COSTO HASTA SU PUESTA EN MARCHA), DE ACUERDO A FACTURA
                COMERCIAL Y/O AVALÚO Y/O DOCUMENTO EQUIVALENTE.<br><br>

                <b>PARA ROTURA DE MAQUINARIA Y EQUIPO MÓVIL:</b><br>
                VALOR DE REPOSICIÓN A NUEVO, (INCLUYENDO TODO EL COSTO HASTA SU PUESTA EN MARCHA), DE ACUERDO A FACTURA
                COMERCIAL Y/O AVALÚO Y/O DOCUMENTO EQUIVALENTE.<br><br>
            </div>
        </div>
        <div style="font-size: 70%;">
            <b>PARA BIENES CON ANTIGÜEDAD DE MÁS DE 5 AÑOS O BIENES REACONDICIONADOS:</b><br>
            EL VALOR DE REPOSICIÓN A NUEVO O SU VALOR DE ADQUISICIÓN, SIEMPRE Y CUANDO ESTE VALOR DE ADQUISICIÓN SEA POR
            LO MENOS EQUIVALENTE A UN 80% DEL VALOR DE REPOSICIÓN A NUEVO.<br><br>

            <b>CLÁUSULAS ADICIONALES:</b><br>
        </div>
        <div style="width: 770px; border: 0px solid #ffff00; text-align:justify;">

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA PARA COLAPSO DE PAREDES</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA PARA COLAPSO DE TECHOS</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE VALOR DE REEMPLAZO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE ELEGIBILIDAD DE AJUSTADORES</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE REHABILITACIÓN AUTOMÁTICA DE LA SUMA ASEGURADA</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE FLETE AÉREO HASTA EL 5% DEL VALOR DEL RECLAMO MÁXIMO $US.
                        5.000.-
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE RESCISIÓN DEL CONTRATO A PRORRATA SUJETO A NO SINIESTRALIDAD
                        DURANTE LA VIGENCIA
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA PARA CUBRIR PÉRDIDA O DAÑOS OCASIONADOS DIRECTAMENTE POR INCENDIO
                        Y/O RAYO EN INSTALACIONES O APARATOS ELÉCTRICOS
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE TERREMOTO, TEMBLOR Y ERUPCIONES VOLCÁNICAS</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE RIESGOS POLÍTICOS Y TERRORISMO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE ROBO CON VIOLENCIA A PRIMER RIESGO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE DERRUMBE Y DESLIZAMIENTO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE HUNDIMIENTO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE GASTOS DE INVESTIGACIÓN Y SALVAMENTO HASTA EL 5% DEL VALOR DEL
                        RECLAMO CON UNA MÁXIMO A $US. 10.000.-
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE DEFINICIÓN DE EVENTO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE ERRORES Y OMISIONES</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE HONORARIOS DE ARQUITECTOS, INGENIEROS Y TOPOGRAFOS.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE REMOCIÓN DE ESCOMBROS</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE SUBROGACIÓN</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">ANEXO DE RENOVACIÓN AUTOMÁTICA, HASTA FINALIZAR EL CRÉDITO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">GASTOS DE INVESTIGACIÓN Y SALVAMENTO, HASTA EL 5% DEL VALOR DEL RECLAMO CON
                        UN MÁXIMO DE USD 10.000.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE GASTOS EXTRAORDINARIOS, HASTA EL 20% DEL VALOR DEL RECLAMO, MÁXIMO $US
                        100.000.-
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DAÑOS OCASIONADOS POR SALVAMENTO Y LA EXTINCIÓN DE INCENDIOS, HASTA EL 5% DEL
                        VALOR DEL RECLAMO, MÁXIMO $US. 10.000.-
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE FLETE AÉREO, HASTA EL 5% DEL VALOR DEL RECLAMO, MÁXIMO $US 5.000.-</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE AMPLIACIÓN DE AVISO DE SINIESTRO HASTA 15 DÍAS A PARTIR DE QUE EL
                        CONTRATANTE TIENE CONOCIMIENTO DEL EVENTO. QUEDA ESTABLECIDO QUE CUALQUIER REPARACIÓN, ARREGLO O
                        ADQUISICIÓN QUE EL ASEGURADO DEBA REALIZAR PARA LA REPOSICIÓN O REPARACIÓN DEL BIEN DAÑADO, DEBE
                        CONTAR CON LA AUTORIZACIÓN EXPRESA DE LA COMPAÑÍA.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE ADELANTO DEL 50% EN CASO DE SINIESTRO UNA VEZ DECLARADO PROCEDENTE EL
                        RECLAMO Y HABIÉNDOSE ESTABLECIDO EL MONTO APROXIMADO DE LA PÉRDIDA.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE TRASLADO TEMPORAL, INCLUYENDO USO, MANTENIMIENTO, REPARACIÓN Y DAÑOS
                        DURANTE SU TRANSPORTE (BAJO CLÁUSULA L.A.P.)
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE INCLUSIONES Y EXCLUSIONES.</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE TRASLADO TEMPORAL, INCLUYENDO USO, MANTENIMIENTO, REPARACIÓN Y DAÑOS
                        DURANTE SU TRANSPORTE (BAJO CLÁUSULA L.A.P.)
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">AMPLIACIÓN DE VIGENCIA A PRORRATA, BAJO LOS MISMOS TÉRMINOS Y CONDICIONES
                        INCLUYENDO TASAS PACTADAS, HASTA 90 DÍAS.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">CLÁUSULA DE HUNDIMIENTO, SIEMPRE Y CUANDO NO SEA GRADUAL</td>
                </tr>
            </table>
            <br>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td colspan="2" style="text-align: left;">
                        <b>APLICABLES A LA SECCIÓN IV (EQUIPO MÓVIL)</b><br>
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">COBERTURA PARA EL TRÁNSITO POR SUS PROPIOS MEDIOS, SIEMPRE Y CUANDO EL EQUIPO
                        MÓVIL SE TRASLADE DE UN PROYECTO A OTRO, O A SU GARAJE.
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DE REHABILITACIÓN AUTOMÁTICA DE LA SUMA ASEGURADA.</td>
                </tr>
            </table>
            <br>

            <div style="font-size: 70%;">
                <b>DEDUCIBLES:</b><br>

                <b>SECCIÓN I:POR EVENTO Y/O RECLAMO</b><br>
            </div>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">RIESGOS POLÍTICOS Y TERRORISMO: 1% DEL VALOR ASEGURADO POR UBICACIÓN, CON UN
                        MÍNIMO DE US$ 100.-
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">TERREMOTO, TEMBLOR Y MOVIMIENTOS SÍSMICOS: 1% DEL VALOR ASEGURADO POR
                        UBICACIÓN, CON UN MÍNIMO DE US$ 100.-
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">PARA ROBO CON VIOLENCIA AL CONTENIDO: US$100.- (APLICABLE ÚNICAMENTE A
                        RIESGOS DOMICILIARIOS); para otros riesgos: US$ 250 por toda y cada pérdida
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">PARA LAS DEMÁS COBERTURAS US$ 50.-</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">PARA LAS COBERTURAS DE ASENTAMIENTO, HUNDIMIENTO, DESLIZAMIENTO, CORRIMIENTO
                        DE TIERRAS, 5% DEL VALOR DEL RECLAMO CON UN MÍNIMO DE US$ 500.- POR TODA Y CADA PÉRDIDA
                    </td>
                </tr>
            </table>
            <br>

            <div style="font-size: 70%;">
                <b>SECCIONES II Y III: POR EVENTO Y/O RECLAMO</b><br>
            </div>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">EQUIPO MEDICO: DE ACUERDO A LA SIGUIENTE TABLA DE VALORES:
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%;">&rsaquo;</td>
                                <td style="width:98%;">PARA EQUIPOS CON UN VALOR ASEGURADO MAYOR A US$ 50.000.- 2% DEL
                                    VALOR DEL SINIESTRO.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;">&rsaquo;</td>
                                <td style="width:98%;">DEMÁS EQUIPOS 2% DEL VALOR DEL SINIESTRO MÍNIMO US$ 250.-</td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">EQUIPO DE TELECOMUNICACIONES: 2% DEL VALOR DEL SINIESTRO MÍNIMO US$. 250.-,
                        EQUIPOS MOVILES
                    </td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DEMÁS AMPARADOS: 1% DEL VALOR DEL RECLAMO CON UN MÍNIMO DE US$. 200.- POR
                        EVENTO Y/O RECLAMO
                    </td>
                </tr>
            </table>
            <br>
            <div style="font-size: 70%;">
                <b>SECCIÓN IV: POR EVENTO Y/O RECLAMO</b><br>
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">PARA LA COBERTURA DE VIDRIOS US$. 20.- POR EVENTO Y/O RECLAMO</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">DEMÁS COBERTURAS:
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width:2%;" valign="top">-</td>
                                <td style="width:98%;">PARA EQUIPOS CON VALORES ASEGURADOS HASTA US$ 50.000, 2% DEL
                                    VALOR DEL SINIESTRO.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">-</td>
                                <td style="width:98%;">PARA EQUIPOS CON VALORES ASEGURADOS HASTA US$ 250.000, 1.5% DEL
                                    VALOR DEL SINIESTRO.
                                </td>
                            </tr>
                            <tr>
                                <td style="width:2%;" valign="top">-</td>
                                <td style="width:98%;">PARA EQUIPOS CON VALORES ASEGURADOS MAYORES A US$ 250.000, 1% DEL
                                    VALOR DEL SINIESTRO
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div style="font-size: 70%; text-align: justify;">
                LOS DEDUCIBLES ESTÁN SUJETOS A LA COBERTURA CONTRATADA<br><br>

                <b>ACEPTACIONES ESPECIALES:</b><br>
                Los siguientes riesgos, deben ser consultados a la Compañía previo a la emisión de la Póliza:
            </div>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size:70%;">
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Riesgos textiles incluyendo riesgos azucareros y algodoneros</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Riesgos mineros</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Fábricas de plástico, plastoformo, polietileno, papel, cartón, algodón</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Discotecas, Pubs y Karaokes</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Ferias, exposición y eventos</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">&bull;</td>
                    <td style="width:98%;">Industrias químicas y/o todas aquellas donde los insumos sean sustancias
                        inflamables y/o pinturas
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div style="width: 770px; border:0px solid #FFFF00; text-align: justify; font-size: 70%;">
            <b>Exclusiones</b><br>
            De acuerdo a lo estipulado en el Condicionado General y demás secciones de la Póliza<br>
            SECCION I:<br>
            -Dinero, joyas y/o valores<br>
            -Bienes inmuebles que estén ubicados en el lecho o cercanía de rios<br>
            SECCIÓN II:
            -SATÉLITES ESPACIALES<br>
            -SOFTWARE Y LICENCIAS<br>
            -DAÑOS POR VIRUS<br>
            -DAÑOS MECÁNICOS Y ELÉCTRICOS INTERNOS<br>
            -DEMÁS EXCLUSIONES DE ACUERDO AL CONDICIONADO GENERAL DE LA PÓLIZA.<br>
            SECCIÓN III:<br>
            -DE ACUERDO AL CONDICIONADO GENERAL DE LA PÓLIZA.<br>
            SECCIÓN IV:<br>
            -EQUIPOS QUE OPEREN BAJO TIERRA<br>
            -EQUIPOS QUE TENGAN PLACAS DE CIRCULACIÓN<br>
            -RIESGOS DE PERFORACIÓN; RIESGOS PETROLEROS Y RIESGOS DE GAS<br>
            -DEMÁS EXCLUSIONES DE ACUERDO AL CONDICIONADO GENERAL DE LA PÓLIZA.<br>

            SECCIÓN V:<br>
            -DE ACUERDO AL CONDICIONADO GENERAL DE LA PÓLIZA.<br><br>
            <span style="font-weight: bold;">IMPORTANTE:</span><br>
            La responsabilidad indemnizatoria de la Compañía está limitada como máximo al Valor Total Asegurado o
            declarado, el cual no puede ser superior a USD. 4.000.000,00 ó sus equivalentes en Moneda Nacional
            (Bolivianos)<br><br>
            <b>REQUISITOS:</b><br>
            Avalúo técnico firmado por el perito designado por Banco Pyme Ecofuturo o documento equivalente, donde se
            especifique la materia del seguro.<br><br>
            <span style="font-weight: bold;">NOTAS ESPECIALES:</span><br>
            El asegurado autoriza a la compañía de seguros a enviar el reporte a la central de riesgos del mercado
            de seguros acorde a las normativas reglamentarias de la autoridad de fiscalización y control de
            pensiones y seguros – APS.<br><br>

            <span style="font-weight: bold;">ACEPTACIONES ESPECIALES:</span><br>

            Los siguientes riesgos, deben ser consultados a la Compañía previo a la emisión de la Póliza:
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                <tr>
                    <td style="width:2%;" valign="top">1.</td>
                    <td style="width:98%;">Bienes inmuebles que estén ubicados en el lecho o cercanía de ríos</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">2.</td>
                    <td style="width:98%;">Riesgos textiles incluyendo riesgos azucareros y algodoneros</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">3.</td>
                    <td style="width:98%;">Riesgos mineros</td>
                </tr>
                <tr>
                    <td style="width:2%;" valign="top">4.</td>
                    <td style="width:98%;">Fábricas de plástico, plastoformo, polietileno, papel, cartón, algodón</td>
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
                    <td style="width:98%;">Industrias químicas y/o todas aquellas donde los insumos sean sustancias
                        inflamables y/o pinturas
                    </td>
                </tr>
            </table>
            <br><br>

            Si un riesgo industrial supera en valor asegurado los US$ 200.000.- debe ser consultado para su aceptación a
            la Compañía Caso contrario, el límite máximo de indemnización asumido por la Compañía será el de US$
            200.000.-
        </div>
        <br><br><br><br>
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; font-size: 70%;">
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial;">
                <tr>
                    <td style="text-align:center; width:33%;">Delfi Lopez</td>
                    <td style="text-align:center; width:34%;">3652954</td>
                    <td style="text-align:center; width:33%;"><?=date('d-m-Y');?></td>
                </tr>
                <tr>
                    <td style="text-align:center; width:33%;"><b>Firma del Titular Asegurado</b></td>
                    <td style="text-align:center; width:34%;"><b>C.I.</b></td>
                    <td style="text-align:center; width:33%;"><b>Fecha de Solicitud</b></td>
                </tr>
            </table>
        </div>
    </div>
</div>



