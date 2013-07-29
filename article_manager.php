<?php
include_once ("./header.php");
?>

<div class="container">
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">文献管理</a>
                <div class="nav-collapse collapse navbar-responsive-collapse">
                    <ul class="nav">
                        <li><a  href="upload_file.php">上传文献</a></li>
                       
                        <li><a href="#">删除文献</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">标签 <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">添加标签</a></li>
                                <li><a href="#">修改标签</a></li>
                                <li><a href="#">删除标签</a></li>

                            </ul>
                        </li>


                    </ul>
                    <form class="navbar-search pull-left" action="">
                        <input type="text" class="search-query span4" placeholder="请搜索文献">
                        <button type="submit" class="btn-link"><i class="icon-search"></i></button>
                    </form>
                    <ul class="nav pull-right">
                        <li><a  href="#">返回首页</a></li>

                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->
</div>
<div class="container">
    

    <table class="table table-hover">
        <tbody>
            <tr class="info">
                <td>#</td>
                <td width = "8%"><strong>作者</strong></td>
                <td width = "8%"><strong>题目</strong></td>
                <td width = "8%"><strong>出处</strong></td>
                <td width = "15%"><strong>上传时间</strong></td> 
                <td width = "40%"><strong>操作</strong></td>

            </tr>

            <?php
            require_once('appvars.php');
            require_once('connectvars.php');

            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

            $query = "SELECT * FROM resource ORDER BY title ASC";
            $data = mysqli_query($dbc, $query);

            $row_num = 1;
            $color = true;
            while ($row = mysqli_fetch_array($data)) {
                if ($color) {
                    echo '<tr>';
                } else {
                    echo '<tr class="info">';
                }
                $color = !$color;
                echo '<td width = "3%">' . $row_num++ . '</td>';
                echo '<td width = "15%">' . $row['authors'] . '</td>';

                echo '<td width = "30%">' . $row['title'] . '</td>';
                echo '<td width = "25%">' . $row['journal'] . $row['year'] . ',' . $row['pages'] . ',' . $row['publisher'] . '</td>';
                echo '<td width = "10%">' . $row['create_time'] . '</td>';
                $file_name = iconv('utf-8', 'gb2312', $row['file']);
                echo '<td width = "15%">';
                echo '<a class="btn-link" href="upload_file.php"><i class="icon-edit"></i></a>';

                if (is_file(GW_UPLOADPATH . $file_name)) {
                    echo '<a class="btn-link" href="' . GW_UPLOADPATH . $row['file'] . '"><i class="icon-download-alt"></i></a>';
                }

                echo '<a class="btn-link" href="create_article.html"><i class="icon-trash"></i></a></td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>

<?php
include_once ("./foot.php");
?>