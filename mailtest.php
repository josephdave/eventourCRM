<?php
require('control/Mailin.php');
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0','2mUNn4KyjYgABhW8', 5000);	// Optional parameter: Timeout in MS

/** Prepare variables for easy use **/ 

$contenido="<head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'><meta name='viewport' content='initial-scale=1.0'><meta name='format-detection' content='telephone=no'><title>MOSAICO Responsive Email Designer</title><style type='text/css'>.socialLinks {font-size: 6px;}
.socialLinks a {display: inline-block;}
.socialIcon {display: inline-block;vertical-align: top;padding-bottom: 0px;border-radius: 100%;}
table.vb-row.fullwidth {border-spacing: 0;padding: 0;}
table.vb-container.fullwidth {padding-left: 0;padding-right: 0;}</style><style type='text/css'>
    /* yahoo, hotmail */
    .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div{ line-height: 100%; }
    .yshortcuts a{ border-bottom: none !important; }
    .vb-outer{ min-width: 0 !important; }
    .RMsgBdy, .ExternalClass{
      width: 100%;
      background-color: #3f3f3f;
      background-color: #002060}

    /* outlook */
    table{ mso-table-rspace: 0pt; mso-table-lspace: 0pt; }
    #outlook a{ padding: 0; }
    img{ outline: none; text-decoration: none; border: none; -ms-interpolation-mode: bicubic; }
    a img{ border: none; }

    @media screen and (max-device-width: 600px), screen and (max-width: 600px) {
      table.vb-container, table.vb-row{
        width: 95% !important;
      }

      .mobile-hide{ display: none !important; }
      .mobile-textcenter{ text-align: center !important; }

      .mobile-full{
        float: none !important;
        width: 100% !important;
        max-width: none !important;
        padding-right: 0 !important;
        padding-left: 0 !important;
      }
      img.mobile-full{
        width: 100% !important;
        max-width: none !important;
        height: auto !important;
      }   
    }
  </style><style type='text/css'>#ko_doubleArticleBlock_5 .links-color a, #ko_doubleArticleBlock_5 .links-color a:link, #ko_doubleArticleBlock_5 .links-color a:visited, #ko_doubleArticleBlock_5 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}
#ko_singleArticleBlock_3 .links-color a, #ko_singleArticleBlock_3 .links-color a:link, #ko_singleArticleBlock_3 .links-color a:visited, #ko_singleArticleBlock_3 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}
#ko_textBlock_4 .links-color a, #ko_textBlock_4 .links-color a:link, #ko_textBlock_4 .links-color a:visited, #ko_textBlock_4 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}
#ko_textBlock_6 .links-color a, #ko_textBlock_6 .links-color a:link, #ko_textBlock_6 .links-color a:visited, #ko_textBlock_6 .links-color a:hover {color: #3f3f3f;color: #3f3f3f;text-decoration: underline;}
#ko_footerBlock_2 .links-color a:visited, #ko_footerBlock_2 .links-color a:hover {color: #ccc;color: #fff;text-decoration: underline;}</style></head><body bgcolor='#002060' text='#ffffff' alink='#ffffff' vlink='#ffffff' style='margin: 0;padding: 0;background-color: #002060;color: #fff;'>

  <center>

  <!-- preheaderBlock -->
  

  <table class='vb-outer' width='100%' cellpadding='0' border='0' cellspacing='0' bgcolor='#002060' style='background-color: #002060;' id='ko_preheaderBlock_1'><tbody><tr><td class='vb-outer' align='center' valign='top' bgcolor='#002060' style='padding-left: 9px;padding-right: 9px;background-color: #002060;'>
        <div style='display: none; font-size: 1px; color: #333333; line-height: 1px; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;'></div>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='570'><tr><td align='center' valign='top'><![endif]-->
        <div class='oldwebkit' style='max-width: 570px;'>
        <table width='570' border='0' cellpadding='0' cellspacing='0' class='vb-row halfpad' bgcolor='#002060' style='border-collapse: separate;border-spacing: 0;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;background-color: #002060;'><tbody><tr><td align='center' valign='top' bgcolor='#002060' style='font-size: 0; background-color: #002060;'>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='552'><tr><![endif]-->
<!--[if (gte mso 9)|(lte ie 8)]><td align='left' valign='top' width='276'><![endif]--> 
<div style='display: inline-block; max-width: 276px; vertical-align: top; width: 100%;' class='mobile-full'> 
                    <table class='vb-content' border='0' cellspacing='9' cellpadding='0' width='276' style='border-collapse: separate;width: 100%;' align='left'><tbody><tr><td width='100%' valign='top' align='left' style='font-weight: normal; text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #ffffff;'>
                          <a style='text-decoration: underline; color: #ffffff;' target='_new' href='http://eventoursport.travel/crm/'>Eventour</a> 
                          
                        </td>
                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]>
