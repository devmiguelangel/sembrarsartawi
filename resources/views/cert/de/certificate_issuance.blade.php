<div style="width: 775px; height: auto; border: 0px solid #0081C2; padding: 5px;">
    <div style="width: 770px; font-weight: normal; font-size: 12px; font-family: Arial, Helvetica, sans-serif; color: #000000; border: 0px solid #FFFF00;">

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial; margin-bottom: 2px;">
            <tr>
                <td style="width:30%; border: 0px solid #FFFF00; vertical-align: middle;" align="left" valign="top">
                    <img src="{{ asset($query->img_company) }}" width="95">
                </td>
                <td style="width:40%; font-weight:bold; text-align:center; line-height: 0.9em;">
                    <div style="font-size: 67%;">
                        SOLICITUD DE SEGURO DE<br>
                        DESGRAVAMEN HIPOTECARIO<br>
                    </div>
                    <div style="font-size: 57%;">
                        Código S.P.V.S.: 204-934904-2007 07 049-3001
                    </div>
                </td>
                <td style="width:30%; vertical-align: middle;" align="right" valign="top">
                    <img src="{{ asset($query->img_retailer) }}" width="95">
                </td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: left; font-size: 57%;">
                    Estimado cliente, le solicitamos completar la información que se requiere a continuación: (utilice letra clara)
                </td>
            </tr>
        </table>

        <div style="font-weight:bold; font-size:57%; font-family: Arial; line-height: 1em; margin-bottom: 5px;">
            DATOS PERSONALES<br>
            INFORMACIÓN SOBRE TITULAR
        </div>
        <!--DATOS DEL TITULAR 1-->
        @var $i=1;
        @foreach($query_details as $data_cl)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 9%; text-align: left; font-weight: bold;">TITULAR {{$i}}: </td>
                    <td style="text-align: center; width: 23%;">
                        {{$data_cl->last_name}}
                    </td>
                    <td style="text-align: center; width: 23%;">
                        {{$data_cl->mother_last_name}}
                    </td>
                    <td style="text-align: center; width: 23%;">
                        @if($data_cl->civil_status=='C')
                            {{$data_cl->married_name}}
                        @endif
                    </td>
                    <td style="text-align: center; width: 22%;">
                        {{$data_cl->first_name}}
                    </td>
                </tr>
                <tr>
                    <td style="width: 9%;">&nbsp;</td>
                    <td style="width: 23%; border-top: 1px solid #080808; text-align: center;">Apellido Paterno</td>
                    <td style="width: 23%; border-top: 1px solid #080808; text-align: center;">Apellido Materno</td>
                    <td style="width: 23%; border-top: 1px solid #080808; text-align: center;">Apellido Esposo</td>
                    <td style="width: 22%; border-top: 1px solid #080808; text-align: center;">nombres</td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 5%; text-align: left;">Hombre </td>
                    <td style="width: 3%; border:0px solid #333;">
                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                            {{$data_cl->gender=='M'?'x':''}}
                        </div>
                    </td>
                    <td style="width: 5%; text-align: left;"> o Mujer </td>
                    <td style="width: 3%;">
                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                            {{$data_cl->gender=='F'?'x':''}}
                        </div>
                    </td>
                    <td style="width: 84%; text-align: left;">

                    </td>
                </tr>
            </table>
            @var $fecha = date('d/m/Y', strtotime($data_cl->birthdate));
            @var $array = explode('/',$fecha);
            @var $day = $array[0];
            @var $month = $array[1];
            @var $year = $array[2];
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 17%; text-align: left;">Lugar y fecha de Nacimiento: </td>
                    <td style="width: 15%; border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->birth_place}}
                    </td>
                    <td style="width: 5%; text-align: left;">
                        Fecha:
                    </td>
                    <td style="width: 4%; border-bottom: 1px solid #080808; text-align: center;">
                        {{$day}}
                    </td>
                    <td style="width: 1%; text-align: center;">/</td>
                    <td style="width: 4%; border-bottom: 1px solid #080808; text-align: center;">
                        {{$month}}
                    </td>
                    <td style="width: 1%; text-align: center;">/</td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: center;">
                        {{$year}}
                    </td>
                    <td style="width: 4%; text-align: center;">
                        C.I.:
                    </td>
                    <td style="width: 11%; border-bottom: 1px solid #080808; text-align: center;">
                        {{$data_cl->dni.' '.$data_cl->complement.' '.$data_cl->extension}}
                    </td>
                    <td style="width: 5%; text-align: center;">
                        Edad:
                    </td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->age}}
                    </td>
                    <td style="width: 5%; text-align: center;">
                        Peso(Kg):
                    </td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: center;">
                        {{$data_cl->weight}}
                    </td>
                    <td style="width: 8%; text-align: center;">
                        Estatura(cm):
                    </td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: center;">
                        {{$data_cl->height}}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 8%; text-align: left;">Dirección:</td>
                    <td style="width: 51%; border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->home_address}}
                    </td>
                    <td style="width: 7%; text-align: left">Tel. Dom.:</td>
                    <td style="width: 13%; border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->phone_number_home}}
                    </td>
                    <td style="width: 8%; text-align: left;">Tel. Oficina:</td>
                    <td style="width: 13%; border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->phone_number_office}}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 8%; text-align: left;">Ocupación: </td>
                    <td style="width: 59%;  border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->occupation}}
                    </td>
                    <td style="width: 13%; text-align: left;">Porcentaje del crédito: </td>
                    <td style="width: 20%;  border-bottom: 1px solid #080808; text-align: left;">
                        {{$data_cl->percentage_credit}}
                    </td>
                </tr>
            </table>
            @var $i=$i+1
        @endforeach
        <!--DATOS TITULAR 2-->
        @if(count($query_details)<2)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 9%; text-align: left; font-weight: bold;">TITULAR 2: </td>
                    <td style="border-bottom: 1px solid #080808; text-align: left;" colspan="4">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td style="width: 9%;">&nbsp;</td>
                    <td style="width: 23%; text-align: center;">Apellido Paterno</td>
                    <td style="width: 23%; text-align: center;">Apellido Materno</td>
                    <td style="width: 23%; text-align: center;">Apellido Esposo</td>
                    <td style="width: 22%; text-align: center;">nombres</td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 5%; text-align: left;">Hombre </td>
                    <td style="width: 3%; border:0px solid #333;">
                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">

                        </div>
                    </td>
                    <td style="width: 5%; text-align: left;"> o Mujer </td>
                    <td style="width: 3%;">
                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">

                        </div>
                    </td>
                    <td style="width: 84%; text-align: left;">

                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 17%; text-align: left;">Lugar y fecha de Nacimiento: </td>
                    <td style="width: 15%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 5%; text-align: left;">
                        Fecha:
                    </td>
                    <td style="width: 4%; border-bottom: 1px solid #080808; text-align: center;">

                    </td>
                    <td style="width: 1%; text-align: center;">/</td>
                    <td style="width: 4%; border-bottom: 1px solid #080808; text-align: center;">

                    </td>
                    <td style="width: 1%; text-align: center;">/</td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: center;">

                    </td>
                    <td style="width: 4%; text-align: center;">
                        C.I.:
                    </td>
                    <td style="width: 11%; border-bottom: 1px solid #080808; text-align: center;">

                    </td>
                    <td style="width: 5%; text-align: center;">
                        Edad:
                    </td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 5%; text-align: center;">
                        Peso(Kg):
                    </td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: center;">

                    </td>
                    <td style="width: 8%; text-align: center;">
                        Estatura(cm):
                    </td>
                    <td style="width: 5%; border-bottom: 1px solid #080808; text-align: center;">

                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 8%; text-align: left;">Dirección:</td>
                    <td style="width: 51%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 7%; text-align: left">Tel. Dom.:</td>
                    <td style="width: 13%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 8%; text-align: left;">Tel. Oficina:</td>
                    <td style="width: 13%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 57%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 8%; text-align: left;">Ocupación: </td>
                    <td style="width: 59%;  border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 13%; text-align: left;">Porcentaje del crédito: </td>
                    <td style="width: 20%;  border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                </tr>
            </table>
        @endif
        <!--CUESTIONARIO-->

        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 56%; font-family: Arial; padding-bottom: 5px;">
            <tr>
                <td style="width: 3%;"></td>
                <td style="width: 65%;"></td>
                <td style="width: 12%;" align="center">RESPUESTAS</td>
                <td style="width: 8%;"></td>
                <td style="width: 12%;" align="center">RESPUESTAS</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left;"><label style="font-weight: bold;">CUESTIONARIO</label> (Las respuestas debe marcarlas con una x)</td>
                <td style="width: 12%;" align="center">TITULAR 1</td>
                <td style="width: 8%;"></td>
                <td style="width: 12%;" align="center">TITULAR 2</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: left;"></td>
                <td style="width: 12%;" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px;">
                        <tr>
                            <td style="width: 20%; padding-left: 3px; font-size: 56%;">
                                SI
                            </td>
                            <td style="width: 60%;">

                            </td>
                            <td style="width: 20%; padding-left: 3px; font-size: 56%;">
                                NO
                            </td>
                        </tr>
                    </table>
                </td>
                <td style="width: 8%;"></td>
                <td style="width: 12%;" align="center">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px;">
                        <tr>
                            <td style="width: 20%; padding-left: 3px; font-size: 56%;">
                                SI
                            </td>
                            <td style="width: 60%;">

                            </td>
                            <td style="width: 20%; padding-left: 3px; font-size: 56%;">
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
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px;">
                                <tr>
                                    <td style="width: 20%; padding-left: 3px; font-size: 56%;">
                                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">
                                            {{$response == true ? 'x':''}}
                                        </div>
                                    </td>
                                    <td style="width: 60%;">

                                    </td>
                                    <td style="width: 20%; padding-left: 3px; font-size: 56%;">
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
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%; margin-bottom:5px;">
                                <tr>
                                    <td style="width: 20%; padding-left: 3px; font-size: 56%;">
                                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">

                                        </div>
                                    </td>
                                    <td style="width: 60%;">

                                    </td>
                                    <td style="width: 20%; padding-left: 3px; font-size: 56%;">
                                        <div style="width:14px; height:10px; border:1px solid #333; text-align:center; vertical-align: middle;">

                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    @endif
                </tr>
                @var $j = $j + 1
            @endforeach
        </table>
        <div style="font-size:56%; font-family: Arial; line-height: 1em; margin-bottom: 5px; text-align: justify;">
            Si ha contestado afirmativamente alguno de los puntos del 2 al 8, detallar los mismos señalando además cúando ocurrió,
            duración, tratamiento, fecha de curación, secuelas y observaciones u otros
        </div>
        @var $ti = 1;
        @foreach($query_details as $data_cl)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 56%; font-family: Arial; padding-bottom: 5px;">
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
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 56%; font-family: Arial; padding-bottom: 5px;">
                <tr>
                    <td style="width: 10%;">TITULAR 2: </td>
                    <td style="width: 90%;" class="border-bottom">

                    </td>
                </tr>
            </table>
        @endif
        <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify; font-size: 56%; margin-bottom: 5px;">
            Declaro que las respuestas que he consignado en esta solicitud son verdaderas y completas y que es de mi
            conocimiento que cualquier declaración inexacta, omisión u ocultación hará perder todos los beneficios del seguro.<br>
            Igualmente declaro haber recibido, leído y estar de acuerdo con el Certificado de Cobertura Individual (leer reverso),
            que entrará en vigencia una vez aceptada la solicitud y desembolsado el crédito. Declaro beneficiario a título oneroso
            de esta póliza a BANCO DE DESARROLLO PRODUCTIVO S.A.M. para el pago del saldo deudor existente, en caso de siniestro
            cubierto de acuerdo de acuerdo a los términos y condiciones del Seguro.<br>
            Asimismo autorizo a los médicos, clínicas, hospitales y otros centros de salud que me hayan atendido o que me atiendan
            en el futuro, para que proporcionen a la Boliviana Ciacruz Seguros Personales S.A., todos los resultados de los informes
            referentes a mi salud, en caso de enfermedad o accidente, para lo cual revelo a dichos médicos y centros médicos en relación
            con su secreto profesional, de toda responsabilidad en que pudiera incurrir al proporcionar tales informes. Asimismo,
            autorizo a La Boliviana Ciacruz Seguros Personales S.A. a proporcionar estos resultados a BANCO DE DESARROLLO PRODUCTIVO S.A.M.<br>
            Asimismo me comprometo hacer conocer a los beneficiarios la existencia de este Seguro, sus términos y condiciones.

        </div>
        <div style="font-size:56%; font-family: Arial; line-height: 1em; margin-bottom: 5px;">
            BENEFICIARIO PARA SEPELIO: El Asegurado debe designar como beneficiario para la cobertura adicional de sepelio a la persona
            que a su fallecimiento recibirá el Capital que la Compañía otorga en esta cobertura.
        </div>
        <!--BENEFICIARIES-->
        @var $db = 1
        @foreach($beneficiary as $data_benef)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 56%; font-family: Arial; padding-bottom: 5px;">
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
                    <td style="width: 20%; text-align: center;"></td>
                </tr>
                <tr>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Apellido Paterno</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Apellido Materno</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Nombres</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Parentesco</td>
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Telefono/Celular</td>
                </tr>
            </table>
            @var $db = $db + 1
        @endforeach
        @if(count($beneficiary)<2)
            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 56%; font-family: Arial; padding-bottom: 5px;">
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
                    <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">Telefono/Celular</td>
                </tr>
            </table>
        @endif
        <!--FIRMAS-->
        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 56%; font-family: Arial; padding: 20px 0 5px 0;">
            <tr>
                <td style="width: 10%;"></td>
                <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">FIRMA DEL SOLICITANTE (TITULAR 1)</td>
                <td style="width: 10%;"></td>
                <td style="width: 20%; text-align: center; border-top: 1px solid #080808;">FIRMA DEL SOLICITANTE (TITULAR 2)</td>
                <td style="width: 10%;"></td>
            </tr>
        </table>


        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-size: 56%; font-family: Arial; padding-bottom: 5px;">
            <tr>
                <td style="width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                        <tr>
                            <td style="width: 9%; text-align: left; font-size: 56%;">Lugar y fecha:</td>
                            <td style="width: 20%; border-bottom: 1px solid #080808; font-size: 56%;">{{$query_header->city}} - {{$query_header->date_issue}}</td>
                            <td style="width: 71%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: left; padding-top: 4px;">
                    NOTA: La Compañía se reserva el derecho de solicitar exámen(es) médico(s) o información adicional
                </td>
            </tr>
            <tr>
                <td style="width: 100%; font-weight: bold; text-align: left;">
                    TIPO DE OPERACIÓN:
                </td>
            </tr>
            @if($query_header->movement_type!='LC')
                <tr>
                    <td style="width: 100%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 14%; text-align: left; font-weight: bold; font-size: 56%;">
                                    CRÉDITO:
                                </td>
                                <td style="width: 5%; text-align: left; font-size: 56%;">Dólares </td>
                                <td style="width: 3%; border:0px solid #333; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                        {{$query_header->currency=='USD'?'x':''}}
                                    </div>
                                </td>
                                <td style="width: 7%; text-align: left; font-size: 56%;"> Bolivianos </td>
                                <td style="width: 3%; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                        {{$query_header->currency=='BS'?'x':''}}
                                    </div>
                                </td>
                                <td style="width: 68%; text-align: left;">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; padding-top: 3px;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 14%; text-align: left;; font-weight: bold; font-size: 56%;">
                                    LÍNEA DE CREDITO:
                                </td>
                                <td style="width: 5%; text-align: left; font-size: 56%;">Dólares </td>
                                <td style="width: 3%; border:0px solid #333; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">

                                    </div>
                                </td>
                                <td style="width: 7%; text-align: left; font-size: 56%;">Bolivianos </td>
                                <td style="width: 3%; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">

                                    </div>
                                </td>
                                <td style="width: 68%; text-align: left;">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @else
                <tr>
                    <td style="width: 100%;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 14%; text-align: left; font-weight: bold; font-size: 56%;">
                                    CRÉDITO:
                                </td>
                                <td style="width: 5%; text-align: left; font-size: 56%;">Dólares </td>
                                <td style="width: 3%; border:0px solid #333; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">

                                    </div>
                                </td>
                                <td style="width: 7%; text-align: left; font-size: 56%;"> Bolivianos </td>
                                <td style="width: 3%; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">

                                    </div>
                                </td>
                                <td style="width: 68%; text-align: left;">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; padding-top: 3px;">
                        <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                            <tr>
                                <td style="width: 14%; text-align: left;; font-weight: bold; font-size: 56%;">
                                    LÍNEA DE CREDITO:
                                </td>
                                <td style="width: 5%; text-align: left; font-size: 56%;">Dólares </td>
                                <td style="width: 3%; border:0px solid #333; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                        {{$query_header->currency=='USD'?'x':''}}
                                    </div>
                                </td>
                                <td style="width: 7%; text-align: left; font-size: 56%;">Bolivianos </td>
                                <td style="width: 3%; font-size: 56%;">
                                    <div style="width:14px; height:10px; border:1px solid #333; text-align:center;">
                                        {{$query_header->currency=='BS'?'x':''}}
                                    </div>
                                </td>
                                <td style="width: 68%; text-align: left;">

                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            @endif
            <tr>
                <td style="width: 100%;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                        <tr>
                            <td style="width: 19%; text-align: left; font-size: 56%;">Saldo deudor actual ASEGURADO:</td>
                            <td style="width: 20%; border-bottom: 1px solid #080808; font-size: 56%;">{{number_format($query_header->amount_requested, 2, '.', ',')}}</td>
                            <td style="width: 6%; text-align: left; font-weight: bold; font-size: 56%;">Sucursal:</td>
                            <td style="width: 16%; border-bottom: 1px solid #080808; font-size: 56%;">{{$query_header->city}}</td>
                            <td style="width: 6%; text-align: left; font-weight: bold; font-size: 56%;">Agencia:</td>
                            <td style="width: 16%; border-bottom: 1px solid #080808; font-size: 56%;">{{$query_header->agency}}</td>
                            <td style="width: 17%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="width: 100%; text-align: left;">
                    (Cúmulo desembolsos anteriores)
                </td>
            </tr>
            @foreach($query_details as $data_ti)
                @if($data_ti->headline=='D')
                    <tr>
                        <td style="width: 100%; text-align: left;">
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                <tr>
                                    <td style="width: 13%; text-align: left; font-size: 56%;">Monto actual solicitado:</td>
                                    <td style="width: 25%; border-bottom: 1px solid #080808; font-size: 56%;">{{number_format($data_ti->amount, 2, '.', ',')}}</td>
                                    <td style="width: 62%;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%; text-align: left;">
                            <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                                <tr>
                                    <td style="width: 14%; text-align: left; font-size: 56%;">Monto actual Acumulado:</td>
                                    <td style="width: 25%; border-bottom: 1px solid #080808; font-size: 56%;">{{number_format($data_ti->cumulus, 2, '.', ',')}}</td>
                                    <td style="width: 61%;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                @endif
            @endforeach
            @var $parameter_term = config('base.term_types')
            @var $type_term = $parameter_term[$query_header->type_term]
            <tr>
                <td style="width: 100%; text-align: left;">
                    <table border="0" cellpadding="0" cellspacing="0" style="width:100%;">
                        <tr>
                            <td style="width: 14%; text-align: left; font-size: 56%;">Plazo del presente crédito:</td>
                            <td style="width: 25%; border-bottom: 1px solid #080808; font-size: 56%;">{{$query_header->term.' '.$type_term}}</td>
                            <td style="width: 61%;"></td>
                        </tr>
                    </table>
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
                        @if($data_fac->headline=='D')
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
                            <tr>
                                <td colspan="6" style="text-align: left; background: #e57474; color: #FFFFFF;">
                                    <span style="color:#000000">Observaciones:</span> {{$data_fac->reason}}
                                </td>
                            </tr>
                        @endif
                    @endforeach
            </table>

            @else

                <table border="0" cellpadding="1" cellspacing="0" style="width: 100%; font-size: 8px; border-collapse: collapse; font-weight: normal; font-family: Arial; margin: 2px 0 0 0; padding: 0; border-collapse: collapse; vertical-align: bottom;">
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
                    <td style="width:30%; border: 0px solid #FFFF00; vertical-align: middle;" align="left" valign="top">

                    </td>
                    <td style="width:40%; font-weight:bold; text-align:center; line-height: 0.9em;">
                        <div style="font-size: 53%;">
                            PÓLIZA DE SEGURO DE DESGRAVAMEN HIPOTECARIO<br>
                            CERTIFICADO DE COBERTURA INDIVIDUAL B1<br>
                        </div>
                        <div style="font-size: 50%;">
                            Código Asignado S.P.V.S.: 204-934904-2007 07 049-4004
                        </div>
                    </td>
                    <td style="width:30%; vertical-align: middle;" align="right" valign="top">

                    </td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: right; font-size: 50%;">
                        Póliza Nº A1070587
                    </td>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto;  font-family: Arial;">
                <tr>
                    <td style="width: 100%;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; font-size: 50%;">
                            <tr>
                                <td style="width: 12%; text-align: left; font-weight: bold;">
                                    CONTRATANTE:
                                </td>
                                <td style="width: 88%; border-bottom: 0px solid #080808; text-align: left;">
                                    BANCO DE DESARROLLO PRODUCTIVO S.A.M.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 12%; text-align: left; font-weight: bold;">
                                    ASEGURADO:
                                </td>
                                <td style="width: 88%; border-bottom: 0px solid #080808; text-align: left;">

                                </td>
                            </tr>
                            <tr>
                                <td style="width: 12%; text-align: left; font-weight: bold;">
                                    BENEFICIARIO:
                                </td>
                                <td style="width: 88%; border-bottom: 0px solid #080808; font-weight: bold; text-align: left;">
                                    BANCO DE DESARROLLO PRODUCTIVO S.A.M.
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 12%; text-align: left; font-weight: bold;">
                                    INTERMEDIARIO:
                                </td>
                                <td style="width: 88%; border-bottom: 0px solid #080808; font-weight: bold; text-align: left;">
                                    Sudamericana SRL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; TELEFONO: (591)-2-2433500&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fax: (591)-2-2128329
                                </td>
                            </tr>
                            <tr>
                                <td style="width: 12%; text-align: left;">

                                </td>
                                <td style="width: 88%; border-bottom: 0px solid #080808; font-weight: bold; text-align: left;">
                                    Direccion: Prolongación Cordero N&deg; 163 - San Jorge
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; height: auto; font-family: Arial;">
                <tr>
                    <td style="width: 100%; border-bottom: 1px solid #000000; border-top: 1px solid #000000; font-size: 50%;">
                        LA BOLIVIANA CIACRUZ SEGUROS PERSONALES S.A. CERTIFICA QUE SE ENCUENTRA ASEGURADO(A) CON LAS SIGUIENTES COBERTURAS:
                    </td>
                </tr>
                <tr>
                    <td style="width: 100%; border-bottom: 1px solid #000000;">
                        <table border="0" cellpadding="0" cellspacing="0" style="width:100%; font-size: 50%;">
                            <tr>
                                <td style="width: 45%; text-align: left; font-weight: bold;">COBERTURAS</td>
                                <td style="width: 10%; "></td>
                                <td style="width: 45%; text-align: left; font-weight: bold;">CAPITAL ASEGURADO</td>
                            </tr>
                            <tr>
                                <td style="width: 45%; text-align: left; ">-Muerte Natural y/o Accidental:</td>
                                <td style="width: 10%; "></td>
                                <td style="width: 45%; text-align: left; ">Saldo deudor (De acuerdo a Condicionado Particular)</td>
                            </tr>
                            <tr>
                                <td style="width: 45%; text-align: left; font-weight: bold;">COBERTURAS ADICIONALES</td>
                                <td style="width: 10%; "></td>
                                <td style="width: 45%; text-align: left; "></td>
                            </tr>
                            <tr>
                                <td style="width: 45%; text-align: left; ">
                                    -Pago anticipado por Invalidez Total y Permanente<br>
                                    -Sepelio
                                </td>
                                <td style="width: 10%; "></td>
                                <td style="width: 45%; text-align: left; ">
                                    De acuerdo a Condicionado Particular<br>
                                    De acuerdo a Condicionado Particular
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

            <div style="width: 770px; border: 0px solid #FFFF00; text-align:justify;">
                <div style="font-size: 38%;">
                    <span style="font-weight: bold;">COBERTURAS ADICIONALES</span><br>
                    <span style="font-weight: bold;">PAGO ANTICIPADO POR INVALIDEZ TOTAL Y PERMANENTE</span><br />
                    A los efectos de la presente cobertura se considera Invalidez Total y Permanente el hecho de que el Asegurado, antes de llegar
                    a los 65 años de edad, quede incapacitado en por lo menos un 65%, a causa de un estado crónico, debidoa enfermedad, o lesión o
                    la pérdida de miembros o funciones, que impida ejecutar cualquier trabajo y siempre que el carácter de tal incapacidad sea
                    reconocido.<br>
                    Una vez recibidos los documentos probatorios de la invalidez total y permanente del Asegurado , la Compañía, en caso de
                    conformidad, pagará el Capital Asegurado correspondiente al Beneficiario.<br>
                    <span style="font-weight: bold;">EXCLUSIONES</span><br>
                    <span style="font-weight: bold;">MUERTE NATURAL Y/O ACCIDENTAL</span>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify;">
                            Suicidio, intento de suicidio, mutilaciones o lesiones inferidas al Asegurado por si mismo  o por
                            terceros con su consentimiento, cualquiera sea la época en que ocurra. No obstante, la Compañía pagará
                            el Capital Asegurado a los Beneficiarios, si el fallecimiento ocurriera por cualesquiera de las causas
                            antes descritas, siempre que el hecho haya ocurrido después de transcurridos los (2) años completos e
                            ininterrumpidos desde la fecha de contratación de la póliza, desde su rehabilitación o desde el aumento
                            del Capital Asegurado. En este último caso, el nuevo plazo se considerara sólo para el pago del incremento
                            del Capital Asegurado.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center;" valign="top">b)</td>
                        <td style="width: 98%; text-align: justify;">
                            Pena de muerte o participación, directa o indirecta, en calidad de autor o cómplice en cualquier acto delictivo.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center;" valign="top">c)</td>
                        <td style="width: 98%; text-align: justify;">
                            Guerra, guerra civil, invasión o acción de un enemigo extranjero, hostilidades u operaciones bélicas, ya sea bajo
                            declaración de guerra o no.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center;" valign="top">d)</td>
                        <td style="width: 98%; text-align: justify;">
                            Confiscación, nacionalización, requisición hecha u ordenada por cualquier gobierno o autoridad pública, nacional
                            o local, ley marcial o estado de sitio, rebelión, revolución, insurrección, sedición, insubordinación, poder militar
                            o usurpado, huelgas, motines, asonada, conmoción civil o popular de cualquier clase, daño malicioso, vandalismo,
                            sabotaje y/o terrorismo, siempre que el Asegurado tengo participación activa en dichos hechos.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">e)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fisión o fusión nuclear o contaminación radioactiva.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">f)</td>
                        <td style="width: 98%; text-align: justify;">
                            Enfermedades, lesiones, o dolencias preexistentes, entendiéndose por tales cualquier lesión, enfermedad, o
                            dolencia que afecte al asegurado, que haya sido conocida por él y que haya sido diagnosticada con anterioridad a
                            la fecha de incorporación del Asegurado a la póliza.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">g)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Consecuencias y complicaciones directas e indirectas del VIH/SIDA.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">h)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Consecuencias y complicaciones directas e indirectas de Gripe Aviar.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">i)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Viajar como piloto, copiloto, asistente de vuelo o como pasajero en transporte aéreo privado y
                            helicópteros, no autorizados para operar como línea aérea comercial sujeta a itinerario fijo,
                            salvo que solicite cobertura especifica en cada caso, y la Compañía acepte, mediante anexo expreso,
                            fijando una extra prima.
                        </td>
                    </tr>
                </table>
                <span style="font-weight: bold; font-size: 38%;">PAGO ANTICIPADO POR INVALIDEZ TOTAL Y PERMANENTE</span>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Intento de suicidio, mutilaciones o lesiones inferidas al Asegurado por sí mismo o por terceros con su consentimiento, cualquiera sea la época que ocurra.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">b)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Participación, directa o indirecta, en calidad de autor o cómplice en cualquier acto delictivo.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">c)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Guerra, invasión, actos de enemigos extranjeros, hostilidades u operaciones bélicas, sea que haya habido o no
                            declaración de guerra, servicio militar, revolución, insurrección, sublevación, rebelión, sedición, motín; o
                            hechos que las leyes califican como delitos contra la seguridad del estado.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">d)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fisión o fusión nuclear o contaminación radiactiva.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">e)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Catástrofes naturales.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">f)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Viajar como piloto, copiloto, asistente de vuelo o como pasajero en transporte aéreo privado y
                            helicópteros no autorizados para operar como línea aéreacomercial sujeta a itinerario fijo, salvo
                            que previamente se solicite cobertura específica para cada caso, sujeta a extra prima y que la
                            Compañía acepte, mediante anexo expreso.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">g)</td>
                        <td style="width: 98%; text-align: justify; ">
                            La participación del asegurado como conductor o acompañante, profesionalmente o como aficionado,
                            en competencias o ensayos de velocidad o resistencia, en cualquier clase de vehículo terrestre,
                            acuático, o aéreo, a motor o no, salvo que la cobertura específica haya sido solicitada y expresamente
                            aceptada por la Compañía por escrito fijándose una extra prima.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">h)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Enfermedades, lesiones, o dolenciaspreexistentes, entendiéndose por tales cualquier lesión,
                            enfermedad o dolencia que afecte al asegurado, que haya sido conocida por él y que haya sido
                            diagnosticada con anterioridad a la fecha de incorporación del Asegurado a la póliza.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">i)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Consecuencias y complicaciones directas e indirectas del VIH/SIDA.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">j)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Consecuencias y complicaciones directas e indirectas de Gripe Aviar.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">k)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Que el Asegurado se encuentre en estado de ebriedad o bajo los efectos o alucinógenos y haya
                            sido el causante del siniestro. Estos estados deberán ser calificados por la autoridad competente
                            o informe del médico que lo hubiese atendido.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">l)</td>
                        <td style="width: 98%; text-align: justify; ">
                            La participación del Asegurado en actos temerarios, profesionalmente o como aficionado, en deportes
                            riesgosos: Cuando practique como aficionado: béisbol; esquí; inmersiones acuáticas y/o buceo a más
                            de tres metros de profundidad; piloto; rodeo; rugby; alas delta; andinismo, alpinismo o montañismo,
                            con equipo especial, salvo el trecking en cerros o montañas que no impliquen el uso de equipo especial
                            ni se constituya en ascenso vertical; ascensos verticales (escalada), con o sin equipo; boxeo;
                            paracaidismo; parapente; artes marciales; equitación; bungy jumping; o rating.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">m)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Todo tipo de deporte practicado en competencias oficiales, llamadas o convocadas por una Asociación
                            Deportiva Legalmente reconocida, ya sea profesionalmente o no, salvo las competencias intercolegiales
                            o inter universitarias.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">n)</td>
                        <td style="width: 98%; text-align: justify; ">
                            La participación del Asegurado en actos temerarios o en cualquier maniobra, experimento, exhibición,
                            desafío o actividad notoriamente peligrosa, entendiendo por tales aquellas donde se pone en grave
                            peligro la vida e integridad física de las personas.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">o)</td>
                        <td style="width: 98%; text-align: justify; ">
                            La práctica o el desempeño de alguna actividad, profesión u oficio claramente riesgoso, que no haya
                            sido declarado por el Asegurado al momento de contratar el seguro durante su vigencia y que  no haya
                            sido aceptado por la Compañía mediante anexo expreso, sujeto a extra prima.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">p)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Falsas declaraciones, omisión o reticencia del Asegurado que puedan influir en la comprobación de su estado de invalidez.
                        </td>
                    </tr>
                </table>
                <span style="font-weight: bold; font-size: 38%;">SEPELIO</span>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify;">
                            Pena de muerte o participación, directa o indirecta, en calidad de autor o cómplice en cualquier acto delictivo.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">b)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Guerra, guerra civil, invasión o acción de un enemigo extranjero, hostilidades u operaciones bélicas, ya sea bajo declaración de guerra o no.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">c)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Confiscación, nacionalización, requisición hecha u ordenada por cualquier gobierno o autoridad pública, nacional
                            o local, ley marcial o estado de sitio, rebelión, revolución, insurrección, sedición, insubordinación,
                            poder militar o usurpado, huelgas, motines, asonada, conmoción civil o popular de cualquier clase, daño malicioso,
                            vandalismo, sabotaje y/o terrorismo, siempre que el Asegurado tenga participación activa en dichos hechos.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">d)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Enfermedades, lesiones, o dolencias preexistentes, entendiéndose por tales cualquier lesión, enfermedad o
                            dolencia que afecte al asegurado, que haya sido conocida por él y que haya sido diagnosticada con anterioridad a
                            la fecha de incorporación del Asegurado a la póliza.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">e)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Enfermedades, lesiones, o dolencias preexistentes, entendiéndose por tales cualquier lesión, enfermedad o dolencia
                            que afecte al asegurado, que haya sido conocida por él y que haya sido diagnosticada con anterioridad a la fecha de
                            incorporación del Asegurado a la póliza.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">f)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Consecuencias y complicaciones directas e indirectas del VIH/SIDA.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">g)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Consecuencias y complicaciones directas e indirectas de Gripe Aviar.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: justify;">
                            En todos estos casos, si ocurriese la muerte del Asegurado como consecuencia de una causa excluida, no corresponderá
                            la devolución de prima alguna.
                        </td>
                    </tr>
                </table>
                <div style="font-size: 38%;"><b>PROCEDIMIENTO EN CASO DE SINIESTRO</b><br>
                El Beneficiario a Título Oneroso, tan pronto y a más tardar dentro de los sesenta (60) días calendario de tener conocimiento
                del siniestro de alguno de los Asegurados, deberá comunicar tal hecho a la Compañía, salvo fuerza mayor o impedimento
                justificado. En caso de muerte presunta, ésta deberá acreditarse de acuerdo a ley. Una vez recibidos los documentos probatorios
                del fallecimiento del Asegurado, la Compañía, en caso de conformidad, pagará el Capital Asegurado correspondiente al Beneficiario.
                La obligación de pagar el Capital Asegurado deberá ser cumplida por la Compañía en un solo acto, por su valor total y en dinero.
                Y quedará sujeta a los términos y condiciones establecidos en los artículos 1031, 1033 y 1034 del Código de Comercio.<br>
                El Beneficiario deberá presentar a la Compañía la siguiente documentación, que podrá ser modificada en acuerdo de partes al
                momento de celebrarse el contrato del Seguro, debiéndose detallar de manera expresa en la Condiciones Particulares:
                <b>MUERTE POR CUALQUIER CAUSA</b><br>
                <b>Para siniestros hasta Bs. 70.000 (Free Cover)</b>
                </div>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fotocopia de Certificado de Nacimiento o Fotocopia del Carnet de Identidad del Asegurado.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">b)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Liquidación de cartera con el monto indeminizable.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">c)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Certificado de Defunción Original.
                        </td>
                    </tr>
                </table>
                <span style="font-weight: bold; font-size: 38%;">Para siniestros mayores a Bs. 70.000</span>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fotocopia de Certificado de Nacimiento o Fotocopia del Carnet de Identidad del Asegurado.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">b)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Liquidación de cartera con el monto indeminizable.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">c)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Certificado de Defunción Original.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">d)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Certificado Médico Único de Defunción en original o fotocopia legalizada (para las poblaciones donde existan
                            centros médicos o postas con presencia de médico.) o informe del oficial de crédito dando fe de suceso y
                            descripción breve de lo acontecido (causa de muerte), con el respectivo visto bueno de su inmediato superior y
                            avalado por la autoridad del lugar (para las poblaciones que no se encuentren en el área urbana y no existan centros
                            médicos o postas sanitarias con presencia de médico).
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">e)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Historia clínica, si corresponde (para las poblaciones donde existan centros médicos o postas con presencia de médico)
                            o informe médico de un centro médico de la población más cercana (para las poblaciones que no se encuentren en el
                            área urbana y no existan centros médicos o postas sanitarias con presencia de médico).
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">f)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fotocopia legalizada del informe de la autoridad competente, en caso de muerte accidental.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">g)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Además de alguna otra información complementaria que la compañía requiera en caso de ser necesario, en caso de
                            alguna observación legal.
                        </td>
                    </tr>
                </table>
                <span style="font-weight: bold; font-size: 38%;">PAGO ANTICIPADO POR INVALIDEZ Y PERMANENTE</span>
                <span style="font-weight: bold; font-size: 38%;">Para siniestros hasta Bs. 70.000(Free Cover)</span>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fotocopia de Certificado de Nacimiento o Fotocopia del Carnet de Identidad del Asegurado.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">b)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Liquidación de cartera con el monto indeminizable.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">c)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Calificación del Grado de Invalidez en base a las normas vigentes por la institución o médico
                            debidamente autorizado por la Autoridad Competente (APS).
                        </td>
                    </tr>
                </table>
                <span style="font-weight: bold; font-size: 38%;">Para siniestros mayores a Bs. 70.000</span>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fotocopia de Certificado de Nacimiento o Fotocopia del Carnet de Identidad del Asegurado.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">b)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Liquidación de cartera con el monto indeminizable.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">c)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Historia clínica, si corresponde (para las poblaciones donde existan centros médicos o
                            postas con presencia de médico) o informe médico de un centro médico de la población más
                            cercana (para las poblaciones que no se encuentren en el área urbana y no existan centros
                            médicos o postas sanitarias con presencia de médico).
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">d)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Calificación del Grado de Invalidez en base a las normas vigentes por la institución o médico
                            debidamente autorizado por la Autoridad Competente (APS).
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">e)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Además de alguna otra información complementaria que la compañía requiera en caso de ser necesario,
                            en caso de alguna observación legal.
                        </td>
                    </tr>
                </table>
                <span style="font-weight: bold; font-size: 38%;">SEPELIO</span>
                <span style="font-weight: bold; font-size: 38%;">(Beneficiarios)</span>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">a)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Fotocopia del Carnet de Identidad del Beneficiario.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 2%; text-align: center; " valign="top">b)</td>
                        <td style="width: 98%; text-align: justify; ">
                            Declaratoria de Beneficiarios o Declaratoria de Herederos Legales, en caso de no existir la nominación de los mismos.
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%; font-size: 38%;">
                    <tr>
                        <td style="width: 100%;">
                            La Compañía se reserva el derecho de exigir a las autoridades competentes y a su costa, la autopsia o la exhumación
                            del cadáver para establecer las causas de la muerte. El Beneficiario y/o los sucesores deben prestar su colaboración
                            y concurso para la obtención de las correspondientes autorizaciones oficiales. Si el Beneficiario y/o los sucesores
                            se negaran a permitir dicha autopsia o exhumación, o la retardaran en tal forma de que ella sea inútil para el
                            finperseguido, el Beneficiario perderá el derecho a la indeminización del Capital Asegurado por esta Póliza.
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 100%;">
                            <b>CONDICIÓN DE ADHESIÓN:</b> El Asegurado se adhiere voluntariamente al seguro de Desgravamen Hipotecario y declara conocer
                            y aceptar todas las condiciones de la presente póliza.<br>
                            TODOS LOS BENEFICIOS A LOS CUALES EL ASEGURADO TIENE DERECHO SE SUJETAN A LO ESTIPULADO EN LAS CONDICIONES GENERALES,
                            PARTICULARES Y/O ESPECIALES DE LA PÓLIZA DE DESGRAVAMEN HIPOTECARIO GRUPO DE LA CUAL DE LA CUAL EL PRESENTE
                            CERTIFICADO FORMA PARTE INTEGRANTE.<br>
                            <b>PRIMA:</b> De acuerdo a las declaraciones mensuales de contratante.<br>
                            <b>FORMA DE PAGO:</b> CONTADO A TRAVÉS DE BANCO DE DESARROLLO PRODUCTIVO S.A.M.<br>
                            <b>LUGAR Y FECHA:</b> Los mencionados en la Solicitud de Seguro de Desgravamen Hipotecario (Anverso).
                        </td>
                    </tr>
                </table>
                <table cellpadding="0" cellspacing="0" border="0" style="width: 100%;">
                    <tr>
                        <td style="width: 33%; text-align: center;"></td>
                        <td style="width: 34%; text-align: center;">
                            <img src="{{ asset($query->img_company) }}" width="95">
                        </td>
                        <td style="width: 33%; text-align: center;"></td>
                    </tr>
                </table>
            </div>
        @endif
    </div>
</div>
