<?php 

$FAQ_INTRO_QUESTION = "¿Pero esto de qué va?";
$FAQ_INTRO_SUBQUESTION1 = "¿Has tenido un flechazo con un desconocido pero no te atreviste a decirle nada?";
$FAQ_INTRO_SUBQUESTION2 = "¿Te gustaría contactar con alguien que no conoces pero sólo si esa persona quiere también?";
$FAQ_INTRO_SUBQUESTION3 = "¿Te gustaría saber si esa persona con la que te cruzas cada mañana quiere decirte algo?";

$FAQ_INTRO_ANSWER_P1 = "<p>A diario nos cruzamos con montones de desconocidos que vemos y olvidamos rápidamente. Sin embargo, de vez en cuando vemos a alguien que nos transmite algo y que, por alguna razón despierta en nosotros una extraña atracción. Quizá vuestras miradas se cruzan. Quizá os sonreís. Quizá ambos os preguntáis si la otra persona siente la misma atracción. ¿Qué hacer?.</p>";

$FAQ_INTRO_ANSWER_P2 = "<p>seeshy es el primer buscador para gente que no conoces y que te gustaría conocer. Encontrar a esa persona puede ser más fácil de lo que crees. Sólo hace falta que ambos pongáis interés en ello. El resto es trabajo nuestro. Rellenando un simple formulario estarás a un paso de esa persona que crees que no volverás a ver. Así que deja de lamentarte y empieza a buscar ya. Alguien podría estar ahora mismo buscándote a ti!</p>";

$FAQ_INTRO_QUESTION_MOAR ="¡Tengo más preguntas!";

$FAQ_INTRO_MOAR_TEXT = "<p>No te preocupes. Nos encanta responder a las preguntas m&aacute;s raras que puedas tener. A continuaci&oacute;n tienes una lista de las m&aacute;s frecuentes ya contestadas. Si por alguna raz&oacute;n eres especialmente creativo y tienes otra que no est&aacute; en esta lista, no dudes en contactar con nosotros via email :</p>";

$FAQ_LIST = "<ul>";

//////////////////////////////////////
//////// FAQ QUESTIONS
//////////////////////////////////////

$FAQS = array(  );

$FAQS[] = array('¿C&oacute;mo funciona?',
				'<p>La b&uacute;squeda es algo muy sencillo. Simplemente necesitamos que nos proporciones algunos datos sobre el lugar y el momento del encuentro, as&iacute; como una descripci&oacute;n aproximada tanto de ti como de la persona que buscas. Con estos datos el sistema intentar&aacute; emparejarte con la persona que m&aacute;s encaje con el perfil e informaci&oacute;n que has dado. Naturalmente para que todo esto funcione es necesario que ambas personas se busquen mutuamente.</p><p>Una vez se detecta un posible emparejamiento, cada candidato recibe un email avis&aacute;ndole de ello e invit&aacute;ndole a leer el mensaje que esta persona escribi&oacute;. Si ambas personas confirman que esa es la persona que buscan, se les envia el respectivo email del candidato.</p> ');

$FAQS[] = array('¿Qu&eacute; pasa si no señalo bien el lugar del encuentro?',
				'<p>No es grave siempre que no falles por mucho. La b&uacute;squeda tiene un radio de tolerancia de unos 200 metros, espacio m&aacute;s que suficiente para que puedas equivocarte de lugar exacto.</p>');

$FAQS[] = array('¿Y si nos vimos en un tren, avi&oacute;n, autob&uacute;s?',
				'<p>Si os visteis en un entorno en movimiento, elegid como punto de encuentro el lugar donde os perdisteis de vista (estaci&oacute;n, aeropuerto...)</p>');

$FAQS[] = array('¿Y si me equivoco en la hora, en la edad o en alguna otra cosa?',
				'<p>No te preocupes. Si son pequeños fallos encontrar&aacute;s igualmente a la persona que buscas. Adivinar la edad a veces es complicado y la hora podr&iacute;a estar justo entre dos intervalos. Elige cuidadosamente los datos del encuentro pero no te obsesiones con acertar al 100%.</p>');

$FAQS[] = array('¿Cu&aacute;nto tiempo tardar&eacute; en saber si mi b&uacute;squeda tiene &eacute;xito?',
				'<p>seeshy borra las b&uacute;squedas pendientes 15 d&iacute;as despu&eacute;s de la fecha de creaci&oacute;n. Esto quiere decir que si envias tu b&uacute;squeda hoy, la persona que buscas dispone de 2 semanas para buscarte a ti y emparejaros. Tras ese periodo tu b&uacute;squeda se borrar&aacute; del directorio.</p>');

$FAQS[] = array('¿Y si no tiene &eacute;xito?',
				'<p>Si transcurridos 15 d&iacute;as tu b&uacute;squeda no devuelve ning&uacute;n resultado, te informaremos del hecho y podr&aacute;s entonces reintentarlo si as&iacute; lo deseas. Desgraciadamente las cosas no siempre terminan felizmente y es posible que tu b&uacute;squeda nunca devuelva resultados.</p>');

$FAQS[] = array('¿Cotilleais los mensajes que la gente escribe?',
				'<p>No. En seeshy nos tomamos muy en serio tu privacidad y no tenemos ninguna intenci&oacute;n de revisar las b&uacute;squedas que hacen nuestros usuarios. Puedes estar tranquilo.</p>');

$FAQS[] = array('Si os doy mi direcci&oacute;n de correo, ¿me mandar&eacute;is basura?',
				'<p>No. De hecho no podr&iacute;amos aunque quisi&eacute;ramos, pues no guardaremos tu direcci&oacute;n durante m&aacute;s tiempo del estrictamente necesario. Una vez tu b&uacute;squeda haya finalizado borraremos tus datos y nunca m&aacute;s sabremos nada sobre ti.</p>');

$FAQS[] = array('¿Puede coincidir mi b&uacute;squeda con la de alguien diferente a quien busco?',
				'<p>S&iacute;, podr&iacute;a suceder. Algunas localizaciones son especialmente calientes para realizar b&uacute;squedas de gente desconocida (discotecas, bares, estaciones...). En esos casos es posible que tu b&uacute;squeda devuelva m&aacute;s de un resultado. Si esto sucede simplemente lee los mensajes de cada candidato y decide cuidadosamente cual pertenece a la persona que buscas. Recuerda que s&oacute;lo puedes elegir a un candidato para poneros en contacto.</p>');

$FAQS[] = array('¿Caduca mi b&uacute;squeda?',
				'<p>S&iacute;, a los 15 d&iacute;as borramos tu b&uacute;squeda y tus datos del directorio.</p>');
			
$FAQS[] = array('seeshy hace cosas raras con mi navegador',
	'<p>seeshy est&aacute; optimizada para las &uacute;ltimas versiones de Internet Explorer, Firefox, Safari y Chrome. Si suceden cosas raras, prueba a actualizar tu navegador a la &uacute;ltima versi&oacute;n.</p>');


$FAQS[] = array('Hab&eacute;is montado todo esto para ligar eh?',
				'<p>Nos has pillado. En realidad somos las personas m&aacute;s t&iacute;midas del mundo y todo esto no es m&aacute;s que una excusa para conseguir chicas :D</p>');

//////////////////////////////////////
//////// END OF FAQ QUESTIONS
//////////////////////////////////////

$FAQ_LIST .= "</ul>";

?> 