</td><td align='left' valign='top' width='276'>
<![endif]--><div style='display: inline-block; max-width: 276px; vertical-align: top; width: 100%;' class='mobile-full mobile-hide'> 

                    <table class='vb-content' border='0' cellspacing='9' cellpadding='0' width='276' style='border-collapse: separate;width: 100%;text-align: right;' align='left'><tbody><tr><td width='100%' valign='top' style='font-weight: normal; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #ffffff;'>
                      <span style='color: #ffffff; text-decoration: underline;'>
                          <a href='%5Bshow_link%5D' style='text-decoration: underline; color: #ffffff;' target='_new'></a>
                         </span>
                       </td>
                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]>
</td></tr></table><![endif]-->

            </td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><!-- /preheaderBlock --><table class='vb-outer' width='100%' cellpadding='0' border='0' cellspacing='0' bgcolor='#1f497d' style='background-color: #1f497d;' id='ko_singleArticleBlock_3'><tbody><tr><td class='vb-outer' align='center' valign='top' bgcolor='#1f497d' style='padding-left: 9px;padding-right: 9px;background-color: #1f497d;'>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='570'><tr><td align='center' valign='top'><![endif]-->
        <div class='oldwebkit' style='max-width: 570px;'>
        <table width='570' border='0' cellpadding='0' cellspacing='18' class='vb-container fullpad' bgcolor='#ffffff' style='border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 570px;background-color: #fff;'><tbody><tr><td width='100%' valign='top' align='left' class='links-color'>
              
                <img border='0' hspace='0' vspace='0' width='534' class='mobile-full' alt='' style='border: 0px;display: block;vertical-align: top;max-width: 534px;width: 100%;height: auto;' src='https://mosaico.io/srv/f-y7owue1/img?src=https%3A%2F%2Fmosaico.io%2Ffiles%2Fy7owue1%2Fheader_.jpg&amp;method=resize&amp;params=534%2Cnull'></td>
          </tr><tr><td><table align='left' border='0' cellpadding='0' cellspacing='0' width='100%'><tbody><tr><td style='font-size: 18px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f; text-align: left;'>
                <span style='color: #3f3f3f;'>Apreciado Viajero:</span>
              </td>
            </tr><tr><td height='9' style='font-size: 1px; line-height: 1px;'></td>
            </tr><tr><td align='left' class='long-text links-color' style='text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;'><p style='margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;text-align: left;' data-mce-style='text-align: left;'>Su registro se realiz&oacute; exitosamente en nuestro sistema, si usted desea actualizar o modificar informaci&oacute;n, o cargar documentos pendientes, haga clic en el siguiente link:</p></td>
            </tr><tr><td height='13' style='font-size: 1px; line-height: 1px;'></td>
            </tr><tr><td align='center' valign='top'>
                <table cellpadding='0' border='0' cellspacing='0' class='mobile-full'><tbody><tr><td width='auto' valign='middle' bgcolor='#92d050' align='center' height='26' style='font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: center; color: #3f3f3f; font-weight: normal; padding-left: 18px; padding-right: 18px; background-color: #92d050; border-radius: 5px;'>
                      <a style='text-decoration: none; color: #3f3f3f; font-weight: normal;' target='_new' href='https://eventoursport.travel/crm'>https://eventoursport.travel/crm</a>
                    </td>
                  </tr></tbody></table></td>
            </tr></tbody></table></td></tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><table class='vb-outer' width='100%' cellpadding='0' border='0' cellspacing='0' bgcolor='#1f497d' style='background-color: #1f497d;' id='ko_textBlock_4'><tbody><tr><td class='vb-outer' align='center' valign='top' bgcolor='#1f497d' style='padding-left: 9px;padding-right: 9px;background-color: #1f497d;'>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='570'><tr><td align='center' valign='top'><![endif]-->
        <div class='oldwebkit' style='max-width: 570px;'>
        <table width='570' border='0' cellpadding='0' cellspacing='18' class='vb-container fullpad' bgcolor='#ffffff' style='border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 570px;background-color: #fff;'><tbody><tr><td align='left' class='long-text links-color' style='text-align: center; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;'><p style='margin: 1em 0px;margin-top: 0px;'>Al momento de ingresar al sistema, este le solicitara usuario y contrase&ntilde;a:</p><p style='margin: 1em 0px;margin-bottom: 0px;text-align: center;' data-mce-style='text-align: center;'><strong>Usuario:  $usuario<br>Contrase&ntilde;a: $contrasena</strong></p></td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><table class='vb-outer' width='100%' cellpadding='0' border='0' cellspacing='0' bgcolor='#1f497d' style='background-color: #1f497d;' id='ko_doubleArticleBlock_5'><tbody><tr><td class='vb-outer' align='center' valign='top' bgcolor='#1f497d' style='padding-left: 9px;padding-right: 9px;background-color: #1f497d;'>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='570'><tr><td align='center' valign='top'><![endif]-->
        <div class='oldwebkit' style='max-width: 570px;'>
        <table width='570' border='0' cellpadding='0' cellspacing='9' class='vb-row fullpad' bgcolor='#ffffff' style='border-collapse: separate;border-spacing: 9px;width: 100%;max-width: 570px;background-color: #fff;'><tbody><tr><td align='center' valign='top' style='font-size: 0;'>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='552'><tr><![endif]-->
