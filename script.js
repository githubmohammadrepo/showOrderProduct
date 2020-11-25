  //function accept
  function acceptOrder(user_id, button) {
      // sent ajax request
      $.ajax({
              url: "http://hypertester.ir/serverHypernetShowUnion/changeOrderStatus.php",
              method: "POST",
              data: {
                  user_id: user_id,
                  order_id: button.getAttribute("data-orderid"),
                  typeAction: "accept"
              })
          .done(function(data) {
              console.log('success', data)
          })
          .fail(function(xhr) {
              console.log('error', xhr);
          });
      }

      //function reject
      function rejectOrder() {

      }