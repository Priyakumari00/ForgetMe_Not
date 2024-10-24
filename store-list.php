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
                        <div class="col-md-8">
                            <!--Start Coding Here-->
                            <h4>Store Lists</h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Store Name</th>
                                        <th>Description</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id='store-table'>
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
                url: 'http://dev.cogzin.com/jayanta/muktifresh/viewstores',
                method: 'GET',
                success: function (res) {
                    var tab = ``;
                    res.forEach(function (item, key) {
                        tab += `
                    <tr>
                        <td>`+ (key + 1) + `</td>
                        <td>`+ item.name + `</td>
                        <td>`+ item.description + `</td>
                        <td>`+ item.location + `</td>
                        <td>`+ item.status + `</td>
                        <td>
                            <button store-id="`+ item.id + `" class='btn btn-sm btn-outline-primary edit-btn'><i class="fa fa-pencil"></i></button>
                            <button store-id="`+ item.id + `" class='btn btn-sm btn-outline-primary dlt-btn'><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    `;
                    })

                    $('#store-table').html(tab);
                    $('.table').DataTable({});
                }
            })


            $('#store-table').delegate('.edit-btn','click',function(){
                store_id = $(this).attr('store-id');
                window.location='edit-store.php?id='+store_id;
            })

            $('#store-table').delegate('.dlt-btn', 'click', function () {
                store_id = $(this).attr('store-id');


                var con = confirm('Are you sure want to delete this store?');
                if (con == true) {
                    $.ajax({
                        url: 'https://dev.cogzin.com/jayanta/muktifresh/deletestores',
                        method: 'POST',
                        data: JSON.stringify({ 'id': store_id }),
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

            /*$('.dlt-btn').on('click',function(){
                alert('clicked');
            })*/
        })
    </script>
</body>

</html>