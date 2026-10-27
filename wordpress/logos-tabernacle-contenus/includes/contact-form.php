<?php
/**
 * Formulaire de contact : affichage, traitement côté serveur, envoi par e-mail
 * et conservation des messages dans « Église › Messages reçus ».
 *
 * @package Logos_Contenus
 */

defined( 'ABSPATH' ) || exit;

/** Réglages du formulaire. */
function logos_contact_fields() {
	return array(
		array( 'id' => 'recipient', 'label' => __( 'E-mail de réception', 'logos-tabernacle' ), 'type' => 'email', 'default' => '', 'desc' => __( 'Adresse qui reçoit les messages. Vide : l’adresse d’administration du site.', 'logos-tabernacle' ) ),
		array( 'id' => 'subjects', 'label' => __( 'Objets proposés', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 5, 'default' => "Question générale\nDemande de prière\nPremière visite\nRejoindre un département\nAutre", 'desc' => __( 'Un objet par ligne.', 'logos-tabernacle' ) ),
		array( 'id' => 'submit_label', 'label' => __( 'Texte du bouton d’envoi', 'logos-tabernacle' ), 'type' => 'text', 'default' => 'Envoyer le message' ),
		array( 'id' => 'whatsapp_button', 'label' => __( 'Bouton WhatsApp', 'logos-tabernacle' ), 'type' => 'checkbox', 'default' => '1', 'text' => __( 'Proposer aussi l’envoi du message par WhatsApp', 'logos-tabernacle' ) ),
		array( 'id' => 'success', 'label' => __( 'Message de confirmation', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Merci, votre message a bien été envoyé. Nous vous répondrons rapidement.' ),
		array( 'id' => 'error', 'label' => __( 'Message d’erreur général', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Votre message n’a pas pu être envoyé. Merci de vérifier les champs ou de nous écrire sur WhatsApp.' ),
		array( 'id' => 'note', 'label' => __( 'Note sous le formulaire', 'logos-tabernacle' ), 'type' => 'textarea', 'rows' => 2, 'default' => 'Vos informations servent uniquement à vous répondre.' ),
	);
}

/** Réglages enregistrés, complétés par les valeurs par défaut. */
function logos_contact_settings() {
	$saved = get_option( 'logos_contact', array() );
	$out   = array();
	foreach ( logos_contact_fields() as $field ) {
		$out[ $field['id'] ] = is_array( $saved ) && array_key_exists( $field['id'], $saved ) ? $saved[ $field['id'] ] : $field['default'];
	}
	return $out;
}

/** Objets proposés. */
function logos_contact_subjects() {
	$subjects = array_filter( array_map( 'trim', explode( "\n", logos_contact_settings()['subjects'] ) ) );
	return $subjects ? array_values( $subjects ) : array( __( 'Question générale', 'logos-tabernacle' ) );
}

/** Numéro WhatsApp (fourni par le thème via le filtre « logos_whatsapp_number »). */
function logos_contact_whatsapp_number() {
	return preg_replace( '/\D+/', '', (string) apply_filters( 'logos_whatsapp_number', '' ) );
}

add_action(
	'admin_init',
	static function () {
		register_setting(
			'logos_contact',
			'logos_contact',
			array(
				'type'              => 'array',
				'sanitize_callback' => static function ( $input ) {
					return Logos_Fields::sanitize_all( logos_contact_fields(), $input );
				},
				'default'           => array(),
			)
		);
	}
);

add_action(
	'admin_menu',
	static function () {
		$hook = add_submenu_page(
			LOGOS_CONTENUS_MENU,
			__( 'Formulaire de contact', 'logos-tabernacle' ),
			__( 'Formulaire de contact', 'logos-tabernacle' ),
			'manage_options',
			'logos-contact',
			'logos_contact_settings_page'
		);
		add_action(
			'admin_print_scripts-' . $hook,
			static function () {
				Logos_Fields::enqueue( LOGOS_CONTENUS_URL . 'assets/admin/' );
			}
		);
	},
	20
);

/** Page de réglages du formulaire. */
function logos_contact_settings_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	echo '<div class="wrap"><h1>' . esc_html__( 'Formulaire de contact', 'logos-tabernacle' ) . '</h1>';
	echo '<p class="logos-admin-intro">' . esc_html__( 'Le formulaire s’affiche sur la page Contact (ou partout avec le code [logos_formulaire_contact]). Chaque message est envoyé par e-mail et conservé dans « Église › Messages reçus ».', 'logos-tabernacle' ) . '</p>';
	echo '<form method="post" action="options.php">';
	settings_fields( 'logos_contact' );
	Logos_Fields::render_table( logos_contact_fields(), get_option( 'logos_contact', array() ), 'logos_contact' );
	submit_button();
	echo '</form>';
	echo '<p class="description">' . esc_html__( 'Conseil : si les e-mails n’arrivent pas, installez une extension SMTP (par exemple « WP Mail SMTP ») pour fiabiliser l’envoi depuis votre hébergement.', 'logos-tabernacle' ) . '</p></div>';
}

/** Signature du champ d'horodatage (empêche de le falsifier). */
function logos_contact_sign( $time ) {
	return substr( wp_hash( 'logos_contact|' . $time, 'nonce' ), 0, 20 );
}

/** Empreinte anonyme de l'adresse IP (limitation des envois). */
function logos_contact_ip_key() {
	$ip = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
	// Derrière un proxy ou un CDN, REMOTE_ADDR est celle du proxy : ce filtre permet de fournir l'adresse réelle du visiteur.
	$ip = (string) apply_filters( 'logos_contact_client_ip', $ip );
	return 'logos_contact_' . md5( $ip . wp_salt( 'nonce' ) );
}

/**
 * HTML du formulaire.
 *
 * @return string
 */
function logos_contact_form() {
	$settings = logos_contact_settings();
	$state    = isset( $_GET['contact'] ) ? sanitize_key( wp_unslash( $_GET['contact'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$token    = isset( $_GET['ct'] ) ? sanitize_key( wp_unslash( $_GET['ct'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$old      = array();
	$errors   = array();
	if ( 'error' === $state && $token ) {
		$stored = get_transient( 'logos_contact_err_' . $token );
		if ( is_array( $stored ) ) {
			$old    = $stored['values'];
			$errors = $stored['errors'];
		}
	}
	$val = static function ( $key ) use ( $old ) {
		return isset( $old[ $key ] ) ? $old[ $key ] : '';
	};

	$whatsapp = $settings['whatsapp_button'] ? logos_contact_whatsapp_number() : '';
	if ( $whatsapp ) {
		wp_enqueue_script( 'logos-contact', LOGOS_CONTENUS_URL . 'assets/contact.js', array(), LOGOS_CONTENUS_VERSION, true );
	}
	$time = time();

	ob_start();
	?>
	<form id="formulaire-contact" class="contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" novalidate<?php echo $whatsapp ? ' data-whatsapp="' . esc_attr( $whatsapp ) . '"' : ''; ?>>
		<?php if ( 'ok' === $state ) : ?>
			<p class="contact-form__success" role="status"><?php echo esc_html( $settings['success'] ); ?></p>
		<?php elseif ( 'error' === $state ) : ?>
			<div class="contact-form__error" role="alert">
				<p><?php echo esc_html( $settings['error'] ); ?></p>
				<?php if ( $errors ) : ?>
					<ul>
						<?php foreach ( $errors as $error ) : ?>
							<li><?php echo esc_html( $error ); ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<input type="hidden" name="action" value="logos_contact">
		<?php wp_nonce_field( 'logos_contact', 'logos_contact_nonce' ); ?>
		<input type="hidden" name="logos_t" value="<?php echo esc_attr( $time . '.' . logos_contact_sign( $time ) ); ?>">
		<div class="contact-form__hp" aria-hidden="true">
			<label>Site web <input type="text" name="logos_website" tabindex="-1" autocomplete="off"></label>
		</div>

		<div class="contact-form__row">
			<label class="field">
				<span><?php esc_html_e( 'Nom complet *', 'logos-tabernacle' ); ?></span>
				<input type="text" name="logos_name" autocomplete="name" maxlength="100" required value="<?php echo esc_attr( $val( 'name' ) ); ?>">
			</label>
			<label class="field">
				<span><?php esc_html_e( 'Téléphone', 'logos-tabernacle' ); ?></span>
				<input type="tel" name="logos_phone" autocomplete="tel" maxlength="30" value="<?php echo esc_attr( $val( 'phone' ) ); ?>">
			</label>
		</div>
		<label class="field">
			<span><?php esc_html_e( 'E-mail (pour vous répondre)', 'logos-tabernacle' ); ?></span>
			<input type="email" name="logos_email" autocomplete="email" maxlength="120" value="<?php echo esc_attr( $val( 'email' ) ); ?>">
		</label>
		<label class="field">
			<span><?php esc_html_e( 'Objet', 'logos-tabernacle' ); ?></span>
			<select name="logos_subject">
				<?php foreach ( logos_contact_subjects() as $subject ) : ?>
					<option <?php selected( $val( 'subject' ), $subject ); ?>><?php echo esc_html( $subject ); ?></option>
				<?php endforeach; ?>
			</select>
		</label>
		<label class="field">
			<span><?php esc_html_e( 'Votre message *', 'logos-tabernacle' ); ?></span>
			<textarea name="logos_message" rows="5" maxlength="5000" required><?php echo esc_textarea( $val( 'message' ) ); ?></textarea>
		</label>

		<p class="contact-form__error" role="alert" data-client-error hidden></p>

		<div class="contact-form__actions">
			<button type="submit" class="btn btn--primary">
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 6-10 7L2 6"/></svg>
				<?php echo esc_html( $settings['submit_label'] ); ?>
			</button>
			<?php if ( $whatsapp ) : ?>
				<button type="button" class="btn btn--whatsapp" data-whatsapp-send>
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
					<?php esc_html_e( 'Envoyer par WhatsApp', 'logos-tabernacle' ); ?>
				</button>
			<?php endif; ?>
		</div>
		<?php if ( $settings['note'] ) : ?>
			<p class="contact-form__note"><?php echo esc_html( $settings['note'] ); ?></p>
		<?php endif; ?>
	</form>
	<?php
	return ob_get_clean();
}

add_shortcode( 'logos_formulaire_contact', 'logos_contact_form' );

/** Redirige vers la page du formulaire avec un état. */
function logos_contact_redirect( $args ) {
	$back = wp_get_referer();
	$back = $back ? wp_validate_redirect( $back, home_url( '/' ) ) : home_url( '/' );
	$back = remove_query_arg( array( 'contact', 'ct' ), $back );
	$back = strtok( $back, '#' );
	wp_safe_redirect( add_query_arg( $args, $back ) . '#formulaire-contact' );
	exit;
}

/** Traitement de l'envoi. */
function logos_contact_handle() {
	// Contrôles anti-robots : jeton de sécurité, champ piège, délai minimal, signature.
	$nonce = isset( $_POST['logos_contact_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['logos_contact_nonce'] ) ) : '';
	if ( ! wp_verify_nonce( $nonce, 'logos_contact' ) ) {
		logos_contact_fail( array( __( 'La session a expiré. Merci de renvoyer le formulaire.', 'logos-tabernacle' ) ), array() );
	}

	$values = array(
		'name'    => isset( $_POST['logos_name'] ) ? sanitize_text_field( wp_unslash( $_POST['logos_name'] ) ) : '',
		'phone'   => isset( $_POST['logos_phone'] ) ? sanitize_text_field( wp_unslash( $_POST['logos_phone'] ) ) : '',
		'email'   => isset( $_POST['logos_email'] ) ? sanitize_email( wp_unslash( $_POST['logos_email'] ) ) : '',
		'subject' => isset( $_POST['logos_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['logos_subject'] ) ) : '',
		'message' => isset( $_POST['logos_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['logos_message'] ) ) : '',
	);
	$raw_email = isset( $_POST['logos_email'] ) ? trim( sanitize_text_field( wp_unslash( $_POST['logos_email'] ) ) ) : '';

	$honeypot = isset( $_POST['logos_website'] ) ? sanitize_text_field( wp_unslash( $_POST['logos_website'] ) ) : '';
	$stamp    = isset( $_POST['logos_t'] ) ? sanitize_text_field( wp_unslash( $_POST['logos_t'] ) ) : '';
	list( $time, $sig ) = array_pad( explode( '.', $stamp, 2 ), 2, '' );
	$elapsed = time() - (int) $time;
	if ( '' !== $honeypot || ! hash_equals( logos_contact_sign( (int) $time ), $sig ) || $elapsed < 3 || $elapsed > DAY_IN_SECONDS ) {
		// Envoi automatisé probable : on ne l'enregistre pas, sans le signaler au robot.
		logos_contact_redirect( array( 'contact' => 'ok' ) );
	}

	// Limite : 5 messages par heure et par adresse IP (0 pour désactiver).
	$key   = logos_contact_ip_key();
	$count = (int) get_transient( $key );
	$limit = (int) apply_filters( 'logos_contact_rate_limit', 5 );
	if ( $limit > 0 && $count >= $limit ) {
		logos_contact_fail( array( __( 'Trop de messages ont été envoyés depuis votre connexion. Merci de réessayer plus tard ou de nous écrire sur WhatsApp.', 'logos-tabernacle' ) ), $values );
	}

	$errors = array();
	if ( '' === $values['name'] ) {
		$errors[] = __( 'Merci d’indiquer votre nom.', 'logos-tabernacle' );
	}
	if ( '' === $values['message'] ) {
		$errors[] = __( 'Merci d’écrire votre message.', 'logos-tabernacle' );
	}
	if ( '' !== $raw_email && ! is_email( $raw_email ) ) {
		$errors[] = __( 'L’adresse e-mail ne semble pas valide.', 'logos-tabernacle' );
		$values['email'] = $raw_email;
	}
	if ( '' !== $values['phone'] && ! preg_match( '/^[0-9+().\s-]{6,30}$/', $values['phone'] ) ) {
		$errors[] = __( 'Le numéro de téléphone ne semble pas valide.', 'logos-tabernacle' );
	}
	if ( ! in_array( $values['subject'], logos_contact_subjects(), true ) ) {
		$values['subject'] = logos_contact_subjects()[0];
	}
	if ( mb_strlen( $values['name'] ) > 100 || mb_strlen( $values['message'] ) > 5000 ) {
		$errors[] = __( 'Votre message est trop long.', 'logos-tabernacle' );
	}
	if ( $errors ) {
		logos_contact_fail( $errors, $values );
	}

	set_transient( $key, $count + 1, HOUR_IN_SECONDS );

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'lt_message',
			'post_status' => 'private',
			'post_title'  => $values['name'] . ' · ' . $values['subject'],
		),
		true
	);
	if ( ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_lt_name', $values['name'] );
		update_post_meta( $post_id, '_lt_phone', $values['phone'] );
		update_post_meta( $post_id, '_lt_email', $values['email'] );
		update_post_meta( $post_id, '_lt_subject', $values['subject'] );
		update_post_meta( $post_id, '_lt_message', $values['message'] );
		update_post_meta( $post_id, '_lt_unread', '1' );
	}

	$settings  = logos_contact_settings();
	$recipient = is_email( $settings['recipient'] ) ? $settings['recipient'] : get_option( 'admin_email' );
	$site      = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );
	$body      = sprintf(
		"Nouveau message envoyé depuis le site %s\n\nNom : %s\nTéléphone : %s\nE-mail : %s\nObjet : %s\n\n%s\n\n--\nMessage conservé dans le tableau de bord : %s",
		$site,
		$values['name'],
		$values['phone'] ? $values['phone'] : '—',
		$values['email'] ? $values['email'] : '—',
		$values['subject'],
		$values['message'],
		is_wp_error( $post_id ) ? admin_url() : admin_url( 'post.php?post=' . (int) $post_id . '&action=edit' )
	);
	$headers = array();
	if ( $values['email'] ) {
		$headers[] = 'Reply-To: ' . str_replace( array( "\r", "\n", '<', '>', ',' ), '', $values['name'] ) . ' <' . $values['email'] . '>';
	}
	$sent = wp_mail( $recipient, sprintf( '[%s] %s · %s', $site, $values['subject'], $values['name'] ), $body, $headers );
	if ( ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_lt_mailed', $sent ? '1' : '0' );
	}

	if ( is_wp_error( $post_id ) && ! $sent ) {
		logos_contact_fail( array(), $values );
	}

	do_action( 'logos_contact_received', $post_id, $values, $sent );
	logos_contact_redirect( array( 'contact' => 'ok' ) );
}
add_action( 'admin_post_nopriv_logos_contact', 'logos_contact_handle' );
add_action( 'admin_post_logos_contact', 'logos_contact_handle' );

/** Mémorise erreurs et saisies quelques minutes, puis revient au formulaire. */
function logos_contact_fail( $errors, $values ) {
	$token = strtolower( wp_generate_password( 12, false ) );
	set_transient( 'logos_contact_err_' . $token, array( 'errors' => $errors, 'values' => $values ), 10 * MINUTE_IN_SECONDS );
	logos_contact_redirect( array( 'contact' => 'error', 'ct' => $token ) );
}
