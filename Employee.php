<?php
    
    $connect= new PDO("mysql:servername=localhost;dbname=projrct","root","");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check & Balance</title>
    <style>
    .back{
            height: 300px;
            background-image: url('../images/slider3.jpg');
        }
    </style>
</head>
<body>
<?php
        include("../MasterPage/header.php");
    ?>
        <div class="back">
    
        </div>
        <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
            <div class="col-md-3">                				
						
                <div class="list-group">
					<h3 align="center">Categories</h3>
                    <div   style="height: 180px;">
					<?php
                     $query = "SELECT * FROM `employee`";
                   // $query = "SELECT DISTINCT(Categories) FROM cart WHERE product_status = '1' ORDER BY ID DESC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                     ?>
                     <div class="list-group-item checkbox">
                         <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['Categories']; ?>"  > <?php echo $row['Categories']; ?></label>
                     </div>
                     <?php
                     }

                    ?>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>

        </div>
    </div>
    <style>

</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var brand = get_filter('brand');
        
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action,brand:brand},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });


});
</script>
<br />


       <?php
        include("../MasterPage/footer.php");
    ?>
</body>
</html>
