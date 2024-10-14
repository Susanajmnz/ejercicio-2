<html>
    <head>
       <title>Register Form</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
       <meta name="viewport" content="width=device-width">
       <link rel="stylesheet" href="stylesheet.css">
       <?php
            // Variable para controlar si hay errores
            $error = ['name' => '', 'password' => '', 'email' => '',
            'dateofbirth' => '', 'tel' => '', 'shop' => '', 'age' => ''];
            $errores = false;  

            // Validar nombre (3-25 caracteres, solo letras y espacios)
            $nombre = filter_input(INPUT_POST,'name', FILTER_SANITIZE_STRING);
            if (empty($nombre) || !preg_match("/^[a-zA-Z\s]{3,25}$/", $nombre)) {
                $error['name'] = "Nombre debe contener entre 3 y 25 caracteres alfabéticos y espacios.";
                $errores = true;
            }

            // Validar contraseña (6-8 caracteres alfanuméricos)
            $contraseña = filter_input(INPUT_POST,'password', FILTER_SANITIZE_STRING);
            if (empty($contraseña) || !preg_match("/^[a-zA-Z0-9]{6,8}$/", $contraseña)) {
                $error['password'] = "Contraseña debe contener entre 6 y 8 caracteres alfanuméricos.";
                $errores = true;
            }

            // Validar correo electrónico
            $correo = filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL);
            if (empty($correo)) {
                $error['email'] = "Correo electrónico no tiene el formato correcto.";
                $errores = true;
            }

            // Validar fecha de nacimiento (Formato YYYY-MM-DD)
            $nacimiento = filter_input(INPUT_POST,'dateofbirth', FILTER_SANITIZE_STRING);
            if (empty($nacimiento) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $nacimiento)) {
                $error['dateofbirth'] = "Debe ingresar una fecha de nacimiento válida (YYYY-MM-DD).";
                $errores = true;
            }

            // Validar teléfono (9 dígitos)
            $telefono = filter_input(INPUT_POST,'tel', FILTER_SANITIZE_NUMBER_INT);
            if (empty($telefono) || !preg_match("/^\d{9}$/", $telefono)) {
                $error['tel'] = "Teléfono debe contener 9 dígitos.";
                $errores = true;
            }
                
            // Validar edad (selección obligatoria)
            $años = filter_input(INPUT_POST,'age', FILTER_SANITIZE_STRING);
            if (empty($años)) {
                $error['age'] = "Debe seleccionar un rango de edad.";
                $errores = true;
            }
            
            // Validar la subscripción
            $_subscripcion = isset($_POST['subscription']) ? "subscrito" : "no subscrito";
       ?>
    </head>
    
    <body>
        <div class="flex-page">
            <h1>Customer Registration</h1>
            <form class="form-font capaform" name="registerform" 
                  action="" method="POST">
                <div class="flex-outer">
                    <div class="form-section">
                        <label for="name">Name:</label> 
                        <input id="name" type="text" name="name" placeholder="Enter your name:"/> 
                        <span class="error"><?php echo $error['name'] ?></span>
                    </div>
                    <div class="form-section">
                        <label for="password">Contraseña:</Label> 
                        <input id="password" type="password" name="password" placeholder="Enter your password:"/> 
                        <span class="error"><?php echo $error['password'] ?></span>
                    </div>
                    <div class="form-section">
                        <label for="email">Email:</Label> 
                        <input id="email" type="text"  name="email" placeholder="Enter your email">
                        <span class="error"><?php echo $error['email'] ?></span>
                    </div>
                    <div class="form-section">
                        <label for="dateofbirth">Date of Birth:</Label> 
                        <input id="dateofbirth" type="date" name="dateofbirth" placeholder="Enter your date of birth">
                        <span class="error"><?php echo $error['dateofbirth'] ?></span>
                    </div>
                    <div class="form-section">
                        <label for="telephone">Telefono Móvil:</Label> 
                        <input id="telephone" type="tel" name="tel" placeholder="Enter your telephone">
                        <span class="error"><?php echo $error['tel'] ?></span>
                    </div>
                    <div class="form-section">
                        <label for="shop">Closest Shop:</Label> 
                        <select id="shop" name="shop">
                            <option value="Madrid">Madrid</option>
                            <option value="Barcelona">Barcelona</option>
                            <option value="Valencia">Valencia</option>
                        </select> 
                        <span class="error"><?php echo $error['shop'] ?></span>
                    </div>
                    <div class="form-section">
                        <label>Age:</label>
                        <div class="select-section">
                            <div>
                                <input id="-25" type="radio" name="age" value="-25" /> 
                                <label for="-25">Younger than 25</label>
                            </div>
                            <div>
                                <input id="25-50" type="radio" name="age" value="25-50" /> 
                                <label for="25-50">Between 25 and 50</label>
                            </div>
                            <div>
                                <input id="50-" type="radio" name="age" value="50-" />
                                <label for="50-">Older than 50</label>
                            </div>
                            <span class="error"><?php echo $error['age'] ?></span>
                        </div>
                    </div>
                    <div class="form-section">
                        <label for="subscription">Newsletter subscription:</label>
                        <input id="subscription" type="checkbox"  name="subscription"/>
                    </div>
                    <div class="form-section">
                        <div class="submit-section">
                            <input class="submit" type="submit" 
                                   value="Send" name="sendbutton" /> 
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="datos">
            <h1>Datos del formulario</h1>
            <p>
                <?php
                // Solo mostrar los datos si no hay errores
                if ($_SERVER["REQUEST_METHOD"] == "POST" && !$errores) {
                    echo "nombre:" . " " . $_POST["name"] ."<br>";
                    echo "contraseña:" . " " . $_POST["password"] ."<br>";
                    echo "correo:" . " " .  $_POST["email"] ."<br>";
                    echo "año de nacimiento:" . " " . $_POST["dateofbirth"] ."<br>";
                    echo "telefono:" . " " . $_POST["tel"] ."<br>"; 
                    echo "tienda:" . " " . $_POST["shop"] ."<br>"; 
                    echo "edad:" . " " . $_POST["age"] ."<br>"; 
                    echo "subscripción:" . " " . $_subscripcion ."<br>";
                }
                ?>
            </p>
        </div>
    </body>
</html>
