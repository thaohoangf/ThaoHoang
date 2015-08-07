<?php
include 'menu.php';
?>
<body>
<div class="content">
    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="index.php?controller=CategoryController&action=index&page=1">List Categories</a></li>
        </ul>
    </div>

    <div class="workplace">
        <div class="row-fluid">
            <div class="span12 search">
                <form method="GET" action="index.php">
                    <input type="hidden" class="" name="controller" value="CategoryController"/>
                    <input type="hidden" class="" name="action" value="index"/>
                    <input type="hidden" class="" name="page" value="1"/>
                    <input type="hidden" name="order" value="asc">
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
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="index.php?controller=CategoryController&action=viewAddCategory" class="btn btn-add">Add Category</a>
                    <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">
                        <thead>
                        <form method="POST" action="index.php?controller=CategoryController&action=index&page=<?php echo $_GET['page']; ?>">
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <?php
                                $_SESSION['page'] = $_GET['page'];
                                if(!isset($_GET['order']) || $_GET['order']=='asc'){
                                    $order = 'desc';
                                    $class = 'sorting_desc';
                                } else if($_GET['order']=='desc' ||$_GET['order']!=$order){
                                    $order = 'asc';
                                    $class = 'sorting_asc';
                                }
                                if(!isset($_GET['search'])){
                                    $search = '';
                                }else $search = '&search='.$_GET['search'];?>
                                <th width='15%' class='<?php echo $class; ?>'>
                                    <a href='index.php?controller=CategoryController&action=index&sort=id<?php echo $search; ?>&order=<?php echo $order; ?>&page=1'>ID</a>
                                </th>
                                <th width='30%' class='<?php echo $class; ?>'>
                                    <a href='index.php?controller=CategoryController&action=index&sort=name<?php echo $search; ?>&order=<?php echo $order; ?>&page=1'>Name</a>
                                </th>
                                <th width='25%' class='<?php echo $class; ?>'>
                                    <a href='index.php?controller=CategoryController&action=index&sort=activate<?php echo $search; ?>&order=<?php echo $order; ?>&page=1'>Activate</a>
                                </th>
                                <th width='15%' class='<?php echo $class; ?>'>
                                    <a href='index.php?controller=CategoryController&action=index&sort=time_create<?php echo $search; ?>&order=<?php echo $order; ?>&page=1'>Time Created</a>
                                </th>
                                <th width='15%' class='<?php echo $class; ?>'>
                                    <a href='index.php?controller=CategoryController&action=index&sort=time_update<?php echo $search; ?>&order=<?php echo $order; ?>&page=1'>Time Updated</a>
                                </th>
                                <th width='10%'>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($listCategory as $data){?>
                            <tr>
                                <td><input type="checkbox" name="checkbox[]" value="<?php echo $data['id']; ?>"/></td>
                                <td><?php echo $data['id'];?></td>
                                <td><?php echo $data['name'];?></td>
                                <td><?php if($data['activate']== 1) echo "<span class='text-success'>Activate</span>";
                                    else echo "<span class='text-error'>Deactivate</span>";?></td>
                                <td><?php echo $data['time_create'];?></td>
                                <td><?php echo $data['time_update'];?></td>
                                <td><a href="index.php?controller=CategoryController&action=editCategory&id=<?php echo $data['id']; ?>&page=<?php  echo $_GET['page']; ?>" class="btn btn-info">Edit</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    <div class="bulk-action">
                        <button class="btn btn-success" name="activate">Activate</button>
                        <button class="btn btn-danger" name="delete" onclick="return(confirm('Are you sure delete?'))">Delete</button>
                    </div><!-- /bulk-action-->
                    </form>
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
<script>
    var input = document.getElementsByTagName('input');
    var selectAll = input[5];
    selectAll.onclick = function(){
        var state = (selectAll.checked) ? true : false;
        for (var i = 2; i < input.length; i++) {
            input[i].checked = state;
        }
    };
</script>

</body>
</html>

