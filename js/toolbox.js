
$(document).ready(function() {
  
  /* ===============================================================================================
  |  VISIBILITY TOGGLE FUNCTIOALITY
  ================================================================================================*/
  
  // BIND ONCLICK TOGGLE EVENT
  $('.toggle').click(function() {
    var id  = $(this).attr('id');
    var rel = $(this).attr('rel');
    
    $('#' + rel).toggle();
    return false;
  });
  
  // DETERMINE ONCLICK TOGGLE STATE
  $('.hidden').each(function() {
    var id    = $(this).attr('id');
    var value = $('#' + id + '_toggle').attr('value');
    var show  = $('#' + id).attr('rel');
    show      = (show == undefined) ? 1 : show;
    
    $('#output').append('value: ' + value + ' | show: ' + show + '<Br>');
    
    $(this).toggle(value == show);
    
    return false;
  });
  
  // BIND ONCHANGE VIEW EVENT
  $('.change').change(function() {
    var name  = $(this).attr('name');
    var id    = $(this).attr('rel');
    var value = $(this).val();
    
    if (id.indexOf(value) >= 0)
    {
      $('#' + name + '_change').fadeIn('medium');
    }
    else
    {
      $('#' + name + '_change').fadeOut('medium');
    }
    return false;
  });
  
  // DETERMINE ONCHANGE VIEW STATE
  $('.select_change').each(function() {
    var name  = $(this).attr('id').replace('_change', '');
    var id    = $('#' + name).attr('rel');
    var value = $('#' + name).val();
    
    $(this).toggle(id.indexOf(value) >= 0);
    
    return false;
  });
  
  // HIDE HIDDEN TOOLS BOX AND MENU SORT BASE BY DEFAULT
  //$('#toolboxhide').hide();
  //$('#menusortbase').hide();
  
  /* ---------------------------------------------------------------------
  |  DETERMINE LAYOUT MODE
  ----------------------------------------------------------------------*/
  
  layout_mode = ($('#layout_mode').val() == '1') ? true : false;
  
  if (layout_mode == 1){
    
    // ADD HANDLE GRAPHIC CLASS
    $('.toolboxitem span').addClass('handle')
    
    // ADD BORDER TO MENU DROPPABLE BLOCK
    $('.navset.project .nav:eq(0)').addClass('menudropborder');
    
    // HIDE HIDDEN TOOLS BLOCK AND MENU SORT BASE BY DEFAULT
    $('#toolboxhide').show();
    
    // ADD DROP BOXES TO PROJECT TOOLS MENU AND BODY
    $(".navset.project .nav:eq(0)").append('<li class="menudrop">Drag Project Tools Here</li>');
    $("#toolbox").before('<div class="menudropoff">Drag Project Tools from the left-hand menu to remove them.</div>');
    
    // TOOLBOX SORTABLES
    $('#toolboxshow, #toolboxhide').sortable({
      cursor: 'move',
      items: '.toolboxitem',
      connectWith: '.rollmenu',
      helper: 'clone',
      tolerance: 'pointer',
      placeholder: 'placeholder',
      forcePlaceholderSize: true,
      revert: true,
      update: function(event, ui) {
        
        var item_id = $(ui.item).attr('id').split('_')[1];
        var item_parent_id = $(ui.item).parent().attr('id');
        var parent_id = $(this).attr('id');
        
        // PREVENT EVENT FROM FIRING TWICE
        if (parent_id == item_parent_id){
          var show_serial = $('#toolboxshow').sortable('serialize', { key: 'show[]' });
          var hide_serial = $('#toolboxhide').sortable('serialize', { key: 'hide[]' });
          var hide = (parent_id == 'toolboxhide') ? 1 : 0;
          
          // SET TOOLBOX ORDER
          $.ajax({
            type: 'POST',
            url: base_url + 'tool_sort',
            data: show_serial + '&' + hide_serial,
            success: function(output){
              $('#toolboxshow p.clear').remove();
              $('#toolboxhide p.clear').remove();
              //out(output);
            }
          });
          
          setEmptyToolbox();
        }
      }
    });
    
    // MENU SORTABLE
    $(".navset.project .nav:eq(0)").sortable({
      cursor: 'move',
      //cancel: '.navset.project .nav:eq(0)',
      items: '.menu_sort',
      revert: true,
      update: function(event, ui) {
        
        var item_id = $(ui.item).attr('id').split('_')[1];
        var menu_serial = $(this).sortable("serialize", { key: "menu[]" });
        
        // SET PROJECT TOOLS MENU ORDER
        $.ajax({
          type: 'POST',
          url: base_url + 'menu_set',
          data: menu_serial,
          success: function(output){  
            //out(output);
          }
        });
      }
    });
    
    // MENU ADD DROPPABLE
    $('.navset.project .nav:eq(0)').droppable({
      accept: '.toolboxitem',
      tolerance: "pointer",
      drop: function(event, ui) {
        
        // COLLECT VARIABLE VALUES
        var item_id  = $(ui.draggable).attr('id');
        var item_num = item_id.split('_')[1];
        var item_name = $('#' + item_id).attr('name');
        
        if ($('#menu_' + item_num).length == 0) {  
          
          $('#menusortbase').before('<li class="menu_sort" id="menu_' + item_num + '" style=""><a class="itemtxt" href="#">' + item_name + '</a></li>');
          
          var menu_serial = $(this).sortable("serialize", { key: "menu[]" });
          
          // ADD PROJECT TOOLS MENU ITEM
          $.ajax({
            type: 'POST',
            url: base_url + 'menu_set',
            data: menu_serial,
            success: function(output){
              //out(output);
            }
          });
        }
      }
    });
    
    // MENU REMOVE DROPPABLE
    $('.menudropoff').droppable({
      accept: '.menu_sort',
      tolerance: "pointer",
      drop: function(event, ui) {
        
        // COLLECT VARIABLE VALUES
        var item_id  = $(ui.draggable).attr('id');
        var item_num = item_id.split('_')[1];
        
        if ($('#menu_' + item_num).length > 0) {
          
          $('#menu_' + item_num).remove();
           
          var menu_serial = $('.navset.project .nav:eq(0)').sortable("serialize", { key: "menu[]" });
           
          // ADD PROJECT TOOLS MENU ITEM
          $.ajax({
            type: 'POST',
            url: base_url + 'menu_set',
            data: menu_serial,
            success: function(output){
              //out(output);
            }
          });
        }
      }
    });
  
  }
  
  // END LAYOUT MODE ---------------------------------------------------------------

  // CHECK FOR EMPTY TOOLBOX LIST
  setEmptyToolbox();
  
  // PROCESS EMPTY TOOLBOX
  function setEmptyToolbox() {
    $('#toolboxshow, #toolboxhide').each(function() {
    
      var count = $(this).children('.toolboxitem').size();
      
      if (count > 0) {
        $(this).removeClass('toolboxheight');
        $(this).children('span').hide();
        
      } else {
        $(this).addClass('toolboxheight');
        $(this).children('span').show();
      }
    });
  }
  
  // ==================================================================================================
  
  // INITIALIZE HINTS
  if ($('.hint').size() > 0) {
    $('.hinticon').show();
    if ($.cookie('HintState') == '1') $('.hint').show();
  } else {
    $('.hinticon').hide();
  }
  
  // BIND HINT ICON CLICK ACTION
  $('.hinticon').click(function() {
    var bHintState = ($.cookie('HintState') == '1') ? 0 : 1 ;
    $('.hint').toggle(bHintState == 1);
    $.cookie('HintState', bHintState, { path: '/' });
  });
  
  // CREATE INLINE NOTICE CLOSE LINK
  $('.inlinenotice').append('<a href="#" class="inlinenoticeoff"></a>')
  
  // BIND INLINE NOTICE LINK CLOSE ACTION
  $('.inlinenotice a').click(function() { 
    
    $(this).parent().slideUp(500, function() {
      
      var key = $(this).attr('id');
      var subkey = 'InlineNotice_CAPID';
    
      // SET INLINE NOTICE STATE
      $.ajax({
        type: 'POST',
        url: '/global/ajif/aj_cookie.html',
        data: 'key=' + key + '&subkey=' + subkey + '&value=0&a=set',
        success: function(output){
          // May want info box success notification here
        }
      });
    });
    return false;
  });

  // BIND INLINE NOTICE LINK CLOSE ACTION
  $('.inlinenoticereset').click(function() { 
    var key    = '';
    var subkey = 'InlineNotice_CAPID';
    var value  = '';
    
    // SET INLINE NOTICE STATE
    $.ajax({
      type: 'POST',
      url: '/global/ajif/aj_cookie_reset.html',
      data: 'key=' + key + '&subkey=' + subkey + '&value=' + value,
      success: function(output){
        $('.inlinenoticereset').append(output);
      }
    });
  });
  
  // OUTPUT DEBUG UTILITY
  function out(val) {
    var output = $('#output').length;
    if (output) {
      $('#output').append(val + '<br />');
    } else {
      $('body').append('<div id="output"></div>');
      $('#output').append(val + '<br />');
    }
  }
  
});

  
  
  
  