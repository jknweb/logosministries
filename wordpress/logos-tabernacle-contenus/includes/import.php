<?php
/**
 * Import initial des contenus du site d'origine (une seule fois, à l'activation).
 * Un type qui contient déjà des éléments n'est jamais modifié.
 *
 * @package Logos_Contenus
 */

defined( 'ABSPATH' ) || exit;

/**
 * Ajoute une image du dossier demo/ à la médiathèque.
 *
 * @return int Identifiant du fichier joint, 0 en cas d'échec.
 */
function logos_contenus_import_image( $filename, $alt = '' ) {
	$imported = get_option( 'logos_contenus_media', array() );
	if ( isset( $imported[ $filename ] ) && get_post( $imported[ $filename ] ) ) {
		return (int) $imported[ $filename ];
	}
	$source = LOGOS_CONTENUS_DIR . 'demo/' . $filename;
	if ( ! file_exists( $source ) ) {
		return 0;
	}
	$upload = wp_upload_bits( $filename, null, file_get_contents( $source ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- fichier local de l'extension.
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	$attachment_id = wp_insert_attachment(
		array(
			'post_mime_type' => 'image/jpeg',
			'post_title'     => $alt ? $alt : pathinfo( $filename, PATHINFO_FILENAME ),
			'post_status'    => 'inherit',
		),
		$upload['file']
	);
	if ( ! $attachment_id || is_wp_error( $attachment_id ) ) {
		return 0;
	}
	wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $upload['file'] ) );
	if ( $alt ) {
		update_post_meta( $attachment_id, '_wp_attachment_image_alt', $alt );
	}
	$imported[ $filename ] = $attachment_id;
	update_option( 'logos_contenus_media', $imported, false );
	return (int) $attachment_id;
}

/** Vrai si le type contient déjà au moins un élément. */
function logos_contenus_has_posts( $post_type ) {
	return (bool) get_posts( array( 'post_type' => $post_type, 'post_status' => 'any', 'posts_per_page' => 1, 'fields' => 'ids' ) );
}

/** Crée un contenu avec ses métadonnées. */
function logos_contenus_insert( $post_type, $args, $meta = array(), $image = '' ) {
	$post_id = wp_insert_post(
		array_merge(
			array(
				'post_type'   => $post_type,
				'post_status' => 'publish',
			),
			$args
		)
	);
	if ( ! $post_id || is_wp_error( $post_id ) ) {
		return 0;
	}
	foreach ( $meta as $key => $value ) {
		update_post_meta( $post_id, $key, $value );
	}
	if ( $image ) {
		$attachment = logos_contenus_import_image( $image[0], $image[1] );
		if ( $attachment ) {
			set_post_thumbnail( $post_id, $attachment );
		}
	}
	return $post_id;
}

