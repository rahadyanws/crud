$(document).ready(function() {
  var url_apikey = "<?php echo base_url('users/addApikey');?>";
  $("#formApikey").submit(function(event) {
    $(document).ajaxStart(function() {
      $("input").prop('disabled', true);
      $("button").prop('disabled', true);
      $("select").prop('disabled', true);
    });
    $(document).ajaxStop(function() {
      $("input").prop('disabled', false);
      $("button").prop('disabled', false);
      $("select").prop('disabled', false);
    });
    $(document).ajaxError(function() {
      alert("failed");
      $("input").prop('disabled', false);
      $("button").prop('disabled', false);
      $("select").prop('disabled', false);
    });
    console.log($(this).serialize());
    $.ajax({
      type: 'POST',
      url: url_apikey,
      data: $(this).serialize(),
      dataType: 'json',
      encode: true
    }).done(function(data) {
      if (data.status == true) {
        alert(data.message);
        window.location.reload(true);
        $('#add-apikey').modal('hide');
      } else {
        alert(data.message);
      }
    });
    event.preventDefault();
  });
  $('#table_apikey tbody').on('click', '.delete_apikey', function() {
    var uid = $(this).data("uid");
    var apikeyid = $(this).data("apikey");
    if (confirm("Are you sure? " + uid + " " + apikeyid)) {
      $.ajax({
        type: 'POST',
        dataType: "json",
        url: '<?php echo base_url('
        users / deleteApikey ');?>',
        data: {
          uid: uid,
          apikeyid: apikeyid
        },
        success: function(data, textStatus, jqXHR) {
          if (data.status == true) {
            location.reload();
            alert("success");
          } else {
            alert("failed");
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("failed loja" + textStatus);
        }
      });
    }
  });
});