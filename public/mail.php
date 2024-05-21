<?php

// Destinatário
$emailsender = "marcelo@primenegociosinteligentes.com.br";

// Destinatário
$para = "marcelo@primenegociosinteligentes.com.br";

// Assunto do e-mail
$assunto = "Contato do site";

// Campos do formulário de contato
	$nome= $_POST['nome'];
	$email= $_POST['email'];
	$telefone= $_POST['telefone'];
	$mensagem= $_POST['mensagem'];

// Monta o corpo da mensagem com os campos
$corpo  = "<strong>Mensagem de Contato</strong><br/><br/>";
$corpo .= "Nome: $nome <br> E-mail: $email <br>";
$corpo .= "Telefone: $telefone <br>";
$corpo .= "Mensagem: $mensagem <br>";



			/* Verifica qual éo sistema operacional do servidor para ajustar o cabeçalho de forma correta.  */
			if(PATH_SEPARATOR == ";") $quebra_linha = "\r\n"; //Se for Windows
			else $quebra_linha = "\n"; //Se "nÃ£o for Windows"
			 
			// Passando os dados obtidos pelo formulário para as variáveis abaixo
			$nomeremetente     = 'Rocket Holding';
			$emailremetente    = $emailsender;
			$emaildestinatario = $para;			 
			 
			/* Montando a mensagem a ser enviada no corpo do e-mail. */
			$mensagemHTML = $corpo;
			 
			 
			/* Montando o cabeÃ§alho da mensagem */
			$headers = "MIME-Version: 1.1" .$quebra_linha;
			$headers .= "Content-type: text/html; charset=utf-8" .$quebra_linha;
			// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
			$headers .= "From: " . $emailsender.$quebra_linha;
			$headers .= "Reply-To: " . $emailremetente . $quebra_linha;
			// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)

			/* Enviando a mensagem */
			//É obrigatório o uso do parâmetro -r (concatenação do "From na linha de envio"), aqui na Locaweb:
			if(mail($emaildestinatario, $assunto, $mensagemHTML, $headers ,"-r".$emailsender)){ // Se for Postfix
				$headers .= "Return-Path: " . $emailsender . $quebra_linha; // Se "não for Postfix"
				mail($emaildestinatario, $assunto, $mensagemHTML, $headers );
				
				/* Mostrando na tela as informações enviadas por e-mail */
				$msg = "Sua mensagem foi enviada com sucesso.";
				// Mostra a mensagem acima e redireciona para index.html
				
				echo "<script>
			
				window.open(
				'index.html',
				'_parent');
			
			
				 alert('$msg');
			
				</script>";
				
			} else {
				$msg = "Falha ao enviar.";
				// Mostra a mensagem acima e redireciona para index.html
				echo "<script>
			
				window.open(
				'index.html', '_parent' );
			
			
				 alert('$msg');
			
				</script>";
			}

?>