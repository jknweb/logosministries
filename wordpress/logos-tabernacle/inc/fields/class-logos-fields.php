<?php
/**
 * Bibliothèque de champs d'administration partagée par le thème et l'extension
 * Logos Tabernacle (le premier chargé est utilisé, les deux copies sont identiques).
 *
 * Un champ est décrit par un tableau :
 *   id, label, type, desc, default, options (select), fields (repeater), placeholder, rows.
 * Types : text, textarea, wysiwyg, url, email, tel, number, date, time, checkbox,
 *         select, color, image, file, page, icon, repeater, heading.
 *
 * @package Logos_Tabernacle
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Logos_Fields' ) ) :

	final class Logos_Fields {

		const VERSION = '1.0.0';

		/** Icônes disponibles (mêmes noms que le jeu SVG du thème). */
		public static function icons() {
			return array(
				'worship'    => __( 'Église', 'logos-tabernacle' ),
				'book'       => __( 'Livre / Bible', 'logos-tabernacle' ),
				'children'   => __( 'Enfants / groupe', 'logos-tabernacle' ),
				'music'      => __( 'Musique', 'logos-tabernacle' ),
				'heart'      => __( 'Cœur', 'logos-tabernacle' ),
				'prayer'     => __( 'Prière', 'logos-tabernacle' ),
				'hands'      => __( 'Mains / entraide', 'logos-tabernacle' ),
				'user'       => __( 'Personne', 'logos-tabernacle' ),
				'clock'      => __( 'Horloge', 'logos-tabernacle' ),
				'calendar'   => __( 'Calendrier', 'logos-tabernacle' ),
				'pin'        => __( 'Lieu', 'logos-tabernacle' ),
				'phone'      => __( 'Téléphone', 'logos-tabernacle' ),
				'mail'       => __( 'E-mail', 'logos-tabernacle' ),
				'whatsapp'   => __( 'WhatsApp', 'logos-tabernacle' ),
				'youtube'    => __( 'YouTube', 'logos-tabernacle' ),
				'download'   => __( 'Téléchargement', 'logos-tabernacle' ),
				'directions' => __( 'Itinéraire', 'logos-tabernacle' ),
			);
		}

		/** Charge les scripts et styles des champs (médiathèque, couleurs, répéteurs). */
		public static function enqueue( $base_url ) {
			wp_enqueue_media();
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'logos-fields', $base_url . 'admin-fields.css', array(), self::VERSION );
			wp_enqueue_script( 'logos-fields', $base_url . 'admin-fields.js', array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), self::VERSION, true );
			wp_localize_script(
				'logos-fields',
				'logosFields',
				array(
					'chooseImage' => __( 'Choisir une image', 'logos-tabernacle' ),
					'chooseFile'  => __( 'Choisir un fichier', 'logos-tabernacle' ),
					'use'         => __( 'Utiliser', 'logos-tabernacle' ),
					'confirmDel'  => __( 'Supprimer cet élément ?', 'logos-tabernacle' ),
				)
			);
		}

		/**
		 * Affiche une liste de champs dans un tableau de formulaire.
		 *
		 * @param array  $fields Définitions.
		 * @param array  $values Valeurs enregistrées.
		 * @param string $prefix Préfixe du nom HTML (ex. « lt_site »).
		 */
		public static function render_table( $fields, $values, $prefix ) {
			echo '<table class="form-table logos-fields" role="presentation"><tbody>';
			foreach ( $fields as $field ) {
				if ( 'heading' === $field['type'] ) {
					echo '<tr class="logos-fields__heading"><th colspan="2"><h3>' . esc_html( $field['label'] ) . '</h3>';
					if ( ! empty( $field['desc'] ) ) {
						echo '<p class="description">' . wp_kses_post( $field['desc'] ) . '</p>';
					}
					echo '</th></tr>';
					continue;
				}
				$value   = array_key_exists( $field['id'], (array) $values ) ? $values[ $field['id'] ] : ( isset( $field['default'] ) ? $field['default'] : '' );
				$name    = $prefix . '[' . $field['id'] . ']';
				$html_id = self::html_id( $name );
				echo '<tr><th scope="row"><label for="' . esc_attr( $html_id ) . '">' . esc_html( $field['label'] ) . '</label></th><td>';
				self::render( $field, $value, $name );
				echo '</td></tr>';
			}
			echo '</tbody></table>';
		}

		/** Identifiant HTML à partir d'un nom de champ. */
		public static function html_id( $name ) {
			return trim( preg_replace( '/[^a-z0-9_-]+/i', '-', $name ), '-' );
		}

		/** Affiche un champ. */
		public static function render( $field, $value, $name ) {
			$id          = self::html_id( $name );
			$type        = $field['type'];
			$placeholder = isset( $field['placeholder'] ) ? ' placeholder="' . esc_attr( $field['placeholder'] ) . '"' : '';

			switch ( $type ) {
				case 'textarea':
					$rows = isset( $field['rows'] ) ? (int) $field['rows'] : 4;
					printf( '<textarea class="large-text" id="%1$s" name="%2$s" rows="%3$d"%5$s>%4$s</textarea>', esc_attr( $id ), esc_attr( $name ), $rows, esc_textarea( $value ), $placeholder ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;

				case 'wysiwyg':
					wp_editor(
						$value,
						$id,
						array(
							'textarea_name' => $name,
							'textarea_rows' => isset( $field['rows'] ) ? (int) $field['rows'] : 8,
							'media_buttons' => false,
						)
					);
					break;

				case 'checkbox':
					printf(
						'<input type="hidden" name="%1$s" value="0"><label class="logos-toggle"><input type="checkbox" id="%2$s" name="%1$s" value="1" %3$s><span class="logos-toggle__ui" aria-hidden="true"></span><span>%4$s</span></label>',
						esc_attr( $name ),
						esc_attr( $id ),
						checked( (bool) $value, true, false ),
						esc_html( isset( $field['text'] ) ? $field['text'] : __( 'Activé', 'logos-tabernacle' ) )
					);
					break;

				case 'select':
				case 'icon':
					$options = 'icon' === $type ? self::icons() : $field['options'];
					printf( '<select id="%1$s" name="%2$s">', esc_attr( $id ), esc_attr( $name ) );
					foreach ( $options as $key => $label ) {
						printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $key ), selected( (string) $value, (string) $key, false ), esc_html( $label ) );
					}
					echo '</select>';
					break;

				case 'page':
					wp_dropdown_pages(
						array(
							'name'              => $name, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'id'                => $id, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'selected'          => (int) $value,
							'show_option_none'  => __( '— Aucune —', 'logos-tabernacle' ),
							'option_none_value' => '0',
						)
					);
					break;

				case 'color':
					$default = isset( $field['default'] ) ? $field['default'] : '';
					printf( '<input type="text" class="logos-color" id="%1$s" name="%2$s" value="%3$s" data-default-color="%4$s">', esc_attr( $id ), esc_attr( $name ), esc_attr( $value ), esc_attr( $default ) );
					break;

				case 'image':
				case 'file':
					$att_id  = (int) $value;
					$preview = '';
					if ( $att_id ) {
						$preview = 'image' === $type
							? wp_get_attachment_image( $att_id, 'medium' )
							: '<span class="logos-media__name">' . esc_html( basename( (string) get_attached_file( $att_id ) ) ) . '</span>';
					} elseif ( 'image' === $type && ! empty( $field['fallback'] ) ) {
						$preview = '<img src="' . esc_url( $field['fallback'] ) . '" alt=""><em class="logos-media__default">' . esc_html__( 'Image par défaut du thème', 'logos-tabernacle' ) . '</em>';
					}
					printf(
						'<div class="logos-media" data-type="%1$s"><input type="hidden" id="%2$s" name="%3$s" value="%4$s"><div class="logos-media__preview">%5$s</div><p><button type="button" class="button logos-media__choose">%6$s</button> <button type="button" class="button-link logos-media__remove" %7$s>%8$s</button></p></div>',
						esc_attr( $type ),
						esc_attr( $id ),
						esc_attr( $name ),
						esc_attr( $att_id ? $att_id : '' ),
						$preview, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- construit et échappé ci-dessus.
						esc_html( 'image' === $type ? __( 'Choisir une image', 'logos-tabernacle' ) : __( 'Choisir un fichier', 'logos-tabernacle' ) ),
						$att_id ? '' : 'hidden',
						esc_html__( 'Retirer', 'logos-tabernacle' )
					);
					break;

				case 'repeater':
					self::render_repeater( $field, is_array( $value ) ? $value : array(), $name );
					break;

				case 'number':
					$attrs = '';
					foreach ( array( 'min', 'max', 'step' ) as $attr ) {
						if ( isset( $field[ $attr ] ) ) {
							$attrs .= ' ' . $attr . '="' . esc_attr( $field[ $attr ] ) . '"';
						}
					}
					printf( '<input type="number" class="small-text" id="%1$s" name="%2$s" value="%3$s"%4$s>', esc_attr( $id ), esc_attr( $name ), esc_attr( $value ), $attrs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					break;

				default: // text, url, email, tel, date, time.
					$input_type = in_array( $type, array( 'url', 'email', 'tel', 'date', 'time' ), true ) ? $type : 'text';
					$class      = in_array( $type, array( 'date', 'time' ), true ) ? '' : 'regular-text';
					printf( '<input type="%1$s" class="%2$s" id="%3$s" name="%4$s" value="%5$s"%6$s>', esc_attr( $input_type ), esc_attr( $class ), esc_attr( $id ), esc_attr( $name ), esc_attr( $value ), $placeholder ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			if ( ! empty( $field['desc'] ) && 'heading' !== $type ) {
				echo '<p class="description">' . wp_kses_post( $field['desc'] ) . '</p>';
			}
		}

		/** Répéteur : lignes ordonnables, ajout et suppression. */
		private static function render_repeater( $field, $rows, $name ) {
			$add = isset( $field['add_label'] ) ? $field['add_label'] : __( 'Ajouter un élément', 'logos-tabernacle' );
			echo '<div class="logos-repeater" data-name="' . esc_attr( $name ) . '">';
			echo '<ol class="logos-repeater__rows">';
			$index = 0;
			foreach ( $rows as $row ) {
				self::render_repeater_row( $field, (array) $row, $name . '[' . $index . ']' );
				++$index;
			}
			echo '</ol>';
			// Modèle de ligne, cloné en JavaScript (le jeton __i__ est remplacé par l'index).
			echo '<script type="text/html" class="logos-repeater__template">';
			self::render_repeater_row( $field, array(), $name . '[__i__]' );
			echo '</script>';
			echo '<button type="button" class="button logos-repeater__add">' . esc_html( $add ) . '</button>';
			echo '</div>';
		}

		private static function render_repeater_row( $field, $row, $row_name ) {
			echo '<li class="logos-repeater__row"><div class="logos-repeater__bar"><span class="logos-repeater__handle dashicons dashicons-move" title="' . esc_attr__( 'Glisser pour réordonner', 'logos-tabernacle' ) . '"></span><span class="logos-repeater__title"></span><button type="button" class="button-link logos-repeater__remove">' . esc_html__( 'Supprimer', 'logos-tabernacle' ) . '</button></div><div class="logos-repeater__fields">';
			foreach ( $field['fields'] as $sub ) {
				$value = isset( $row[ $sub['id'] ] ) ? $row[ $sub['id'] ] : ( isset( $sub['default'] ) ? $sub['default'] : '' );
				$name  = $row_name . '[' . $sub['id'] . ']';
				echo '<div class="logos-repeater__field logos-repeater__field--' . esc_attr( $sub['type'] ) . '"><label for="' . esc_attr( self::html_id( $name ) ) . '">' . esc_html( $sub['label'] ) . '</label>';
				self::render( $sub, $value, $name );
				echo '</div>';
			}
			echo '</div></li>';
		}

		/**
		 * Nettoie un ensemble de valeurs reçues selon leurs définitions.
		 *
		 * @param array $fields Définitions.
		 * @param array $input  Valeurs brutes, déjà « unslashées » par l’appelant.
		 * @return array
		 */
		public static function sanitize_all( $fields, $input ) {
			$clean = array();
			$input = is_array( $input ) ? $input : array();
			foreach ( $fields as $field ) {
				if ( 'heading' === $field['type'] ) {
					continue;
				}
				$raw                  = isset( $input[ $field['id'] ] ) ? $input[ $field['id'] ] : ( 'checkbox' === $field['type'] ? '0' : '' );
				$clean[ $field['id'] ] = self::sanitize( $field, $raw );
			}
			return $clean;
		}

		/** Nettoie une valeur selon son type. */
		public static function sanitize( $field, $raw ) {
			switch ( $field['type'] ) {
				case 'textarea':
					return sanitize_textarea_field( (string) $raw );
				case 'wysiwyg':
					return wp_kses_post( (string) $raw );
				case 'url':
					return esc_url_raw( trim( (string) $raw ) );
				case 'email':
					return sanitize_email( (string) $raw );
				case 'number':
					if ( '' === $raw ) {
						return '';
					}
					return isset( $field['step'] ) && false !== strpos( (string) $field['step'], '.' ) ? (float) $raw : (int) $raw;
				case 'checkbox':
					return $raw ? '1' : '0';
				case 'image':
				case 'file':
				case 'page':
					return absint( $raw ) ? absint( $raw ) : '';
				case 'color':
					$color = sanitize_hex_color( (string) $raw );
					return $color ? $color : '';
				case 'date':
					$raw = sanitize_text_field( (string) $raw );
					return preg_match( '/^\d{4}-\d{2}-\d{2}$/', $raw ) ? $raw : '';
				case 'time':
					$raw = sanitize_text_field( (string) $raw );
					return preg_match( '/^\d{2}:\d{2}$/', $raw ) ? $raw : '';
				case 'select':
					$raw = sanitize_text_field( (string) $raw );
					return array_key_exists( $raw, $field['options'] ) ? $raw : ( isset( $field['default'] ) ? $field['default'] : '' );
				case 'icon':
					$raw = sanitize_key( (string) $raw );
					return array_key_exists( $raw, self::icons() ) ? $raw : 'book';
				case 'repeater':
					$rows = array();
					if ( is_array( $raw ) ) {
						foreach ( $raw as $key => $row ) {
							if ( '__i__' === (string) $key || ! is_array( $row ) ) {
								continue;
							}
							$clean_row = self::sanitize_all( $field['fields'], $row );
							if ( implode( '', array_map( 'strval', array_filter( $clean_row, 'is_scalar' ) ) ) !== '' ) {
								$rows[] = $clean_row;
							}
						}
					}
					return $rows;
				default:
					return sanitize_text_field( (string) $raw );
			}
		}
	}

endif;
