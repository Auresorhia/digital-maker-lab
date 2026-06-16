-- ============================================
-- Fichier SQL pour la fonctionnalité Login Admin
-- Auteur: [Votre nom]
-- Date: 2026-06-01
-- ============================================
-- 
-- Ce fichier contient les requêtes SQL nécessaires
-- pour la fonctionnalité de connexion administrateur
-- 
-- À MENTIONNER dans la Pull Request pour intégration
-- dans le fichier init_db.sql principal
-- ============================================

-- Création de la table admins
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion d'un compte admin par défaut (à modifier en production)
-- Email: leo.duriezj@gmail.com
-- Mot de passe: Admin123! (à changer immédiatement après la première connexion)
INSERT INTO admins (email, password) VALUES 
('leo.duriezj@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Note: Le mot de passe hashé ci-dessus correspond à "Admin123!"
-- Il est FORTEMENT recommandé de changer ce mot de passe après la première connexion

-- ============================================
-- Requêtes de test (optionnelles)
-- ============================================

-- Vérifier que la table a été créée
-- SELECT id, email, created_at FROM admins;

-- Compter le nombre d'admins
-- SELECT COUNT(*) as total_admins FROM admins;
