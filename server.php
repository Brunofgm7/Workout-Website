<?php 

session_start();

$username = "";
$nome = "";
$email = "";
$dataNasc = "";
$errors = array();

include 'database.php';
$db = mysqli_connect('localhost','root','','workout');

//se o botao registo for pressionado
if(isset($_POST['registo'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $nome = mysqli_real_escape_string($db, $_POST['nome']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);
    $dataNasc = mysqli_real_escape_string($db, $_POST['dataNasc']);

    // Verificar se todos os campos estão introduzidos corretamente
    if(empty($username)) {
        array_push($errors, "Username não está preenchido");
    }
    // Validar apenas caracteres válidos para o USERNAME
    if (!empty($username)) {
        if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
        array_push($errors, "Caracteres inválidos no username");
        }   
    }
    if(empty($nome)) {
        array_push($errors, "Nome não está preenchido");
    }
    if(empty($email)) {
        array_push($errors, "Email não está preenchido");
    }
    if(empty($password1)) {
        array_push($errors, "Password não está preenchida");
    }
    if(empty($password2)) {
        array_push($errors, "Repetição da password não está preenchida");
    }
    if ($password1 != $password2) {
        array_push($errors, 'Passwords não são correspondentes!');
    }
    if(empty($dataNasc)) {
        array_push($errors, "Data de nascimento não está preenchida");
    }
    // validar a length das passwords
    if (strlen($_POST['password1']) > 20 || strlen($_POST['password1']) < 5 || strlen($_POST['password2']) > 20 || strlen($_POST['password2']) < 5) {
        array_push($errors, 'Password tem que ter entre 5 a 20 caracteres!');
    }

    // verificar se já existe o username ou o email na BD
    $sql = "SELECT * FROM utilizadores WHERE username = '$username'";
    $result = mysqli_query($db,$sql);
    $sql2 = "SELECT * FROM utilizadores WHERE email = '$email'";
    $result2 = mysqli_query($db,$sql2);
    if(mysqli_num_rows($result)>=1) {
        array_push($errors, "Username existente!");
    } 
    else if(mysqli_num_rows($result2)>=1) {
        array_push($errors, "Email existente!");
    }    

    // se não houve erro nenhum, então adicionar na BD
    if(count($errors) == 0) {
        // Gerar chave
        $key = md5(time().$username);
        
        //encriptar a password para inserir na BD
        $password_encriptada = md5($password1);
        // insira o utilizador na BD
        $sql = "INSERT INTO utilizadores (username, nome, email, password, dataNasc,tipoUtilizador,contaAtivada,chave,foto) VALUES ('$username','$nome','$email','$password_encriptada','$dataNasc',0,0,'$key','fotos/stock.jpg')";
        mysqli_query($db,$sql);

        //enviar email de confirmação
        require_once 'PHPMailer/class.phpmailer.php';
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPSecure = "tls";
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "workoutsiteES@gmail.com";
        $mail->Password = "workoutsite";
        $mail->Port       = 587;
        $mail->Timeout=120;
        $mail->SMTPDebug=0;
        
        $mail->FromName="Workout Website";
    
        $mail->IsHTML(true);
        
        $mail->Subject = "Confirmacao do registo";
        
        $mensagem = "<strong>$nome</strong>,<br />
                    Obrigado pelo seu registo!<br />
                    Para confirmar o registo e ativar a conta, clique no link abaixo.<br />
                    <a href ='http://localhost/workout-website/verificacao.php?key=$key'>Ativar Conta</a><br />
                    <b>Esta e uma mensagem automatica, por favor nao responda!</b>";
    
        $corpo_email = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$mensagem</body>";
        $mail->SetFrom("workoutsiteES@gmail.com","Confirmação conta");
        $mail->AddAddress($email);
        
        $mail->Body=$corpo_email;
        $mail->Send();

        $key = $_POST['key'];

        header('location: login.php?status=success');
    }
}

if(isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Verificar se todos os campos estão introduzidos corretamente
    if(empty($username)) {
        array_push($errors, "Username não está preenchido");
    }
    if(empty($password)) {
        array_push($errors, "Password não está preenchida");
    }
    if(count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM utilizadores WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1) {
            $_SESSION['username'] = $username;
            $smt=$pdo->prepare('SELECT * FROM utilizadores WHERE username=?');
            $smt->execute([$_SESSION["username"]]);
            $utilizador=$smt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['tipoUtilizador'] = $utilizador['tipoUtilizador'];
            $_SESSION['success'] = "";
            // redirecionar para a homepage
            header('location: index.php');
        } else {
            array_push($errors, "Username ou password errados!");
        }
    }
}

