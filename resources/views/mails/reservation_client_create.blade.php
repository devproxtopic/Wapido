<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reservación Creada</title>
  <!-- Designed by https://github.com/kaytcat -->
  <!-- Header image designed by Freepik.com -->


  <style type="text/css">
  /* Take care of image borders and formatting */

  img { max-width: 600px; outline: none; text-decoration: none; -ms-interpolation-mode: bicubic;}
  a img { border: none; }
  table { border-collapse: collapse !important; }
  #outlook a { padding:0; }
  .ReadMsgBody { width: 100%; }
  .ExternalClass {width:100%;}
  .backgroundTable {margin:0 auto; padding:0; width:100% !important;}
  table td {border-collapse: collapse;}
  .ExternalClass * {line-height: 115%;}


  /* General styling */

  td {
    font-family: Arial, sans-serif;
    color: #6f6f6f;
  }

  body {
    -webkit-font-smoothing:antialiased;
    -webkit-text-size-adjust:none;
    width: 100%;
    height: 100%;
    color: #6f6f6f;
    font-weight: 400;
    font-size: 18px;
  }


  h1 {
    margin: 10px 0;
  }

  a {
    color: #27aa90;
    text-decoration: none;
  }

  .force-full-width {
    width: 100% !important;
  }

  .force-width-80 {
    width: 80% !important;
  }


  .body-padding {
    padding: 0 75px;
  }

  .mobile-align {
    text-align: right;
  }



  </style>

  <style type="text/css" media="screen">
      @media screen {
        @import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,900);
        /* Thanks Outlook 2013! */
        * {
          font-family: 'Source Sans Pro', 'Helvetica Neue', 'Arial', 'sans-serif' !important;
        }
        .w280 {
          width: 280px !important;
        }

      }
  </style>

  <style type="text/css" media="only screen and (max-width: 480px)">
    /* Mobile styles */
    @media only screen and (max-width: 480px) {

      table[class*="w320"] {
        width: 320px !important;
      }

      td[class*="w320"] {
        width: 280px !important;
        padding-left: 20px !important;
        padding-right: 20px !important;
      }

      img[class*="w320"] {
        width: 250px !important;
        height: 67px !important;
      }

      td[class*="mobile-spacing"] {
        padding-top: 10px !important;
        padding-bottom: 10px !important;
      }

      *[class*="mobile-hide"] {
        display: none !important;
      }

      *[class*="mobile-br"] {
        font-size: 12px !important;
      }

      td[class*="mobile-w20"] {
        width: 20px !important;
      }

      img[class*="mobile-w20"] {
        width: 20px !important;
      }

      td[class*="mobile-center"] {
        text-align: center !important;
      }

      table[class*="w100p"] {
        width: 100% !important;
      }

      td[class*="activate-now"] {
        padding-right: 0 !important;
        padding-top: 20px !important;
      }

      td[class*="mobile-block"] {
        display: block !important;
      }

      td[class*="mobile-align"] {
        text-align: left !important;
      }

    }
  </style>
</head>
<body  offset="0" class="body" style="padding:0; margin:0; display:block; background:#eeebeb; -webkit-text-size-adjust:none" bgcolor="#eeebeb">
<table align="center" cellpadding="0" cellspacing="0" width="100%" height="100%">
  <tr>
    <td align="center" valign="top" style="background-color:#eeebeb" width="100%">

    <center>

      <table cellspacing="0" cellpadding="0" width="600" class="w320">
        <tr>
          <td align="center" valign="top">


          <table style="margin:0 auto;" cellspacing="0" cellpadding="0" width="100%">
            <tr>
              <td style="text-align: center;">
                <img src="{{ asset($reservation->owner->logo) }}" width="20%">
                <a href="#" style="font-family: -apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Helvetica,Arial,sans-serif,'Apple Color Emoji','Segoe UI Emoji','Segoe UI Symbol';box-sizing: border-box;color: #bbbfc3;font-size: 19px;font-weight: bold;text-decoration: none;">{{ $reservation->owner->name }}</a>
              </td>
            </tr>
          </table>


          <table cellspacing="0" cellpadding="0" class="force-full-width" style="background-color:#3bcdb0;">
            <tr>
              <td style="background-color:#3bcdb0;">

                <table cellspacing="0" cellpadding="0" class="force-full-width">
                  <tr>
                    <td style="font-size:18px; font-weight: 600; color: #ffffff; text-align:center;" class="mobile-spacing">
                    <div class="mobile-br">&nbsp;</div>
                      Su reservación ha sido realizada con éxito.
                    <br>
                    </td>
                  </tr>
                </table>

              </td>
            </tr>
          </table>

          <table cellspacing="0" cellpadding="0" class="force-full-width" bgcolor="#ffffff" >
            <tr>
              <td style="background-color:#ffffff; padding-top: 15px;">

                <center>
                    <table style="margin:0 auto;" cellspacing="0" cellpadding="0" class="force-width-80">
                        <tr>
                                <td style="font-size:16px; font-weight: 600; color:#6f6f6f; text-align:center;" class="mobile-spacing">
                                    Hola {{ $reservation->client->fullname }}, tu reservación a {{ $reservation->owner->name }} ha sido realizada con éxito.
                                    <br>
                                    En poco tiempo te contactaran para confirmar la reservación.<br>
                                    Muchas gracias, le esperamos.
                                </td>
                        </tr>
                    </table>
                </center>


              <table cellspacing="0" cellpadding="0" bgcolor="#363636"  class="force-full-width">

                <tr>
                  <td style="color:#f0f0f0; font-size: 14px; text-align:center; padding-bottom:4px; padding:14px 0px; ">
                    <center><img src="{{ asset('img/wapido_logo2.png') }}" width="20%"></center> <br>
                    © Pedido realizado por <a href="http://wapido.com">Wapido</a>. Todos los derechos reservados
                  </td>
                </tr>
                <tr>
                  <td style="font-size:12px;">
                    &nbsp;
                  </td>
                </tr>
              </table>

              </td>
            </tr>
          </table>







          </td>
        </tr>
      </table>

    </center>




    </td>
  </tr>
</table>
</body>
</html>