/** Contenus du site d'origine (src/data). */
function logos_contenus_import_defaults() {
	if ( get_option( 'logos_contenus_imported' ) ) {
		return;
	}

	if ( ! logos_contenus_has_posts( 'lt_horaire' ) ) {
		$schedule = array(
			array( 'Ecodim', 'Dimanche', '7h30', 'children', 'Enfants', 'Enseignement biblique pour les enfants, formation ludique et croissance spirituelle.', "Classes adaptées à chaque tranche d’âge\nHistoires bibliques, chants et activités\nLes enfants rejoignent ensuite leurs parents" ),
			array( 'Culte du dimanche', 'Dimanche', '8h30', 'worship', 'Tout public', 'Louange, adoration, prédication de la Parole, prière et communion fraternelle.', "Louange et adoration avec la chorale\nPrédication de la Parole\nPrière et communion fraternelle" ),
			array( 'Culte de la semaine', 'Mardi et jeudi', '17h30', 'book', 'Tout public', 'Enseignement approfondi, intercession, édification et moments de réveil.', "Étude approfondie des Écritures\nTemps d’intercession\nÉdification et réveil" ),
		);
		foreach ( $schedule as $i => $s ) {
			logos_contenus_insert(
				'lt_horaire',
				array( 'post_title' => $s[0], 'menu_order' => $i ),
				array( '_lt_day' => $s[1], '_lt_time' => $s[2], '_lt_icon' => $s[3], '_lt_audience' => $s[4], '_lt_summary' => $s[5], '_lt_details' => $s[6] )
			);
		}
	}

	if ( ! logos_contenus_has_posts( 'lt_departement' ) ) {
		$ministries = array(
			array( 'Musique et louange', 'music', 'Notre chorale et notre groupe de louange conduisent l’assemblée dans l’adoration chaque dimanche.' ),
			array( 'Département des mamans', 'heart', 'Des femmes priantes et dévouées qui intercèdent pour l’église, la famille et la nation, tout en œuvrant dans le social.' ),
			array( 'Intercession', 'prayer', 'Une équipe qui se tient à la brèche pour soutenir le ministère et porter les requêtes des fidèles.' ),
			array( 'Action sociale', 'hands', 'L’Évangile en action : visite des malades, soutien aux orphelins et aide aux plus démunis.' ),
			array( 'Jeunesse et Ecodim', 'children', 'Accompagner les enfants et les jeunes pour qu’ils grandissent dans la foi et la connaissance de la Parole.' ),
		);
		foreach ( $ministries as $i => $m ) {
			logos_contenus_insert( 'lt_departement', array( 'post_title' => $m[0], 'menu_order' => $i ), array( '_lt_icon' => $m[1], '_lt_text' => $m[2], '_lt_join' => '1' ) );
		}
	}

	if ( ! logos_contenus_has_posts( 'lt_evenement' ) ) {
		logos_contenus_insert(
			'lt_evenement',
			array(
				'post_title'   => 'Spécial veillée de la traversée 2027',
				'post_name'    => 'veillee-traversee-2027',
				'post_excerpt' => 'Dans la nuit du 31 décembre au 1er janvier, venez traverser de 2026 à 2027 dans la présence de Dieu : louange, prière et méditation de la Parole pour entrer dans la nouvelle année.',
				'post_content' => 'Dans la nuit du 31 décembre au 1er janvier, venez traverser de 2026 à 2027 dans la présence de Dieu : louange, prière et méditation de la Parole pour entrer dans la nouvelle année.',
			),
			array( '_lt_date' => '2026-12-31', '_lt_time' => '', '_lt_location' => 'Temple Logos Tabernacle, Ozone-Ngaliema', '_lt_cta' => '1' ),
			array( 'assemblee.jpg', 'L’assemblée réunie pour le culte à Logos Tabernacle' )
		);
	}

	if ( ! logos_contenus_has_posts( 'lt_enseignement' ) ) {
		$base = time();
		logos_contenus_insert(
			'lt_enseignement',
			array( 'post_title' => 'Enseignement précédent', 'post_date' => wp_date( 'Y-m-d H:i:s', $base - 2 * DAY_IN_SECONDS ) ),
			array( '_lt_youtube' => 'https://www.youtube.com/watch?v=lvJ002eSFbw', '_lt_featured' => '0' )
		);
		logos_contenus_insert(
			'lt_enseignement',
			array( 'post_title' => 'Enseignement précédent', 'post_date' => wp_date( 'Y-m-d H:i:s', $base - DAY_IN_SECONDS ) ),
			array( '_lt_youtube' => 'https://www.youtube.com/watch?v=zoSMxPDnSYk', '_lt_featured' => '0' )
		);
		logos_contenus_insert(
			'lt_enseignement',
			array(
				'post_title'   => 'Le dernier message',
				'post_date'    => wp_date( 'Y-m-d H:i:s', $base - 60 ),
				'post_excerpt' => 'Revivez le dernier enseignement partagé à Logos Tabernacle : un temps de Parole pour vous équiper, vous fortifier et nourrir votre foi tout au long de la semaine.',
			),
			array( '_lt_youtube' => 'https://www.youtube.com/watch?v=wZkenFjduRs', '_lt_speaker' => 'Rév. Yves Kalombo', '_lt_date' => '2026-10-18', '_lt_featured' => '1' ),
			array( 'ambiance-temple.jpg', 'Ambiance du temple Logos Tabernacle' )
		);
	}

	if ( ! logos_contenus_has_posts( 'lt_ressource' ) ) {
		foreach ( array( array( 'Recueil des chants', '2,4 Mo' ), array( 'Résumé des prédications', '5,1 Mo' ), array( 'Brochure de l’église', '3,8 Mo' ) ) as $i => $r ) {
			logos_contenus_insert( 'lt_ressource', array( 'post_title' => $r[0], 'menu_order' => $i ), array( '_lt_size' => $r[1] ) );
		}
	}

	if ( ! logos_contenus_has_posts( 'lt_equipe' ) ) {
		$bio = <<<'HTML'
<h3>Origines</h3>
<p>Le pasteur Yves Kalombo est né le 14 juillet 1959 à Dekese, dans l’ex-Kasaï Occidental, au sein d’une famille de douze enfants dont il est le deuxième. Son père, Kalombo Kabwe Simon Pierre, a travaillé dans l’administration publique avant de terminer sa carrière comme cadre à la SNCC. Sa mère s’appelait Victorine Tshibwabwa Tshimanga.</p>
<h3>Formation</h3>
<p>Au gré des mutations professionnelles de son père, il étudie dans plusieurs villes du pays : le primaire au Collège Saint-Louis de Kananga, puis l’Athénée de la Gombe à Kinshasa, et le secondaire à Lubumbashi, au Collège Imara et à l’Institut Kiwele.</p>
<p>À Kinshasa, il obtient le diplôme d’ingénieur technicien en électronique radionavigation à l’Institut Supérieur des Techniciens Appliqués (ISTA). Il se forme ensuite au journalisme et à l’informatique au centre CEFOJI. Ce double profil, technique et communicant, sera mis au service de l’évangélisation et de l’enseignement biblique.</p>
<h3>Famille et médias</h3>
<p>En 1984, il épouse Mademoiselle Gorettie Twebana Kalombo. Le couple est parent de huit enfants. En 2003, il crée à Kinshasa un magazine d’informations religieuses, signe de son souci de porter le message chrétien au-delà de la chaire.</p>
<h3>Conversion et appel</h3>
<p>Son parcours spirituel est marqué dès sa jeunesse par une recherche profonde du sens de la vie. Pendant ses études, il vit une conversion qui transforme sa vision de l’existence et oriente toute sa vie vers la prédication de l’Évangile. De cette rencontre avec Dieu naît une conviction durable : servir Jésus-Christ et annoncer Sa Parole avec fidélité.</p>
HTML;
		logos_contenus_insert(
			'lt_equipe',
			array(
				'post_title'   => 'Rév. Yves Kalombo',
				'menu_order'   => 0,
				'post_excerpt' => 'Ingénieur de formation, converti pendant ses études, le pasteur Yves Kalombo prêche l’Évangile depuis les années 1980. Il a fondé Logos Tabernacle en 1987 à Ngaliema-Ozone, avec la conviction de servir Jésus-Christ et d’annoncer Sa Parole avec fidélité.',
				'post_content' => $bio,
			),
			array(
				'_lt_role'    => 'Pasteur principal et fondateur',
				'_lt_lead'    => '1',
				'_lt_visible' => '1',
				'_lt_facts'   => array(
					array( 'label' => 'Naissance', 'value' => '14 juillet 1959, Dekese' ),
					array( 'label' => 'Formation', 'value' => 'Ingénieur technicien (ISTA), journalisme et informatique (CEFOJI)' ),
					array( 'label' => 'Famille', 'value' => 'Marié depuis 1984 à Gorettie Twebana Kalombo, huit enfants' ),
					array( 'label' => 'Ministère', 'value' => 'Fondateur de Logos Tabernacle (1987)' ),
				),
			),
			array( 'pasteur-yves-kalombo.jpg', 'Portrait du Rév. Yves Kalombo' )
		);
		foreach ( array( array( 'Pasteur Gershom', 'pasteur-gershom.jpg' ), array( 'Pasteur Joël', 'pasteur-joel.jpg' ), array( 'Pasteur Salem', 'pasteur-salem.jpg' ) ) as $i => $p ) {
			logos_contenus_insert(
				'lt_equipe',
				array( 'post_title' => $p[0], 'menu_order' => $i + 1 ),
				array( '_lt_role' => '', '_lt_lead' => '0', '_lt_visible' => '1' ),
				array( $p[1], 'Portrait du ' . $p[0] )
			);
		}
	}

	update_option( 'logos_contenus_imported', LOGOS_CONTENUS_VERSION, false );
}
