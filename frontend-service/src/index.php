<html>

<head>
  <!-- <script language="javascript" type="text/javascript" src="jquery.js"></script> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <style>
    .full-screen {
      width: 100vw;
      height: 100vh;
    }
  </style>
</head>

<body style="background-color:white;">

  <script id="source" language="javascript" type="text/javascript">
    setInterval(ajaxCall, 20000);

    function ajaxCall() {
      //-----------------------------------------------------------------------
      // Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
      //-----------------------------------------------------------------------
      $.ajax({
        send http request with AJAX
        url: 'conn.php',
        data: "",
        dataType: 'json',
        success: function (data) {
          var localtime = data['LTIME'];
          var retreivedtime = data['RTIME'];
          var status = data['STATUS']

          $('#localtimeholder').html(localtime);
          $('#worldtimeholder').html(retreivedtime);
          $('#statusholder').html(status);
        }
      });
    };
  </script>

<!-- retrieve instance metadata from VPC endpoint -->
  <?php
  $cmd = 'curl "http://169.254.169.254/latest/meta-data/local-hostname"';
  $instanceID = shell_exec($cmd);
?>
<!-- front end interface div -->
  <div
    class="full-screen d-flex align-items-center justify-content-center align-content-center text-center flex-column">
    <div class="card border-primary mb-3 shadow p-3 mb-5 bg-body rounded" style="max-width: 40rem;">
      <div class="card-header bg-transparent border-primary">
        <h1>Time Clock Status Monitor</h1>
      </div>
      <div class="card-body text-primary">
        <h3 class="card-title">Local Time : <span id='localtimeholder'></span></h3>
        <h3 class="card-text">Retreived Time : <span id='worldtimeholder'></span></h3>
        <h3 class="card-text">Instance ID : <?php echo "$instanceID" ?></h3>
      </div>
      <div class="card-footer bg-transparent border-primary">
        <h2><span id='statusholder'></span></h2>
      </div>
    </div>
  </div>
  </div>
  </div>
</body>

</html>