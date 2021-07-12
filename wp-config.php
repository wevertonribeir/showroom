<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'showroom' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3uX!)MRr|?1=HCw_Ho!1Ak4{F%2jo)T.!i/ FNeeLQKuQFUP8E@4^S*i %V5vJL}' );
define( 'SECURE_AUTH_KEY',  '$^3%U>+q+E+2Qsu<FKB3tC0V7W@|xR:&t$WsLquCOBvJll=5<q<#cNvh2M>*otJ(' );
define( 'LOGGED_IN_KEY',    'iFZC{}!#dS:^0qeZJ</$k*HaPN%MteC5|B,8_Jd-;#v{2ptfs~~kxx+yg{`uk]~R' );
define( 'NONCE_KEY',        'NKFHKA{3xgNS/OfbfDm=^Es]!yEuR!1>fmCQg2T9caY}P9k7Lsg:RcFYT34JnJD/' );
define( 'AUTH_SALT',        ')>^-k;M~AM{Q=mxBR$x#FQ)v`>;0_SG)Rv:mR4qSF$_@iK!xAEM>]!dVnI,aas$X' );
define( 'SECURE_AUTH_SALT', 'SEC82w qF}qz^LffDq8 ycvk0zX,w*Gj[%M,_Qq3!/L<#>%$rw-Kp<vif)bL xb7' );
define( 'LOGGED_IN_SALT',   'G>{Ij{791Efh.D)sN5Ak@^Wuhz.H4XGfjorv}0<X1rLQfukrjX>!e.*$Z/m4(hT%' );
define( 'NONCE_SALT',       'Jj.J}#Czm:VPZ4 bF9GH!_%y/ssa@q]]3zTVx=,1YBAQOwE{o|SU@|3gZh<`S7:m' );
define( 'JWT_AUTH_SECRET_KEY', 'pPtf(O-!|_X!g3(Wc+>sel2),0V{j>Z-O[c[8D:* iB-4e<8rnh{g+`Y.<I}*|/:' );
define('JWT_AUTH_CORS_ENABLE', true);
/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