// Logout
if(isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header('location: login.php');
}


//Recuperar Palavra-passe
if(isset($_POST['recuperar'])) {
    $userEmail = mysqli_real_escape_string($db, $_POST['userEmail']);
 
    if(empty($userEmail)) {
        array_push($errors, "Username/Email não está preenchido");
    }
    if(count($errors) == 0) {
        $query = "SELECT * FROM utilizadores WHERE username = '$userEmail' OR email = '$userEmail'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1) {

            $smt=$pdo->prepare("SELECT * FROM utilizadores WHERE username = '$userEmail' OR email = '$userEmail'");
            $smt->execute();
            $utilizador=$smt->fetch();
            $key2 = $utilizador['chave'];
            $emaill = $utilizador['email'];
            $nomee = $utilizador['nome'];

            //enviar email de confirmação
            require_once 'PHPMailer/class.phpmailer.php';
            
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPSecure = "tls";
            $mail->Host       = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "workoutsiteES@gmail.com";
            $mail->Password = "workoutsite";
            $mail->Port       = 587;
            $mail->Timeout=120;
            $mail->SMTPDebug=0;
            
            $mail->FromName="Workout Website";

            $mail->IsHTML(true);
            
            $mail->Subject = "Recuperacao Palavra-passe";
            
            $mensagem = "<strong>$nomee</strong>,<br />
                        Foi enviado um pedido de recuperação de senha.
                        Para recuperar a palavra-passe, clique no link abaixo.<br />
                        <a href ='http://localhost/workout-website/validacaoPass.php?key=$key2'>Recuperar palavra-passe</a><br />
                        Se não pediu para recuperar a palavra-passe, ignore esta mensagem e altere a mensagem o mais rápido possível.<br />
                        <b>Esta e uma mensagem automatica, por favor nao responda!</b>";

            $corpo_email = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$mensagem</body>";
            $mail->SetFrom("workoutsiteES@gmail.com","Recuperacao Palavra-passe");
            $mail->AddAddress($emaill);
            
            $mail->Body=$corpo_email;
            $mail->Send();

            $key2 = $_POST['key'];

            header('location: login.php?status=pass');

        } else {
            array_push($errors, "Username ou email não encontrado!");
        }
    }
}

if(isset($_POST['validacaoPass'])) {
    $novaPalavraPasse = mysqli_real_escape_string($db, $_POST['novaPalavraPasse']);
    $RepetirNovaPalavraPasse = mysqli_real_escape_string($db, $_POST['RepetirNovaPalavraPasse']);
    $key = mysqli_real_escape_string($db, $_POST['key']);

    if(empty($novaPalavraPasse)) {
        array_push($errors, "Nova palavra-passe não está preenchido");
    }
    if(empty($RepetirNovaPalavraPasse)) {
        array_push($errors, "Repetir nova palavra-passe não está preenchido");
    }
    if ($novaPalavraPasse != $RepetirNovaPalavraPasse) {
        array_push($errors, 'Passwords não são correspondentes!');
    }
    if (strlen($_POST['novaPalavraPasse']) > 20 || strlen($_POST['novaPalavraPasse']) < 5 || strlen($_POST['RepetirNovaPalavraPasse']) > 20 || strlen($_POST['RepetirNovaPalavraPasse']) < 5) {
        array_push($errors, 'Password tem que ter entre 5 a 20 caracteres!');
    }
    if(count($errors) == 0) {
        $novaPalavraPasse_encrip = md5($novaPalavraPasse);
        $query = "SELECT * FROM utilizadores WHERE chave='$key'";
        $result = mysqli_query($db, $query);
        if(mysqli_num_rows($result) == 1) {
            $smt=$pdo->prepare('UPDATE utilizadores SET password=? WHERE chave=?');
            $smt->execute([$novaPalavraPasse_encrip, $key]);
            $msg="Registo alterado com sucesso";
            // redirecionar para a homepage
            header('location: login.php?status=novapass');
        } else {
            array_push($errors, "Erro!");
        }
    }
}

