<?php
/**
 * Widget Dashboard personnalisé KD-COM
 * 
 * Affiche un tableau de bord personnalisé avec :
 * - En-tête graphique avec logo KD-COM
 * - Cartes Documentation, Contact, Support/Maintenance
 * - Formulaire de support (si maintenance activée)
 * - Guides d'utilisation Pages et Articles
 */

if (!defined('ABSPATH')) {
  exit; // Sécurité : empêche l'accès direct
}

// Register our custom dashboard widget.
function kd_add_my_dashboard_widget() {
  global $wp_meta_boxes;
  
  // Supprimer tous les widgets existants du tableau de bord
  $wp_meta_boxes['dashboard']['normal']['core'] = array();
  $wp_meta_boxes['dashboard']['side']['core'] = array();
  $wp_meta_boxes['dashboard']['column3']['core'] = array();
  $wp_meta_boxes['dashboard']['column4']['core'] = array();
  
  // Ajouter notre widget personnalisé
  wp_add_dashboard_widget(
    'kd-theme-presentation',
    'Présentation du thème KD-COM',
    'kd_render_my_dashboard_widget',
    null,
    null,
    'normal',
    'high'
  );
}
add_action('wp_dashboard_setup', 'kd_add_my_dashboard_widget', 10);

// Fonction de rendu du widget
function kd_render_my_dashboard_widget() {
  $maintenance_kd = get_option('maintenance_kd_com', '0') === '1';
  $logo_url = get_bloginfo('stylesheet_directory') . '/img/logo_admin.png';
  ?>
  <div class="kd-dashboard-widget" style="padding: 0; max-width: 100%;">
    <!-- En-tête graphique avec logo -->
    <div style="background: linear-gradient(135deg, #1a2332 0%, #2d3a4d 100%); color: white; padding: 0; border-radius: 8px 8px 0 0; margin-bottom: 20px; position: relative; overflow: hidden; min-height: 180px;">
      <!-- Motif géométrique de fond -->
      <div style="position: absolute; top: -50px; right: -50px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,107,53,0.15) 0%, transparent 70%); border-radius: 50%;"></div>
      <div style="position: absolute; bottom: -30px; left: -30px; width: 200px; height: 200px; background: radial-gradient(circle, rgba(255,107,53,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
      
      <!-- Barre décorative orange -->
      <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, #e64449 0%, #e64449 100%);"></div>
      
      <!-- Contenu principal -->
      <div style="position: relative; z-index: 2; padding: 40px 30px;">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 30px;">
          <!-- Logo et texte -->
          <div style="display: flex; align-items: center; gap: 25px; flex: 1;">
            <div style="background: white; padding: 15px; border-radius: 12px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); border: 3px solid #e64449;">
              <img src="<?php echo esc_url($logo_url); ?>" alt="KD-COM Logo" style="height: 70px; display: block;">
            </div>
            <div>
              <h2 style="margin: 0 0 8px 0; color: white; font-size: 32px; font-weight: 700; text-shadow: 0 2px 8px rgba(0,0,0,0.3); letter-spacing: -0.5px;">Thème KD-COM</h2>
              <p style="margin: 0; color: #e64449; font-size: 16px; font-weight: 500;">Votre thème WordPress professionnel optimisé</p>
            </div>
          </div>
          
          <!-- Badge version ou info -->
          <div style="background: rgba(255,107,53,0.2); backdrop-filter: blur(10px); padding: 12px 20px; border-radius: 8px; border: 1px solid rgba(255,107,53,0.3);">
            <div style="font-size: 11px; color: #e64449; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 3px;">Powered by</div>
            <div style="font-size: 14px; color: white; font-weight: 600;">KD-COM<br><small><strong>20 rue de Bretagne 53240 Andouillé</strong></small></div>
          </div>
        </div>
      </div>
    </div>
    
    <div style="padding: 0 15px 15px 15px;">
      <div style="background: #f8fafc; padding: 25px; border-radius: 8px; border-left: 4px solid #e64449; margin-bottom: 20px; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
        <h3 style="margin-top: 0; color: #1a2332; font-size: 20px; font-weight: 600;">👋 Bienvenue sur votre site internet !</h3>
        <p style="line-height: 1.6; color: #64748b; font-size: 15px; margin: 0;">
          Vous disposez d'un thème WordPress conçu par KD-COM avec toutes les fonctionnalités modernes 
          pour gérer facilement votre contenu : blocs Gutenberg personnalisés, gestion des couleurs, 
          animations, et bien plus encore.
        </p>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px;">
        <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
          <h4 style="margin: 0 0 10px 0; color: #1a2332; font-size: 18px; font-weight: 600;">📚 Documentation</h4>
          <p style="font-size: 14px; color: #64748b; margin-bottom: 15px;">Consultez le guide d'utilisation complet</p>
         
          <p style="font-size: 12px; color: #555; line-height: 1.5; margin-bottom: 15px;">
            Ce guide vous aidera à maîtriser toutes les fonctionnalités de votre site.
          </p>
          <a href="https://acrobat.adobe.com/id/urn:aaid:sc:EU:6c483d3c-7d46-4bb4-a7e4-07707c0ed5da" target="_blank" class="button button-primary" style="text-decoration: none; background: #e64449; border-color: #e64449;">
            Télécharger le guide
          </a>
        </div>
      
        <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
          <h4 style="margin: 0 0 10px 0; color: #1a2332; font-size: 18px; font-weight: 600;">📞 Contact</h4>
          <p style="font-size: 14px; color: #64748b; margin-bottom: 15px;">Besoin d'aide ? Contactez-nous</p>
          <a href="tel:0626656741" class="button button-secondary" style="text-decoration: none; background: #1a2332; border-color: #1a2332; color: white;">
            📱 06 26 65 67 41
          </a>
        </div>

        
        <div style="background: white; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
          <h4 style="margin: 0 0 10px 0; color: #1a2332; font-size: 18px; font-weight: 600;">✉️ Demande de support</h4>
          <div style="background: #f0f9ff; padding: 12px; border-radius: 6px; border-left: 3px solid #0ea5e9; margin-bottom: 12px;">
            <p style="font-size: 12px; color: #0c4a6e; margin: 0; line-height: 1.5;">
              <strong>🛡️ Site sous contrat de maintenance</strong><br>
              Votre site est maintenu par <strong>KD-COM</strong>. Profitez d'un support technique réactif pour toute question ou problème.
            </p>
          </div>
          <p style="font-size: 14px; color: #64748b; margin-bottom: 15px;">Envoyez-nous votre demande par email</p>
          <button onclick="document.getElementById('kd-support-form-modal').style.display='block'" class="button button-primary" style="text-decoration: none; border: none; cursor: pointer; background: #FF6B35; border-color: #FF6B35;">
            Formulaire de contact
          </button>
        </div>
        
      </div>

    
    <!-- Modal du formulaire de support -->
    <div id="kd-support-form-modal" style="display: none; position: fixed; z-index: 100000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
      <div style="background-color: white; margin: 5% auto; padding: 30px; border-radius: 8px; width: 90%; max-width: 600px; position: relative;">
        <span onclick="document.getElementById('kd-support-form-modal').style.display='none'" style="position: absolute; right: 20px; top: 15px; font-size: 28px; font-weight: bold; cursor: pointer; color: #999;">&times;</span>
        <h3 style="margin-top: 0; color: #1a2332;">Demande de support</h3>
        <iframe src="https://ubiquitous-wallaby-823.notion.site/ebd//8b656f12f65e4f028630067a133a550e" width="100%" height="600" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
   

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
      <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
        <h4 style="margin: 0 0 10px 0; color: #1a2332; font-size: 18px; font-weight: 600;">📄 Utilisation des Pages</h4>
        <ul style="font-size: 13px; color: #64748b; line-height: 1.8; margin: 0; padding-left: 20px;">
          <li>Les pages sont utilisées pour le contenu statique (À propos, Contact, Services...)</li>
          <li>Elles peuvent être organisées de manière hiérarchique (pages parentes/enfants)</li>
          <li>Idéales pour créer la structure principale de votre site</li>
          <li>Ajoutez une page via <strong style="color: #1a2332;">Pages > Ajouter</strong></li>
        </ul>
      </div>
      
      <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0;">
        <h4 style="margin: 0 0 10px 0; color: #1a2332; font-size: 18px; font-weight: 600;">📰 Utilisation des Articles</h4>
        <ul style="font-size: 13px; color: #64748b; line-height: 1.8; margin: 0; padding-left: 20px;">
          <li>Les articles sont parfaits pour le contenu régulier (actualités, blog...)</li>
          <li>Ils sont organisés par date de publication</li>
          <li>Possibilité de les classer par catégories et étiquettes</li>
          <li>Créez un article via <strong style="color: #1a2332;">Articles > Ajouter</strong></li>
        </ul>
      </div>
    </div>
  </div>
  <style>
    /* Force le widget à prendre toute la largeur */
    #dashboard-widgets .postbox-container {
      width: 100% !important;
    }
    #kd-theme-presentation {
      width: 100% !important;
      max-width: 100% !important;
    }
    #kd-theme-presentation .inside {
      margin: 0 !important;
      padding: 0 !important;
    }
    #normal-sortables {
      min-height: 0 !important;
    }
    .kd-dashboard-widget .button {
      display: inline-block;
      padding: 10px 20px;
      border-radius: 4px;
      font-size: 14px;
      transition: all 0.3s ease;
    }
    .kd-dashboard-widget .button:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    }
  </style>
  <?php
}

