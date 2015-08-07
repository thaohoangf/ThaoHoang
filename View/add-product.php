<?php include_once 'menu.php'; ?>
<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="list-products.php">List Products</a> <span class="divider">></span></li>
            <li class="active">Add</li>
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
                    <form method="POST" action="index.php?controller=ProductController&action=addProduct" enctype="multipart/form-data">
                    	<div class="row-form">
                            <div class="span3">Product Name:</div>
                            <div class="span9"><input type="text" placeholder="some text value..." name="name"/>
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
                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row-form">
                            <div class="span3">Price:</div>
                            <div class="span9"><input type="text" placeholder="some text value..." name="price"/>
                            <?php
                                if(isset($error['price'])) echo $error['price'];
                            ?>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Description:</div>
                            <div class="span9"><textarea name="description" placeholder="Textarea field placeholder..."></textarea>
                            <?php
                                if(isset($error['description'])) echo $error['description'];
                            ?>
                            </div>
                            <div class="clear"></div>
                        </div> 
                    	<div class="row-form">
                            <div class="span3">Upload Image:</div>
                            <div class="span9"><input type="file" name="product" size="19"></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="activate">
                                    <option value="0">choose a option...</option>
                                    <option value="1">Activate</option>
                                    <option value="2">Deactivate</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit" name="create">Create</button>
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