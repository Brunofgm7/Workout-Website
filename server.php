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
    // Validar apenas caracteres válidos para o USERNAME
    if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
        array_push($errors, "Caracteres inválidos no username");
    }
    // validar a length das passwords
    if (strlen($_POST['password1']) > 20 || strlen($_POST['password1']) < 5 || strlen($_POST['password2']) > 20 || strlen($_POST['password2']) < 5) {
        array_push($errors, 'Password must be between 5 and 20 characters long!');
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

            $smt=$pdo->prepare('SELECT * FROM utilizadores WHERE username="Brunofgm7"');
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
            
            $mail->Subject = "Recuperação Palavra-passe";
            
            $mensagem = "<strong>$nomee</strong>,<br />
                        Foi enviado um pedido de recuperação de senha.
                        Para recuperar a palavra-passe, clique no link abaixo.<br />
                        <a href ='localhost/workout-website/validacaoPass.php?key=$key2'>Recuperar palavra-passe</a><br />
                        Se não pediu para recuperar a palavra-passe, ignore esta mensagem.<br />
                        <b>Esta e uma mensagem automatica, por favor nao responda!</b>";

            $corpo_email = "<html><head><style>p{font-family:Arial;font-size:12px}</style></head><body>$mensagem</body>";
            $mail->SetFrom("workoutsiteES@gmail.com","Recuperação Palavra-passe");
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
        array_push($errors, 'Password must be between 5 and 20 characters long!');
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
/*
if(isset($_POST['mudarPass'])) {
    $RepetirNovaPassword = mysqli_real_escape_string($db, $_POST['PalavraPasseAtual']);
    $NovaPassword = mysqli_real_escape_string($db, $_POST['NovaPassword']);
    $RepetirNovaPassword = mysqli_real_escape_string($db, $_POST['RepetirNovaPassword']);

    if(empty($PalavraPasseAtual)) {
        array_push($errors, "Palavra-passe atual não está preenchido");
    }
    if(empty($NovaPassword)) {
        array_push($errors, "Nova palavra-passe não está preenchido");
    }
    if(empty($RepetirNovaPassword)) {
        array_push($errors, "Repetir nova palavra-passe não está preenchido");
    }
    if ($RepetirNovaPassword != $password) {
        array_push($errors, "Palavra-passe atual está errada");
    }
    if ($NovaPassword != $RepetirNovaPassword) {
        array_push($errors, 'Passwords não são correspondentes!');
    }
    if (strlen($_POST['novaPalavraPasse']) > 20  strlen($_POST['novaPalavraPasse']) < 5  strlen($_POST['RepetirNovaPalavraPasse']) > 20 || strlen($_POST['RepetirNovaPalavraPasse']) < 5) {
        array_push($errors, 'Password must be between 5 and 20 characters long!');
    }

}
*/
?>