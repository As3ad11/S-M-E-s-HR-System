<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Payslip Template</title>
    <meta name="author" content="Vertex42.com" />
    <style type="text/css">
      * {
        margin: 0;
        padding: 0;
        text-indent: 0;
      }

      h2 {
        color: #3573A7;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 22pt;
      }

      .h1 {
        color: #3573A7;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 25.5pt;
        vertical-align: -1pt;
      }

      .s1 {
        color: #28567C;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
      }

      .a,
      a {
        color: #28567C;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
      }

      h4 {
        color: #FFF;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 8pt;
      }

      .s2 {
        color: #FFF;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 8pt;
      }

      .s3 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 8pt;
      }

      h3 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 10pt;
      }

      p {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
        margin: 0pt;
      }

      .s4 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
      }

      .s6 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: normal;
        text-decoration: none;
        font-size: 8pt;
      }

      .s7 {
        color: black;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 10pt;
      }

      .s8 {
        color: #FFF;
        font-family: Arial, sans-serif;
        font-style: normal;
        font-weight: bold;
        text-decoration: none;
        font-size: 10pt;
      }

      table,
      tbody {
        vertical-align: top;
        overflow: visible;
      }
    </style>
  </head>
  <body style="padding:25px">
    <h2 style="padding-top: 4pt;padding-left: 9pt;text-indent: 0pt;text-align: left;"><span class="h1">PAYSLIP</span>
    </h2>
    <p style="text-indent: 0pt;text-align: left;">
      <br />
    </p>
    <h4 style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">EMPLOYEE INFORMATION</h4>
    <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;" />
    <table style="border-collapse:collapse" cellspacing="0">
      <tr style="height:19pt">
        <td style="width:88pt;border-right-style:solid;border-right-width:3pt;border-right-color:#FFFFFF" bgcolor="#7AACD4">
          <p class="s2" style="padding-top: 4pt;padding-left: 19pt;padding-right: 18pt;text-indent: 0pt;text-align: center;">PAY DATE</p>
        </td>
      </tr>
      <tr style="height:19pt">
        <td style="width:88pt;border-right-style:solid;border-right-width:3pt;border-right-color:#FFFFFF" bgcolor="#D2E1EF">
          <p class="s3" style="padding-top: 4pt;padding-left: 19pt;padding-right: 18pt;text-indent: 0pt;text-align: center;">2019-06-10</p>
        </td>
      </tr>
    </table>
    <p style="text-indent: 0pt;text-align: left;" />
    <h3 style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">{{ $payslip->Profile->fullname() }}</h3>
    <p style="padding-top: 8pt;padding-left: 7pt;text-indent: 0pt;line-height: 202%;text-align: left;">{{ $payslip->Profile->address }} Phone: {{ $payslip->Profile->phone }}</p>
    <p style="padding-left: 7pt;text-indent: 0pt;text-align: left;">
      <a href="mailto:{{ $payslip->Profile->User->email }}" class="s4" target="_blank">Email: </a>{{ $payslip->Profile->User->email }}
    </p>
    <p style="text-indent: 0pt;text-align: left;">
      <br />
    </p>
    <p style="text-indent: 0pt;text-align: left;">
      <br />
    </p>
    <table style="border-collapse:collapse;margin-left:5.88pt" cellspacing="0">
      <tr style="height:19pt">
        <td style="width:400pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#DDDDDD">
          <p class="s3" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">EARNINGS</p>
        </td>
        <td style="width:87pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#B1B1B1">
          <p class="s3" style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">AMOUNT</p>
        </td>
      </tr>
      <tr style="height:18pt">
        <td style="width:400pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999">
          <p class="s6" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">Basic</p>
        </td>
        <td style="width:87pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#F1F1F1">
          <p class="s6" style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">{{ $payslip->basic }}</p>
        </td>
      </tr>
      <tr style="height:18pt">
        <td style="width:400pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999">
          <p class="s6" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">Overtime</p>
        </td>
        <td style="width:87pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#F1F1F1">
          <p class="s6" style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">{{ $payslip->overtime }}</p>
        </td>
      </tr>

      <tr style="height:18pt">
        <td style="width:400pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999">
          <p class="s6" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">Commision</p>
        </td>
        <td style="width:87pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#F1F1F1">
          <p class="s6" style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">{{ $payslip->commision }}</p>
        </td>
      </tr>
      <tr style="height:18pt">
        <td style="width:124pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#DDDDDD">
          <p style="text-indent: 0pt;text-align: left;">
            <br />
          </p>
        </td>
        <td style="width:87pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#B1B1B1">
          <p class="s8" style="padding-top: 3pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">RM {{ $payslip->basic + $payslip->overtime + $payslip->commision }}</p>
        </td>
      </tr>
    </table>
    <p style="text-indent: 0pt;text-align: left;">
      <br />
    </p>
    <p style="text-indent: 0pt;text-align: left;">
      <br />
    </p>
    <table style="border-collapse:collapse;margin-left:5.88pt" cellspacing="0">
        <tr style="height:19pt">
          <td style="width:400pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#DDDDDD">
            <p class="s3" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">DEDUCTION</p>
          </td>
          <td style="width:87pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#B1B1B1">
            <p class="s3" style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">AMOUNT</p>
          </td>
        </tr>
        <tr style="height:18pt">
          <td style="width:400pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999">
            <p class="s6" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">EPF</p>
          </td>
          <td style="width:87pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#F1F1F1">
            <p class="s6" style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">{{ $payslip->epf }}</p>
          </td>
        </tr>
        <tr style="height:18pt">
          <td style="width:400pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999">
            <p class="s6" style="padding-top: 4pt;padding-left: 1pt;text-indent: 0pt;text-align: left;">SOCSO</p>
          </td>
          <td style="width:87pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#F1F1F1">
            <p class="s6" style="padding-top: 4pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">{{ $payslip->socso }}</p>
          </td>
        </tr>
        <tr style="height:18pt">
          <td style="width:124pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#DDDDDD">
            <p style="text-indent: 0pt;text-align: left;">
              <br />
            </p>
          </td>
          <td style="width:87pt;border-top-style:solid;border-top-width:1pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#999999" bgcolor="#B1B1B1">
            <p class="s8" style="padding-top: 3pt;padding-right: 1pt;text-indent: 0pt;text-align: right;">RM {{ $payslip->epf + $payslip->socso }}</p>
          </td>
        </tr>
      </table>
    <p style="text-indent: 0pt;text-align: left;">
      <br />
    </p>
    <p style="text-indent: 0pt;text-align: left;">
      <br />
    </p>
    <table style="border-collapse:collapse;margin-left:256.13pt" cellspacing="0">
      <tr style="height:17pt">
        <td style="width:150pt;border-top-style:solid;border-top-width:2pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#999999" bgcolor="#DDDDDD">
          <p class="s7" style="padding-top: 2pt;padding-left: 33pt;text-indent: 0pt;text-align: left;">NET PAY</p>
        </td>
        <td style="width:87pt;border-top-style:solid;border-top-width:2pt;border-top-color:#999999;border-bottom-style:solid;border-bottom-width:2pt;border-bottom-color:#999999" bgcolor="#B1B1B1">
          <p class="s7" style="padding-top: 2pt;padding-left: 40pt;text-indent: 0pt;text-align: left;">RM {{ ($payslip->basic + $payslip->overtime + $payslip->commision) - ($payslip->epf + $payslip->socso) }}</p>
        </td>
      </tr>
    </table>
  </body>
</html>
