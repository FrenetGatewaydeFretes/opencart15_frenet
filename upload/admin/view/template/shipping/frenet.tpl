<?php echo $header; ?>
<div id="content">
<div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
</div>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
<div class="heading">
    <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
</div>
<div class="content">
<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
<table class="form">
<tr>
    <td><span class="required">*</span> <?php echo $entry_postcode; ?><br />
    </td>
    <td><input name="frenet_postcode" type="text" id="frenet_postcode" value="<?php echo $frenet_postcode; ?>" />
        <?php if ($error_postcode) { ?>
        <span class="error"><?php echo $error_postcode; ?></span>
        <?php  } ?>
    </td>
</tr>
<tr>
    <td><span class="required">*</span> <?php echo $entry_msg_prazo; ?><br />
    </td>
    <td><input name="frenet_msg_prazo" type="text" id="frenet_msg_prazo" value="<?php echo $frenet_msg_prazo; ?>" />
        <?php if ($error_postcode) { ?>
        <span class="error"><?php echo $error_postcode; ?></span>
        <?php  } ?>
    </td>
</tr>
<tr>
    <td><?php echo $help_frenet_key; ?><br />
    </td>
    <td>
        <?php echo $entry_frenet_key_codigo; ?><br /><input name="frenet_contrato_codigo" type="text" id="frenet_contrato_codigo" value="<?php echo $frenet_contrato_codigo; ?>" /><br/>
        <?php echo $entry_frenet_key_senha; ?><br /><input name="frenet_contrato_senha" type="text" id="frenet_contrato_senha" value="<?php echo $frenet_contrato_senha; ?>" />
    </td>
</tr>
<tr>
    <td width="25%"><?php echo $entry_status; ?></td>
    <td><select name="frenet_status">
            <?php if ($frenet_status) { ?>
            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
            <option value="0"><?php echo $text_disabled; ?></option>
            <?php } else { ?>
            <option value="1"><?php echo $text_enabled; ?></option>
            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
            <?php } ?>
        </select></td>
</tr>
<tr>
    <td><?php echo $entry_sort_order; ?></td>
    <td><input type="text" name="frenet_sort_order" value="<?php echo $frenet_sort_order; ?>" size="1" /></td>
</tr>
</table>
</form>
</div>
</div>
</div>
<?php echo $footer; ?>
