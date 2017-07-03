(function( $ ) {
  'use strict';

  // selectText helper
  jQuery.fn.selectText = function() {
    var doc = document
      , element = this[0]
      , range, selection
    ;
    if (doc.body.createTextRange) {
      range = document.body.createTextRange();
      range.moveToElementText(element);
      range.select();
    } else if (window.getSelection) {
      selection = window.getSelection();
      range = document.createRange();
      range.selectNodeContents(element);
      selection.removeAllRanges();
      selection.addRange(range);
    }
  };

  // AudioTool object
  var AudioTool = {
    params: AudioToolVars,

    init: function() {
       var _this = this;

       _this.bind();

      $('.easy-select').click(function() {
        $(this).selectText();
      });
     },

    bind: function() {
      var _this = this;

      $('#get-data').on('click', function() {
        _this.hideOutput();
        _this.getData($('#latest-select').val());
      });

    },

    hideOutput: function() {
      $('.output').hide();
    },

    showOutput: function() {
      $('.output').show();
    },

    getData: function(postId) {
      var _this = this;
      var data = {
        'action': 'get_audio_post_data',
        'postId': postId
      };

      $.ajax({
        url: _this.params.ajaxurl,
        type: 'get',
        data: data,
        success: function(response, status) {
          if (response.type === 'error') {
            alert(response.error);
            console.log('response', response);
          } else {
            _this.setOutputData(response.data);
            _this.showOutput();
          }
        }
      });

    },

    setOutputData: function(data) {
      var _this = this;
      var outputTitle = data.post_title;

      if (data.show_name) {
        outputTitle = data.show_name + ': ' + outputTitle;
      }

      $('#output-title').text(outputTitle);

      $('#output-filename').text(outputTitle.replace(/[^a-zA-Z 0-9]+/g,'').replace(/[ ]+/g, '_').toLowerCase());

      var date = new Date();

      var archiveYear = date.getFullYear() + '';
      var archiveDate = archiveYear.substring(2) + _this.addLeadingZero(date.getMonth()) + _this.addLeadingZero(date.getDate());

      $('#output-archive-filename').text(archiveDate + '_' + outputTitle.replace(/[^a-zA-Z 0-9]+/g,'').replace(/[ ]+/g, '_').toLowerCase());

      $('#output-permalink').text(data.post_permalink);

      var escapedCopy = $('<p>' + data.post_content + '</p>').text();

      $('#output-copy').text(escapedCopy);

      $('#output-lyrics').text(escapedCopy + '\n\n' + data.post_permalink);

      $('#output-archive-org-copy').text('<p>' + data.post_content + '</p><a href="' + data.post_permalink + '">' + data.post_permalink + '</a>');

      var tags = 'Novara Media';

      if (data.show_name) {
        tags += ', ' + data.show_name;
      }

      $(data.post_tags).each(function(index, tag) {
        tags += ', ' + tag;
      });

      $('#output-tags').text(tags);

      var archiveUrl = 'http://archive.org/upload/?';

      archiveUrl += 'title=' + encodeURIComponent(outputTitle);
      archiveUrl += '&description=' + '<p>' + encodeURIComponent(escapedCopy) + '</p><a href="' + encodeURIComponent(data.post_permalink) + '">' + encodeURIComponent(data.post_permalink) + '</a>';
      archiveUrl += '&subject=' + encodeURIComponent(tags);
      archiveUrl += '&creator=Novara Media';
      archiveUrl += '&licenseurl=http://creativecommons.org/licenses/by-nc-sa/3.0/';
      archiveUrl += '&language=eng';

      $('#output-archive-org-link').attr('href', archiveUrl);

    },

    addLeadingZero: function(number) {
      number = number + '';

      if (number.length === 1) {
        number = '0' + number;
      }

      return number;
    },

  };

  $( window ).load(function() {
    AudioTool.init();
  });

})( jQuery );
