<?php
session_start();
if (!isset($_SESSION['id_us'])) {
    header("location: login.php");
}
?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                include_once "php/confi.php";
                // Recupera el valor de 'user_id' desde la URL
                $user_id = mysqli_real_escape_string($conexion, $_GET['id_us']);
		$sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE id_us = {$user_id}");
         	if(mysqli_num_rows($sql) > 0){
             	$row = mysqli_fetch_assoc($sql);
         	}
                ?>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
       		 <img src="php/images/<?php echo $row['img'] ?>" alt="">
        	<div class="details">
         	 <span><?php echo $row['nom1'] . " " . $row['ape1'] ?></span>
         	 <p><?php echo $row['status'] ?></p>
       		</div>
            </header>
            <div class="chat-box">
                
            </div>
            <form action="#" class="typing-area" autocomplete="off">
            	<input type="text" name="outgoing_id" value= "<?php echo $_SESSION['id_us']; ?>" hidden>
        	<input type="text" name="incoming_id" value= "<?php echo $user_id; ?>" hidden>
        	<input type="text" name="message" class="input-field" placeholder="Escribe tu mensaje aquí..." autocomplete="off">
        	<button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>


    <script src="js/chat.js"></script>

</body>

</html>