<!DOCTYPE html>
<html lang="en">

<head>
  <title>ForgetMe Not</title>
  <?php include "includes/head.php"; ?>
</head>

<body class="with-welcome-text">
  <div class="container-scroller">
    <?php include "includes/topnav.php"; ?>
    <div class="container-fluid page-body-wrapper">
      <?php include "includes/sidebar.php"; ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6">
              <!--Start Coding Here-->
              <h4>Create Category</h4>
              <form id="category_form" method="post" class="row">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" name="" id="name" class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea type="text" name="" rows="5" id="description" class="form-control" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Status</label>
                      <select name="" id="status" class="form-control" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category Photo</label>
                      <input type="file" accept=".jpg,.png,.gif,.jpeg,.webp" name="" id="photo" class="form-control">
                      <p id="photo_action" class="text-info"></p>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-success" id="submit">Submit</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <?php include "includes/footer.php"; ?>
    </div>
  </div>
  </div>
  <?php include "includes/scripts.php"; ?>
  <script>

    $(document).ready(function () {
      var photo_url = '';
      //Photo Upload
      $('#photo').on('change', function () {
        var file = $(this)[0].files[0];
        var form = new FormData();
        form.append("img", file);

        $(this).prop('disabled', true);
        $('#photo_action').html('Loading...');
        $.ajax({
          url: backend + 'upload',
          method: 'POST',
          processData: false,
          contentType: false,
          data: form,
          success: function (res) {
            console.log(res);
            $(this).prop('disabled', false);
            photo_url = res.url;
            $('#photo_action').html(`<a href='` + backend + res.url + `' target='_blank'>Click to view</a>`);
          }
        })

      })

      $('#category_form').on('submit', function (e) {
        e.preventDefault();
        var name = $('#name').val();
        var description = $('#description').val();
        var location = $('#location').val();
        var status = $('#status').val();
        var phone = $('#phone').val();
        if (photo_url.length != 0 && name.length != 0 && description.length != 0 && status.length != 0 && location.length != 0 && phone.length != 0) {
          var req = {
            "name": name,
            "description": description,
            "latitude": "",
            "longitude": "",
            "photo": photo_url,
            "status": status,
            "location": location,
            "contact_info": phone
          }

          $.ajax({
            url: 'http://dev.cogzin.com/jayanta/muktifresh/createcategories',
            method: 'POST',
            data: JSON.stringify(req),
            success: function (res) {
              if (res.success == true) {
                alert(res.message);
                window.location = 'category-list.php';
              } else {
                alert(res.message);
              }
            }
          })
        } else {
          alert('Please fill all the fields!');
        }



      })
      /**/
    });

  </script>
  </div>
  </div>
  </div>
  <?php include "includes/footer.php"; ?>
  </div>
  </div>
  </div>
  <?php include "includes/scripts.php"; ?>
</body>

</html>