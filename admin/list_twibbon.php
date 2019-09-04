<?php
if(!defined("TwibbonKu")){
    header("location: index.php"); 
    exit();
}
?>
    <table id="dataTables" class="table">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Preview</th>
                <th>Judul</th>
                <th>File Name</th>
                <th>File Size</th>
                <th>Date</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $data = $twibbon->show_twibbon();
            foreach($data as $row){
        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><img id="img_preview" src="<?php echo $row['file_location']; ?>" width="100px" height="100px"></td>
                <td><?php echo $row['judul']; ?></td>
                <td><?php echo $row['file_name']; ?></td>
                <td><?php echo $twibbon->filesize_formatted($row['file_location']); ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><a href="./?do=delete&opt=twibbon&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs">Delete</a></td>
            </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
    <script>
        $("img").hover(
            function(){$(this).animate({width: "250px", height:"250px"}, 1000);},        
            function(){$(this).animate({width: "100px", height:"100px"}, 1000);}
        );
    </script>