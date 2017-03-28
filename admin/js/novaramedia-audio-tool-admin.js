(function( $ ) {
  'use strict';

  /**
   * All of the code for your admin-facing JavaScript source
   * should reside in this file.
   *
   * Note: It has been assumed you will write jQuery code here, so the
   * $ function reference has been prepared for usage within the scope
   * of this function.
   *
   * This enables you to define handlers, for when the DOM is ready:
   *
   * $(function() {
   *
   * });
   *
   * When the window is loaded:
   *
   * $( window ).load(function() {
   *
   * });
   *
   * ...and/or other possibilities.
   *
   * Ideally, it is not considered best practise to attach more than a
   * single DOM-ready or window-load handler for a particular page.
   * Although scripts in the WordPress core, Plugins and Themes may be
   * practising this, we should strive to set a better example in our own work.
   */

   var AudioTool = {
    vars: AudioToolVars,

    init: function() {
       var _this = this;

       _this.bind();
     },

    bind: function() {
      var _this = this;

      $('#get-data').on('click', function() {
        _this.getData($('#latest-select').val());
      });

     },

    getData: function(postId) {
      var _this = this;
      var data = {
        'action': 'get_audio_post_data',
        'postId': postId
      };

      $.ajax({
        url: _this.vars.ajaxurl,
        type: 'get',
        data: data,
        success: function(response, status) {
          return _this.useData(response, status);
        }
      });

     },

    useData(response, status) {
       console.log(response.data);
     }
   };

   $( window ).load(function() {
     AudioTool.init();
   });


})( jQuery );