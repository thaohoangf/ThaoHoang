<!DOCTYPE html>
<html lang="en">
<?php
include_once 'menu.php';
?>
<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="list-products.php">List Products</a></li>
        </ul>

    </div>

    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form method="GET" action="index.php">
                    <input type="hidden" class="" name="controller" value="ProductController"/>
                    <input type="hidden" class="" name="action" value="searchProduct"/>
                    <input type="hidden" class="" name="page" value="1"/>
                    <input type="text" class="span11" placeholder="Some text for search..." name="search"/>
                    <button class="btn span1" type="submit">Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->

        <div class="row-fluid">

            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="index.php?controller=ProductController&action=viewAddProduct"class="btn btn-add">Add Product</a>
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <form method="POST" action="index.php?controller=ProductController&action=handle">
                            <?php
                            if(!isset($_GET['order']) || $_GET['order']=='desc'){
                                $order = 'asc';
                            } else if($_GET['order']=='asc' ||$_GET['order']!=$order){
                                $order = 'desc';
                            }
                            ?>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th width="10%" class="<?php if($_GET['action']=='sortId'){if($_GET['order']=='desc') echo "sorting_desc"; else echo 'sorting_asc';}?>">
                                    <a href="index.php?controller=ProductController&action=sortId&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>" id="sortId">ID</a>
                                </th>
                                <th width="20%" class="<?php if($_GET['action']=='sortProductName'){if($_GET['order']=='desc') echo "sorting_desc"; else echo 'sorting_asc';}?>">
                                    <a href="index.php?controller=ProductController&action=sortProductName&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Productname</a>
                                </th>
                                <th width="20%" class="<?php if($_GET['action']=='sortPrice'){if($_GET['order']=='desc') echo "sorting_desc"; else echo 'sorting_asc';}?>">
                                    <a href="index.php?controller=ProductController&action=sortPrice&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Price</a>
                                </th>
                                <th width="20%" class="<?php if($_GET['action']=='sortActivate'){if($_GET['order']=='desc') echo "sorting_desc"; else echo 'sorting_asc';}?>">
                                    <a href="index.php?controller=ProductController&action=sortActivate&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Activate</a>
                                </th>
                                <th width="20%" class="<?php if($_GET['action']=='sortTimeCreated'){if($_GET['order']=='desc') echo "sorting_desc"; else echo 'sorting_asc';}?>">
                                    <a href="index.php?controller=ProductController&action=sortTimeCreate&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Time Created</a>
                                </th>
                                <th width="20%" class="<?php if($_GET['action']=='sortTimeUpdated'){if($_GET['order']=='desc') echo "sorting_desc"; else echo 'sorting_asc';}?>">
                                    <a href="index.php?controller=ProductController&action=sortTimeUpdate&order=<?php echo $order;?>&page=<?php echo $_GET['page'];?>">Time Updated</a>
                                </th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($listProduct as $data){?>
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="<?php echo $data['id']; ?>"/></td>
                                <td><?php echo $data['id'];?></td>
                                <td><?php echo $data['name'];?></td>
                                <td><?php echo $data['price'];?></td>
                                <td><?php if($data['activate']) echo "<span class='text-success'>Activate</span>";
                                    else echo "<span class='text-error'>Deactivate</span>";?></td>
                                <td><?php echo $data['time_create'];?></td>
                                <td><?php echo $data['time_update'];?></td>
                                <td><a href="index.php?controller=ProductController&action=editProduct&id=<?php echo $data['id']; ?>" class="btn btn-info">Edit</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <div class="bulk-action">
                        <button class="btn btn-success" name="activate">Activate</button>
                        <button class="btn btn-danger" name="delete" onclick="return(confirm('Are you sure delete?'))">Delete</button>
                    </div><!-- /bulk-action-->
                    <div class="dataTables_paginate">
                        <?php echo $link; ?>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>

    </div>

</div>

</body>
</html>