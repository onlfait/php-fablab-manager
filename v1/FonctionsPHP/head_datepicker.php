<!--Configuration pour le datepicker-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
jQuery(function($){
  $.datepicker.regional['fr'] = {
    closeText: 'Fermer',
    prevText: '&#x3c;Préc',
    nextText: 'Suiv&#x3e;',
    currentText: 'Aujourd\'hui',
    monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
    'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
    monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
    'Jul','Aou','Sep','Oct','Nov','Dec'],
    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
    weekHeader: 'Sm',
    dateFormat: 'dd-mm-yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: '',
    minDate: 0,
    maxDate: '+12M +0D',
    numberOfMonths: 1,
    showButtonPanel: true
  };
  $.datepicker.setDefaults($.datepicker.regional['fr']);
});
$( function() {
  $( ".datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
} );
</script>
