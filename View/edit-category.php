<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>

    <title>NTQ Solution Admin Control Panel</title>

    <link rel="icon" type="image/ico" href="favicon.ico"/>

    <link href="../css/stylesheets.css" rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="header">
    <a class="logo" href="list-categories.php">
        <img src="../img/logo.png" alt="NTQ Solution - Admin Control Panel" title="NTQ Solution - Admin Control Panel"/>
    </a>
    
</div>

<div class="menu">

    <div class="breadLine">
        <div class="arrow"></div>
        <div class="adminControl active">
            Hi, Ta Quoc Vuong
        </div>
    </div>

    <div class="admin">
        <div class="image">
            <img src="../img/users/avatar.jpg" class="img-polaroid"/>
        </div>
        <ul class="control">
            <li><span class="icon-cog"></span> <a href="edit-user.php">Update Profile</a></li>
            <li><span class="icon-share-alt"></span> <a href="login.php">Logout</a></li>
        </ul>
    </div>

    <ul class="navigation">
        <li>
            <a href="list-categories.php">
                <span class="isw-grid"></span><span class="text">Categories</span>
            </a>
        </li>
        <li>
            <a href="list-products.php">
                <span class="isw-list"></span><span class="text">Products</span>
            </a>
        </li>
        <li>
            <a href="list-users.php">
                <span class="isw-user"></span><span class="text">Users</span>
            </a>
        </li>
    </ul>

</div>

<div class="content">


    <div class="breadLine">

        <ul class="breadcrumb">
            <li><a href="list-categories.php">List Categories</a> <span class="divider">></span></li>
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
                    <form>
                    	<div class="row-form">
                            <div class="span3">Category Name:</div>
                            <div class="span9"><input type="text" placeholder="some text value..."/></div>
                            <div class="clear"></div>
                        </div> 
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="select">
                                        <option value="0">choose a option...</option>
                                        <option value="1">Activate</option>
                                        <option value="2">Deactivate</option>
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>                          
                        <div class="row-form">
                        	<button class="btn btn-success" type="submit">Update</button>
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