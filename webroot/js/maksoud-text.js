/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

var text_max = $('#text').get(0).getAttribute('maxlength');
$('#count_message').html(text_max);

$('#text').keyup(function() {
  
  var text_length = $('#text').val().length;
  var text_remaining = text_max - text_length;
  
  $('#count_message').html(text_remaining);

});