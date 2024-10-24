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
                        <div class="col-md-6">
                            <!--Start Coding Here-->
                            <h4>Edit subcategory</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="" id="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select name="" id="category" class="form-control">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea type="text" name="" rows="5" id="description"
                                            class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="" id="status" class="form-control">
                                            <option value="Active">Active</option>
                                            <option value="Inactive">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Photo</label>
                                        <input type="file" name="" id="photo" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-success" id="submit">Submit</button>
                                </div>
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

            $.ajax({
                url: 'http://dev.cogzin.com/jayanta/muktifresh/viewcategories',
                method: 'GET',
                success: function (res) {
                    cats=``;
                    res.forEach(function (item, key) {
                        cats+=`<option value='`+item.id+`'>`+item.name+`</option>`;
                    })
                    $('#category').html(cats);
                }
            })


            $('#submit').on('click', function () {
                var name = $('#name').val();
                var description = $('#description').val();
                var category_id=$('#category').val();
                // var location=$('#location').val();
                var status = $('#status').val();
                var phone = $('#phone').val();

                var req = {
                    "name": name,
                    "description": description,
                    "latitude": "",
                    "longitude": "",
                    "photo": null,
                    "status": status,
                    "location": location,
                    "contact_info": phone
                }

                $.ajax({
                    url: 'http://dev.cogzin.com/jayanta/muktifresh/createsubcategories',
                    method: 'POST',
                    data: JSON.stringify(req),
                    success: function (res) {
                        console.log(res);
                    }
                })

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