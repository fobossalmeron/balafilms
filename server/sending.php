<?php 	

	require 'bala.php';
	require 'phpmailer/PHPMailerAutoload.php';
	require 'phpmailer/class.pop3.php';

	function enviaMail($email,$name,$mensaje){
		//Envia Mail
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;

		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'info@balafilms.com';
		$mail->Password = 'infobala';
        $mail->SMTPSecure = 'tls';     
		$mail->Port = 587;
		$mail->setFrom('info@balafilms.com','Info Bala');  
		$mail->addAddress('info@balafilms.com');
		$mail->isHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = 'Nuevo Registro'; 
		$mail->Body = "Alguien se ha registrado en el landing de BalaFilms con los siguientes datos:<br>
                          Nombre: ".$name."<br>
                          Email: ".$email."<br>
                          Mensaje: ".$mensaje;

		
		// if(!$mail->send()) {
		// 	echo 'Message could not be sent.';
		// 	echo 'Mailer Error: ' . $mail->ErrorInfo;

		// } else{
		// 	echo 'mensaje enviado';
		// }

	    }
	    



	//Mail checker
	function checkMail($mail){
if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $mail)){
					return true;
				}else{
					return false;
				}

				
}	

				if(isset($_POST['nombre']) && !empty($_POST['nombre']) AND
				   isset($_POST['correo']) && !empty($_POST['correo']) AND
				   isset($_POST['mensaje']) && !empty($_POST['mensaje']) )

				{
					
					$mail = mysqli_real_escape_string($db,$_POST['correo']);
					$nombre = mysqli_real_escape_string($db,$_POST['nombre']);
					$mensaje = mysqli_real_escape_string($db,$_POST['mensaje']);


					
    if(checkMail($mail)){
	$sql = "INSERT INTO balaus (`id`, `nombre`, `correo`, `mensaje`) VALUES('','$nombre','$mail','$mensaje')";
    $saveDB = mysqli_query($db, $sql);
	if($saveDB){
	enviaMail($mail,$nombre,$mensaje);
	echo "<div id='AjaxAction'><script>document.getElementById('formulario').reset(); </script> 
							<script>
								swal({   title: 'GRACIAS',   
								text: 'En breve nos comunicaremos contigo',   
								imageUrl: './img/succes.png',  
								confirmButtonColor: '#000'
								 });
							</script></div>";




	//*enviaMail($nombre,$mail,$mensaje);
    //header('Location: ../thankyou.html');
    }

	else{
	echo "<div id='AjaxAction'>
						<script>
							swal({   title: 'ERROR',   
							text: 'Error en base de datos',   
							imageUrl: './img/error.png',  
							confirmButtonColor: '#000'
							 });
						</script></div>"; 
	echo   mysqli_error($db);

		}
	}

else{
	echo "<div id='AjaxAction'> 
						 	<script>
							 	swal({   title: 'ERROR',   
								text: 'Mail invalido',   
								imageUrl: './img/error.png',  
								confirmButtonColor: '#000'
								 }); 
							</script></div>";
								
	}
	}	

	else{

echo "<div id='AjaxAction'> 
						 	<script>
						 		swal({   title: 'ERROR',   
								text: 'Datos incompletos',   
								imageUrl: './img/error.png',  
								confirmButtonColor: '#000'
								 }); 
							</script></div>";

				}


 ?>
 
