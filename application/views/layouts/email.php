<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<table width="600" align="center" cellpadding="0" cellspacing="0">
    	<tr>
        	<td width="199"><img src="<?php echo base_url(); ?>static/img/assinatura-job.png" width="47" height="47" />
        		</td>
          <td width="389" style="font-family:Arial; font-size:11px; color:#ffffff;">
          	<span style="font-family:Arial; font-size:11px; color:#ffffff;"><?php echo date('d/m/Y H:i:s')?></span>
          </td>
        </tr>
        <tr>
        	<td colspan="2" style="padding-left:10px; font-family:Arial; font-size:22px; font-weight:bold; letter-spacing:-1px; color:#ffffff;">
            	<?php echo $titulo; ?>
            </td>
        </tr>
        <tr>
        	<td height="61" colspan="2" style="padding:20px 10px 10px 10px; font-family: Arial; font-size:12px;"><?php echo $template['body']; ?>
            </td>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
         <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
         <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
        <tr>
           		<td colspan="2" align="center" style="padding:10px; font-family: Arial; font-size:10px;"><a style="text-decoration:none; color:#000000;" href="http://www.jobdesign.com.br">jobdesign.com.br</a> <?php echo date('Y'); ?>
                </td>
            </tr>
        </table>
</body>
</html>