<!--[if (gte mso 9)|(lte ie 8)]><td align='left' valign='top' width='276'><![endif]--> 
<div style='display: inline-block; max-width: 276px; vertical-align: top; width: 100%;' class='mobile-full'> 

                    <table class='vb-content' border='0' cellspacing='9' cellpadding='0' width='276' style='border-collapse: separate;width: 100%;' align='left'><tbody><tr><td style='font-size: 18px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f; text-align: left;'>
                          <span style='color: #3f3f3f;'>Programa</span>
                        </td>
                      </tr><tr><td align='left' class='long-text links-color' style='text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;'><p style='margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;'>Para descargar copia del programa, haga clic aqu&iacute;:</p></td>
                      </tr><tr><td valign='top'>
                          <table cellpadding='0' border='0' align='left' cellspacing='0' class='mobile-full' style='padding-top: 4px;'><tbody><tr><td width='auto' valign='middle' bgcolor='#92d050' align='center' height='26' style='font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: center; color: #3f3f3f; font-weight: normal; padding-left: 18px; padding-right: 18px; background-color: #92d050; border-radius: 5px;'>
                                <a style='text-decoration: none; color: #3f3f3f; font-weight: normal;' target='_new' href='https://eventoursport.travel/crm/impresion/pdf/programa_pdf.php?plan=$plan'>Programa</a>
                              </td>
                            </tr></tbody></table></td>
                      </tr></tbody></table></div><!--[if (gte mso 9)|(lte ie 8)]></td>
<td align='left' valign='top' width='276'>
<![endif]--><div style='display: inline-block; max-width: 276px; vertical-align: top; width: 100%;' class='mobile-full'> 

                    <table class='vb-content' border='0' cellspacing='9' cellpadding='0' width='276' style='border-collapse: separate;width: 100%;' align='right'><tbody><tr><td style='font-size: 18px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f; text-align: left;'>
                          <span style='color: #3f3f3f;'>Contrato</span>
                        </td>
                      </tr><tr><td align='left' class='long-text links-color' style='text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;'><p style='margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;'>Para descargar copia de la aceptaci&oacute;n, haga clic aqu&iacute;:</p></td>
                      </tr><tr><td valign='top'>
                          <table cellpadding='0' border='0' align='left' cellspacing='0' class='mobile-full' style='padding-top: 4px;'><tbody><tr><td width='auto' valign='middle' bgcolor='#92d050' align='center' height='26' style='font-size: 13px; font-family: Arial, Helvetica, sans-serif; text-align: center; color: #3f3f3f; font-weight: normal; padding-left: 18px; padding-right: 18px; background-color: #92d050; border-radius: 5px;'>
                                <a style='text-decoration: none; color: #3f3f3f; font-weight: normal;' target='_new' href='https://eventoursport.travel/crm/impresion/pdf/contrato_pdf.php?firma=$contrasena'>Aceptaci&oacute;n</a>
                              </td>
                            </tr></tbody></table></td>
                      </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td><![endif]-->
