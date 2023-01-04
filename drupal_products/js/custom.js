(function ($, Drupal, once) {
    Drupal.behaviors.product_qr = {
      attach: function (context, settings) {
       // console.log('test');
        once('product_qr', 'html', context).forEach( function () {
            var url = $('#url').val();  
            console.log(url);   
            // Clear Previous QR Code
            $('#qrcode').empty();   
             // Set Size to Match User Input
            $('#qrcode').css({
                'width' : 300,
                'height' : 300
            });
                
            // Generate and Output QR Code
            $('#qrcode').qrcode({width: 300,height: 300,text: url});
        });
      }
    };
  })(jQuery, Drupal, once);