<?php 
/*------------------------------------------------------------------------
# smartslider - Smart Slider
# ------------------------------------------------------------------------
# author    Roland Soos 
# copyright Copyright (C) 2011 Offlajn.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.offlajn.com
-------------------------------------------------------------------------*/
?>
<?php
defined('_JEXEC') or die('Restricted access');
?>
<script type="text/javascript">
var captions = new Array;
</script>
<div id="<?php echo $id; ?>">
  <div class="controllLeft"></div>
  <div class="controllRight"></div>
  <div class="slinner">
    <div class="frame1 frame"><div></div></div>
    <div class="frame2 frame"><div></div></div>
    
    <div class="mainframe">
      <div class="mainframeinner">
        <div class="mainframeinner2">
          <div class="mainframepipe">
            <?php 
            $x=0;
            foreach($tthis->slides as $slide): 
              $classes = array();
              if($x == 0)
                $classes[] = 'selected';
                
              $class = implode(' ', $classes);
              ?>
              <div class="<?php echo $class; ?> sslide">
                <script type="text/javascript">
                  captions[<?php echo $x; ?>] = new Array;
                </script>
                <?php $child = $slide->childs[0] ?>
                <div class="canvas">
                  <?php echo $context['helper']->modulePositionReplacer($child->content); ?>
                </div>
                <script type="text/javascript">
                  var caption = null;
                </script>
                <div class="caption">
                  <?php echo $child->caption; ?>
                </div>
                <script type="text/javascript">
                  captions[<?php echo $x; ?>] = caption;
                </script>
              </div>
            <?php ++$x; endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="shadow"></div>
  <div class="controll" style="width: <?php echo count($tthis->slides)*56+2+43; ?>px;">
  <?php
  for($x=0; $x < count($tthis->slides); ++$x): 
  ?>
  <div class="dot <?php if($x==0) echo 'selected first'; ?>"></div>
  <?php
  endfor;
  ?>
  <div class="last"></div>
  </div>
</div>
<script type="text/javascript">
var <?php echo $id?>captions = sliderDojo.clone(captions);
sliderDojo.addOnLoad(sliderDojo, function(){
  var dojo = sliderDojo;
  new OfflajnSliderPhoto({
    node: dojo.byId('<?php echo $id; ?>'),
    rawcaptions: <?php echo $id?>captions,
    autoplay: <?php echo $tthis->slider->params->get('autoplay', 0); ?>,
    autoplayinterval: <?php echo $tthis->slider->params->get('autoplayinterval', 5000); ?>,
    restartautoplay: <?php echo $tthis->slider->params->get('restartautoplay', 0); ?>,
    maineasing: <?php echo $tthis->slider->params->get('maineasing'); ?>,
    maininterval: <?php echo $tthis->slider->params->get('maininterval'); ?>,
    mousescroll: <?php echo $tthis->slider->params->get('mousescroll', 1); ?>,
    transition: <?php echo $tthis->slider->params->get('transition', 1); ?>
  });
});
</script>