if(isset($_POST['mudarPass'])) {
    $PasswordAtual = mysqli_real_escape_string($db, $_POST['PasswordAtual']);
    $NovaPassword = mysqli_real_escape_string($db, $_POST['NovaPassword']);
    $RepetirNovaPassword = mysqli_real_escape_string($db, $_POST['RepetirNovaPassword']);

    if(empty($PasswordAtual)) {
        array_push($errors, "Palavra-passe atual não está preenchido");
    }
    if(empty($NovaPassword)) {
        array_push($errors, "Nova palavra-passe não está preenchido");
    }
    if(empty($RepetirNovaPassword)) {
        array_push($errors, "Repetir nova palavra-passe não está preenchido");
    }
    if ($NovaPassword != $RepetirNovaPassword) {
        array_push($errors, 'Passwords não são correspondentes!');
    }
    if (strlen($_POST['NovaPassword']) > 20 || strlen($_POST['NovaPassword']) < 5 || strlen($_POST['RepetirNovaPassword']) > 20 || strlen($_POST['RepetirNovaPassword']) < 5) {
        array_push($errors, 'Password tem que ter entre 5 a 20 caracteres!');
    }
    if(count($errors) == 0) {
        $user = $_SESSION['username'];

        $novaPassword_encrip = md5($NovaPassword);
        $pass = md5($PasswordAtual);

        $query = "SELECT * FROM utilizadores WHERE username='$user'";
        $result = mysqli_query($db, $query);         
     
        if(mysqli_num_rows($result) == 1) {
            //verificar se a pass atual introduzida corresponde à atual
            $sql = "SELECT password FROM utilizadores WHERE username = '$user' AND password = '$pass'";
            $result = mysqli_query($db,$sql);
            if(mysqli_num_rows($result) > 0) {
                $smt=$pdo->prepare('UPDATE utilizadores SET password=? WHERE username=? AND password=? ');
                $smt->execute([$novaPassword_encrip, $user, $pass]);
                // redirecionar para a homepage
                header('location: perfil.php');
            } else {
            array_push($errors, "Password atual não corresponde!");
            }
        }
    }
}


if (isset($_SESSION["certificado"]) and $_SESSION["certificado"]==1) {
    $userEmail = mysqli_real_escape_string($db, $_SESSION['email']);
    
    if(empty($userEmail)) {
        array_push($errors, "Username/Email não está preenchido");
    }
    if(count($errors) == 0) {
        $query = "SELECT * FROM utilizadores WHERE email = '$userEmail'";
        $result = mysqli_query($db, $query);

        if(mysqli_num_rows($result) == 1) {

            $smt=$pdo->prepare("SELECT * FROM utilizadores WHERE email = '$userEmail'");
            $smt->execute();
            $utilizador=$smt->fetch();
            $emaill = $utilizador['email'];
            $nomee = $utilizador['nome'];

            //enviar email de confirmação
            require_once 'PHPMailer/class.phpmailer.php';
            
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPSecure = "tls";
            $mail->Host       = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "workoutsiteES@gmail.com";
            $mail->Password = "workoutsite";
            $mail->Port       = 587;
            $mail->Timeout=120;
            $mail->SMTPDebug=0;
            
            $mail->FromName="Workout Website";

            $mail->IsHTML(true);

            
            $mail->Subject = "Candidatura para professor";
            

            $mensagem = "<strong>$nomee</strong>,<br />
                        Foi recebido o seu certificado para se tornar professor na nossa página.
                        Obrigado pela a sua candidatura, em breve ira ser contactado por nós para saber o resultado.
                        Se não enviou certificado, ignore esta mensagem.<br />
                        <b>Esta e uma mensagem automatica, por favor nao responda!</b>";

            $corpo_email = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$mensagem</body>";
            $mail->SetFrom("workoutsiteES@gmail.com","Candidatura para professor");
            $mail->AddAddress($emaill);
            
            $mail->Body=$corpo_email;
            $mail->Send();

            
            
            header('location: perfil.php');

        } else {
            array_push($errors, "Username ou email não encontrado!");
        }
    }
    $_SESSION["certificado"]=0;
}

