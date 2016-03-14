@include('partials.tools_modal',array('type'=>$type,'idHeader'=>encode($idHeader)))

@var $size = '80%'
@if($flagPdf == 1)
    @var $size = '55%'
@endif
    
<meta charset="utf-8">
<!--
@include('partials.logos_modal',array('image1'=>$retailer->image,'images'=>$retailerProduct))
-->
<div class="container" style="width: 730px; ">
    <div class="main">
        <div class="header">
            <div style="font-size: {{ $size }}; width: auto; height: auto; font-weight: bold; text-align: right;">
                DECLARACIÓN JURADA DE SALUD <br>
                SOLICITUD DE SEGURO DE VIDA EN GRUPO
            </div>
            <div style="font-size: {{ $size }}; width: auto; height: auto; margin-top: 3px; text-align: left;">
                Estimado Cliente, agradeceremos completar la informacion que se requiere a continuaci&oacute;n: (utilice letra clara)
            </div>
        </div>
        <br>
        <div class="wrap" style="font-size: {{ $size }};">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: {{ $size }};">I.	DATOS PERSONALES (TITULAR)</div><br />
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: {{ $size }};">Nombres y Apellidos:</div>
                 <br />
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table" style="width: 730px;">
                <tr>
                    <td style="width: 730px; text-align: left;border-bottom: 1px solid #080808;">{{ $viDetail->taker_name }}: </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table" style="width: 730px;">
                <tr>
                    <td style="width: 20%; text-align: left;">Lugar y Fecha de Nacimiento: </td>
                    <td style="width: 60%; border-bottom: 1px solid #080808; text-align: left;"> &nbsp;
                        {{ $viDetail->client->place_residence }} {{ date('d-m-Y', strtotime($viDetail->client->birthdate)) }}
                    </td>
                    <td style="width: 5%; text-align: left;">Sexo: </td>
                    <td style="width: 15%; border-bottom: 1px solid #080808; text-align: left;"> 
                        {{ $viDetail->client->gender== 'M'?'Masculino':'Femenino' }}
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table" style="width: 730px;">
                <tr>
                    <td style="width: 15%; text-align: left;">Carnet de Identidad: </td>
                    <td style="width: 43%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->dni }} {{ $viDetail->client->extension }}
                    </td>
                    <td style="width: 4%; text-align: left;">Edad: </td>
                    <td style="width: 9%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->age }}
                    </td>
                    <td style="width: 4%; text-align: left;">Peso: </td>
                    <td style="width: 9%; border-bottom: 1px solid #080808; text-align: left;">

                    </td>
                    <td style="width: 7%; text-align: left;">Estatura: </td>
                    <td style="width: 9%; border-bottom: 1px solid #080808;">
                        {{ $viDetail->client->height }}
                    </td>
                </tr>
            </table>  
                 <table cellpadding="0" cellspacing="0" border="0" class="wrap_table" style="width: 730px;">
                <tr>
                    <td style="width: 8%; text-align: left;">Direcci&oacute;n: </td>
                    <td style="width: 32%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->home_address }}
                    </td>
                    <td style="width: 11%; text-align: left;">Telef. Domicilio: </td>
                    <td style="width: 19%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->phone_number_home }}
                    </td>
                    <td style="width: 9%; text-align: left;">Teléfono Of: </td>
                    <td style="width: 21%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->phone_number_office }}
                    </td>
                </tr>
            </table>  
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table" style="width: 730px;">
                <tr>
                    <td style="width: 8%; text-align: left;">Ocupaci&oacute;n: </td>
                    <td style="width: 92%; border-bottom: 1px solid #080808; text-align: left;">
                        {{ $viDetail->client->occupation_description }}
                    </td>
                </tr>
            </table>  
        </div>
        <br>
        <div class="wrap">
            <div style="width: auto;	height: auto; text-align: left; margin: 2px 0; padding: 0;
                 font-weight: bold; font-size: {{ $size }};">2. CUESTIONARIO</div>
            
            <table cellpadding="0" cellspacing="0" border="0" class="wrap_table" style="font-size: {{ $size }};width: 730px;">
                <tr>
                    <td style="width: 5%;">1 </td>
                    <td style="width: 45%;">¿Pregunta Uno?</td>
                    <td style="width: 25%;">SI <input type="text" value="&nbsp;" style="width: 35px;"/></td>
                    <td style="width: 25%;">NO <input type="text" value="X" style="width: 35px;" /></td>
                </tr>
                <tr>
                    <td style="width: 5%;">2 </td>
                    <td style="width: 45%;">¿Pregunta Dos?</td>
                    <td style="width: 25%;">SI <input type="text" value="&nbsp;" style="width: 35px;"/></td>
                    <td style="width: 25%;">NO <input type="text" value="X" style="width: 35px;" /></td>
                </tr>
                <tr>
                    <td style="width: 5%;">3 </td>
                    <td style="width: 45%;">¿Pregunta Tres?</td>
                    <td style="width: 25%;">SI <input type="text" value="&nbsp;" style="width: 35px;"/></td>
                    <td style="width: 25%;">NO <input type="text" value="X" style="width: 35px;" /></td>
                </tr>
            </table>
        </div>
        
        <br />
        <div class="text_contenido" style="font-size: {{ $size }}; text-align: justify">
            <p style="text-align: justify; margin: 0;">
                Declaro haber contestado con total veracidad, máxima buena fe a todas 
                las preguntas del presente cuestionario y no haber omitido u ocupado 
                hechos y/o circunstancias que hubiera podido influir en la celebración 
                del contrato de seguro. Las declaraciones de salud que hacen anulable 
                el Contrato de Seguros y en la que el asegurado pierde su derecho a 
                indemnización, se enmarcan en los artículos 992, 993, 999 y 1038 del 
                Código de Comercio.
                <br><br>
                Relevo expresamente del secreto profesional y legal, a cualquier 
                médico que me hubiese asistido y/o tratado de dolencias y le autorizo 
                a revelar a Nacional Vida Seguros de Personas S.A. todos los datos y 
                antecedentes patológicos que pudiera tener o de los que hubiera 
                adquirido conocimiento al prestarme sus servicios. Entiendo que de 
                presentarse alguna eventualidad contemplada bajo la póliza de seguro 
                como consecuencia de alguna enfermedad existente a la fecha de la 
                firma de este documento o cuando haya alcanzado la edad límite 
                estipulada en la póliza, la compañía aseguradora quedará liberada 
                de toda la responsabilidad en lo que respecta a mí seguro.
            </p>
        </div>
        <br>
        <div class="wrap">
            <table cellpadding="0" cellspacing="0" border="0" style="font-size: {{ $size }};width: 730px;">
                <tr>
                    <td style="width: 10%; ">
                        Lugar y Fecha:
                    </td>
                    <td style="width: 30%; height: 5px; border-bottom: 1px solid #080808;" >&nbsp;
                       {{ date('d-m-Y', strtotime($viHeader->date_issue)) }} 
                    </td>
                    <td style="width: 5%;" >
                        Firma:
                    </td>
                    <td style="width: 35%; border-bottom: 1px solid #080808;">&nbsp;

                    </td>
                </tr>
                <tr>
                    <td style="width: 5%;">
                    </td>
                    <td style="width: 35%; height: 5px;" >
                    </td>
                    <td style="width: 5%;">
                    </td>
                    <td style="width: 55%; text-align: center;">
                        ASEGURADO
                    </td>
                </tr>
            </table>
            <br><br>
        </div>
    </div>
</div>