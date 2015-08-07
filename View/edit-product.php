<?php require 'menu.php'; ?>
<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=ProductController&action=index&page=1">List Products</a> <span class="divider"></span></li>
            <li class="active">Edit</li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form method="POST" action="index.php?controller=ProductController&action=editProduct&id=<?php echo $_GET['id'];?> " enctype="multipart/form-data">
                    	<div class="row-form">
                            <div class="span3">Product Name:</div>
                            <div class="span9"><input type="text" name="name" value="<?php echo $infor['name']; ?>"/>
                            <?php
                                if(isset($error['name'])) echo $error['name'];
                            ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row-form">
                            <div class="span3">Category:</div>
                            <div class="span9">
                                <select name="category">
                                    <option value="0">choose a option...</option>
                                    <?php foreach($category as $data){ ?>
                                        <option value="<?php echo $data['id']; ?>" <?php if($infor['category_id'] == $data['id']) echo "selected"; ?>><?php echo $data['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                    	<div class="row-form">
                            <div class="span3">Price:</div>
                            <div class="span9"><input type="text" name="price" value="<?php echo $infor['price']; ?>"/>
                            <?php
                                if(isset($error['price'])) echo $error['price'];
                            ?>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Description:</div>
                            <div class="span9"><input type="text" name="description" value="<?php echo $infor['description']; ?>"/>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Image:</div>
                            <div class="span9">
                            <img src="img/products/1.jpg" />
                            <br/>
                            <input type="file" name="picture" size="19">
                            </div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="activate">
                                    <option value="0">choose a option...</option>
                                    <option value="1" <?php if($infor['activate']==1) echo "selected";?>>Activate</option>
                                    <option value="0" <?php if($infor['activate']==0) echo "selected";?>>Deactivate</option>
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