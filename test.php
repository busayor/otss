<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<html>
  <head>
    <script>
      $(document).ready(function(){
        $('.add_more').click(function(e){
          e.preventDefault();
          $(this).before("<input name='file[]' type='file'/>");
        });
      });
    </script>
  </head>
  <body>
    <!-- form.php -->
<form action="uploads.php" method="post" enctype="multipart/form-data">
 <label> Select File: <input type="file" name="attachment[]" multiple > </label>
 <input type="submit" name="HandleUpload" value="Upload" >
</form>
  </body>
</html>