<!DOCTYPE html>
<html lang="en">

<head>
  <title>Muktifresh Admin </title>
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
            <div class="col-md-8">
              <!--Start Coding Here-->
              <h4>Category List</h4>
              <table class="table table-light">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Description</th>

                    <th>Status</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody id='category-table'>
                  <tr>
                    <td colspan='6' class='text-center'>Loading...</td>
                  </tr>
                </tbody>
              </table>
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
      $.ajax({
        url: 'http://dev.cogzin.com/jayanta/muktifresh/viewcategories',
        method: 'GET',
        success: function (res) {
          var tab = ``;
          res.forEach(function (item, key) {
            tab += `
            <tr>
                <td>`+ (key + 1) + `</td>
                <td>`+ item.name + `</td>
                <td>`+ item.description + `</td>
                <td>`+ item.status + `</td>
                <td>
                    <button category-id="`+ item.id + `"class='btn btn-sm btn-outline-primary'><i class="fa fa-pencil"></i></button>
                    <button category-id="`+ item.id + `" class='btn btn-sm btn-outline-primary dlt-btn'><i class="fa fa-trash "></i></button>
                </td>
            </tr>
            `;
          })

          $('#category-table').html(tab);
          $('.table').DataTable({});
        }
      })
        $('#category-table').delegate('.dlt-btn', 'click', function () {
          category_id = $(this).attr('category-id');

          var con = confirm('Are you sure want to delete this category?');
          if (con == true) {
            $.ajax({
              url: 'https://dev.cogzin.com/jayanta/muktifresh/deletecategories',
              method: 'POST',
              data: JSON.stringify({ 'id': category_id }),
              success: function (res) {
                if (res.success == true) {
                  alert(res.message);
                  location.reload();
                } else {
                  alert(res.message);
                }
              }
            })
          }
        })
    })
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