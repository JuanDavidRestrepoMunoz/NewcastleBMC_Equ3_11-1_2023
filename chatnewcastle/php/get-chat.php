<?php
    session_start();
    if(isset($_SESSION['id_us'])){
        include_once "confi.php";
        $outgoing_id = mysqli_real_escape_string($conexion, $_POST['outgoing_id']);
        $incoming_id = mysqli_real_escape_string($conexion, $_POST['incoming_id']);
        $output = "";

        $sql = "SELECT * FROM messages
                LEFT JOIN usuario ON usuario.id_us = messages.incoming_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id}) 
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conexion, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                if($row ['outgoing_msg_id']  === $outgoing_id){
                    $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';

                }else{
                    $output .= '<div class="chat incoming">
                                <img src="php/images/'. $row['img'] .'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                                </div>';

                }
            
            }
            echo $output;
        }
           
    }
?>

