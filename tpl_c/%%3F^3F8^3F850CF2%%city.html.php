<?php /* Smarty version 2.6.16, created on 2012-08-17 16:27:45
         compiled from city.html */ ?>
<select name="ajaxcity" id="ajaxcity"  onchange="ajax_City()">
	<?php if ($this->_tpl_vars['cityArr'] != ""): ?>
	<option value="" >请选择</option>
	<?php $_from = $this->_tpl_vars['cityArr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['show'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['show']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['row']):
        $this->_foreach['show']['iteration']++;
?>
		<option value=<?php echo $this->_tpl_vars['row']; ?>
><?php echo $this->_tpl_vars['row']; ?>
</option>
	<?php endforeach; endif; unset($_from); ?>
	<?php else: ?>
		<option value="" >请选择</option>
	<?php endif; ?>
</select>