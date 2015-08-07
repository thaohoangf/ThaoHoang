<?php require 'menu.php'; ?>
<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=CategoryController&action=index&page=1">List Categories</a> <span class="divider">></span></li>
            <li class="active">Edit</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form method="post" action="index.php?controller=CategoryController&action=editCategory&id=<?php echo $_GET['id']; ?>">
                    	<div class="row-form">
                            <div class="span3">Category Name:</div>
                            <div class="span9"><input type="text" value="<?php echo $infor['name']; ?>" name="name"/></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="activate">
                                        <option value="0">choose a option...</option>
                                        <option value="1" <?php if($infor['activate'] == 1) echo 'selected'; ?>>Activate</option>
                                        <option value="2" <?php if($infor['activate'] == 2) echo 'selected'; ?>>Deactivate</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit" name="update">Update</button>
							<div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>

</body>
</html>