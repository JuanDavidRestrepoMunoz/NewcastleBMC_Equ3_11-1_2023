<?php
while($row = mysqli_fetch_assoc($sql)){
    $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['id_us']}
                OR outgoing_msg_id = {$row['id_us']}) AND (outgoing_msg_id = {$outgoing_id}
                OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conexion, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if(mysqli_num_rows($query2) > 0){
        $result = $row2['msg'];
    }else{
        $result = "Sin mensajes";
    }
    
    (strlen($result) > 28) ? $msg = substr($result, 0, 28).'...' : $msg = $result;
    if ($row2 !== null) {
        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "TU: " : $you = "";
    } else {
        // Manejar el caso en el que $row2 es nulo
        $you = ""; // O establece cualquier otro valor por defecto que desees
    }
    
    ($row['status'] == "Desconectado ahora") ? $offline = "offline" : $offline = "";

    $user_id = $row['id_us']; // Obtener el valor de user_id
    $output .= '<a href="chat.php?id_us=' . $user_id . '">
                <div class="content">
                    <img src="php/images/' . $row['img'] . '" alt="">
                    <div class="details">
                        <span>' . $row['nom1'] . " " . $row['ape1'] . '</span>
                        <p>'. $you . $msg .'</p>
                    </div>
                </div>
                <div class="status-dot '.$offline.'"><i class="fas fa-circle"></i></div>
                </a>';
}
?>
