jQuery(document).ready(function($) {

  // Uploading files
  let fileFrame;

  $('#wp_rating_upload_button').on('click', function(event) {

    event.preventDefault();

    // If the media frame already exists, reopen it.
    if (fileFrame) {
      fileFrame.open();
      return;
    }

    // Create the media frame.
    fileFrame = wp.media.frames.fileFrame = wp.media({
      title: jQuery(this).data('uploader_title'),
      button: {
        text: jQuery(this).data('uploader_button_text'),
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    fileFrame.on('select', function() {
      // We set multiple to false so only get one image from the uploader
      attachment = fileFrame.state().get('selection').first().toJSON();
      $('#rating_image').val(attachment.url);
      // Do something with attachment.id and/or attachment.url here
    });

    // Finally, open the modal
    fileFrame.open();
  });

});
