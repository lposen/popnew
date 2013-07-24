$(document).ready(function() { 	

var end = new Date(2013,08,12);
var today = Date.now();
var daydiff = Math.floor((end-today)/86400000);
$("#daydiff").text(daydiff);

$('#bts_teaser').tubular({videoId: 'h3EK0do07_k'}); // where idOfYourVideo is the YouTube ID.

$('#input_9_1_3').attr('placeholder', 'First Name');
$('#input_9_1_6').attr('placeholder', 'Last Name');
$('#input_9_2').attr('placeholder', 'Email');

});