if(isset($_POST['manageCandidatura'])) {
    if($_POST['manageCandidatura']=="Aceitar"){
        $username=isset($_POST["username"])?$_POST["username"]:'';
        $tipoUtilizador=1;
        $smt=$pdo->prepare('UPDATE utilizadores SET tipoUtilizador=? WHERE username=?');
        $smt->execute([$tipoUtilizador,$username]);

        $aprovado=1;
        $smt1=$pdo->prepare('UPDATE certificado SET aprovado=? WHERE username=?');
        $smt1->execute([$aprovado, $username]);


        $userEmail = mysqli_real_escape_string($db, $_POST['email']);
    
        if(empty($userEmail)) {
            array_push($errors, "Username/Email não está preenchido");
        }
        if(count($errors) == 0) {
            $query = "SELECT * FROM utilizadores WHERE email = '$userEmail'";
            $result = mysqli_query($db, $query);
        
            if(mysqli_num_rows($result) == 1) {

                $smt=$pdo->prepare("SELECT * FROM utilizadores WHERE email = '$userEmail'");
                $smt->execute();
                $utilizador=$smt->fetch();
                $emaill = $utilizador['email'];
                $nomee = $utilizador['nome'];

                //enviar email de confirmação
                require_once 'PHPMailer/class.phpmailer.php';
            
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPSecure = "tls";
                $mail->Host       = "smtp.gmail.com";
                $mail->SMTPAuth = true;
                $mail->Username = "workoutsiteES@gmail.com";
                $mail->Password = "workoutsite";
                $mail->Port       = 587;
                $mail->Timeout=120;
                $mail->SMTPDebug=0;
            
                $mail->FromName="Workout Website";

                $mail->IsHTML(true);
            
                $mail->Subject = "Candidatura para professor";
            
                $mensagem = "<strong>$nomee</strong>,<br />
                        Parabens,<br />
                        A sua candidatura foi aceite.
                        <b>Esta e uma mensagem automatica, por favor nao responda!</b>";

                $corpo_email = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$mensagem</body>";
                $mail->SetFrom("workoutsiteES@gmail.com","Candidatura para professor");
                $mail->AddAddress($emaill);
            
                $mail->Body=$corpo_email;
                $mail->Send();

        

            } else {
                array_push($errors, "Username ou email não encontrado!");
            }
    }


    }else if($_POST['manageCandidatura']=="Rejeitar"){
        $username=isset($_POST["username"])?$_POST["username"]:'';

        $smt1=$pdo->prepare('SELECT certificado FROM certificado WHERE username=?');
        $smt1->execute([$username]);
        $utilizador=$smt1->fetch(PDO::FETCH_ASSOC);
        unlink($utilizador["certificado"]);

        $smt=$pdo->prepare('DELETE FROM certificado WHERE username=?');
        $smt->execute([$username]);


$userEmail = mysqli_real_escape_string($db, $_POST['email']);

if(empty($userEmail)) {
    array_push($errors, "Username/Email não está preenchido");
}
if(count($errors) == 0) {
    $query = "SELECT * FROM utilizadores WHERE email = '$userEmail'";
    $result = mysqli_query($db, $query);

    if(mysqli_num_rows($result) == 1) {

        $smt=$pdo->prepare("SELECT * FROM utilizadores WHERE email = '$userEmail'");
        $smt->execute();
        $utilizador=$smt->fetch();
        $emaill = $utilizador['email'];
        $nomee = $utilizador['nome'];

        //enviar email de confirmação
        require_once 'PHPMailer/class.phpmailer.php';
    
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPSecure = "tls";
        $mail->Host       = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "workoutsiteES@gmail.com";
        $mail->Password = "workoutsite";
        $mail->Port       = 587;
        $mail->Timeout=120;
        $mail->SMTPDebug=0;
    
        $mail->FromName="Workout Website";

        $mail->IsHTML(true);
    
        $mail->Subject = "Candidatura para professor";
    
        $mensagem = "<strong>$nomee</strong>,<br />
                Infelizmente a sua candidatura não cumpriu os requesitos para se tornar professor.
                <b>Esta e uma mensagem automatica, por favor nao responda!</b>";

        $corpo_email = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$mensagem</body>";
        $mail->SetFrom("workoutsiteES@gmail.com","Candidatura para professor");
        $mail->AddAddress($emaill);
    
        $mail->Body=$corpo_email;
        $mail->Send();



    } else {
        array_push($errors, "Username ou email não encontrado!");
    }
}
    
}
    header('location: adminpage.php');
}


if(isset($_POST['adicionarTreino'])) {
    $nomeTreino = mysqli_real_escape_string($db, $_POST['nomeTreino']);
    $descricaoTreino = mysqli_real_escape_string($db, $_POST['descricaoTreino']);
    $dificuldade = mysqli_real_escape_string($db, $_POST['dificuldade']);

    if(empty($nomeTreino)) {
        array_push($errors, "Nome do treino não está preenchido");
    }
    if(count($errors) == 0) {

        $user = $_SESSION['username'];
        $query = "SELECT id FROM utilizadores WHERE username='$user'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_row($result);
        $id = $row[0];

        $target_dir = "fotosTreinosExercicios/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
        // Check if image file is a actual image or fake image
        if (isset($_POST['fileToUpload'])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
                $uploadOk = 0;
            }    
        } 
		
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
            array_push($errors, "Sorry, your file is too large.");
		    $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
		{
            array_push($errors, "Sorry, only JPG, JPEG, PNG files are allowed.");
		    $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            array_push($errors, "Sorry, your file was not uploaded.");
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                rename($target_dir. $_FILES["fileToUpload"]["name"], $target_dir ."treino_".$nomeTreino."_".$_SESSION["username"].".jpg");

                $imagem=$_FILES["fileToUpload"]["name"]!=""?$target_dir."treino_".$nomeTreino."_".$_SESSION["username"].".jpg":"";
    
                $sql = "INSERT INTO treinos (id_utilizador, titulo, descricao, dificuldade, imagem) VALUES ('$id','$nomeTreino','$descricaoTreino','$dificuldade','$imagem')";
                mysqli_query($db,$sql);
                header('location: adicionarExercicio.php');

            } else {
                array_push($errors, "Sorry, there was an error uploading your file.");
            }
        } 
    }
}


