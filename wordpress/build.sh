#!/usr/bin/env bash
# Construit les deux ZIP installables (thème + extension) dans wordpress/dist/.
# La bibliothèque de champs est maintenue dans le thème et copiée dans l'extension.
set -euo pipefail
cd "$(dirname "$0")"

THEME=logos-tabernacle
PLUGIN=logos-tabernacle-contenus

mkdir -p "$PLUGIN/includes/fields" "$PLUGIN/assets/admin"
cp "$THEME/inc/fields/class-logos-fields.php" "$PLUGIN/includes/fields/class-logos-fields.php"
cp "$THEME/assets/admin/admin-fields.js" "$THEME/assets/admin/admin-fields.css" "$PLUGIN/assets/admin/"

# Vérification de la syntaxe PHP.
if find "$THEME" "$PLUGIN" -name '*.php' -print0 | xargs -0 -n1 php -l | grep -v '^No syntax errors'; then
	echo "Erreur de syntaxe PHP : construction annulée." >&2
	exit 1
fi

mkdir -p dist
rm -f "dist/$THEME.zip" "dist/$PLUGIN.zip"
zip -qr "dist/$THEME.zip" "$THEME" -x '*.DS_Store'
zip -qr "dist/$PLUGIN.zip" "$PLUGIN" -x '*.DS_Store'
ls -lh dist/
