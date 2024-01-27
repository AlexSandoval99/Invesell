/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/
$(document).ready(function () {
  $('[magnific-popup]').magnificPopup({
    type: 'image'
  });

  // fix multiple modal z-index
  $(document).on('show.bs.modal', '.modal', function () {
    var zIndex = 2040 + 10 * $('.modal:visible').length;
    $(this).css('z-index', zIndex);
    setTimeout(function () {
      $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
      $('[select2]').select2({
        language: 'es'
      });
    }, 0);
  });
  $(document).on('shown.bs.modal', '.modal', function () {
    $('[select2]').select2({
      language: 'es'
    });
  });
  $("[select2]").select2({
    language: 'es',
    matcher: function matcher(params, data) {
      if ($.trim(params.term) === '') {
        return data;
      }
      keywords = params.term.split(" ");
      for (var i = 0; i < keywords.length; i++) {
        if (data.text.toUpperCase().indexOf(keywords[i].toUpperCase()) == -1) return null;
      }
      return data;
    }
  });
  $("[select2-group]").select2({
    language: 'es',
    matcher: function matcher(params, data) {
      // If there are no search terms, return all of the data
      if ($.trim(params.term) === '') {
        return data;
      }

      // Skip if there is no 'children' property
      if (typeof data.children === 'undefined') {
        return null;
      }

      // `data.children` contains the actual options that we are matching against
      var filteredChildren = [];
      $.each(data.children, function (idx, child) {
        if (child.text.toUpperCase().indexOf(params.term.toUpperCase()) != -1) {
          filteredChildren.push(child);
        }
      });
      // If we matched any of the timezone group's children, then set the matched children on the group
      // and return the group object
      if (filteredChildren.length) {
        var modifiedData = $.extend({}, data, true);
        modifiedData.children = filteredChildren;

        // You can return modified objects from here
        // This includes matching the `children` how you want in nested data sets
        return modifiedData;
      }

      // Return `null` if the term should not be displayed
      return null;
    }
  });
  $("[enterprise-select2-placeholder]").select2({
    language: 'es',
    placeholder: 'Todas las Unidades'
  });
  $("[service-invoices-select2-placeholder]").select2({
    language: 'es',
    placeholder: 'Todas los servicios'
  });
  $("[status-select2-placeholder]").select2({
    language: 'es',
    placeholder: 'Seleccione estado'
  });
  $('.i-checks').iCheck({
    checkboxClass: 'icheckbox_square-green',
    radioClass: 'iradio_square-green'
  });
  $("[input-mask]").inputmask();
  $("[date-mask]").inputmask({
    alias: 'date'
  });
  $("[time-mask]").inputmask({
    "mask": "99:99"
  });
  $("[month-year-mask]").inputmask({
    "mask": "99/9999"
  });
  $("[date-range-mask]").inputmask({
    "mask": "99/99/9999 - 99/99/9999"
  });
  $("[date-range-time-mask]").inputmask({
    "mask": "99/99/9999 99:99 - 99/99/9999 99:99"
  });
  $("[datetime-mask]").inputmask({
    alias: 'datetime'
  });
  $('[percentage-data-mask]').inputmask({
    alias: 'percentage'
  });
  $('[numeric-data-mask]').inputmask({
    alias: 'numeric',
    rightAlign: false,
    digits: 0
  });
  $("[period-data-mask]").inputmask({
    alias: 'decimal',
    groupSeparator: '.',
    radixPoint: ',',
    autoGroup: true,
    allowMinus: false,
    rightAlign: false,
    digits: 0,
    removeMaskOnSubmit: true
  });
  $("[period-data-mask-decimal]").inputmask({
    alias: 'decimal',
    groupSeparator: '.',
    radixPoint: ',',
    autoGroup: true,
    allowMinus: false,
    rightAlign: true,
    digits: 2,
    removeMaskOnSubmit: true
  });
  $("[period-data-mask-4-decimal]").inputmask({
    alias: 'decimal',
    groupSeparator: '.',
    radixPoint: ',',
    autoGroup: true,
    allowMinus: false,
    rightAlign: true,
    digits: 4,
    removeMaskOnSubmit: true
  });
  $("[linea-baja-py-mask]").inputmask({
    "mask": "(999) 999-999"
  });
  $("[celular-py-mask]").inputmask({
    "mask": "(9999) 999-999"
  });
  $("[invoice-purchase-mask]").inputmask({
    "mask": "999-999-9999999"
  });

  // $("[datepicker]").datepicker({
  //     language: "es",
  //     autoclose: true,
  // });

  $('form').preventDoubleSubmission();

  //$('.selectpicker').selectpicker();
});
/******/ })()
;