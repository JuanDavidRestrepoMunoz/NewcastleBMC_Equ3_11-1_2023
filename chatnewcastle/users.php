<?php 
    session_start();
    if(!isset($_SESSION['id_us'])){
    }

?>
<?php include_once "header.php"; ?>
<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                include ("php/confi.php");
                $sql = mysqli_query($conexion, "SELECT * FROM usuario WHERE id_us = {$_SESSION['id_us']} ");
                if(mysqli_num_rows($sql) > 0){
                    $row = mysqli_fetch_assoc($sql);
                }

                ?>
                <div class="content">
                    <img src="php/images/<?php echo $row['img'] ?>" alt="">
                    <div class="details">
                        <span><?php echo $row['nom1'] . " " . $row['ape1'] ?></span>
                        <p><?php echo $row['status'] ?></p>
                    </div>
                </div>
            </header>
            <div class="search"> 
                <span class="text">Ingrese usuario</span>
                <input type="text" placeholder="Ingresa el nombre">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
                <a href="#">
                
                
            </a>
            </div>
        </section>
     </div>

     <script src="js/users.js"></script>
</body>
</html>