<!--[if (gte mso 9)|(lte ie 8)]></tr></table><![endif]-->

            </td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><table class='vb-outer' width='100%' cellpadding='0' border='0' cellspacing='0' bgcolor='#1f497d' style='background-color: #1f497d;' id='ko_textBlock_6'><tbody><tr><td class='vb-outer' align='center' valign='top' bgcolor='#1f497d' style='padding-left: 9px;padding-right: 9px;background-color: #1f497d;'>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='570'><tr><td align='center' valign='top'><![endif]-->
        <div class='oldwebkit' style='max-width: 570px;'>
        <table width='570' border='0' cellpadding='0' cellspacing='18' class='vb-container fullpad' bgcolor='#ffffff' style='border-collapse: separate;border-spacing: 18px;padding-left: 0;padding-right: 0;width: 100%;max-width: 570px;background-color: #fff;'><tbody><tr><td align='left' class='long-text links-color' style='text-align: left; font-size: 13px; font-family: Arial, Helvetica, sans-serif; color: #3f3f3f;'><p style='margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;text-align: center;' data-mce-style='text-align: center;'> Estamos atentos a cualquier informaci&oacute;n adicional que requiera.</p></td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><!-- footerBlock --><table width='100%' cellpadding='0' border='0' cellspacing='0' bgcolor='#002060' style='background-color: #002060;' id='ko_footerBlock_2'><tbody><tr><td align='center' valign='top' bgcolor='#002060' style='background-color: #002060;'>

<!--[if (gte mso 9)|(lte ie 8)]><table align='center' border='0' cellspacing='0' cellpadding='0' width='570'><tr><td align='center' valign='top'><![endif]-->
        <div class='oldwebkit' style='max-width: 570px;'>
        <table width='570' style='border-collapse: separate;border-spacing: 9px;padding-left: 9px;padding-right: 9px;width: 100%;max-width: 570px;' border='0' cellpadding='0' cellspacing='9' class='vb-container halfpad' align='center'><tbody><tr><td class='long-text links-color' style='text-align: center; font-size: 13px; color: #ffffff; font-weight: normal; text-align: center; font-family: Arial, Helvetica, sans-serif;'><p style='margin: 1em 0px;margin-bottom: 0px;margin-top: 0px;'><strong>EVENTOUR SPORT</strong><br>Avenida 5C Norte No. 23DN-35<br><a href='tel:(2)%206604000' target='_blank' style='color: #fff;text-decoration: underline;'>57 2 6604000</a><br>+57 320 677 9116<br><a href='http://www.eventoursport.travel/' target='_blank' data-saferedirecturl='http://www.eventoursport.travel/' style='color: #fff;text-decoration: underline;'>www.eventoursport.travel</a><strong><u></u><u></u></strong></p></td></tr><tr><td style='text-align: center;'>
              
            </td>
          </tr><tr style='text-align: center;'><td align='center'>&nbsp;</td>
          </tr></tbody></table></div>
<!--[if (gte mso 9)|(lte ie 8)]></td></tr></table><![endif]-->
      </td>
    </tr></tbody></table><!-- /footerBlock --></center>

</body></html>
";

$data = array( "to" => array("jdmal2004@gmail.com"=>"Jose David Maldonado"),
		//	"cc" => array("cc@example.net"=>"cc whom!"),
		//	"bcc" =>array("bcc@example.net"=>"bcc whom!"),
			"from" => array("info@eventours.travel","Eventours"),
			"replyto" => array("info@eventours.travel","Eventours"),
			"subject" => "Prueba",
			//"text" => "This is the text",
			  
			  
			  
			"html" => $contenido,
			"attachment" => array(),
			"headers" => array("Content-Type"=> "text/html; charset=iso-8859-1")
);

var_dump($mailin->send_email($data));

?>