if(isset($_POST['adicionarExercicio'])) {
    $nomeExercicio = mysqli_real_escape_string($db, $_POST['nomeExercicio']);
    $repeticoes = mysqli_real_escape_string($db, $_POST['repeticoes']);
    $dificuldade = mysqli_real_escape_string($db, $_POST['dificuldade']);

    if(empty($nomeExercicio)) {
        array_push($errors, "Nome do exercicio não está preenchido");
    }
    if(empty($repeticoes)) {
        array_push($errors, "Número de repetições não está preenchido");
    }
    if(count($errors) == 0) {

        $user = $_SESSION['username'];
        $query = "SELECT id FROM utilizadores WHERE username='$user'";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_row($result);
        $id = $row[0];

        $target_dir = "fotosTreinosExercicios/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            
        // Check if image file is a actual image or fake image
        if (isset($_POST['fileToUpload'])){
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                // echo "File is not an image.";
                $uploadOk = 0;
            }    
        } 
		
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
            array_push($errors, "Sorry, your file is too large.");
		    $uploadOk = 0;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg")
		{
            array_push($errors, "Sorry, only JPG, JPEG, PNG files are allowed.");
		    $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            array_push($errors, "Sorry, your file was not uploaded.");
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                rename($target_dir. $_FILES["fileToUpload"]["name"], $target_dir ."treino_".$nomeExercicio."_".$_SESSION["username"].".jpg");

                $imagem=$_FILES["fileToUpload"]["name"]!=""?$target_dir."treino_".$nomeExercicio."_".$_SESSION["username"].".jpg":"";
    
                $sql = "INSERT INTO exercicios (nome, series_rep, dificuldade, imagem) VALUES ('$nomeExercicio','$repeticoes','$dificuldade','$imagem')";
                mysqli_query($db,$sql);
                header('location: meustreinos.php');

            } else {
                array_push($errors, "Sorry, there was an error uploading your file.");
            }
        } 
    }
}

if(isset($_POST['tprofessor'])) {

    $_SESSION["certificado"]=0;
    $target_dir = "candidaturas/";
    $filename = basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $FileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
    if($FileType!="pdf"){
        $uploadOk = 0;
        array_push($errors, "Sorry, only PDF files");
    }

    if ($uploadOk == 0) {
        array_push($errors, "Sorry, your file was not uploaded.");
    }else{
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $filename.".tmp")) {
            copy($filename.".tmp", $target_dir."cand_".$_SESSION["username"]."_".$filename);
            unlink($filename.".tmp");
            // echo "The file '".$filename."' was uploaded.";
            $_SESSION["certificado"]=1;

            $email=isset($_POST["email"])?$_POST["email"]:'';
            $username=isset($_POST["username"])?$_POST["username"]:'';
            $certificado=$uploadOk==1?$target_dir."cand_".$_SESSION["username"]."_".$filename:'';
            $aprovado=0;
    
            $db = mysqli_connect('localhost','root','','workout');
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $query = "SELECT * FROM certificado WHERE username = '$username'";
            $result = mysqli_query($db, $query);
        
            if(mysqli_num_rows($result) == 0) {			
                $smt=$pdo->prepare('INSERT INTO certificado (username,email,certificado,aprovado) VALUES (?,?,?,?)');
                $smt->execute([$username,$email,$certificado,$aprovado]);
            }else{
                $smt1=$pdo->prepare('SELECT certificado FROM certificado WHERE username=?');
                $smt1->execute([$_SESSION["username"]]);
                $utilizador=$smt1->fetch(PDO::FETCH_ASSOC);
                unlink($utilizador["certificado"]);

                $smt=$pdo->prepare('UPDATE certificado SET email=?,certificado=? WHERE username=?');
                $smt->execute([$email, $certificado, $username]);				
            }
            header('Location: perfil.php');

            }
        }
}

?>
