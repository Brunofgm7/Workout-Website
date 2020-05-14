<?php
    include ('server.php');
    $db = mysqli_connect('localhost','root','','workout');

?>


<body>
<script src="js/app.js"></script>

    <div class="contentPass">
        <table>
            <thead>
                <h2>Mudar palavra-passe</h2>
            </thead>
            <tr>
                <form action="mudarPass.php" method="post">
                <?php include('errors.php'); ?>
                <td>
                    <label for="PalavraPasseAtual">Palavra-passe atual</label>
                </td>
                <td>
                    <input type="text" name="PalavraPasseAtual" placeholder="Inserir nova palavra-passe" value="" id="PalavraPasseAtual">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="NovaPassword">Nova palavra-passe</label>
                </td>
                <td>
                    <input type="text" name="NovaPassword" placeholder="Inserir nova palavra-passe" value="" id="NovaPassword">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="RepetirNovaPassword">Repetir nova palavra-passe</label>
                </td>
                <td>
                    <input type="text" name="RepetirNovaPassword" placeholder="Repetir nova palavra-passe" value="" id="RepetirNovaPassword">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit" name="mudarPass" class="enviar">Mudar palavra-passe</button>
                </td>
            </tr>
        </form>
        </table>
    </div>
</body>