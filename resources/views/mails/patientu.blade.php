<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <!--[if mso]>
  <style>
    table {border-collapse:collapse;border-spacing:0;border:none;margin:0;}
    div, td {padding:0;}
    div {margin:0 !important;}
  </style>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-family: Arial, sans-serif;
        }

        @media screen and (max-width: 530px) {
            .unsub {
                display: block;
                padding: 8px;
                margin-top: 14px;
                border-radius: 6px;
                background-color: #555555;
                text-decoration: none !important;
                font-weight: bold;
            }

            .col-lge {
                max-width: 100% !important;
            }
        }

        @media screen and (min-width: 531px) {
            .col-sml {
                max-width: 27% !important;
            }

            .col-lge {
                max-width: 73% !important;
            }
        }
    </style>
</head>

<body style="margin:0;padding:0;word-spacing:normal;background-color:#939297;">
    <div role="article" aria-roledescription="email" lang="en"
        style="text-size-adjust:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;background-color:#939297;">
        <table role="presentation" style="width:100%;border:none;border-spacing:0;">
            <tr>
                <td align="center" style="padding:0;">
                    <!--[if mso]>
          <table role="presentation" align="center" style="width:600px;">
          <tr>
          <td>
          <![endif]-->
                    <table role="presentation"
                        style="width:94%;max-width:600px;border:none;border-spacing:0;text-align:left;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                        <tr>
                            <td style="padding:40px 30px 30px 30px;text-align:center;font-size:24px;font-weight:bold;">
                                <a href="{{ route('dashboard') }}"
                                    style="width:165px;max-width:80%;height:auto;border:none;text-decoration:none;color:#ffffff;">{{config('app.name')}}</a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:30px;background-color:#ffffff;">
                                <h1
                                    style="margin-top:0;margin-bottom:16px;font-size:26px;line-height:32px;font-weight:bold;letter-spacing:-0.02em;">
                                    Se le ha actualizado su cita!</h1>
                                <p style="margin:0;">{{ $appointment->user->fullName }} le ha agendado una cita en la
                                    clínica {{ $appointment->organization->name }}, con fecha {{ $appointment->init }}.</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding:0;font-size:24px;line-height:28px;font-weight:bold;">
                                <a href="{{ route('dashboard') }}" style="text-decoration:none;"><img
                                        src="{{ asset('imgs/pexels-thirdman-7659873.jpg') }}" width="600" alt=""
                                        style="width:100%;height:auto;display:block;border:none;text-decoration:none;color:#363636;"></a>
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="padding:35px 30px 11px 30px;font-size:0;background-color:#ffffff;border-bottom:1px solid #f0f0f5;border-color:rgba(201,201,207,.35);">
                                <!--[if mso]>
                <table role="presentation" width="100%">
                <tr>
                <td style="width:145px;" align="left" valign="top">
                <![endif]-->
                                <div class="col-sml"
                                    style="display:inline-block;width:100%;max-width:145px;vertical-align:top;text-align:left;font-family:Arial,sans-serif;font-size:14px;color:#363636;">
                                    <img src="{{ $appointment->patient->avatar }}" width="115" alt=""
                                        style="width:115px;max-width:80%;margin-bottom:20px;">
                                </div>
                                <!--[if mso]>
                </td>
                <td style="width:395px;padding-bottom:20px;" valign="top">
                <![endif]-->
                                <div class="col-lge"
                                    style="display:inline-block;width:100%;max-width:395px;vertical-align:top;padding-bottom:20px;font-family:Arial,sans-serif;font-size:16px;line-height:22px;color:#363636;">
                                    <p style="margin-top:0;margin-bottom:12px;">Nombre completo: {{ $appointment->patient->fullName }}</p>
                                    <p style="margin-top:0;margin-bottom:12px;">Fecha de inicio: {{ $appointment->init }}</p>                                   
                                    <p style="margin-top:0;margin-bottom:12px;">Estado: {{ $appointment->state }}</p>                                   
                                    <p style="margin-top:0;margin-bottom:12px;">Observación: {{ $appointment->observation }}</p>                                   
                                    
                                </div>
                                <!--[if mso]>
                </td>
                </tr>
                </table>
                <![endif]-->
                            </td>
                        </tr>
                        <tr>
                            <td
                                style="padding:30px;text-align:center;font-size:12px;background-color:#404040;color:#cccccc;">
                                <p style="margin:0 0 8px 0;"><a href="http://www.facebook.com/"
                                        style="text-decoration:none;">
                                        {{ Metronic::getSVG("media/svg/social-icons/facebook.svg", "") }}
                                    </a>
                                    <a href="http://www.twitter.com/" style="text-decoration:none;">
                                        {{ Metronic::getSVG("media/svg/social-icons/twitter.svg", "") }}</a>
                                </p>
                                <p style="margin:0;font-size:14px;line-height:20px;">&reg; {{ config('app.name') }},
                                    ONISOFT 2021</p>
                            </td>
                        </tr>
                    </table>
                    <!--[if mso]>
          </td>
          </tr>
          </table>
          <![endif]-->
                </td>
            </tr>
        </table>
    </div>
</body>

</html>