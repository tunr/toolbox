
<?php $this->load->view('header'); ?>

<h2><span class="left">Project Tools</span><span class="right pagetitlelink"><?php echo $layout_link; ?></span><div class="clear"></div></h2>
<hr class="small">
<div class="projtools">

<div id="Hint_1" class="hint primary hide">
<div>Project tools hint</div>
</div>

<div id="toolbox">
<div id="toolboxshow" class="rollmenu">

<?php
//dump($toolbox_show_list);
?>

<?php if ( ! empty($toolbox_show_list)): ?>
  <?php foreach($toolbox_show_list as $row): ?>
    <a href="#" id="tool_<?php echo $row['id']; ?>" name="<?php echo $row['name']; ?>" class="toolboxitem">
    <h5><img src="<?php echo base_url(); ?>img/icon/<?php echo $row['icon']; ?>" class="png"><?php echo $row['name']; ?></h5>
    <span></span>
    </a>
  <?php endforeach; ?>
<?php endif; ?>

<span style="display: none;" class="toolboxempty">No tools are shown</span>
</div>

<div class="clear"></div> <!-- rollmenu --> 
<div class="clear"></div>

<div class="formsection clear">
<a href="#" tabindex="10" id="toolboxhide_toggle" class="toggle" rel="toolboxhide">Hidden Tools</a>
</div>

<div id="toolboxhide" class="rollmenu hidden hide">

<?php if ( ! empty($toolbox_hide_list)): ?>
  <?php foreach($toolbox_hide_list as $row): ?>
    <a href="#" id="tool_<?php echo $row['id']; ?>" name="<?php echo $row['name']; ?>" class="toolboxitem">
    <h5><img src="<?php echo base_url(); ?>img/icon/<?php echo $row['icon']; ?>" class="png"><?php echo $row['name']; ?></h5>
    <span></span>
    </a>
  <?php endforeach; ?>
<?php endif; ?>

<span style="display: none;" class="toolboxempty">No tools are hidden</span>
</div>

<div class="clear"></div> <!-- rollmenu --> 
<div class="clear"></div>

<div id="Hint_2" class="hint hide">
<div>Hiden tools hint</div></div>
</div>

<div id="toolboxdefault">
<a href="<?php echo base_url(); ?>reset/">Apply Default Toolbox Settings</a>
<!--<div>Set by Project Manager <span title="Oct 28, 2009">Last Month</span></div>-->
</div>

<div id="Hint_3" class="hint down padup hide">
<div>Set default tools hint</div></div>
<hr>

<div class="nextback"><h5>What Now?</h5>
<ul class="nextstep">
<li><a href="#">Return to Project Homepage</a></li>
</ul>

</div>
</div> <!-- projtools -->

<div class="minwidth"></div>

<input type="hidden" id="layout_mode" value="<?php echo $layout_mode; ?>"/>

<?php $this->load->view('footer'); ?>