// Traitement du formulaire de support
add_action('admin_init', 'kd_process_support_form');
function kd_process_support_form() {
  if (isset($_POST['kd_submit_support']) && wp_verify_nonce($_POST['kd_support_nonce'], 'kd_support_form')) {
    $name = sanitize_text_field($_POST['kd_name']);
    $email = sanitize_email($_POST['kd_email']);
    $message = sanitize_textarea_field($_POST['kd_message']);
    
    $site_name = get_bloginfo('name');
    $site_url = get_bloginfo('url');
    $admin_email = get_option('admin_email');
    
    $to = 'contact@kd-com.fr';
    $subject = $site_name . ' - Demande de support';
    
    $body = "Nouvelle demande de support depuis : " . $site_name . "\n";
    $body .= "URL du site : " . $site_url . "\n";
    $body .= "----------------------------------------\n\n";
    $body .= "Nom : " . $name . "\n";
    $body .= "Email : " . $email . "\n\n";
    $body .= "Message :\n" . $message . "\n\n";
    $body .= "----------------------------------------\n";
    $body .= "Envoyé le : " . date('d/m/Y à H:i:s');
    
    // Headers avec Reply-To pour éviter les problèmes de delivrabilité
    $headers = array(
      'Content-Type: text/plain; charset=UTF-8',
      'From: ' . $site_name . ' <' . $admin_email . '>',
      'Reply-To: ' . $name . ' <' . $email . '>'
    );
    
    // Log de debug avant envoi
    error_log('=== DEBUT LOG MAIL SUPPORT KD-COM ===');
    error_log('Destinataire: ' . $to);
    error_log('Sujet: ' . $subject);
    error_log('Admin email: ' . $admin_email);
    error_log('Email demandeur: ' . $email);
    error_log('Nom: ' . $name);
    
    $mail_sent = wp_mail($to, $subject, $body, $headers);
    
    // Log du résultat
    if ($mail_sent) {
      error_log('Résultat: Email envoyé avec succès');
      error_log('=== FIN LOG MAIL SUPPORT (SUCCÈS) ===');
      add_action('admin_notices', function() {
        echo '<div class="notice notice-success is-dismissible"><p>✅ Votre demande de support a été envoyée avec succès !</p></div>';
      });
    } else {
      error_log('Résultat: ÉCHEC de l\'envoi d\'email');
      error_log('=== FIN LOG MAIL SUPPORT (ÉCHEC) ===');
      add_action('admin_notices', function() {
        echo '<div class="notice notice-error is-dismissible"><p>❌ Erreur lors de l\'envoi du message. Vérifiez les logs PHP pour plus de détails.</p></div>';
      });
    }
  }
}

// Ajouter des logs pour les erreurs PHPMailer
add_action('wp_mail_failed', 'kd_log_mail_errors');
function kd_log_mail_errors($wp_error) {
  error_log('=== ERREUR PHPMAILER ===');
  error_log('Message d\'erreur: ' . $wp_error->get_error_message());
  error_log('Code d\'erreur: ' . $wp_error->get_error_code());
  error_log('=== FIN ERREUR PHPMAILER ===');
}
