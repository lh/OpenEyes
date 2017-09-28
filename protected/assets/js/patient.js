function addItem(wrapper_id, ui){
    var $wrapper = $('#' + wrapper_id);
    $wrapper.find('span.name').text(ui.item.label);
    $wrapper.show();
    $wrapper.find('.hidden_id').val(ui.item.id);
}

function addGpItem(wrapper_id, ui){
    var $wrapper = $('#' + wrapper_id);
    var JsonObj = JSON.parse(ui);
    $wrapper.find('span.name').text(JsonObj.label);
    $wrapper.show();
    $wrapper.find('.hidden_id').val(JsonObj.id);
}

function addReferredToItem(wrapper_id, ui){
  var $wrapper = $('#' + wrapper_id);
  $wrapper.find('span.name').text(ui.item.label);
  $wrapper.show();
  $wrapper.find('.hidden_id').val(ui.item.id);
}

function removeSelectedGP(){
    $('#no_gp_result').hide();
    $('.selected_gp span.name').text('');
    $('#selected_gp_wrapper').hide();
    $('#Patient_gp_id').val('');
}
function removeSelectedPractice(){
    $('#no_practice_result').hide();
    $('.selected_practice span.name').text('');
    $('#selected_practice_wrapper').hide();
    $('#Patient_practice_id').val('');
        
}
function removeSelectedReferredto(){
  $('#no_referred_to_result').hide();
  $('.selected_referred_to span.name').text('');
  $('#selected_referred_to_wrapper').hide();
}

$(document).ready(function(){

    $('#patient-form').on('keyup', '#Patient_nhs_num', function(){
        var selector = $(this).data('child_row');
        $(selector).hide();
        if( $(this).val().length > 0 ){
            $(selector).show();
        }
    });
    
    $('#Patient_is_deceased').on('change', function(){
        var selector = $(this).data('child_row');
        $(selector).hide();
        $(selector).find('input').val('');
        if($(this).is(':checked')){
            $(selector).show();
        }
    });
    
    $('#selected_gp_wrapper').on('click', '.remove', function(){
        removeSelectedGP();
    });
    
    $('#selected_practice_wrapper').on('click', '.remove', function(){
        removeSelectedPractice();
    });

  $('#selected_referred_to_wrapper').on('click', '.remove', function(){
    removeSelectedReferredto();
  });
    
    
});